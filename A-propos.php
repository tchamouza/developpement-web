<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <script src="scripts.js"></script>
        <link rel="icon" type="image/png" href="avion (1).png">
        <script
            src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/js/all.min.js"></script>
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <title>A propos</title>
    </head>

    <body>
        <header>
            <div class="logo">
                <img src="avion (1).png" alt="Logo du site" width="30px"
                    height="30px">
                <a href="#"> airline<span>TRAVEL</span></a>
            </div>
            <nav>
                <ul>
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="pages/Service.php">Services</a></li>
                    <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
                        <li><a href="dashboard.php">Tableau de bord</a></li>
                        <li><a href="logout.php">Déconnexion</a></li>
                    <?php else: ?>
                        <li><a href="connexion.php">Connexion</a></li>
                    <?php endif; ?>
                    <li><a href="pages/Contact.php">Contact</a></li>
                    <li><a href="A-propos.php">À propos</a></li>
                </ul>
            </nav>

            <!-- Menu Burger pour mobile -->
            <div class="menu-toggle" id="mobile-menu">
                <span></span>
                <span></span>
                <span></span>
            </div>

            <!-- Navigation mobile (popup) -->
            <div class="mobile-nav" id="mobile-nav">
                <ul>
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="pages/Service.php">Services</a></li>
                    <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
                        <li><a href="dashboard.php">Tableau de bord</a></li>
                        <li><a href="logout.php">Déconnexion</a></li>
                    <?php else: ?>
                        <li><a href="connexion.php">Connexion</a></li>
                    <?php endif; ?>
                    <li><a href="pages/Contact.php">Contact</a></li>
                    <li><a href="A-propos.php">À propos</a></li>
                </ul>
            </div>
        </header>

        <section class="testimony">
            <div class="test-item1 test-item-behavior">
                <p class="test ">
                    Nous avons fait confiance à cette agence pour notre voyage
                    en Thaïlande, et nous n'avons pas été déçus !
                    Tout était impeccable : les hôtels, les excursions, et même
                    les petits conseils pratiques. Un grand
                    merci à notre conseillère pour sa disponibilité et son
                    professionnalisme. Nous reviendrons sans hésiter
                    !
                </p>

                <p class="test-logo">
                    <i class="fa-solid fa-circle-user"></i>
                    Marie et Pierre
                    <i class="fas fa-star" style="color: gold;"></i>
                    <i class="fas fa-star" style="color: gold;"></i>
                    <i class="fas fa-star" style="color: gold;"></i>
                    <i class="fas fa-star" style="color: gold;"></i>
                    <i class="fas fa-star-half-alt" style="color: gold;"></i>
                </p>
            </div>
            <div class="test-item2 test-item-behavior">
                <p class="test">
                    Je cherchais un voyage sur mesure au Japon, et cette agence
                    a su répondre à toutes mes attentes. Ils ont
                    pris le temps de comprendre mes envies et m'ont proposé un
                    itinéraire parfait. Les guides locaux étaient
                    exceptionnels. Un sans-faute !
                </p>
                <p class="test-logo">
                    <i class="fa-solid fa-circle-user"></i>
                    Thomas
                    <i class="fas fa-star" style="color: gold;"></i>
                    <i class="fas fa-star" style="color: gold;"></i>
                    <i class="fas fa-star" style="color: gold;"></i>
                    <i class="fas fa-star" style="color: gold;"></i>
                    <i class="fas fa-star-half-alt" style="color: gold;"></i>
                </p>
            </div>
            <div class="test-item3 test-item-behavior">
                <p class="test">
                    Notre voyage aux Maldives a été annulé à la dernière minute
                    par le resort, mais l'agence a tout
                    réorganisé en urgence et nous a trouvé une alternative
                    encore mieux ! Leur réactivité et leur
                    bienveillance ont fait toute la différence. Vraiment top !
                </p>
                <p class="test-logo">
                    <i class="fa-solid fa-circle-user"></i>
                    Sophie et Marc
                    <i class="fas fa-star" style="color: gold;"></i>
                    <i class="fas fa-star" style="color: gold;"></i>
                    <i class="fas fa-star" style="color: gold;"></i>
                    <i class="fas fa-star" style="color: gold;"></i>
                    <i class="fas fa-star-half-alt" style="color: gold;"></i>
                </p>

            </div>
            <div class="test-item4 test-item-behavior">
                <p class="test">
                    Nous avons réservé un séjour en Grèce avec cette agence et
                    avons été agréablement surpris par les
                    prestations pour le prix. Les hôtels étaient bien situés,
                    les transferts fluides, et l'équipe toujours
                    joignable en cas de besoin. À recommander !
                </p>
                <p class="test-logo">
                    <i class="fa-solid fa-circle-user"></i>
                    Laura
                    <i class="fas fa-star" style="color: gold;"></i>
                    <i class="fas fa-star" style="color: gold;"></i>
                    <i class="fas fa-star" style="color: gold;"></i>
                    <i class="fas fa-star" style="color: gold;"></i>
                    <i class="fas fa-star-half-alt" style="color: gold;"></i>
                </p>
            </div>
            <div class="test-item5 test-item-behavior">
                <p class="test">
                    Notre road-trip en Californie avec les enfants était tout
                    simplement magique. L'agence a pensé à tout :
                    des activités adaptées aux petits, des hébergements
                    familiaux et même des bons plans restaurants. Un
                    voyage sans stress grâce à eux !
                </p>
                <p class="test-logo">
                    <i class="fa-solid fa-circle-user"></i>
                    La famille Dupont
                    <i class="fas fa-star" style="color: gold;"></i>
                    <i class="fas fa-star" style="color: gold;"></i>
                    <i class="fas fa-star" style="color: gold;"></i>
                    <i class="fas fa-star" style="color: gold;"></i>
                    <i class="fas fa-star" style="color: gold;"></i>
                </p>
            </div>
            <div class="test-item6 test-item-behavior">
                <p class="test">
                    En tant que voyageur solo, je voulais un circuit sécurisé et
                    enrichissant en Amérique du Sud. L'agence
                    m'a guidé vers des destinations parfaites et m'a donné des
                    astuces pour bien profiter. Tout s'est
                    déroulé à la perfection, merci !
                </p>
                <p class="test-logo">
                    <i class="fa-solid fa-circle-user"></i>
                    Nicolas
                    <i class="fas fa-star" style="color: gold;"></i>
                    <i class="fas fa-star" style="color: gold;"></i>
                    <i class="fas fa-star" style="color: gold;"></i>
                    <i class="fas fa-star-half-alt" style="color: gold;"></i>
                </p>
            </div>
        </section>
        <footer>
            <div class="logo">
                <br>
                <p>© copyright @ 2025 par <a
                        href="#">airline<span>TRAVEL</span></a>. Tous droits
                    réservés.</p>
            </div>
            <p>📍 Adresse : Lomé-Togo</p>
            <p>📞 <a href="tel:+22892558895"
                    style="color: gray;text-decoration: none;">Telephone</a></p>
            <p>📧 <a href="mailto:contact@airlinetravel.tg"
                    style="color: gray;text-decoration: none;">contact@airlinetravel.tg</a></p>
        </footer>
    </body>

</html>