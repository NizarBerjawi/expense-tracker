<?php

namespace App\Http\Controllers\BaseControllers;

use Illuminate\Validation\Validator;
use App\Http\Requests\BaseRequests\BaseRequest;
use Illuminate\Http\Request;

abstract class BudgetBaseController extends Controller
{
    /**
     * An instance of the model. This can either be
     * an expense, income, or category model.
     *
     * @var Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * The name of the resource "controlled" by the controller
     *
     * @return string
     */
    abstract protected function resourceName() : string;

    /**
     * The role of the user using the controller
     *
     * @return string
     */
    abstract protected function userRole() : string;

    /**
     * Validates the input for any store or update action
     * related to the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Validation\Validator
     */
    abstract protected function validateInput(Request $request) : Validator;

    /**
     * Builds the full route name that will be used in redirection.
     *
     * @param  string $subroute
     * @return string
     */
    private function getFullRouteName($subroute) : string
    {
        // Get the user role
        $userRole = $this->userRole();
        // Get the resource name
        $resourceName = $this->resourceName();
        // Build the full route name
        return "{$userRole}.{$resourceName}.{$subroute}";
    }

    /**
     * Returns a redirect based on a specified subroute.
     *
     * @param  string $subroute
     * @param  int $id
     * @return \Illuminate\Routing\Redirector
     */
    private function redirectToSubRoute($subroute = null, $routeParameter = null)
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

    /**
     * Show the resource main index page.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Send the table sort criteria to the view
        return view($this->getFullRouteName('index'))
                    ->with('dir', $request->dir)
                    ->with('col', $request->col);
    }

    /**
     * Show the page to create a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->getFullRouteName('create'));
    }

   /**
    * Store a new instance of the resource.
    *
    * @param  \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        // Validate the user input
        $validator = $this->validateInput($request);
        // Return any error messages and the old input
        if ($validator->fails()) {
            return $this->redirectToSubRoute()
                        ->withErrors($validator)
                        ->withInput();
        }
        // If all is good, add the user ID to the request
        $request->merge(['user_id' => $request->user()->id]);
        // Store the new model
        $item = $this->model->create($request->all());
        // Flash the success message
        $request->session()->flash('success', 'Successfully saved');
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
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
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
        $request->session()->flash('success', 'Successfully updated');
        // Redirect to the correct route
        return $this->redirectToSubRoute('edit', $id);
    }

    /**
     * Delete a specific resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id = null)
    {
        // Delete the selected resources
        $this->model->discard((array) $id);
        // Flash the success message
        $request->session()->flash('success', 'Successfully deleted');
        // Redirect to the correct route
        return $this->redirectToSubRoute('index');
    }
}
