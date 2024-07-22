<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Site extends Model
{
    use HasFactory;
    use Loggable;
    use SoftDeletes;

    protected $fillable = ['title', 'factory_id'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime'
    ];

    public function factory()
    {
        return $this->belongsTo(Factory::class);
    }

    public function components()
    {
        return $this->hasMany(Component::class);
    }
}
