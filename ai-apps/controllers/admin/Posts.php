<?php
class Posts extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $config['upload_path']        = upload_dir();
        $config['allowed_types']    = 'gif|jpg|png|jpeg|pdf|doc|docx|xls';
        $config['max_width']        = '4000';
        $config['max_height']        = '4000';
        $this->load->library('upload', $config);
        $this->data['active_tabs'] = 'posts';
    }

    public function index($offset = 0)
    {
        $this->data['active_tabs'] = 'catalog';
        $show_per_page = 1000;
        $this->data['main'] = 'posts/index';
        $arr_result = $this->Post_model->getAllPosts($offset, $show_per_page);
        $this->data['post_list']  = $arr_result['results'];
        $config['base_url']      = admin_url('posts/index');
        $config['num_links']      = 2;
        $config['uri_segment']     = 4;
        $config['total_rows']     = $arr_result['total'];
        $config['per_page']      = $show_per_page;
        $config['full_tag_open'] = '<ul class="pagination pagination-sm">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open']  = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['first_link']      = 'First';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link']      = 'Last';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['prev_link']      = 'Prev';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_link']      = 'Next';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['cur_tag_open']     = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $this->pagination->initialize($config);
        $this->data['paginate']     =  $this->pagination->create_links();

        $this->load->view('default', $this->data);
    }


    public function pages()
    {
        $this->data['main'] = 'posts/page-index';
        $pages = $this->db->order_by('post_title', 'ASC')->where('post_type', 'page')->get('posts')->result();
        $this->data['post_list'] = $pages;
        $this->load->view(admin_view('default'), $this->data);
    }

    function edit_page($id)
    {
        $page = $this->db->get_where('posts', array('page_id' => $id))->row();
        if (is_object($page)) {
            redirect(admin_url('posts/add/' . $page->id));
        } else {
            $page = array();
            $page['post_title'] = "Untitled";
            $page['post_type'] = 'page';
            $page['page_id'] = $id;
            $page['status'] = 1;
            $this->db->insert('posts', $page);
            $id = $this->db->insert_id();
            redirect(admin_url('posts/add/' . $id));
        }
    }

    public function add($id = false)
    {
        $this->data['post_type'] = 'page';
        $this->data['main'] = admin_view('posts/add-page');
        $this->data['p'] = $this->Post_model->getNew();
        $layouts = $this->config->item('layouts');
        $this->data['layouts'] = $layouts['pages'];
        $this->data['parents'] = $this->Post_model->pagesDropdown();
        if ($id) {
            $this->data['p'] = $post = $this->Post_model->getRow($id);
            $this->data['page_data'] = get_custom_page($post->page_id);
        }

        $this->form_validation->set_rules('data[post_title]', 'Title', 'required');
        if ($this->form_validation->run()) {
            $save = $this->input->post('data');
            if ($this->input->post('del_img')) {
                $del_img = $this->input->post('hid_img');
                @unlink(upload_dir($del_img));
                $save['image'] = '';
            }

            if ($this->input->post('del_at')) {
                $del_img = $this->input->post('hid_at');
                @unlink(upload_dir($del_img));
                $save['attachment'] = '';
            }


            $save['id'] = $id;
            $save['post_type'] = 'page';

            $uploaded    = $this->upload->do_upload('image');
            if ($uploaded) {
                $image            = $this->upload->data();
                $save['image']    = $image['file_name'];
                $this->resize($image['full_path']);
            }

            $uploaded    = $this->upload->do_upload('attachment');
            if ($uploaded) {
                $image            = $this->upload->data();
                $save['attachment']    = $image['file_name'];
                $this->resize($image['full_path']);
            }


            $save['created']             = date('Y-m-d');
            $slug                         = $save['slug'];
            if (empty($slug) || $slug == '') {
                $slug = $save['post_title'];
            }
            if ($save['seo_title'] == '') {
                $save['seo_title'] = $save['post_title'];
            }
            $slug    = strtolower(url_title($slug));
            $save['slug']    = $this->Post_model->get_unique_url($slug, $id);
            if ($id > 0) {
                $page_data = get_custom_page($post->page_id);
                $save['slug'] = isset($page_data['slug']) ? $page_data['slug'] : $slug;
            }
            $id    = $this->Post_model->save($save);

            //Saving Meta Fields
            if ($this->input->post("meta")) {
                $meta = $this->input->post("meta");
                foreach ($meta as $key => $value) {
                    $sv = array();
                    $sv['page_id'] = $id;
                    $sv['meta_name'] = $key;
                    $sv['meta_value'] = $value;

                    $flag = $this->db->get_where('page_meta', array('page_id' => $id, 'meta_name' => $key))->row();
                    if (is_object($flag)) {
                        $this->db->update("page_meta", $sv, array("id" => $flag->id));
                    } else {
                        $this->db->insert("page_meta", $sv);
                    }
                }
            }


            $this->session->set_flashdata('success', 'Page saved successfully');
            redirect(admin_url('posts/add/' . $id));
        } else {
            $this->load->view(admin_view('default'), $this->data);
        }
    }

    public function add_post($id = false)
    {
        $this->data['active_tabs'] = 'catalog';
        $this->data['post_type'] = 'post';
        $this->data['main'] = admin_view('posts/add');
        $this->data['p'] = $this->Post_model->getNew();
        $layouts = $this->config->item('layouts');
        $this->data['layouts'] = $layouts['posts'];
        $this->data['cat'] = '';
        $this->data['parents'] = $this->Category_model->category_dropdown();
        $this->data['parents1'] = $this->Category_model->category_dropdown_main();
        if ($id) {
            $this->data['p'] = $this->Post_model->getRow($id);
            $this->data['t']  =   $this->Master_model->checkExist($id, 'ai_postcats');
        }
        $this->form_validation->set_rules('form[post_title]', 'Title', 'required');
        if ($this->form_validation->run()) {
            $save = $this->input->post('form');
            if ($this->input->post('del_img')) {
                $del_img = $this->input->post('hid_img');
                $this->delImages($del_img);
                $save['image'] = '';
            }
            $save['id'] = $id;
            $save['post_type'] = 'post';
            $save['featured'] = $this->input->post('featured') ? 1 : 0;
            $save['no_follow'] = $this->input->post('no_follow') ? 1 : 0;
            $save['gallery_id'] = 0; //intval($save['gallery_id']);



            $uploaded    = $this->upload->do_upload('image');
            if ($uploaded) {
                $image            = $this->upload->data();
                $save['image']    = $image['file_name'];
                $this->resize($image['full_path']);
            }

            if ($this->input->post('del_at')) {
                $del_img = $this->input->post('hid_at');
                @unlink(upload_dir($del_img));
                $save['attachment'] = '';
            }

            $uploaded    = $this->upload->do_upload('attachment');
            if ($uploaded) {
                $image            = $this->upload->data();
                $save['attachment']    = $image['file_name'];
                $this->resize($image['full_path']);
            }

            $slug                         = $save['slug'];
            if (empty($slug) || $slug == '') {
                $slug = $save['post_title'];
            }
            $slug    = strtolower(url_title($slug));
            $save['slug']    = $this->Post_model->get_unique_url($slug, $id);
            if ($id) {
                $save['updated'] = date('Y-m-d H:i:s');
            } else {
                $save['created'] = date('Y-m-d H:i:s');
            }
            $id    = $this->Post_model->save($save);
            $this->data['t']  =   $this->Master_model->checkExist($id, 'ai_postcats');
            $x = '';
            if ($this->data['t']['total'] > 0) {

                $this->Master_model->delete_category($id, 'ai_postcats');
                foreach ($this->input->post('category_id') as $row) {
                    $x .= (int)$row . ',';
                    $sav['category_id'] = (int)$row;
                    $sav['post_id'] = $id;
                    $this->db->insert('ai_postcats', $sav);
                }
                $this->data['cat'] = trim($x, ',');
            } else {
                foreach ($this->input->post('category_id') as $row) {
                    $sav['category_id'] = (int)$row;
                    $x .= (int)$row . ',';
                    $sav['post_id'] = $id;
                    $this->db->insert('ai_postcats', $sav);
                }
                $this->data['cat'] = trim($x, ',');
            }


            $this->session->set_flashdata('success', 'Post saved successfully');
            redirect(admin_url('posts/add-post/' . $id));
        } else {
            $this->load->view(admin_view('default'), $this->data);
        }
    }

    function activate($id = false)
    {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('posts');
        if ($id) {
            $c['id'] = $id;
            $c['status'] = 1;
            $this->Post_model->save($c);
            $this->session->set_flashdata("success", "Page published");
        }
        redirect($redirect);
    }

    function deactivate($id = false)
    {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('posts');
        if ($id) {
            $c['id'] = $id;
            $c['status'] = 0;
            $this->Post_model->save($c);
            $this->session->set_flashdata("success", "Posts saved to draft");
        }
        redirect($redirect);
    }

    function delete($id = false)
    {
        if ($id) {
            $p = $this->Post_model->getRow($id);
            $this->Post_model->delete($id);
            $this->session->set_flashdata("success", "Posts deleted successfully");
            if ($p->post_type == 'page') {
                redirect(admin_url('posts/pages'));
            }
        }
        redirect(admin_url('posts'));
    }




    function active($id = false)
    {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('posts/senior_post');
        if ($id) {
            $c['id'] = $id;
            $c['status'] = 1;
            $this->Master_model->save($c, 'senior_post');
            $this->session->set_flashdata("success", "Page published");
        }
        redirect($redirect);
    }

    function deactive($id = false)
    {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('posts/senior_post');
        if ($id) {
            $c['id'] = $id;
            $c['status'] = 0;
            $this->Master_model->save($c, 'senior_post');
            $this->session->set_flashdata("success", "Posts saved to draft");
        }
        redirect($redirect);
    }
    function deletep($id = false)
    {
        if ($id) {

            $this->Master_model->delete($id, 'senior_post');
            $this->session->set_flashdata("success", "Posts deleted successfully");

            redirect(admin_url('posts/senior_post'));
        }
        redirect(admin_url('posts'));
    }
}
