<?php

namespace App\Providers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        try {
            $this->registerGates();
        } catch (\PDOException $exception) {
            Log::info('Cannot register gates, cause: ' . $exception);
        }
    }

    private function registerGates(): void
    {
        $roles = Cache::rememberForever('roles_with_permissions', fn() => Role::with('permissions')->get());
        $permissions = [];
        foreach ($roles as $role) {
            foreach ($role->permissions as $permission) {
                $permissions[$permission->name->value][] = $role->id;
            }
        }

        // Every permission may have multiple roles assigned
        foreach ($permissions as $title => $roles) {
            Gate::define($title, function (User $user) use ($roles) {
                // We check if we have the needed roles among current user's roles
                return count(array_intersect($user->roles->pluck('id')->toArray(), $roles)) > 0;
            });
        }
    }
}
