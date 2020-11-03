<?php
class Media_model extends Master_model{

	function __construct(){
		parent::__construct();
		$this -> table = 'ai_posts';
	}

    function getAllFiles($offset = 0, $limit = 40){

        $this -> db -> where('post_type', 'media');
        $this -> db -> order_by('id', 'DESC');
        $this -> db -> limit($limit, $offset);
        $rest = $this -> db -> get($this -> table);
        $data['results'] = $rest -> result();
        $data['total'] = $this -> db -> get_where($this -> table, array('post_type' => 'media')) -> num_rows();
        return $data;
    }
}
