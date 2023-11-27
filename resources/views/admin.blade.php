<!DOCTYPE html>
<html class="h-screen overflow-y-auto" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>The Social Machine ADMIN</title>
    @vite('resources/css/app.css')
    <!-- Fonts -->
</head>
<body class="antialiased h-screen overflow-y-auto" style="height: 100vh">
<div id="app" class="h-screen overflow-y-auto">
    @vite('resources/js/admin/admin.ts')
</div>
</body>
</html>
