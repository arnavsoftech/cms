<?php class Post_model extends Master_model
{
    var $error, $status;
    var $lang_id;

    public function __construct()
    {
        parent::__construct();
        $this->table = 'ai_posts';
    }

    public function post($id)
    {
        $p = $this->db->get_where($this->table, array('id' => $id))->first_row('array');
        $p['category'] = $this->Category_model->category($p['parent_id']);

        return $p;
    }

    public function page($id)
    {
        $p = $this->db->get_where($this->table, array('id' => $id))->first_row();

        return $p;
    }

    function slugPost($slug)
    {
        $this->db->select('id');

        return $this->db->get_where($this->table, array('slug' => $slug))->first_row();
    }

    function getAllPosts($offset = 0, $show_per_page = 10)
    {
        $this->db->select('id');
        if ($show_per_page) {
            $this->db->limit($show_per_page, $offset);
        }
        $this->db->where('post_type', 'post');
        $this->db->order_by('id', 'DESC');
        $rest = $this->db->get($this->table);
        $data['results'] = $rest->result();
        $data['total'] = $this->db->select('id')->get_where($this->table, array('post_type' => 'post'))->num_rows();

        return $data;
    }
    function getAllPost($offset = 0, $show_per_page = 10)
    {
        $this->db->select();
        if ($show_per_page) {
            $this->db->limit($show_per_page, $offset);
        }
        // $this->db->where('post_type', 'post');
        $this->db->order_by('id', 'DESC');
        $rest = $this->db->get('senior_post');
        $data['results'] = $rest->result();
        $data['total'] = $this->db->get_where('senior_post')->num_rows();

        return $data;
    }

    function getAllPages($offset = 0, $show_per_page = 10)
    {
        $this->db->select('id');
        if ($show_per_page) {
            $this->db->limit($show_per_page, $offset);
        }
        $this->db->where('post_type', 'page');
        $this->db->order_by('post_title', 'ASC');
        $data['results'] = $this->db->get($this->table)->result();
        $data['total'] = $this->db->get_where($this->table, array('post_type' => 'page'))->num_rows();

        return $data;
    }

    public function get_page_dd()
    {
        $data = array(0 => 'Main Page');
        $this->db->where('post_type', 'page');
        $this->db->order_by('post_title', 'ASC');
        $rest = $this->db->get($this->table);
        if ($rest->num_rows() > 0) {
            foreach ($rest->result_array() as $row) {
                $data[$row['id']] = $row['post_title'];
            }
        }
        $rest->free_result();

        return $data;
    }

    public function get_post_dd()
    {
        $data = array(0 => 'Main Page');
        $this->db->where('post_type', 'post');
        $this->db->order_by('post_title', 'ASC');
        $rest = $this->db->get($this->table);
        if ($rest->num_rows() > 0) {
            foreach ($rest->result_array() as $row) {
                $data[$row['id']] = $row['post_title'];
            }
        }
        $rest->free_result();

        return $data;
    }

    function pagesDropdown()
    {
        $data = array(0 => 'Main Page');
        $this->db->select('id,post_title');
        $this->db->order_by('post_title', "ASC");
        $this->db->where('parent_id', 0);
        $this->db->where('post_type', 'page');
        $rest = $this->db->get_where($this->table);
        if ($rest->num_rows() > 0) {
            foreach ($rest->result() as $r) {
                $tname = ucwords(strtolower($r->post_title));
                $data[$r->id] = $tname;
                $data = $this->sub_child($r->id, $tname, $data);
            }
        }

        return $data;
    }

    function sub_child($parent_id, $name, $old_arr = array())
    {
        $this->db->select('id, post_title');
        $this->db->where('parent_id', $parent_id);
        $this->db->where('post_type', 'page');
        $this->db->order_by('post_title', 'ASC');
        $rest = $this->db->get($this->table);
        if ($rest->num_rows() > 0) {
            foreach ($rest->result() as $r) {
                $fname = $name . ' &#x021D2; ' . ucwords(strtolower($r->post_title));
                $old_arr[$r->id] = $fname;
                $old_arr = $this->sub_child($r->id, $fname, $old_arr);
            }
        }

        return $old_arr;
    }

    function featuredStories($limit = false, $cat = false)
    {
        $this->db->select("id");
        $this->db->order_by("created", "DESC");
        if ($limit) {
            $this->db->limit($limit);
        }
        if ($cat) {
            $this->db->where("parent_id", $cat);
        }
        $this->db->where("featured", 1);
        $this->db->where("status", 1);
        $rest = $this->db->get($this->table);

        return $rest->result();
    }

    function latestStories($parent_id = false, $limit = false, $offset = 0)
    {

        $this->db->select("id");
        $this->db->order_by("id", "DESC");
        if ($parent_id) {
            $this->db->where("parent_id", $parent_id);
        }
        $this->db->where("post_type", "post");
        $this->db->where("status", 1);
        $sql = $this->db->get_compiled_select($this->table, false);
        $this->db->limit($limit, $offset);
        $rest = $this->db->get();
        $data = new stdClass();
        $data->items = $rest->result();
        $data->length = $this->db->query($sql)->num_rows();

        return $data;
    }

    function related_post($post_id = false, $limit = false)
    {
        $this->db->select("category_id");
        $this->db->where('post_id', $post_id);
        $this->db->from('ai_postcats');
        $rest = $this->db->get();
        $data = new stdClass();
        $items = $rest->result();
        if (is_array($items)) {
            $x = $catid = '';
            foreach ($items as $row) {
                $x .= $row->category_id . ',';
            }
            if ($x != '') {
                $cat_id = trim($x, ',');
                $arr = explode(',', $cat_id);
                $this->db->select('distinct(post_id)');
                $this->db->from('ai_postcats');
                $this->db->where_in('category_id', $arr);
                $this->db->order_by('post_id', 'desc');
                $this->db->limit($limit);
                $zz = $this->db->get();
                $xx = new stdClass();
                $data->items = $zz->result();

                return $data;
            }
        }
    }

    function latest_cat_post($parent_id = false, $limit = false, $offset = 0)
    {
        $this->db->select('ai_posts.id');
        $this->db->from('ai_posts');
        $this->db->join('ai_postcats', 'ai_postcats.post_id=ai_posts.id');
        $this->db->where('ai_postcats.category_id', $parent_id);
        $this->db->where('ai_posts.status', 1);
        $this->db->where('ai_posts.post_type', 'post');
        $this->db->order_by('ai_posts.created', 'desc');
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        $data = new stdClass();
        $data->items = $query->result();

        return $data;
    }

    function senior_post($limit = false, $offset = 0)
    {
        $this->db->where('status', 1);
        $this->db->limit($limit, $offset);
        $query = $this->db->get('senior_post');
        $data = new stdClass();
        $data->items = $query->result();
        return $data;
    }
    function fetch_tag_post_list($parent_id = false, $limit = false, $offset = 0)
    {
        $this->db->select('ai_posts.id');
        $this->db->from('ai_posts');
        $this->db->like('tagging', $parent_id);
        $this->db->where('status', 1);
        $this->db->where('post_type', 'post');
        $this->db->order_by('created', 'desc');
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        $data = new stdClass();
        $data->items = $query->result();

        return $data;
    }

    function total_record($parent_id = false)
    {
        $this->db->select('count(*) as c');
        $this->db->from('ai_posts');
        $this->db->join('ai_postcats', 'ai_postcats.post_id=ai_posts.id');
        $this->db->where('ai_postcats.category_id', $parent_id);
        $this->db->where('ai_posts.status', 1);
        $this->db->where('ai_posts.post_type', 'post');
        $query = $this->db->get()->row();
        //$row = $query->num_rows();
        $row = $query->c;
        return $row;
    }
    function total_rec($parent_id = false)
    {

        $query = $this->db->get_where('senior_post', array('status' => 1));
        $row = $query->num_rows();

        return $row;
    }

    function total_tag_record($parent_id = false)
    {
        $this->db->select('ai_posts.id');
        $this->db->from('ai_posts');
        $this->db->like('tagging', $parent_id);
        $this->db->where('status', 1);
        $this->db->where('post_type', 'post');
        $this->db->order_by('created', 'desc');
        $query = $this->db->get();
        $row = $query->num_rows();

        return $row;
    }

    function mostPopular($parent_id = false, $limit = false, $offset = 0)
    {
        $this->db->select("id");
        $this->db->order_by("view_count", "DESC");
        $this->db->order_by("id", "DESC");
        if ($limit) {
            $this->db->limit($limit, $offset);
        }
        if ($parent_id) {
            $this->db->where("parent_id", $parent_id);
        }
        $this->db->where("post_type", "post");
        $this->db->where("status", 1);
        $rest = $this->db->get($this->table);

        return $rest->result();
    }

    function latestHomeStories($limit = false, $parent_id = false)
    {
        $this->db->select("id");
        $this->db->order_by("id", "DESC");
        if ($limit) {
            $this->db->limit($limit);
        }
        if ($parent_id) {
            $this->db->where("parent_id", $parent_id);
        }
        $this->db->where("featured", 0);
        $this->db->where("post_type", "post");
        $this->db->where("status", 1);
        $this->db->where("lang_id", $this->lang_id);
        $rest = $this->db->get($this->table);

        return $rest->result();
    }

    function latest_post($limit = false, $parent_id = false)
    {
        $this->db->select("id");
        $this->db->order_by("created", "DESC");
        if ($limit) {
            $this->db->limit($limit);
        }
        if ($parent_id) {
            $this->db->where("parent_id", $parent_id);
        }
        $this->db->where("featured", 0);
        $this->db->where("post_type", "post");
        $this->db->where("status", 1);
        $rest = $this->db->get($this->table);

        return $rest->result();
    }

    function categoryPosts($cat_id, $limit = 40, $offset = 0)
    {
        $this->db->where("category_id", $cat_id);
        $this->db->limit($limit, $offset);
        $this->db->order_by("post_id", "DESC");
        $rest = $this->db->get("ai_postcats");

        return $rest->result();
    }

    function latestPosts($limit = 40, $offset = 0)
    {
        $this->db->limit($limit, $offset);
        $this->db->order_by("post_id", "DESC");
        $rest = $this->db->get("ai_postcats");

        return $rest->result();
    }

    function count_category_post($cat_id = false)
    {
        $this->db->select('count("id")');
        $this->db->from('ai_posts');
        $this->db->join('ai_postcats', 'ai_postcats.post_id=ai_posts.id');
        $this->db->where('ai_postcats.category_id', $cat_id);
        $this->db->where('ai_posts.status', 1);
        $this->db->where('ai_posts.post_type', 'post');
        $data = $this->db->count_all_results();

        return $data;
    }


    function getCatId($newsId)
    {
        $r = $this->db->get_where("ai_postcats", array("post_id" => $newsId))->row();
        if (is_object($r)) {
            return $r->category_id;
        } else {
            return 1;
        }
    }

    public function getCustomPage($page_id)
    {
        $page = $this->db->get_where('posts', array('page_id' => $page_id))->row();
        if (is_object($page)) {
            $metas = $this->db->get_where('page_meta', array('page_id' => $page->id))->result();
            foreach ($metas as $m) {
                $key = $m->meta_name;
                $page->$key = $m->meta_value;
            }
            if ($page->image == '') {
                $page->image = theme_url('images/foot-bg.jpg');
            } else {
                $page->image = base_url(upload_dir($page->image));
            }
        }
        return $page;
    }
}
