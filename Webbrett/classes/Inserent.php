<?php

class Inserent{
	private $nummer;
	private $nickname;
	private $email;

	public function __construct ($nummer, $nickname, $email){
		$this->nummer = $nummer;
		$this->nickname = $nickname;
		$this->email = $email;
	}
	
	public function getNummer(){
		return $this->nummer;
	}
	
	public function setNummer($nummer){
		$this->nummer = $nummer;
	}
	
	public function getNickname(){
		return $this->nickname;
	}
	
	public function setNickname($nickname){
		$this->nickname  = $nickname;
	}
	
	public function getEmail(){
		return $this->email;
	}
	
	public function setEmail($email){
		$this->email  = $email;
	}
}