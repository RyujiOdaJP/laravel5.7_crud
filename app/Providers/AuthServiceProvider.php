<?php

namespace app\Providers;

use app\User;
use app\Policies\UserPolicy;
use app\Post;
use app\Policies\PostPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use app\User;
use app\Policies\UserPolicy;
use app\Post;
use app\Policies\PostPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'app\Model' => 'app\Policies\ModelPolicy',
        User::class => UserPolicy::class,
        Post::class => PostPolicy::class,

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //// グローバル変数
        // 管理者のID番号を1とする
        // 参照: https://stackoverflow.com/questions/28356193/
        config(['admin_id' => 1]);
    }
}
