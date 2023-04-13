<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class records extends Model
{
    use HasFactory;
    protected $fillable = [
        'rec_uID',
        'sch_type',
        'sch_porcentage',
        'us_uID',
        'rol',
        'conv_uID',
        'ar_uID',
        'sta_uID',
    ];

    const UID_STATUS_ACTIVE='023584f1-5547-429a-a131-3b3810d156c7';

    public function user()
    {
     return $this->hasOne('App\Models\User', 'us_uID', 'us_uID' );
    }
    public function coordinador(){
        return $this->hasOne('App\Models\User', 'us_uID','us_uID');
    }
    public function area()
    {
     return $this->hasOne('App\Models\general\Area', 'ar_uID', 'ar_uID');
    }
    public function conv()
    {
     return $this->hasOne('App\Models\convocations', 'conv_uID', 'conv_uID' );
    }
    public function assig()
    {
     return $this->hasOne('App\Models\assigments', 'us_uID', 'us_uID' );
    }
}

