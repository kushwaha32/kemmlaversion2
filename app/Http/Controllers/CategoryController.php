<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(3);
        return view('admin.category.index', compact('categories'));
    }

    public function trash(){
        $categories = Category::onlyTrashed()->paginate(5);
        return view('admin.category.index', compact('categories'));
    }
    
    public function recovercat($id){
        $category = Category::onlyTrashed()->findOrFail($id);
        if($category->restore()){
            return back()->with('message', 'Category successfully restored!');
        }else{
            return back()->with('message', 'Failed to restore category');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
              'title' => 'required|min:5',
              'slug'  => 'required|min:5|unique:categories'
        ]);

        $categories = Category::create($request->only('title', 'description', 'slug'));
        $categories->childrens()->attach($request->parent_id);
        return back()->with('message', 'Category added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $categories = category::where('id', '!=', $category->id)->get();
        return view('admin.category.create', ['categories' => $categories,
        'category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $category->title = $request->title;
        $category->description = $request->description;
        $category->slug = $request->slug;
        //save current record into the database
        $saved = $category->save();
        //detach all parent categories
        //dd($saved->childrens());
        //$saved->childrens()->detach();
        $category->childrens()->detach();
        //attach selected parent categories
        $category->childrens()->attach($request->parent_id);
        //return back to the edit form
        return back()->with('message', 'Record updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        
        if($category->childrens()->detach() && $category->forceDelete()){
            return response()->json(['status'=>'Service category deleted successfully']);
        }else{
            return response()->json(['status'=>'Error deleting record']);
        }
      
        
    }
    public function remove(Category $category){
        
        if($category->delete()){
            return back()->with('message', 'Category successfully trashed');
        }else{
            return back()->with('message', 'Error deleting record');
        }
    }
}
