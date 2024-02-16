<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forms extends Model
{
    public function additionalData()
    {
        return $this->relatedData();
    }
    public function relatedData()
    {
        return $this->hasMany(relatedData::class, 'user_id');
    }
}
