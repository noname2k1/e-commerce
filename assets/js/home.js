//disable Scroll when menu mobile on
const checkboxMenu = document.querySelector(
    ' input[type="checkbox"]#mobile-menu'
);
let winX = null;
let winY = null;

window.addEventListener('scroll', function () {
    if (winX !== null && winY !== null) {
        window.scrollTo(winX, winY);
    }
});

function disableWindowScroll() {
    winX = window.scrollX;
    winY = window.scrollY;
}
function enableWindowScroll() {
    winX = null;
    winY = null;
}

checkboxMenu.addEventListener('change', function () {
    checkboxMenu.checked ? disableWindowScroll() : enableWindowScroll();
});
