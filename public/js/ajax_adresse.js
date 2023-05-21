document.addEventListener('DOMContentLoaded', () => {
    const SEARCH_NAME = document.getElementById('search_name');
    const SEARCH_SERVICE = document.getElementById('search_service');
    const SEARCH_CODE = document.getElementById('search_code');
    const SEARCH_TOWN = document.getElementById('search_town');
    const SEARCH_LOCALITY = document.getElementById('search_locality');

    const clearSelect = (select) => {
        while (select.firstChild) {
            select.removeChild(select.firstChild);
        }
    };

    const updateSelectedOption = (select, value) => {
        Array.from(select.options).forEach((option, index) => {
            if (option.value == value) {
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

        select(SEARCH_LOCALITY, dataFilter.localites);

        updateSelectedOption(SEARCH_TOWN, dataFilter.communes[0]);
        updateSelectedOption(SEARCH_CODE, dataFilter.codes[0]);
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
            const dataFilter = displayFilteredData(data);
            insertDataIntoSelectors(dataFilter);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    };

    SEARCH_NAME.addEventListener('input', () => {
        // Code à exécuter lorsque l'input change
    });

    SEARCH_SERVICE.addEventListener('change', () => {
        // Code à exécuter lorsque la catégorie change
    });

    SEARCH_CODE.addEventListener('change', () => {
        const FILTER = {
            Code: SEARCH_CODE.value,
        };
        clearSelect(SEARCH_LOCALITY);
        updateSelectedOption(SEARCH_TOWN, 0);
        fetchFilteredData(FILTER);
    });

    SEARCH_TOWN.addEventListener('change', () => {
        const FILTER = {
            Commune: SEARCH_TOWN.value,
        };
        clearSelect(SEARCH_LOCALITY);
        updateSelectedOption(SEARCH_CODE, 0);
        fetchFilteredData(FILTER);
    });
});
