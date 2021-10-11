<?php

namespace App\Policies;

use App\Models\User;
use App\Models\project;
use App\Models\UserAuthority;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        // 誰でもプロジェクトの一覧を閲覧できる。
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\project  $project
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, project $project)
    {
        // showメソッドはない。
        return false;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        // 誰でもプロジェクトを作成することができる。
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\project  $project
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, project $project)
    {
        // 管理者権限
        return $user->getAuthorityId($project) === UserAuthority::PROJECT_ADMIN;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\project  $project
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, project $project)
    {
        // 管理者権限
        return $user->getAuthorityId($project) === UserAuthority::PROJECT_ADMIN;
    }
}
