<?php

namespace App\Providers;

use App\Services\Impl\PaymentServiceImpl;
use App\Services\PaymentService;
use Illuminate\Support\ServiceProvider;

class PaymentServiceProvider extends ServiceProvider
{
    public array $singletons =[
        PaymentService::class => PaymentServiceImpl::class
    ];
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
    public function provides(): array
    {
        return [PaymentService::class];
    }
}
