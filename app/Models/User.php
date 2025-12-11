<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;
    protected $primaryKey = 'id_user'; 
    public $incrementing = true;
    protected $keyType = 'int';

    /**
     * Field yang boleh diisi mass-assignment.
     */
    protected $fillable = [
        'username',
        'password',
        'role',
    ];

    /**
     * Field yang disembunyikan saat serialisasi.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Cast field ke tipe data tertentu (tidak perlu `email_verified_at`).
     */
    protected $casts = [];

    public function getAuthIdentifierName()
    {
        return 'username';
    }
}
