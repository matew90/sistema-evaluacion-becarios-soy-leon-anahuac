<?php

namespace App\Models\general;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submenu extends Model
{
    use HasFactory;

    protected $fillable = [
        'sub_uID',
        'men_uID',
        'sta_uID',
        'sub_name',
        'sub_route',
        'sub_slug',
        'sub_bread',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function menu()
    {
      return $this->hasOne(Menu::class,'men_uID', 'men_uID');
    }

    public function status()
    {
      return $this->hasOne(Status::class,'sta_uID', 'sta_uID');
    }

}
