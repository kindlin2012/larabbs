<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Warehouse;

class WarehousePolicy extends Policy
{
    public function update(User $user, Warehouse $warehouse)
    {

        // return $warehouse->user_id == $user->id;
        return $user->isAuthorOf($warehouse);
        // return true;
    }

    public function destroy(User $user, Warehouse $warehouse)
    {
        return $user->isAuthorOf($warehouse);
        // return true;
    }

    public function create(User $user, Warehouse $warehouse)
    {
        return $user->id==1;
        // return true;
    }


}
