<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreCategory;
use App\Http\Requests\UpdateCategory;
use App\Http\Requests\DeleteCategory;
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
        // Get an instance of the user making the request
        $user = $request->user();
        // Create the category
        $user->categories()->create($request->all());
        // Flash the success message
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
        // Get an instance of the user making the request
        $user = $request->user();
        // Update the category
        $user->categories()
             ->where('id', $categoryId)
             ->update($request->except(['_token', '_method']));
        // Flash the success message
        $request->session()->flash('success', 'Category updated successfully!');
        return redirect()->route('categories.edit', $categoryId);
    }

    /**
     * Delete a specified category
     *
     * @param App\Models\Category
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteCategory $request, $categoryId = null)
    {
        if (!$request->exists('category_ids') && !$categoryId) { return back(); }
        // Get the category ids to be deleted
        $categoryIds = $request->input('category_ids', $categoryId);
        // Delete the selected categories
        Category::discard((array) $categoryIds);
        // Flash the success message
        $request->session()->flash('success', 'Categories deleted successfully!');
        return redirect()->route('categories.index');
    }
}
