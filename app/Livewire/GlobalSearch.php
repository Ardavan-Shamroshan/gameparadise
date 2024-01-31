<?php

namespace App\Livewire;

use App\Models\Content\Post\Post;
use App\Models\GameNet\Game;
use App\Models\Shop\Product\Product;
use Livewire\Attributes\On;
use Livewire\Component;

class GlobalSearch extends Component
{
    /**
     * Properties
     */
    public $search  = '';
    public $results = [];

    #[On('clear-search')]
    public function updatedSearch()
    {
        if (empty($this->search)) {
            $this->results = [];
        }
    }

    public function render()
    {
        return view('livewire.global-search', [
            'results' => $this->query()
        ]);
    }

    public function submit($formData)
    {
        $this->redirectRoute('show-search-result', parameters: "search={$formData['search']}", navigate: true);
    }

    public function query($query = '')
    {
        if ($this->search) {
            // $games = Game::search($this->search)->get();
            // $posts = Post::search($this->search)->get();
            // $products = Product::search($this->search)->get();
            $games    = Game::query()->where('name', 'LIKE', "%$this->search%")->get();
            $posts    = Post::query()->where('title', 'LIKE', "%$this->search%")->get();
            $products = Product::query()->where('name', 'LIKE', "%$this->search%")->get();
            return $this->results = ['games' => $games, 'posts' => $posts, 'products' => $products];
        }
    }
}
