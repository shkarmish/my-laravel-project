<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Make sure images folder exists
        File::ensureDirectoryExists(public_path('images'));

        $products = [
            [
                'name'        => 'Classic White Sneakers',
                'description' => 'Lightweight and comfortable everyday sneakers with a clean white design. Perfect for casual outings.',
                'price'       => 49.99,
                'image_url'   => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=400',
            ],
            [
                'name'        => 'Leather Wallet',
                'description' => 'Slim genuine leather wallet with multiple card slots and a bill compartment. Fits easily in any pocket.',
                'price'       => 29.99,
                'image_url'   => 'https://images.unsplash.com/photo-1627123424574-724758594e93?w=400',
            ],
            [
                'name'        => 'Wireless Headphones',
                'description' => 'Over-ear wireless headphones with noise cancellation and 30-hour battery life. Crystal clear sound quality.',
                'price'       => 89.99,
                'image_url'   => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=400',
            ],
            [
                'name'        => 'Sunglasses',
                'description' => 'UV400 polarized sunglasses with a stylish frame. Ideal for sunny days and outdoor activities.',
                'price'       => 34.99,
                'image_url'   => 'https://images.unsplash.com/photo-1572635196237-14b3f281503f?w=400',
            ],
            [
                'name'        => 'Backpack',
                'description' => 'Durable 30L backpack with laptop compartment, water bottle pocket, and padded shoulder straps.',
                'price'       => 59.99,
                'image_url'   => 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=400',
            ],
            [
                'name'        => 'Wrist Watch',
                'description' => 'Minimalist analog watch with a stainless steel case and leather strap. Water resistant up to 30m.',
                'price'       => 119.99,
                'image_url'   => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=400',
            ],
            [
                'name'        => 'Coffee Mug',
                'description' => 'Ceramic 350ml coffee mug with a comfortable handle. Microwave and dishwasher safe.',
                'price'       => 14.99,
                'image_url'   => 'https://images.unsplash.com/photo-1514228742587-6b1558fcca3d?w=400',
            ],
            [
                'name'        => 'Bluetooth Speaker',
                'description' => 'Portable waterproof speaker with 360-degree sound and 12-hour playtime. Great for outdoor use.',
                'price'       => 44.99,
                'image_url'   => 'https://images.unsplash.com/photo-1608043152269-423dbba4e7e1?w=400',
            ],
            [
                'name'        => 'Running Shoes',
                'description' => 'Breathable mesh running shoes with cushioned sole for maximum comfort during long runs.',
                'price'       => 74.99,
                'image_url'   => 'https://images.unsplash.com/photo-1491553895911-0055eca6402d?w=400',
            ],
            [
                'name'        => 'Desk Lamp',
                'description' => 'LED desk lamp with adjustable brightness and color temperature. USB charging port on the base.',
                'price'       => 39.99,
                'image_url'   => 'https://images.unsplash.com/photo-1573297888407-63cdfd4d0030?w=400',
            ],
            [
                'name'        => 'Notebook',
                'description' => 'A5 hardcover notebook with 200 lined pages. Perfect for journaling, notes, and sketching.',
                'price'       => 12.99,
                'image_url'   => 'https://images.unsplash.com/photo-1531346878377-a5be20888e57?w=400',
            ],
            [
                'name'        => 'Phone Stand',
                'description' => 'Adjustable aluminum phone stand compatible with all smartphones and tablets. Foldable and portable.',
                'price'       => 18.99,
                'image_url'   => 'https://images.unsplash.com/photo-1586953208270-d52e1e3a6483?w=400',
            ],
            [
                'name'        => 'Yoga Mat',
                'description' => 'Non-slip 6mm thick yoga mat with carrying strap. Suitable for yoga, pilates, and stretching.',
                'price'       => 27.99,
                'image_url'   => 'https://images.unsplash.com/photo-1601925228008-6afd4d36ad8e?w=400',
            ],
            [
                'name'        => 'Mechanical Keyboard',
                'description' => 'Compact TKL mechanical keyboard with RGB backlight and tactile switches. Great for gaming and typing.',
                'price'       => 99.99,
                'image_url'   => 'https://images.unsplash.com/photo-1587829741301-dc798b83add3?w=400',
            ],
            [
                'name'        => 'Water Bottle',
                'description' => 'Insulated stainless steel 500ml water bottle. Keeps drinks cold for 24 hours and hot for 12 hours.',
                'price'       => 22.99,
                'image_url'   => 'https://images.unsplash.com/photo-1602143407151-7111542de6e8?w=400',
            ],
            [
                'name'        => 'Cap / Hat',
                'description' => 'Adjustable cotton baseball cap with a curved brim. One size fits most. Available in multiple colors.',
                'price'       => 16.99,
                'image_url'   => 'https://images.unsplash.com/photo-1588850561407-ed78c282e89b?w=400',
            ],
            [
                'name'        => 'Scented Candle',
                'description' => 'Hand-poured soy wax candle with a lavender and vanilla scent. Burns cleanly for up to 40 hours.',
                'price'       => 19.99,
                'image_url'   => 'https://images.unsplash.com/photo-1603006905003-be475563bc59?w=400',
            ],
            [
                'name'        => 'Sunscreen SPF 50',
                'description' => 'Lightweight non-greasy sunscreen with SPF 50 protection. Suitable for all skin types.',
                'price'       => 11.99,
                'image_url'   => 'https://images.unsplash.com/photo-1556228578-8c89e6adf883?w=400',
            ],
            [
                'name'        => 'Wireless Mouse',
                'description' => 'Ergonomic wireless mouse with silent clicks and a long-lasting battery. Compatible with all OS.',
                'price'       => 32.99,
                'image_url'   => 'https://images.unsplash.com/photo-1527864550417-7fd91fc51a46?w=400',
            ],
            [
                'name'        => 'Dumbbell Set',
                'description' => 'Pair of rubber-coated 5kg dumbbells. Ideal for home workouts and strength training.',
                'price'       => 54.99,
                'image_url'   => 'https://images.unsplash.com/photo-1584735935682-2f2b69dff9d2?w=400',
            ],
            [
                'name'        => 'Ceramic Plant Pot',
                'description' => 'Minimalist white ceramic pot with drainage hole and bamboo tray. Perfect for indoor plants.',
                'price'       => 17.99,
                'image_url'   => 'https://images.unsplash.com/photo-1485955900006-10f4d324d411?w=400',
            ],
            [
                'name'        => 'Portable Charger',
                'description' => '10000mAh slim power bank with dual USB output and fast charging support. Travel-friendly.',
                'price'       => 37.99,
                'image_url'   => 'https://images.unsplash.com/photo-1609091839311-d5365f9ff1c5?w=400',
            ],
            [
                'name'        => 'Wooden Cutting Board',
                'description' => 'Large acacia wood cutting board with juice groove. Easy to clean and gentle on knife edges.',
                'price'       => 31.99,
                'image_url'   => 'https://images.unsplash.com/photo-1606206591513-adbfbdd5e98b?w=400',
            ],
            [
                'name'        => 'Face Wash',
                'description' => 'Gentle daily face wash with aloe vera and green tea extract. Suitable for sensitive skin.',
                'price'       => 9.99,
                'image_url'   => 'https://images.unsplash.com/photo-1556228720-195a672e8a03?w=400',
            ],
            [
                'name'        => 'Throw Blanket',
                'description' => 'Soft fleece throw blanket 130x150cm. Lightweight and warm — perfect for the couch or bed.',
                'price'       => 42.99,
                'image_url'   => 'https://images.unsplash.com/photo-1580301762395-21ce84d00bc6?w=400',
            ],
        ];

        foreach ($products as $index => $data) {
            // Download image from Unsplash and save locally
            $filename  = 'product_' . ($index + 1) . '.jpg';
            $imagePath = public_path('images/' . $filename);

            // Only download if not already saved
            if (!File::exists($imagePath)) {
                try {
                    $imageContent = file_get_contents($data['image_url']);
                    if ($imageContent !== false) {
                        File::put($imagePath, $imageContent);
                    } else {
                        $filename = null; // If download fails, store null
                    }
                } catch (\Exception $e) {
                    $filename = null; // If download fails, store null
                }
            }

            Product::create([
                'name'        => $data['name'],
                'description' => $data['description'],
                'price'       => $data['price'],
                'stock'       => rand(5, 100),
                'image'       => $filename,
            ]);
        }

        $this->command->info('25 dummy products seeded successfully!');
    }
}