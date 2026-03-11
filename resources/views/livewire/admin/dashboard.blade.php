<div>
    <!-- Header -->
    <div class="border-b border-black/10">
        <div class="mx-auto max-w-7xl px-6 py-8">
            <h1 class="text-3xl font-semibold tracking-tight">Admin Dashboard</h1>
            <p class="mt-2 text-sm text-black/60">System overview and statistics</p>
        </div>
    </div>

    <!-- Admin Navigation -->
    <div class="border-b border-black/10 bg-black/5">
        <div class="mx-auto max-w-7xl px-6">
            <div class="flex gap-6 text-sm">
                <a href="{{ route('admin.dashboard') }}" class="py-4 border-b-2 border-black font-medium">
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
                <a href="{{ route('admin.statistics') }}" class="py-4 border-b-2 border-transparent hover:border-black/30 transition-colors">
                    Statistics
                </a>
            </div>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="mx-auto max-w-7xl px-6 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            <!-- Total Users -->
            <div class="border border-black/10 p-6">
                <h3 class="text-sm font-medium text-black/60 mb-2">Total Users</h3>
                <p class="text-3xl font-semibold">{{ $stats['total_users'] }}</p>
                <div class="mt-2 text-xs text-black/60">
                    {{ $stats['admin_users'] }} admins • {{ $stats['player_users'] }} players
                </div>
            </div>

            <!-- Total Items -->
            <div class="border border-black/10 p-6">
                <h3 class="text-sm font-medium text-black/60 mb-2">Total Items</h3>
                <p class="text-3xl font-semibold">{{ $stats['total_items'] }}</p>
            </div>

            <!-- Total Trades -->
            <div class="border border-black/10 p-6">
                <h3 class="text-sm font-medium text-black/60 mb-2">Total Trades</h3>
                <p class="text-3xl font-semibold">{{ $stats['total_trades'] }}</p>
                <div class="mt-2 text-xs text-black/60">
                    {{ $stats['pending_trades'] }} pending
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="border border-black/10 p-6">
                <h3 class="text-sm font-medium text-black/60 mb-3">Quick Actions</h3>
                <div class="space-y-2">
                    <a href="{{ route('admin.users.create') }}" class="block text-sm hover:text-black/60 transition-colors">
                        + Create User
                    </a>
                    <a href="{{ route('admin.items.create') }}" class="block text-sm hover:text-black/60 transition-colors">
                        + Create Item
                    </a>
                </div>
            </div>
        </div>

        <!-- Items by Type -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="border border-black/10 p-6">
                <h2 class="text-xl font-semibold mb-4">Items by Type</h2>
                <div class="space-y-3">
                    @foreach($stats['items_by_type'] as $type => $count)
                        <div class="flex justify-between items-center">
                            <span class="text-sm capitalize">{{ $type }}</span>
                            <span class="text-sm font-semibold">{{ $count }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Items by Rarity -->
            <div class="border border-black/10 p-6">
                <h2 class="text-xl font-semibold mb-4">Items by Rarity</h2>
                <div class="space-y-3">
                    @foreach($stats['items_by_rarity'] as $rarity => $count)
                        <div class="flex justify-between items-center">
                            <span class="text-sm capitalize">{{ $rarity }}</span>
                            <span class="text-sm font-semibold">{{ $count }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
