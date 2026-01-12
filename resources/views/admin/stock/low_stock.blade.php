@extends('admin.layouts.master')

@section('content')
<div class="container">
    <h2>Low Stock Items</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Variant ID</th>
                <th>Product</th>
                <th>Qty</th>
                <th>Alert Qty</th>
                <th>Adjust</th>
            </tr>
        </thead>
        <tbody>
            @foreach($variants as $v)
            <tr id="variant-{{ $v->id }}">
                <td>{{ $v->id }}</td>
                <td>{{ $v->product->name ?? '—' }}</td>
                <td class="qty">{{ $v->qty }}</td>
                <td>{{ $v->alert_qty }}</td>
                <td>
                    <input type="number" min="-99999" id="change-{{ $v->id }}" value="0" />
                    <button class="btn btn-sm btn-primary" onclick="adjust({{ $v->id }})">Apply</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
function adjust(variantId) {
    const change = document.getElementById('change-' + variantId).value;
    fetch('/stock/adjust', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ variant_id: variantId, change: parseInt(change, 10) })
    }).then(r => r.json()).then(resp => {
        if (resp.success) {
            const row = document.getElementById('variant-' + variantId);
            row.querySelector('.qty').innerText = resp.variant.qty;
            alert('Stock adjusted');
        } else {
            alert(resp.error || 'Error');
        }
    }).catch(e => alert('Error'));
}
</script>
@endsection
