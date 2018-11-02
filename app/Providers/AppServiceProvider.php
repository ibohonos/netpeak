<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Journal;
use App\Author;

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

		Author::deleting(function ($author)) {
			$author->journals()->detach();
		}
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
