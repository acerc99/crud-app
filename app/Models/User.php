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
        'name', 'email', 'dob', 'gender', 'profession', 'mobile_no', 'state_id', 'city_id'
    ];

    public function saveUser($data)
    {
    
        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->dob = $data['dob'];
        $this->gender = $data['gender'];
        $this->profession = $data['profession'];
        $this->mobile_no = $data['mobile_no'];
        $this->state_id = $data['state'];
        $this->city_id = $data['city'];
        $this->image = $imageName;
        $this->save();
    }

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

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'user_skill');
    }
}
