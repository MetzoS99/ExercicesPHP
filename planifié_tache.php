<?php
// Chargement ou initialisation des tâches
$file = 'taches.txt';
$tasks = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

// Gestion de l'ajout de tâches
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $date = $_POST['date'];
    $description = $_POST['description'];
    $duration = $_POST['duration'];

    $tasks[$date][] = ['description' => $description, 'duration' => $duration];
    file_put_contents($file, json_encode($tasks));
}

// Affichage du planificateur
echo "<h1>Planificateur de tâches</h1>";
echo '<form method="POST">
    <label for="date">Date :</label>
    <input type="date" name="date" required>
    <label for="description">Description :</label>
    <input type="text" name="description" required>
    <label for="duration">Durée (heures) :</label>
    <input type="number" name="duration" min="1" required>
    <button type="submit">Ajouter</button>
</form>';

// Récapitulatif
echo "<table border='1'>";
echo "<tr><th>Date</th><th>Tâches</th><th>Durée totale</th></tr>";
foreach ($tasks as $date => $dayTasks) {
    $totalDuration = array_sum(array_column($dayTasks, 'duration'));
    echo "<tr><td>$date</td><td>";
    foreach ($dayTasks as $task) {
        echo $task['description'] . " ({$task['duration']}h)<br>";
    }
    echo "</td><td>$totalDuration</td></tr>";
}
echo "</table>";
?>
