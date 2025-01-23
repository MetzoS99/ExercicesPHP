# ExercicesPHP

<?php
// Formulaire pour sélectionner un mois et une année
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $month = $_POST['month'];
    $year = $_POST['year'];
    $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

    echo "<h1>Calendrier de $month/$year</h1>";
    echo "<table border='1'>";
    echo "<tr><th>Jour</th><th>Événements</th></tr>";

    for ($day = 1; $day <= $daysInMonth; $day++) {
        echo "<tr><td>$day</td><td></td></tr>";
    }
    echo "</table>";
} else {
    // Affichage du formulaire
    echo '<form method="POST">
        <label for="month">Mois :</label>
        <input type="number" name="month" min="1" max="12" required>
        <label for="year">Année :</label>
        <input type="number" name="year" min="1900" max="2100" required>
        <button type="submit">Afficher le calendrier</button>
    </form>';
}
?>
