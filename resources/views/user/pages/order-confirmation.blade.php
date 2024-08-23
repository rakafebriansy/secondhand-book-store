@extends('layout.main')
@section('main')
<section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16">
    <div class="mx-auto max-w-2xl px-4 2xl:px-0">
        <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl mb-2">Terima kasih atas pesanan Anda!</h2>
        <p class="text-gray-500 dark:text-gray-400 mb-6 md:mb-8">Pesanan anda <span href="#" class="font-medium text-gray-900 dark:text-white hover:underline">#{{ $transaction->id }}</span> akan di proses dalam 24 jam dalam jam kerja. Kami akan menghubungi email anda ketika pesanan Anda telah kami kirim.</p>
        <div class="space-y-4 sm:space-y-2 rounded-lg border border-gray-100 bg-gray-50 p-6 dark:border-gray-700 dark:bg-gray-800 mb-6 md:mb-8">
            <dl class="sm:flex items-center justify-between gap-4">
                <dt class="font-normal mb-1 sm:mb-0 text-gray-500 dark:text-gray-400">Tanggal</dt>
                <dd class="font-medium text-gray-900 dark:text-white sm:text-end">{{ $transaction->created_at }}</dd>
            </dl>
            <dl class="sm:flex items-center justify-between gap-4">
                <dt class="font-normal mb-1 sm:mb-0 text-gray-500 dark:text-gray-400">Metode Pembayaran</dt>
                <dd class="font-medium text-gray-900 dark:text-white sm:text-end">{{ $transaction->payment_method ?? 'Midtrans' }}</dd>
            </dl>
            <dl class="sm:flex items-center justify-between gap-4">
                <dt class="font-normal mb-1 sm:mb-0 text-gray-500 dark:text-gray-400">Nama</dt>
                <dd class="font-medium text-gray-900 dark:text-white sm:text-end">{{ $transaction->name }}</dd>
            </dl>
            <dl class="sm:flex items-center justify-between gap-4">
                <dt class="font-normal mb-1 sm:mb-0 text-gray-500 dark:text-gray-400">Alamat</dt>
                <dd class="font-medium text-gray-900 dark:text-white sm:text-end">{{ $transaction->address }}</dd>
            </dl>
            <dl class="sm:flex items-center justify-between gap-4">
                <dt class="font-normal mb-1 sm:mb-0 text-gray-500 dark:text-gray-400">Email</dt>
                <dd class="font-medium text-gray-900 dark:text-white sm:text-end">{{ $transaction->email }}</dd>
            </dl>
        </div>
        <div class="flex items-center space-x-4">
            <a href="/" class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Kembali ke Katalog</a>
        </div>
    </div>
</section>
@endsection