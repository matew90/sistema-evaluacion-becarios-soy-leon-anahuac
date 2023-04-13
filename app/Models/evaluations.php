<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class evaluations extends Model
{
    use HasFactory;
    protected $fillable = [
        'eval_uID',
        'eval_Question1',
        'eval_Question2',
        'eval_Question3',
        'eval_Question4',
        'eval_Question5',
        'eval_Question6',
        'sta_uID',
        'assig_uID'

    ];
}
