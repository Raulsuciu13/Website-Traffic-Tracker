<div class="px-4 sm:px-6 lg:px-8">
    <div class="sm:flex sm:items-center">
      <div class="sm:flex-auto">
        <h1 class="text-base font-semibold leading-6 text-gray-900">Unique visits per page</h1>
        <p class="mt-2 text-sm text-gray-700">A list of all unique users page visists in website.</p>
      </div>
        <div class="flex flex-row items-center pt-6">
            <input name="endDate" wire:model="startDate" type="date" min="2023-01-01" class="w-32 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            <span class="sm:table-cell whitespace-nowrap px-2 text-gray-500">{{ __('to') }}</span>
            <input name="endDate" wire:model="endDate" type="date" min="2023-01-01" class="w-32 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
        </div>
    </div>
    <div class="mt-8 flow-root">
      <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
          <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-300">
              <thead class="bg-gray-50">
                <tr>
                  <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Page</th>
                  <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6 text-sm text-left font-semibold text-gray-900">Visits</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-200 bg-white">
                @if($visits->isNotEmpty())
                    @foreach ($visits as $visit)
                        <tr>
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">{{ $visit->page_url }}</td>
                            <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-left text-sm text-gray-900 sm:pr-6">{{ $visit->visit_count }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="2" class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">No data available</td>
                    </tr>
                @endif
              </tbody>
            </table>
            {{ $visits->links('components.pagination') }}
          </div>
        </div>
      </div>
    </div>
  </div>
