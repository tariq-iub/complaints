<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class Menu extends Model
{
    use HasFactory;
    use Loggable;
    protected $fillable = ['title'];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'menus_roles');
    }

    public function subMenus()
    {
        return $this->hasMany(Menu::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    public function parentsOnly()
    {
        return self::where('parent_id', null)->with('subMenus')->get();
    }
}
