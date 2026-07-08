<x-layouts::app :title="__('Products')">
    <div class="flex flex-col gap-4">

        <div class="flex items-center justify-between">
            <flux:heading size="xl">Products</flux:heading>
            <flux:button href="{{ route('products.create') }}" variant="primary">
                + Add Product
            </flux:button>
        </div>

        @if (session('success'))
            <div class="p-4 bg-green-100 text-green-800 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <table class="w-full text-left">
                <thead class="border-b border-neutral-200 dark:border-neutral-700">
                    <tr>
                        <th class="py-3 px-4">Name</th>
                        <th class="py-3 px-4">SKU</th>
                        <th class="py-3 px-4">Price</th>
                        <th class="py-3 px-4">Stock</th>
                        <th class="py-3 px-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr class="border-b border-neutral-100 dark:border-neutral-800">
                            <td class="py-3 px-4">{{ $product->name }}</td>
                            <td class="py-3 px-4">{{ $product->sku }}</td>
                            <td class="py-3 px-4">RM {{ number_format($product->price, 2) }}</td>
                            <td class="py-3 px-4">{{ $product->stock_quantity }}</td>
                            <td class="py-3 px-4 space-x-2">
                                <flux:button href="{{ route('products.show', $product) }}" size="sm">View</flux:button>
                                <flux:button href="{{ route('products.edit', $product) }}" size="sm">Edit</flux:button>
                                <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline" onsubmit="return confirm('Delete this product?')">
                                    @csrf
                                    @method('DELETE')
                                    <flux:button type="submit" size="sm" variant="danger">Delete</flux:button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-6 px-4 text-neutral-500">No products yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</x-layouts::app>