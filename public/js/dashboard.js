console.log('Début du script qui gère le dashboard');
const BUTTONS_ELLIPSIS_ICONE    = document.querySelectorAll('#btn-ellipsis-dashboard');
const MODAL_ERROR_FORM          = document.getElementById('modal-error-form');

BUTTONS_ELLIPSIS_ICONE.forEach(button => {
    button.addEventListener('click', function(e) {
        BUTTONS_ELLIPSIS_ICONE.forEach(btn => {
            btn.classList.remove('active');
        });
        this.classList.add('active');
        e.stopPropagation();
    });
});

document.addEventListener('click', function() {
    BUTTONS_ELLIPSIS_ICONE.forEach(button => {
        if(button.classList.contains('active')) {
            button.classList.remove('active');
        }
    });
});

document.addEventListener('click', function() {
    MODAL_ERROR_FORM.classList.remove('active');
});
