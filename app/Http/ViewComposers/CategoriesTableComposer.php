<?php

namespace App\Http\ViewComposers;

use App\Http\ViewComposers\BaseComposers\TableBaseComposer;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoriesTableComposer extends TableBaseComposer
{
    /**
     * Create a new view composer instance.
     *
     * @param  Illuminate\Http\Request $request
     */
    public function __construct(Request $request, Category $category)
    {
        $this->currentPage = $request->page;
        $this->dir = $request->dir;
        $this->col = $request->col;
        $this->model = $category;
    }

    /**
     * The name of the resource being queried
     *
     * @return string
     */
    protected function resourceName() : string
    {
        return 'categories';
    }

    /**
     * The name of the relationship being returned with the
     * main resource. For example, a tag is queried with category.
     *
     * @return string
     */
    protected function with() : string
    {
        return 'tag';
    }
}
