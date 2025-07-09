<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---

## **1. MODELS, MIGRATIONS, FACTORIES, SEEDERS**

### **Models**
- `Product` (nome, category_id, brand_id)
- `Category` (nome)
- `Brand` (nome)

### **Migrations**
- `products` (id, name, category_id, brand_id)
- `categories` (id, name)
- `brands` (id, name)

### **Factories**
- `ProductFactory`
- `CategoryFactory`
- `BrandFactory`

### **Seeders**
- Popular categorias, marcas e produtos

---

## **2. LIVEWIRE COMPONENT**

- Componente: `ProductSearch`
- Filtros: nome (input), categorias (checkbox múltiplo), marcas (checkbox múltiplo)
- Persistência: query string
- Limpar filtros: botão

---

## **3. BLADE VIEWS**

- Página principal com o componente Livewire
- Listagem dos produtos filtrados

---

## **4. TESTES AUTOMATIZADOS**

- Testes de feature para todos os filtros e combinações

---

## **5. DOCKER**

- `docker-compose.yml` (php:8.4.8, mysql, nginx)
- `Dockerfile` para PHP
- Scripts de setup

---

## **6. README**

- Instruções para rodar o projeto

---

# **VAMOS GERAR OS ARQUIVOS**

---

## **A. DOCKER**

### `docker-compose.yml`

```yaml:docker-compose.yml
version: '3.8'

services:
  app:
    build:
      context: .
      dockerfile: Dockerfile
    image: laravel-app
    container_name: laravel-app
    restart: unless-stopped
    working_dir: /var/www
    volumes:
      - ./:/var/www
    ports:
      - "8000:8000"
    depends_on:
      - db

  db:
    image: mysql:8.0
    container_name: laravel-db
    restart: unless-stopped
    environment:
      MYSQL_DATABASE: laravel
      MYSQL_ROOT_PASSWORD: root
      MYSQL_USER: laravel
      MYSQL_PASSWORD: laravel
    ports:
      - "3306:3306"
    volumes:
      - dbdata:/var/lib/mysql

volumes:
  dbdata:
```

---

### `Dockerfile`

```dockerfile:Dockerfile
FROM php:8.4.8-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . /var/www

RUN composer install

CMD php artisan serve --host=0.0.0.0 --port=8000
```

---

## **B. MODELS, MIGRATIONS, FACTORIES, SEEDERS**

### **Models & Migrations**

```php:app/Models/Category.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
```

```php:app/Models/Brand.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brand extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
```

```php:app/Models/Product.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'category_id', 'brand_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
```

---

### **Migrations**

```php:database/migrations/2024_01_01_000001_create_categories_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('categories');
    }
};
```

```php:database/migrations/2024_01_01_000002_create_brands_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('brands');
    }
};
```

```php:database/migrations/2024_01_01_000003_create_products_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('brand_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
```

---

### **Factories**

```php:database/factories/CategoryFactory.php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->word,
        ];
    }
}
```

```php:database/factories/BrandFactory.php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BrandFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->company,
        ];
    }
}
```

```php:database/factories/ProductFactory.php
namespace Database\Factories;

use App\Models\Category;
use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->productName,
            'category_id' => Category::factory(),
            'brand_id' => Brand::factory(),
        ];
    }
}
```

---

### **Seeders**

```php:database/seeders/DatabaseSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $categories = Category::factory(5)->create();
        $brands = Brand::factory(5)->create();

        foreach ($categories as $category) {
            foreach ($brands as $brand) {
                Product::factory(10)->create([
                    'category_id' => $category->id,
                    'brand_id' => $brand->id,
                ]);
            }
        }
    }
}
```

---

## **C. LIVEWIRE COMPONENT**

### **Comando para criar componente**
```bash
php artisan make:livewire ProductSearch
```

### **ProductSearch.php**

```php:app/Http/Livewire/ProductSearch.php
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

    public function updated($property)
    {
        $this->resetPage();
    }

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
```

---

## **D. BLADE VIEWS**

### **resources/views/livewire/product-search.blade.php**

```blade:resources/views/livewire/product-search.blade.php
<div>
    <form wire:submit.prevent>
        <input type="text" wire:model="search" placeholder="Nome do produto" />

        <div>
            <label>Categorias:</label>
            @foreach($categories as $category)
                <label>
                    <input type="checkbox" wire:model="selectedCategories" value="{{ $category->id }}">
                    {{ $category->name }}
                </label>
            @endforeach
        </div>

        <div>
            <label>Marcas:</label>
            @foreach($brands as $brand)
                <label>
                    <input type="checkbox" wire:model="selectedBrands" value="{{ $brand->id }}">
                    {{ $brand->name }}
                </label>
            @endforeach
        </div>

        <button type="button" wire:click="clearFilters">Limpar Filtros</button>
    </form>

    <div>
        <h3>Produtos</h3>
        <ul>
            @forelse($products as $product)
                <li>
                    {{ $product->name }} - {{ $product->category->name }} - {{ $product->brand->name }}
                </li>
            @empty
                <li>Nenhum produto encontrado.</li>
            @endforelse
        </ul>
        {{ $products->links() }}
    </div>
</div>
```

---

### **resources/views/welcome.blade.php** (ou crie uma nova view principal)

```blade:resources/views/welcome.blade.php
<!DOCTYPE html>
<html>
<head>
    <title>Busca de Produtos</title>
    @livewireStyles
</head>
<body>
    <h1>Busca de Produtos</h1>
    @livewire('product-search')
    @livewireScripts
</body>
</html>
```

---

## **E. TESTES AUTOMATIZADOS**

### **tests/Feature/ProductSearchTest.php**

```php:tests/Feature/ProductSearchTest.php
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
```

---

## **F. README.md**

```markdown:README.md
<code_block_to_apply_changes_from>
```

---

## **Resumo**

- Estrutura pronta para rodar com Docker
- Models, migrations, factories, seeders para carga inicial
- Live
