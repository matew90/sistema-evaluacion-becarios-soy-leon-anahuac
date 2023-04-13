<?php

namespace App\Models\general;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
	
	
   public function spacesGet()
   {
     return $this->belongsTo('App\Models\general\Spaces', 'spa_uID', 'spa_uID');
   }
	
   public function user()
   {
     return $this->hasOne('App\Models\User', 'us_uID', 'us_uID');
   }
}
