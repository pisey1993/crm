<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{
    protected $table = 'claims_online'; // Set your custom table

    protected $fillable = [
        'policy_number', 'claim_type', 'incident_date', 'description', 'documents',
    ];

    protected $casts = [
        'documents' => 'array',
    ];
}
