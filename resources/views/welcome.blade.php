<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TryCat</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">

    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body>
    <main x-data="game"
          @keyup.window="onKeyPress($event.key)">
        <header>
            <h1 aria-label="TryCat">
                <img src="/images/tyler-logo.jpg" alt="" class="w-36 h-36 rounded-full mx-auto">
            </h1>

            <hint class="text-left">
                <div class="font-bold text-sm">Hint</div>
                <span x-text="hint" class="text-blue-200"></span>
            </hint>
            <output x-text="message"></output>


        </header>

        <div id="game">
            <template x-for="(row, index) in board">
                <div class="row" :class="{'current' : currentRowIndex === index, 'invalid' : currentRowIndex === index && errors}">
                    <template x-for="tile in row">
                        <div class="tile" :class="tile.status" x-text="tile.letter"></div>
                    </template>
                </div>
            </template>
        </div>

        <div id="keyboard" @click.stop="handleClick($event)">
            <template x-for="row in letters">
                <div class="row">
                    <template x-for="key in row">
                        <button
                            class="key"
                            :class="matchingTileForKey(key)?.status"
                            type="button"
                            :data-key="key"
                        >
                            <template x-if="key === 'Backspace'">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mx-2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9.75L14.25 12m0 0l2.25 2.25M14.25 12l2.25-2.25M14.25 12L12 14.25m-2.58 4.92l-6.375-6.375a1.125 1.125 0 010-1.59L9.42 4.83c.211-.211.498-.33.796-.33H19.5a2.25 2.25 0 012.25 2.25v10.5a2.25 2.25 0 01-2.25 2.25h-9.284c-.298 0-.585-.119-.796-.33z" />
                                </svg>
                            </template>
                            <template x-if="key === 'Enter'">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mx-2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                </svg>
                            </template>

                            <template x-if="key !== 'Backspace' && key !== 'Enter'">
                                <span x-text="key"></span>
                            </template>
                        </button>
                    </template>
                </div>
            </template>
        </div>
    </main>
</body>
</html>
