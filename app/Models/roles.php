<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class roles extends Model
{
    use HasFactory;
    protected $fillable = [
        'rol_uID',
        'sta_uID',
        'camp_uID',
        'rol_name',
        'rol_level',
        'rol_permissions',
        'first_sub_uID',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at'
    ];
}
