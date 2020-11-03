<?php
class User_model extends Master_model{

    var $tel_codes;
	function __construct(){
		parent::__construct();
		$this -> table = 'ai_users';
        $this -> tel_codes = array(7, 20, 27, 30, 31, 32, 33, 34, 36, 39, 40, 41, 43, 44, 45, 46, 47, 48, 49, 51, 52, 53, 54, 55, 56, 57, 58, 60, 61, 62, 63, 64, 65, 66, 81, 82, 84, 86, 90, 91, 92, 93, 94, 95, 98, 211, 212, 213, 216, 218, 220, 221, 222, 223, 224, 225, 226, 227, 228, 229, 230, 231, 232, 233, 234, 235, 236, 237, 238, 239, 240, 241, 242, 243, 244, 245, 246, 248, 249, 250, 251, 252, 253, 254, 255, 256, 257, 258, 260, 261, 262, 263, 264, 265, 266, 267, 268, 269, 290, 291, 297, 298, 299, 350, 351, 352, 353, 354, 355, 356, 357, 358, 359, 370, 371, 372, 373, 374, 375, 376, 377, 378, 380, 381, 382, 385, 386, 387, 389, 420, 421, 423, 500, 501, 502, 503, 504, 505, 506, 507, 508, 509, 590, 591, 592, 593, 594, 595, 596, 597, 598, 599, 670, 672, 673, 674, 675, 676, 677, 678, 679, 680, 681, 682, 683, 685, 686, 687, 688, 689, 690, 691, 692, 850, 852, 853, 855, 856, 880, 886, 960, 961, 962, 963, 964, 965, 966, 967, 968, 970, 971, 972, 973, 974, 975, 976, 977, 992, 993, 994, 995, 996, 998);
	}

    function getUserMetaList(){
        $arr = array('phone_no', 'dob', 'education', 'city', 'address', 'state', 'birth_place');
        return $arr;
    }

    function getAll($offset = 0, $limit = 40, $parent_id = false){
        $this -> db -> order_by('id', 'DESC');
        $this -> db -> limit($limit, $offset);
        if($parent_id){
            $this -> db -> where('parent_id', $parent_id);
        }
        $rest = $this -> db -> get($this -> table);
        $data['results'] = $rest -> result();
        if($parent_id){
            $this -> db -> where('parent_id', $parent_id);
        }
        $data['total'] = $this -> db -> get($this -> table) -> num_rows();
        return $data;
    }

    function getAllSearched($offset = 0, $limit = 40, $likes = array(), $parent_id = false){

        if($parent_id){
            $this -> db -> where('parent_id', $parent_id);
        }
        if(count($likes) > 0){
            foreach($likes as $key => $val){
                $this -> db -> or_like($key, $val);
            }
        }
        $this -> db -> order_by('id', 'DESC');

        $sql = $this -> db -> get_compiled_select($this -> table, false);
        $this -> db -> limit($limit, $offset);
        $rest = $this -> db -> get();
        $data['results'] = $rest -> result();
        $data['total'] = $this -> db -> query($sql) -> num_rows();
        return $data;
    }

	function createAccount($u){
		$this -> db -> insert($this -> table, $u);
		return $this -> db -> insert_id();
	}

	function validateEmail($email, $act_code){
		$r = $this -> db -> get_where($this -> table, array('email_id' => $email, 'act_code' => $act_code, 'status' => 0));
		if($r -> num_rows() > 0){
			return true;
		}else{
			return false;
		}
	}

	function loginCheck($email, $pass){
		$r = $this -> db -> get_where($this -> table, array('email_id' => $email, 'pass' => $pass, 'status' => 1));
		if($r -> num_rows() > 0){
			return true;
		}else{
			return false;
		}
	}

	function getUser($email_id){
        if(is_int($email_id)){
            return $this -> getUserById($email_id);
        }
		$r = $this -> db -> get_where($this -> table, array('email_id' => $email_id)) -> first_row();
		return $r;
	}

	function getUserById($id){
		$r = $this -> db -> get_where($this -> table, array('id' => $id)) -> first_row();
		return $r;
	}

    function getUserByMobile($mobile_no){
        $r = $this -> db -> get_where($this -> table, array('mobile_no' => $mobile_no)) -> first_row();
        return $r;
    }

    function verifyOTP($otp, $mobile_no){
        $c = $this -> db -> get_where($this -> table, array('mobile_no' => $mobile_no, 'mobile_vcode' => $otp)) -> num_rows();
        if($c > 0){
            $data = array();
            $data['mobile_verified'] = 1;
            $data['status'] = 1;
            $data['is_verified'] = 1;
            $this -> db -> update($this -> table, $data, array('mobile_no' => $mobile_no, 'mobile_vcode' => $otp));
            return TRUE;
        }else{
            return FALSE;
        }
    }

    function emailExists($email_id){
        $s = $this -> db -> get_where($this -> table, array('email_id' => $email_id)) -> num_rows();
        if($s > 0){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    function saveMeta($user_id, $meta = array()){
        if(is_array($meta) && count($meta) > 0){
            foreach ($meta as $k => $v) {
                $userinfo = array();
                $userinfo['user_id'] = $user_id;
                $userinfo['meta_key'] = $k;
                $userinfo['meta_value'] = $v;
                if($this -> db -> get_where('ai_usermeta', array('user_id' => $user_id, 'meta_key' => $k, 'meta_value' => $v)) -> num_rows() == 0){
                    $this -> db -> insert('ai_usermeta', $userinfo);
                }else{
                    $this -> db -> update('ai_usermeta', $userinfo, array('user_id' => $user_id, 'meta_key' => $k, 'meta_value' => $v));
                }
            }
        }
    }
}
