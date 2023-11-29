document.getElementById('menuToggle').addEventListener('click',function (e) {
    e.preventDefault(); 
    document.querySelector('.sidebar-wrap').classList.toggle('show');
}); 