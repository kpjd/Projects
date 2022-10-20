<?php
require "inc/controller.php";
include("classes/FormType.php");
include("classes/Formular.php");

$rubrikArray = [];
$query = "SELECT * FROM rubrik ORDER BY rubriknummer;";

if($mysqli->prepare($query)){
	$result = $mysqli->query($query);

	while ($row = $result->fetch_assoc()) {
		$rubrik = new Rubrik($row["rubriknummer"], $row["rubrikbezeichnung"]);
		$rubrikArray[] = $rubrik;	
	}

$result->free_result();
}

$nicknameForm = new FormType(	"nickname"	, "Nickname"									, "text"		, "maxMuster"										);
$emailForm = new FormType(		"email"		, "E-mail"										, "text"		, "example@outlook.com"								);
$rubrikForm = new FormType(		"rubrikList", "Bitte eine oder meherere Rubriken wählen"	, "checkbox"	, NULL												);
$anzeigeForm = new FormType(	"anzeige"	, "Bitte Text für die Anzeige eingeben"			, "textarea"	, "bitte text eingeben"	, NULL			, 10, 200	);

$finalForm = new Formular(1, "senden");

$formList = [
	$nicknameForm,
	$emailForm,
	$rubrikForm,
	$anzeigeForm
];

foreach($rubrikArray as $rubrik){
	$rubrikForm->setRubrikList($rubrik);
}

foreach($formList as $formPiece){
	$finalForm->setFormList($formPiece);
}

$finalForm->createForm();


if(isset($_POST["nickname"]) && isset($_POST["email"]) && isset($_POST["rubrikList"]) && isset($_POST["anzeige"])){
	echo $_POST["nickname"] . "<br>";
	echo $_POST["email"] . "<br>";
	print_r($_POST["rubrikList"]);
	echo "<br>";
	echo $_POST["anzeige"] . "<br>";
}


require "inc/footer.php";

?>
 