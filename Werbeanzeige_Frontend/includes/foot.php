<?php
// Öffnungszeiten
$zeiten = [
    "Montag" => "10:00 - 18:00",
    "Dienstag" => "10:00 - 18:00",
    "Mittwoch" => "10:00 - 18:00",
    "Donnerstag" => "10:00 - 18:00",
    "Freitag" => "10:00 - 18:00",
    "Samstag" => "11:00 - 18:00",
    "Sonntag" => "10:00 - 18:00"
];
?>
<div class="bottom">
    <h2>
        <?php foreach($zeiten as $tag => $zeitspanne) :
            echo $tag . ": " . $zeitspanne . " ";
        endforeach; ?>
    </h2>
</div>