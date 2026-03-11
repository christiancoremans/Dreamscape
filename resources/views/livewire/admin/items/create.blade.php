<div>
    <!-- Header -->
    <div class="border-b border-black/10">
        <div class="mx-auto max-w-7xl px-6 py-8">
            <a 
                href="{{ route('admin.items.index') }}" 
                class="inline-flex items-center text-sm font-medium hover:text-black/60 transition-colors mb-4"
            >
                ← Back to Items
            </a>
            <h1 class="text-3xl font-semibold tracking-tight">Create New Item</h1>
            <p class="mt-2 text-sm text-black/60">Add a new item with statistics</p>
        </div>
    </div>

    <!-- Form -->
    <div class="mx-auto max-w-4xl px-6 py-12">
        <form wire:submit="createItem" class="space-y-8">
            <!-- Basic Info -->
            <div class="border border-black/10 p-6">
                <h2 class="text-xl font-semibold mb-4">Basic Information</h2>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium mb-2">Name</label>
                        <input 
                            type="text" 
                            wire:model="name"
                            class="w-full px-3 py-2 border border-black/20 focus:border-black focus:ring-1 focus:ring-black"
                            placeholder="Enter item name"
                        >
                        @error('name') <p class="mt-1 text-sm text-black/60">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-2">Description</label>
                        <textarea 
                            wire:model="description"
                            rows="3"
                            class="w-full px-3 py-2 border border-black/20 focus:border-black focus:ring-1 focus:ring-black"
                            placeholder="Enter item description (optional)"
                        ></textarea>
                        @error('description') <p class="mt-1 text-sm text-black/60">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-2">Type</label>
                            <select 
                                wire:model="type"
                                class="w-full px-3 py-2 border border-black/20 focus:border-black focus:ring-1 focus:ring-black"
                            >
                                <option value="weapon">Weapon</option>
                                <option value="armor">Armor</option>
                                <option value="consumable">Consumable</option>
                                <option value="accessory">Accessory</option>
                            </select>
                            @error('type') <p class="mt-1 text-sm text-black/60">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Rarity</label>
                            <select 
                                wire:model="rarity"
                                class="w-full px-3 py-2 border border-black/20 focus:border-black focus:ring-1 focus:ring-black"
                            >
                                <option value="common">Common</option>
                                <option value="uncommon">Uncommon</option>
                                <option value="rare">Rare</option>
                                <option value="epic">Epic</option>
                                <option value="legendary">Legendary</option>
                            </select>
                            @error('rarity') <p class="mt-1 text-sm text-black/60">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistics -->
            <div class="border border-black/10 p-6">
                <h2 class="text-xl font-semibold mb-4">Statistics (0-100)</h2>
                
                <div class="space-y-6">
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <label class="text-sm font-medium">Power</label>
                            <span class="text-sm font-semibold">{{ $power }}</span>
                        </div>
                        <input 
                            type="range" 
                            wire:model.live="power"
                            min="0" 
                            max="100"
                            class="w-full"
                        >
                        @error('power') <p class="mt-1 text-sm text-black/60">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <label class="text-sm font-medium">Speed</label>
                            <span class="text-sm font-semibold">{{ $speed }}</span>
                        </div>
                        <input 
                            type="range" 
                            wire:model.live="speed"
                            min="0" 
                            max="100"
                            class="w-full"
                        >
                        @error('speed') <p class="mt-1 text-sm text-black/60">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <label class="text-sm font-medium">Durability</label>
                            <span class="text-sm font-semibold">{{ $durability }}</span>
                        </div>
                        <input 
                            type="range" 
                            wire:model.live="durability"
                            min="0" 
                            max="100"
                            class="w-full"
                        >
                        @error('durability') <p class="mt-1 text-sm text-black/60">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <label class="text-sm font-medium">Magic</label>
                            <span class="text-sm font-semibold">{{ $magic }}</span>
                        </div>
                        <input 
                            type="range" 
                            wire:model.live="magic"
                            min="0" 
                            max="100"
                            class="w-full"
                        >
                        @error('magic') <p class="mt-1 text-sm text-black/60">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex justify-end gap-4">
                <a 
                    href="{{ route('admin.items.index') }}"
                    class="px-6 py-3 text-sm font-medium border border-black/20 hover:bg-black/5 transition-colors"
                >
                    Cancel
                </a>
                <button 
                    type="submit"
                    class="px-6 py-3 text-sm font-medium bg-black text-white hover:bg-black/80 transition-colors"
                >
                    Create Item
                </button>
            </div>
        </form>
    </div>
</div>
