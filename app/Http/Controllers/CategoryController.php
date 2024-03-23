<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    //index
    public function index()
    {
        $categories = Category::paginate(10);
        return view('pages.categories.index', compact('categories'));
    }

    // create
    public function create()
    {
        return view('pages.categories.create');
    }

    // store
    public function store(Request $request)
    {
        // validate the request..
        $request->validate([
            'name'=>'required',
            'image'=> 'required|image|mimes:jpge,png,jpg,gif,svg|max:2048',
        ]);
        // store the request..
        $category = new Category;
        $category->name =$request->name;
        $category->description = $request->description;


        // save image
        if($request->hasFile('image')){
            $image = $request->file('image');
            $image->storeAs('public/categories', $category->id .'.'. $image->getClientOriginalExtension());
            $category->image = 'storage/categories/' . $category->id . '.' . $image->getClientOriginalExtension();
            $category->save();
        }
        return redirect()->route('categories.index')->with('success', 'Product update successfully');
    }

    // show
    public function show($id)
    {
        return view('pages.categories.show');
    }
    // edit
    public function edit($id)
    {
        $category = Category::find($id);
        return view('pages.categories.edit', compact('category'));
    }

    // update
    public function update(Request $request, $id)
    {
    // validate the request..
    $request->validate([
        'name'=>'required',
        'image'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // update the request..
    $category = Category::find($id);
    $category->name = $request->name;
    $category->description = $request->description;

    // save image
    if($request->hasFile('image')) {
        $image = $request->file('image');
        $image->storeAs('public/categories', $categoriex->id .'.'. $image->getClientOriginalExtesion());
        $product->image = 'storage/categories/' . $product->id . '.' . $image->getClientOriginalExtension();
        $product->save();
    }
    return redirect()->route('categories.index')->with('success', 'Product update successfully');
    }

    // destroy
    public function destroy($id)
    {
        // delete the reques..
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('categories.index')->with('success','Category delete successfully');
    }
}
