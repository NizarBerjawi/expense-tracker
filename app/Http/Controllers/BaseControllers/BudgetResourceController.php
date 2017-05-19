<?php

namespace App\Http\Controllers\BaseControllers;

use App\Controllers\Traits\ValidatesCategory;
use Illuminate\Http\Request;

abstract class BudgetResourceController extends Controller
{
    use ValidatesCategory;

    /**
     * An instance of the model. This can either be
     * an expense, income, or category model.
     *
     * @var Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * Show the resource main index page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view($this->getFullRouteName('index'));
    }

    /**
     * Show the page to create a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->getFullRouteName('new'));
    }

   /**
    * Store a new instance of the resource.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        // Validate input
        $validator = $this->validateInput($request);
        // Return any error messages with the old input
        if ($validator->fails()) {
            return $this->redirectToSubRoute()
                        ->withErrors($validator)
                        ->withInput();
        }
        // If all is good, add the user ID to the request
        $request->merge(['user_id' => $request->user()->id]);
        // Store the new model
        $this->model->create($request->all());
        // Flash the success message
        $request->session()->flash('success', 'Saved '.$this->resourceName());
        // Redirect to the correct route
        return $this->redirectToSubRoute('index');
    }

    /**
     * Show a specific resource details.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view($this->getFullRouteName('view'));
    }

    /**
     * Show the edit page of a specific resource
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view($this->getFullRouteName('edit'));
    }

    /**
     * Update the details of a specific resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate input
        $validator = $this->validateInput($request);
        // Return any error messages with the old input
        if ($validator->fails()) {
            return $this->redirectToSubRoute()
                        ->withErrors($validator)
                        ->withInput();
        }
        // If all is good, add the user ID to the request
        $request->merge(['user_id' => $request->user()->id]);
        // Update the resource
        $this->model->where('id', $id)
                    ->update($request->except(['_token', '_method']));
        // Flash the success message
        $request->session()->flash('success', 'Updated '.$this->resourceName());
        // Redirect to the correct route
        return $this->redirectToSubRoute('edit', $id);
    }

    /**
     * Delete a specific resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id = null)
    {
        // Get the ids of the resource(s) to be deleted
        $ids = $request->input('ids', $id);
        // Delete the selected resources
        $this->model->discard((array) $ids);
        // Flash the success message
        $request->session()->flash('success', 'Deleted '.$this->resourceName());
        // Redirect to the correct route
        return $this->redirectToSubRoute('index');
    }

    /**
     * The name of the resource "controlled" by the controller
     *
     * @return string
     */
    abstract protected function resourceName();

    /**
     * Builds the full route name that will be used in redirection.
     *
     * @param  string  $subroute
     * @return string
     */
    protected function getFullRouteName($subroute)
    {
        $resource_name = $this->resourceName();
        return "{$resource_name}.{$subroute}";
    }

    /**
     * Returns a redirect based on a specified subroute.
     *
     * @param  string  $subroute
     * @param  int  $id
     * @return \Illuminate\Routing\Redirector
     */
    protected function redirectToSubRoute($subroute = null, $routeParameter = null)
    {
        // If no subroute is provided
        if (!$subroute) { return back(); }
        // If no route parameter is provided
        if (!$routeParameter) {
            return redirect()->route($this->getFullRouteName($subroute));
        }
        // If a route parameter is provided
        return redirect()->route($this->getFullRouteName($subroute), $routeParameter);
    }
}
