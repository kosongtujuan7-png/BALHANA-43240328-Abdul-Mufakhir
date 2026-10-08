<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::query()
            ->where('is_active', true)
            ->with('variants')
            ->withSum('variants', 'stock')
            ->orderBy('name')
            ->get();

        $firstProduct = $products->first();

        $summary = [
            'total_products' => Product::where('is_active', true)->count(),
            'total_variants' => ProductVariant::whereHas('product', function ($query) {
                $query->where('is_active', true);
            })->count(),
            'available_stock' => (int) ProductVariant::whereHas('product', function ($query) {
                $query->where('is_active', true);
            })->sum('stock'),
            'needs_attention' => ProductVariant::whereHas('product', function ($query) {
                $query->where('is_active', true);
            })->whereColumn('stock', '<=', 'low_stock_threshold')->count(),
        ];

        return view('produk', compact('products', 'firstProduct', 'summary'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedProduct($request);

        DB::transaction(function () use ($data): void {
            $product = Product::create([
                'code' => $data['code'] ?: 'DRAFT-' . Str::uuid(),
                'name' => $data['name'],
                'category' => $data['category'],
                'material' => $data['material'] ?? null,
                'notes' => $data['notes'] ?? null,
                'selling_price' => $data['selling_price'],
                'purchase_price' => $data['purchase_price'],
                'is_active' => true,
            ]);

            if (empty($data['code'])) {
                $product->update([
                    'code' => 'BLH-' . str_pad((string) $product->id, 3, '0', STR_PAD_LEFT),
                ]);
            }

            $this->ensureVariants(
                $product,
                $data['sizes'] ?? '',
                $data['colors'] ?? ''
            );
        });

        return redirect()
            ->route('produk')
            ->with('status', 'Produk berhasil ditambahkan.');
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $data = $this->validatedProduct($request, $product);

        DB::transaction(function () use ($data, $product): void {
            $product->update([
                'code' => $data['code'] ?: $product->code,
                'name' => $data['name'],
                'category' => $data['category'],
                'material' => $data['material'] ?? null,
                'notes' => $data['notes'] ?? null,
                'selling_price' => $data['selling_price'],
                'purchase_price' => $data['purchase_price'],
            ]);

            $this->ensureVariants(
                $product,
                $data['sizes'] ?? '',
                $data['colors'] ?? ''
            );
        });

        return redirect()
            ->route('produk')
            ->with('status', 'Perubahan produk berhasil disimpan.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->update(['is_active' => false]);

        return redirect()
            ->route('produk')
            ->with('status', 'Produk dinonaktifkan dari katalog.');
    }

    private function validatedProduct(Request $request, ?Product $product = null): array
    {
        return $request->validate([
            'code' => [
                'nullable',
                'string',
                'max:50',
                Rule::unique('products', 'code')->ignore($product?->id),
            ],
            'name' => ['required', 'string', 'max:150'],
            'category' => ['required', 'string', 'max:80'],
            'material' => ['nullable', 'string', 'max:120'],
            'notes' => ['nullable', 'string', 'max:2000'],
            'selling_price' => ['required', 'numeric', 'min:0'],
            'purchase_price' => ['required', 'numeric', 'min:0'],
            'sizes' => ['nullable', 'string', 'max:255'],
            'colors' => ['nullable', 'string', 'max:255'],
        ]);
    }

    private function ensureVariants(Product $product, string $sizes, string $colors): void
    {
        $sizeList = $this->splitValues($sizes) ?: ['All size'];
        $colorList = $this->splitValues($colors) ?: ['Default'];

        foreach ($sizeList as $size) {
            foreach ($colorList as $color) {
                ProductVariant::firstOrCreate(
                    [
                        'product_id' => $product->id,
                        'size' => $size,
                        'color' => $color,
                    ],
                    [
                        'stock' => 0,
                        'low_stock_threshold' => 3,
                    ]
                );
            }
        }
    }

    private function splitValues(string $value): array
    {
        return collect(preg_split('/[,;\/]+/', $value) ?: [])
            ->map(fn ($item) => trim($item))
            ->filter()
            ->unique()
            ->values()
            ->all();
    }
}