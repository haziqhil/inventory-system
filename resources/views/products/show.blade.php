<x-layouts::app :title="__('Product Details')">
    <div class="max-w-xl">

        <div class="flex items-center justify-between mb-6">
            <flux:heading size="xl">{{ $product->name }}</flux:heading>
            <flux:button href="{{ route('products.index') }}" variant="ghost">Back to Products</flux:button>
        </div>

        <div class="flex flex-col gap-3 rounded-xl border border-neutral-200 dark:border-neutral-700 p-6">
            <div>
                <span class="text-neutral-500 text-sm">SKU</span>
                <p>{{ $product->sku }}</p>
            </div>
            <div>
                <span class="text-neutral-500 text-sm">Price</span>
                <p>RM {{ number_format($product->price, 2) }}</p>
            </div>
            <div>
                <span class="text-neutral-500 text-sm">Stock Quantity</span>
                <p>{{ $product->stock_quantity }}</p>
            </div>
        </div>

        <flux:heading size="lg" class="mt-8 mb-4">Order History</flux:heading>

        <div class="overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <table class="w-full text-left">
                <thead class="border-b border-neutral-200 dark:border-neutral-700">
                    <tr>
                        <th class="py-3 px-4">Order #</th>
                        <th class="py-3 px-4">Customer</th>
                        <th class="py-3 px-4">Quantity</th>
                        <th class="py-3 px-4">Price at Purchase</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($product->orderItems as $item)
                        <tr class="border-b border-neutral-100 dark:border-neutral-800">
                            <td class="py-3 px-4">#{{ $item->order->id }}</td>
                            <td class="py-3 px-4">{{ $item->order->customer_name }}</td>
                            <td class="py-3 px-4">{{ $item->quantity }}</td>
                            <td class="py-3 px-4">RM {{ number_format($item->price_at_purchase, 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-6 px-4 text-neutral-500">No orders yet for this product.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</x-layouts::app>