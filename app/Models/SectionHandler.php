<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SectionHandler extends Model
{
    use SoftDeletes;

    protected $table = 'section_handlers';

    protected $fillable = [
        'section_id',
        'user_id',
        'is_heard',
    ];

    protected $casts = [
        'is_heard' => 'string', // Adjust casting as needed
    ];

    public $timestamps = true;

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
