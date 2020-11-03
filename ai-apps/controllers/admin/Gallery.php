<?php
class Gallery extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("gallery_model");
        $this->data['active_tabs'] = 'media';
    }
    public function index()
    {
        $this->data['site_title'] = 'Gallery';
        $this->data['main'] = 'gallery/index';
        $this->data['gallery_list']    = $this->gallery_model->get_galleries_admin();
        $this->load->view('default', $this->data);
    }
    public function create($id = false)
    {
        $this->data['site_title'] = 'Create Gallery';
        $this->data['main'] = 'gallery/add';
        $this->data['gallery'] = array(
            'id' => $id,
            'gallery_name' => '',
            'gallery_n_hindi' => '',
            'description' => '',
            'description_hindi' => '',
            'sequence' => '',
            'lang_id' => 1,
            'sports_id' => 0,
            'seo_title' => '',
            'seo_keywords' => '',
            'seo_description' => '',
            'seo_t_hindi' => '',
            'seo_d_hindi' => '',
            'seo_k_hindi' => '',
            'slug' => '',
            'status' => 1
        );
        if ($id) {
            $gallery = $this->gallery_model->get_gallery($id);
            $this->data['gallery'] = $gallery;
        }


        $this->form_validation->set_rules('gallery_name', 'Gallery Name', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('default', $this->data);
        } else {
            $save['id']                =     $id;
            $save['gallery_name']     =     $title_eng = $this->input->post('gallery_name');
            $save['status']        = $this->input->post('status') ? 1 : 0;
            $gal_id = $this->gallery_model->save($save);
            $this->session->set_flashdata('success', 'Gallery saved successfully');
            redirect(admin_url('gallery/create/' . $gal_id));
        }
    }
    public function multiple($id = false)
    {
        $this->data['site_title'] = 'File upload';
        $this->load->library('image_lib');
        $this->data['main'] = 'gallery/multiple-upload';
        $this->data['id'] = $id;
        $this->load->library('upload');
        $err_str = '';
        if ($this->input->post('submit')) {
            $save = array();
            $files = $_FILES;
            $count = count($_FILES['filesToUpload']['name']);
            $save['gallery_id'] = $id;
            for ($i = 0; $i < $count; $i++) {
                $_FILES['filesToUpload']['name'] = $files['filesToUpload']['name'][$i];
                $_FILES['filesToUpload']['type'] = $files['filesToUpload']['type'][$i];
                $_FILES['filesToUpload']['tmp_name'] = $files['filesToUpload']['tmp_name'][$i];
                $_FILES['filesToUpload']['error'] = $files['filesToUpload']['error'][$i];
                $_FILES['filesToUpload']['size'] = $files['filesToUpload']['size'][$i];

                $config = array();
                $config['upload_path']          = upload_dir();
                $config['allowed_types']        = 'jpg|png|gif';
                $config['max_size']             = 10000;
                $config['max_width']            = 5000;
                $config['max_height']           = 5000;
                $config['overwrite']     = FALSE;

                $this->upload->initialize($config);
                if ($this->upload->do_upload('filesToUpload') == False) {
                    $err_str .= $this->upload->display_errors();
                } else {
                    $d = $this->upload->data();
                    $basename = $d['raw_name'];
                    $title = str_replace('-', ' ', $basename);

                    $save['id']     = false;
                    $save['image']  = $d['file_name'];
                    $save['title'] = ucfirst($title);
                    $save['slug'] = $basename;
                    $save['image_alt'] = "Images for $title";
                    $save['image_title'] = $title;
                    $save['meta_title'] = "Images for $title, Photos, Pictures";
                    $save['meta_description'] = "Check out images for $title also gets more photos of $title on Qissey.";
                    $save['meta_keywords'] = "$title Photos, Pictures";


                    $this->gallery_model->save_image($save);

                    //Medium image

                    $arr_names = explode('.', $save['image']);
                    $md_name = $arr_names[0] . '-md.' . $arr_names[1];
                    $sm_name = $arr_names[0] . '-sm.' . $arr_names[1];

                    $config = array();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = upload_dir($save['image']);
                    $config['new_image']    = upload_dir($md_name);
                    $config['maintain_ratio'] = FALSE;
                    $config['width'] = 360;
                    $config['height'] = 250;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();

                    $config = array();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = upload_dir($save['image']);
                    $config['new_image']    = upload_dir($sm_name);
                    $config['maintain_ratio'] = FALSE;
                    $config['width'] = 130;
                    $config['height'] = 100;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();
                }
            }
            $this->session->set_flashdata('success', 'Image uploaded for Gallery');
            $this->session->set_flashdata('error', $err_str);
            redirect(admin_url('gallery/view/' . $id));
        } else {
            $this->load->view('default', $this->data);
        }
    }
    public function view($id)
    {
        $this->load->library("image_lib");
        if ($this->input->post('cover_image')) {
            $s['id'] = $id;
            $s['cover_image'] = $this->input->post('cover_image');
            $this->gallery_model->save($s);
        }
        if ($this->input->post('re_crop')) {
            $arr_imges    = $this->gallery_model->get_images($id);
            foreach ($arr_imges as $row) {
                $arr_names = explode('.', $row['image']);
                $md_name = $arr_names[0] . '-md.' . $arr_names[1];
                $sm_name = $arr_names[0] . '-sm.' . $arr_names[1];

                $config = array();
                $config['image_library'] = 'gd2';
                $config['source_image'] = upload_dir($row['image']);
                $config['new_image']    = upload_dir($md_name);
                $config['maintain_ratio'] = FALSE;
                $config['width'] = 360;
                $config['height'] = 250;
                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $this->image_lib->clear();

                $config = array();
                $config['image_library'] = 'gd2';
                $config['source_image'] = upload_dir($row['image']);
                $config['new_image']    = upload_dir($sm_name);
                $config['maintain_ratio'] = FALSE;
                $config['width'] = 130;
                $config['height'] = 100;
                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $this->image_lib->clear();
            }
        }
        $this->data['site_title'] = 'View Images';
        $this->data['main']       = 'gallery/view-images';
        $this->data['id']            = $id;
        $this->data['image_list']    = $this->gallery_model->get_images($id);
        $gallery            = $this->gallery_model->get_gallery($id);
        $this->data['gallery']    = $gallery;
        $this->data['gallery_name']     =     $gallery['gallery_name'];
        $this->load->view('default', $this->data);
    }
    public function delete($id = false)
    {
        if ($id) {
            $arr_images = $this->gallery_model->get_images($id);
            if (is_array($arr_images) and count($arr_images) > 0) {
                foreach ($arr_images as $row) {
                    @unlink('img/gallery/' . $row['image']);
                }
            }
            $this->db->where('id', $id);
            $this->db->delete('gallery');
            $this->session->set_flashdata('success', 'Gallery Deleted Successfully');
            redirect(admin_url('gallery'));
        }
    }
    public function delete_image($gallery_id, $id = false)
    {
        if ($id) {
            $image = $this->gallery_model->get_image($id);
            @unlink(upload_dir($image['image']));
            $this->db->where('id', $id);
            $this->db->delete('gallery_img');
            $this->session->set_flashdata('success', 'Image Deleted Successfully');
            redirect(admin_url('gallery/view/' . $gallery_id));
        }
    }
    public function edit_image($id = false)
    {
        $this->data['site_title'] = 'Edit Image Information';
        $this->data['main'] = 'gallery/edit-image';
        $this->data['id']    = $id;
        $cat_id = false;
        if ($id) {
            $image = $this->gallery_model->get_image($id);
            $this->data['image'] = $image;
            $cat_id = $image['gallery_id'];
        }
        if ($this->input->post('submit')) {
            $save['id']        = $id;
            $save['title'] = $title_eng = $this->input->post('title');
            $save['description'] = $this->input->post('description');
            $save['image_alt'] = $this->input->post('image_alt');
            $save['image_title'] = $this->input->post('image_title');
            $save['meta_title'] = $this->input->post('meta_title');
            $save['meta_description'] = $this->input->post('meta_description');
            $save['meta_keywords'] = $this->input->post('meta_keywords');
            $slug = $this->input->post('slug');
            $save['slug'] = $slug;

            $this->gallery_model->save_image($save);
            $this->session->set_flashdata('success', "Gallery Image Saved");
            redirect(admin_url('gallery/edit-image/' . $id));
        }
        $this->load->view('default', $this->data);
    }

    function activate($id)
    {
        $url = isset($_GET['redirect_to']) ? urldecode($_GET['redirect_to']) : admin_url('gallery');
        $s = array();
        $s['id'] = $id;
        $s['status'] = 1;
        $this->gallery_model->save($s);
        $this->session->set_flashdata("success", "Gallery status activated successfully!!");
        redirect($url);
    }

    function deactivate($id)
    {
        $url = isset($_GET['redirect_to']) ? urldecode($_GET['redirect_to']) : admin_url('gallery');
        $s = array();
        $s['id'] = $id;
        $s['status'] = 0;
        $this->gallery_model->save($s);
        $this->session->set_flashdata("success", "Gallery status deactivated successfully!!");
        redirect($url);
    }
}
