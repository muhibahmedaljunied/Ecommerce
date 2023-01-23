<?php

namespace App\Http\Controllers;

use App\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
                // $this->middleware('Admin');
        
    }
    public function index(Request $request)
    {      
        // $category = Category::all();
        return response()->json(Category::all());  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $category = Category::find($id);
        return response()->json('asd');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $file = $request->file('image');
        $upload_path = public_path('assets/upload');
        $file_name = $file->getClientOriginalName();
        $generated_new_name = time() . '.' . $file->getClientOriginalExtension();
        $file->move($upload_path, $generated_new_name);

        $category = new Category();
        $category->name = $request->post('name');
        $category->status = $request->post('status');
        $category->image = $file_name;
        $category->save();
        return response()->json($request->file('image'));
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(category $category)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   

        $category = Category::find($id);
        return response()->json($category);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
        $request->validate([
            'name' => 'required|unique:categories|max:255',
            'status' => '',
        ]);
        $category = Category::find($request->id);
        $category->update($request->post());
        return response()->json($request);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Category = Category::find($id);

        $Category->delete();

        return response()->json('successfully deleted');
    }
}
