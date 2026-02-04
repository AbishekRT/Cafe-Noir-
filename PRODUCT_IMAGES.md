# Product Images

## Image Setup

All product images have been downloaded and added to the database.

### Image Storage

- **Location:** `public/storage/products/`
- **Format:** JPG (optimized from Unsplash)
- **Total Images:** 19 high-quality product images

### Products with Images

#### Coffee Products (12):

1. Ethiopian Yirgacheffe
2. Colombian Supremo
3. Guatemala Antigua
4. Kenya AA
5. Sumatra Mandheling
6. House Blend
7. Breakfast Blend
8. Dark Roast Blend
9. Decaf Blend
10. Classic Espresso
11. Single Origin Espresso
12. Ristretto Roast

#### Accessories (7):

13. Ceramic Pour-Over Dripper
14. Cafe Noir Travel Mug
15. Burr Coffee Grinder
16. Glass French Press
17. Coffee Storage Canister
18. Digital Coffee Scale
19. Cafe Noir Mug Set

### Image Source

All images sourced from [Unsplash](https://unsplash.com) - free, high-quality stock photos.

### Database

Product images are stored in the `product_images` table with the following fields:

- `product_id` - Foreign key to products table
- `original_path` - Path to the original image
- `large_path` - 1200px width version
- `medium_path` - 600px width version
- `thumbnail_path` - 300px width version
- `alt_text` - Alt text for SEO
- `is_primary` - Primary image flag

### Note for Setup

When cloning this repository:

1. Product images are stored in `public/storage/products/` (gitignored)
2. After running migrations and seeding, you can download the images again or add your own
3. Images will be linked to products via the `product_images` table through the seeder

---

**Last Updated:** February 4, 2026
