<?php
class Users extends CI_Controller {
	public function __construct () {
		parent::__construct ();
		$this->form_validation->set_error_delimiters ('<div>', '</div>');
	}

	public function index () {
        if($this -> session -> has_userdata('login')){
            $login = $this -> session -> userdata('login');
            $user = new AI_User($login['user_id']);
            redirect($user -> goToDashboard());
        }
		$data['main'] = admin_view ('users/login');
		$this->load->view ('users/login', $data);
	}

	public function login () {
        $data['main'] = admin_view('users/login');
        $this->form_validation->set_rules ('username', 'Email Id', 'trim|required');
        $this -> form_validation -> set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run ()) {
            $email_id = $this->input->post ('username');
            $password = $this->input->post ('password');
            if ($this-> User_model ->loginCheck ($email_id, $password)) {
                $user = $this -> User_model -> getUser($email_id);
                $obj = new AI_User($user -> id);
                $s = array(
                    'user_id' => $user -> id,
                    'loggedat' => time(),
                );
                $this -> session -> set_userdata('login', $s);
                //echo $obj -> goToDashboard();
                redirect($obj -> goToDashboard());
            } else {
                $this->session->set_flashdata ('error', 'Invalid userid/password. Try again');
                redirect (admin_url ('users/login'));
            }

        } else {
            $this->load->view (admin_view ('users/login'), $data);
        }
	}

	public function forget () {
		$data['main'] = admin_view('users/forget');
		if ($this->input->post ('submit')) {
			$validate = array(
				array(
					'field' => 'email_id',
					'label' => 'Email ID',
					'rules' => 'required|valid_email'
				)
			);
			$this->form_validation->set_rules ($validate);
			if ($this->form_validation->run () == FALSE) {
				$this->load->view (admin_view('users/forget'), $data);
			} else {
				$email_id = $this->input->post ('email_id');
				$user = $this->Account_model->get_login ($email_id);
				if ($user) {
					$msg = 'Dear Admin';
					$msg .= '<br />Here is your login details : ';
					$msg .= '<br />User Name: ' . $user['username'];
					$msg .= '<br />Password : ' . $user['password'];
					echo $msg .= '<br /><br /> To login here. <a href="' . base_url ($this->config->item ('admin_folder') . 'users/login') . '">Login Now</a>';

					$this->load->library ('email');
					$this->email->from ('no-reply@domain.com', 'Web Admin');
					$this->email->to ($user['email_id']);
					$this->email->subject ('Recover Password');
					$this->email->message ($msg);

					$this->email->send ();

					$this->session->set_flashdata ('error', 'Password has been sent on your email id');
					redirect ($this->config->item ('admin_folder') . 'users/login');
				} else {
					$this->session->set_flashdata ('error', 'Sorry, Invalid Email ID');
					$this->load->view (admin_view('users/forget'), $data);
				}
			}
		} else {
			$this->load->view (admin_view('users/forget'), $data);
		}
	}

	public function logout () {
		$this->session->unset_userdata ('login');
		$this->session->sess_destroy ();
		$this->session->set_flashdata ('error', 'You have successfully logged out');
		redirect (admin_url('users/login'));
	}
}
