
<!DOCTYPE html>
<html lang="en" class="h-full">
<head>




    <meta charset="UTF-8">
    <title>@yield('title', 'Page')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>



    @stack('style')
    <style>
              :root {
            --primary-color: #6B4226;      
            --primary-hover: #593721;       
            --secondary-color: #C8A165;     
            --secondary-hover: #B58F54;     
            --accent-color: #8C5E3C;       
            --accent-hover: #734C30;        
            --text-on-primary: #FFFFFF;     
            --text-on-secondary: #1A1A1A;   
            --background-color: #F8F5F2;   
            --surface-color: #FFFFFF;      
            --border-color: #E5D5C3;
        }

    </style>
</head>

<body class="bg-body">
<div id="loader">
    <div class="spinner"></div>
</div>

<!-- Navbar -->
@include('user.partials.navbar')


@yield('content')

<!-- Footer -->
 @include('user.partials.footer')

<script>
  console.log('loader showing')
  window.addEventListener('load', () => {
    const loader = document.getElementById('loader');
    console.log('loader hiding')
    loader.style.display = 'none';
  });
</script>

    @stack('script')
</body>
</html>
