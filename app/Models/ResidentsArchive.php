<?php

namespace App\Models;

use App\Imports\VehicleImport;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ResidentsArchive extends Model
{
    public function pets(): HasMany
    {
        return $this->hasMany(PetsArchive::class, 'email');
    }

    public function vehicles(): HasMany
    {
        return $this->hasMany(VehiclesArchive::class, 'email');
    }
    
    use HasFactory;
    protected $table = 'homeowner_archives';

    protected $fillable = [
        'block',
        'lot',
        'street',
        'first_name',
        'middle_initial',
        'last_name',
        'religion',
        'email',
        'phone_number',
        'household_size',
        'occupation',
        'status',
        'acknowledgement_on_community_rules',
        'disability',
        'gender',
        'payment_status',
        'violation',
        'relationship_to_homeowner',
    ];

    
}
