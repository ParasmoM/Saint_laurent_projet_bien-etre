console.log('Début du script qui gère la relation des sélecteurs d\'adresse settings');

document.addEventListener('DOMContentLoaded', () => {
    const FORM_PHOTO = document.getElementById('profile-photo-form');
    const UPLOAD_INPUT = document.getElementById('upload-input');

    UPLOAD_INPUT.addEventListener('change', function() {
        FORM_PHOTO.submit();
        console.log('upluod');
    });

    console.log('finished');
});
