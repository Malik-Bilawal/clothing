<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>

    <title>{{ config('app.name', 'Grocery Store') }}</title>
</head>
<body class="bg-background text-text">

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

    <main class="p-6">
        @yield('content')
    </main>

    <footer class="bg-secondary text-black p-4 text-center">
        <p>&copy; {{ date('Y') }} Grocery Store. All rights reserved.</p>
    </footer>

</body>
</html>
