<?php defined('BASEPATH') or exit('No direct script access allowed');

class Home extends AI_Controller
{
    var $category;

    function __construct()
    {
        parent::__construct();
        $this->data['meta_title'] = theme_option('meta_title');
        $this->data['meta_description'] = null;
        $this->data['meta_keywords'] = null;
    }

    function index($page_id = 1)
    {
        $page = get_custom_page($page_id);
        if ($page == null) {
            $this->data['main'] = '404';
        } else {
            $this->data['page_id'] = $page_id;
            $this->data['main'] = isset($page['layout']) ? $page['layout'] : 'page';
            $this->data['page'] = $page = $this->Post_model->getCustomPage($page_id);
            if (!is_object($page)) {
                $this->data['main'] = '404';
            } else {
                $this->data['meta_title'] = $page->seo_title;
                $this->data['meta_description'] = $page->seo_description;
                $this->data['meta_keywords'] = $page->seo_keywords;
            }
        }
        $this->load->front_view('default', $this->data);
    }

    function page_slug($slug)
    {
        if ($slug != '') {
            $page = $this->db->get_where('posts', array('slug' => $slug))->row();
            if (is_object($page)) {
                $page_id = $page->id;
                if ($page->image != '') {
                    $page->image = base_url(upload_dir($page->image));
                } else {
                    $page->image = theme_url('images/foot-bg.jpg');
                }
                $this->data['page_id'] = $page_id;
                $this->data['page'] = $page; // $this->Post_model->getCustomPage($page_id);
                $this->data['main'] = $page->layout;
                $this->data['meta_title'] = $page->seo_title;
                $this->data['meta_description'] = $page->seo_description;
                $this->data['meta_keywords'] = $page->seo_keywords;
                $this->load->front_view('default', $this->data);
            } else {
                $this->errorpage();
            }
        } else {
            $this->errorpage();
        }
    }

    function post_single($post_id)
    {
        if ($post_id != '') {
            $page = $this->db->get_where('posts', array('id' => $post_id))->row();
            if (is_object($page)) {
                $page_id = $page->id;
                $this->data['page_id'] = $page_id;
                $this->data['page'] = $page; //$this->Post_model->getCustomPage($page_id);
                $this->data['main'] = 'post';
                $this->data['meta_title'] = $page->seo_title;
                $this->data['meta_description'] = $page->seo_description;
                $this->data['meta_keywords'] = $page->seo_keywords;
                $this->load->front_view('default', $this->data);
            } else {
                $this->errorpage();
            }
        } else {
            $this->errorpage();
        }
    }

    function save_submission()
    {
        $this->load->library('upload');
        if (isset($_POST['btnsubmit'])) {
            $form = $this->input->post('project');
            $form['created'] = date("Y-m-d H:i");

            $images = array();
            $files = $_FILES;
            $count = count($_FILES['filesToUpload']['name']);
            for ($i = 0; $i < $count; $i++) {
                $_FILES['filesToUpload']['name'] = $files['filesToUpload']['name'][$i];
                $_FILES['filesToUpload']['type'] = $files['filesToUpload']['type'][$i];
                $_FILES['filesToUpload']['tmp_name'] = $files['filesToUpload']['tmp_name'][$i];
                $_FILES['filesToUpload']['error'] = $files['filesToUpload']['error'][$i];
                $_FILES['filesToUpload']['size'] = $files['filesToUpload']['size'][$i];

                $config = array();
                $config['upload_path'] = upload_dir();
                $config['allowed_types'] = '*';
                $config['max_size'] = '0';
                $config['overwrite']     = FALSE;

                $this->upload->initialize($config);
                if ($this->upload->do_upload('filesToUpload')) {
                    $s = $this->upload->data();
                    $images[] = $s['file_name'];
                }
            }
            $form['images'] = json_encode($images);

            $this->db->insert("helpdata", $form);
            $this->session->set_flashdata('success', 'Form details sent successfully');
        }
        redirect('pages/help-submission');
    }

    function errorpage()
    {
        $this->data['main'] = '404';
        $this->load->front_view('default', $this->data);
    }
}
