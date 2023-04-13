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
        'emailPersonal',
        'password',
        'us_uID',
        'rol_uID',
        'camp_uID',
        'ar_uID',
        'sta_uID',
        'deg_uID'
    ];

    protected $table ="users";
    const ROL_BECARIO = 0;




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
    public function convocatoria()
    {
     return $this->hasOne('App\Models\general\convocations', 'us_uID', 'us_uID');
    }
    public function degrees()
    {
     return $this->hasOne('App\Models\Degrees', 'deg_uID', 'deg_uID');
    }
    public function roles()
    {
     return $this->hasOne('App\Models\Degrees', 'deg_uID', 'deg_uID');
    }
    public function records()
    {
     return $this->hasOne('App\Models\Records', 'rec_uID', 'rec_uID');
    }
    public function user()
    {
     return $this->hasOne('App\Models\User', 'us_uID', 'us_uID' );
    }
    public function record()
    {
     return $this->hasOne('App\Models\records', 'us_uID', 'us_uID' );
    }
    public function recordActive($conv = null)
    {
        if(!is_null($conv)){
            return $this->record()->where("sta_uID", records::UID_STATUS_ACTIVE)->where("conv_uID", $conv)->first();
        }
        return $this->record()->where("sta_uID", records::UID_STATUS_ACTIVE)->first();
    }
    public function assigment()
    {
     return $this->hasOne('App\Models\assigment', 'us_uID', 'us_uID' );
    }
}
