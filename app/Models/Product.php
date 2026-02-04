<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

/**
 * Product Model
 * 
 * Represents coffee products available for purchase.
 * 
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $sku
 * @property string $description
 * @property string|null $short_description
 * @property float $price
 * @property float|null $compare_price
 * @property int $category_id
 * @property string|null $weight
 * @property string|null $roast_level
 * @property string|null $origin
 * @property int|null $stock_quantity
 * @property bool $is_active
 * @property bool $is_featured
 * @property string|null $seo_title
 * @property string|null $seo_description
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 */
class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'sku',
        'description',
        'short_description',
        'price',
        'compare_price',
        'category_id',
        'weight',
        'roast_level',
        'origin',
        'stock_quantity',
        'is_active',
        'is_featured',
        'seo_title',
        'seo_description',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price' => 'decimal:2',
        'compare_price' => 'decimal:2',
        'stock_quantity' => 'integer',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
    ];

    /**
     * Boot the model.
     */
    protected static function boot(): void
    {
        parent::boot();

        // Auto-generate slug from name if not provided
        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
        });

        static::updating(function ($product) {
            if ($product->isDirty('name') && !$product->isDirty('slug')) {
                $product->slug = Str::slug($product->name);
            }
        });
    }

    /**
     * Get the category that owns the product.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the images for this product.
     */
    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order');
    }

    /**
     * Scope a query to only include active products.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to only include featured products.
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope a query to only include products in stock.
     */
    public function scopeInStock($query)
    {
        return $query->where(function ($q) {
            $q->whereNull('stock_quantity')->orWhere('stock_quantity', '>', 0);
        });
    }

    /**
     * Scope a query to search products.
     */
    public function scopeSearch($query, $term)
    {
        if (empty($term)) {
            return $query;
        }

        return $query->where(function ($q) use ($term) {
            $q->where('name', 'like', "%{$term}%")
                ->orWhere('description', 'like', "%{$term}%");
        });
    }

    /**
     * Get the current price (compare price if available, otherwise regular price).
     */
    public function getCurrentPriceAttribute(): float
    {
        return $this->compare_price ?? $this->price;
    }

    /**
     * Check if the product has a discount.
     */
    public function getHasDiscountAttribute(): bool
    {
        return $this->compare_price !== null && $this->price < $this->compare_price;
    }

    /**
     * Get the discount percentage.
     */
    public function getDiscountPercentageAttribute(): int
    {
        if (!$this->has_discount) {
            return 0;
        }

        return (int) round((($this->compare_price - $this->price) / $this->compare_price) * 100);
    }

    /**
     * Check if the product is in stock.
     */
    public function getIsInStockAttribute(): bool
    {
        return $this->stock_quantity === null || $this->stock_quantity > 0;
    }

    /**
     * Get the primary image for this product.
     */
    public function getPrimaryImageAttribute(): ?ProductImage
    {
        return $this->images->firstWhere('is_primary', true) ?? $this->images->first();
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Get the SEO title for this product.
     */
    public function getSeoTitleFullAttribute(): string
    {
        return $this->seo_title ?? $this->name . ' | Cafe Noir';
    }

    /**
     * Get the SEO description for this product.
     */
    public function getSeoDescriptionFullAttribute(): string
    {
        return $this->seo_description ?? Str::limit(strip_tags($this->description), 160);
    }
}
