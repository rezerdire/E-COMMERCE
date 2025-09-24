

<div>
<!-- Title -->
<div class=" bg-gray-100 h-screen pt-10">
<h1 class="text-center text-2xl font-bold text-gray-800">All Products</h1>




<!-- Product List -->
<section class="py-10 bg-gray-100">
    <div class="mx-auto max-w-7xl px-6 grid grid-cols-1 lg:grid-cols-4 gap-8">

   <!-- Filter Sidebar -->
      <aside class="bg-white rounded-xl p-4 shadow-md lg:col-span-1">
        <h2 class="text-lg font-bold text-gray-700 mb-4">Filters</h2>
        
        <!-- Category Filter -->
        <div class="mb-6">
          <h3 class="text-sm font-semibold text-gray-600 mb-2">Category</h3>
          <ul class="space-y-2 text-gray-700">
            <li><label><input type="checkbox" class="mr-2"> Shoes</label></li>
            <li><label><input type="checkbox" class="mr-2"> Laptops</label></li>
            <li><label><input type="checkbox" class="mr-2"> Clothes</label></li>
            <li><label><input type="checkbox" class="mr-2"> Smartphones</label></li>
          </ul>
        </div>

        <!-- Price Filter -->
        <div class="mb-6">
          <h3 class="text-sm font-semibold text-gray-600 mb-2">Price</h3>
          <input type="range" min="100" max="1000" class="w-full accent-blue-500">
          <p class="text-sm text-gray-500 mt-1">Up to 1000</p>
        </div>

        <!-- Rating Filter -->
        <div class="mb-6">
          <h3 class="text-sm font-semibold text-gray-600 mb-2">Brands</h3>
        
        </div>

        <button class="w-full py-2 mt-4 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
          Apply Filters
        </button>
      </aside>


      <div class="lg:col-span-3 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">

   
  
      @foreach ($products as $product )
          <article class="rounded-xl bg-white p-3 shadow-lg hover:shadow-xl hover:transform hover:scale-105 duration-300 " wire:key="{{ $product->id }}">
      <a href="/products/{{ $product->slug }}">
        <div class="relative flex items-end overflow-hidden rounded-xl">
         <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
        </div>

        <div class="mt-1 p-2">
          <h2 class="text-slate-700">{{ $product->name }}</h2>
          <p class="mt-1 text-sm text-slate-400">{{ $product->description }}</p>

          <div class="mt-3 flex items-end justify-between">
              <p class="text-lg font-bold text-blue-500">{{ $product->price }}</p>

            <div class="flex items-center space-x-1.5 rounded-lg bg-blue-500 px-4 py-1.5 text-white duration-100 hover:bg-blue-600">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
              </svg>

              <button class="text-sm">Add to cart</button>
            </div>
          </div>
        </div>
      </a>
    </article>

      @endforeach

    

    

    </div>
</section>
</div>

</div> 