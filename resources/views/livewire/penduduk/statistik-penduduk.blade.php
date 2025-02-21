<div class="flex flex-col w-full gap-4 xl:gap-6">
    <div class="w-full">
        <label for="region" class="sr-only">Rentang Usia</label>
        <select id="region" name="region" wire:model="selectedRegion" wire:change="onRegionChange"
            class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
            <option value="">Semua Kabupaten/Kota</option>
            @foreach ($regions as $item)
                <option value="{{ $item['region_name'] }}"
                    {{ request('region') == $item['region_name'] ? 'selected' : '' }}>
                    {{ $item['region_name'] }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="grid grid-cols-12 gap-4 md:gap-6">
        <div class="col-span-12 xl:col-span-4">
            <x-chart.penduduk.pie-chart :data="$genderPercentage" :dataFooter="$populationCount" />
        </div>
        <div class="col-span-12 space-y-6 xl:col-span-8">
            <x-chart.penduduk.bar-chart :data="[]" />
        </div>
    </div>
</div>
