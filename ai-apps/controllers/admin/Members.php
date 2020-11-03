<?php
class Members extends MY_Controller{
	public function __construct(){
		parent::__construct();
		$this -> data['active_tabs'] = 'members';
	}

	public function add($id = false){
		$this -> data['main'] = admin_view('members/add');
		$this -> data['m'] = $this -> User_model -> getNew();
		$this -> data['m'] -> gender = "Male";
		if($id){
			$this -> data['m'] = $this -> User_model -> getRow($id);
		}
		$this -> form_validation -> set_rules('frm[first_name]', 'First name', 'required');
		if($this -> form_validation -> run()){
			$m = $this -> input -> post('frm');
            echo $this -> getUserID();
            $admin = new AI_User($this -> getUserID());
            if($admin -> is(AI_User::$_AGENT)){
                $m['parent_id'] = $this -> admin -> ID();
            }else{
                $m['parent_id'] = 0;
            }
			$m['id'] = $id;
            if($id == false){
                $m['created'] = date('Y-m-d H:i:s');
            }
			$id = $this -> User_model -> save($m);
			$this -> session -> set_flashdata("success", "Member detail saved");
			redirect(admin_url('members/add/' . $id));
		}else {
			$this->load->view (admin_view ('default'), $this->data);
		}
	}

	public function index($page = 1){
        $this -> load -> library('pagination');
        $show_per_page = 40;
		$offset = ($page - 1) * $show_per_page;
        $this -> data['main'] = admin_view('members/index');
		$members = $this -> User_model -> getAll($offset, $show_per_page);
		if($this -> input -> get('btnsearch')){
			$q = $this -> input -> get('q');
			if($q <> ''){
				$likes = array(
					'first_name' => $q, 'last_name' => $q, 'email_id' => $q
				);
				$members = $this -> User_model -> getAllSearched($offset, $show_per_page, $likes);
			}
		}

        $this -> data['mem_list']  = $members['results'];
        $config['base_url'] 	 = admin_url('members/index');
        $config['num_links'] 	 = 2;
        $config['uri_segment']	 = 4;
        $config['total_rows']	 = $members['total'];
        $config['per_page'] 	 = $show_per_page;
        $config['full_tag_open'] = '<ul class="pagination pagination-sm">';
        $config['full_tag_close']= '</ul>';
        $config['num_tag_open']  = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['first_link'] 	 = 'First';
        $config['first_tag_open']= '<li>';
        $config['first_tag_close']= '</li>';
        $config['last_link'] 	 = 'Last';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close']= '</li>';
        $config['prev_link'] 	 = 'Prev';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close']= '</li>';
        $config['next_link'] 	 = 'Next';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close']= '</li>';
        $config['cur_tag_open']	 = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
		$config['use_page_numbers'] = true;
		$config['use_page_numbers'] = true;
		$config['page_query_string'] = true;
		$config['query_string_segment'] = 'page';
		$config['reuse_query_string'] = true;

        $this->pagination->initialize($config);

        $this -> data['paginate'] 	=  $this->pagination->create_links();

		$this -> load -> view(admin_view('default'), $this -> data);
	}

	function activate($id = false){
		$redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('members');
		if($id){
			$c['id'] = $id;
			$c['status'] = 1;
			$this -> User_model -> save($c);
			$this -> session -> set_flashdata("success", "Member account activated");
		}
		redirect($redirect);
	}

	function deactivate($id = false){
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('members');
		if($id){
			$c['id'] = $id;
			$c['status'] = 0;
			$this -> User_model -> save($c);
			$this -> session -> set_flashdata("success", "Member account deactivated");
		}
		redirect($redirect);
	}

	public function delete($id){
        if($id == 1){
            $this -> session -> set_flashdata("error", "You cannot delete Super Administrator");
        }
		if($id > 1){
			$this -> User_model -> delete($id);
			$this -> session -> set_flashdata('success', 'Member deleted successfully ');
		}
		redirect(admin_url('members'));
	}

	public function subscriptions($page = 1){
		$show_per_page = 10;
		$offset = ($page - 1) * $show_per_page;
		$this -> data['main'] = admin_view('members/subscriptions');
		$members = $this -> Master_model -> getAll($offset, $show_per_page, 'ai_subscription');
		$this -> data['emails']  = $members['results'];
		$config['base_url'] 	 = admin_url('members/subscriptions');
		$config['num_links'] 	 = 2;
		$config['uri_segment']	 = 4;
		$config['total_rows']	 = $members['total'];
		$config['per_page'] 	 = $show_per_page;
		$config['full_tag_open'] = '<ul class="pagination pagination-sm">';
		$config['full_tag_close']= '</ul>';
		$config['num_tag_open']  = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['first_link'] 	 = 'First';
		$config['first_tag_open']= '<li>';
		$config['first_tag_close']= '</li>';
		$config['last_link'] 	 = 'Last';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close']= '</li>';
		$config['prev_link'] 	 = 'Prev';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close']= '</li>';
		$config['next_link'] 	 = 'Next';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close']= '</li>';
		$config['cur_tag_open']	 = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['use_page_numbers'] = true;

		$this->pagination->initialize($config);

		$this -> data['paginate'] 	=  $this->pagination->create_links();

		$this -> load -> view(admin_view('default'), $this -> data);
	}

	function unsubscribe($id = false){
		$redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('subscriptions');
		if($id){
			$c['id'] = $id;
			$c['status'] = 0;
			$this -> Master_model -> save($c, 'ai_subscription');
			$this -> session -> set_flashdata("success", "Email id unsubscribed");
		}
		redirect($redirect);
	}
	function subscribe($id = false){
		$redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('subscriptions');
		if($id){
			$c['id'] = $id;
			$c['status'] = 1;
			$this -> User_model -> save($c, 'ai_subscription');
			$this -> session -> set_flashdata("success", "Email id subscribed");
		}
		redirect($redirect);
	}

	public function delsubscribe($id){
		if($id > 0){
			$this -> User_model -> delete($id, 'ai_subscription');
			$this -> session -> set_flashdata('success', 'Email deleted successfully ');
		}
		redirect(admin_url('members/subscriptions'));
	}
}
