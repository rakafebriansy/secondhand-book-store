<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Services\ProductService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class ProductController extends Controller
{
    private ProductService $product_service;
    public function __construct(ProductService $product_service) {
        $this->product_service = $product_service;
    }
    public function index(Request $request): View
    {
        Log::info($request->page);
        $page = $request->page ?? 1;
        $per_page = 10;
        $skipped = ($page - 1 ?? 0) * $per_page;

        $products = $this->product_service->getPaginate($per_page, $skipped);
        $page_count = floor($this->product_service->getCount() / 10);
        return view('admin.pages.product',[
            'title' => 'Admin | Product',
            'products' => $products,
            'page_count' => $page_count,
            'current_page' => $page
        ]);
    }
    public function store(StoreProductRequest $request): RedirectResponse
    {
        $data = $request->validated();
        try {
            $response = $this->product_service->add($data['name'],$data['description'],$data['price'],$data['quantity']);
            if($response) {
                return back()->with('success', 'Add product success');
            }
            return back()->withInput()->withErrors(['errors' => 'Add product failed']);
        } catch (\Exception $error) {
            return back()->withInput()->withErrors(['errors' => $error->getMessage()]);
        }
    }
}
