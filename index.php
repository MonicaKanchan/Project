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

//instantiating the object
$obj = new main();

class main
{
public function __construct()
{

$pageRequest = 'Homepage';
//checking parameters
if (isset($_REQUEST['Nextpage']))
{
$pageRequest = $_REQUEST['Nextpage'];
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

abstract class Nextpage
{
protected $html;

public function __construct()
{
$this->html .= '<html>';
//Link to css file
$this->html .= '<link rel= "stylesheet" href= "styles.css">';
$this->html .= '<body>';
}
public function __destruct()
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

class Homepage extends Nextpage
{
public function get()
{
$form = '<form method="post" enctype="multipart/form-data">';
$form .= '<input type="file" name="fileToUpload" id="fileToUpload">';
$form .= '<input type="submit" value="Upload" name="Submit">';
$form .= '</form>';
$this->html .= '<h1>Upload Form</h1>';
$this->html .= $form;
}

public function post()
{
//directory for saving uploaded csv file
$target_dir = "Uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
$imageFileName = pathinfo($target_file, PATHINFO_BASENAME);
//uploading the csv file
move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
//header for the uploaded csv file
header('Location: index.php?Nextpage=htmlTable&filename='.$imageFileName);
}
}

class htmlTable extends Nextpage
{
public function get()
{
$filename=$_REQUEST['filename'];
//parameters for table
$file = fopen("Uploads/".$filename, "r");
$tablehtml = "";
$i=0;
$tablehtml .= '<table border= "1">';
while(! feof($file))
{
$data=fgetcsv($file);
$count=count($data);
$tablehtml .= '<tr>';
for($i=0; $i<$count; $i++)
{
$tablehtml .= '<td>' .$data[$i].'</td>';
}
$tablehtml .= '</tr>';
}
$tablehtml .= '</table>';

fclose($file);
print($tablehtml);
}

}

class stringFunctions
{
static public function printThis($inputText)
{
return print($inputText);
}

}

?>
