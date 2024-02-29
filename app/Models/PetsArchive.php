<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PetsArchive extends Model
{
    public function homeowners()
    {
        return $this->belongsTo(ResidentsArchive::class, 'email');
    }
    
    use HasFactory;

    protected $table = 'pets_archives';

    protected $fillable = [
        'email',
        'type_of_pets',
        'breed',
        'vaccinated',
        'age',
        'color',
    ];

    
}
