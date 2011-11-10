<?php
require_once '../persistence/Persistence.php';
class User{
    private $_id;
    private $_username;
    private $_pwd;
    private $_type;
    
    function __construct($id="",$username="",$pwd="",$type=""){
        $this->_id = $id;
        $this->_username = $username;
        $this->_pwd = $pwd;
        $this->_type = $type;
    }    
    
    function getID(){return $this->_id;}
    function getUsername(){return $this->_username;}
    function getPwd(){return $this->_pwd;}
    function getType(){return $this->_type;}
    
    function getUsers(){
        $i = Persistence::getInstance();
        $array = $i->getAll('users');
        $users = array();
        foreach($array as $usr){
            $id = $usr['_id'];
            $name = $usr['name'];
            $pwd = $usr['password'];
            $type = $usr['type'];
            $user = new User($id,$name,$pwd,$type);
            $users[] = $user;
        }
        return $users;    
    }
}
