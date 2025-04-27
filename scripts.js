document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector("form");
    if (form) {
        const errorBox = document.createElement("div");
        errorBox.style.color = "red";
        errorBox.style.marginTop = "10px";
        form.appendChild(errorBox);

        const isInscription = form.querySelector("#confirmemotdepasse");
        const isConnexion = form.querySelector("#motdepasse") && !form.querySelector("#confirmemotdepasse");
        const isReservation = form.classList.contains("reservation") && form.querySelector("#departure");

        form.addEventListener("submit", function (e) {
            let errors = [];
            errorBox.innerHTML = "";

            if (isReservation) {
                const name = form["name"].value.trim();
                const email = form["email"].value.trim();
                const phone = form["phone"].value.trim();
                const departure = form["departure"].value.trim();
                const arrival = form["arrival"].value.trim();
                const date = form["date"].value;
                const tarif = form["tarif"].value.replace('€', '').trim();

                if (!/^[A-Za-z\s\-']+$/.test(name)) errors.push("Le nom ne doit contenir que des lettres.");
                if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) errors.push("Adresse email invalide.");
                if (!/^\+?[0-9\s\-]+$/.test(phone)) errors.push("Numéro de téléphone invalide.");
                if (!/^[A-Za-z\s\-']+$/.test(departure)) errors.push("La ville de départ ne doit contenir que des lettres.");
                if (!/^[A-Za-z\s\-']+$/.test(arrival)) errors.push("La ville d'arrivée ne doit contenir que des lettres.");
                if (new Date(date) < new Date()) errors.push("La date de départ doit être future.");
                if (!/^\d+(\.\d{1,2})?$/.test(tarif)) errors.push("Le montant du tarif doit être un nombre valide.");
            }

            if (isInscription) {
                const name = form["name"].value.trim();
                const prenoms = form["prenoms"].value.trim();
                const email = form["email"].value.trim();
                const phone = form["phone"].value.trim();
                const password = form["motdepasse"].value;
                const confirm = form["confirmemotdepasse"].value;

                if (/\d/.test(name)) errors.push("Le nom ne doit pas contenir de chiffres.");
                if (/\d/.test(prenoms)) errors.push("Les prénoms ne doivent pas contenir de chiffres.");
                if (!/^\d+$/.test(phone)) errors.push("Le numéro de téléphone doit contenir uniquement des chiffres.");
                if (password.length < 4 || password.length > 8) errors.push("Le mot de passe doit comporter entre 4 et 8 caractères.");
                if (password !== confirm) errors.push("Les mots de passe ne correspondent pas.");
            }

            if (isConnexion) {
                const email = form["email"].value.trim();
                const password = form["motdepasse"].value;
                if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) errors.push("Adresse email invalide.");
                if (password.length < 4 || password.length > 8) errors.push("Le mot de passe doit comporter entre 4 et 8 caractères.");
            }

            if (errors.length > 0) {
                e.preventDefault();
                errorBox.innerHTML = errors.map(err => `<p>${err}</p>`).join('');
            }
        });

        const restrictInput = () => {
            const letterOnlyFields = ['name', 'departure', 'arrival'];
            const numberOnlyFields = ['phone', 'tarif'];

            letterOnlyFields.forEach(id => {
                const input = document.getElementById(id);
                if (input) {
                    input.addEventListener("keypress", e => {
                        if (!/[a-zA-Z\s\-']/.test(e.key)) e.preventDefault();
                    });
                }
            });

            numberOnlyFields.forEach(id => {
                const input = document.getElementById(id);
                if (input) {
                    input.addEventListener("keypress", e => {
                        if (!/[0-9]/.test(e.key)) e.preventDefault();
                    });
                }
            });
        };

        restrictInput();
    }

    // Empêche le retour arrière (back button)
    history.pushState(null, null, document.URL);
    window.addEventListener('popstate', function () {
        history.pushState(null, null, document.URL);
    });

    // Script pour le menu utilisateur
    const userInfo = document.getElementById('userInfo');
    const toggleButton = document.querySelector(".user-toggle");

    if (userInfo && toggleButton) {
        userInfo.style.display = 'none';

        toggleButton.addEventListener("click", function () {
            userInfo.style.display = (userInfo.style.display === 'none' || userInfo.style.display === '') ? 'block' : 'none';
        });
    }
});
document.addEventListener("DOMContentLoaded", () => {
    const toggleButton = document.querySelector(".user-toggle");
    const userInfo = document.getElementById("userInfo");

    if (toggleButton && userInfo) {
        userInfo.style.display = "none"; // caché au démarrage

        toggleButton.addEventListener("click", () => {
            userInfo.style.display = (userInfo.style.display === "none" || userInfo.style.display === "") ? "block" : "none";
        });

        // Fermer si clic en dehors
        document.addEventListener("click", (event) => {
            if (!userInfo.contains(event.target) && !toggleButton.contains(event.target)) {
                userInfo.style.display = "none";
            }
        });
    }
});
        document.addEventListener('DOMContentLoaded', function() {
            const dropBtn = document.querySelector('.dropbtn');
            const dropdownContent = document.getElementById('userInfo');

            // Toggle du menu dropdown
            dropBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                dropdownContent.classList.toggle('show');
            });

            // Fermer le menu si on clique ailleurs
            document.addEventListener('click', function() {
                if (dropdownContent.classList.contains('show')) {
                    dropdownContent.classList.remove('show');
                }
            });

            // Empêcher la fermeture quand on clique dans le menu
            dropdownContent.addEventListener('click', function(e) {
                e.stopPropagation();
            });
        });