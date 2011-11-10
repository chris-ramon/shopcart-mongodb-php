<?php
require_once '../model/Product.php';
require_once '../model/Order.php';
require_once '../model/Image.php';
session_start();

class Controlador
{
    private $_carro=array();
    private $_items_nro;
    private $_items_precio;

    public function loadImage($id)
    {
        $image=new Image();
        return $image->loadImage($id);
        
    }

    public function cerrarSesion()
    {
        session_start();
        session_destroy();
        header('location:../index.php');

    }
    


    public function crearOrden($_name,$_address,$_city,$_province,$_email,$_country,
                            $_shippingMethod,$_paymentMethod,$_zipCode,$_phone)
    {
        $orden= new Order($_SESSION['carro']);
        $orden->insertar($_name,$_address,$_city,$_province,$_email,$_country,
                            $_shippingMethod,$_paymentMethod,$_zipCode,$_phone);
        return $orden;

    }

    public function  __construct() {

        $this->inicializarParametros();

    }

    public function actualizarCarrito()
    {
        $_SESSION['carro'];
        foreach($_SESSION['carro'] as $id=>$item)
        {
            if($_POST["$id"]==0)
            {
                unset ($_SESSION['carro'][$id]);
            }
            else
            {
                $_SESSION['carro'][$id]=$_POST["$id"];
            }
        }
        $_SESSION['items_nro']=$this->calcularNumeroItems($_SESSION['carro']);
        $_SESSION['items_precio']=$this->calcularPrecio($_SESSION['carro']);



    }
    public function calcularNumeroItems($carro)
    {
        $nro=0;
        foreach($carro as $key =>$item)
        {
            $nro=$nro+$item;

        }
        return $nro;

    }
    public function calcularPrecio($carro)
    {
        $nro=0;
        foreach($carro as $key =>$item)
        {
            $producto=$this->findProductById($key);

            $nro=$nro+$item*$producto->getPrice();

        }
        return $nro;
    }

    public function agregarProductos($id)
    {
        $producto=$this->findProductById($id);

        if(isset($_SESSION['carro'][$id]))
        {
            $_SESSION['carro'][$id]++;
        }
        else
        {
            $_SESSION['carro'][$id]=1;
        }
        $_SESSION['items_nro']=$this->calcularNumeroItems($_SESSION['carro']);
        $_SESSION['items_precio']=$this->calcularPrecio($_SESSION['carro']);


    }


    public function findProductById($id)
    {
        $productos=$this->getProductos();
        foreach($productos as $prod)
        {
            if($prod->getId()==$id)
            {
                return $prod;
            }
        }

    }

    public function inicializarParametros()
    {
        if(isset($_SESSION['carro']))
        {
            $this->_carro=$_SESSION['carro'];
            $this->_items_nro=count($_SESSION['items_nro']);

        }
        else
        {
            $this->_items_nro=0;
            $this->_items_precio=0.00;
            $_SESSION['items_nro']=$this->_items_nro;
            $_SESSION['items_precio']=$this->_items_precio;

        }
    }
    public function getProductos()
    {
        $producto=new Product();
        return $producto->getAll();

    }
    
    function inserProduct($name,$description,$price,$img){
        $p = new Product();
        return $p->insert($name,$description,$price,$img);
    }

    function deleteProduct($id){
        $p = new Product();
        return $p->delete($id);
    }

    
    
}


?>
