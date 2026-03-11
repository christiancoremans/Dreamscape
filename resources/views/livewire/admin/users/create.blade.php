<div>
    <!-- Header -->
    <div class="border-b border-black/10">
        <div class="mx-auto max-w-7xl px-6 py-8">
            <a 
                href="{{ route('admin.users.index') }}" 
                class="inline-flex items-center text-sm font-medium hover:text-black/60 transition-colors mb-4"
            >
                ← Back to Users
            </a>
            <h1 class="text-3xl font-semibold tracking-tight">Create New User</h1>
            <p class="mt-2 text-sm text-black/60">Add a new user to the system</p>
        </div>
    </div>

    <!-- Form -->
    <div class="mx-auto max-w-2xl px-6 py-12">
        <form wire:submit="createUser" class="space-y-6">
            <!-- Username -->
            <div>
                <label class="block text-sm font-medium mb-2">Username</label>
                <input 
                    type="text" 
                    wire:model="username"
                    class="w-full px-3 py-2 border border-black/20 focus:border-black focus:ring-1 focus:ring-black"
                    placeholder="Enter username"
                >
                @error('username')
                    <p class="mt-1 text-sm text-black/60">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label class="block text-sm font-medium mb-2">Password</label>
                <input 
                    type="password" 
                    wire:model="password"
                    class="w-full px-3 py-2 border border-black/20 focus:border-black focus:ring-1 focus:ring-black"
                    placeholder="Minimum 8 characters"
                >
                @error('password')
                    <p class="mt-1 text-sm text-black/60">{{ $message }}</p>
                @enderror
            </div>

            <!-- Role -->
            <div>
                <label class="block text-sm font-medium mb-2">Role</label>
                <select 
                    wire:model="role"
                    class="w-full px-3 py-2 border border-black/20 focus:border-black focus:ring-1 focus:ring-black"
                >
                    <option value="player">Player</option>
                    <option value="admin">Admin</option>
                </select>
                @error('role')
                    <p class="mt-1 text-sm text-black/60">{{ $message }}</p>
                @enderror
            </div>

            <!-- Actions -->
            <div class="flex justify-end gap-4 pt-4">
                <a 
                    href="{{ route('admin.users.index') }}"
                    class="px-6 py-3 text-sm font-medium border border-black/20 hover:bg-black/5 transition-colors"
                >
                    Cancel
                </a>
                <button 
                    type="submit"
                    class="px-6 py-3 text-sm font-medium bg-black text-white hover:bg-black/80 transition-colors"
                >
                    Create User
                </button>
            </div>
        </form>
    </div>
</div>
