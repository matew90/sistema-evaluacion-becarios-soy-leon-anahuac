<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class assigments extends Model
{
    use HasFactory;
    protected $fillable = [
        'assig_uID',
        'us_uID',
        'coord_uID',
        'conv_uID',
        'sta_uID',
        'ar_uID'

    ];
    public function area()
    {
     return $this->hasOne('App\Models\general\Area', 'ar_uID', 'ar_uID');
    }
    public function evaluacion()
    {
     return $this->hasOne('App\Models\evaluations', 'assig_uID', 'assig_uID');
    }
    public function becario(){
        return $this->hasOne('App\Models\User', 'us_uID', 'us_uID');
    }
    public function coordinador(){
        return $this->hasOne('App\Models\User', 'us_uID','coord_uID');
    }
    public function conv()
    {
     return $this->hasOne('App\Models\convocations', 'conv_uID', 'conv_uID' );
    }
    public function record()
    {
     return $this->hasOne('App\Models\records', 'us_uID', 'us_uID' );
    }


}
