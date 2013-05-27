<?php
require_once '../persistence/Persistence.php';

class Product {

    private $_id;
    private $_name;
    private $_description;
    private $_price;
    private $_imgPath;

    public function getId(){return $this->_id;}
    public function getName(){return $this->_name; }
    public function getDescription(){return $this->_description;}
    public function getPrice(){return $this->_price;}
    function getImgPath(){return $this->_imgPath;}

    public function  __construct($id="",$name="",$description="",$price=0.00,$imgPath="") {

        $this->_id=$id;
        $this->_name=$name;
        $this->_description=$description;
        $this->_price=$price;
        $this->_imgPath=$imgPath;

    }
    public function getAll()
    {
        $path = "/imagenes" . DIRECTORY_SEPARATOR;

        $instance=Persistence::getInstance();
        $result=$instance->getAll('products');
        $productos=array();
        foreach($result as $item)
        {
            $id=$item['_id'];
            $name=$item['name'];
            $description=$item['description'];
            $price=$item['price'];
            $imgPath=$path . $item['img'];
            $producto=new Product($id, $name, $description, $price, $imgPath);
            $productos[]=$producto;
            $productos = array_reverse($productos);
        }
        return $productos;
    }
    public function getProductoById($id)
    {
        $producto= new Product();
        $productos= $producto->getAll();
        foreach($productos as $prod)
        {
            if($prod->getId()==$id)
            {
                return $prod;
            }
        }
    }
    
    function insert($name,$description,$price,$img){
        $i = Persistence::getInstance();
        $collection = 'products';
        $document = array('name'=>$name,
        'description'=>$description,
        'price'=>$price,
        'img'=>$img);
        return $i->insertDocument($document,$collection);
    }
    
    function delete($id){
        $i = Persistence::getInstance();
        $collection = 'products';
        return $i->deleteDocument($id,$collection);
    }

}
?>
