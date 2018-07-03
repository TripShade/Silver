<?php

namespace Admin\{{moduleName}}\Controllers;

use Illuminate\Http\Request;
use Admin\{{moduleName}}\Models\{{modelName}};
use Admin\{{moduleName}}\Requests\{{modelName}}Request;
use Admin\{{moduleName}}\Datatables\{{modelName}}Datatable;
use Admin\Core\Controllers\AdminBaseController;

class {{modelName}}Controller extends AdminBaseController {

	/**
	 * {{modelName}} Model
	 * @var {{modelNamePlural}}
	 */
	protected ${{modelNamePluralLowerCase}};
	/**
	 * Create a new {{modelName}}Controller instance
	 * @param {{modelName}} ${{modelNamePluralLowerCase}}
	 */
	public function __construct({{modelName}} ${{modelNamePluralLowerCase}})
	{
		parent::__construct();

		$this->{{modelNamePluralLowerCase}} = ${{modelNamePluralLowerCase}};

		view()->share('activeNav', 'admin.{{modelNamePluralLowerCase}}.index');
		view()->share('activeSubNav', 'admin.{{modelNamePluralLowerCase}}.index');
	}

	/**
	 * Display a listing of the resource.
	 * @return Response
	 */
	public function index()
	{
		${{modelNamePluralLowerCase}} = $this->{{modelNamePluralLowerCase}}->get();

		return view('admin.{{modelNamePluralLowerCase}}.index', compact('{{modelNamePluralLowerCase}}'));
	}

	/**
     * Return data for the resource listing.
     * @return JSON
     */
    public function data({{modelName}}Datatable $datatable)
    {
        return $datatable->make();
    }

	/**
	 * Show the form for creating a new resource.
	 * @return Response
	 */
	public function create()
	{
		return view('admin.{{modelNamePluralLowerCase}}.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * @return Response
	 */
	public function store({{modelName}}Request $request)
	{
		${{modelNameLowerCase}} = $this->{{modelNamePluralLowerCase}}->create( $request->all() );

		$request->session()->flash('success', "Nieuw {{modelNameLowerCase}} is opgeslagen.");

		return $request->ajax() ?
			['success' => true, 'refresh' => true] :
			redirect()->route('admin.{{modelNamePluralLowerCase}}.index');
	}

	/**
	 * Display the specified resource.
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return $this->{{modelNamePluralLowerCase}}->find($id);
	}

	/**
	 * Show the form for editing the specified resource.
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		${{modelNameLowerCase}} = $this->{{modelNamePluralLowerCase}}->find($id);

		return view('admin.{{modelNamePluralLowerCase}}.edit', compact('{{modelNameLowerCase}}'));
	}

	/**
	 * Update the specified resource in storage.
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, {{modelName}}Request $request)
	{
		${{modelNameLowerCase}} = $this->{{modelNamePluralLowerCase}}->findOrFail($id);

		${{modelNameLowerCase}}->update( $request->all() );

		$request->session()->flash('success', "{{modelNameLowerCase}} is aangepast.");

		return $request->ajax() ?
			['success' => true, 'refresh' => true] :
			redirect()->route('admin.{{modelNamePluralLowerCase}}.index');
	}

	/**
	 * Remove the specified resource from storage.
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		${{modelNameLowerCase}} = $this->{{modelNamePluralLowerCase}}->findOrFail($id);

		${{modelNameLowerCase}}->delete();

		return redirect()->route('admin.{{modelNamePluralLowerCase}}.index')->withSuccess("{{modelNameLowerCase}} is verwijderd.");
	}
}