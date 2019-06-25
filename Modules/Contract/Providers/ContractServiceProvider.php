<?php

namespace Modules\Contract\Providers;

use Modules\Support\Traits\AddsAsset;
use Illuminate\Support\ServiceProvider;
use Modules\Support\Traits\LoadsConfig;


class ContractServiceProvider extends ServiceProvider
{
    use AddsAsset, LoadsConfig;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
//        $this->addAdminAssets('admin.contracts.index', ['admin.contract.css', 'admin.jstree.js', 'admin.contract.js']);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->loadConfigs('permissions.php');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }
}
