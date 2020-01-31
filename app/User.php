<?php

namespace App;

use App\Events\UserCreated;
use App\Traits\HasUuid;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use KD\Wallet\Traits\HasWallet;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasUuid;

    use Notifiable;

    use HasWallet;

    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $dates = ['created_at', 'updated_at'];

    protected $dispatchesEvents = [
        'created' => UserCreated::class
    ];

    public function getAvatarAttribute($avatar)
    {
        return $avatar == null ? "https://huntpng.com/images250/default-avatar-png-11.png" : $avatar;
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function quizzes()
    {
        return $this->belongsToMany(Quiz::class, 'quiz_participants');
    }

    public function quiz_rankings()
    {
        return $this->hasMany(QuizRanking::class);
    }

    public function topics()
    {
        return $this->belongsToMany(Topic::class, 'topic_subscribers');
    }

    public static function generate_username($name, $rand_num = 1000)
    {
        $parts = array_slice(array_filter(explode(" ", strtolower($name))), 0, 2);

        $part1 = (!empty($parts[0])) ? substr($parts[0], 0, strlen($parts[0])) : "";
        $part2 = (!empty($parts[1])) ? substr($parts[1], 0, rand(0, strlen($parts[1]))) : "";

        $username = $part1 . $part2 . rand(0, $rand_num);
        $exists = self::where('username', $username)->first();

        if ($exists) {
            return self::generate_username($name, $rand_num = 200);
        } else {
            return $username;
        }
    }
}
