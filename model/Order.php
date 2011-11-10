<?php
require_once '../persistence/Persistence.php';
require_once '../model/Product.php';

class Order {

    //private $_client;
    private $_productos=array();
    private $_price;

    //public function getClient(){return $this->_client;}
    public function getProductos(){return $this->_productos;}
    public function getPrice(){return $this->_price;}

    public function  __construct($carro) {

        $total=0.00;
        $productoBase= new Product();
        foreach($carro as $key=>$value)
        {
            $producto=$productoBase->getProductoById($key);
            $total=$total+$producto->getPrice()*$value;
            $this->_productos[]=array("_id"=>$key,"name"=>$producto->getName(),"description"=>$producto->getDescription(),
                                         "price"=>$producto->getPrice(),
                                         "quantity"=>$value,"subTotal"=>$producto->getPrice()*$value);

        }
        $this->_price=$total;


    }

    public function insertar($_name,$_address,$_city,$_province,$_email,$_country,
                            $_shippingMethod,$_paymentMethod,$_zipCode,$_phone)
    {
        $instance=Persistence::getInstance();
        
        $arregloCabeza=array("price"=>$this->_price);
        $arregloCuerpo=array("productos"=>$this->_productos);        

        
        $name=array('name'=>$_name);
        $address=array('address'=>$_address);
        $city=array('city'=>$_city);
        $province=array('city'=>$_province);
        $email=array('email'=>$_email);
        $country=array('country'=>$_country);
        $shippingMethod=array('shippingMethod'=>$_shippingMethod);
        $paymentMethod=array('paymentMethod'=>$_paymentMethod);
        $zipCode=array('zipCode'=>$_zipCode);
        $phone=array('phone'=>$_phone);
        
        $arregloFinal=array_merge($arregloCabeza, $arregloCuerpo,
                                $name,$address,$city,$province,$email,
                                $country,$shippingMethod,$paymentMethod,
                                $zipCode,$phone);
                                
        $instance->insertDocument($arregloFinal,'orders');
    }


}
?>
