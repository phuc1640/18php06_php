<?php

class User 
{	
	var $name;
	var $email;
	var $password;
	var $phone;
	var $address;
	
	function __construct()
	{
		$this->name = "phuc";
	}

	private function Add()
	{
		echo "Add<br>";
	}

	private function Edit()
	{
		echo "Edit<br>";
	}

	public function Register()
	{
		echo "Register<br>";
	}

	public function Login()
	{
		echo "Login<br>";
	}

	public function View()
	{	
		echo $this->name;
		echo "View<br>";
	}

	public function List()
	{
		echo "List<br>";
	}
}

	
class Customer extends User
{	
	var $idCustomer;
	function __construct()
	{
		
	}

	public function Pay()
	{
		# code...
	}

	public function History()
	{
		# code...
	}
}

$user = new User();
$user->View();

$customer = new Customer();


?>