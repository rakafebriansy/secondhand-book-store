<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Services\ProductService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    private ProductService $product_service;
    public function __construct(ProductService $product_service) {
        $this->product_service = $product_service;
    }
    public function index(): View
    {
        $products = $this->product_service->getAll();
        return view('admin.pages.product',[
            'title' => 'Admin | Product',
            'products' => $products
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
