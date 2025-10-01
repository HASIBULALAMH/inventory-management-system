// location.js - Reusable location selector module with autofill
class LocationSelector {
    constructor(config) {
        this.countryId = config.countryId;
        this.stateId = config.stateId;
        this.cityId = config.cityId;
        this.zipcodeId = config.zipcodeId;
        this.baseUrl = config.baseUrl || '/admin/warehouse';
        this.init();
    }

    init() {
        this.bindEvents();
    }

    bindEvents() {
        const countrySelect = document.getElementById(this.countryId);
        const stateSelect = document.getElementById(this.stateId);
        const citySelect = document.getElementById(this.cityId);
        const zipcodeInput = document.getElementById(this.zipcodeId);

        if (!countrySelect || !stateSelect || !citySelect || !zipcodeInput) {
            console.error('One or more elements not found');
            return;
        }

        // Country -> State
        countrySelect.addEventListener('change', () => {
            this.loadStates(countrySelect.value, stateSelect, citySelect, zipcodeInput)
                .then(() => citySelect.innerHTML = '<option value="">-- Select City --</option>');
        });

        // State -> City
        stateSelect.addEventListener('change', () => {
            this.loadCities(stateSelect.value, citySelect, zipcodeInput);
        });

        // City -> Zipcode
        citySelect.addEventListener('change', () => {
            const selected = citySelect.options[citySelect.selectedIndex];
            zipcodeInput.value = selected?.getAttribute('data-zipcode') || '';
        });
    }

    loadStates(countryId, stateSelect, citySelect, zipcodeInput) {
        return new Promise((resolve) => {
            if (!countryId) {
                stateSelect.innerHTML = '<option value="">-- Select State --</option>';
                citySelect.innerHTML = '<option value="">-- Select City --</option>';
                zipcodeInput.value = '';
                resolve();
                return;
            }

            fetch(`${this.baseUrl}/get-states/${countryId}`)
                .then(response => response.json())
                .then(data => {
                    stateSelect.innerHTML = '<option value="">-- Select State --</option>';
                    data.forEach(state => {
                        stateSelect.innerHTML += `<option value="${state.id}">${state.name}</option>`;
                    });
                    citySelect.innerHTML = '<option value="">-- Select City --</option>';
                    zipcodeInput.value = '';
                    resolve();
                })
                .catch(error => {
                    console.error('Error loading states:', error);
                    resolve();
                });
        });
    }

    loadCities(stateId, citySelect, zipcodeInput) {
        return new Promise((resolve) => {
            if (!stateId) {
                citySelect.innerHTML = '<option value="">-- Select City --</option>';
                zipcodeInput.value = '';
                resolve();
                return;
            }

            fetch(`${this.baseUrl}/get-cities/${stateId}`)
                .then(response => response.json())
                .then(data => {
                    citySelect.innerHTML = '<option value="">-- Select City --</option>';
                    data.forEach(city => {
                        citySelect.innerHTML += `<option value="${city.id}" data-zipcode="${city.zip_code || ''}">${city.name}</option>`;
                    });
                    zipcodeInput.value = '';
                    resolve();
                })
                .catch(error => {
                    console.error('Error loading cities:', error);
                    resolve();
                });
        });
    }
}

// Function to initialize location selector
function initLocationSelector(config) {
    return new LocationSelector(config);
}

// Permanent Address autofill
function enablePermanentAutofill(presentIds, permanentIds, checkboxId) {
    const checkbox = document.getElementById(checkboxId);
    const presentCountry = document.getElementById(presentIds.countryId);
    const presentState = document.getElementById(presentIds.stateId);
    const presentCity = document.getElementById(presentIds.cityId);
    const presentZip = document.getElementById(presentIds.zipcodeId);

    const permCountry = document.getElementById(permanentIds.countryId);
    const permState = document.getElementById(permanentIds.stateId);
    const permCity = document.getElementById(permanentIds.cityId);
    const permZip = document.getElementById(permanentIds.zipcodeId);

    checkbox.addEventListener('change', async function() {
        if (this.checked) {
            // Copy Country
            permCountry.value = presentCountry.value;
            permCountry.dispatchEvent(new Event('change'));

            // Wait for states to load
            await waitForOptionsLoad(permState);
            permState.value = presentState.value;
            permState.dispatchEvent(new Event('change'));

            // Wait for cities to load
            await waitForOptionsLoad(permCity);
            permCity.value = presentCity.value;
            permCity.dispatchEvent(new Event('change'));

            // Copy Zipcode
            permZip.value = presentZip.value;
        } else {
            permCountry.value = '';
            permState.innerHTML = '<option value="">-- Select State --</option>';
            permCity.innerHTML = '<option value="">-- Select City --</option>';
            permZip.value = '';
        }
    });

    function waitForOptionsLoad(selectElement) {
        return new Promise(resolve => {
            const interval = setInterval(() => {
                if (selectElement.options.length > 1) {
                    clearInterval(interval);
                    resolve();
                }
            }, 50);
        });
    }
}
