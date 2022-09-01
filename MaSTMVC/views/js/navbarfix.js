document
    .getElementById('clickbtn')
    .addEventListener('click', showAdvanced);
let x = 0;
function showAdvanced() {
    let el = document.getElementsByTagName('body')[0];
    if (x === 0) {
        el.style.overflow="hidden";
        x=1;
    } else {
        el.style.overflow="auto";
        x=0;
    }
}
