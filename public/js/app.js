// Validation des dates pour les réservations
document.addEventListener('DOMContentLoaded', function() {
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
});