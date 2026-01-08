<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'location',
        'completion_date',
        'area',
        'scope',
        'description',
        'featured_image',
        'is_featured',
        'is_published',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'completion_date' => 'date',
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
        ];
    }

    /**
     * @return BelongsTo<Category, $this>
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return HasMany<ProjectImage, $this>
     */
    public function images(): HasMany
    {
        return $this->hasMany(ProjectImage::class)->orderBy('order');
    }

    /**
     * Scope for published projects.
     *
     * @param  \Illuminate\Database\Eloquent\Builder<Project>  $query
     * @return \Illuminate\Database\Eloquent\Builder<Project>
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    /**
     * Scope for featured projects.
     *
     * @param  \Illuminate\Database\Eloquent\Builder<Project>  $query
     * @return \Illuminate\Database\Eloquent\Builder<Project>
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}
