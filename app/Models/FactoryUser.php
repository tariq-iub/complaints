<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FactoryUser extends Model
{
    use HasFactory;

    protected $table = 'factory_user';

    protected $fillable = ['factory_id', 'user_id', 'access_level'];

    public function factory()
    {
        return $this->belongsTo(Factory::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
