<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\PaymentService;
use App\Services\ProductService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class ShoppingController extends Controller
{
    private ProductService $product_service;
    private PaymentService $payment_service;
    public function __construct(ProductService $product_service, PaymentService $payment_service) {
        $this->product_service = $product_service;
        $this->payment_service = $payment_service;
    }
    public function index(Request $request): View
    {
        $page = $request->page ?? 1;
        $keyword = $request->keyword ?? '';
        $per_page = 8;
        $skipped = ($page - 1 ?? 0) * $per_page;

        $products = $this->product_service->getPaginate($per_page, $skipped, $keyword);
        $page_count = floor($this->product_service->getCount($keyword) / $per_page);
        return view('user.pages.product',[
            'title' => 'Home',
            'products' => $products,
            'page_count' => $page_count,
            'current_page' => $page,
            'current_keyword' => $keyword,
            'per_page' => $per_page
        ]);
    }
    public function doCheckout(Request $request): View|RedirectResponse
    {
        $data = json_decode($request->data);
        try {
            if($data && $request->total_price) {
                [
                    'snap_token' => $snap_token,
                    'transaction_id' => $transaction_id
                ] = $this->payment_service->beforePayment($data, $request->total_price);
                return view('user.pages.payment',[
                    'title' => 'Payment',
                    'products' => $data,
                    'total_price' => $request->total_price,
                    'snap_token' => $snap_token,
                    'transaction_id' => $transaction_id,
                ]);
            }
            return back()->withErrors(['errors' => 'Checkout failed']);
        } catch (\Exception $error) {
            return back()->withErrors(['errors' => 'Checkout failed']);
        }
    }
    public function confirmOrder(Request $request): View|RedirectResponse
    {
        try {
            if($request->transaction_id) {
                $transaction = $this->payment_service->orderConfirmation($request->transaction_id);
                return view('user.pages.order-confirmation',[
                    'title' => 'Order Confirmation',
                    'transaction' => $transaction
                ]);
            }
            return redirect('/')->withErrors(['errors' => 'Checkout failed']);
        } catch (\Exception $error) {
            return redirect('/')->withErrors(['errors' => $error->getMessage()]);
        }
    }
}
