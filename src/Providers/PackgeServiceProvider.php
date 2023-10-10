<?php

namespace Roghumi\Press\packagename\Providers;

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
          __DIR__ . '/../../config/press/pacakgename.php' => config_path('press/pacakgename.php'),
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
