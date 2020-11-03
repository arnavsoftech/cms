<?php
class Setting_model extends Master_model{
    var $_global;
    function __construct(){
        parent::__construct();
	    $this -> _global = array(
            'primary-menu' => 1,
            'footer-menu' => 2
        );
        $this -> table = 'ai_options';
    }
	function all_options(){
		$data = array();
		$rest = $this -> db -> get($this -> table) -> result_array();
		if(is_array($rest) AND count($rest) > 0){
			foreach($rest as $row){
				$data[$row['option_name']] = $row['option_value'];
			}
		}
		return $data;
	}
    function get_option($option_name){
        $d = $this -> db -> get_where($this -> table, array('option_name' => $option_name)) -> first_row('array');
        if(is_array($d)){
            return $d;
        }else{
            $m['option_name'] = $option_name;
            $m['option_value'] = $this -> _global[$option_name];
            return $m;
        }
    }
    function get_option_value($option_name){
        $row = $this -> get_option($option_name);
        return $row['option_value'];
    }
	function save_option($data){
		$rest = $this -> db -> get_where($this -> table, array('option_name' => $data['option_name']));
		if($rest -> num_rows() > 0){
			$this -> db -> where('option_name', $data['option_name']);
			$this -> db -> update($this -> table, $data);
		}else{
			$this -> db -> insert($this -> table, $data);
		}
	}

    function seo_urls($offset = 0, $limit = 10){
        $this -> db -> order_by('seo_title', 'ASC');
        $this -> db -> limit($limit, $offset);
        $rest = $this -> db -> get('ai_seo');
        $arr_urls = $rest -> result_array();
        $rest -> free_result();
        $data['data'] = $arr_urls;
        $data['total'] = $this -> db -> count_all('ai_seo');
        return $data;
    }
    function url($id){
        return $this -> db -> get_where('ai_seo', array('id' => $id)) -> first_row('array');
    }
    function save_url($data){
        $row = $this -> db -> get_where('ai_seo', array('id' => $data['id']));
        if($row -> num_rows() > 0){
            $this -> db -> where('id', $data['id']);
            $this -> db -> update('ai_seo', $data);
        }else{
            $this -> db -> insert('ai_seo', $data);
            return $this -> db -> insert_id();
        }
    }
    function get_meta($url){
        $this -> db -> where('url', $url);
        $this -> db -> or_where('url', rtrim($url, '/'));
        return $this -> db -> get('ai_seo') -> first_row('array');
    }
    function url_delete($id){
        $this -> db -> where('id', $id);
        $this -> db -> delete('ai_seo');
    }

}
