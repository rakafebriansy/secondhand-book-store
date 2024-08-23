<div id="myCartDropdown1" class="hidden z-10 mx-auto max-w-sm space-y-4 overflow-hidden rounded-lg bg-white p-4 antialiased shadow-lg dark:bg-gray-800">
    <template x-for="(product, index) in cart" x-bind:key="index">
        <li class="grid grid-cols-2">
            <div>
              <p href="#" class="truncate text-sm font-semibold leading-none text-gray-900 dark:text-white hover:underline" x-text="product.name"></p>
              <p class="mt-0.5 truncate text-sm font-normal text-gray-500 dark:text-gray-400" x-text="'Rp ' + product.price"></p>
            </div>
      
            <div class="flex items-center justify-end gap-6">
              <p class="text-sm font-normal leading-none text-gray-500 dark:text-gray-400"><span class="cursor-pointer select-none" x-on:click="decrementCart(product.id)">-</span> Qty: <span x-text="product.quantity"></span><span class="cursor-pointer select-none" x-on:click="incrementCart(product.id)">+</span></p>
      
              <button x-on:click="removeCart(index)" data-tooltip-target="tooltipRemoveItem1a" type="button" class="text-red-600 hover:text-red-700 dark:text-red-500 dark:hover:text-red-600">
                <span class="sr-only"> Remove </span>
                <svg class="h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                  <path fill-rule="evenodd" d="M2 12a10 10 0 1 1 20 0 10 10 0 0 1-20 0Zm7.7-3.7a1 1 0 0 0-1.4 1.4l2.3 2.3-2.3 2.3a1 1 0 1 0 1.4 1.4l2.3-2.3 2.3 2.3a1 1 0 0 0 1.4-1.4L13.4 12l2.3-2.3a1 1 0 0 0-1.4-1.4L12 10.6 9.7 8.3Z" clip-rule="evenodd" />
                </svg>
              </button>
              <div id="tooltipRemoveItem1a" role="tooltip" class="tooltip invisible absolute z-10 inline-block rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300 dark:bg-gray-700">
                Remove item
                <div class="tooltip-arrow" data-popper-arrow></div>
              </div>
            </div>
          </li>
      </template>
      
      <template x-if="cart.length > 0">
      <form action="/checkout" method="POST" @submit.prevent="checkoutHandler" class="flex flex-col items-start gap-2">
        @csrf
        <div class="font-bold">
          <p>Total: Rp <span x-text="totalPrice"></span></p>
        </div>
        <button type="submit" class="mb-2 me-2 inline-flex w-full items-center justify-center rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"> Checkout </button>
      </form>
    </template>
    <template x-if="cart.length == 0">
      <button disabled type="submit" class="mb-2 me-2 inline-flex w-full items-center justify-center rounded-lg bg-gray-300 px-5 py-2.5 text-sm font-medium text-white focus:outline-none focus:ring-4 "> Checkout </button>
    </template>
</div>