<section class="py-12 h-screen">
  <div class="mx-auto max-w-screen-xl px-4 2xl:px-0 ">
    <div class="flex items-center justify-between mb-8">
      <h2 class="text-xl font-semibold text-gray-900 sm:text-2xl">
        Category List
      </h2>

    </div>

    <div class="grid gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
   

    @foreach ($categories as $category )
    <a href="#" 
        class="flex flex-col items-center justify-center rounded-xl border border-gray-200 bg-white p-6 shadow-sm hover:shadow-md hover:bg-gray-50 transition" wire:key="{{ $category->id }}">
        <svg class="w-8 h-8 mb-3 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none"
          viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M9 12h6m2 0a2 2 0 100-4 2 2 0 000 4zm-8 0a2 2 0 100-4 2 2 0 000 4zM3 7a2 2 0 012-2h14a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V7z" />
        </svg>
        <span class="text-gray-900 font-medium">{{ $category->name }}</span>
      </a>
    @endforeach
      




    </div>
  </div>
</section>
