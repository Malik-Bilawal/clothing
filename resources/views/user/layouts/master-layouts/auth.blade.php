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
    /* Primary */
    --primary-color: #680626;        /* Dark Maroon */
    --primary-hover: #52041E;        /* Deeper Maroon */
    --secondary-color: #B89A6B;     /* Rose-champagne gold */
--secondary-hover: #967B52;     /* Elegant darkening, stays refined */



    /* Cards */
    --card-background: #FFFFFF;

    /* Accent (Greige – slightly warmer) */
    --accent-color: #D6CEC3;         /* Warm Greige */
    --accent-hover: #C8BFB3;         /* Natural darkening, not muddy */

    /* Text */
    --text-on-primary: #FFFFFF;
    --text-on-secondary: #2A2A2A;

    /* Backgrounds */
    --background-color: #FBF7EE;     /* Soft Ivory */
    --surface-color: #FFFFFF;

    /* Borders */
    --border-color: #E2DBD1;
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
