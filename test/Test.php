<?php
require_once '../persistence/Persistence.php';
require_once '../model/Product.php';
//$instance= Persistence::getInstance();

//var_dump($instance->getAll());
/*$producto = new Product();
var_dump($producto->getAll());
*//*
        $mongo=new Mongo();
        $db=$mongo->shoppingCartsss;
        $grid=$db->getGridFS();
        $filename="lostCanvas.png";
        $location="/data/";
        $storedFile=$grid->storeFile($location.$filename,array("metadata"=>array("filename"=>$filename),"filename"=>$filename));
        //echo $storedFile;
        $image=$grid->findOne("lostCanvas.png");
        //var_dump($image);
        if($image)
        {

        header("Content-type:image/png");
        echo $image->getBytes();
        }
        //echo $display;
 *
 *
 */
$instance= Persistence::getInstance();
Persistence::insertImagen();

print "<br>";
print "<br>";
print "<br>";
print "<br>";

?>
