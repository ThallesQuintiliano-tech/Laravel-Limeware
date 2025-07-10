<div style="max-width: 600px; margin: 0 auto;">
    <form wire:submit.prevent="search" style="margin-bottom: 20px;">
        <div style="margin-bottom: 10px;">
            <input
                type="text"
                wire:model.defer="search"
                placeholder="Buscar por nome do produto"
                style="width: 100%; padding: 8px;"
            >
        </div>

        <div style="margin-bottom: 10px;">
            <label for="category">Categoria:</label>
            <select id="category" wire:model.defer="selectedCategory" style="width: 100%; padding: 8px;">
                <option value="">Todas as categorias</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div style="margin-bottom: 10px;">
            <label for="brand">Marca:</label>
            <select id="brand" wire:model.defer="selectedBrand" style="width: 100%; padding: 8px;">
                <option value="">Todas as marcas</option>
                @foreach($brands as $brand)
                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <button type="submit" style="padding: 8px 16px;">Buscar</button>
            <button type="button" wire:click="clearFilters" style="padding: 8px 16px;">Limpar Filtros</button>
        </div>
    </form>

    <ul>
        @forelse($products as $product)
            <li>
                <strong>{{ $product->name }}</strong> -
                {{ $product->brand->name ?? 'Sem marca' }} -
                {{ $product->category->name ?? 'Sem categoria' }}
            </li>
        @empty
            <li>Nenhum produto encontrado.</li>
        @endforelse
    </ul>

    <div style="margin-top: 20px;">
        {{ $products->links() }}
    </div>
</div>