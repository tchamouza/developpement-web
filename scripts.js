    document.addEventListener('DOMContentLoaded', function() {
      const menuToggle = document.getElementById('mobile-menu');
      const mobileNav = document.getElementById('mobile-nav');
      
      menuToggle.addEventListener('click', function() {
        this.classList.toggle('active');
        mobileNav.classList.toggle('active');
        
        // Empêcher le défilement de la page lorsque le menu est ouvert
        if (mobileNav.classList.contains('active')) {
          document.body.style.overflow = 'hidden';
        } else {
          document.body.style.overflow = 'auto';
        }
      });
      
      // Fermer le menu lorsqu'on clique sur un lien
      const navLinks = mobileNav.querySelectorAll('a');
      navLinks.forEach(link => {
        link.addEventListener('click', function() {
          menuToggle.classList.remove('active');
          mobileNav.classList.remove('active');
          document.body.style.overflow = 'auto';
        });
      });
    });