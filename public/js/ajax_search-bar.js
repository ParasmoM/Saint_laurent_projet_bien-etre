window.onload = () => {
    const FORM_SEARCH_BAR   = document.getElementById('search_bar');
    const INPUT_NOM         = document.getElementById('search_name');
    const SELECT_CATEGORIE  = document.getElementById('search_service');
    const SELECT_CODE       = document.getElementById('search_code');
    const SELECT_COMMUNE    = document.getElementById('search_town');
    const SELECT_LOCALITE   = document.getElementById('search_locality');

    const getFormDataAndCurrentUrl = (formElement) => {
        console.log('ici');
        const FORM_DATA = new FormData(formElement);
    
        // On fabrique la "queryString"
        const PARAMS = new URLSearchParams();
    
        FORM_DATA.forEach((value, key) => {
            PARAMS.append(key, value);
        });
    
        // On récupère l'url active
        const currentUrl = new URL(window.location.href);
    
        return {
            PARAMS,
            currentUrl,
        };
    };

    const fetchSearchResults = (url, params) => {
        fetch(url.pathname + "?" + params.toString(), {
            headers: {
                "X-Requested-With": "XMLHttpRequest"
            }
        }).then(response => 
            response.json()
        ).then(data => {
            // On va chercher la zone de contenu 
            const CONTENT = document.getElementById("prestataire_card");

            // ON remplace le contenu
            CONTENT.innerHTML = data.content;
            console.log(data, data.content);
            // On met à jour l'url
            history.pushState({}, null, url.pathname + "?" + params.toString());
        })
    };
    
    const handleInputChange = () => {
        console.log('change input');
        const { PARAMS, currentUrl } = getFormDataAndCurrentUrl(FORM_SEARCH_BAR);
        fetchSearchResults(currentUrl, PARAMS); 
    };
    
    const handleSelectChange = () => {
        console.log('change select');
        const { PARAMS, currentUrl } = getFormDataAndCurrentUrl(FORM_SEARCH_BAR);
        fetchSearchResults(currentUrl, PARAMS); 
    };
    
    
    INPUT_NOM.addEventListener('input', handleInputChange);
    SELECT_CATEGORIE.addEventListener('change', handleSelectChange);
    SELECT_CODE.addEventListener('change', handleSelectChange);
    SELECT_COMMUNE.addEventListener('change', handleSelectChange);
    SELECT_LOCALITE.addEventListener('change', handleSelectChange);
}