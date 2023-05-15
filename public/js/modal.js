console.log('Début du script qui gère les modal');
const MODAL_ERROR_FORM      = document.getElementById('modal-error-form');
const MODAL_ERROR_SETTINGS  = document.getElementById('modal-error-settings');
const MODAL_ERROR_DASHBOARD = document.getElementById('modal-error-dashboard');
const MODAL_ERROR_HOME = document.getElementById('modal-error-home');


document.addEventListener('click', function() {
    MODAL_ERROR_FORM.classList.remove('active');
});
document.addEventListener('click', function() {
    MODAL_ERROR_SETTINGS.classList.remove('active');
});
document.addEventListener('click', function() {
    MODAL_ERROR_DASHBOARD.classList.remove('active');
});
document.addEventListener('click', function() {
    MODAL_ERROR_HOME.classList.remove('active');
});