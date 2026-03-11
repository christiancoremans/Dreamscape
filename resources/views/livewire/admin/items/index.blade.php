<div>
    <!-- Header -->
    <div class="border-b border-black/10">
        <div class="mx-auto max-w-7xl px-6 py-8">
            <h1 class="text-3xl font-semibold tracking-tight">Items Management</h1>
            <p class="mt-2 text-sm text-black/60">View, create, edit, and delete items</p>
        </div>
    </div>

    <!-- Admin Navigation -->
    <div class="border-b border-black/10 bg-black/5">
        <div class="mx-auto max-w-7xl px-6">
            <div class="flex gap-6 text-sm">
                <a href="{{ route('admin.dashboard') }}" class="py-4 border-b-2 border-transparent hover:border-black/30 transition-colors">
                    Dashboard
                </a>
                <a href="{{ route('admin.users.index') }}" class="py-4 border-b-2 border-transparent hover:border-black/30 transition-colors">
                    Users
                </a>
                <a href="{{ route('admin.items.index') }}" class="py-4 border-b-2 border-black font-medium">
                    Items
                </a>
                <a href="{{ route('admin.inventory.assign') }}" class="py-4 border-b-2 border-transparent hover:border-black/30 transition-colors">
                    Assign Items
                </a>
                <a href="{{ route('admin.statistics') }}" class="py-4 border-b-2 border-transparent hover:border-black/30 transition-colors">
                    Statistics
                </a>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="mx-auto max-w-7xl px-6 py-12">
        @if(session()->has('success'))
            <div class="mb-6 p-4 bg-black/5 border border-black/20">
                {{ session('success') }}
            </div>
        @endif

        <!-- Filters & Actions -->
        <div class="mb-6 flex justify-between items-center gap-4">
            <div class="flex gap-4 flex-1">
                <input 
                    type="text" 
                    wire:model.live.debounce.300ms="search"
                    placeholder="Search items..."
                    class="flex-1 max-w-md px-3 py-2 border border-black/20 focus:border-black focus:ring-1 focus:ring-black"
                >
                <select 
                    wire:model.live="typeFilter"
                    class="px-3 py-2 border border-black/20 focus:border-black focus:ring-1 focus:ring-black"
                >
                    <option value="">All Types</option>
                    <option value="weapon">Weapon</option>
                    <option value="armor">Armor</option>
                    <option value="consumable">Consumable</option>
                    <option value="accessory">Accessory</option>
                </select>
            </div>
            <a 
                href="{{ route('admin.items.create') }}"
                class="px-6 py-2 text-sm font-medium bg-black text-white hover:bg-black/80 transition-colors"
            >
                Create Item
            </a>
        </div>

        <!-- Items Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($items as $item)
                <div class="border border-black/10 p-6">
                    <div class="flex justify-between items-start mb-3">
                        <h3 class="text-lg font-semibold">{{ $item->name }}</h3>
                        <div class="flex gap-2">
                            <a 
                                href="{{ route('admin.items.edit', $item) }}"
                                class="text-xs px-2 py-1 border border-black/20 hover:bg-black/5 transition-colors"
                            >
                                Edit
                            </a>
                            <button 
                                wire:click="deleteItem({{ $item->id }})"
                                wire:confirm="Are you sure you want to delete this item? This action cannot be undone."
                                class="text-xs px-2 py-1 border border-black/20 hover:bg-black/5 transition-colors"
                            >
                                Delete
                            </button>
                        </div>
                    </div>

                    <p class="text-sm text-black/60 capitalize mb-2">{{ $item->type }}</p>
                    
                    <div class="inline-block px-2 py-1 text-xs border border-black/20 capitalize mb-4">
                        {{ $item->rarity }}
                    </div>

                    @if($item->description)
                        <p class="text-sm text-black/80 mb-4 line-clamp-2">{{ $item->description }}</p>
                    @endif

                    @if($item->stats)
                        <div class="grid grid-cols-2 gap-2 text-sm">
                            <div><span class="text-black/60">Power:</span> {{ $item->stats->power }}</div>
                            <div><span class="text-black/60">Speed:</span> {{ $item->stats->speed }}</div>
                            <div><span class="text-black/60">Durability:</span> {{ $item->stats->durability }}</div>
                            <div><span class="text-black/60">Magic:</span> {{ $item->stats->magic }}</div>
                        </div>
                    @endif
                </div>
            @empty
                <div class="col-span-full text-center py-12 border border-black/10">
                    <p class="text-black/60">No items found</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $items->links() }}
        </div>
    </div>
</div>
