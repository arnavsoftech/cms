<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
    var $is_login;

    function __construct() {
        parent::__construct();
        $this->output->nocache();
        $this->form_validation->set_error_delimiters('<div>', '</div>');
        $this->output->nocache();
        if (!$this->session->has_userdata('login')) {
            $this->session->set_flashdata('error', 'Session out!! Please login agin');
            redirect(admin_url('users/login'), 'refresh');
        }
        $this->data['active_tabs'] = 'dashboard';
        $this->data['dashboard_title'] = 'Dashboard';
        $this->load->library(array('pagination'));
    }

    function resize($source_file = FALSE) {
        $this->load->library('image_lib');
        $file = basename($source_file);
        $filearr = explode('.', $file);
        $file_p = $filearr[0];
        $file_a = $filearr[1];
        $sizes = config_item("img_sizes");
        if (is_array($sizes) && count($sizes) > 0) {
            foreach ($sizes as $key => $size_ar) {
                $width = $size_ar[0];
                $height = $size_ar[1];
                $filename = $file_p . '-' . $key . '.' . $file_a;
                $config = array();
                $config['image_library'] = 'gd2';
                $config['source_image'] = $source_file;
                $config['new_image'] = upload_dir($filename);
                $config['maintain_ratio'] = FALSE;
                $config['width'] = $width;
                $config['height'] = $height;
//                $config['x_axis']   = $width;
//                $config['y_axis']   = $height;
                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $this->image_lib->clear();
            }
        }
    }

    function img_files($source_file) {
        $data = array();
        $file = basename($source_file);
        $filearr = explode('.', $file);
        $file_p = $filearr[0];
        $file_a = $filearr[1];
        $sizes = config_item("img_sizes");
        if (is_array($sizes) && count($sizes) > 0) {
            foreach ($sizes as $key => $size_ar) {
                $filename = $file_p . '-' . $key . '.' . $file_a;
                $data[] = $filename;
            }
        }
        return $data;
    }

    function delImages($source_file) {
        $imgarr = $this->img_files($source_file);
        if (is_array($imgarr) && count($imgarr) > 0) {
            foreach ($imgarr as $fname) {
                @unlink(upload_dir($fname));
            }
        }
    }
}

class AI_Controller extends CI_Controller {
    var $data;
    var $lang_id;
    function __construct() {
        parent::__construct();
        $this->output->nocache();
        $this->form_validation->set_error_delimiters('<div>', '</div>');
        $this->data['seo_title'] = 'Dilersamachar';
        $this->data['seo_description'] = '';
        $this->data['seo_keywords'] = '';
        $this->data['og_image'] = theme_url('assets/img/logo.png');

        $this->load->model(array("Menu_model", "User_model"));

        $lang = FALSE;
        if (preg_match('/^(.+)\.qissey.com$/', $_SERVER['HTTP_HOST'], $matches) && count($matches) == 2 && $matches[1] != 'www') {
            $lang = $matches[1];
        }
        if ($lang == 'hindi') {
            $this->lang_id = HIN;
            $this->lang->load('default', 'hindi');
        } else {
            $this->lang_id = ENG;
            $this->lang->load('default', 'english');
        }
        $this->Post_model->lang_id = $this->lang_id;
        if ($this->session->has_userdata('lang_id')) {
            $this->lang_id = $this->session->userdata('lang_id');
        } else {
            $this->session->set_userdata('lang_id', $this->lang_id);
        }
        $this->data['lang_id'] = $this->lang_id;
    }

    function user(){

        $login = $this -> session -> userdata('logina');

        return $login['user_id'];

    }
     function user_id(){

        $login = $this -> session -> userdata('login');

        return $login['user_id'];

    }
     function resize($source_file = FALSE) {
        $this->load->library('image_lib');
        $file = basename($source_file);
        $filearr = explode('.', $file);
        $file_p = $filearr[0];
        $file_a = $filearr[1];
        $sizes = config_item("img_sizes");
        if (is_array($sizes) && count($sizes) > 0) {
            foreach ($sizes as $key => $size_ar) {
                $width = $size_ar[0];
                $height = $size_ar[1];
                $filename = $file_p . '-' . $key . '.' . $file_a;
                $config = array();
                $config['image_library'] = 'gd2';
                $config['source_image'] = $source_file;
                $config['new_image'] = upload_dir($filename);
                $config['maintain_ratio'] = FALSE;
                $config['width'] = $width;
                $config['height'] = $height;
//                $config['x_axis']   = $width;
//                $config['y_axis']   = $height;
                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $this->image_lib->clear();
            }
        }
    }
     function delImages($source_file) {
        $imgarr = $this->img_files($source_file);
        if (is_array($imgarr) && count($imgarr) > 0) {
            foreach ($imgarr as $fname) {
                @unlink(upload_dir($fname));
            }
        }
    }
    function img_files($source_file) {
        $data = array();
        $file = basename($source_file);
        $filearr = explode('.', $file);
        $file_p = $filearr[0];
        $file_a = $filearr[1];
        $sizes = config_item("img_sizes");
        if (is_array($sizes) && count($sizes) > 0) {
            foreach ($sizes as $key => $size_ar) {
                $filename = $file_p . '-' . $key . '.' . $file_a;
                $data[] = $filename;
            }
        }
        return $data;
    }

}
