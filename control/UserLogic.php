<?php
require_once '../model/User.php';
class UserLogic{
    function auth($r_username,$r_pwd){
        $usr = new User();
        $users = $usr->getUsers();
        foreach($users as $user){
            $username = $user->getUsername();
            $pwd = $user->getPwd();
            if($r_username == $username && $r_pwd == $pwd)
                return $user;
        }
        return false;
    }
}
