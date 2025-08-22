const sidebarToggle = document.getElementById('sidebarToggle');
const sidebar = document.getElementById('sidebar');
const mainContent = document.getElementById('main-content');
const modeToggle = document.getElementById('modeToggle');
const body = document.body;

// Sidebar collapse
if (sidebarToggle) {
    sidebarToggle.addEventListener('click', () => {
        if (sidebar.style.width === '250px' || sidebar.style.width === '') {
            sidebar.style.width = '80px';
            mainContent.style.marginLeft = '80px';
            sidebar.querySelectorAll('.nav-link span').forEach(span => span.style.display = 'none');
        } else {
            sidebar.style.width = '250px';
            mainContent.style.marginLeft = '250px';
            sidebar.querySelectorAll('.nav-link span').forEach(span => span.style.display = 'inline');
        }
    });
}

// Light/Dark Mode toggle
modeToggle.addEventListener('click', () => {
    body.classList.toggle('dark-mode');
    body.classList.toggle('light-mode');
    const icon = modeToggle.querySelector('i');
    icon.classList.toggle('bi-moon-fill');
    icon.classList.toggle('bi-sun-fill');
});

// Chart.js Inventory Trend
const inventoryCtx = document.getElementById('inventoryChart').getContext('2d');
new Chart(inventoryCtx, {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        datasets: [{
            label: 'Inventory',
            data: [200, 180, 220, 190, 230, 210, 250],
            borderColor: '#6f42c1',
            backgroundColor: 'rgba(111,66,193,0.2)',
            tension: 0.3, fill: true
        }]
    },
    options: { responsive: true, plugins: { legend: { display: true } } }
});

// Chart.js Sales Trend
const salesCtx = document.getElementById('salesChart').getContext('2d');
new Chart(salesCtx, {
    type: 'bar',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        datasets: [{
            label: 'Sales',
            data: [5000, 4000, 6000, 4500, 7000, 6500, 8000],
            backgroundColor: '#28a745'
        }]
    },
    options: { responsive: true, plugins: { legend: { display: false } } }
});

// Optional: Mouse move reactive gradient
sidebar.addEventListener('mousemove', (e) => {
    const { width, height } = sidebar.getBoundingClientRect();
    const x = e.offsetX / width * 100;
    const y = e.offsetY / height * 100;
    sidebar.style.setProperty('--gradient-x', `${x}%`);
    sidebar.style.setProperty('--gradient-y', `${y}%`);
});
