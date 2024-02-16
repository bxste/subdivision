<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incidents extends Model
{
    use HasFactory;
    protected $fillable = ['reporter_first_name', 'reporter_last_name', 'reporter_phone_number', 'reporter_block_num', 'incident_date', 'incident_time', 'location_details', 'incident_details', 'incident_type', 'person_behind_incident', 'person_behind_incident_block_num' ];
}
