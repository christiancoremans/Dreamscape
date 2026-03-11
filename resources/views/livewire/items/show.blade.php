<div>
    <!-- Header -->
    <div class="border-b border-black/10">
        <div class="mx-auto max-w-7xl px-6 py-8">
            <a
                href="{{ route('items.index') }}"
                class="inline-flex items-center text-sm font-medium hover:text-black/60 transition-colors mb-4"
            >
                ← Back to Items
            </a>
            <h1 class="text-3xl font-semibold tracking-tight">{{ $item->name }}</h1>
            <div class="mt-2 flex items-center gap-4">
                <span class="inline-block px-3 py-1 text-sm font-medium border border-black/20 capitalize">
                    {{ $item->rarity }}
                </span>
                <span class="text-sm text-black/60 capitalize">{{ $item->type }}</span>
            </div>
        </div>
    </div>

    <!-- Item Details -->
    <div class="mx-auto max-w-4xl px-6 py-12">
        <div class="border border-black/10 p-8">
            <!-- Description -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold mb-3">Description</h2>
                <p class="text-black/80 leading-relaxed">
                    {{ $item->description ?: 'No description available.' }}
                </p>
            </div>

            <!-- Stats -->
            @if($item->stats)
                <div>
                    <h2 class="text-xl font-semibold mb-6">Statistics</h2>
                    <div class="space-y-6">
                        <!-- Power -->
                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-sm font-medium">Power</span>
                                <span class="text-sm font-semibold">{{ $item->stats->power }}</span>
                            </div>
                            <div class="h-2 bg-black/5 border border-black/10">
                                <div
                                    class="h-full bg-black transition-all"
                                    style="width: {{ $item->stats->power }}%"
                                ></div>
                            </div>
                        </div>

                        <!-- Speed -->
                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-sm font-medium">Speed</span>
                                <span class="text-sm font-semibold">{{ $item->stats->speed }}</span>
                            </div>
                            <div class="h-2 bg-black/5 border border-black/10">
                                <div
                                    class="h-full bg-black transition-all"
                                    style="width: {{ $item->stats->speed }}%"
                                ></div>
                            </div>
                        </div>

                        <!-- Durability -->
                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-sm font-medium">Durability</span>
                                <span class="text-sm font-semibold">{{ $item->stats->durability }}</span>
                            </div>
                            <div class="h-2 bg-black/5 border border-black/10">
                                <div
                                    class="h-full bg-black transition-all"
                                    style="width: {{ $item->stats->durability }}%"
                                ></div>
                            </div>
                        </div>

                        <!-- Magic -->
                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-sm font-medium">Magic</span>
                                <span class="text-sm font-semibold">{{ $item->stats->magic }}</span>
                            </div>
                            <div class="h-2 bg-black/5 border border-black/10">
                                <div
                                    class="h-full bg-black transition-all"
                                    style="width: {{ $item->stats->magic }}%"
                                ></div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
