// Toggle menu when 'menuToggle' is clicked
document.getElementById('menuToggle').addEventListener('click', function (e) {
    e.preventDefault();
    const sidebarWrap = document.querySelector('.sidebar-wrap');
    sidebarWrap.classList.toggle('show');
    e.stopPropagation(); // Stop the click event from propagating further
});

// Hide menu when clicking anywhere on the page except the menu
document.body.addEventListener('click', function (e) {
    const sidebarWrap = document.querySelector('.sidebar-wrap');
    const menuToggle = document.getElementById('menuToggle');
    
    // Check if the click is outside the '.sidebar-wrap' and not on 'menuToggle'
    if (!sidebarWrap.contains(e.target) && e.target !== menuToggle) {
        sidebarWrap.classList.remove('show');
    }
});
