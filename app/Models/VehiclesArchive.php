<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehiclesArchive extends Model
{
    public function homeowners()
    {
        return $this->belongsTo(ResidentsArchive::class, 'email');
    }
    
    use HasFactory;
    protected $table = 'vehicles_archives';

    protected $fillable = [
        'email',
        'type',
        'model',
        'make',
        'color',
        'plate_number',
        'sticker_number',
    ];

    
}
