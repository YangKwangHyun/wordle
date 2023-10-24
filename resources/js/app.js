let grid = document.querySelector('#game');


let guessesAllowed = 4;
let wordLength = 3;

// generate 3 rows
let fragment = document.createDocumentFragment();

let generatedGrid = () => {


    Array.from({length: guessesAllowed}).forEach(() => {
        let row = document.createElement('div');

        row.classList.add('row');

        Array.from({length: wordLength}).forEach(() => {
            let tile = document.createElement('div');
            tile.classList.add('tile');

            row.appendChild(tile);
        });

        fragment.appendChild(row);
    });

    grid.appendChild(fragment);
}

// Init
generatedGrid();


