<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Residents extends Model
{
    public function vehicles()
    {
        return $this->hasMany(Vehicles::class, 'homeowner_id');
    }

    public function pets()
    {
        return $this->hasMany(Pets::class, 'homeowner_id');
    }

    public function residentType()
    {
        return $this->status === 'owner' ? 'owned' : 'tenant';
    }
    
    use HasFactory;

    protected $table = 'homeowners';

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
        'homeowner_id',
    ];

    public function tenants(): HasMany
    {
        return $this->hasMany(Residents::class, 'homeowner_id');
    }

    public function homeowner()
    {
        return $this->belongsTo(Residents::class, 'homeowner_id');
    }
}
