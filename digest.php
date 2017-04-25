<?php
class digest{
    private $users = array();
    private $passwords = array();
    private $realm = "Unbekannt";
    private $error = "Der Zugriff zu dieser Seite ist Ihnen untersagt";
    
	public function add($user, $pass)
	{
		if(is_array($user) OR is_array($pass))
		{
			foreach($user as $usr)
			{
				$this->users[] = $usr;
			}
			
			foreach($pass as $pwd)
			{
				$this->passwords[] = $pwd;
			}
		}
		else
		{
			$this->users[] = $user;
			$this->passwords[] = $pass;
		}
	}
	
	private function send()
	{
		header('WWW-Authenticate: Basic realm="'.$this->realm.'"');
		header('HTTP/1.0 401 Unauthorized');
		echo $this->error;
		exit;
	}
	
	public function realm($string)
	{
		if(empty($string) == false)
		{
			$this->realm = $string;
		}
	}
	
	public function error($string)
	{
		if(empty($string) == false)
		{
			$this->error = $string;
		}
	}
	
	private function check($username,$passwort)
	{
		$i = 0;
		$gueltig = false;
		foreach($this->users as $usah)
		{
			if($usah == $username)
			{
				$gueltig = true;
				break;
			}
			else
			{
				$i = $i+1;
			}
		}
		if($gueltig == true)
		{
			$pass = $this->passwords[$i];
			if((in_array($username, $this->users) == false) OR ($passwort !== $pass))
			{
				$this->send();
			}
		}
		else
		{
			$this->send();
		}
	}
	
	public function start()
	{
		if(empty($_SERVER['PHP_AUTH_USER']) == false && empty($_SERVER['PHP_AUTH_PW']) == false)
		{
			$this->check($_SERVER['PHP_AUTH_USER'],$_SERVER['PHP_AUTH_PW']);
		}
		else
		{
			$this->send();
		}
	}
}
?>
