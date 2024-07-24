<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Section extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['title', 'factory_id'];

    public function factory()
    {
        return $this->belongsTo(Factory::class);
    }

    public function handlers()
    {
        return $this->hasMany(SectionHandler::class);
    }

    public function getHandlersCountAttribute()
    {
        return $this->handlers()->count();
    }

    public function sectionHead()
    {
        return $this->handlers()->firstWhere("is_head", true);
    }
}

