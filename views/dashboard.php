<?php 
$title = 'Tableau de bord - airlineTRAVEL';
ob_start(); 
?>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Section de bienvenue -->
        <div class="bg-gradient-to-r from-blue-500 to-purple-600 text-white p-8 rounded-lg mb-8">
            <h1 class="text-3xl font-bold mb-2">Bienvenue, <?= htmlspecialchars($_SESSION['user_name']) ?> !</h1>
            <p class="text-lg">Gérez vos voyages et découvrez de nouvelles destinations</p>
        </div>

        <!-- Statistiques -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-6 rounded-lg shadow text-center">
                <div class="text-3xl font-bold text-blue-600"><?= $stats['total'] ?></div>
                <div class="text-gray-600">Réservations totales</div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow text-center">
                <div class="text-3xl font-bold text-green-600"><?= $stats['confirmees'] ?></div>
                <div class="text-gray-600">Voyages confirmés</div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow text-center">
                <div class="text-3xl font-bold text-yellow-600"><?= $stats['en_attente'] ?></div>
                <div class="text-gray-600">En attente</div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow text-center">
                <div class="text-3xl font-bold text-red-600"><?= $stats['annulees'] ?></div>
                <div class="text-gray-600">Annulées</div>
            </div>
        </div>

        <!-- Réservations -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-semibold">Mes Réservations</h3>
                    <a href="/reservations/create" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Nouvelle Réservation
                    </a>
                </div>

                <?php if (empty($reservations)): ?>
                    <div class="text-center py-8">
                        <p class="text-gray-500 mb-4">Aucune réservation trouvée.</p>
                        <a href="/reservations/create" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Faire ma première réservation
                        </a>
                    </div>
                <?php else: ?>
                    <div class="space-y-4">
                        <?php 
                        $reservationModel = new Reservation();
                        foreach ($reservations as $reservation): 
                        ?>
                            <div class="border rounded-lg p-4 hover:shadow-md transition duration-300">
                                <div class="flex justify-between items-start mb-3">
                                    <h4 class="text-xl font-semibold"><?= htmlspecialchars($reservation['destination']) ?></h4>
                                    <span class="px-3 py-1 rounded-full text-sm font-medium
                                        <?php if ($reservation['statut'] === 'confirmee'): ?>bg-green-100 text-green-800
                                        <?php elseif ($reservation['statut'] === 'en_attente'): ?>bg-yellow-100 text-yellow-800
                                        <?php else: ?>bg-red-100 text-red-800
                                        <?php endif; ?>">
                                        <?= $reservationModel->getStatutLabel($reservation['statut']) ?>
                                    </span>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                                    <div>
                                        <strong>Dates:</strong><br>
                                        Du <?= date('d/m/Y', strtotime($reservation['date_depart'])) ?>
                                        au <?= date('d/m/Y', strtotime($reservation['date_retour'])) ?>
                                        <br><small class="text-gray-500">(<?= $reservationModel->getDuration($reservation) ?> jours)</small>
                                    </div>
                                    <div>
                                        <strong>Personnes:</strong> <?= htmlspecialchars($reservation['nombre_personnes']) ?><br>
                                        <strong>Type:</strong> <?= htmlspecialchars($reservation['type_voyage']) ?>
                                    </div>
                                    <div>
                                        <strong>Budget:</strong> <?= htmlspecialchars($reservation['budget']) ?>€<br>
                                        <strong>Réservé le:</strong> <?= date('d/m/Y', strtotime($reservation['created_at'])) ?>
                                    </div>
                                </div>
                                <?php if ($reservation['statut'] === 'en_attente'): ?>
                                    <div class="mt-4 space-x-2">
                                        <a href="/reservations/<?= $reservation['id'] ?>/edit" class="text-blue-600 hover:text-blue-800">Modifier</a>
                                        <a href="/reservations/<?= $reservation['id'] ?>/delete" class="text-red-600 hover:text-red-800" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette réservation ?')">
                                            Supprimer
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php 
$content = ob_get_clean();
include 'layout.php';
?>