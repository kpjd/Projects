<?php 


function crt_nvlst($array){
    ?>
    <nav>
        <ul>
            <?php
            foreach($array as $name => $link):
                ?> <li><a href="<?php echo $link; ?>"><?php echo $name; ?></a></li><?php
            endforeach;
            ?>
        </ul>
    </nav>
    <?php
};


$navItems = [
    "Anzeigen aufgeben" => "anzeige_neu.php",
    "Alle Rubriken" => "index.php"
]; ?>

<header> <?php
	crt_nvlst($navItems); ?>
</header>