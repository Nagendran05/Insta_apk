<?php

namespace App\Livewire;
use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\User;
use Livewire\Attributes\Title;

#[Title('Search')]
class SearchPage extends Component
{
    public $query = '';
    public $results = [];

    public function updatedQuery()
    {
        $this->results = User::where('name', 'like', '%' . $this->query . '%')->get();
    }
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.search-page');
    }
}
