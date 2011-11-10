<?php

class Persistence {

    private static $_instance=null;
    private $_conexion;

    public static function getImagen($id)
    {
        $mongo = new Mongo();
        $db = $mongo->shoppingCart;
        $grid=$db->getGridFS();
        $filename=$id.'.PNG';
        $image=$grid->findOne(array("filename"=>"$filename"));
        return $image;

    }

    public static function insertImagen()
    {

        $mongo = new Mongo();
        $db = $mongo->shoppingCart;


        $grid = $db->getGridFS();
        $grid->remove();

        $path = "/opt/lampp/htdocs/MongoShoppingCart/imagenes/";

           
            for($i=1;$i<7;$i++)
            {
                $filename = $i.'.PNG';

                $storedfile = $grid->storeFile($path . $filename,
                 array("metadata" => array("filename" => $filename),
                 "filename" => $filename));
            }
    }

    public static function getInstance()
    {
        if(self::$_instance==null)
        {
            self::$_instance=new Persistence();

        }
        return self::$_instance;

    }
    public function insertDocument($bson,$collec)
    {
        try {
            $db=$this->_conexion->shoppingCart;
            $collection=$db->$collec;
            if($collection->insert($bson))
                return true;
            else
                return false;

        } catch (Exception $e) {
            throw $e;
        }

    }

    public function  __construct() {

        try {
            $this->_conexion=new Mongo();
        } catch (Exception $e) {

            error_log($e->getMessage(), 3, '../log/Error.log');
        }
        self::insertImagen();

    }


    public function getAll($collection)
    {
        $db=$this->_conexion->shoppingCart;
        $collection=$db->$collection;

        $cursor=$collection->find();
        
        $arreglo=array();
        foreach ($cursor as $obj)
        {
             $arreglo[]=$obj;
             
        }
        return $arreglo;
    }    
    
    function deleteDocument($id,$collec){
        $db=$this->_conexion->shoppingCart;
        $collection = $db->$collec;
        if($collection->remove(array('_id' => new MongoId($id)), true))
            return true;
        else
            return false;
    }
    
    


}
Persistence::getInstance();

?>
