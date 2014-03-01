<?php namespace Hettiger\SeoAggregator\Providers;

use \App;
use \Config;
use \Hettiger\SeoAggregator\Robots;
use \Hettiger\SeoAggregator\Sitemap;
use \Hettiger\SeoAggregator\Support\Helpers;
use \Illuminate\Support\ServiceProvider;

class SeoAggregatorServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('hettiger/seo-aggregator', null, __DIR__ . '/../../../../src');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
        App::bind('sitemap', function()
        {
            $protocol = Config::get('seo-aggregator::protocol');
            $host = Config::get('seo-aggregator::host');

            return new Sitemap(new Helpers, $protocol, $host);
        });

        App::bind('robots', function()
        {
            $protocol = Config::get('seo-aggregator::protocol');
            $host = Config::get('seo-aggregator::host');

            return new Robots(new Helpers, $protocol, $host);
        });
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('sitemap', 'robots');
	}

}
