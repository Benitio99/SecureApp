//  Pierce Bennett C00242526
//	27/02/22
//  Javascript for open popout menu and close popout menu
//*********************************************************

function init() {

    var hamburger = document.getElementById("hamburger");
    hamburger.addEventListener("click", toggleMenu);

    function toggleMenu() {

        var main = document.getElementById("mainArea");
        var nav = document.getElementById("navWrapper");
        var barOne = document.getElementById("barOne");
        var barTwo = document.getElementById("barTwo");
        var barThree = document.getElementById("barThree");
        main.classList.toggle('hide');
        nav.classList.toggle('show');
        barOne.classList.toggle('cross');
        barTwo.classList.toggle('cross');
        barThree.classList.toggle('cross');
    }

}
document.addEventListener("DOMContentLoaded", init, false);