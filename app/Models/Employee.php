<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'father_name',
        'cnic',
        'birth_date',
        'gender',
        'designation_id',
        'email',
        'mobile_no',
        'address_line1',
        'address_line2',
        'joining_date',
    ];

    protected $dates = ['birth_date', 'joining_date'];
    
    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }
}
