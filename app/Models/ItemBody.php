<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItemBody extends Model
{
    use HasFactory;

    public function itemHeader(): BelongsTo
    {
        return $this->belongsTo(ItemHeader::class, 'item_header_id');
    }
}
