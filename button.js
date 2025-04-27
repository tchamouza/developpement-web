
function toggleUserMenu() {
    const userInfo = document.getElementById('userInfo');
    userInfo.classList.toggle('active');
    
    // Fermer le menu si on clique ailleurs
    document.addEventListener('click', function closeMenu(e) {
        if (!e.target.closest('.user')) {
            userInfo.classList.remove('active');
            document.removeEventListener('click', closeMenu);
        }
    });
}