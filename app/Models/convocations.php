<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class convocations extends Model
{
    use HasFactory;

    protected $fillable = [
        'conv_uID',
        'conv_name',
        'conv_period',
        'conv_start_date',
        'conv_end_date',
        'conv_email',
        'conv_porcentage',
        'conv_comments',
        'sta_uID'
    ];

    public function convocations()
    {
     return $this->hasOne('App\Models\convocations', 'conv_uID', 'conv_uID' );
    }
    public function assig()
    {
     return $this->hasOne('App\Models\assigments', 'us_uID', 'us_uID' );
    }
    public function record()
    {
     return $this->hasOne('App\Models\record', 'us_uID', 'us_uID' );
    }
}
