<?php

namespace Roghumi\Press\LaraPressPackage\Providers;

use Illuminate\Support\ServiceProvider;
use Roghumi\Press\Crud\Helpers\MigrationPublishTrait;

class PackageServiceProvider extends ServiceProvider
{
  use MigrationPublishTrait;

  public function register()
  {
  }

  public function boot()
  {
    $this->mergeConfigFrom(__DIR__ . '/../../config/press/packagename.php', 'press.packagename');
    $this->loadRoutesFrom(__DIR__ . '/../../routes/packagename.php');
    $this->loadTranslationsFrom(__DIR__ . '/../../lang/', 'packagename.packagename');

    if ($this->app->runningInConsole()) {
      $this->publishes([
          __DIR__ . '/../../config/press/packagename.php' => config_path('press/packagename.php'),
      ], 'config');

      $this->publishMigrations(__DIR__ . '/../../database/migrations');
      if ($this->app->runningUnitTests()) {
          $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
      }

      $this->commands([
      ]);
  }
  }
}
