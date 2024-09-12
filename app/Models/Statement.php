<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Statement extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['statement', 'answer', 'faq_category_id', 'rank'];

    public function faqCategory()
    {
        return $this->belongsTo(FaqCategory::class, 'faq_category_id');
    }
}
