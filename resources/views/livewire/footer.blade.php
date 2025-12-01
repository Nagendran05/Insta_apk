<div class="fixed bottom-0 left-0 right-0 bg-white   flex justify-around py-3 z-50">
    
    <!-- Home -->
    <a href="/home" class="flex flex-col items-center {{ request()->is('home') ? 'text-blue-600' : 'text-gray-700' }}">
        
        @if(request()->is('home'))
            <ion-icon name="home" class="text-3xl"></ion-icon>
        @else
            <ion-icon name="home-outline" class="text-3xl"></ion-icon>
        @endif

        <span class="text-xs">Home</span>
    </a>

    <!-- Search -->
    <a href="/search" class="flex flex-col items-center {{ request()->is('search') ? 'text-blue-600' : 'text-gray-700' }}">
        
        @if(request()->is('search'))
            <ion-icon name="search" class="text-3xl"></ion-icon>
        @else
            <ion-icon name="search-outline" class="text-3xl"></ion-icon>
        @endif

        <span class="text-xs">Search</span>
    </a>

    <!-- Create Post -->
    <a href="/create-post" class="flex flex-col items-center {{ request()->is('create-post') ? 'text-blue-600' : 'text-gray-700' }}">
        
        @if(request()->is('create-post'))
            <ion-icon name="add-circle" class="text-3xl"></ion-icon>
        @else
            <ion-icon name="add-circle-outline" class="text-3xl"></ion-icon>
        @endif

        <span class="text-xs">Post</span>
    </a>

    <!-- Profile -->
    <a href="/profile" class="flex flex-col items-center {{ request()->is('profile') ? 'text-blue-600' : 'text-gray-700' }}">
        
        @if(request()->is('profile'))
            <ion-icon name="person" class="text-3xl"></ion-icon>
        @else
            <ion-icon name="person-outline" class="text-3xl"></ion-icon>
        @endif

        <span class="text-xs">Profile</span>
    </a>
</div>
