<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreCategory;
use App\Http\Requests\UpdateCategory;
use App\Models\Category;
use App\Models\Tag;

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
        // Send all the tags to the view to allow user to select
        return view('categories.new')->with('tags', Tag::all());
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
        ]);

        // Attach the tag to the category
        $category->attachTag($request->input('tagData'));

        return redirect()->route('categories.index');
    }

    /**
     * Show a specified category.
     *
     * @param  App\Models\Category;
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category) {
        return view('categories.view')
                    ->with(compact('category'));
    }

    /**
     * Show the edit page of a specified category
     *
     * @param  App\Models\Category;
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category) {
        return view('categories.edit')
                    ->with('category', $category)
                    ->with('tags', Tag::all());
    }

    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategory $request, Category $category) {
        // Update the category and save
        $category->name = $request->input('name');
        $category->description = $request->input('description');
        $category->attachTag($request->input('tagData'));

        /// Save the new category details
        $category->save();

        return redirect()->route('categories.show', $category->id);
    }
}
