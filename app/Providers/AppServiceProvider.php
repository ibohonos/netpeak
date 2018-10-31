<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Journal;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		Journal::deleting(function ($journal) {
			$journal->authors()->detach();
		});
	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}
}
