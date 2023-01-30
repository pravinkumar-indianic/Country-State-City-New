<?php

namespace Indianic\CountryStateCityManagement;

use Laravel\Nova\Nova;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Events\ServingNova;
use Illuminate\Support\Facades\Event;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Artisan;
use Indianic\CountryStateCityManagement\Nova\Resources\City;
use Indianic\CountryStateCityManagement\Nova\Resources\State;
use Indianic\CountryStateCityManagement\Nova\Resources\Country;
use Indianic\CountryStateCityManagement\Console\CountryManagementCommand;
use Indianic\CountryStateCityManagement\Policies\CountryStateCityManagementPolicy;

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

            if (is_dir($path . "/Seeders")) {
                $file_names = glob($path . "/Seeders" . '/*.php');
                foreach ($file_names as $filename) {
                    $class = basename($filename, '.php');
                    echo "\033[1;33mSeeding:\033[0m {$class}\n";
                    $startTime = microtime(true);
                    Artisan::call('db:seed', ['--class' => 'Indianic\\CountryStateCityManagement\\Database\\Seeders\\' . $class, '--force' => '']);
                    $runTime = round(microtime(true) - $startTime, 2);
                    echo "\033[0;32mSeeded:\033[0m {$class} ({$runTime} seconds)\n";
                }
            }

            $this->commands([
                CountryManagementCommand::class,
            ]);
        }
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
