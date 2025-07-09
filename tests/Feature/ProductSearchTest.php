namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Livewire\Livewire;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductSearchTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_search_by_name()
    {
        $product = Product::first();
        Livewire::test('product-search')
            ->set('search', $product->name)
            ->assertSee($product->name);
    }

    public function test_search_by_category()
    {
        $category = Category::first();
        Livewire::test('product-search')
            ->set('selectedCategories', [$category->id])
            ->assertSee($category->name);
    }

    public function test_search_by_brand()
    {
        $brand = Brand::first();
        Livewire::test('product-search')
            ->set('selectedBrands', [$brand->id])
            ->assertSee($brand->name);
    }

    public function test_search_by_multiple_categories_and_brands()
    {
        $categories = Category::pluck('id')->take(2)->toArray();
        $brands = Brand::pluck('id')->take(2)->toArray();
        Livewire::test('product-search')
            ->set('selectedCategories', $categories)
            ->set('selectedBrands', $brands)
            ->assertStatus(200);
    }

    public function test_clear_filters()
    {
        Livewire::test('product-search')
            ->set('search', 'test')
            ->set('selectedCategories', [1])
            ->set('selectedBrands', [1])
            ->call('clearFilters')
            ->assertSet('search', '')
            ->assertSet('selectedCategories', [])
            ->assertSet('selectedBrands', []);
    }
} 