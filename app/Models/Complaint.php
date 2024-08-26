<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Complaint extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'detail',
        'category_id',
        'priority',
        'section_id',
        'handler_id',
        'photo_path',
        'section_added_at',
        'handler_assigned_at',
        'resolved_at',
    ];

    protected $casts = [
        'priority' => 'string',
        'created_at' => 'datetime',
        'section_added_at' => 'datetime',
        'handler_assigned_at' => 'datetime',
        'resolved_at' => 'datetime',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    public function sectionHead()
    {
        // Assuming the section head is managed via the SectionHandler
        return $this->hasOneThrough(Employee::class, SectionHandler::class, 'section_id', 'id', 'section_id', 'employee_id')
                    ->where('is_head', true);
    }

    public function handler()
    {
        return $this->belongsTo(Employee::class, 'handler_id');
    }
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
