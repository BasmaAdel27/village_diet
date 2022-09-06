<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

class CreateRoutePermissionsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permission:create-permission-routes';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a permission routes.';
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        /**
         *  This array contains all public routes
         *
         * @var array
         */
        $publicRoutes = [
            'login',
            'logout',
            'register',
            'password.request',
            'password.email',
            'password.reset',
            'password.update',
            'password.confirm',
            'admin.'
        ];

        foreach (Route::getRoutes() as $route) {
            if (
                $route->getName() != ''
                && $route->getAction()['middleware']['0'] == 'web'
                && !Permission::where('name', $route->getName())->exists()
                && !in_array($route->getName(), $publicRoutes)
                && !str_contains($route->getName(), 'edit')
                && !str_contains($route->getName(), 'create')
            ) {
                permission::create(['name' => $route->getName()]);
            }
        }

        $this->info('Permission routes added successfully.');
    }
}
