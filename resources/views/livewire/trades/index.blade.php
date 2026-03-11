<div>
    <!-- Header -->
    <div class="border-b border-black/10">
        <div class="mx-auto max-w-7xl px-6 py-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-semibold tracking-tight">My Trades</h1>
                    <p class="mt-2 text-sm text-black/60">View and manage your trade requests</p>
                </div>
                <a 
                    href="{{ route('trades.create') }}"
                    class="px-6 py-3 text-sm font-medium bg-black text-white hover:bg-black/80 transition-colors"
                >
                    Start New Trade
                </a>
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

    <!-- Filters -->
    <div class="border-b border-black/10">
        <div class="mx-auto max-w-7xl px-6 py-4">
            <div class="flex gap-4">
                <button 
                    wire:click="setFilter('all')"
                    class="px-4 py-2 text-sm font-medium {{ $filter === 'all' ? 'bg-black text-white' : 'border border-black/20 hover:bg-black/5' }} transition-colors"
                >
                    All Trades
                </button>
                <button 
                    wire:click="setFilter('sent')"
                    class="px-4 py-2 text-sm font-medium {{ $filter === 'sent' ? 'bg-black text-white' : 'border border-black/20 hover:bg-black/5' }} transition-colors"
                >
                    Sent
                </button>
                <button 
                    wire:click="setFilter('received')"
                    class="px-4 py-2 text-sm font-medium {{ $filter === 'received' ? 'bg-black text-white' : 'border border-black/20 hover:bg-black/5' }} transition-colors"
                >
                    Received
                </button>
                <button 
                    wire:click="setFilter('pending')"
                    class="px-4 py-2 text-sm font-medium {{ $filter === 'pending' ? 'bg-black text-white' : 'border border-black/20 hover:bg-black/5' }} transition-colors"
                >
                    Pending Action
                </button>
            </div>
        </div>
    </div>

    <!-- Trades List -->
    <div class="mx-auto max-w-7xl px-6 py-12">
        @if($trades->count() > 0)
            <div class="space-y-4">
                @foreach($trades as $trade)
                    <a 
                        href="{{ route('trades.show', $trade) }}"
                        class="block border border-black/10 hover:border-black/30 transition-colors p-6"
                    >
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center gap-4 mb-2">
                                    <!-- Trade Type -->
                                    @if($trade->sender_id === auth()->id())
                                        <span class="text-sm font-medium">To: <span class="font-semibold">{{ $trade->receiver->username }}</span></span>
                                    @else
                                        <span class="text-sm font-medium">From: <span class="font-semibold">{{ $trade->sender->username }}</span></span>
                                    @endif

                                    <!-- Status Badge -->
                                    <span class="inline-block px-3 py-1 text-xs font-medium border border-black/20 capitalize
                                        {{ $trade->status === 'pending' ? 'bg-black/5' : '' }}
                                        {{ $trade->status === 'accepted' ? 'bg-black text-white' : '' }}
                                        {{ $trade->status === 'rejected' ? 'border-black/40 text-black/60' : '' }}
                                        {{ $trade->status === 'cancelled' ? 'border-black/40 text-black/60' : '' }}
                                    ">
                                        {{ $trade->status }}
                                    </span>
                                </div>

                                <!-- Items -->
                                <div class="mt-4">
                                    <p class="text-sm text-black/60 mb-2">Items in trade:</p>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($trade->tradeItems as $tradeItem)
                                            <div class="inline-flex items-center gap-2 px-3 py-1 border border-black/10 text-xs">
                                                <span class="font-medium">{{ $tradeItem->item->name }}</span>
                                                <span class="text-black/60">
                                                    ({{ $tradeItem->offeredBy->id === auth()->id() ? 'You' : $tradeItem->offeredBy->username }})
                                                </span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Date -->
                                <p class="mt-3 text-xs text-black/60">
                                    {{ $trade->created_at->format('M d, Y \a\t H:i') }}
                                </p>
                            </div>

                            <!-- Action Indicator -->
                            @if($trade->status === 'pending' && $trade->receiver_id === auth()->id())
                                <div class="text-right">
                                    <span class="text-sm font-medium text-black">Action Required →</span>
                                </div>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $trades->links() }}
            </div>
        @else
            <div class="text-center py-12 border border-black/10 p-12">
                <p class="text-lg font-medium mb-2">No trades found</p>
                <p class="text-sm text-black/60 mb-6">
                    @if($filter === 'pending')
                        You have no pending trade requests.
                    @elseif($filter === 'sent')
                        You haven't sent any trade requests yet.
                    @elseif($filter === 'received')
                        You haven't received any trade requests yet.
                    @else
                        Start trading with other players!
                    @endif
                </p>
                <a 
                    href="{{ route('trades.create') }}"
                    class="inline-block px-6 py-3 text-sm font-medium bg-black text-white hover:bg-black/80 transition-colors"
                >
                    Start New Trade
                </a>
            </div>
        @endif
    </div>
</div>
