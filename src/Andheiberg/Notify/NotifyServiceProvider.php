<?php namespace Andheiberg\Notify;

use Illuminate\Support\ServiceProvider;

class NotifyServiceProvider extends ServiceProvider {

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->package('andheiberg/notify', 'notify');

		// Register 'asset' instance container to our Asset object
		$this->app['notify'] = $this->app->share(function($app)
		{
			return new Notify($app['session.store'], $app['config']);
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
