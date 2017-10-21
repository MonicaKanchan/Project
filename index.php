<?php

ini_set('display_errors', 'On');
error_reporting(E_ALL);

class Manage
{
public static function autoload($class)
{
include $class . '.php';
}
}

spl_autoload_register(array('Manage', 'autoload'));

$obj = new main();

class main
{
public function _construct()
{
$pageRequest = 'homepage';
if (isset($_REQUEST['page']))
{
$pageRequest = $_Request['page'];
}

$page = new $pageRequest;

if($_SERVER['REQUEST_METHOD'] == 'GET')
{
$page->get();
}
else
{
$page->post();
}
}
}

abstract class page
{
protected $html;

public function _construct()
{
$this->html .= '<html>';
$this->html .= '<link rel= "stylesheet" href= "styles.css">';
$this->html .= '<body>';
}
public function _destruct()
{
$this->html .= '</body></html>';
stringFunctions::printThis($this->html);
}

public function get()
{
echo 'Default get message';
}

public function post()
{
print_r($_POST);
}
}

?>
