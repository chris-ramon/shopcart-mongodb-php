<?php
require_once '../control/Controlador.php';
require_once '../persistence/Persistence.php';
require_once '../control/UserLogic.php';

if(!isset($_SESSION)) 
{ 
session_start(); 
}  
class ViewPHP {

    public static function run()
    {

        $miLogic=new Controlador();
        
        $view=isset($_GET['view'])?($_GET['view']):'default';
        switch($view)
        {
            case 'default':
                $productos=$miLogic->getProductos();

                break;
            case 'agregar':$miLogic->agregarProductos($_GET['id']);
                            header('location:ViewPHP.php');

                break;

            case 'update':$miLogic->actualizarCarrito();
                 header('location:ViewPHP.php?view=detalle');


                break;
            case 'cerrar': $miLogic->cerrarSesion();
                break;

            case 'detalle':
                $productos=$miLogic->getProductos();

                break;
             case 'presentar':
                    $name = $_POST['name'];
                    $address = $_POST['address'];
                    $city = $_POST['city'];
                    $province = $_POST['province'];
                    $email = $_POST['email'];
                    $country = $_POST['country'];
                    $shippingMethod = $_POST['shippingMethod'];
                    $paymentMethod = $_POST['paymentMethod'];
                    $zipCode = $_POST['zipCode'];
                    $phone = $_POST['phone'];
                    $orden=$miLogic->crearOrden($name,$address,$city,
                                    $province,$email,$country,$shippingMethod,
                                    $paymentMethod,$zipCode,$phone);
                    
                    break;
             case 'imagen':
                 $imagen=$miLogic->loadImage($_GET['id']);
                 header('Content-type:image/png');
                 echo $imagen->getBytes();
                 break;
            case 'login':
                if(isset($_POST['username']) && isset($_POST['pwd'])){
                    if($_POST['username']!=null && $_POST['pwd']!=null){
                        $r_username =$_POST['username'];
                        $r_pwd = $_POST['pwd'];
                        $userLogic = new UserLogic();
                        $rs = $userLogic->auth($r_username,$r_pwd);
                        header('location:ViewPHP.php');
                    }
                }
                break;
            case 'register':
                echo $username = $_POST['username'];
                echo $pwd = $_POST['pwd'];
                echo $role = 'customer';
                $userLogic = new UserLogic();
                $created = $userLogic->create($username, $pwd, $role);
                $rs = $userLogic->auth($username, $pwd);
                echo var_dump($rs);
//                $username = $_POST['username'];
//                $pwd = $_POST['pwd'];
//                $role = 'customer';
//                $userLogic = new UserLogic();
//                $created = $userLogic->create($username, $pwd, $role);
//                echo $created;
//                if ($created) {
//                    $rs = $userLogic->auth($username, $pwd);
//                    header('location:ViewPHP.php');
//                } else {
//                    // TODO: handle errors
//                    header('location:ViewPHP.php');
//                }
                break;
            case 'addProduct':
                if(isset($_POST['name'])){
                    if($_POST['name']!=null && $_POST['description']!=null
                    && $_POST['price']!=null && $_FILES['img']!=null ){
                        $name = $_POST['name'];
                        $description = $_POST['description'];
                        $price = $_POST['price'];                        
                        $img = $_FILES['img'];
                        $nameimg = $_FILES['img']['name'];
                        $path = getcwd();
                        $path = substr($path,0,35);
                        $mvpath = '../imagenes/'.$nameimg;                        
                        $tmp_name = $_FILES['img']['tmp_name'];
                        move_uploaded_file($tmp_name,$mvpath);                        
                        $status = $miLogic->inserProduct($name,$description,$price,$mvpath);   
                        header('location:ViewPHP.php?view=default');                                             
                    }
                }             
                break;
            case 'deleteProduct':
                if(isset($_POST['id'])){
                    if($_POST['id']!=null){
                        $status = $miLogic->deleteProduct($_POST['id']);
                        header('location:ViewPHP.php');
                    }
                }
                break;
            default:
                    break;

        }
        require_once 'generalView.html';


    }
}
ViewPHP::run();
?>
