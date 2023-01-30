<?php
namespace Indianic\CountryStateCityManagement\Policies;

use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class CountryStateCityManagementPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any currency management.
     *
     * @param Admin $user
     * @return bool
     */
    public function viewAny(Admin $user): bool
    {
        return $user->hasPermissionTo('view country-management');
    }

    /**
     * Determine whether the user can view the country-management.
     *
     * @param Admin $user
     * @return bool
     */
    public function view(Admin $user): bool
    {
        return ( $user->hasPermissionTo('view country-management'));
    }

    /**
     * Determine whether the user can create country-management.
     *
     * @param Admin $user
     * @return bool
     */
    public function create(Admin $user): bool
    {
        return ( $user->hasPermissionTo('create country-management'));
    }

    /**
     * Determine whether the user can update the country-management.
     *
     * @param Admin $user
     * @return bool
     */
    public function update(Admin $user): bool
    {
        return $user->hasPermissionTo('update country-management');
    }

    /**
     * Determine whether the user can delete the country-management.
     *
     * @return Response|bool
     */
    public function delete(): Response|bool
    {
        return $user->hasPermissionTo('delete country-management');
    }
}