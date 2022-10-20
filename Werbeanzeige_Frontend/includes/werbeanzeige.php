<?php
# includes ################################################


# variables ###############################################
$farbtypen = [
    "azure",
    "palegoldenrod",
    "gainsboro",
    "cornsilk"
];

$imageData = [
    "blumen.jpg" => "Blumen",
    "boot.jpg" => "Boot",
    "hafen_seitenansicht.jpg" => "Hafen in Seitenansicht",
    "hafen.jpg" => "Hafen",
    "landschaft.jpg" => "Landschaft",
    "meer.jpg" => "Meer",
    "parkplatz.jpg" => "Parkplatz",
    "stadt_am_meer.jpg" => "Stadt am Meer",
    "strand.jpg" => "Strand",
    "wiesen.jpg" => "Wiesen"

];



$currentView = [];
$imageIndices = [];

$counter = 0;

    // placeholder
$string = "Hier stehen Ihre Events --- ";
$startdatum = "20.01.2023";
$enddatum = "30.02.2023";
$eventBeschreibung = "<br>Eventbeschreibung";


?>

<style>
    .bildrahmen {
        background-color: <?php echo $farbtypen[1] ?>;
    };
</style>


<div class="wrapper">
    <div class="banner">
        <p><?php for($i = 0; $i < 10; $i++): echo $string; endfor; ?></p>
    </div>



    <div class="container">
<?php



$imageIndices = create_indices_arr($imageData);


$currentView = push_curr_view($imageIndices, $currentView);

    // print_r($currentView);
    // echo "<br>";

    foreach($currentView as $num):
        foreach($imageIndices as $index => $dataName):
            if($num == $index):
                // echo parse_url(http_build_query([$counter => $index]));
?>
                <div class="bildrahmen" style="background: <?php //echo $farbtypen[$counter] ?>">
                    <h1><?php echo $imageData[$dataName]; ?></h1>
                    <img src="img/<?php echo $dataName; ?>" alt="<?php echo $dataName; ?>" width="600" height="400">
                    <p><?php 
                            echo "Beginn: " . $startdatum . " --- Endet: " . $enddatum;
                            echo $eventBeschreibung;
                            for($i = 0; $i < 100; $i++): if($i % 8 == 0) echo "<br>Beschreibung "; else echo "Beschreibung "; endfor; 
                        ?>
                    </p>
                </div>
<?php           $counter++;
            endif;
        endforeach;
    endforeach;
    ?>
    </div>


<?php
$oeffnungszeiten = [
    "Montag" => "10:00 - 18:00",
    "Dienstag" => "10:00 - 18:00",
    "Mittwoch" => "10:00 - 18:00",
    "Donnerstag" => "10:00 - 18:00",
    "Freitag" => "10:00 - 18:00",
    "Samstag" => "11:00 - 18:00",
    "Sonntag" => "10:00 - 18:00"
];
$mailadresse = "example@gmail.com";
$mobilNum = 23048503845;

?>
    <div class="bottom">
        <span>
            <?php
            echo "E-Mail: " . $mailadresse;
            echo "Telefon: " . $mobilNum;
            echo "<br>Öffnungszeiten: ";
            foreach($oeffnungszeiten as $tag => $zeitspanne) :
                echo $tag . ": " . $zeitspanne . " ";
            endforeach; ?>
        </span>
    </div>
</div>