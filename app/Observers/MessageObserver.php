<?php

namespace App\Observers;

use App\Models\Message;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class MessageObserver
{
    public function creating(Message $message)
    {
        //
    }

    public function updating(Message $message)
    {
        //
    }
}