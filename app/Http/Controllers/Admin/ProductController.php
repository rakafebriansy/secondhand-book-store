<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
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
        $page = $request->page ?? 1;
        $keyword = $request->keyword ?? '';
        $per_page = 10;
        $skipped = ($page - 1 ?? 0) * $per_page;

        $products = $this->product_service->getPaginate($per_page, $skipped, $keyword);
        $page_count = floor($this->product_service->getCount($keyword) / 10);
        return view('admin.pages.product',[
            'title' => 'Admin | Product',
            'products' => $products,
            'page_count' => $page_count,
            'current_page' => $page,
            'current_keyword' => $keyword
        ]);
    }
    public function store(StoreProductRequest $request): RedirectResponse
    {
        $data = $request->validated();
        try {
            $file = $request->file('image');
            $file_name = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storePubliclyAs('product', $file_name);
            $data['image'] = $file_name;

            $response = $this->product_service->add($data);
            if($response) {
                return back()->with('success', 'Add product success');
            }
            return back()->withInput()->withErrors(['errors' => 'Add product failed']);
        } catch (\Exception $error) {
            return back()->withInput()->withErrors(['errors' => $error->getMessage()]);
        }
    }
    public function update(UpdateProductRequest $request): RedirectResponse
    {
        $data = $request->validated();
        try {
            if($request->file('image') != null) {
                $file = $request->file('image');
                $file_name = uniqid() . '.' . $file->getClientOriginalExtension();
                $file->storePubliclyAs('product', $file_name);
                $data['image'] = $file_name;
            }

            $response = $this->product_service->update($data);
            if($response) {
                return back()->with('success', 'Update product success');
            }
            return back()->withInput()->withErrors(['errors' => 'Update product failed']);
        } catch (\Exception $error) {
            return back()->withInput()->withErrors(['errors' => $error->getMessage()]);
        }
    }
    public function delete(Request $request): RedirectResponse
    {
        try {
            $response = $this->product_service->delete($request->id);
            if($response) {
                return back()->with('success', 'Delete product success');
            }
            return back()->withInput()->withErrors(['errors' => 'Delete product failed']);
        } catch (\Exception $error) {
            return back()->withInput()->withErrors(['errors' => $error->getMessage()]);
        }
    }
}
