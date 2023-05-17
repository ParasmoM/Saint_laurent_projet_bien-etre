const BUTTON_SIMILAR_PROVIDER = document.getElementById('provider-similar-filter');
const UL_SIMILAR_PROVIDER = document.getElementById('provider-similar-filter-content');
const PROVIDER_PROFILE_CONTAINER = document.querySelector('.provider_profile');

BUTTON_SIMILAR_PROVIDER.addEventListener('click', function() {
    UL_SIMILAR_PROVIDER.classList.toggle('active');
});

PROVIDER_PROFILE_CONTAINER.addEventListener('click', function(event) {
    if (!BUTTON_SIMILAR_PROVIDER.contains(event.target) && UL_SIMILAR_PROVIDER.classList.contains('active')) {
        UL_SIMILAR_PROVIDER.classList.remove('active');
    }
});

const LI_ELEMENTS = document.querySelectorAll('#provider-similar-filter-content li');
const PROVIDER_ID_ELEMENT = document.querySelector('#provider-similar-filter'); 
const PROVIDER_ID = PROVIDER_ID_ELEMENT.getAttribute('data-id');

const fetchFilteredData = (filter) => {
    fetch('/providers/get-filter-similar', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(filter)
    })
    .then(response => response.json())
    .then(data => {
        // On va chercher la zone de contenu 
        const CONTENT = document.getElementsByClassName("prestataire_card");

        CONTENT.innerHTML = data.content;
        console.log(data, data.content);
    })
    .catch(error => {
        console.error('Error:', error);
    });
};

LI_ELEMENTS.forEach(function(li) {
    li.addEventListener('click', function() {
        const TAB = [];
        TAB.push(this.innerText);
        TAB.push(PROVIDER_ID);
        fetchFilteredData(TAB); 
    });
});

