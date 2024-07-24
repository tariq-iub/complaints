<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Section extends Model
{
    use HasFactory, SoftDeletes;

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

    public function sectionHandlers()
    {
        return $this->hasMany(SectionHandler::class); // Updated to use SectionHandler
    }
}

