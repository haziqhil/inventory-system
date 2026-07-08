<x-layouts::app :title="__('Add Product')">
    <div class="max-w-xl">

        <flux:heading size="xl" class="mb-6">Add Product</flux:heading>

        <form action="{{ route('products.store') }}" method="POST" class="flex flex-col gap-4">
            @csrf

            <flux:field>
                <flux:label>Name</flux:label>
                <flux:input name="name" value="{{ old('name') }}" />
                <flux:error name="name" />
            </flux:field>

            <flux:field>
                <flux:label>SKU</flux:label>
                <flux:input name="sku" value="{{ old('sku') }}" />
                <flux:error name="sku" />
            </flux:field>

            <flux:field>
                <flux:label>Price (RM)</flux:label>
                <flux:input type="number" step="0.01" name="price" value="{{ old('price') }}" />
                <flux:error name="price" />
            </flux:field>

            <flux:field>
                <flux:label>Stock Quantity</flux:label>
                <flux:input type="number" name="stock_quantity" value="{{ old('stock_quantity') }}" />
                <flux:error name="stock_quantity" />
            </flux:field>

            <div class="flex gap-2 mt-2">
                <flux:button type="submit" variant="primary">Save Product</flux:button>
                <flux:button href="{{ route('products.index') }}" variant="ghost">Cancel</flux:button>
            </div>
        </form>

    </div>
</x-layouts::app>