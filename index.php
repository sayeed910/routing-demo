<?php

class Customer{
    public $name;
    public $id;
    public $email;

    public function __construct($id, $name, $email){
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
    }
}

$database = [
   '1' => new Customer('1', "sayeed", 'email1'),
   '2' => new Customer('2', "rizvee", 'email2'),
];


function show_customer($params){
    global $database;
    $customer = $database[$params[1]];

    require_once "./customer.php";
}


function show_about(){
    require_once "./a_small_about_page.php";
}


$root_url = "/routing";

$routes = [
    '/customers/([0-9]+)'   => 'show_customer', 
    '/customers/about'   => 'show_about'
];

$request = $_SERVER['REQUEST_URI'];

$matched = false;
foreach($routes as $key => $value){
    $matches = [];
    $pattern = "@".$key."@";
    $didMatch = preg_match($pattern, $request, $matches);

    if ($didMatch){
        $matched = true;
        $value($matches);
    }

}


if (! $matched)
    require_once "./how_to_use.php";