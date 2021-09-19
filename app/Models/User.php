<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Notifications\RedefinirSenhaNotification;
use App\Notifications\VerificarEmailNotification;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Sobrescreve método padrão de e-mail para recuperação de senha
     *
     * @param string
     */
    public function sendPasswordResetNotification($token) {
        $this->notify(new RedefinirSenhaNotification($token, $this->email, $this->name));
    }

    /**
     * Sobrescreve método padrão de e-mail para verificação de e-mail
     *
     */
    public function sendEmailVerificationNotification() {
        $this->notify(new VerificarEmailNotification($this->name));
    }

    public function projetos() {
        return $this->hasMany('App\Models\Projeto');
    }

}
