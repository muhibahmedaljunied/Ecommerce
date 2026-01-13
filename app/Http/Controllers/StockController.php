<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductFamilyAttribute;
use App\Models\StockTransaction;

class StockController extends Controller
{
    /**
     * Adjust stock for a product variant.
     * POST /stock/adjust
     * Params: variant_id, change (integer), type (optional), note (optional)
     */
    public function adjust(Request $request)
    {
        $request->validate([
            'variant_id' => 'required|integer|exists:product_family_attributes,id',
            'change' => 'required|integer'
        ]);

        $variant = ProductFamilyAttribute::find($request->variant_id);
        if (!$variant) {
            return response()->json(['error' => 'Variant not found'], 404);
        }

        $change = (int)$request->change;

        if ($change < 0 && abs($change) > $variant->qty) {
            return response()->json(['error' => 'Insufficient stock to decrease by that amount'], 400);
        }

        if ($change >= 0) {
            $variant->increment('qty', $change);
        } else {
            $variant->decrement('qty', abs($change));
        }

        $transaction = StockTransaction::create([
            'product_family_attribute_id' => $variant->id,
            'change' => $change,
            'type' => $request->input('type', 'adjustment'),
            'reference_id' => $request->input('reference_id'),
            'reference_type' => $request->input('reference_type'),
            'user_id' => auth()->id() ?? null,
            'note' => $request->input('note')
        ]);

        return response()->json(['success' => true, 'variant' => $variant, 'transaction' => $transaction]);
    }

    /**
     * List stock transactions (with optional filters)
     * GET /stock/transactions
     */
    public function transactions(Request $request)
    {
        // Order by id descending for consistent behavior in tests and environments
        $query = StockTransaction::with('variant')->orderBy('id', 'desc');

        if ($request->has('variant_id')) {
            $query->where('product_family_attribute_id', $request->variant_id);
        }

        $data = $query->paginate(50);

        return response()->json($data);
    }

    /**
     * Admin list of current stock variants with last transaction and low-stock flag.
     * GET /stocks
     */
    public function index(Request $request)
    {
        $query = ProductFamilyAttribute::with('product')->orderBy('id', 'desc');

        if ($request->has('product_id')) {
            $query->where('product_id', $request->product_id);
        }

        $perPage = (int)$request->get('per_page', 50);

        $data = $query->paginate($perPage);

        // Attach derived fields: last_transaction and low_stock
        $data->getCollection()->transform(function ($variant) {
            $last = $variant->stockTransactions()->orderBy('id', 'desc')->first();
            return [
                'id' => $variant->id,
                'product_id' => $variant->product_id,
                'product_name' => $variant->product->name ?? null,
                'sku' => $variant->id,
                'qty' => $variant->qty,
                'alert_qty' => $variant->alert_qty,
                'low_stock' => $variant->isLowStock(),
                'last_transaction' => $last ? [
                    'id' => $last->id,
                    'change' => $last->change,
                    'type' => $last->type,
                    'created_at' => $last->created_at
                ] : null
            ];
        });

        return response()->json($data);
    }

    /**
     * Render a simple admin view showing low-stock variants and a small adjust form.
     */
    public function lowStockView(Request $request)
    {
        $variants = ProductFamilyAttribute::where('alert_qty', '>', 0)
            ->whereColumn('qty', '<=', 'alert_qty')
            ->with('product')
            ->get();

        return view('admin.stock.low_stock', ['variants' => $variants]);
    }

    /**
     * Return the latest stock transaction (optionally filtered by variant_id)
     * GET /stock/transactions/latest?variant_id=...
     */
    public function lastTransaction(Request $request)
    {
        // Order by id so the most recently created record (by insert) is returned.
        $query = StockTransaction::with('variant')->orderBy('id', 'desc');

        if ($request->has('variant_id')) {
            $query->where('product_family_attribute_id', $request->variant_id);
        }

        $transaction = $query->first();

        if (!$transaction) {
            return response()->json(['message' => 'No transactions found'], 404);
        }

        return response()->json($transaction);
    }
}
