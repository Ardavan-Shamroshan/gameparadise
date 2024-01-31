<?php

namespace App\Livewire;

use App\Models\GameNet\AccountSKU;
use App\Models\GameNet\Game;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class SelectGameAccount extends Component
{
    use LivewireAlert;

    public Game $game;
    public      $accountSkus;
    public      $selectedAccountSkuId = [];
    public      $selectedAccountSku;
    public      $selectedPlatform     = 'PS5';

    protected $queryString = [
        'query' => ['except' => ''],
        'page'  => ['except' => 1],
    ];

    /**
     * Runs once, immediately after the component is instantiated,
     * but before render() is called.
     * This is only called once on initial page load and never called again, even on component refreshes
     * @return void
     */
    public function mount()
    {
        $this->accountSkus = $this->game->account()
            ->with('accountSkus')
            ->whereHas('accountSkus')
            ->first()
            ?->accountSkus()
            ->with('volume')
            ->get();
    }

    public function updatedSelectedAccountSkuId()
    {
        $this->selectedAccountSku = AccountSKU::query()->findOrFail($this->selectedAccountSkuId);
    }

    public function render()
    {
        return view('livewire.select-game-account');
    }
}
