<?php

namespace App\Livewire;

use App\Models\GameNet\Game;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class GamesFilter extends Component
{
    use WithPagination;

    public $createdAt = false;
    public $releasedAt = false;
    public $perLoad           = 32;
    public $pagination        = false;

    public function mount($perLoad = 8)
    {
        $this->perLoad = $perLoad;
    }


    #[On('filter-updated')]
    public function render()
    {
        $gamesQuery = Game::with('publisher', 'account')
            ->active()
            ->orderByDesc('released_at')
            ->when($this->createdAt, function ($query) {
                return $query->orderBy('created_at');
            })
            ->when($this->releasedAt, function ($query) {
                $query->orderBy('released_at');
            });

        // get games records
        $games = $this->pagination ?
            $gamesQuery->paginate($this->perLoad) :
            $gamesQuery->take($this->perLoad)->get();

        return view('livewire.games-filter', compact('games'));
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
