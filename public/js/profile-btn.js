const BUTTON_PROFILE = document.querySelector('#profile');
const PROFILE_DROPDOWN = document.querySelector('#profile-dropdown');

BUTTON_PROFILE.addEventListener('click', function(event) {
    event.stopPropagation();
    PROFILE_DROPDOWN.classList.toggle('active');
});

document.addEventListener('click', function() {
    if (PROFILE_DROPDOWN.classList.contains('active')) {
        PROFILE_DROPDOWN.classList.remove('active');
    }
});
