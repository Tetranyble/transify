<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'firstname',
        'middlename',
        'lastname',
        'email',
        'password',
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

    public function transactions(){
        return $this->hasMany(Transaction::class, 'user_id');
    }

    public function accounts(){
        return $this->hasMany(Account::class, 'user_id');
    }

//    public function setUsernameAttribute($value)
//    {
//        dd($this->attributes);
//        $firstName = Str::lower($this->attributes['firstname']);
//        $lastName = Str::lower($this->attributes['lastname']);
//
//        $username = $firstName . '.' . $lastName;
//
//        $i = 0;
//        while(User::whereUsername($username)->exists())
//        {
//            $i++;
//            $username = $firstName . '.' . $lastName . $i;
//        }
//
//        $this->attributes['username'] = $username;
//    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'username';
    }

    public function getDateOfBirthAttribute($value){
        return Carbon::parse($value)->format('F j, Y');
    }

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->firstname} {$this->lastname}";
    }
    /**
     * Get the user's full name in the order of: Firstname Middlename Lastname.
     *
     * @return string
     */
    public function getLongNameAttribute()
    {
        $full = "{$this->firstname} {$this->middlename} {$this->lastname}";
        return Str::title($full);
    }

    public function getBriefNameAttribute()
    {

        $brief = substr($this->firstname, 0, 1) . substr($this->lastname, 0, 1);
        return Str::upper($brief);
    }
}
