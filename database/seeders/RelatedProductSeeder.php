<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\RelatedProduct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RelatedProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all product IDs
        $productIds = Product::pluck('id')->toArray();

        // Seed the related_products table
        foreach ($productIds as $productId) {
            // Randomly pick two different products
            $relatedProductIds = array_diff($productIds, [$productId]);
            $randomRelatedProductIds = array_rand($relatedProductIds, 2);

            // Create related entries in the related_products table
            foreach ($randomRelatedProductIds as $relatedProductId) {
                RelatedProduct::create([
                    'product_id' => $productId,
                    'related_product_id' => $relatedProductIds[$relatedProductId],
                ]);
            }
        }
    }
}
