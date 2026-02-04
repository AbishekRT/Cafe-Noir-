<?php

namespace App\Services;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * ImageService
 * 
 * Handles image uploads with automatic resizing for products.
 * Creates multiple sizes: original, large (1200px), medium (600px), thumbnail (300px).
 */
class ImageService
{
    /**
     * Image sizes configuration.
     */
    protected const SIZES = [
        'large' => 1200,
        'medium' => 600,
        'thumbnail' => 300,
    ];

    /**
     * Maximum file size in bytes (3 MB).
     */
    public const MAX_FILE_SIZE = 3 * 1024 * 1024;

    /**
     * Allowed MIME types.
     */
    public const ALLOWED_MIMES = ['image/jpeg', 'image/png', 'image/webp'];

    /**
     * Allowed extensions.
     */
    public const ALLOWED_EXTENSIONS = ['jpg', 'jpeg', 'png', 'webp'];

    /**
     * The image manager instance.
     */
    protected ImageManager $manager;

    /**
     * Create a new ImageService instance.
     */
    public function __construct()
    {
        $this->manager = new ImageManager(new Driver());
    }

    /**
     * Upload and process a product image.
     * 
     * @param UploadedFile $file The uploaded file.
     * @param string $folder The storage folder path.
     * @return array{original: string, large: string, medium: string, thumbnail: string}
     */
    public function upload(UploadedFile $file, string $folder = 'products'): array
    {
        $this->validate($file);

        $filename = $this->generateFilename($file);
        $basePath = "public/{$folder}";

        // Read the image
        $image = $this->manager->read($file->getRealPath());

        // Save original
        $originalPath = "{$basePath}/original/{$filename}";
        Storage::put($originalPath, $image->toJpeg(85));

        $paths = ['original' => $originalPath];

        // Create resized versions
        foreach (self::SIZES as $size => $width) {
            $resized = $this->manager->read($file->getRealPath());

            // Resize maintaining aspect ratio, only if larger than target
            if ($resized->width() > $width) {
                $resized->scale(width: $width);
            }

            $sizePath = "{$basePath}/{$size}/{$filename}";
            Storage::put($sizePath, $resized->toJpeg(85));
            $paths[$size] = $sizePath;
        }

        return $paths;
    }

    /**
     * Validate an uploaded file.
     * 
     * @throws \InvalidArgumentException
     */
    public function validate(UploadedFile $file): void
    {
        if ($file->getSize() > self::MAX_FILE_SIZE) {
            throw new \InvalidArgumentException('Image file size must not exceed 3 MB.');
        }

        $extension = strtolower($file->getClientOriginalExtension());
        if (!in_array($extension, self::ALLOWED_EXTENSIONS)) {
            throw new \InvalidArgumentException('Image must be a JPG, PNG, or WebP file.');
        }

        $mimeType = $file->getMimeType();
        if (!in_array($mimeType, self::ALLOWED_MIMES)) {
            throw new \InvalidArgumentException('Invalid image type. Only JPG, PNG, and WebP are allowed.');
        }
    }

    /**
     * Generate a unique filename for the uploaded image.
     */
    protected function generateFilename(UploadedFile $file): string
    {
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $slug = Str::slug($originalName);
        $uniqueId = Str::random(8);

        return "{$slug}-{$uniqueId}.jpg";
    }

    /**
     * Delete all versions of an image.
     */
    public function delete(array $paths): void
    {
        foreach ($paths as $path) {
            if ($path && Storage::exists($path)) {
                Storage::delete($path);
            }
        }
    }

    /**
     * Get validation rules for image uploads.
     */
    public static function validationRules(): array
    {
        return [
            'mimes:jpg,jpeg,png,webp',
            'max:3072', // 3 MB in kilobytes
        ];
    }
}
