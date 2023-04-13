<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class temporal extends Model
{
    use HasFactory;
    protected $fillable = [
        'rol',
        'temp_uID',
        'us_uID',
        'sta_uID',
    ];
    public function user()
    {
     return $this->hasOne('App\Models\User', 'us_uID', 'us_uID');
    }
    
    public function status()
    {
     return $this->hasOne('App\Models\general\Status', 'sta_uID', 'sta_uID');
    }
}
