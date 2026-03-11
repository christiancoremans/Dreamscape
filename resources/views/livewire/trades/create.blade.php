<div>
    <!-- Header -->
    <div class="border-b border-black/10">
        <div class="mx-auto max-w-7xl px-6 py-8">
            <a 
                href="{{ route('trades.index') }}" 
                class="inline-flex items-center text-sm font-medium hover:text-black/60 transition-colors mb-4"
            >
                ← Back to Trades
            </a>
            <h1 class="text-3xl font-semibold tracking-tight">Start New Trade</h1>
            <p class="mt-2 text-sm text-black/60">Select a player and items to trade</p>
        </div>
    </div>

    <!-- Form -->
    <div class="mx-auto max-w-7xl px-6 py-12">
        <form wire:submit="createTrade" class="space-y-8">
            <!-- Select Receiver -->
            <div class="border border-black/10 p-6">
                <h2 class="text-xl font-semibold mb-4">Select Trading Partner</h2>
                
                @error('receiverId')
                    <div class="mb-4 p-3 bg-black/5 border border-black/20 text-sm text-black/80">
                        {{ $message }}
                    </div>
                @enderror

                <select 
                    wire:model.live="receiverId"
                    class="w-full md:w-1/2 px-3 py-2 border border-black/20 focus:border-black focus:ring-1 focus:ring-black"
                >
                    <option value="">Choose a player...</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->username }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Select Items -->
            <div class="border border-black/10 p-6">
                <h2 class="text-xl font-semibold mb-4">Select Items to Offer</h2>
                
                @error('selectedItems')
                    <div class="mb-4 p-3 bg-black/5 border border-black/20 text-sm text-black/80">
                        {{ $message }}
                    </div>
                @enderror

                @if($myItems->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                        @foreach($myItems as $inventory)
                            <div 
                                wire:click="toggleItem({{ $inventory->id }})"
                                class="border p-4 cursor-pointer transition-colors {{ in_array($inventory->id, $selectedItems) ? 'border-black bg-black/5' : 'border-black/10 hover:border-black/30' }}"
                            >
                                <div class="flex items-center gap-2 mb-2">
                                    <div class="w-4 h-4 border border-black/20 flex items-center justify-center">
                                        @if(in_array($inventory->id, $selectedItems))
                                            <div class="w-2 h-2 bg-black"></div>
                                        @endif
                                    </div>
                                    <h3 class="text-sm font-semibold">{{ $inventory->item->name }}</h3>
                                </div>

                                <p class="text-xs text-black/60 capitalize mb-2">{{ $inventory->item->type }}</p>

                                <div class="inline-block px-2 py-1 text-xs border border-black/20 capitalize mb-3">
                                    {{ $inventory->item->rarity }}
                                </div>

                                @if($inventory->item->stats)
                                    <div class="grid grid-cols-2 gap-1 text-xs">
                                        <div><span class="text-black/60">Power:</span> {{ $inventory->item->stats->power }}</div>
                                        <div><span class="text-black/60">Speed:</span> {{ $inventory->item->stats->speed }}</div>
                                        <div><span class="text-black/60">Durability:</span> {{ $inventory->item->stats->durability }}</div>
                                        <div><span class="text-black/60">Magic:</span> {{ $inventory->item->stats->magic }}</div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    @if(count($selectedItems) > 0)
                        <div class="mt-4 text-sm text-black/60">
                            {{ count($selectedItems) }} item{{ count($selectedItems) !== 1 ? 's' : '' }} selected
                        </div>
                    @endif
                @else
                    <div class="text-center py-12 border border-black/10 p-12">
                        <p class="text-lg font-medium mb-2">Your inventory is empty</p>
                        <p class="text-sm text-black/60 mb-6">You need items in your inventory to trade.</p>
                        <a 
                            href="{{ route('items.index') }}"
                            class="inline-block px-6 py-3 text-sm font-medium bg-black text-white hover:bg-black/80 transition-colors"
                        >
                            Browse Items
                        </a>
                    </div>
                @endif
            </div>

            <!-- Submit -->
            @if($myItems->count() > 0)
                <div class="flex justify-end gap-4">
                    <a 
                        href="{{ route('trades.index') }}"
                        class="px-6 py-3 text-sm font-medium border border-black/20 hover:bg-black/5 transition-colors"
                    >
                        Cancel
                    </a>
                    <button 
                        type="submit"
                        class="px-6 py-3 text-sm font-medium bg-black text-white hover:bg-black/80 transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
                        :disabled="!receiverId || selectedItems.length === 0"
                    >
                        Send Trade Request
                    </button>
                </div>
            @endif
        </form>
    </div>
</div>
