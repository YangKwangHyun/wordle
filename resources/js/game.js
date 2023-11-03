import Tile from "./Tile";
import {allWords, theWords} from "./words";

export default {

    guessesAllowed: 3,
    theWord: theWords[Math.floor(Math.random() * theWords.length)],
    currentRowIndex: 0,
    state: 'active',
    errors: false,
    message: '',

    letters: [
        'QWERTYUIOP'.split(""),
        'ASDFGHJKL'.split(""),
        ["Enter", ...'ZXCVBNM'.split(""), "Backspace"]
    ],

    get currentRow() {
        return this.board[this.currentRowIndex];
    },

    get currentGuess() {
        return this.currentRow.map(tile => tile.letter).join('');
    },

    get remainingGuesses() {
        return this.guessesAllowed - this.currentRowIndex - 1;
    },

    init() {
        this.board = Array.from({length: this.guessesAllowed}, () => {
            return Array.from({length: this.theWord.word.length}, (item, index) => new Tile(index));
        })

        this.hint = this.theWord.hint;
    },

    matchingTileForKey(key) {
        if (key === 'Enter' || key === 'Backspace') {
            return {status: key.toLowerCase()}; // 이를 통해 "enter" 또는 "backspace" 클래스를 반환합니다.
        }

        return this.board
            .flat()
            .filter((tile) => tile.status)
            .sort((t1, t2) => {
                return t1.status === 'correct' ? -1 : 1;
            })
            .find((tile) => tile.letter === key.toLowerCase());
    },

    onKeyPress(key) {
        this.message = '';
        this.errors = false;

        if (/^[A-z]$/.test(key)) {
            this.fillTile(key);
        } else if (key === 'Backspace') {
            this.emptyTile();
        } else if (key === 'Enter') {
            this.submitGuess();
        }
    },

    fillTile(key) {
        for (let tile of this.currentRow) {
            if (!tile.letter) {
                tile.fill(key);
                break;
            }
        }
    },

    emptyTile() {
        for (let tile of [...this.currentRow].reverse()) {
            if (tile.letter) {
                tile.empty();

                break;
            }
        }
    },

    submitGuess() {
        if (this.currentGuess.length < this.theWord.word.length) return;

        if (!allWords.includes(this.currentGuess.toUpperCase())) {
            this.errors = true;
            this.message = 'Invalid Word...';

            return;
        }

        Tile.updateStatusesForRow(this.currentRow, this.theWord.word);

        if (this.currentGuess === this.theWord.word) {
            this.state = 'complete';
            this.message = 'You Win!';
        } else if (this.remainingGuesses === 0) {
            this.state = 'complete';
            this.message = `Game Over. You Lose. (${this.theWord.word})`;
        } else {
            this.currentRowIndex++;
            this.message = 'Incorrect';
        }
    },

    handleClick(event) {
        const button = event.target.closest('button');

        // key는 data-key 속성을 통해 전달됩니다.
        const key = button.dataset.key;

        this.onKeyPress(key);
    }
}
