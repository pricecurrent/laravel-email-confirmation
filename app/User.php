<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

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
     * CHeck if user has confirmed email
     * @return bool
     */
    public function isConfirmed()
    {
        return !! $this->is_confirmed;
    }

    /**
     * Get email confirmation token
     * @return string
     */
    public function getEmailConfirmationToken()
    {
        $this->update([
            'confirmation_token' => $token = Str::random(),
        ]);

        return $token;
    }


    /**
     * Confirm user's email address
     * @return App\User
     */
    public function confirm()
    {
        $this->update([
            'is_confirmed' => true,
            'confirmation_token' => null,
        ]);
        return $this;
    }
}
