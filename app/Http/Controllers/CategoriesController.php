<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreCategory;
use App\Http\Requests\UpdateCategory;
use App\Models\Category;
use App\Models\Tag;
use Auth;

class CategoriesController extends Controller
{
  /**
  * Create a new controller instance.
  *
  * @return void
  */
  public function _construct() {
    $this->middleware('auth');
  }

  /**
  * Show the categories main page.
  *
  * @param Illuminate\Http\Request
  * @return \Illuminate\Http\Response
  */
  public function index(Request $request)
  {
    return view('categories.index');
  }

  /**
  * Show the page to create a new category
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    return view('categories.new');
  }

  /**
  * Store a new category.
  *
  * @param  App\Http\Requests\StoreCategory;
  * @return \Illuminate\Http\Response
  */
  public function store(StoreCategory $request) {
    // Create the category model
    $category = Category::create([
      'name'          => $request->input('name'),
      'description'   => $request->input('description'),
      'user_id'       => Auth::id(),
    ]);

    // Attach the tag to the category
    $category->attachTag($request->input('tagData'));

    return redirect()->route('categories.index');
  }

  /**
  * Show a specified category.
  *
  * @return \Illuminate\Http\Response
  */
  public function show() {
    return view('categories.view');
  }

  /**
  * Show the edit page of a specified category
  *
  * @return \Illuminate\Http\Response
  */
  public function edit() {
    return view('categories.edit');
  }

  /**
  *
  * @return \Illuminate\Http\Response
  */
  public function update(UpdateCategory $request, $categoryId) {
    // Update the category and save
    $category = Category::find($categoryId);
    $category->name = $request->input('name');
    $category->description = $request->input('description');
    $category->attachTag($request->input('tagData'));
    $category->save();
    $request->session()->flash('success', 'Category updated successfully!');
    return redirect()->route('categories.edit', $category->id);
  }
}
