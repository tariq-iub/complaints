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

    protected $user;
    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'menus_roles');
    }

    public function getMenusSubjectToRole()
    {
        $ids = $this->menus()->where('status', true)->pluck('menus.id')->toArray();
        return $this->menus()
            ->whereNull('parent_id')
            ->with('submenus', function($query) use($ids) {
                $query->whereIn('id', $ids);
            })->orderBy('display_order')
            ->get();
    }

    public function isAdmin() : bool
    {
        return $this->user->role_id == 1;
    }

    public function isClient() : bool
    {
        return $this->user->role_id == 2;
    }

    public function isEmployee() : bool
    {
        return $this->user->role_id == 3;
    }
}
