<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use File;

class ModuleGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:generator {module} {model}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates module CRUD and base setup';

    protected $model;
    protected $module;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->model = $this->argument('model');
        $this->module = $this->argument('module');

        $this->model();
        $this->controller();
        $this->datatable();
        $this->request();
        $this->moduleprovider();
        $this->adminRoutes();
        $this->views();
        $this->info("Module ". $this->module . " finished");
    }

    protected function getStub($type)
    {
        return file_get_contents(resource_path("stubs/$type.stub.php"));
    }

    protected function render($stub, $tree = '')
    {
        $viewTemplate = str_replace(
            [
                '{{moduleName}}',
                '{{modelName}}',
                '{{modelNamePlural}}',
                '{{modelNamePluralLowerCase}}',
                '{{modelNameLowerCase}}'
            ],
            [
                $this->module,
                $this->model,
                str_plural($this->model),
                strtolower(str_plural($this->model)),
                strtolower($this->model)
            ],
            $this->getStub($tree . $value)
        );

        return $viewTemplate;
    }

    protected function model()
    {
        $modelTemplate = $this->render('Model');

        if(!file_exists($path = base_path("admin/" . $this->module . '/Models')))
            mkdir($path, 0777, true);

        file_put_contents(base_path("admin/" . $this->module . "/Models/{$this->model}.php"), $modelTemplate);
        $this->info("created " .base_path("admin/" . $this->module . "/Models/".$this->model.".php"));
    }

    protected function controller()
    {
        $controllerTemplate = $this->render('Controller');

        if(!file_exists($path = base_path("admin/" . $this->module . '/Controllers')))
            mkdir($path, 0777, true);

        file_put_contents(base_path("admin/" . $this->module . "/Controllers/{$this->model}Controller.php"), $controllerTemplate);
        $this->info("created " .base_path("admin/" . $this->module . "/Controllers/".$this->model."Controller.php"));
    }

    protected function request()
    {
        $requestTemplate = $this->render('Request');

        if(!file_exists($path = base_path("admin/" . $this->module . '/Requests')))
            mkdir($path, 0777, true);

        file_put_contents(base_path("admin/" . $this->module . "/Requests/{$this->model}Request.php"), $requestTemplate);
        $this->info("created " .base_path("admin/" . $this->module . "/Requests/".$this->model."Request.php"));
    }

    protected function datatable()
    {
        $datatableTemplate = $this->render('Datatable');

        if(!file_exists($path = base_path("admin/" . $this->module . '/Datatables')))
            mkdir($path, 0777, true);

        file_put_contents(base_path("admin/" . $this->module . "/Datatables/{$this->model}Datatable.php"), $datatableTemplate);
        $this->info("created " .base_path("admin/" . $this->module . "/Datatables/".$this->model."Datatable.php"));
    }

    protected function moduleprovider()
    {
        $moduleproviderTemplate = $this->render('ModuleProvider');

        if(!file_exists($path = base_path("admin/" . $this->module . '/Providers')))
            mkdir($path, 0777, true);

        file_put_contents(base_path("admin/" . $this->module . "/Providers/{$this->module}ModuleProvider.php"), $moduleproviderTemplate);
        $this->info("created " .base_path("admin/" . $this->module . "/Providers/".$this->module."ModuleProvider.php"));
    }

    protected function adminRoutes()
    {
        if(!file_exists($path = base_path("admin/" . $this->module . '/routes/admin.php'))){
            mkdir(base_path("admin/" . $this->module . '/routes'), 0777, true);
            File::put($path, '<?php' . PHP_EOL . PHP_EOL);
        }

        File::append($path, 'Route::get(\'' . str_plural(strtolower($this->model)) . "/data', ['as' => 'admin." . str_plural(strtolower($this->model)) . ".data', 'uses' => 'Admin\\" . $this->module ."\Controllers\\". $this->model ."Controller@data']);" . PHP_EOL);

        File::append($path, 'Route::resource(\'' . str_plural(strtolower($this->model)) . "', 'Admin\\". $this->module ."\Controllers\\". $this->model . "Controller', ['as' => 'admin']);" . PHP_EOL . PHP_EOL);

        $this->info("added new routes");
    }

    protected function views()
    {
        $crudViews = ['index', 'edit', 'create'];

        foreach ($crudViews as $key => $value) {
            $viewTemplate = $this->render($value, 'view.');

            if(!file_exists($path = base_path("resources/views/admin/" . str_plural($this->model))))
                mkdir($path, 0777, true);

            file_put_contents($path . "/" . $value . ".blade.php", $viewTemplate);
            $this->info("created " . $path . "/" . $value . ".blade.php");
        }

        if(!file_exists($path = base_path("resources/views/admin/" . str_plural($this->model) . "/partials")))
                mkdir($path, 0777, true);

        file_put_contents($path . "/datatable_actions.blade.php", $this->getStub('view.datatable_actions'));
        $this->info("created " . $path . "/datatable_actions.blade.php");

        file_put_contents($path . "/fields.blade.php", $this->getStub('view.fields'));
        $this->info("created " . $path . "/fields.blade.php");
    }
}
