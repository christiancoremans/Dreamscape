<div>
    <!-- Header -->
    <div class="border-b border-black/10">
        <div class="mx-auto max-w-7xl px-6 py-8">
            <h1 class="text-3xl font-semibold tracking-tight">My Inventory</h1>
            <p class="mt-2 text-sm text-black/60">Your collected items</p>
        </div>
    </div>

    <!-- Filters & Sort -->
    <div class="border-b border-black/10 bg-white">
        <div class="mx-auto max-w-7xl px-6 py-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <!-- Search -->
                <div>
                    <label class="block text-sm font-medium mb-2">Search</label>
                    <input
                        type="text"
                        wire:model.live.debounce.300ms="search"
                        placeholder="Search items..."
                        class="w-full px-3 py-2 border border-black/20 focus:border-black focus:ring-1 focus:ring-black"
                    >
                </div>

                <!-- Type Filter -->
                <div>
                    <label class="block text-sm font-medium mb-2">Type</label>
                    <select
                        wire:model.live="typeFilter"
                        class="w-full px-3 py-2 border border-black/20 focus:border-black focus:ring-1 focus:ring-black"
                    >
                        <option value="">All Types</option>
                        <option value="weapon">Weapon</option>
                        <option value="armor">Armor</option>
                        <option value="consumable">Consumable</option>
                        <option value="accessory">Accessory</option>
                    </select>
                </div>

                <!-- Sort By -->
                <div>
                    <label class="block text-sm font-medium mb-2">Sort By</label>
                    <select
                        wire:model.live="sortBy"
                        class="w-full px-3 py-2 border border-black/20 focus:border-black focus:ring-1 focus:ring-black"
                    >
                        <option value="name">Name</option>
                        <option value="type">Type</option>
                        <option value="acquired">Date Acquired</option>
                    </select>
                </div>

                <!-- Reset Button -->
                <div class="flex items-end">
                    <button
                        wire:click="resetFilters"
                        class="px-4 py-2 text-sm font-medium border border-black/20 hover:bg-black/5 transition-colors"
                    >
                        Reset Filters
                    </button>
                </div>
            </div>

            <!-- Stat Filters -->
            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Power -->
                <div>
                    <label class="block text-sm font-medium mb-2">
                        Power ({{ $minPower }} - {{ $maxPower }})
                    </label>
                    <div class="flex gap-2">
                        <input
                            type="range"
                            wire:model.live="minPower"
                            min="0"
                            max="100"
                            class="flex-1"
                        >
                        <input
                            type="range"
                            wire:model.live="maxPower"
                            min="0"
                            max="100"
                            class="flex-1"
                        >
                    </div>
                </div>

                <!-- Speed -->
                <div>
                    <label class="block text-sm font-medium mb-2">
                        Speed ({{ $minSpeed }} - {{ $maxSpeed }})
                    </label>
                    <div class="flex gap-2">
                        <input
                            type="range"
                            wire:model.live="minSpeed"
                            min="0"
                            max="100"
                            class="flex-1"
                        >
                        <input
                            type="range"
                            wire:model.live="maxSpeed"
                            min="0"
                            max="100"
                            class="flex-1"
                        >
                    </div>
                </div>

                <!-- Durability -->
                <div>
                    <label class="block text-sm font-medium mb-2">
                        Durability ({{ $minDurability }} - {{ $maxDurability }})
                    </label>
                    <div class="flex gap-2">
                        <input
                            type="range"
                            wire:model.live="minDurability"
                            min="0"
                            max="100"
                            class="flex-1"
                        >
                        <input
                            type="range"
                            wire:model.live="maxDurability"
                            min="0"
                            max="100"
                            class="flex-1"
                        >
                    </div>
                </div>

                <!-- Magic -->
                <div>
                    <label class="block text-sm font-medium mb-2">
                        Magic ({{ $minMagic }} - {{ $maxMagic }})
                    </label>
                    <div class="flex gap-2">
                        <input
                            type="range"
                            wire:model.live="minMagic"
                            min="0"
                            max="100"
                            class="flex-1"
                        >
                        <input
                            type="range"
                            wire:model.live="maxMagic"
                            min="0"
                            max="100"
                            class="flex-1"
                        >
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Inventory Grid -->
    <div class="mx-auto max-w-7xl px-6 py-12">
        @if($inventories->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($inventories as $inventory)
                    <div class="border border-black/10 p-6">
                        <!-- Item Name -->
                        <a
                            href="{{ route('items.show', $inventory->item) }}"
                            class="block"
                        >
                            <h3 class="text-lg font-semibold hover:text-black/60 transition-colors">
                                {{ $inventory->item->name }}
                            </h3>
                        </a>

                        <!-- Type -->
                        <p class="mt-2 text-sm text-black/60 capitalize">
                            {{ $inventory->item->type }}
                        </p>

                        <!-- Rarity Badge -->
                        <div class="mt-4">
                            <span class="inline-block px-3 py-1 text-xs font-medium border border-black/20 capitalize">
                                {{ $inventory->item->rarity }}
                            </span>
                        </div>

                        <!-- Stats Preview -->
                        @if($inventory->item->stats)
                            <div class="mt-4 grid grid-cols-2 gap-2 text-xs">
                                <div>
                                    <span class="text-black/60">Power:</span>
                                    <span class="font-medium">{{ $inventory->item->stats->power }}</span>
                                </div>
                                <div>
                                    <span class="text-black/60">Speed:</span>
                                    <span class="font-medium">{{ $inventory->item->stats->speed }}</span>
                                </div>
                                <div>
                                    <span class="text-black/60">Durability:</span>
                                    <span class="font-medium">{{ $inventory->item->stats->durability }}</span>
                                </div>
                                <div>
                                    <span class="text-black/60">Magic:</span>
                                    <span class="font-medium">{{ $inventory->item->stats->magic }}</span>
                                </div>
                            </div>
                        @endif

                        <!-- Acquired Date -->
                        <div class="mt-4 pt-4 border-t border-black/10">
                            <p class="text-xs text-black/60">
                                Acquired: {{ $inventory->acquired_at->format('M d, Y') }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12 border border-black/10 p-12">
                <p class="text-lg font-medium mb-2">Your inventory is empty</p>
                <p class="text-sm text-black/60 mb-6">You haven't collected any items yet.</p>
                <a
                    href="{{ route('items.index') }}"
                    class="inline-block px-6 py-3 text-sm font-medium bg-black text-white hover:bg-black/80 transition-colors"
                >
                    Browse Items
                </a>
            </div>
        @endif

        <!-- Pagination -->
        <div class="mt-8">
            {{ $inventories->links() }}
        </div>
    </div>
</div>
