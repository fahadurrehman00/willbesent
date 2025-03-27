<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Notifications\CustomResetPassword;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'lastname',
        'phone',
        'state',
        'zip',
        'street',
        'city',
        'frequency',
        'password',
        'pincode',
        'profile_image',
        'message_time',
        'user_status',
        'last_verification_attempt'
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
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function recipients()
    {
        return $this->hasMany(Recipient::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
    
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'last_verification_attempt' => 'datetime',
        ];
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomResetPassword($token));
    }
}
