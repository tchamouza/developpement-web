// JavaScript pour airlineTRAVEL

document.addEventListener('DOMContentLoaded', function() {
    // Validation des dates pour les réservations
    const dateDepart = document.getElementById('date_depart');
    const dateRetour = document.getElementById('date_retour');
    
    if (dateDepart && dateRetour) {
        dateDepart.addEventListener('change', function() {
            const departDate = new Date(this.value);
            const minRetour = new Date(departDate);
            minRetour.setDate(minRetour.getDate() + 1);
            
            dateRetour.min = minRetour.toISOString().split('T')[0];
            
            if (dateRetour.value && new Date(dateRetour.value) <= departDate) {
                dateRetour.value = '';
            }
        });
    }
    
    // Auto-hide des messages flash après 5 secondes
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.opacity = '0';
            setTimeout(() => {
                alert.remove();
            }, 300);
        }, 5000);
    });
    
    // Navigation mobile (si nécessaire)
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    
    if (mobileMenuBtn && mobileMenu) {
        mobileMenuBtn.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
        });
    }
});

// Fonction pour confirmer la suppression
function confirmDelete(message = 'Êtes-vous sûr de vouloir supprimer cet élément ?') {
    return confirm(message);
}

// Fonction pour formater les dates
function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString('fr-FR');
}