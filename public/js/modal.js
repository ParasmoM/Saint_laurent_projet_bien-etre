console.log('Début du script qui gère les modal');
const MODAL_ERROR_FORM      = document.getElementById('modal-error-form');
const MODAL_ERROR_SETTINGS  = document.getElementById('modal-error-settings');
const MODAL_ERROR_DASHBOARD = document.getElementById('modal-error-dashboard');
const MODAL_ERROR_HOME = document.getElementById('modal-error-home');
const MODAL_ERROR_CONTACT = document.getElementById('modal-error-contact');

document.addEventListener('click', function() {
    if (MODAL_ERROR_FORM) {
        MODAL_ERROR_FORM.classList.remove('active');
    }
    if (MODAL_ERROR_SETTINGS) {
        MODAL_ERROR_SETTINGS.classList.remove('active');
    }
    if (MODAL_ERROR_DASHBOARD) {
        MODAL_ERROR_DASHBOARD.classList.remove('active');
    }
    if (MODAL_ERROR_HOME) {
        MODAL_ERROR_HOME.classList.remove('active');
    }
    if (MODAL_ERROR_CONTACT) {
        MODAL_ERROR_CONTACT.classList.remove('active');
    }
});
