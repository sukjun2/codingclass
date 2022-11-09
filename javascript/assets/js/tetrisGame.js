const tetrisWrap = document.querySelector(".tetris__wrap");
const playground = tetrisWrap.querySelector(".playground > ul");
const tetrisFolder = document.querySelector(".icon4");
const tetrisLoading = document.querySelector(".tetris__loading");
const startBtn = document.querySelector(".message");
const tetScore = document.querySelector(".tetris__score .tetScore");
const tetResultWrap = document.querySelector(".tetris__result");
const tetResult = document.querySelector(".tetris__result .tetris_result");
const tetRestart = document.querySelector(".tetris_restart");

// variables
let rows = 14;
let cols = 10;
let tetrisScore = 0;
let duration = 500;
let downInterval;
let tempMovingItem;

// 블록 정보
const movingItem = {
    type: "Imino",
    direction: 0, //블록 모양
    top: 0,
    left: 3,
};
// 블록 좌표값
const blocks = {
    Tmino: [
        [
            [2, 1],
            [0, 1],
            [1, 0],
            [1, 1],
        ],
        [
            [1, 2],
            [0, 1],
            [1, 0],
            [1, 1],
        ],
        [
            [1, 2],
            [0, 1],
            [2, 1],
            [1, 1],
        ],
        [
            [2, 1],
            [1, 2],
            [1, 0],
            [1, 1],
        ],
    ],
    Imino: [
        [
            [0, 0],
            [0, 1],
            [0, 2],
            [0, 3],
        ],
        [
            [0, 0],
            [1, 0],
            [2, 0],
            [3, 0],
        ],
        [
            [0, 0],
            [0, 1],
            [0, 2],
            [0, 3],
        ],
        [
            [0, 0],
            [1, 0],
            [2, 0],
            [3, 0],
        ],
    ],
    Omino: [
        [
            [0, 0],
            [0, 1],
            [1, 0],
            [1, 1],
        ],
        [
            [0, 0],
            [0, 1],
            [1, 0],
            [1, 1],
        ],
        [
            [0, 0],
            [0, 1],
            [1, 0],
            [1, 1],
        ],
        [
            [0, 0],
            [0, 1],
            [1, 0],
            [1, 1],
        ],
    ],
    Zmino: [
        [
            [0, 0],
            [1, 0],
            [1, 1],
            [2, 1],
        ],
        [
            [1, 0],
            [0, 1],
            [1, 1],
            [0, 2],
        ],
        [
            [0, 0],
            [1, 0],
            [1, 1],
            [2, 1],
        ],
        [
            [1, 0],
            [0, 1],
            [1, 1],
            [0, 2],
        ],
    ],
    Smino: [
        [
            [1, 0],
            [2, 0],
            [0, 1],
            [1, 1],
        ],
        [
            [0, 0],
            [0, 1],
            [1, 1],
            [1, 2],
        ],
        [
            [1, 0],
            [2, 0],
            [0, 1],
            [1, 1],
        ],
        [
            [0, 0],
            [0, 1],
            [1, 1],
            [1, 2],
        ],
    ],
    Jmino: [
        [
            [0, 2],
            [1, 0],
            [1, 1],
            [1, 2],
        ],
        [
            [0, 0],
            [0, 1],
            [1, 1],
            [2, 1],
        ],
        [
            [0, 0],
            [1, 0],
            [0, 1],
            [0, 2],
        ],
        [
            [0, 0],
            [1, 0],
            [2, 0],
            [2, 1],
        ],
    ],
    Lmino: [
        [
            [0, 0],
            [0, 1],
            [0, 2],
            [1, 2],
        ],
        [
            [0, 0],
            [1, 0],
            [2, 0],
            [0, 1],
        ],
        [
            [0, 0],
            [1, 0],
            [1, 1],
            [1, 2],
        ],
        [
            [0, 1],
            [1, 1],
            [2, 0],
            [2, 1],
        ],
    ],
};
// 시작하기
function init() {
    tempMovingItem = { ...movingItem };
    for (let i = 0; i < rows; i++) {
        prependNewLine(); //블록 라인 만들기
    }
    // renderBlocks(); //블록 출력하기

    const seizedLi = document.querySelector(".playground > ul > li > ul");

    console.log(seizedLi.childNodes);
    seizedLi.childNodes.forEach((child) => {
        if (child.classList.contains(".seized")) {
            endTetris();
        }
    });
}

// 블록 만들기
function prependNewLine() {
    const li = document.createElement("li");
    const ul = document.createElement("ul");
    for (let j = 0; j < cols; j++) {
        const matrix = document.createElement("li");
        ul.prepend(matrix);
    }
    li.prepend(ul);
    playground.prepend(li);
}
// 블록 출력하기
function renderBlocks(moveType = "") {
    // const ty = tempMovingItem.type;
    // const di = tempMovingItem.direction;
    // const to = tempMovingItem.top;
    // const le = tempMovingItem.left;
    const { type, direction, top, left } = tempMovingItem;
    const movingBlocks = document.querySelectorAll(".moving");
    movingBlocks.forEach((moving) => {
        moving.classList.remove(type, "moving");
    });
    blocks[type][direction].some((block) => {
        const x = block[0] + left; //2 0 1 1
        const y = block[1] + top; //1 1 0 1
        const target = playground.childNodes[y] ? playground.childNodes[y].childNodes[0].childNodes[x] : null;
        const isAvailable = checkEmpty(target);
        if (isAvailable) {
            target.classList.add(type, "moving");
        } else {
            tempMovingItem = { ...movingItem };
            setTimeout(() => {
                renderBlocks();
                if (moveType === "top") {
                    seizeBlock();
                }
            }, 0);
            return true;
        }
        // console.log({ playground });
    });
    movingItem.left = left;
    movingItem.top = top;
    movingItem.direction = direction;
}

// 빈칸 감지
function checkEmpty(target) {
    if (!target || target.classList.contains("seized")) {
        return false;
    }
    return true;
}

// 블록 감지하기
function seizeBlock() {
    const movingBlocks = document.querySelectorAll(".moving");
    movingBlocks.forEach((moving) => {
        moving.classList.remove("moving");
        moving.classList.add("seized");
    });
    checkMatch();
}
// 한 줄 제거하기
function checkMatch() {
    const childNodes = playground.childNodes;
    childNodes.forEach((child) => {
        let matched = true;
        child.children[0].childNodes.forEach((li) => {
            if (!li.classList.contains("seized")) {
                matched = false;
            }
        });
        if (matched) {
            child.remove();
            prependNewLine();
            tetrisScore++;
            tetScore.textContent = tetrisScore;
        }
    });
    generateNewBlock();
}
// 새로운 블록 만들기
function generateNewBlock() {
    clearInterval(downInterval);

    downInterval = setInterval(() => {
        moveBlock("top", 1);
    }, duration);

    const blockArray = Object.entries(blocks);
    const randomIndex = Math.floor(Math.random() * blockArray.length);

    movingItem.type = blockArray[randomIndex][0];
    movingItem.top = 0;
    movingItem.left = 3;
    movingItem.direction = 0;
    tempMovingItem = { ...movingItem };
}

// 블록 움직이기
function moveBlock(moveType, amount) {
    tempMovingItem[moveType] += amount;
    renderBlocks(moveType);
}

// 모양 바꾸기
function changeDirection() {
    const direction = tempMovingItem.direction;
    direction === 3 ? (tempMovingItem.direction = 0) : (tempMovingItem.direction += 1);
    renderBlocks();
}

// 빨리 내리기
function dropBlock() {
    clearInterval(downInterval);
    downInterval = setInterval(() => {
        moveBlock("top", 1);
    }, 10);
}

// 이벤트
document.addEventListener("keydown", (e) => {
    switch (e.keyCode) {
        case 39:
            moveBlock("left", 1);
            break;
        case 37:
            moveBlock("left", -1);
            break;
        case 40:
            moveBlock("top", 1);
            break;
        case 38:
            changeDirection();
            break;
        case 32:
            dropBlock();
            break;
        default:
            break;
    }
});

// 게임 끝났을 때
function endTetris() {
    // 시작 버튼 만들기
    tetrisLoading.style.display = "block";
    startBtn.style.display = "none";

    // 메시지 출력
    tetResultWrap.classList.add("show");
    tetResult.innerHTML = `당신의 점수는 ${tetrisScore}점 입니다!`;
}

// 게임 ON/OFF
tetrisFolder.addEventListener("dblclick", () => {
    tetrisWrap.classList.toggle("show");
    $(".tetris__wrapper").css("z-index", "1000");
    $(".music__wrap").css("z-index", "0");
    $(".memory__wrap").css("z-index", "0");
    $(".search__wrap").css("z-index", "0");
});

// 게임 start button
startBtn.addEventListener("click", () => {
    tetrisLoading.classList.add("hide");
    generateNewBlock(); //블록 만들기
});

// 닫기 버튼
const tetrisClose = document.querySelector(".tetris__wrapper");

tetrisClose.addEventListener("click", () => {
    tetrisWrap.classList.remove("show");
});

init();
