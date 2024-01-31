<?php

namespace App\Http\Services\Product;

use App\Http\Resources\Shop\ProductResource;
use App\Http\Resources\Shop\TorobProductResource;
use App\Models\Shop\Product\Product;
use App\Support\Traits\JsonResponseHandler;
use Illuminate\Http\JsonResponse;

class ProductService
{
    use JsonResponseHandler;

    public function indexProducts(): JsonResponse
    {
        $products = ProductResource::collection(Product::all());
        return $this->success(compact('products'));
    }


    /**
     محصولات در صفحه‌ی موردنظر، به ترتیب جدید به قدیم مرتب شوند. *
     یعنی محصولات جدیدا اضافه شده و جدیدا ویرایش شده در اولویت قرار داشته باشند. *
     *
     * @return JsonResponse
     */
    public function torobIndexProducts(): JsonResponse
    {
        $products = TorobProductResource::collection(Product::query()->orderByDesc('created_at')->get());
        return $this->success(compact('products'));
    }
}