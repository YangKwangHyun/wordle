<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TryCat</title>
    @vite('resources/css/app.css')
    <script src="//unpkg.com/alpinejs" defer></script>

</head>
<body>
    <div id="game" x-data="{ guessesAllowed: 4, wordLength: 3 }">
        <template x-for="row in Array.from({ length: guessesAllowed })">
            <div class="row">
                <template x-for="tile in Array.from({ length: wordLength })">
                    <div class="tile"></div>
                </template>
            </div>
        </template>
    </div>
{{--    @vite('resources/js/app.js')--}}
</body>
</html>
