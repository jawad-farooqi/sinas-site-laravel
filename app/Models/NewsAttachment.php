<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsAttachment extends Model
{
    //

    protected $fillable = [
        'news_id',
        'file_path',
        'original_name',
        'mime_type',
        'file_size',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'file_size' => 'integer',
            'sort_order' => 'integer',
        ];
    }

    public function news(): BelongsTo
    {
        return $this->belongsTo(News::class);
    }

}
