<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

   protected $fillable = [
       'men_uID',
       'sta_uID',
       'men_name',
       'men_slug',
       'men_icon',
       'men_route',
       'cat_uID',
       'created_by',
       'updated_by',
       'deleted_by',
   ];

   public function category()
   {
     return $this->hasOne(Category::class,'cat_uID', 'cat_uID');
   }

   public function submenus()
   {
     return $this->hasMany(Submenu::class,'men_uID', 'men_uID');
   }

   public function status()
   {
     return $this->hasOne(Status::class,'sta_uID', 'sta_uID');
   }
}
