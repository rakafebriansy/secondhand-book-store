@extends('user.partials.body')
@section('wrapper')
@push('midtrans-snap')
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key={{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <script type="text/javascript">
      document.getElementById('pay-button').onclick = function(e){
        e.preventDefault();
        snap.pay('{{ $snap_token }}', {
          onSuccess: function(result){
            document.getElementById('payment-form').submit();
            /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
          },
          // Optional
          onPending: function(result){
            /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
          },
          // Optional
          onError: function(result){
            /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
          }
        });
      };
</script>
@endpush
<section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16">
    <form id="payment-form" action="/order-confirmation" class="mx-auto max-w-screen-xl  px-4 2xl:px-0">
        <input type="hidden" name="transaction_id" value="{{ $transaction_id }}">
        <div class="mx-auto max-w-3xl">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Rincian pesanan</h2>
            <div class="mt-6 sm:mt-8 border-t border-gray-200">
            <div class="relative overflow-x-auto border-b border-gray-200">
                <table class="w-full text-left font-medium text-gray-900 dark:text-white md:table-fixed">
                <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
                  @foreach ($products as $product)
                  <tr>
                    <td class="whitespace-nowrap py-4 md:w-[384px]">
                        <div class="flex items-center gap-4">
                        <a href="#" class="flex items-center aspect-square w-10 h-10 shrink-0">
                            <img class="h-auto w-full max-h-full dark:hidden" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-front.svg" alt="imac image" />
                            <img class="hidden h-auto w-full max-h-full dark:block" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-front-dark.svg" alt="imac image" />
                        </a>
                        <a href="#" class="hover:underline">{{ $product->name }}</a>
                        </div>
                    </td>
    
                    <td class="p-4 text-base font-normal text-gray-900 dark:text-white">x{{ $product->quantity  }}</td>
    
                    <td class="p-4 text-right text-base font-bold text-gray-900 dark:text-white">Rp {{ number_format(intval($product->price) * intval($product->quantity), 0, ',', '.') }}</td>
                    </tr>
                  @endforeach
                </tbody>
                </table>
            </div>

            <dl class="flex my-5 items-center justify-between gap-4 pt-2 pe-4">
              <dt class="text-lg font-bold text-gray-900 dark:text-white">Total</dt>
              <dd class="text-lg font-bold text-gray-900 dark:text-white">Rp {{ number_format($total_price, 0, ',', '.') }}</dd>
            </dl>
    
            <div class="gap-4 sm:flex sm:items-center">
                <button id="pay-button" type="button" class="mt-4 flex w-full items-center justify-center rounded-lg bg-blue-700  px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300  dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 sm:mt-0">Bayar Sekarang</button>
            </div>
            </div>
        </div>
    </form>
  </section>
@endsection