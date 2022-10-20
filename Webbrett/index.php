<?php
require "inc/controller.php";

$rubrikArray = [];
$query = "SELECT * FROM rubrik ORDER BY rubriknummer;";

if($mysqli->prepare($query)){
	$result = $mysqli->query($query);

	while ($row = $result->fetch_assoc()) {
		$rubrik = new Rubrik($row["rubriknummer"], $row["rubrikbezeichnung"]);
		$rubrikArray[] = $rubrik;	
	}

$result->free_result(); ?>

	<table> <?php
		foreach($rubrikArray as $rubrik){ ?>
			<tr>
				<td><?php
					echo $rubrik->getNummer()?>
				</td>
				<td>
				<!-- build_query für konkrete Filterung in alle_anzeigen.php -->
					<a class="rubrik-item"
						href="alle_anzeigen.php?<?php
							echo http_build_query(["rubrik" => $rubrik->getBezeichnung()])?>"><?php
					echo $rubrik->getBezeichnung()?>
					</a>
				</td>
			</tr> <?php
		} ?>
	</table> <?php
}


	require "inc/footer.php";
?>
 