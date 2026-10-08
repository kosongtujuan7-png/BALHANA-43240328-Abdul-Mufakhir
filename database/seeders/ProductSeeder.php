<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'code' => 'BLH-001',
                'name' => 'Kemeja Linen',
                'category' => 'Atasan',
                'material' => 'Linen premium',
                'selling_price' => 149000,
                'purchase_price' => 90000,
                'notes' => 'Potongan regular fit, bahan ringan dan adem.',
                'variants' => [
                    ['size' => 'M', 'color' => 'Hitam', 'stock' => 2],
                    ['size' => 'L', 'color' => 'Hitam', 'stock' => 3],
                    ['size' => 'XL', 'color' => 'Hitam', 'stock' => 1],
                    ['size' => 'M', 'color' => 'Cream', 'stock' => 1],
                    ['size' => 'L', 'color' => 'Cream', 'stock' => 1],
                    ['size' => 'XL', 'color' => 'Cream', 'stock' => 0],
                ],
            ],
            [
                'code' => 'BLH-002',
                'name' => 'Tunik Aira',
                'category' => 'Atasan',
                'material' => 'Katun rayon',
                'selling_price' => 129000,
                'purchase_price' => 82000,
                'notes' => null,
                'variants' => [
                    ['size' => 'M', 'color' => 'Cream', 'stock' => 14],
                    ['size' => 'L', 'color' => 'Cream', 'stock' => 12],
                    ['size' => 'XL', 'color' => 'Cream', 'stock' => 8],
                    ['size' => 'M', 'color' => 'Olive', 'stock' => 3],
                    ['size' => 'L', 'color' => 'Olive', 'stock' => 3],
                    ['size' => 'XL', 'color' => 'Olive', 'stock' => 2],
                ],
            ],
            [
                'code' => 'BLH-003',
                'name' => 'Celana Kulot',
                'category' => 'Bawahan',
                'material' => 'Satin twill',
                'selling_price' => 119000,
                'purchase_price' => 76000,
                'notes' => null,
                'variants' => [
                    ['size' => 'M', 'color' => 'Mocca', 'stock' => 6],
                    ['size' => 'L', 'color' => 'Mocca', 'stock' => 6],
                    ['size' => 'XL', 'color' => 'Mocca', 'stock' => 6],
                    ['size' => 'M', 'color' => 'Hitam', 'stock' => 6],
                    ['size' => 'L', 'color' => 'Hitam', 'stock' => 6],
                    ['size' => 'XL', 'color' => 'Hitam', 'stock' => 6],
                ],
            ],
            [
                'code' => 'BLH-004',
                'name' => 'Outer Knit',
                'category' => 'Outer',
                'material' => 'Rajut halus',
                'selling_price' => 159000,
                'purchase_price' => 100000,
                'notes' => null,
                'variants' => [
                    ['size' => 'All size', 'color' => 'Beige', 'stock' => 0],
                    ['size' => 'All size', 'color' => 'Charcoal', 'stock' => 0],
                ],
            ],
        ];

        foreach ($products as $data) {
            $variants = $data['variants'];
            unset($data['variants']);

            $product = Product::firstOrCreate(
                ['code' => $data['code']],
                $data
            );

            foreach ($variants as $variant) {
                ProductVariant::firstOrCreate(
                    [
                        'product_id' => $product->id,
                        'size' => $variant['size'],
                        'color' => $variant['color'],
                    ],
                    [
                        'stock' => $variant['stock'],
                        'low_stock_threshold' => 3,
                    ]
                );
            }
        }
    }
}