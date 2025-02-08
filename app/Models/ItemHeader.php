<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
