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
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-semibold tracking-tight">Trade Details</h1>
                    <p class="mt-2 text-sm text-black/60">
                        Between {{ $trade->sender->username }} and {{ $trade->receiver->username }}
                    </p>
                </div>
                <span class="inline-block px-4 py-2 text-sm font-medium border border-black/20 capitalize
                    {{ $trade->status === 'pending' ? 'bg-black/5' : '' }}
                    {{ $trade->status === 'accepted' ? 'bg-black text-white' : '' }}
                    {{ $trade->status === 'rejected' ? 'border-black/40 text-black/60' : '' }}
                    {{ $trade->status === 'cancelled' ? 'border-black/40 text-black/60' : '' }}
                ">
                    {{ $trade->status }}
                </span>
            </div>
        </div>
    </div>

    <!-- Flash Messages -->
    @if(session()->has('success'))
        <div class="mx-auto max-w-7xl px-6 pt-6">
            <div class="p-4 bg-black/5 border border-black/20 text-sm">
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if(session()->has('error'))
        <div class="mx-auto max-w-7xl px-6 pt-6">
            <div class="p-4 bg-black/5 border border-black/30 text-sm text-black/80">
                {{ session('error') }}
            </div>
        </div>
    @endif

    <!-- Trade Content -->
    <div class="mx-auto max-w-7xl px-6 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Sender's Items -->
            <div class="border border-black/10 p-6">
                <h2 class="text-xl font-semibold mb-4">
                    {{ $trade->sender->username }}'s Offer
                    @if($trade->sender_id === auth()->id())
                        <span class="text-sm font-normal text-black/60">(You)</span>
                    @endif
                </h2>

                @php
                    $senderItems = $trade->tradeItems->where('offered_by_user_id', $trade->sender_id);
                @endphp

                @if($senderItems->count() > 0)                    <div class="space-y-4">
                        @foreach($senderItems as $tradeItem)
                            <div class="border border-black/10 p-4">
                                <h3 class="font-semibold mb-2">{{ $tradeItem->item->name }}</h3>
                                <p class="text-sm text-black/60 capitalize mb-2">{{ $tradeItem->item->type }}</p>
                                <div class="inline-block px-2 py-1 text-xs border border-black/20 capitalize mb-3">
                                    {{ $tradeItem->item->rarity }}
                                </div>
                                @if($tradeItem->item->stats)
                                    <div class="grid grid-cols-2 gap-2 text-sm">
                                        <div><span class="text-black/60">Power:</span> {{ $tradeItem->item->stats->power }}</div>
                                        <div><span class="text-black/60">Speed:</span> {{ $tradeItem->item->stats->speed }}</div>
                                        <div><span class="text-black/60">Durability:</span> {{ $tradeItem->item->stats->durability }}</div>
                                        <div><span class="text-black/60">Magic:</span> {{ $tradeItem->item->stats->magic }}</div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-black/60 text-sm">No items offered</p>
                @endif
            </div>

            <!-- Receiver's Items -->
            <div class="border border-black/10 p-6">
                <h2 class="text-xl font-semibold mb-4">
                    {{ $trade->receiver->username }}'s Offer
                    @if($trade->receiver_id === auth()->id())
                        <span class="text-sm font-normal text-black/60">(You)</span>
                    @endif
                </h2>

                @php
                    $receiverItems = $trade->tradeItems->where('offered_by_user_id', $trade->receiver_id);
                @endphp

                @if($receiverItems->count() > 0)
                    <div class="space-y-4">
                        @foreach($receiverItems as $tradeItem)
                            <div class="border border-black/10 p-4">
                                <h3 class="font-semibold mb-2">{{ $tradeItem->item->name }}</h3>
                                <p class="text-sm text-black/60 capitalize mb-2">{{ $tradeItem->item->type }}</p>
                                <div class="inline-block px-2 py-1 text-xs border border-black/20 capitalize mb-3">
                                    {{ $tradeItem->item->rarity }}
                                </div>
                                @if($tradeItem->item->stats)
                                    <div class="grid grid-cols-2 gap-2 text-sm">
                                        <div><span class="text-black/60">Power:</span> {{ $tradeItem->item->stats->power }}</div>
                                        <div><span class="text-black/60">Speed:</span> {{ $tradeItem->item->stats->speed }}</div>
                                        <div><span class="text-black/60">Durability:</span> {{ $tradeItem->item->stats->durability }}</div>
                                        <div><span class="text-black/60">Magic:</span> {{ $tradeItem->item->stats->magic }}</div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @elseif($trade->receiver_id === auth()->id() && $trade->status === 'pending')
                    <p class="text-black/60 text-sm mb-4">You can add items to counter-offer (optional)</p>
                    
                    @if($this->receiverInventory->count() > 0)
                        <div class="space-y-2 max-h-96 overflow-y-auto">
                            @foreach($this->receiverInventory as $inventory)
                                <div 
                                    wire:click="toggleItem({{ $inventory->id }})"
                                    class="border p-3 cursor-pointer transition-colors text-sm {{ in_array($inventory->id, $selectedItems) ? 'border-black bg-black/5' : 'border-black/10 hover:border-black/30' }}"
                                >
                                    <div class="flex items-center gap-2 mb-1">
                                        <div class="w-3 h-3 border border-black/20 flex items-center justify-center flex-shrink-0">
                                            @if(in_array($inventory->id, $selectedItems))
                                                <div class="w-1.5 h-1.5 bg-black"></div>
                                            @endif
                                        </div>
                                        <h3 class="font-semibold">{{ $inventory->item->name }}</h3>
                                    </div>
                                    <p class="text-xs text-black/60 capitalize ml-5">{{ $inventory->item->type }} • {{ $inventory->item->rarity }}</p>
                                </div>
                            @endforeach
                        </div>
                    @endif
                @else
                    <p class="text-black/60 text-sm">No items offered</p>
                @endif
            </div>
        </div>

        <!-- Actions -->
        @if($trade->status === 'pending')
            <div class="mt-8 flex justify-end gap-4">
                @if($trade->sender_id === auth()->id())
                    <!-- Sender can only cancel -->
                    <button 
                        wire:click="cancelTrade"
                        wire:confirm="Are you sure you want to cancel this trade?"
                        class="px-6 py-3 text-sm font-medium border border-black/20 hover:bg-black/5 transition-colors"
                    >
                        Cancel Trade
                    </button>
                @else
                    <!-- Receiver can accept or reject -->
                    <button 
                        wire:click="rejectTrade"
                        wire:confirm="Are you sure you want to reject this trade?"
                        class="px-6 py-3 text-sm font-medium border border-black/20 hover:bg-black/5 transition-colors"
                    >
                        Reject Trade
                    </button>
                    <button 
                        wire:click="acceptTrade"
                        wire:confirm="Are you sure you want to accept this trade? Items will be transferred immediately."
                        class="px-6 py-3 text-sm font-medium bg-black text-white hover:bg-black/80 transition-colors"
                    >
                        Accept Trade
                    </button>
                @endif
            </div>
        @else
            <div class="mt-8 p-4 border border-black/10 text-center text-sm text-black/60">
                This trade has been {{ $trade->status }}.
                @if($trade->status === 'accepted')
                    Items have been transferred to their new owners.
                @else
                    No items were transferred.
                @endif
            </div>
        @endif

        <!-- Trade Info -->
        <div class="mt-8 pt-8 border-t border-black/10 text-sm text-black/60">
            <p>Trade created: {{ $trade->created_at->format('M d, Y \a\t H:i') }}</p>
            @if($trade->updated_at != $trade->created_at)
                <p>Last updated: {{ $trade->updated_at->format('M d, Y \a\t H:i') }}</p>
            @endif
        </div>
    </div>
</div>
