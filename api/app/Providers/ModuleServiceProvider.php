<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider {

        protected $files;
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
            $modules = (config("module.list")) ?: array_map('class_basename', $this->files->directories(app_path().'/Modules/'));
            $modulePath =   app_path() . DIRECTORY_SEPARATOR . 'Modules' . DIRECTORY_SEPARATOR;    
            foreach ($modules as $module) {
                $moduleNamespace = 'App'. DIRECTORY_SEPARATOR . 'Modules' . DIRECTORY_SEPARATOR . $module . DIRECTORY_SEPARATOR;
                $routes = $modulePath . $module . DIRECTORY_SEPARATOR . 'routes.php';
                $views  = $modulePath . $module . DIRECTORY_SEPARATOR . 'Views'. DIRECTORY_SEPARATOR ;   
                if (file_exists($routes)) {
                    require ($routes);
                }
                if (is_dir($views)) {
                    $this->loadViewsFrom($views, $moduleNamespace);
                }
            }
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
            $this->files = new \Illuminate\Filesystem\Filesystem();
	}

}
