<?php

namespace App\Livewire;
use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\SearchHistory;
use Livewire\Attributes\Title;

#[Title('Search')]
class SearchPage extends Component
{
    public $query = '';
    public $results = [];
    public $oldSearches = [];

    public function mount(){
        $this->oldSearches = SearchHistory::where('user_id', Auth::id())
                                       ->orderBy('created_at', 'desc')
                                       ->take(10)
                                       ->get();
    }
    public function updatedQuery()
    {
        $this->results = User::where('name', 'like', '%' . $this->query . '%')->get();
    }
    public function saveHistory($userId)
{
    // Avoid duplicates (same user multiple times)
    SearchHistory::where('user_id', Auth::id())
        ->where('profile_id', $userId)
        ->delete();

    SearchHistory::create([
        'user_id' => Auth::id(),
        'profile_id' => $userId
    ]);
    $this->query = '';
    $this->results= [];
    return redirect($userId == Auth::id() ? '/profile' : '/profile/'.$userId);
}
    public function removeHistory($id)
{
    SearchHistory::where('id', $id)
        ->where('user_id', Auth::id())
        ->delete();

    $this->oldSearches = SearchHistory::where('user_id', Auth::id())
                                      ->orderBy('created_at', 'desc')
                                      ->take(10)
                                      ->get();
}
public function clearAll()
{
    SearchHistory::where('user_id', Auth::id())->delete();

    // Refresh history list
    $this->oldSearches = [];
}
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.search-page');
    }
}
