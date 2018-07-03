<?php

namespace Admin\{{moduleName}}\Providers;

use Illuminate\Support\Facades\Route;
use Admin\Core\Providers\ModuleServiceProvider;

class {{moduleName}}ModuleProvider extends ModuleServiceProvider {

	/**
	 * Bootstrap the application events.
	 * @return void
	 */
	public function boot()
	{
		// load module routes
		$this->mapWebRoutes();
		$this->mapApiRoutes();
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		// $this->app->bind('Admin\Things\Repositories\CourseRepo', 'Admin\Things\Repositories\CuteCourseRepo');
	}

	private function mapWebRoutes()
	{
		Route::prefix(config('admin.prefix', 'admin'))
			->middleware(['admin', 'auth.admin'])
			->group(__DIR__ .'/../routes/admin.php');
	}

	private function mapApiRoutes()
	{
		Route::prefix('api')
			->middleware('api')
			->group(__DIR__ .'/../routes/api.php');
	}

}