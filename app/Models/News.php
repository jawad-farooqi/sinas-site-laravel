<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    //
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'news_category_id',
        'featured_image',
        'status',
        'published_at',
        'expires_at',
        'is_featured',
        'author_id',
    ];

    protected function casts(): array
    {
        return [
            'attachments' => 'array',
            'published_at' => 'datetime',
            'expires_at' => 'datetime',
            'is_featured' => 'boolean',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(
            NewsCategory::class,
            'news_category_id'
        );
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'author_id'
        );
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(NewsAttachment::class)
            ->orderBy('sort_order');
    }

    public function isExpired(): bool
    {
        return $this->status === 'published'
            && $this->expires_at !== null
            && $this->expires_at->isPast();
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published');
    }

    public function scopeNotExpired(Builder $query): Builder
    {
        return $query->where(function (Builder $query) {
            $query
                ->whereNull('expires_at')
                ->orWhere('expires_at', '>', now());
        });
    }
}
