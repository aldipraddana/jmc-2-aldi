<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ItemHeader extends Model
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

    public function itemBody(): HasMany
    {
        return $this->hasMany(ItemBody::class, 'item_header_id');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function subCategory(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }
}
