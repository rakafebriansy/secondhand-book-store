@extends('user.partials.body')
@section('wrapper')
<section class="bg-gray-50 py-8 antialiased dark:bg-gray-900 md:py-12">
    <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
      <div class="mb-4 items-center justify-between space-y-4 sm:flex sm:space-y-0 md:mb-8">
          <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Katalog Buku Bekas</h2>
        <div class="flex items-center space-x-4 min-w-[20rem]">
            <form class="w-full mx-auto">   
                <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input name="keyword" type="search" id="default-search" class="block w-full focus:outline-none p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Cari berdasarkan nama..." />
                    <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                </div>
            </form>
        </div>
      </div>
      <ul class="mb-4 grid gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
        @if (count($products) > 0)
            @foreach ($products as $product)
            <li class="rounded-lg border h-full flex flex-col justify-between border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
              <div class="h-56 w-full">
                <a href="#">
                  <img class="mx-auto h-full dark:hidden" src="{{ env('APP_URL') }}/storage/products/{{ $product['image'] }}" alt="" />
                </a>
              </div>
              <div class="pt-6">
                <h3 class="text-lg font-semibold leading-tight text-gray-900 hover:underline dark:text-white">{{ $product->name }}</h3>
                <div class="mt-2 flex items-center gap-2">
                  <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ $product->description }}</p>
                </div>
                <div class="mt-4 flex items-center justify-between gap-4">
                  <p  class="text-xl font-extrabold leading-tight text-gray-900 dark:text-white">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
      
                  <button x-on:click="addCart({{ json_encode($product) }})" type="button" class="inline-flex items-center rounded-lg bg-blue-700 px-4 py-1.5 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4  focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="-ms-2 me-2 h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6" />
                    </svg>
                    Tambah
                  </button>
                </div>
              </div>
            </li>
            @endforeach
        @else
          <h1>Produk belum tersedia.</h1>
        @endif
      </ul>
      <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4" aria-label="Table navigation">
        <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
            Menampikan halaman
            <span class="font-semibold text-gray-900 dark:text-white">{{ $current_page }}</span>
            dari
            <span class="font-semibold text-gray-900 dark:text-white">{{ ($page_count <= 1 ? 1 : $page_count) }}</span>
            halaman
        </span>
        <ul class="inline-flex items-stretch -space-x-px">
            @if ($current_page > 1)
            <li>
                <a href="/?page={{ $current_page - 1}}{{ strlen($current_keyword > 0) ? "&keyword=$current_keyword" : '' }}" class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                    <span class="sr-only">Previous</span>
                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                </a>
            </li>
            @endif
            @php
                $navigation_start = floor($current_page / 3) + 1;
                $navigation_end = $page_count >=3 ? $navigation_start + 2 : $page_count;
                $navigation_active = $current_page % 3;
            @endphp
            @for ($i = $navigation_start; $i <= $navigation_end; $i++)
                @if ($i > $page_count)
                    @break
                @endif
                @if ($i % 3 == $navigation_active)
                <li>
                    <a href="#" aria-current="page" class="flex items-center justify-center text-sm z-10 py-2 px-3 leading-tight text-blue-700 bg-blue-50 border border-blue-300 hover:bg-blue-100 hover:text-blue-800 dark:border-gray-700 dark:bg-gray-700 dark:text-white">{{ $i }}</a>
                </li>
                @else
                <li>
                    <a href="/?page={{ $i }}{{ strlen($current_keyword > 0) ? "&keyword=$current_keyword" : '' }}" class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">{{ $i }}</a>
                </li>
                @endif
            @endfor
            @if ($current_page != $page_count && $page_count != $navigation_end)
            <li>
                <a href="/?page={{ $current_page + 5 <= $page_count ? $current_page + 5 : $page_count }}{{ strlen($current_keyword > 0) ? "&keyword=$current_keyword" : '' }}" class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">...</a>
            </li>
                @if ($current_page != $page_count-1)
                <li>
                    <a href="/?page={{ $page_count }}{{ strlen($current_keyword > 0) ? "&keyword=$current_keyword" : '' }}" class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">{{ $page_count }}</a>
                </li>
                @endif
            @endif
            
            @if ($current_page < $page_count)
            <li>
                <a href="/?page={{ $current_page + 1 }}{{ strlen($current_keyword > 0) ? "&keyword=$current_keyword" : '' }}" class="flex items-center justify-center h-full py-1.5 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                    <span class="sr-only">Next</span>
                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </a>
            </li>
            @endif
        </ul>
      </nav>
    </div>
  </section>
@endsection