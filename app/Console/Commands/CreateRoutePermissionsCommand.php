<?php

namespace App\Console\Commands;

use Database\Seeders\PermissionSeeder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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

        $this->truncateTables();

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
        $this->createRolePermissions();

        $this->info('Permission routes added successfully.');
    }

    private static function createRolePermissions()
    {
        $adminPermissionIds = Permission::where('name', 'like', 'admin.%')->orWhere('name', 'home')->pluck('id');
        $trainerPermissionIds = Permission::where('name', 'like', 'trainer.%')->orWhere('name', 'home')->pluck('id');

        Role::create(['name' => 'admin'])->permissions()->sync($adminPermissionIds);
        Role::create(['name' => 'trainer'])->permissions()->sync($trainerPermissionIds);
    }

    private function truncateTables()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('user_has_roles')->truncate();
        DB::table('user_has_permissions')->truncate();
        DB::table('role_has_permissions')->truncate();
        Permission::truncate();
        Role::truncate();
        Schema::enableForeignKeyConstraints();
    }
}
