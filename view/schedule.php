<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emploi du temps</title>
</head>
<body>
<?php
date_default_timezone_set('Europe/Paris');

// URL de ton iCalendar
$icsUrl = 'https://edt.univ-eiffel.fr/jsp/custom/modules/plannings/anonymous_cal.jsp?resources=1486&projectId=26&calType=ical&nbWeeks=4';

// Récupérer la semaine demandée (par défaut : semaine actuelle)
$currentWeek = isset($_GET['week']) ? (int)$_GET['week'] : 0;

// Empêcher currentWeek d'être négatif
if ($currentWeek < 0) {
    $currentWeek = 0;
}

$startOfWeek = strtotime("monday this week +$currentWeek week");
$endOfWeek = strtotime("sunday this week +$currentWeek week");

// Fonction pour récupérer et parser l'iCalendar
function parseICS($url) {
    $events = [];
    $icsContent = file_get_contents($url);

    if ($icsContent === false) {
        echo "Impossible de récupérer l'emploi du temps.";
        return [];
    }

    $lines = explode("\n", $icsContent);
    $event = null;

    foreach ($lines as $line) {
        $line = trim($line);
        if (strpos($line, 'BEGIN:VEVENT') !== false) {
            $event = [];
        } elseif (strpos($line, 'END:VEVENT') !== false) {
            $events[] = $event;
        } elseif ($event !== null) {
            list($key, $value) = explode(':', $line, 2) + [null, null];
            if ($key && $value) {
                $event[$key] = $value;
            }
        }
    }
    return $events;
}

// Filtrer les événements par semaine et trier par heure de début
function filterEventsByWeek($events, $startOfWeek, $endOfWeek) {
    $filteredEvents = [];

    foreach ($events as $event) {
        if (isset($event['DTSTART'])) {
            $start = strtotime($event['DTSTART']);
            if ($start >= $startOfWeek && $start <= $endOfWeek) {
                $dayOfWeek = date('N', $start);
                $event['formatted_date'] = date('d/m/Y H:i', $start);
                $filteredEvents[$dayOfWeek][] = $event;
            }
        }
    }

    // Trier les événements pour chaque jour par heure de début
    foreach ($filteredEvents as &$dayEvents) {
        usort($dayEvents, function($a, $b) {
            return strtotime($a['DTSTART']) - strtotime($b['DTSTART']);
        });
    }

    return $filteredEvents;
}

// Récupérer et filtrer les événements
$events = parseICS($icsUrl);
$weekEvents = filterEventsByWeek($events, $startOfWeek, $endOfWeek);

// Calcul des dates de la semaine
$daysOfWeek = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
$weekDates = [];
for ($i = 0; $i < 7; $i++) {
    $weekDates[$i] = date('d/m/Y', strtotime("+$i day", $startOfWeek));
}

// Définition des couleurs par catégorie
$categoryColors = [
    'Cours' => '#FFDD57',   // Jaune
    'TD' => '#57AFFF',      // Bleu
    'TP' => '#7FFF57',      // Vert
    'Examen' => '#FF5757',  // Rouge
    'Autre' => '#D3D3D3'    // Gris (par défaut)
];

// Fonction pour déterminer la couleur de l'événement
function getEventColor($summary) {
    global $categoryColors;

    foreach ($categoryColors as $key => $color) {
        if (stripos($summary, $key) !== false) {
            return $color;
        }
    }
    return $categoryColors['Autre'];  // Par défaut
}

// Affichage HTML avec navigation par semaine
echo "<h1>Emploi du Temps Hebdomadaire</h1>";

// Affichage des dates de la semaine
echo "<h2 style='text-align: center;'>Semaine du " . date('d/m/Y', $startOfWeek) . " au " . date('d/m/Y', $endOfWeek) . "</h2>";

// Navigation
echo "<div style='margin-bottom: 20px; text-align: center;'>";
if ($currentWeek > 0) {
    echo "<a href='control.php?action=showSchedule&week=".($currentWeek-1)."'>&laquo; Semaine précédente</a> | ";
}
echo "<a href='control.php?action=showSchedule&week=".($currentWeek+1)."'>Semaine suivante &raquo;</a>";
echo "</div>";

// Table d'affichage
echo "<table border='1' style='width:100%; text-align:center;'>";
echo "<tr>";
foreach ($daysOfWeek as $index => $day) {
    $highlight = (date('d/m/Y') == $weekDates[$index]) ? "style='background-color:#FFEB3B;'" : '';
    echo "<th $highlight>$day <br> {$weekDates[$index]}</th>";
}
echo "</tr>";

// Affichage des événements pour chaque jour
echo "<tr>";
for ($i = 1; $i <= 7; $i++) {
    echo "<td style='vertical-align:top; padding:10px;'>";
    if (!empty($weekEvents[$i])) {
        foreach ($weekEvents[$i] as $event) {
            $start = date('H:i', strtotime($event['DTSTART']));
            $end = date('H:i', strtotime($event['DTEND']));
            $summary = $event['SUMMARY'] ?? 'Sans titre';
            $location = $event['LOCATION'] ?? 'N/A';
            $color = getEventColor($summary);

            echo "<div style='margin-bottom:10px; padding:8px; border:1px solid #ddd; background-color:$color;'>";
            echo "<strong>$summary</strong><br>";
            echo "$start - $end<br>";
            echo "<em>$location</em>";
            echo "</div>";
        }
    } else {
        echo "Aucun événement";
    }
    echo "</td>";
}
echo "</tr>";
echo "</table>";
?>
</body>
</html>