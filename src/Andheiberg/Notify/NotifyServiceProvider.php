<?php namespace Andheiberg\Notify;

use Illuminate\Support\ServiceProvider;

class NotifyServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->publishes([
			__DIR__.'/../../config/notify.php' => config_path('notify.php'),
		]);

		$this->mergeConfigFrom(
			__DIR__.'/../../config/notify.php', 'notify'
		);
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind('notify', function($app) {
			return new Notify($app['session.store'], $app['config'], $app['translator']);
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('notify');
	}

}
