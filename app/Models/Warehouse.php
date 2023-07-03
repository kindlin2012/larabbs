<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Warehouse extends Model
{
    use HasFactory;

    protected $fillable = ['housename', 'user_id', 'description', 'plate_count'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
