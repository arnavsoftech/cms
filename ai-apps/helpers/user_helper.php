<?php
class AI_User{
    private $_user_id;
    private $_user;
    public static $_SUPER = 1;
    public static $_ADMIN = 2;
    public static $_AGENT = 3;
    public static $_MEMBER = 4;
    function __construct($user_id){
        $this -> _user_id = $user_id;
        $CI =& get_instance();
        $this -> _user = $CI -> User_model -> getUserById($user_id);
    }

    public static function getUserTypes(){
        $arr = array(
            1 => 'Super Admin',
            2 => 'Admin Staff',
            3 => 'Affiliates',
            4 => 'Member'
        );
        return $arr;
    }

    function ID(){
        return $this -> _user_id;
    }

    function is($type){
        if($this -> getData('user_type') == $type){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public static function typStr($type){
        if($type == self::$_SUPER){
            return 'Super Admin';
        }elseif($type == self::$_ADMIN){
            return 'Admin/Staff';
        }elseif($type == self::$_AGENT){
            return 'Affiliate User';
        }else{
            return 'Member';
        }
    }

    function goToDashboard(){
        switch($this -> _user -> user_type){
            case self::$_SUPER:
                $url = site_url('admin/dashboard');
                break;
            case self::$_ADMIN:
                $url = site_url('admin/dashboard');
                break;
            case self::$_AGENT:
                $url = site_url('admin/dashboard');
                break;
            case self::$_MEMBER:
                $url = site_url('accounts');
                break;
            default:
                $url = site_url();

        }
        return $url;
    }

    function getName(){
        return $this -> _user -> first_name . ' ' . $this -> _user -> last_name;
    }

    function getMobile(){
        return $this -> _user -> mobile_no;
    }

    function getAddress(){
        return $this -> _user -> address;
    }

    function getCity(){
        return $this -> _user -> city;
    }

    function getEmail(){
        return $this -> _user -> email_id;
    }

    function getData($field){
        if(property_exists($this -> _user, $field)){
            return $this -> _user -> $field;
        }else{
            return false;
        }
    }

    function imgUrl(){
        return base_url(upload_dir($this -> getData('image')));
    }

    function hasData($name){
        if(property_exists($this -> _user, $name)){
            return TRUE;
        }else{
            return FALSE;
        }
    }
}