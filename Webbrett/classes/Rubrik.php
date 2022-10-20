<?php
class Rubrik{
	private $nummer;
	private $bezeichnung;
	private $anzeigenList;

	public function __construct ($nummer, $bezeichnung, $anzeigenList = null){
		$this->nummer = $nummer;
		$this->bezeichnung = $bezeichnung;
	}
	
	public function getNummer(){
		return $this->nummer;
	}
	
	public function setNummer($nummer){
		$this->nummer = $nummer;
	}
	
	public function getBezeichnung(){
		return $this->bezeichnung;
	}
	
	public function setBezeichnung($bezeichnung){
		$this->bezeichnung  = $bezeichnung;
	}

	public function setAnzeigenList($anzeigenList){
		$this->anzeigenList = $anzeigenList;
	}
	
	public function addAnzeige(Anzeige $anzeige){
		$this->anzeigenList[] = $anzeige;
	}
	
	public function getAnzeigenList(){
		return $this->anzeigenList;
	}
}