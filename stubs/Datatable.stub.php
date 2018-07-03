<?php

namespace Admin\{{moduleName}}\Datatables;

use Yajra\Datatables\Datatables;
use Admin\{{moduleName}}\Models\{{modelName}};


class {{modelName}}Datatable
{
    /**
     * Return data request
     * @return json
     */
    public function make()
    {
        ${{modelNamePluralLowerCase}} = {{modelName}}::select();

        return Datatables::of(${{modelNamePluralLowerCase}})
    	    ->addColumn('action', function (${{modelNameLowerCase}}) {
                return view('admin.{{modelNamePluralLowerCase}}.partials.datatable_actions', [
                    'subject' => '{{modelNameLowerCase}}',
                    // 'show' => route('admin.{{modelNamePluralLowerCase}}.subthingy.index', ${{modelNameLowerCase}}->id),
                    'edit' => route('admin.{{modelNamePluralLowerCase}}.edit', ${{modelNameLowerCase}}->id),
                    'delete' => route('admin.{{modelNamePluralLowerCase}}.destroy', ${{modelNameLowerCase}}->id)
                ])->render();
            })
            ->make(true);
    }

}