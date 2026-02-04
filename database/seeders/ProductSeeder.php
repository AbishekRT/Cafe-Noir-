<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all()->keyBy('slug');

        $products = [
            // Single Origin Products
            [
                'category' => 'single-origin',
                'name' => 'Ethiopian Yirgacheffe',
                'price' => 18.99,
                'compare_price' => 22.99,
                'description' => "Experience the birthplace of coffee with our Ethiopian Yirgacheffe. This exceptional single-origin coffee delivers bright, wine-like acidity with delicate floral notes and a smooth, tea-like body. Hand-picked from the lush highlands of the Yirgacheffe region, each bean carries the essence of Ethiopia's rich coffee heritage.\n\nTasting Notes: Jasmine, bergamot, lemon zest, honey\nProcessing: Washed\nAltitude: 1,700 - 2,200 meters",
                'short_description' => 'Bright and floral Ethiopian coffee with notes of jasmine and citrus.',
                'weight' => '340g',
                'roast_level' => 'light',
                'origin' => 'Ethiopia',
                'stock_quantity' => 45,
                'is_featured' => true,
            ],
            [
                'category' => 'single-origin',
                'name' => 'Colombian Supremo',
                'price' => 16.99,
                'description' => "Our Colombian Supremo is sourced from the high-altitude regions of Huila, where volcanic soil and perfect growing conditions produce exceptional beans. This coffee offers a perfectly balanced cup with caramel sweetness, nutty undertones, and a clean, bright finish.\n\nTasting Notes: Caramel, hazelnut, red apple, milk chocolate\nProcessing: Washed\nAltitude: 1,500 - 2,000 meters",
                'short_description' => 'Smooth and balanced with caramel sweetness and nutty undertones.',
                'weight' => '340g',
                'roast_level' => 'medium',
                'origin' => 'Colombia',
                'stock_quantity' => 60,
                'is_featured' => true,
            ],
            [
                'category' => 'single-origin',
                'name' => 'Guatemala Antigua',
                'price' => 17.49,
                'description' => "From the volcanic slopes of Antigua, Guatemala, comes this remarkable coffee with a full body and sophisticated complexity. The unique terroir creates a cup with spicy undertones, chocolate richness, and a subtle smoky finish that lingers pleasantly.\n\nTasting Notes: Dark chocolate, cinnamon, orange peel, smoky finish\nProcessing: Washed\nAltitude: 1,500 - 1,700 meters",
                'short_description' => 'Rich Guatemalan coffee with chocolate notes and spicy complexity.',
                'weight' => '340g',
                'roast_level' => 'medium-dark',
                'origin' => 'Guatemala',
                'stock_quantity' => 38,
                'is_featured' => false,
            ],
            [
                'category' => 'single-origin',
                'name' => 'Kenya AA',
                'price' => 21.99,
                'description' => "Kenya AA represents the highest grade of Kenyan coffee, and our selection exemplifies why. Grown in the nutrient-rich red soil near Mount Kenya, these beans produce a wine-like cup with brilliant acidity, berry sweetness, and a syrupy body that coffee connoisseurs adore.\n\nTasting Notes: Blackcurrant, grapefruit, brown sugar, tomato-like acidity\nProcessing: Washed\nAltitude: 1,400 - 2,000 meters",
                'short_description' => 'Premium Kenyan coffee with bright acidity and berry notes.',
                'weight' => '340g',
                'roast_level' => 'medium-light',
                'origin' => 'Kenya',
                'stock_quantity' => 25,
                'is_featured' => true,
            ],
            [
                'category' => 'single-origin',
                'name' => 'Sumatra Mandheling',
                'price' => 19.49,
                'description' => "This Indonesian gem from the Mandheling region offers a distinctly earthy and bold profile. The unique wet-hulling process gives this coffee its characteristic low acidity, heavy body, and complex herbal notes that make it a favorite for those who enjoy intense, full-flavored coffee.\n\nTasting Notes: Dark chocolate, cedar, tobacco, earthy undertones\nProcessing: Wet-hulled (Giling Basah)\nAltitude: 1,100 - 1,600 meters",
                'short_description' => 'Bold Indonesian coffee with earthy depth and low acidity.',
                'weight' => '340g',
                'roast_level' => 'dark',
                'origin' => 'Indonesia',
                'stock_quantity' => 42,
                'is_featured' => false,
            ],

            // Blend Products
            [
                'category' => 'blends',
                'name' => 'House Blend',
                'price' => 14.99,
                'description' => "Our signature House Blend is the perfect everyday coffee. We've carefully selected and roasted beans from Central and South America to create a well-rounded cup that's smooth, approachable, and consistently delicious. This blend is versatile enough for any brewing method.\n\nTasting Notes: Milk chocolate, toasted nuts, brown sugar, clean finish\nComponents: Colombian, Brazilian, Guatemalan beans\nRoast: Medium",
                'short_description' => 'Our signature everyday blend - smooth, balanced, and approachable.',
                'weight' => '340g',
                'roast_level' => 'medium',
                'origin' => 'Central & South America',
                'stock_quantity' => 100,
                'is_featured' => true,
            ],
            [
                'category' => 'blends',
                'name' => 'Breakfast Blend',
                'price' => 13.99,
                'description' => "Start your morning right with our Breakfast Blend. Light and lively, this blend combines bright East African beans with smooth Central American coffees to create an invigorating cup that pairs perfectly with your morning routine.\n\nTasting Notes: Citrus, honey, toasted grain, bright finish\nComponents: Ethiopian, Costa Rican beans\nRoast: Light-Medium",
                'short_description' => 'Light and bright - the perfect way to start your day.',
                'weight' => '340g',
                'roast_level' => 'medium-light',
                'origin' => 'Multi-region',
                'stock_quantity' => 75,
                'is_featured' => false,
            ],
            [
                'category' => 'blends',
                'name' => 'Dark Roast Blend',
                'price' => 15.49,
                'description' => "For those who prefer a bolder cup, our Dark Roast Blend delivers rich, robust flavors without the bitterness. We select beans that can withstand the darker roast while maintaining sweetness and complexity.\n\nTasting Notes: Dark chocolate, molasses, roasted nuts, smoky\nComponents: Sumatra, Brazilian, Colombian beans\nRoast: Dark",
                'short_description' => 'Bold and rich dark roast for the serious coffee lover.',
                'weight' => '340g',
                'roast_level' => 'dark',
                'origin' => 'Multi-region',
                'stock_quantity' => 55,
                'is_featured' => false,
            ],
            [
                'category' => 'blends',
                'name' => 'Decaf Blend',
                'price' => 16.99,
                'description' => "All the flavor, none of the caffeine. Our Decaf Blend uses the Swiss Water Process to naturally remove caffeine while preserving the coffee's complex flavors. Enjoy a satisfying cup any time of day without compromising on taste.\n\nTasting Notes: Caramel, milk chocolate, subtle fruit, smooth finish\nProcess: Swiss Water Decaffeination\nRoast: Medium",
                'short_description' => 'Swiss Water Process decaf with full flavor.',
                'weight' => '340g',
                'roast_level' => 'medium',
                'origin' => 'Central America',
                'stock_quantity' => 30,
                'is_featured' => false,
            ],

            // Espresso Products
            [
                'category' => 'espresso',
                'name' => 'Classic Espresso',
                'price' => 17.99,
                'description' => "Our Classic Espresso blend is crafted specifically for espresso brewing. This Italian-style roast produces a thick, golden crema and delivers bold, sweet flavors that shine through milk or stand beautifully on their own as a straight shot.\n\nTasting Notes: Bittersweet chocolate, caramel, hazelnut, thick crema\nComponents: Brazilian, Colombian, Guatemalan beans\nBest For: Espresso, Cappuccino, Latte",
                'short_description' => 'Traditional Italian-style espresso with rich crema.',
                'weight' => '340g',
                'roast_level' => 'dark',
                'origin' => 'Multi-region',
                'stock_quantity' => 65,
                'is_featured' => true,
            ],
            [
                'category' => 'espresso',
                'name' => 'Single Origin Espresso',
                'price' => 19.99,
                'compare_price' => 23.99,
                'description' => "For the espresso purist who wants to taste the unique characteristics of a single origin. This medium-dark roast Brazilian Santos creates a smooth, sweet espresso with low acidity and notes of chocolate and nuts.\n\nTasting Notes: Milk chocolate, roasted peanut, caramel, subtle fruit\nOrigin: Santos, Brazil\nBest For: Straight espresso, Americano",
                'short_description' => 'Brazilian single origin crafted for espresso extraction.',
                'weight' => '340g',
                'roast_level' => 'medium-dark',
                'origin' => 'Brazil',
                'stock_quantity' => 35,
                'is_featured' => false,
            ],
            [
                'category' => 'espresso',
                'name' => 'Ristretto Roast',
                'price' => 18.49,
                'description' => "Designed for the concentrated ristretto shot, this intensely roasted blend delivers maximum flavor in minimum volume. The beans are roasted to bring out deep, bittersweet flavors that create an exceptionally concentrated and aromatic shot.\n\nTasting Notes: Dark chocolate, burnt caramel, tobacco, intense finish\nComponents: Italian roast blend\nBest For: Ristretto, Double espresso",
                'short_description' => 'Intense roast for concentrated ristretto shots.',
                'weight' => '340g',
                'roast_level' => 'dark',
                'origin' => 'Multi-region',
                'stock_quantity' => 28,
                'is_featured' => false,
            ],

            // Accessories
            [
                'category' => 'accessories',
                'name' => 'Ceramic Pour-Over Dripper',
                'price' => 24.99,
                'description' => "Our handcrafted ceramic pour-over dripper is the perfect companion for brewing the perfect cup. The ridged interior promotes optimal water flow and extraction, while the ceramic material retains heat for a consistent brewing temperature.\n\nFeatures:\n- Fits standard #2 filters\n- Brews 1-2 cups\n- Heat-retaining ceramic\n- Dishwasher safe\n- Available in matte black",
                'short_description' => 'Handcrafted ceramic dripper for the perfect pour-over.',
                'weight' => '350g',
                'stock_quantity' => 40,
                'is_featured' => false,
            ],
            [
                'category' => 'accessories',
                'name' => 'Cafe Noir Travel Mug',
                'price' => 28.99,
                'description' => "Take your favorite Cafe Noir coffee wherever you go with our premium stainless steel travel mug. Double-walled vacuum insulation keeps your coffee hot for up to 6 hours or cold for 12 hours.\n\nFeatures:\n- 16oz / 475ml capacity\n- Double-wall vacuum insulation\n- Leak-proof lid\n- BPA-free\n- Cafe Noir logo engraved",
                'short_description' => 'Premium insulated travel mug - keeps coffee hot for hours.',
                'weight' => '280g',
                'stock_quantity' => 50,
                'is_featured' => false,
            ],
            [
                'category' => 'accessories',
                'name' => 'Burr Coffee Grinder',
                'price' => 89.99,
                'compare_price' => 109.99,
                'description' => "Achieve the perfect grind every time with our conical burr grinder. Featuring 15 grind settings from fine espresso to coarse French press, this grinder ensures consistent particle size for optimal extraction.\n\nFeatures:\n- Conical burr mechanism\n- 15 grind settings\n- 250g bean hopper\n- Static-reducing technology\n- Easy-clean design",
                'short_description' => 'Conical burr grinder with 15 settings for any brew method.',
                'weight' => '1.2kg',
                'stock_quantity' => 20,
                'is_featured' => true,
            ],
            [
                'category' => 'accessories',
                'name' => 'Glass French Press',
                'price' => 34.99,
                'description' => "Brew rich, full-bodied coffee with our elegant glass French press. The borosilicate glass carafe is both heat-resistant and beautiful, while the fine mesh plunger ensures a clean cup with full flavor extraction.\n\nFeatures:\n- 34oz / 1 liter capacity\n- Borosilicate glass\n- Stainless steel plunger\n- Fine mesh filter\n- Heat-resistant handle",
                'short_description' => 'Elegant 1-liter French press for full-bodied coffee.',
                'weight' => '650g',
                'stock_quantity' => 35,
                'is_featured' => false,
            ],
            [
                'category' => 'accessories',
                'name' => 'Coffee Storage Canister',
                'price' => 19.99,
                'description' => "Keep your coffee fresh with our airtight storage canister. The CO2 release valve allows freshly roasted beans to off-gas while preventing oxygen from entering, ensuring your coffee stays fresh longer.\n\nFeatures:\n- 16oz capacity (holds ~340g beans)\n- One-way CO2 valve\n- Airtight silicone seal\n- Stainless steel construction\n- Date tracker on lid",
                'short_description' => 'Airtight canister with CO2 valve for optimal freshness.',
                'weight' => '200g',
                'stock_quantity' => 60,
                'is_featured' => false,
            ],
            [
                'category' => 'accessories',
                'name' => 'Digital Coffee Scale',
                'price' => 44.99,
                'description' => "Precision brewing starts with accurate measurement. Our digital scale features a built-in timer for pour-over brewing and precise 0.1g accuracy for weighing your coffee and water.\n\nFeatures:\n- 0.1g precision\n- Built-in timer\n- 3kg max capacity\n- Auto-off function\n- USB rechargeable\n- Waterproof surface",
                'short_description' => 'Precision scale with timer for perfect brewing ratios.',
                'weight' => '450g',
                'stock_quantity' => 25,
                'is_featured' => false,
            ],
            [
                'category' => 'accessories',
                'name' => 'Cafe Noir Mug Set',
                'price' => 32.99,
                'description' => "Enjoy your daily brew in style with our signature ceramic mug set. These generously sized mugs feature a comfortable handle and our minimalist Cafe Noir logo. Set includes 2 mugs.\n\nFeatures:\n- Set of 2 mugs\n- 12oz / 350ml each\n- Premium ceramic\n- Microwave safe\n- Dishwasher safe\n- Matte finish with logo",
                'short_description' => 'Set of 2 signature ceramic mugs with Cafe Noir branding.',
                'weight' => '600g',
                'stock_quantity' => 45,
                'is_featured' => false,
            ],
        ];

        foreach ($products as $productData) {
            $categorySlug = $productData['category'];
            unset($productData['category']);

            $productData['category_id'] = $categories[$categorySlug]->id;
            $productData['slug'] = Str::slug($productData['name']);
            $productData['sku'] = 'CN-' . strtoupper(Str::random(6));
            $productData['is_active'] = true;
            $productData['seo_title'] = $productData['name'] . ' | ' . config('cafe.name', 'Cafe Noir');
            $productData['seo_description'] = $productData['short_description'];

            Product::create($productData);
        }
    }
}
