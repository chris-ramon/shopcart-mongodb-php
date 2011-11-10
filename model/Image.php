<?php
require_once '../persistence/Persistence.php';
class Image {


    public function loadImage($id)
    {
        return $image=Persistence::getImagen($id);
        

    }

}
?>
