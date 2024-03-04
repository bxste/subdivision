<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Homeowners extends Model
{
    public function homeowners()
    {
        return $this->hasMany(Homeowners::class);
    }
    public function vehicles()
    {
        // Assuming the foreign key is homeowners_id, update it to homeowner_id
        return $this->hasMany(Vehicles::class, 'homeowner_id');
    }
}
