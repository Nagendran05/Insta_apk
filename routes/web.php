<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Livewire\EditPost;
use App\Livewire\Profile\CreateProfile;
use App\Livewire\Profile\EditProfile;
use App\Livewire\Post\CreatePost;
use App\Livewire\HomePage;
use App\Livewire\Post\PostView;
use App\Livewire\Profile\FollowersList;
use App\Livewire\Profile\FollowingList;
use App\Livewire\Profile\UserProfile;
use App\Livewire\Profile\ViewProfile;
use App\Livewire\SearchPage;

// Login 
Route::redirect('/', '/login');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Register
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth')->group(function () {

    // Profile Folder 
    Route::get('/edit-profile', EditProfile::class)->name('profile.edit');
    Route::get('/profile',ViewProfile::class)->name('profile.view');
    Route::get('/profile/{id?}',UserProfile::class)->name('user-profile');
    Route::get('/create-profile', CreateProfile::class)->name('profile.create');
    Route::get('/profile/{id}/followers',FollowersList::class)->name('profile.followers');
    Route::get('/profile/{id}/following',FollowingList::class)->name('profile.following');
    // Route::get('post/{id}/edit',EditPost::class)->name('post.edit');
    
    // Home page 
    Route::get('/home', HomePage::class)->name('home');
    
    // Post 
    Route::get('/create-post', CreatePost::class)->name('posts.create');
    Route::get('post/{id}',PostView::class)->name('post.view');
    
    // Search 
    Route::get('/search',SearchPage::class)->name('search');
});