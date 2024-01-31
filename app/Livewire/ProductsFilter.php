<?php

namespace App\Livewire;

use App\Models\Content\Category\Category;
use App\Models\Shop\Product\Brand;
use App\Models\Shop\Product\Product;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ProductsFilter extends Component
{
    use WithPagination;

    public $filterByCreatedAt = false;
    public $filterByView      = false;
    public $filterByPrice     = false;
    public $filterBySell      = false;
    public $perLoad           = 32;
    public $pagination        = false;

    public function mount($perLoad)
    {
        $this->perLoad = $perLoad;
    }


    #[On('filter-updated')]
    public function render()
    {
        $productCategories = Category::with('products')->whereHas('products')->get();

        $brands = Brand::with('products')->whereHas('products')->get();

        $productsQuery = Product::query()
            ->orderByDesc('published_at')
            ->when($this->filterByCreatedAt, function (Builder $query) {
                $query->orderBy('created_at');
            })
            ->active();


        // get products records
        $products = $this->pagination ?
            $productsQuery->paginate($this->perLoad) :
            $productsQuery->take($this->perLoad)->get();

        return view('livewire.products-filter', compact('productCategories', 'brands', 'products'));
    }

    public function updated()
    {
        $this->dispatch('filter-updated');
    }

    public function paginationView()
    {
        return 'vendor.livewire.open9-bootstrap';
    }
}