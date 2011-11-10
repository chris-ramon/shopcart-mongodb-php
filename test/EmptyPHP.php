<?php
require_once '../persistence/Persistence.php';


$image=Persistence::getImagen(1);
header("Content-type:image/png");
echo $image->getBytes();

//require_once 'display.html';

?>
