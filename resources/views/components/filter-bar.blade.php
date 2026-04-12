<form method="GET" action="{{ $action }}" class="flex gap-4 mb-10">

    {{-- SEARCH --}}
    <div class="relative flex-1 max-w-sm shadow-sm">
        <i data-lucide="search" class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 w-5 h-5"></i>

        <input type="text" name="search" value="{{ request('search') }}" placeholder="{{ $placeholder ?? 'Cari...' }}"
            class="w-full pl-12 pr-4 py-3.5 rounded-xl border-none focus:ring-2 focus:ring-[#004d4d] outline-none">
    </div>

    {{-- FILTER DROPDOWN --}}
    @if (isset($filters))
        @foreach ($filters as $filter)
            <div class="relative">
                <select name="{{ $filter['name'] }}"
                    class="appearance-none bg-white px-5 py-3.5 pr-10 rounded-xl border-none shadow-sm focus:ring-2 focus:ring-[#004d4d] cursor-pointer">

                    <option value="">Semua {{ $filter['label'] }}</option>

                    @foreach ($filter['options'] as $key => $value)
                        <option value="{{ $key }}" {{ request($filter['name']) == $key ? 'selected' : '' }}>
                            {{ $value }}
                        </option>
                    @endforeach
                </select>

                {{-- ICON DROPDOWN --}}
                <i data-lucide="chevron-down"
                    class="absolute right-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-700 pointer-events-none"></i>
            </div>
        @endforeach
    @endif


    {{-- BUTTON CARI --}}
    <button type="submit"
        class="bg-[#004d4d] px-8 py-3.5 rounded-xl text-white font-bold shadow-sm hover:bg-[#003d3d] transition-all duration-300">
        Cari
    </button>

</form>
