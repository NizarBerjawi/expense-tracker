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
  public function _construct()
  {
    $this->middleware('auth');
  }

  /**
   * Show the categories main page.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
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
   * @param  App\Http\Requests\StoreCategory
   * @return \Illuminate\Http\Response
   */
  public function store(StoreCategory $request)
  {
    // Create the category model
    $category = Category::create([
      'name'          => $request->input('name'),
      'description'   => $request->input('description'),
      'user_id'       => Auth::id(),
    ]);
    // Attach the tag to the category
    $category->attachTag($request->input('tagData'));
    $request->session()->flash('success', 'Category created successfully!');
    return redirect()->route('categories.index');
  }

  /**
   * Show a specified category.
   *
   * @return \Illuminate\Http\Response
   */
  public function show()
  {
    return view('categories.view');
  }

  /**
   * Show the edit page of a specified category
   *
   * @return \Illuminate\Http\Response
   */
  public function edit()
  {
    return view('categories.edit');
  }

  /**
   * Update the details of a specified category.
   *
   * @param  App\Http\Requests\UpdateCategory  $request
   * @param  int  $categoryId
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateCategory $request, $categoryId)
  {
    // Update the category and save
    $category = Category::find($categoryId);
    $category->name = $request->input('name');
    $category->description = $request->input('description');
    $category->attachTag($request->input('tagData'));
    $category->save();
    $request->session()->flash('success', 'Category updated successfully!');
    return redirect()->route('categories.edit', $categoryId);
  }

  /**
   * Delete a specified category
   *
   * @param App\Models\Category
   * @return \Illuminate\Http\Response
   */
  public function destroy(Request $request)
  {
    // Delete the selected categories
    Category::discard($request->input('categoryIds'));
    $request->session()->flash('success', 'Category deleted successfully!');
    return redirect()->route('categories.index');
  }
}
