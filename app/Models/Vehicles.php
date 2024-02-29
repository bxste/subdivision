<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicles extends Model
{
    public function homeowners()
    {
        return $this->belongsTo(Residents::class, 'homeowner_id');
    }

    use HasFactory;

    protected $table = 'vehicles';

    protected $fillable = [
        'homeowner_id',
        'type',
        'model',
        'make',
        'color',
        'plate_number',
        'sticker_number',
    ];
}
