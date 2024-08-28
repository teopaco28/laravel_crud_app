<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteMacroServiceProvider extends ServiceProvider
{
    public function boot()
    {
      
        Route::macro('softDeletes', function ($name, $controller) {
            Route::get("$name/trashed", [$controller, 'trashed'])->name("$name.trashed");
            Route::patch("$name/{user}/restore", [$controller, 'restore'])->name("$name.restore");
            Route::delete("$name/{user}/delete", [$controller, 'delete'])->name("$name.delete");
        });
    }
}
