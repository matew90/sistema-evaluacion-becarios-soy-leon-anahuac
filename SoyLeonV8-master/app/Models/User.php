<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'us_banner_id',
        'us_banner_guid',
        'name',
        'email',
        'password',
        'us_uID',
        'rol_uID',
        'camp_uID',
        'ar_uID',
        'sta_uID',
    ];



    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

  	public function status()
    {
      return $this->hasOne('App\Models\general\Status','sta_uID', 'sta_uID');
    }
    public function campus()
    {
      return $this->hasOne('App\Models\general\Campus','camp_uID', 'camp_uID');
    }
    public function role()
    {
      return $this->hasOne('App\Models\general\Role','rol_uID', 'rol_uID');
    }
    public function area()
    {
     return $this->hasOne('App\Models\general\Area', 'ar_uID', 'ar_uID');
    }

}
