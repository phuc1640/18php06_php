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
		echo "View<br>";
	}

	public function List()
	{
		echo "List<br>";
	}
}

	
class Customer extends User
{
	function __construct()
	{
		
	}
}

$user = new User();
$user->View();

$customer = new Customer();


?>