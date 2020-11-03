<?php
class Categories extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->data['active_tabs'] = "catalog";
        $this->load->model(array('Category_model'));
        $this->load->helper('category');
    }
    function cat_link($page = 1)
    {
        $show_per_page = 500;
        $offset = ($page - 1) * $show_per_page;

        $this->data['main'] = 'category/link';
        $data    = $this->Category_model->getAll($offset, $show_per_page);
        $this->data['categories'] = $data['results'];
        $this->load->view('default', $this->data);
    }

    function index()
    {
        $this->data['dashboard_title'] = "Manage Category";
        $this->data['main'] = 'category/index';
        $this->data['categories'] = $this->db->order_by('name', 'ASC')->get('categories')->result();
        $this->load->view('default', $this->data);
    }


    function add($id = false)
    {

        $config['upload_path']        = upload_dir();
        $config['allowed_types']    = 'gif|jpg|png|jpeg|bmp';
        $config['max_size']            = '5000';
        $config['max_width']        = '3000';
        $config['max_height']        = '2000';
        $this->load->library('upload', $config);

        $this->data['main']             = 'category/add';
        $this->data['categories']        = $this->Category_model->category_dropdown();
        $this->data['cat'] = $this->Category_model->getNew();
        if ($id) {
            $this->data['cat'] = $this->Category_model->getRow($id);
        }
        $this->form_validation->set_rules('cat[name]', 'Name', 'trim|required|max_length[64]');
        $this->form_validation->set_rules('cat[slug]', 'Slug', 'trim');
        $this->form_validation->set_rules('cat[description]', 'Description', 'trim');
        $this->form_validation->set_rules('cat[sequence]', 'Sequence', 'trim|integer');
        $this->form_validation->set_rules('cat[parent_id]', 'Parent id', 'trim');
        if ($this->form_validation->run()) {
            $catdata = $this->input->post('cat');
            $catdata['id'] = $id;
            $catdata['sequence'] = intval($catdata['sequence']);
            $uploaded    = $this->upload->do_upload('image');
            if ($id) {
                if ($this->input->post('del_image')) {
                    $img_name = $this->input->post('hid_image');
                    @unlink(upload_dir($img_name));
                    $catdata['image'] = '';
                }
            }
            if ($uploaded) {
                $image            = $this->upload->data();
                $catdata['image']    = $image['file_name'];
            }
            $slug = $this->input->post('slug');
            if (empty($slug) || $slug == '') {
                $slug = $this->input->post('cat[name]');
            }
            $slug    = strtolower(url_title($slug));
            $catdata['popular_cat'] = isset($catdata['popular_cat']) ? 1 : 0;
            $catdata['slug'] = $this->Category_model->get_unique_url($slug, $id);

            $id    = $this->Category_model->save($catdata);

            $this->session->set_flashdata('success', 'Category saved successfully.');
            redirect(admin_url('categories/add/' . $id));
        } else {
            $this->load->view('default', $this->data);
        }
    }

    function activate($id = false)
    {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('categories');
        if ($id) {
            $c['id'] = $id;
            $c['status'] = 1;
            $this->Category_model->save($c);
            $this->session->set_flashdata("success", "Category saved");
        }
        redirect($redirect);
    }

    function deactivate($id = false)
    {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('categories');
        if ($id) {
            $c['id'] = $id;
            $c['status'] = 0;
            $this->Category_model->save($c);
            $this->session->set_flashdata("success", "Category saved");
        }
        redirect($redirect);
    }

    public function delete($id)
    {
        if ($id > 0) {
            if ($this->Category_model->hasChildren($id)) {
                $this->session->set_flashdata("error", "Subcategory exists, Please delete them first");
                redirect(admin_url('categories'));
                exit();
            }
            $data = $this->Category_model->getRow($id);
            if ($data->image != '') {
                $file = array();
                $file[] = upload_dir($data->image);
                foreach ($file as $f) {
                    if (file_exists($f)) {
                        @unlink($f);
                    }
                }
            }
            $this->Category_model->delete($id);
            $this->session->set_flashdata('success', 'Category deleted successfully');
        }
        redirect(admin_url('categories'));
    }
}
