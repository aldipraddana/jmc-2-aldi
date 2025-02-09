<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubCategory extends Model
{
    use HasFactory;

    protected static function booted() :void
    {
        static::creating(function (self $value) {
            $value->created_by = auth()->id();
            $value->updated_by = auth()->id();
        });

        static::saving(function (self $value) {
            $value->updated_by = auth()->id();
        });
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
