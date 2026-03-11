<div>
    <!-- Header -->
    <div class="border-b border-black/10">
        <div class="mx-auto max-w-7xl px-6 py-8">
            <h1 class="text-3xl font-semibold tracking-tight">Game Statistics</h1>
            <p class="mt-2 text-sm text-black/60">Analyze game economy and player behavior</p>
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
                <a href="{{ route('admin.inventory.assign') }}" class="py-4 border-b-2 border-transparent hover:border-black/30 transition-colors">
                    Assign Items
                </a>
                <a href="{{ route('admin.statistics') }}" class="py-4 border-b-2 border-black font-medium">
                    Statistics
                </a>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="mx-auto max-w-7xl px-6 py-12 space-y-8">
        <!-- Items Per Type -->
        <div class="border border-black/10 p-6">
            <h2 class="text-xl font-semibold mb-4">Items Distribution by Type</h2>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="border-b border-black/10">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-semibold">Type</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold">Total Items</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold">Unique Owners</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold">Total Owned</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-black/10">
                        @foreach($stats['items_per_type'] as $typeData)
                            <tr>
                                <td class="px-4 py-3 text-sm capitalize font-medium">{{ $typeData->type }}</td>
                                <td class="px-4 py-3 text-sm">{{ $typeData->item_count }}</td>
                                <td class="px-4 py-3 text-sm">{{ $typeData->player_count }} players</td>
                                <td class="px-4 py-3 text-sm">{{ $typeData->total_owned }} instances</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Most Owned Items -->
        <div class="border border-black/10 p-6">
            <h2 class="text-xl font-semibold mb-4">Most Popular Items</h2>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="border-b border-black/10">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-semibold">Item</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold">Type</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold">Rarity</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold">Owners</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-black/10">
                        @forelse($stats['most_owned_items'] as $item)
                            <tr>
                                <td class="px-4 py-3 text-sm font-medium">{{ $item->name }}</td>
                                <td class="px-4 py-3 text-sm capitalize">{{ $item->type }}</td>
                                <td class="px-4 py-3 text-sm">
                                    <span class="inline-block px-2 py-1 text-xs border border-black/20 capitalize">
                                        {{ $item->rarity }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm">{{ $item->ownership_count }} players</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-8 text-center text-black/60">
                                    No ownership data available
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Rarity Distribution -->
        <div class="border border-black/10 p-6">
            <h2 class="text-xl font-semibold mb-4">Items by Rarity</h2>
            <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                @foreach($stats['rarity_distribution'] as $rarity)
                    <div class="border border-black/10 p-4 text-center">
                        <p class="text-2xl font-semibold mb-1">{{ $rarity->count }}</p>
                        <p class="text-sm text-black/60 capitalize">{{ $rarity->rarity }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Average Stats by Type -->
        <div class="border border-black/10 p-6">
            <h2 class="text-xl font-semibold mb-4">Average Statistics by Item Type</h2>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="border-b border-black/10">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-semibold">Type</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold">Avg Power</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold">Avg Speed</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold">Avg Durability</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold">Avg Magic</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-black/10">
                        @foreach($stats['avg_stats_by_type'] as $typeStats)
                            <tr>
                                <td class="px-4 py-3 text-sm capitalize font-medium">{{ $typeStats->type }}</td>
                                <td class="px-4 py-3 text-sm">{{ number_format($typeStats->avg_power ?? 0, 1) }}</td>
                                <td class="px-4 py-3 text-sm">{{ number_format($typeStats->avg_speed ?? 0, 1) }}</td>
                                <td class="px-4 py-3 text-sm">{{ number_format($typeStats->avg_durability ?? 0, 1) }}</td>
                                <td class="px-4 py-3 text-sm">{{ number_format($typeStats->avg_magic ?? 0, 1) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Top Collectors -->
        <div class="border border-black/10 p-6">
            <h2 class="text-xl font-semibold mb-4">Top Collectors</h2>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="border-b border-black/10">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-semibold">Rank</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold">Player</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold">Items Owned</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-black/10">
                        @forelse($stats['top_collectors'] as $index => $collector)
                            <tr>
                                <td class="px-4 py-3 text-sm font-semibold">{{ $index + 1 }}</td>
                                <td class="px-4 py-3 text-sm">{{ $collector->username }}</td>
                                <td class="px-4 py-3 text-sm">{{ $collector->item_count }} items</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-4 py-8 text-center text-black/60">
                                    No player data available
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
