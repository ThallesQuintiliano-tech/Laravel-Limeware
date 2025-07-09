<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

class ProductSearch extends Component
{
    public $search = '';
    public $selectedCategories = [];
    public $selectedBrands = [];

    protected $queryString = [
        'search' => ['except' => ''],
        'selectedCategories' => ['except' => []],
        'selectedBrands' => ['except' => []],
    ];

    public function clearFilters()
    {
        $this->reset(['search', 'selectedCategories', 'selectedBrands']);
    }

    public function render()
    {
        $products = Product::query()
            ->when($this->search, fn($q) => $q->where('name', 'like', "%{$this->search}%"))
            ->when($this->selectedCategories, fn($q) => $q->whereIn('category_id', $this->selectedCategories))
            ->when($this->selectedBrands, fn($q) => $q->whereIn('brand_id', $this->selectedBrands))
            ->with(['category', 'brand'])
            ->paginate(10);

        return view('livewire.product-search', [
            'products' => $products,
            'categories' => Category::all(),
            'brands' => Brand::all(),
        ]);
    }
}
