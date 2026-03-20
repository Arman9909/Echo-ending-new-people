 <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

            <!-- ... -->
            <link rel="manifest" href="/manifest.json">
            <meta name="theme-color" content="#3b82f6">
            <meta name="apple-mobile-web-app-capable" content="yes">
            <meta name="apple-mobile-web-app-status-bar-style" content="default">
            <meta name="apple-mobile-web-app-title" content="MyApp">
            <link rel="apple-touch-icon" href="/icons/icon-192x192.png">

            <!-- iOS splash screens (опционально, но сильно улучшает опыт) -->
            <link rel="apple-touch-startup-image" href="/splash/launch-1125x2436.png" media="(device-width: 375px) and (device-height: 812px) and (-webkit-device-pixel-ratio: 3)">

        @PwaHead
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        @RegisterServiceWorkerScript
        <script>
            if ('serviceWorker' in navigator) {
                window.addEventListener('load', () => {
                    navigator.serviceWorker.register('/sw.js')
                        .then(reg => console.log('Service Worker зарегистрирован', reg))
                        .catch(err => console.log('Ошибка SW:', err));
                });
            }
        </script>
    </body>
</html>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Messenger</title>
    @vite(['resources/js/main.js'])
</head>
<body>
<div id="app"></div>
</body>
</html>
