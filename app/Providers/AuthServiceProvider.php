<?php

namespace App\Providers;

use App\Models\Project;
use App\Models\User;
use App\Models\UserAuthority;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('projectAdmin', function (User $user, Project $project) {
            return $user->getAuthorityId($project) === UserAuthority::PROJECT_ADMIN;
        });

        Gate::define('projectEditorOrMore', function (User $user, Project $project) {
            return $user->getAuthorityId($project) >= UserAuthority::PROJECT_EDITOR;
        });

        Gate::define('projectViewerOrMore', function (User $user, Project $project) {
            return $user->getAuthorityId($project) >= UserAuthority::PROJECT_VIEWER;
        });
    }
}
