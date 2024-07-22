<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Support\Facades\Auth;

class Role extends Model
{
    use HasFactory;
    Use Loggable;

    protected $fillable = [
        'title',
    ];

    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'menus_roles');
    }

    public function isSuperAdmin()
    {
        return in_array(Auth::user()->role_id, [1]);
    }

    public function isAdmin()
    {
        return in_array(Auth::user()->role_id, [2]);
    }

    public function isClient()
    {
        return !in_array(Auth::user()->role_id, [1, 2]);
    }
}
