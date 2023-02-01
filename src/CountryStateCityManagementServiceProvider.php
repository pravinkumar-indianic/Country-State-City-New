<?php

namespace Indianic\CountryStateCityManagement;

use Laravel\Nova\Nova;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Events\ServingNova;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Artisan;
use Indianic\CountryStateCityManagement\Nova\Resources\City;
use Indianic\CountryStateCityManagement\Nova\Resources\State;
use Indianic\CountryStateCityManagement\Nova\Resources\Country;
use Indianic\CountryStateCityManagement\Policies\CountryStateCityManagementPolicy;
use Illuminate\Support\Facades\Schema;

class CountryStateCityManagementServiceProvider extends ServiceProvider {

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {

//         $this->setModulePermissions();
//        Gate::policy(\Indianic\CountryStateCityManagement\Models\Country::class, CountryStateCityManagementPolicy::class);



        Nova::serving(function (ServingNova $event) {

            Nova::resources([
                Country::class,
                State::class,
                City::class,
            ]);
        });

        if (!Schema::hasTable('countries') && !Schema::hasTable('states') && !Schema::hasTable('cities')) {
            if ($this->app->runningInConsole()) {
                $this->loadMigrationsFrom(base_path('vendor/indianic/country-state-city-management-new/src/Database/migrations'));
                $path = 'vendor/indianic/country-state-city-management-new/src/Database';
                $migrationPath = $path . "/migrations";
                if (is_dir($migrationPath)) {
                    foreach (array_diff(scandir($migrationPath, SCANDIR_SORT_NONE), [".", ".."]) as $migration) {
                        Artisan::call('migrate', [
                            '--path' => $migrationPath . "/" . $migration
                        ]);
                    }
                }
            }
        }
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        //
    }

    private function setModulePermissions() {
        $existingPermissions = config('nova-permissions.permissions');

        $existingPermissions['view country-management'] = [
            'display_name' => 'View country management',
            'description' => 'Can view country management',
            'group' => 'country management'
        ];

        // $existingPermissions['create country-management'] = [
        //     'display_name' => 'Create country management',
        //     'description'  => 'Can create country management',
        //     'group'        => 'country management'
        // ];

        $existingPermissions['update country-management'] = [
            'display_name' => 'Update country management',
            'description' => 'Can update country management',
            'group' => 'country management'
        ];

        // $existingPermissions['delete country-management'] = [
        //     'display_name' => 'Delete country management',
        //     'description'  => 'Can delete country management',
        //     'group'        => 'country management'
        // ];

        \Config::set('nova-permissions.permissions', $existingPermissions);
    }

}
