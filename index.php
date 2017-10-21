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

class honepage extends page
{
public function get()
{
$form = '<form method="post" enctype="multipart/form-data">';
$form .= '<input type="file" name="fileToUpload" id="fileToUpload">';
$form .= '<input type="submit" value="Upload Image" name="Submit">';
$form .= '</form>';
$this->html .= '<h1>Upload Form</h1>';
$this->html .= $form;
}

public function post()
{
$target_dir = "Uploads/";
$$target_file = $target_dir . basename($_FILES["file ToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
$imageFileNAme = pathinfo($target_file, PATHINFO_BASENAME);
move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
header('Location: index.php?page=htmlTable&filename='.$imageFileName);
}
}

class htmlTable extends page
{
}

class stringFunctions
{
static public function printThis($inputText)
{
return print($inputText);
}
}

?>
