<?php
 
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'prefixname', 'firstname', 'middlename', 'lastname',
        'suffixname', 'username', 'email', 'password', 'photo', 'type'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getAvatarAttribute(): string
    {
        return $this->photo
            ? asset('storage/' . $this->photo)
            : 'data:image/png;base64,' . base64_encode(file_get_contents(resource_path('default-avatar.png')));
    }

    public function getFullnameAttribute(): string
    {
        $middleInitial = $this->middlename ? strtoupper(substr($this->middlename, 0, 1)) . '.' : '';
        return "{$this->firstname} {$middleInitial} {$this->lastname}";
    }

    public function getMiddleinitialAttribute(): string
    {
        return $this->middlename ? strtoupper(substr($this->middlename, 0, 1)) . '.' : '';
    }
}
