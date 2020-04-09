<?php

namespace app\Policies;

use app\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function before($user, $ability)
    {
        return $user->isAdmin() ? true : null;
    }
    /**
     * 編集と削除の認可を判断する。
     *
     * @param  \App\User $user  現在ログインしているユーザー
     * @param  \App\User $model 現在表示しているプロフィールページのユーザー
     * @return mixed
     */
    public function edit(User $user, User $model)
    {
        return $user->id == $model->id;
    }
}
