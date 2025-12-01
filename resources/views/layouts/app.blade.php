<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{  $title  ??  'Page Title' }}</title>
    <link rel="shortcut icon" href="https://dreamfoundry.org/wp-content/uploads/2018/12/instagram-logo-png-transparent-background.png" type="image/x-icon">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @livewireStyles
</head>

<body class="bg-gray-100">

    @include('livewire.header')

        <div>
            {{ $slot }}
        </div>
        
    @include('livewire.footer')

</body>
</html>
