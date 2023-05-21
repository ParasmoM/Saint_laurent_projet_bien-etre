document.addEventListener('DOMContentLoaded', () => {
    const FORM_PHOTO = document.getElementById('profile-photo-form');
    const FORM_LOGO = document.getElementById('profile-logo-form');
    const FORM_PROFILE = document.getElementById('user-settings__form-profile');
    const UPLOAD_PHOTO = document.getElementById('upload-input');
    const UPLOAD_LOGO = document.getElementById('upload-logo');
    const SETTINGS_CODE = document.getElementById('users_form_postalCode');
    const SETTINGS_TOWN = document.getElementById('users_form_town');
    const SETTINGS_LOCALITY = document.getElementById('users_form_locality');

    // Retire tout les options du select 
    const clearSelect = (select) => {
        while (select.firstChild) {
            select.removeChild(select.firstChild);
        }
    };

    const updateSelectedOption = (select, text) => {
        Array.from(select.options).forEach((option, index) => {
            if (option.innerText === text) {
                select.selectedIndex = index;
            }
        });
    };

    const insertDataIntoSelectors = (dataFilter) => {
        const select = (select, data) => {
            data.forEach(value => {
                let option = document.createElement('option');
                option.value = value;
                option.text = value;
                select.add(option);
            });
        };

        // select(SETTINGS_LOCALITY, dataFilter.localites);

        updateSelectedOption(SETTINGS_TOWN, dataFilter.communes[0]);
        updateSelectedOption(SETTINGS_CODE, dataFilter.codes[0]);
        updateSelectedOption(SETTINGS_LOCALITY, dataFilter.localites[0]);
    };

    const displayFilteredData = (data) => {
        const CODES = [];
        const LOCALITIES = [];
        const COMMUNES = [];

        data.forEach(element => {
            if (element.hasOwnProperty('Code') && !CODES.includes(element.Code)) {
                CODES.push(element.Code);
            }
            if (element.hasOwnProperty('Localite') && !LOCALITIES.includes(element.Localite)) {
                LOCALITIES.push(element.Localite);
            }
            if (element.hasOwnProperty('Commune') && !COMMUNES.includes(element.Commune)) {
                COMMUNES.push(element.Commune);
            }
        });

        return {
            codes: CODES,
            localites: LOCALITIES,
            communes: COMMUNES,
        };
    };

    const fetchFilteredData = (filter) => {
        fetch('/providers/get-data', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(filter)
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            const dataFilter = displayFilteredData(data);
            insertDataIntoSelectors(dataFilter);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    };

    SETTINGS_CODE.addEventListener('change', () => {
        const FILTER = {
            Code: SETTINGS_CODE.options[SETTINGS_CODE.selectedIndex].innerText,
        };
        // clearSelect(SETTINGS_LOCALITY);
        updateSelectedOption(SETTINGS_TOWN, 0);
        updateSelectedOption(SETTINGS_LOCALITY, 0);
        fetchFilteredData(FILTER);
    });

    SETTINGS_TOWN.addEventListener('change', () => {
        const FILTER = {
            Commune: SETTINGS_TOWN.options[SETTINGS_TOWN.selectedIndex].innerText,
        };
        // clearSelect(SETTINGS_LOCALITY);
        updateSelectedOption(SETTINGS_CODE, 0);
        updateSelectedOption(SETTINGS_LOCALITY, 0);
        fetchFilteredData(FILTER);
    });
    
    UPLOAD_PHOTO.addEventListener('change', function() {
        FORM_PHOTO.submit();
    });

    UPLOAD_LOGO.addEventListener('change', function() {
        FORM_LOGO.submit();
    });
});
