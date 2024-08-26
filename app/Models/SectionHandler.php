<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SectionHandler extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'section_id',
        'employee_id', // Update to use employee_id
        'is_head',
    ];
    protected $casts = [
        'is_head' => 'boolean',
    ];
    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function employee() // Update to use employee relationship
    {
        return $this->belongsTo(Employee::class);
    }
}

