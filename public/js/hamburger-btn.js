const BUTTON_HAMBURGER = document.querySelector('#hamburger');
const SIDEBAR = document.querySelector('#sidebar');

BUTTON_HAMBURGER.addEventListener('click', function() {
    this.classList.toggle('active');
    SIDEBAR.classList.toggle('active');
});