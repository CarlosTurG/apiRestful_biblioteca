<?php

namespace App;

use App\Libro;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

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


    ///Función que permite obtener qué libros están prestados a qué usuarios
    public function libros()
    {
        return $this->belongsToMany(Libro::class, 'libro_users');
    }

    public static function by_field($key, $value)
    {
        $users = self::where($key, $value)->get();

        foreach ($users as $key => $user)
        {
            return $user;
        }
    }

    public function is_authorized(Request $request)
    {
        $token = new Token();
        $header_authorization = $request->header('Authorization');

        if (!isset($header_authorization))
        {
            return false;
        }

        $data = $token->decode($header_authorization);
        return !empty(self::by_field('email', $data->email));
    }
}
