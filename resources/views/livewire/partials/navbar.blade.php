<header 
x-data="{ isMenuOpen: false, isScrolled: false }"x-init="
        window.addEventListener('scroll', () => {
            isScrolled = window.scrollY > 10
        })
    "
    :class="isScrolled 
        ? 'fixed w-full z-50 bg-gray-100 backdrop-blur-sm shadow-sm transition-all duration-300 border border-gray-300' 
        : 'fixed w-full z-50 bg-gray-100 py-5 transition-all duration-300 border border-gray-300'"
>
  <nav class="max-w-[85rem] w-full mx-auto px-4 md:px-6 lg:px-8  ">
    <div class="flex items-center justify-between">
      
      <!-- Logo -->
      <a href="/" class="text-xl font-bold">
        E-Commerce
      </a>

<!-- Desktop Menu -->
<div class="hidden md:flex items-center space-x-8">
  <a href="/" class=" hover:text-blue-600 transition-colors">Home</a>
  <a href="/categories" class=" hover:text-blue-600 transition-colors">Categories</a>
  <a href="/products" class=" hover:text-blue-600 transition-colors">Products</a> 
  
  <a href="/cart" class="flex items-center  hover:text-blue-600 transition-colors">
    <svg xmlns="http://www.w3.org/2000/svg" 
         class="w-5 h-5 mr-1" 
         fill="none" 
         viewBox="0 0 24 24" 
         stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
        d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993
           1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125
           1.125 0 0 1-1.12-1.243l1.264-12A1.125
           1.125 0 0 1 5.513 7.5h12.974c.576
           0 1.059.435 1.119 1.007Z" />
    </svg>
    <span>Cart</span>
    <span class="ml-2 flex items-center justify-center w-5 h-5 text-xs font-medium bg-gray-300 rounded-full leading-none">
      4
    </span>
  </a>
  
 <div class="pt-3 md:pt-0">
    <a href="/login" 
       class="py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
      <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
        <circle cx="12" cy="7" r="4" />
      </svg>
      Log in
    </a>
  </div>
</div>

      <!-- Mobile Menu Button -->
      <button 
        @click="isMenuOpen = !isMenuOpen" 
        class="md:hidden p-2 z-50"
        aria-label="Toggle Menu"
      >
        <template x-if="!isMenuOpen">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M3 6h18M3 12h18M3 18h18" />
          </svg>
        </template>
        <template x-if="isMenuOpen">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M6 18L18 6M6 6l12 12" />
          </svg>
        </template>
      </button>
    </div>

    <!-- Mobile Menu -->
    <div 
      class="fixed inset-0 bg-black/95 backdrop-blur-md flex flex-col items-center justify-center space-y-8 text-xl transition-all duration-300 md:hidden"
      x-show="isMenuOpen"
      x-transition.opacity
      @click.away="isMenuOpen = false"
    >
      <a href="/" class="text-white hover:text-gray-300 transition-colors" @click="isMenuOpen=false">Home</a>
      <a href="/categories" class="text-white hover:text-gray-300 transition-colors" @click="isMenuOpen=false">Categories</a>
      <a href="/products" class="text-white hover:text-gray-300 transition-colors" @click="isMenuOpen=false">Products</a>
      <a href="/cart" class="text-white hover:text-gray-300 transition-colors" @click="isMenuOpen=false">Cart</a>
      <a href="/login" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition" @click="isMenuOpen=false">
        Log in
      </a>
    </div>
  </nav>
</header>
