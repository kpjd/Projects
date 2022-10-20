<?php
require "inc/controller.php";

$rubrikname = $_GET["rubrik"];
$query = "SELECT r.rubriknummer, r.rubrikbezeichnung, a.anzeigennummer, a.anzeigentext, a.anzeigendatum,
					i.inserentennummer, i.nickname, i.email
			FROM rubrik r, anzeige a, veroeffentlichen v, inserent i
			WHERE r.rubriknummer = v.rubriknummer
				AND a.anzeigennummer = v.anzeigennummer
				AND i.inserentennummer = a.inserentennummer
				AND r.rubrikbezeichnung=?;";

$stmt = $mysqli->prepare($query);
$stmt->bind_param("s", $rubrikname);
$stmt->execute();
$result = $stmt->get_result();

$rubrikArray = [];

while ($row = $result->fetch_assoc()) {
	$rubrik = new Rubrik($row["rubriknummer"], $row["rubrikbezeichnung"]);
	$anzeige = new Anzeige($row["anzeigennummer"], $row["anzeigentext"], $row["anzeigendatum"]);
	$inserent = new Inserent($row["inserentennummer"], $row["nickname"], $row["email"]);
	$anzeige->setInserent($inserent);
	$rubrik->addAnzeige($anzeige);
	$rubrikArray[] = $rubrik;
}

$stmt->free_result();
$stmt->close(); ?>

<table>
	<thead>
		<tr>
			<td>Rubrik</td>
			<td>Anzeigentext</td>
			<td>Anzeigendatum</td>
			<td>Nickname</td>
			<td>E-mail</td>
		</tr>
	</thead><?php
foreach($rubrikArray as $index => $rubrik){ ?>
	<tr>
		<td> <?php
			echo $rubrik->getBezeichnung()?>
		</td> <?php
		foreach($rubrik->getAnzeigenList() as $anzeige){ ?>
			<td><?php
				echo $anzeige->getText();
			
				?></td><td><?php
				echo $anzeige->getDatum(); ?>
			</td><?php
			foreach($anzeige->getInserent() as $inserent){ ?>
				<td><?php
					echo $inserent->getNickname(); ?>
				</td>
				<td><?php
					echo $inserent->getEmail(); ?>
				</td><?php
			}
		} ?>
	</tr> <?php
	} ?>
</table> <?php

// echo "<pre>";
// 	print_r($rubrikArray);
// echo "</pre>";



	require "inc/footer.php";
?>
 