<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pets extends Model
{
    public function homeowners()
    {
        return $this->belongsTo(Residents::class, 'homeowner_id');
    }

    use HasFactory;

    protected $table = 'homeowner_pets';

    protected $fillable = [
        'homeowner_id',
        'type_of_pets',
        'breed',
        'vaccinated',
        'age',
        'color',
    ];
}
