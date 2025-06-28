<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="icon" type="image/png" href="../avion (1).png">
        <title>service</title>
        <meta name="description" content>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../style.css">
        <script src="../scripts.js" defer></script>
    </head>

    <body>
        <header>
            <div class="logo">
                <img src="../avion (1).png" alt="Logo du site" width="30px"
                    height="30px">

                <a href="#">airline<span>TRAVEL</span></a>
            </div>
            <nav>
                <ul>
                    <li><a href="../index.php">Accueil</a></li>
                    <li><a href="Service.php">Services</a></li>
                    <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
                        <li><a href="../dashboard.php">Tableau de bord</a></li>
                        <li><a href="../reservation.php">Réserver</a></li>
                        <li><a href="../logout.php">Déconnexion</a></li>
                    <?php else: ?>
                        <li><a href="../connexion.php">Connexion</a></li>
                    <?php endif; ?>
                    <li><a href="Contact.php">Contact</a></li>
                    <li><a href="../A-propos.php">À propos</a></li>

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
                    <li><a href="../index.php">Accueil</a></li>
                    <li><a href="Service.php">Services</a></li>
                    <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
                        <li><a href="../dashboard.php">Tableau de bord</a></li>
                        <li><a href="../reservation.php">Réserver</a></li>
                        <li><a href="../logout.php">Déconnexion</a></li>
                    <?php else: ?>
                        <li><a href="../connexion.php">Connexion</a></li>
                    <?php endif; ?>
                    <li><a href="Contact.php">Contact</a></li>
                    <li><a href="../A-propos.php">À propos</a></li>
                </ul>
            </div>
        </header>

        <section id="service">
            <h1 class="title">Service</h1>
            <div class="img-desc">
                <div class="left">
                    <video src="./image/33871-398473585_small.mp4" autoplay loop
                        muted></video>
                </div>

                <div class="right">
                    <h3>Créer votre séjour avec airlineTRAVEL</h3>
                    <p>Le but ultime des vacances, c'est sans conteste de
                        s'offrir un pur moment de détente… et rien
                        d'autre. Pour pousser la zénitude à son paroxysme,
                        laissez-vous tenter par un séjour tout compris!
                        Repas, en-cas, cocktails et boissons en tout genre,
                        activités sympas, spa… tout est imaginé pour
                        répondre à vos besoins du moment où vous sortez du lit
                        jusqu'à ce que vous tombiez dans les bras de
                        Morphée. Ajoutez-y une formule hôtel et vol, et il ne
                        vous reste plus qu'à profiter. Elle n'est pas
                        belle, la vie?</p>
                    <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
                        <a href="../reservation.php">Réserver maintenant</a>
                    <?php else: ?>
                        <a href="../connexion.php">Se connecter pour réserver</a>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <section id="popular-destination">
            <h1 class="title">Destinations populaires</h1>
            <div class="content">
                <div class="box">
                    <img src="./image/jamaique.jpg" alt>
                    <div class="content">
                        <h4>Jamaique</h4>
                        <p>Découvrer la jamaique avec nous</p>
                        <p>Réserver moins chère ici</p>
                        <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
                            <a href="../reservation.php">Réserver</a>
                        <?php else: ?>
                            <a href="../connexion.php">Se connecter</a>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="box">
                    <img src="./image/paris-france.jpeg" alt="France">
                    <div class="content">
                        <h4>France</h4>
                        <p>Visitez Paris, la ville lumière</p>
                        <p>Offres exclusives disponibles</p>
                        <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
                            <a href="../reservation.php">Réserver</a>
                        <?php else: ?>
                            <a href="../connexion.php">Se connecter</a>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="box">
                    <img src="./image/japon.jpg" alt="Japon">
                    <div class="content">
                        <h4>Japon</h4>
                        <p>Explorez Tokyo et ses merveilles</p>
                        <p>Expérience culturelle garantie</p>
                        <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
                            <a href="../reservation.php">Réserver</a>
                        <?php else: ?>
                            <a href="../connexion.php">Se connecter</a>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="box">
                    <img src="./image/egypt.jpg" alt="Égypte">
                    <div class="content">
                        <h4>Égypte</h4>
                        <p>Partez à la découverte des pyramides</p>
                        <p>Voyage entre histoire et mystère</p>
                        <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
                            <a href="../reservation.php">Réserver</a>
                        <?php else: ?>
                            <a href="../connexion.php">Se connecter</a>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="box">
                    <img src="./image/bresil.jpg" alt="Brésil">
                    <div class="content">
                        <h4>Brésil</h4>
                        <p>Ambiance tropicale et plages de rêve</p>
                        <p>Partez dès maintenant</p>
                        <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
                            <a href="../reservation.php">Réserver</a>
                        <?php else: ?>
                            <a href="../connexion.php">Se connecter</a>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="box">
                    <img src="./image/italie.jpg" alt="Italie">
                    <div class="content">
                        <h4>Italie</h4>
                        <p>Profitez de la dolce vita</p>
                        <p>Voyage gastronomique et culturel</p>
                        <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
                            <a href="../reservation.php">Réserver</a>
                        <?php else: ?>
                            <a href="../connexion.php">Se connecter</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>

        <section id="offre">
            <h1 class="title">Une offre de vacances pour chacun</h1>
            <div class="content">
                <div class="box">
                    <img src="./image/plage.jpg" alt="Vacances plage">
                    <div class="offre-content">
                        <h2>Offre Plage</h2>
                        <p>Profitez de vacances relaxantes au bord de la
                            mer.</p>
                    </div>
                </div>
                <div class="box">
                    <img src="./image/montagne.jpg"
                        alt="Vacances à la montagne">
                    <div class="offre-content">
                        <h2>Offre Montagne</h2>
                        <p>Évadez-vous dans les montagnes pour un séjour
                            d'aventure.</p>
                    </div>
                </div>
                <div class="box">
                    <img src="./image/campagne.jpg"
                        alt="Vacances à la campagne">
                    <div class="offre-content">
                        <h2>Offre Campagne</h2>
                        <p>Reposez-vous dans un cadre naturel et apaisant.</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="hotels">
            <h1 class="title">Ces hôtels pourraient vous plaire</h1>
            <div class="content">
                <div class="box">
                    <img src="./image/hotel bamboo.jpg" alt="Vacances plage">
                    <div class="hotel-content">
                        <h2>bamboo Hotel </h2>
                    </div>
                </div>
                <div class="box">
                    <img src="./image/sierra pines record.jpg"
                        alt="Vacances plage">
                    <div class="hotel-content">
                        <h2>Sierra Pines Record</h2>
                    </div>
                </div>
                <div class="box">
                    <img src="./image/Hyatt Regency.jpg" alt="Vacances plage">
                    <div class="hotel-content">
                        <h2>Hyatt Regency</h2>
                    </div>
                </div>
                <div class="box">
                    <img src="./image/the luxury.jpg" alt="Vacances plage">
                    <div class="hotel-content">
                        <h2>Luxury Hotel</h2>
                    </div>
                </div>
                <div class="box">
                    <img src="./image/the grand vista.jpg" alt="Vacances plage">
                    <div class="hotel-content">
                        <h2>The Grand vista</h2>
                    </div>
                </div>
                <div class="box">
                    <img src="./image/Santorini island, Greece.jpeg"
                        alt="Vacances plage">
                    <div class="hotel-content">
                        <h2>Santorini</h2>
                    </div>
                </div>
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