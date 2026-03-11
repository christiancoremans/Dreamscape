<div>
    <!-- Header -->
    <div class="border-b border-black/10">
        <div class="mx-auto max-w-7xl px-6 py-8">
            <h1 class="text-3xl font-semibold tracking-tight">Items</h1>
            <p class="mt-2 text-sm text-black/60">Browse all available items</p>
        </div>
    </div>

    <!-- Filters -->
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

    <!-- Items Grid -->
    <div class="mx-auto max-w-7xl px-6 py-12">
        @if($items->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($items as $item)
                    <a
                        href="{{ route('items.show', $item) }}"
                        class="block border border-black/10 hover:border-black/30 transition-colors p-6 group"
                    >
                        <!-- Item Name -->
                        <h3 class="text-lg font-semibold group-hover:text-black/60 transition-colors">
                            {{ $item->name }}
                        </h3>

                        <!-- Type -->
                        <p class="mt-2 text-sm text-black/60 capitalize">
                            {{ $item->type }}
                        </p>

                        <!-- Rarity Badge -->
                        <div class="mt-4">
                            <span class="inline-block px-3 py-1 text-xs font-medium border border-black/20 capitalize">
                                {{ $item->rarity }}
                            </span>
                        </div>

                        <!-- Stats Preview -->
                        @if($item->stats)
                            <div class="mt-4 grid grid-cols-2 gap-2 text-xs">
                                <div>
                                    <span class="text-black/60">Power:</span>
                                    <span class="font-medium">{{ $item->stats->power }}</span>
                                </div>
                                <div>
                                    <span class="text-black/60">Speed:</span>
                                    <span class="font-medium">{{ $item->stats->speed }}</span>
                                </div>
                                <div>
                                    <span class="text-black/60">Durability:</span>
                                    <span class="font-medium">{{ $item->stats->durability }}</span>
                                </div>
                                <div>
                                    <span class="text-black/60">Magic:</span>
                                    <span class="font-medium">{{ $item->stats->magic }}</span>
                                </div>
                            </div>
                        @endif
                    </a>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <p class="text-black/60">No items found matching your filters.</p>
            </div>
        @endif

        <!-- Pagination -->
        <div class="mt-8">
            {{ $items->links() }}
        </div>
    </div>
</div>
