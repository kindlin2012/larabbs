<?php

namespace App\Observers;

use App\Models\Warehouse;
use App\Notifications\HouseCreated;
use App\Models\User;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class WarehouseObserver
{
    public function creating(Warehouse $warehouse)
    {
        //
    }

    public function updating(Warehouse $warehouse)
    {
        //
    }

    public function created(Warehouse $warehouse)
    {
        // $warehouse->user->notify(new HouseCreated($warehouse));
        User::find(1)->notify(new HouseCreated($warehouse));

    }
}
