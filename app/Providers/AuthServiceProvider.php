<?php

namespace App\Providers;

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
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

            Gate::define("post.edit", function($user,$post){
            return $user->id === $post->user_id;
            });

            Gate::define("post.destroy", function($user,$post){
            return $user->id === $post->user_id;
            });
            Gate::before(function($user,$ability){
            if($user->is_admin && in_array($ability,["post.edit","post.destroy"])){
                return true;
            }
            });
    }
}
