<div>
    <!-- Header -->
    <div class="border-b border-black/10">
        <div class="mx-auto max-w-7xl px-6 py-8">
            <h1 class="text-3xl font-semibold tracking-tight">Users Management</h1>
            <p class="mt-2 text-sm text-black/60">View and manage all users</p>
        </div>
    </div>

    <!-- Admin Navigation -->
    <div class="border-b border-black/10 bg-black/5">
        <div class="mx-auto max-w-7xl px-6">
            <div class="flex gap-6 text-sm">
                <a href="{{ route('admin.dashboard') }}" class="py-4 border-b-2 border-transparent hover:border-black/30 transition-colors">
                    Dashboard
                </a>
                <a href="{{ route('admin.users.index') }}" class="py-4 border-b-2 border-black font-medium">
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
                    placeholder="Search users..."
                    class="flex-1 max-w-md px-3 py-2 border border-black/20 focus:border-black focus:ring-1 focus:ring-black"
                >
                <select 
                    wire:model.live="roleFilter"
                    class="px-3 py-2 border border-black/20 focus:border-black focus:ring-1 focus:ring-black"
                >
                    <option value="">All Roles</option>
                    <option value="admin">Admin</option>
                    <option value="player">Player</option>
                </select>
            </div>
            <a 
                href="{{ route('admin.users.create') }}"
                class="px-6 py-2 text-sm font-medium bg-black text-white hover:bg-black/80 transition-colors"
            >
                Create User
            </a>
        </div>

        <!-- Users Table -->
        <div class="border border-black/10">
            <table class="w-full">
                <thead class="border-b border-black/10 bg-black/5">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Username</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Role</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Created</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Items</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-black/10">
                    @forelse($users as $user)
                        <tr class="hover:bg-black/5 transition-colors">
                            <td class="px-6 py-4 text-sm">{{ $user->username }}</td>
                            <td class="px-6 py-4 text-sm">
                                <span class="inline-block px-2 py-1 text-xs border border-black/20 capitalize
                                    {{ $user->role === 'admin' ? 'bg-black text-white' : '' }}">
                                    {{ $user->role }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-black/60">
                                {{ $user->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 text-sm text-black/60">
                                {{ $user->inventories()->count() }} items
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-black/60">
                                No users found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $users->links() }}
        </div>
    </div>
</div>
