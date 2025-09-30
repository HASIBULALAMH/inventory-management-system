  // Manager -> details
  document.getElementById("manager").addEventListener("change", function() {
    let managerId = this.value;
    if(managerId) {
        fetch(`/admin/warehouse/get-manager/${managerId}`)
        .then(res => res.json())
        .then(data => {
            document.getElementById("manager_email").value = data.email || '';
            document.getElementById("manager_phone").value = data.phone || '';
        })
        .catch(err => {
            console.error('Error fetching manager details:', err);
            document.getElementById("manager_email").value = '';
            document.getElementById("manager_phone").value = '';
        });
    } else {
        document.getElementById("manager_email").value = '';
        document.getElementById("manager_phone").value = '';
    }
});