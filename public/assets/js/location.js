// Country -> State
document.getElementById("country").addEventListener("change", function() {
    let countryId = this.value;
    let stateSelect = document.getElementById("state");
    let citySelect  = document.getElementById("city");
    stateSelect.innerHTML = '<option value="">-- Select State --</option>';
    citySelect.innerHTML = '<option value="">-- Select City --</option>';
    document.getElementById("zipcode").value = '';
    
    if(countryId) {
        fetch(`/admin/warehouse/get-states/${countryId}`)
        .then(res => {
            if (!res.ok) {
                throw new Error('Network response was not ok');
            }
            return res.json();
        })
        .then(data => {
            data.forEach(state => {
                stateSelect.innerHTML += `<option value="${state.id}">${state.name}</option>`;
            });
        })
        .catch(err => {
            console.error('Error fetching states:', err);
            alert('Error loading states. Please try again.');
        });
    }
});

// State -> City
document.getElementById("state").addEventListener("change", function() {
    let stateId = this.value;
    let citySelect = document.getElementById("city");
    citySelect.innerHTML = '<option value="">-- Select City --</option>';
    document.getElementById("zipcode").value = '';
    
    if(stateId) {
        fetch(`/admin/warehouse/get-cities/${stateId}`)
        .then(res => {
            if (!res.ok) {
                throw new Error('Network response was not ok');
            }
            return res.json();
        })
        .then(data => {
            data.forEach(city => {
                citySelect.innerHTML += `<option value="${city.id}" data-zipcode="${city.zip_code || ''}">${city.name}</option>`;
            });
        })
        .catch(err => {
            console.error('Error fetching cities:', err);
            alert('Error loading cities. Please try again.');
        });
    }
});

// City -> Zipcode
document.getElementById("city").addEventListener("change", function() {
    let selected = this.options[this.selectedIndex];
    let zipcode = selected.getAttribute("data-zipcode") || '';
    document.getElementById("zipcode").value = zipcode;
});