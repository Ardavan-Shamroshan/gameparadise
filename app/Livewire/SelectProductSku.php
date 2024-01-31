<?php

namespace App\Livewire;

use App\Models\Shop\Product\CartItem;
use App\Models\Shop\Product\Product;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class SelectProductSku extends Component
{
    use LivewireAlert;

    public Product $product;

    /**
     * Runs once, immediately after the component is instantiated,
     * but before render() is called.
     * This is only called once on initial page load and never called again, even on component refreshes
     * @return void
     */
    public function mount($product)
    {
        $this->product = $product;
    }

    public function addToCart()
    {
        if (auth()->guest()) {
            return to_route('auth.authentication-form');
        }

        try {
            if (auth()->user()->cartItems()->pluck('sku_id')->contains($this->product->sku->id)) {
                throw new \Exception('این اکانت بازی در سبد خرید شما وجود دارد');
            } else {
                CartItem::query()->create([
                    'user_id'    => auth()->id(),
                    'product_id' => $this->product->id,
                    'sku_id'     => $this->product->sku->id,
                    'price'      => $this->product->sku->price,
                    'number'     => $this->selectedNumber ?? 1,
                ]);

                $this->alert('success', 'محصول به سبد خرید شما اضافه شد', [
                    'toast' => false
                ]);

                $this->dispatch('cartItem-added')->to(UserCartItems::class);
            }

        } catch (\Exception $e) {
            $this->alert('error', $e->getMessage(), ['toast' => false]);
        }
    }


    public function render()
    {
        return view('livewire.select-product-sku');
    }
}
