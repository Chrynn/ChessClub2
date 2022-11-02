function hideFlash() {

    let flash = document.querySelector(".flash");

    if (flash) {
        setTimeout(() => {
            fadeAway();
        }, 5000)
    }

    function fadeAway() {
        flash?.classList.remove("visible");
    }

}
hideFlash();


function hamburger() {

    let menuLine = document.querySelector('.hamburger-div2');
    let menuOpen = false;
    menuLine.addEventListener('click', () => {
        
        if (!menuOpen) {
            menuLine.classList.add('open2');
            menuOpen = true;
        } else {
            menuLine.classList.remove('open2');
            menuOpen = false;
        }
    });

    const menuBtnTwo = document.querySelector('.hamburger-div2');
    let menuOpenTwo = false;
    let navULTwo = document.querySelector(".header");
    menuBtnTwo.addEventListener('click', () => {

        if (!menuOpenTwo) {
            menuBtnTwo.classList.add('open');
            menuOpenTwo = true;
            navULTwo.classList.add('window-active');
        } else {
            menuBtnTwo.classList.remove('open');
            menuOpenTwo = false;
            navULTwo.classList.remove('window-active');
        }
    });
 
}
hamburger();
