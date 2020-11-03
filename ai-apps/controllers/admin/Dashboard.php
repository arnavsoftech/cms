<?php
class Dashboard extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $this->data['main'] = admin_view('dashboard');
        $this->data['rest_listing'] = array();
        $this->data['rest_members'] = array();
        $this->data['cats'] = array();
        $this->load->model(array('Post_model', 'Category_model'));
        $this->load->helper(array('category', 'post'));

        $this->data['posts'] = $this->Post_model->latest_post(15);
        $this->data['categories']    = $this->Category_model->latest_category(15);
        $this->load->view(admin_view('default'), $this->data);
    }
    public function profile()
    {
        $this->data['main'] = admin_view('members/edit-profile');
        $this->data['m'] = $this->User_model->getRow($this->admin->ID());

        $this->form_validation->set_rules('frm[first_name]', 'First name', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view(admin_view('default'), $this->data);
        } else {
            $save = $this->input->post('frm');
            $save['id'] = $this->admin->ID();
            if ($save['mobile_no'] <> $this->admin->getMobile()) {
                $save['mobile_verified'] = 0;
            }
            if ($this->input->post('pass1')) {
                $save['pass'] = $this->input->post('pass1');
            }
            $this->User_model->save($save);
            $this->session->set_flashdata('success', 'Profile information updated successfully');
            redirect(admin_url('dashboard/profile'));
        }
    }

    function verify()
    {
        $this->data['main'] = admin_view('members/verify-mobile');
        $mobile = $this->admin->getMobile();
        if ($this->admin->getData('mobile_verified') == 1) {
            $this->session->set_flashdata("error", "Mobile no already verified");
            redirect(admin_url('dashboard/profile'));
        }
        if ($this->input->post('submit')) {
            $otp = $this->input->post('otp');
            $sess_otp = $this->session->userdata('otp');
            if ($otp == $sess_otp) {
                $s = array();
                $s['id'] = $this->admin->ID();
                $s['mobile_verified'] = 1;
                $this->User_model->save($s);
                $this->session->set_flashdata('success', "Mobile no verified");
                redirect(admin_url('dashboard/profile'));
            } else {
                $this->session->set_flashdata("error", "OTP Invalid");
                redirect(admin_url('dashboard/profile'));
            }
            exit();
        }
        $this->session->unset_userdata('otp');
        $otp = rand(1000, 9999);
        $this->session->set_userdata('otp', $otp);
        $msg = "Mobile Verification code at Anirubha.com is : " . $otp;
        $this->load->library('Sms');
        $this->sms->send($mobile, $msg);
        $this->load->view(admin_view('default'), $this->data);
    }

    function contact_messages()
    {
        $this->data['main'] = 'contact-messages';

        $this->load->view('default', $this->data);
    }

    function delete_messages($id)
    {
        $this->db->delete('helpdata', array('id' => $id));
        $this->session->set_flashdata('success', 'Deleted Successfully');
        redirect(admin_url('dashboard/contact-messages'));
    }
}
