<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class FaqCategory extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['name', 'rank'];

    
    public function statements()
    {
        return $this->hasMany(Statement::class, 'faq_category_id');
    }
    public function contents()
    {
        return $this->hasOne(Content::class, 'faq_category_id');
    }

}
// i have three data set tables name 
//     faq category
//     rank

//     statement
//     answer 
//     faq category id
//     rank

//     title
//     description
//     icons
//     rank
// make model controller and migration