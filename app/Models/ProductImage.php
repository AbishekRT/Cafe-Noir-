<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

/**
 * ProductImage Model
 * 
 * Represents images associated with products.
 * Stores paths for original and resized versions.
 * 
 * @property int $id
 * @property int $product_id
 * @property string $original_path
 * @property string|null $large_path
 * @property string|null $medium_path
 * @property string|null $thumbnail_path
 * @property string|null $alt_text
 * @property int $sort_order
 * @property bool $is_primary
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 */
class ProductImage extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'product_id',
        'original_path',
        'large_path',
        'medium_path',
        'thumbnail_path',
        'alt_text',
        'sort_order',
        'is_primary',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'sort_order' => 'integer',
        'is_primary' => 'boolean',
    ];

    /**
     * Get the product that owns the image.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the URL for the original image.
     */
    public function getOriginalUrlAttribute(): string
    {
        return Storage::url($this->original_path);
    }

    /**
     * Get the URL for the large image (1200px).
     */
    public function getLargeUrlAttribute(): string
    {
        return Storage::url($this->large_path ?? $this->original_path);
    }

    /**
     * Get the URL for the medium image (600px).
     */
    public function getMediumUrlAttribute(): string
    {
        return Storage::url($this->medium_path ?? $this->original_path);
    }

    /**
     * Get the URL for the thumbnail image (300px).
     */
    public function getThumbnailUrlAttribute(): string
    {
        return Storage::url($this->thumbnail_path ?? $this->original_path);
    }

    /**
     * Get the alt text for the image.
     */
    public function getAltAttribute(): string
    {
        return $this->alt_text ?? $this->product->name ?? 'Product image';
    }

    /**
     * Delete all image files associated with this record.
     */
    public function deleteFiles(): void
    {
        $paths = array_filter([
            $this->original_path,
            $this->large_path,
            $this->medium_path,
            $this->thumbnail_path,
        ]);

        foreach ($paths as $path) {
            if (Storage::exists($path)) {
                Storage::delete($path);
            }
        }
    }

    /**
     * Boot the model.
     */
    protected static function boot(): void
    {
        parent::boot();

        // Delete files when the model is deleted
        static::deleting(function ($image) {
            $image->deleteFiles();
        });
    }
}
