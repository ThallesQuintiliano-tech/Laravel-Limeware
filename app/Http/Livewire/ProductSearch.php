<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;

class ProductSearch extends Component
{
    public $search = '';
    public $selectedCategory = '';
    public $selectedBrand = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'selectedCategory' => ['except' => ''],
        'selectedBrand' => ['except' => ''],
    ];

    public function clearFilters()
    {
        $this->reset(['search', 'selectedCategory', 'selectedBrand']);
    }

    public function search()
    {
        // O Livewire já atualiza o render com os valores deferidos ao submeter o form
    }

    public function render()
    {
        $products = Product::query()
            ->when($this->search, fn($q) => $q->where('name', 'like', "%{$this->search}%"))
            ->when($this->selectedCategory, fn($q) => $q->where('category_id', $this->selectedCategory))
            ->when($this->selectedBrand, fn($q) => $q->where('brand_id', $this->selectedBrand))
            ->with(['category', 'brand'])
            ->paginate(10);

        return view('livewire.product-search', [
            'products' => $products,
            'categories' => Category::all(),
            'brands' => Brand::all(),
        ]);
    }
}
