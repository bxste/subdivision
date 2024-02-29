<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Homeowners;

class ChecklistViolation extends Model
{
    public function user()
    {
        return $this->belongsTo(Homeowners::class);
    }
}
