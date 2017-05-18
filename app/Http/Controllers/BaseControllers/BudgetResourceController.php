<?php

namespace App\Http\Controllers\BaseControllers;

use Validator;
use Illuminate\Http\Request;

abstract class BudgetResourceController extends Controller
{
    /**
     *
     * @var
     */
    protected $model;

    /**
     * Show the resource main page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view($this->getFullRouteName('index'));
    }

    /**
     * Show the page to create a new resource
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view($this->getFullRouteName('new'));
    }

   /**
    * Store a new instance of the resource.
    *
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
     * Show a specified resource page
     *
     * @return \Illuminate\Http\Response
     */
    public function show() {
        return view($this->getFullRouteName('view'));
    }

    /**
     * Show the edit page of a specified resource
     *
     * @return \Illuminate\Http\Response
     */
    public function edit() {
        return view($this->getFullRouteName('edit'));
    }

    /**
     * Update the details of a specified resource.
     *
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
     * Delete a specified resource
     *
     * @param  App\Models\Income
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id = null)
    {
        // Get the income ids to be deleted
        $ids = $request->input('ids', $id);
        // Delete the selected income
        $this->model->discard((array) $ids);
        // Flash the success message
        $request->session()->flash('success', 'Deleted '.$this->resourceName());
        // Redirect to the correct route
        return $this->redirectToSubRoute('index');
    }

    /**
     * The name of the resource handled by the controller
     *
     * @return string
     */
    abstract protected function resourceName();

    /**
     * Builds the full route name that will be used
     * in redirection.
     *
     * @param string  $subroute
     * @return string
     */
    protected function getFullRouteName($subroute)
    {
        $resource_name = $this->resourceName();
        return "{$resource_name}.{$subroute}";
    }

    /**
     * Returns a structured route name based on the user and resource types.
     *
     * @param  string  $subroute
     * @param  int  $id
     * @return \Illuminate\Routing\Redirector
     */
    protected function redirectToSubRoute($subroute = null, $id = null)
    {
        if (!$subroute) {
            return back();
        } else if (!$id) {
            return redirect()->route($this->getFullRouteName($subroute));
        }
        return redirect()->route($this->getFullRouteName($subroute), $id);
    }

    /**
     *
     *
     */
    protected function validateInput(Request $request)
    {
        $validator = Validator::make(
                    $request->all(),
                    $this->model->rules,
                    $this->model->messages
                );

        $validator->after(function ($validator) use ($request) {
            if (!$this->categoryExists($request)) {
              $validator->errors()
                        ->add('errors', 'Please select a valid category from the list');
            }
        });

        return $validator;
    }
}
