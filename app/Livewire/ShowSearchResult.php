<?php

namespace App\Livewire;

use App\Models\Content\Post\Post;
use App\Models\GameNet\Game;
use App\Models\Shop\Product\Product;
use Livewire\Attributes\Url;
use Livewire\Component;

class ShowSearchResult extends Component
{
    #[Url]
    public $search = '';

    public $results = [];

    public function render()
    {
        return view('livewire.show-search-result', [
            'results' => $this->query()
        ])->layout('layouts.home.layout');
    }

    public function query()
    {
        if ($this->search) {
            $games = Game::search($this->search)->get();
            $posts = Post::search($this->search)->get();
            $products = Product::search($this->search)->get();
            return $this->results = ['games' => $games, 'posts' => $posts, 'products' => $products];
        }
        return [];
    }
}
