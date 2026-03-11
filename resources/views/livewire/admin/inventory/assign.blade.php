<div>
    <!-- Header -->
    <div class="border-b border-black/10">
        <div class="mx-auto max-w-7xl px-6 py-8">
            <h1 class="text-3xl font-semibold tracking-tight">Assign Items</h1>
            <p class="mt-2 text-sm text-black/60">Give items to players as rewards or restore lost items</p>
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
                <a href="{{ route('admin.items.index') }}" class="py-4 border-b-2 border-transparent hover:border-black/30 transition-colors">
                    Items
                </a>
                <a href="{{ route('admin.inventory.assign') }}" class="py-4 border-b-2 border-black font-medium">
                    Assign Items
                </a>
                <a href="{{ route('admin.statistics') }}" class="py-4 border-b-2 border-transparent hover:border-black/30 transition-colors">
                    Statistics
                </a>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="mx-auto max-w-4xl px-6 py-12">
        @if(session()->has('success'))
            <div class="mb-6 p-4 bg-black/5 border border-black/20">
                {{ session('success') }}
            </div>
        @endif

        @if(session()->has('error'))
            <div class="mb-6 p-4 bg-black/5 border border-black/30 text-black/80">
                {{ session('error') }}
            </div>
        @endif

        <form wire:submit="assignItem" class="space-y-6">
            <!-- Select Player -->
            <div class="border border-black/10 p-6">
                <h2 class="text-xl font-semibold mb-4">Select Player</h2>
                
                @error('userId')
                    <div class="mb-4 p-3 bg-black/5 border border-black/20 text-sm">
                        {{ $message }}
                    </div>
                @enderror

                <select 
                    wire:model.live="userId"
                    class="w-full px-3 py-2 border border-black/20 focus:border-black focus:ring-1 focus:ring-black"
                >
                    <option value="">Choose a player...</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->username }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Select Item -->
            <div class="border border-black/10 p-6">
                <h2 class="text-xl font-semibold mb-4">Select Item</h2>
                
                @error('itemId')
                    <div class="mb-4 p-3 bg-black/5 border border-black/20 text-sm">
                        {{ $message }}
                    </div>
                @enderror

                <select 
                    wire:model.live="itemId"
                    class="w-full px-3 py-2 border border-black/20 focus:border-black focus:ring-1 focus:ring-black mb-4"
                >
                    <option value="">Choose an item...</option>
                    @foreach($items as $item)
                        <option value="{{ $item->id }}">
                            {{ $item->name }} ({{ ucfirst($item->type) }} - {{ ucfirst($item->rarity) }})
                        </option>
                    @endforeach
                </select>

                @if($itemId)
                    @php
                        $selectedItem = $items->firstWhere('id', $itemId);
                    @endphp
                    
                    @if($selectedItem)
                        <div class="border border-black/10 p-4 bg-black/5">
                            <h3 class="font-semibold mb-2">{{ $selectedItem->name }}</h3>
                            <p class="text-sm text-black/60 capitalize mb-2">
                                {{ $selectedItem->type }} • {{ $selectedItem->rarity }}
                            </p>
                            @if($selectedItem->stats)
                                <div class="grid grid-cols-2 gap-2 text-sm">
                                    <div><span class="text-black/60">Power:</span> {{ $selectedItem->stats->power }}</div>
                                    <div><span class="text-black/60">Speed:</span> {{ $selectedItem->stats->speed }}</div>
                                    <div><span class="text-black/60">Durability:</span> {{ $selectedItem->stats->durability }}</div>
                                    <div><span class="text-black/60">Magic:</span> {{ $selectedItem->stats->magic }}</div>
                                </div>
                            @endif
                        </div>
                    @endif
                @endif
            </div>

            <!-- Submit -->
            <div class="flex justify-end">
                <button 
                    type="submit"
                    wire:confirm="Are you sure you want to assign this item to the selected player?"
                    class="px-6 py-3 text-sm font-medium bg-black text-white hover:bg-black/80 transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
                    wire:loading.attr="disabled"
                    wire:loading.class="opacity-50"
                    @disabled(!$userId || !$itemId)
                >
                    <span wire:loading.remove>Assign Item to Player</span>
                    <span wire:loading>Assigning...</span>
                </button>
            </div>
        </form>
    </div>
</div>
