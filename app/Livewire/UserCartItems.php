<?php

namespace App\Livewire;

use App\Models\Shop\Product\CartItem;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class UserCartItems extends Component
{
    use LivewireAlert;

    public $cartItems;

    /**
     * Runs once, immediately after the component is instantiated,
     * but before render() is called.
     * This is only called once on initial page load and never called again, even on component refreshes
     * @return void
     */
    #[On('cartItem-added')]
    public function mount()
    {
        $this->cartItems = CartItem::with('game', 'product', 'sku', 'accountSku')
            ->where('user_id', auth()->id())
            ->get();
    }

    public function removeFromCart($cartItem)
    {
        try {
            $cartItemIndex = $this->cartItems->search(function ($item) use ($cartItem) {
                return $item->id === $cartItem;
            });

            $this->cartItems->forget($cartItemIndex);

            CartItem::query()->find($cartItem)?->forceDelete();
        } catch (\Exception $e) {
            $this->alert('error', $e->getMessage(), ['toast' => false]);
        }
        $this->dispatch('cartItem-added');

    }

    public function render()
    {
        return view('livewire.user-cart-items');
    }
}
