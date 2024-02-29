<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function violations()
    {
        return $this->hasMany(Violation::class);
    }
}


