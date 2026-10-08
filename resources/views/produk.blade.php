@extends('layouts.app')

@section('title', 'Produk – BALHANA')

@section('content')
@php
    $products = $products ?? collect();
    $summary = $summary ?? [
        'total_products' => 0,
        'total_variants' => 0,
        'available_stock' => 0,
        'needs_attention' => 0,
    ];

    $firstProduct = $firstProduct ?? $products->first();
    $editingId = old('id');
    $selectedProduct = $editingId
        ? $products->firstWhere('id', (int) $editingId)
        : ($errors->any() ? null : $firstProduct);

    $categories = collect(['Atasan', 'Bawahan', 'Outer', 'Dress', 'Hijab', 'Aksesori'])
        ->merge($products->pluck('category'))
        ->filter()
        ->unique()
        ->values();

    $images = [
        'BLH-001' => 'https://images.unsplash.com/photo-1602810318383-e386cc2a3ccf?w=600&q=85&fit=crop',
        'BLH-002' => 'https://images.unsplash.com/photo-1567401893414-76b7b1e5a7a5?w=600&q=85&fit=crop',
        'BLH-003' => 'https://images.unsplash.com/photo-1624378439575-d8705ad7ae80?w=600&q=85&fit=crop',
        'BLH-004' => 'https://images.unsplash.com/photo-1516762689617-e1cffcef479d?w=600&q=85&fit=crop',
    ];
@endphp

<style>
    .products-page {
        --product-bg: #292a28;
        --product-surface: #2e2f2d;
        --product-surface-raised: #30312f;
        --product-well: #242523;
        --product-gold: #d7b77e;
        --product-text: #eeeae1;
        --product-muted: #aaa69d;
        color: var(--product-text);
    }

    .products-page *,
    .products-page *::before,
    .products-page *::after {
        box-sizing: border-box;
    }

    /* Raised panels: soft upper-left light with deeper lower-right shadow. */
    .products-page .neu-card,
    .products-page .metric-card,
    .products-page .product-editor,
    .products-page .variant-panel {
        border: 1px solid rgba(239, 231, 215, .035);
        background:
            linear-gradient(145deg, rgba(255,255,255,.018), transparent 38%),
            linear-gradient(145deg, #30312f, #2b2c2a 76%);
        box-shadow:
            12px 13px 24px rgba(0,0,0,.30),
            4px 5px 10px rgba(0,0,0,.20),
            -7px -7px 18px rgba(255,246,226,.035),
            inset 1px 1px 0 rgba(255,255,255,.025);
    }

    .products-page .metric-card {
        position: relative;
        min-width: 0;
        overflow: hidden;
        border-radius: 22px;
        transition: transform .18s ease, box-shadow .18s ease;
    }

    .products-page .metric-card:hover {
        transform: translateY(-2px);
        box-shadow:
            15px 16px 28px rgba(0,0,0,.34),
            5px 6px 12px rgba(0,0,0,.22),
            -8px -8px 19px rgba(255,246,226,.045),
            inset 1px 1px 0 rgba(255,255,255,.03);
    }

    .products-page .product-editor,
    .products-page .variant-panel {
        min-width: 0;
        padding: 20px;
        border-radius: 22px;
    }

    /* Product cards sit above the catalog surface. */
    .products-page .catalog-card {
        display: flex;
        min-width: 0;
        flex-direction: column;
        overflow: hidden;
        border: 1px solid rgba(242,232,211,.045);
        border-radius: 19px;
        background:
            linear-gradient(145deg, rgba(255,255,255,.018), transparent 42%),
            #2e2f2d;
        box-shadow:
            9px 10px 19px rgba(0,0,0,.30),
            3px 4px 8px rgba(0,0,0,.17),
            -5px -5px 13px rgba(255,246,226,.035),
            inset 1px 1px 0 rgba(255,255,255,.025);
        transition: transform .18s ease, box-shadow .18s ease;
    }

    .products-page .catalog-card:hover {
        transform: translateY(-2px);
        box-shadow:
            12px 14px 22px rgba(0,0,0,.34),
            4px 5px 10px rgba(0,0,0,.2),
            -6px -6px 14px rgba(255,246,226,.045),
            inset 1px 1px 0 rgba(255,255,255,.03);
    }

    .products-page .catalog-photo {
        height: clamp(150px, 16vw, 183px);
        margin: 14px 14px 0;
        overflow: hidden;
        border: 1px solid rgba(255,255,255,.035);
        border-radius: 12px;
        background: #242523;
        box-shadow:
            inset 5px 5px 11px rgba(0,0,0,.48),
            inset -2px -2px 6px rgba(255,246,226,.035),
            1px 1px 0 rgba(255,255,255,.018);
    }

    .products-page .catalog-photo img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform .3s ease;
    }

    .products-page .catalog-card:hover .catalog-photo img {
        transform: scale(1.025);
    }

    /* Search and form fields are recessed into their surrounding surface. */
    .products-page .neu-input,
    .products-page .field-control {
        width: 100%;
        min-width: 0;
        border: 1px solid rgba(255,255,255,.025);
        outline: none;
        background:
            linear-gradient(145deg, rgba(0,0,0,.12), transparent 65%),
            #242523;
        color: var(--product-text);
        box-shadow:
            inset 5px 5px 10px rgba(0,0,0,.48),
            inset -3px -3px 8px rgba(255,246,226,.035),
            1px 1px 0 rgba(255,255,255,.018);
        transition: border-color .18s ease, box-shadow .18s ease;
    }

    .products-page .neu-input {
        min-height: 42px;
        padding: 10px 15px 10px 40px;
        border-radius: 999px;
        font: inherit;
        font-size: 11px;
    }

    .products-page .field-label {
        display: block;
        margin-bottom: 6px;
        color: var(--product-muted);
        font-size: 10px;
    }

    .products-page .field-control {
        min-height: 40px;
        padding: 9px 12px;
        border-radius: 11px;
        font: inherit;
        font-size: 11px;
    }

    .products-page .field-control::placeholder,
    .products-page .neu-input::placeholder {
        color: #8d8981;
        opacity: 1;
    }

    .products-page .field-control:focus,
    .products-page .neu-input:focus {
        border-color: rgba(215,183,126,.48);
        box-shadow:
            inset 5px 5px 10px rgba(0,0,0,.48),
            inset -3px -3px 8px rgba(255,246,226,.035),
            0 0 0 2px rgba(215,183,126,.09);
    }

    .products-page textarea.field-control {
        min-height: 62px;
        resize: vertical;
    }

    .products-page input[type="number"] {
        color-scheme: dark;
    }

    .products-page .filter-scroller {
        display: flex;
        max-width: 100%;
        gap: 7px;
        overflow-x: auto;
        padding: 4px 4px 8px;
        scrollbar-width: thin;
        scrollbar-color: rgba(215,183,126,.28) transparent;
    }

    .products-page .filter-scroller .filter-tab {
        flex: 0 0 auto;
        border: 1px solid rgba(255,255,255,.025);
        background: linear-gradient(145deg, #30312f, #292a28);
        box-shadow:
            4px 5px 9px rgba(0,0,0,.27),
            -3px -3px 8px rgba(255,246,226,.035),
            inset 1px 1px 0 rgba(255,255,255,.025);
        transition: box-shadow .16s ease, color .16s ease, transform .16s ease;
    }

    .products-page .filter-scroller .filter-tab:hover {
        color: var(--product-gold);
        transform: translateY(-1px);
    }

    .products-page .filter-scroller .filter-tab.active {
        color: var(--product-gold);
        box-shadow:
            inset 4px 4px 8px rgba(0,0,0,.34),
            inset -2px -2px 6px rgba(255,246,226,.025),
            1px 1px 0 rgba(255,255,255,.015);
    }

    .products-page .editor-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0,1fr));
        gap: 14px;
    }

    .products-page .lower-grid {
        display: grid;
        grid-template-columns: minmax(0,1fr) minmax(280px,.72fr);
        gap: 16px;
        align-items: start;
    }

    .products-page .variant-line {
        display: flex;
        justify-content: space-between;
        gap: 12px;
        padding: 10px 0;
        border-bottom: 1px solid rgba(245,239,225,.055);
        color: var(--product-muted);
        font-size: 11px;
    }

    .products-page .variant-line:last-child {
        border-bottom: 0;
    }

    .products-page .status-message {
        margin-bottom: 14px;
        padding: 10px 13px;
        border: 1px solid rgba(215,183,126,.18);
        border-radius: 12px;
        background: linear-gradient(145deg, rgba(215,183,126,.075), rgba(215,183,126,.035));
        color: #dfc38f;
        box-shadow:
            inset 3px 3px 7px rgba(0,0,0,.22),
            inset -2px -2px 6px rgba(255,246,226,.025);
        font-size: 11px;
    }

    .products-page .status-message ul {
        overflow-wrap: anywhere;
    }

    .products-page .product-action {
        display: inline-flex;
        min-height: 34px;
        align-items: center;
        justify-content: center;
        padding: 0 13px;
        border: 1px solid rgba(255,255,255,.025);
        border-radius: 999px;
        background: linear-gradient(145deg, #333431, #292a28);
        color: var(--product-text);
        box-shadow:
            5px 6px 11px rgba(0,0,0,.28),
            -3px -3px 8px rgba(255,246,226,.04),
            inset 1px 1px 0 rgba(255,255,255,.025);
        font: inherit;
        font-size: 10px;
        white-space: nowrap;
        cursor: pointer;
        transition: transform .15s ease, box-shadow .15s ease, color .15s ease;
    }

    .products-page .product-action:hover {
        color: var(--product-gold);
        transform: translateY(-1px);
    }

    .products-page .product-action:active {
        transform: translateY(1px);
        box-shadow:
            inset 4px 4px 8px rgba(0,0,0,.37),
            inset -2px -2px 6px rgba(255,246,226,.025);
    }

    .products-page .btn-golden {
        min-height: 38px;
        border: 1px solid rgba(255,239,203,.3);
        background: linear-gradient(145deg, #e7c98f, #d5b276);
        color: #29251d;
        box-shadow:
            5px 6px 12px rgba(0,0,0,.28),
            -3px -3px 8px rgba(255,246,226,.09),
            inset 1px 1px 0 rgba(255,255,255,.30),
            inset -1px -1px 0 rgba(116,82,34,.12);
        transition: transform .15s ease, box-shadow .15s ease, filter .15s ease;
    }

    .products-page .btn-golden:hover {
        filter: brightness(1.025);
        transform: translateY(-1px);
        box-shadow:
            7px 8px 14px rgba(0,0,0,.3),
            -3px -3px 9px rgba(255,246,226,.1),
            inset 1px 1px 0 rgba(255,255,255,.34);
    }

    .products-page .btn-golden:active {
        transform: translateY(1px);
        box-shadow:
            inset 4px 4px 8px rgba(111,78,32,.25),
            inset -2px -2px 5px rgba(255,255,255,.17);
    }

    .products-page .btn-ghost {
        min-height: 36px;
        border: 1px solid rgba(255,255,255,.025);
        background: linear-gradient(145deg, #333431, #292a28);
        color: var(--product-text);
        box-shadow:
            5px 6px 11px rgba(0,0,0,.27),
            -3px -3px 8px rgba(255,246,226,.04),
            inset 1px 1px 0 rgba(255,255,255,.025);
        transition: transform .15s ease, box-shadow .15s ease, color .15s ease;
    }

    .products-page .btn-ghost:hover {
        color: var(--product-gold);
        transform: translateY(-1px);
    }

    .products-page .btn-ghost:active {
        transform: translateY(1px);
        box-shadow:
            inset 4px 4px 8px rgba(0,0,0,.36),
            inset -2px -2px 6px rgba(255,246,226,.025);
    }

    .products-page .btn-golden:focus-visible,
    .products-page .btn-ghost:focus-visible,
    .products-page .product-action:focus-visible,
    .products-page .filter-tab:focus-visible {
        outline: 2px solid rgba(215,183,126,.75);
        outline-offset: 3px;
    }

    .products-page [hidden] {
        display: none !important;
    }

    /* Keep the shared BALHANA sidebar tactile on the Produk page. */
    body:has(.products-page) .sidebar {
        background:
            linear-gradient(145deg, rgba(255,255,255,.018), transparent 35%),
            #292a28;
        box-shadow:
            12px 12px 24px rgba(0,0,0,.34),
            -7px -7px 18px rgba(255,246,226,.035),
            inset 1px 1px 0 rgba(255,255,255,.025);
    }

    body:has(.products-page) .sidebar-item {
        border: 1px solid rgba(255,255,255,.018);
        box-shadow:
            5px 6px 11px rgba(0,0,0,.25),
            -3px -3px 8px rgba(255,246,226,.035),
            inset 1px 1px 0 rgba(255,255,255,.02);
        transition: box-shadow .16s ease, color .16s ease, transform .16s ease;
    }

    body:has(.products-page) .sidebar-item:hover {
        transform: translateY(-1px);
        box-shadow:
            7px 8px 13px rgba(0,0,0,.28),
            -4px -4px 9px rgba(255,246,226,.04),
            inset 1px 1px 0 rgba(255,255,255,.025);
    }

    body:has(.products-page) .sidebar-item.active {
        color: var(--product-gold, #d7b77e);
        box-shadow:
            inset 4px 4px 8px rgba(0,0,0,.36),
            inset -2px -2px 6px rgba(255,246,226,.025),
            1px 1px 0 rgba(255,255,255,.018);
    }

    body:has(.products-page) .neu-input,
    body:has(.products-page) .search-bar {
        background: #242523;
        box-shadow:
            inset 5px 5px 10px rgba(0,0,0,.46),
            inset -3px -3px 8px rgba(255,246,226,.035);
    }

    @media (max-width: 1000px) {
        .products-page .catalog-grid {
            grid-template-columns: repeat(2, minmax(0,1fr)) !important;
        }

        .products-page .lower-grid {
            grid-template-columns: minmax(0,1fr);
        }
    }

    @media (max-width: 700px) {
        .products-page .metric-grid {
            grid-template-columns: repeat(2, minmax(0,1fr)) !important;
        }

        .products-page .catalog-grid {
            grid-template-columns: minmax(0,1fr) !important;
        }

        .products-page .catalog-photo {
            height: 220px;
        }

        .products-page .editor-grid {
            grid-template-columns: minmax(0,1fr);
        }

        .products-page .product-editor,
        .products-page .variant-panel {
            padding: 16px;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .products-page *,
        .products-page *::before,
        .products-page *::after {
            scroll-behavior: auto !important;
            transition-duration: .01ms !important;
        }
    }
</style>

<div class="products-page">
    <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:16px;flex-wrap:wrap;margin-bottom:18px;">
        <div style="min-width:0;">
            <div class="page-breadcrumb">Ruang bisnis / September 2026</div>
            <h1 class="page-title" style="margin-bottom:4px;">Produk</h1>
            <p class="page-subtitle" style="margin-bottom:0;">Katalog internal, varian, dan harga untuk usaha reseller Anda.</p>
        </div>

        <button id="newProductButton" class="btn-golden" type="button">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                <path d="M12 5v14M5 12h14"/>
            </svg>
            Tambah Produk
        </button>
    </div>

    @if(session('status'))
        <div class="status-message" role="status">{{ session('status') }}</div>
    @endif

    @if($errors->any())
        <div class="status-message" role="alert">
            <strong>Periksa kembali data produk:</strong>
            <ul style="margin:6px 0 0;padding-left:18px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <section class="metric-grid" style="display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:12px;margin-bottom:17px;" aria-label="Ringkasan produk">
        <article class="metric-card">
            <div class="metric-label">Total produk</div>
            <div class="metric-value">{{ number_format($summary['total_products'], 0, ',', '.') }}</div>
            <div class="metric-sub">{{ $categories->count() }} kategori fashion</div>
            <svg class="metric-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                <path d="M7 7V5a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v2M5 7h14l1 14H4L5 7z"/>
            </svg>
        </article>

        <article class="metric-card">
            <div class="metric-label">Varian aktif</div>
            <div class="metric-value">{{ number_format($summary['total_variants'], 0, ',', '.') }}</div>
            <div class="metric-sub">Ukuran &amp; warna</div>
            <svg class="metric-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                <path d="m12 3 9 5-9 5-9-5 9-5z"/><path d="m3 12 9 5 9-5M3 16l9 5 9-5"/>
            </svg>
        </article>

        <article class="metric-card">
            <div class="metric-label">Stok tersedia</div>
            <div class="metric-value" style="font-size:clamp(18px,2vw,24px);">{{ number_format($summary['available_stock'], 0, ',', '.') }} pcs</div>
            <div class="metric-sub">Jumlah stok varian aktif</div>
            <svg class="metric-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                <path d="M20 12V6a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h6"/><path d="m16 18 2 2 4-4"/>
            </svg>
        </article>

        <article class="metric-card">
            <div class="metric-label">Perlu perhatian</div>
            <div class="metric-value" style="color:#d4a27f;">{{ number_format($summary['needs_attention'], 0, ',', '.') }}</div>
            <div class="metric-sub">Varian menipis atau habis</div>
            <svg class="metric-icon" style="color:#d4a27f;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                <path d="M10.3 3.9 1.8 18a2 2 0 0 0 1.7 3h16.9a2 2 0 0 0 1.7-3L13.7 3.9a2 2 0 0 0-3.4 0z"/><path d="M12 9v4M12 17h.01"/>
            </svg>
        </article>
    </section>

    <div style="display:flex;align-items:center;gap:12px;flex-wrap:wrap;margin-bottom:16px;">
        <label style="position:relative;display:block;flex:1 1 280px;min-width:min(100%,220px);">
            <svg style="position:absolute;top:50%;left:14px;transform:translateY(-50%);color:#d4b47b;pointer-events:none;" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
            </svg>
            <input id="productSearch" type="search" class="neu-input" placeholder="Cari produk, kode, atau varian..." aria-label="Cari produk, kode, atau varian" autocomplete="off">
        </label>

        <div id="productFilters" class="filter-scroller" role="group" aria-label="Filter kategori">
            <button type="button" class="filter-tab active" data-filter="semua" aria-pressed="true">Semua produk</button>
            @foreach($categories as $category)
                <button type="button" class="filter-tab" data-filter="{{ \Illuminate\Support\Str::slug($category) }}" aria-pressed="false">{{ $category }}</button>
            @endforeach
        </div>
    </div>

    <section class="neu-card" style="padding:19px;margin-bottom:16px;" aria-labelledby="catalog-title">
        <div class="section-header">
            <div>
                <h2 class="section-title" id="catalog-title">Katalog Produk</h2>
                <p class="section-subtitle">
                    <span id="visibleProductCount">{{ $products->count() }}</span>
                    dari {{ number_format($summary['total_products'], 0, ',', '.') }} produk • urutkan: paling populer
                </p>
            </div>
            <a href="#productCategory" class="section-link">Kelola kategori →</a>
        </div>

        <div id="productGrid" class="catalog-grid" style="display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:13px;margin-top:14px;">
            @foreach($products as $product)
                @php
                    $stock = (int) $product->variants->sum('stock');
                    $lowVariants = $product->variants
                        ->filter(fn ($variant) => $variant->stock <= $variant->low_stock_threshold)
                        ->count();

                    $statusText = $stock === 0 ? 'Stok habis' : ($lowVariants > 0 ? 'Stok menipis' : 'Stok aman');
                    $statusClass = $stock === 0 ? 'badge-red' : ($lowVariants > 0 ? 'badge-orange' : 'badge-green');
                    $sizes = $product->variants->pluck('size')->filter()->unique()->implode(', ');
                    $colors = $product->variants->pluck('color')->filter()->unique()->implode(', ');
                    $image = $images[$product->code] ?? $images['BLH-001'];
                    $searchText = \Illuminate\Support\Str::lower(implode(' ', [
                        $product->code,
                        $product->name,
                        $product->category,
                        $product->material,
                        $sizes,
                        $colors,
                    ]));
                @endphp

                <article
                    class="catalog-card"
                    data-product-card
                    data-category="{{ \Illuminate\Support\Str::slug($product->category ?? '') }}"
                    data-search="{{ $searchText }}"
                >
                    <div class="catalog-photo">
                        <img src="{{ $image }}" alt="{{ $product->name }}" loading="lazy">
                    </div>

                    <div style="display:flex;flex:1;flex-direction:column;padding:12px 14px 14px;">
                        <div style="margin-bottom:5px;color:#aaa69d;font-size:9px;">
                            {{ $product->code }} • {{ $product->category }}
                        </div>
                        <h3 style="margin:0 0 5px;color:#eeeae1;font-size:13px;font-weight:600;line-height:1.35;overflow-wrap:anywhere;">
                            {{ $product->name }}
                        </h3>
                        <div style="color:#aaa69d;font-size:9px;line-height:1.6;">
                            {{ $product->material ?: 'Bahan belum diatur' }} • {{ $sizes ?: 'Ukuran belum diatur' }}
                        </div>
                        <div style="margin-bottom:12px;color:#aaa69d;font-size:9px;line-height:1.6;">
                            {{ $colors ?: 'Warna belum diatur' }}
                        </div>

                        <div style="display:flex;align-items:center;justify-content:space-between;gap:8px;margin-top:auto;">
                            <span style="color:#aaa69d;font-size:10px;">{{ number_format($stock, 0, ',', '.') }} pcs</span>
                            <span style="color:#d7b77e;font-size:10px;font-weight:600;white-space:nowrap;">
                                Rp{{ number_format((float) $product->selling_price, 0, ',', '.') }}
                            </span>
                        </div>

                        <div style="display:flex;align-items:center;justify-content:space-between;gap:7px;margin-top:10px;">
                            <span class="{{ $statusClass }}">{{ $statusText }}</span>
                            <button
                                type="button"
                                class="select-product product-action"
                                data-product-id="{{ $product->id }}"
                                data-code="{{ $product->code }}"
                                data-name="{{ $product->name }}"
                                data-category-name="{{ $product->category }}"
                                data-material="{{ $product->material }}"
                                data-sizes="{{ $sizes }}"
                                data-colors="{{ $colors }}"
                                data-price="{{ $product->selling_price }}"
                                data-cost="{{ $product->purchase_price }}"
                                data-notes="{{ $product->notes }}"
                                data-update-url="{{ route('produk.update', $product) }}"
                                data-destroy-url="{{ route('produk.destroy', $product) }}"
                            >
                                {{ $loop->first ? 'Edit Produk' : 'Lihat Detail' }}
                            </button>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        <div id="emptyProducts" @if($products->isNotEmpty()) hidden @endif style="padding:30px 12px;text-align:center;color:#aaa69d;font-size:11px;">
            Belum ada produk tersimpan. Pilih <strong style="color:#d7b77e;">Tambah Produk</strong> untuk mengisi katalog.
        </div>
        <div id="noProductMatch" hidden style="padding:25px 12px;text-align:center;color:#aaa69d;font-size:11px;">
            Produk tidak ditemukan. Coba kata pencarian atau kategori lain.
        </div>
    </section>

    <section class="lower-grid">
        <article class="product-editor" id="productEditor">
            <div style="margin-bottom:16px;">
                <h2 class="section-title" id="editorTitle">{{ $selectedProduct ? 'Edit Produk' : 'Tambah Produk' }}</h2>
                <p class="section-subtitle" id="editorSubtitle">
                    @if($selectedProduct)
                        {{ $selectedProduct->code }} • {{ $selectedProduct->name }} • perubahan belum disimpan
                    @else
                        Tambahkan produk ke katalog internal BALHANA.
                    @endif
                </p>
            </div>

            <form id="productForm" method="POST" action="{{ $selectedProduct ? route('produk.update', $selectedProduct) : route('produk.store') }}">
                @csrf
                <input id="methodField" type="hidden" name="_method" value="PUT" @if(!$selectedProduct) disabled @endif>
                <input id="editingProductId" type="hidden" name="id" value="{{ old('id', $selectedProduct?->id) }}">

                <div class="editor-grid">
                    <div class="code-field" hidden>
                        <label class="field-label" for="productCode">Kode produk</label>
                        <input class="field-control" id="productCode" name="code" type="text" maxlength="50" value="{{ old('code', $selectedProduct?->code) }}" placeholder="Kosongkan untuk kode otomatis">
                        @error('code') <div style="margin-top:4px;color:#d4a18f;font-size:10px;">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <label class="field-label" for="productName">Nama produk</label>
                        <input class="field-control" id="productName" name="name" type="text" maxlength="150" required value="{{ old('name', $selectedProduct?->name) }}">
                        @error('name') <div style="margin-top:4px;color:#d4a18f;font-size:10px;">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <label class="field-label" for="productCategory">Kategori</label>
                        <input class="field-control" id="productCategory" name="category" type="text" list="categoryOptions" maxlength="80" required value="{{ old('category', $selectedProduct?->category) }}" placeholder="Pilih atau ketik kategori">
                        <datalist id="categoryOptions">
                            @foreach($categories as $category)
                                <option value="{{ $category }}">
                            @endforeach
                        </datalist>
                        @error('category') <div style="margin-top:4px;color:#d4a18f;font-size:10px;">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <label class="field-label" for="productMaterial">Bahan</label>
                        <input class="field-control" id="productMaterial" name="material" type="text" maxlength="120" value="{{ old('material', $selectedProduct?->material) }}" placeholder="Contoh: Linen premium">
                    </div>

                    <div>
                        <label class="field-label" for="productSizes">Ukuran tersedia</label>
                        <input class="field-control" id="productSizes" name="sizes" type="text" maxlength="255" value="{{ old('sizes', $selectedProduct ? $selectedProduct->variants->pluck('size')->filter()->unique()->implode(', ') : '') }}" placeholder="Contoh: M, L, XL">
                    </div>

                    <div>
                        <label class="field-label" for="productColors">Warna</label>
                        <input class="field-control" id="productColors" name="colors" type="text" maxlength="255" value="{{ old('colors', $selectedProduct ? $selectedProduct->variants->pluck('color')->filter()->unique()->implode(', ') : '') }}" placeholder="Contoh: Hitam, Cream">
                    </div>

                    <div>
                        <label class="field-label" for="productPrice">Harga jual</label>
                        <input class="field-control" id="productPrice" name="selling_price" type="number" min="0" step="1" required value="{{ old('selling_price', $selectedProduct?->selling_price) }}">
                        @error('selling_price') <div style="margin-top:4px;color:#d4a18f;font-size:10px;">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <label class="field-label" for="productCost">Harga beli</label>
                        <input class="field-control" id="productCost" name="purchase_price" type="number" min="0" step="1" required value="{{ old('purchase_price', $selectedProduct?->purchase_price) }}">
                        @error('purchase_price') <div style="margin-top:4px;color:#d4a18f;font-size:10px;">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div style="margin-top:13px;">
                    <label class="field-label" for="productNotes">Catatan produk</label>
                    <textarea class="field-control" id="productNotes" name="notes" maxlength="2000">{{ old('notes', $selectedProduct?->notes) }}</textarea>
                    @error('notes') <div style="margin-top:4px;color:#d4a18f;font-size:10px;">{{ $message }}</div> @enderror
                </div>

                <div style="display:flex;flex-wrap:wrap;gap:9px;margin-top:15px;">
                    <button id="saveProductButton" class="btn-golden" type="submit">
                        {{ $selectedProduct ? 'Simpan Perubahan' : 'Tambah Produk' }}
                    </button>
                    <button id="cancelEditButton" class="btn-ghost" type="button">Batal</button>
                    <button id="archiveProductButton" class="btn-ghost" type="button" @if(!$selectedProduct) hidden @endif>Arsipkan</button>
                </div>
            </form>

            <form id="archiveForm" method="POST" action="{{ $selectedProduct ? route('produk.destroy', $selectedProduct) : '' }}" style="display:none;">
                @csrf
                @method('DELETE')
            </form>
        </article>

        <article class="variant-panel">
            <div style="margin-bottom:12px;">
                <h2 class="section-title">Stok per Varian</h2>
                <p class="section-subtitle" id="variantSubtitle">
                    {{ $selectedProduct ? $selectedProduct->code . ' • ' . $selectedProduct->name : 'Pilih produk untuk melihat ukuran dan warna.' }}
                </p>
            </div>

            <div id="variantGroups">
                @foreach($products as $product)
                    <div data-variant-group="{{ $product->id }}" @if(!$selectedProduct || $selectedProduct->id !== $product->id) hidden @endif>
                        @forelse($product->variants as $variant)
                            <div class="variant-line">
                                <span>{{ $variant->size }} • {{ $variant->color }}</span>
                                <span style="color:{{ $variant->stock === 0 ? '#c88e7c' : ($variant->isLowStock() ? '#d7b77e' : '#eeeae1') }};">
                                    {{ number_format($variant->stock, 0, ',', '.') }} pcs
                                </span>
                            </div>
                        @empty
                            <p style="color:#aaa69d;font-size:11px;">Belum ada ukuran atau warna untuk produk ini.</p>
                        @endforelse
                    </div>
                @endforeach
            </div>

            <p id="noVariantsMessage" @if($selectedProduct && $selectedProduct->variants->isNotEmpty()) hidden @endif style="margin:0;color:#aaa69d;font-size:11px;line-height:1.6;">
                Varian akan muncul setelah produk disimpan.
            </p>

            <p style="margin:14px 0 0;color:#aaa69d;font-size:9px;line-height:1.55;">
                Stok masuk dan keluar dicatat di halaman Stok agar riwayat inventori tetap tersimpan.
            </p>
            <a href="#productSizes" id="manageVariantsLink" class="btn-ghost" style="display:inline-flex;align-items:center;justify-content:center;margin-top:14px;padding:0 14px;border-radius:999px;text-decoration:none;">
                Kelola Ukuran &amp; Warna
            </a>
        </article>
    </section>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const page = document.querySelector('.products-page');
    if (!page) return;

    const cards = Array.from(page.querySelectorAll('[data-product-card]'));
    const search = page.querySelector('#productSearch');
    const filters = page.querySelector('#productFilters');
    const count = page.querySelector('#visibleProductCount');
    const empty = page.querySelector('#emptyProducts');
    const noMatch = page.querySelector('#noProductMatch');

    let activeFilter = 'semua';

    function updateCatalog() {
        const query = search.value.trim().toLocaleLowerCase('id');
        let visible = 0;

        cards.forEach(function (card) {
            const matchesCategory = activeFilter === 'semua' || card.dataset.category === activeFilter;
            const matchesSearch = !query || (card.dataset.search || '').toLocaleLowerCase('id').includes(query);
            const show = matchesCategory && matchesSearch;

            card.hidden = !show;
            if (show) visible++;
        });

        count.textContent = String(visible);
        empty.hidden = cards.length !== 0;
        noMatch.hidden = cards.length === 0 || visible !== 0;
    }

    search.addEventListener('input', updateCatalog);

    filters.addEventListener('click', function (event) {
        const button = event.target.closest('[data-filter]');
        if (!button) return;

        activeFilter = button.dataset.filter;

        filters.querySelectorAll('[data-filter]').forEach(function (item) {
            const selected = item === button;
            item.classList.toggle('active', selected);
            item.setAttribute('aria-pressed', selected ? 'true' : 'false');
        });

        updateCatalog();
    });

    const form = page.querySelector('#productForm');
    const methodField = page.querySelector('#methodField');
    const archiveForm = page.querySelector('#archiveForm');
    const archiveButton = page.querySelector('#archiveProductButton');
    const editorTitle = page.querySelector('#editorTitle');
    const editorSubtitle = page.querySelector('#editorSubtitle');
    const saveButton = page.querySelector('#saveProductButton');
    const variantSubtitle = page.querySelector('#variantSubtitle');
    const noVariantsMessage = page.querySelector('#noVariantsMessage');

    const fields = {
        id: page.querySelector('#editingProductId'),
        code: page.querySelector('#productCode'),
        name: page.querySelector('#productName'),
        category: page.querySelector('#productCategory'),
        material: page.querySelector('#productMaterial'),
        sizes: page.querySelector('#productSizes'),
        colors: page.querySelector('#productColors'),
        price: page.querySelector('#productPrice'),
        cost: page.querySelector('#productCost'),
        notes: page.querySelector('#productNotes')
    };

    function selectProduct(button) {
        const id = button.dataset.productId;
        const name = button.dataset.name || '';
        const code = button.dataset.code || '';

        fields.id.value = id;
        fields.code.value = code;
        fields.name.value = name;
        fields.category.value = button.dataset.categoryName || '';
        fields.material.value = button.dataset.material || '';
        fields.sizes.value = button.dataset.sizes || '';
        fields.colors.value = button.dataset.colors || '';
        fields.price.value = button.dataset.price || '';
        fields.cost.value = button.dataset.cost || '';
        fields.notes.value = button.dataset.notes || '';

        form.action = button.dataset.updateUrl;
        methodField.disabled = false;
        archiveButton.hidden = false;
        archiveForm.action = button.dataset.destroyUrl;

        editorTitle.textContent = 'Edit Produk';
        editorSubtitle.textContent = code + ' • ' + name + ' • perubahan belum disimpan';
        saveButton.textContent = 'Simpan Perubahan';
        variantSubtitle.textContent = code + ' • ' + name;

        page.querySelectorAll('[data-variant-group]').forEach(function (group) {
            group.hidden = group.dataset.variantGroup !== String(id);
        });

        const activeGroup = page.querySelector('[data-variant-group="' + id + '"]');
        noVariantsMessage.hidden = Boolean(activeGroup && activeGroup.children.length > 0);

        page.querySelector('#productEditor').scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    function startNewProduct() {
        form.reset();
        form.action = @json(route('produk.store'));
        methodField.disabled = true;
        fields.id.value = '';
        archiveButton.hidden = true;
        archiveForm.action = '';

        editorTitle.textContent = 'Tambah Produk';
        editorSubtitle.textContent = 'Tambahkan produk ke katalog internal BALHANA.';
        saveButton.textContent = 'Tambah Produk';
        variantSubtitle.textContent = 'Varian produk akan ditampilkan setelah disimpan.';

        page.querySelectorAll('[data-variant-group]').forEach(function (group) {
            group.hidden = true;
        });

        noVariantsMessage.hidden = false;
        page.querySelector('#productEditor').scrollIntoView({ behavior: 'smooth', block: 'start' });
        fields.name.focus({ preventScroll: true });
    }

    page.querySelector('#newProductButton').addEventListener('click', startNewProduct);

    page.querySelectorAll('.select-product').forEach(function (button) {
        button.addEventListener('click', function () {
            selectProduct(button);
        });
    });

    page.querySelector('#cancelEditButton').addEventListener('click', function () {
        const firstProductButton = page.querySelector('.select-product');
        if (firstProductButton) {
            selectProduct(firstProductButton);
        } else {
            startNewProduct();
        }
    });

    page.querySelector('#manageVariantsLink').addEventListener('click', function () {
        window.setTimeout(function () {
            fields.sizes.focus({ preventScroll: true });
        }, 250);
    });

    archiveButton.addEventListener('click', function () {
        if (!archiveForm.action) return;

        if (window.confirm('Arsipkan produk ini dari katalog aktif? Riwayat produknya tetap disimpan.')) {
            archiveForm.submit();
        }
    });
});
</script>
@endpush