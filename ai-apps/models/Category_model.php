<?php class Category_model extends Master_model {
    function __construct() {
        $this->table = 'ai_categories';
    }

    function get_categories_tierd($parent = 0) {
        $categories = array();
        $result = $this->categories($parent);
        foreach ($result as $category) {
            $categories[$category->id]['category'] = $category;
            $categories[$category->id]['children'] = $this->get_categories_tierd($category->id);
        }

        return $categories;
    }

    function categories($parent = 0) {
        return $this->db->get_where($this->table, array('parent_id' => $parent))->result();
    }

    function hasChildren($parent_id) {
        $c = $this->db->get_where($this->table, array('parent_id' => $parent_id))->num_rows();
        if ($c > 0) {
            return true;
        } else {
            return false;
        }
    }

    function category_dropdown() {
        $data = array(0 => 'Main Category');
        $this->db->select('id,name');
        $this->db->order_by('name', "ASC");
        $this->db->where('parent_id', 0);
        $rest = $this->db->get_where($this->table, array('status' => 1));
        if ($rest->num_rows() > 0) {
            foreach ($rest->result() as $r) {
                $tname = ucwords(strtolower($r->name));
                $data[$r->id] = $tname;
                $data = $this->sub_child($r->id, $tname, $data);
            }
        }

        return $data;
    }

    function category_dropdown_main() {
        $this->db->select('id,name,name_hn');
        $this->db->order_by('name', "ASC");
        $this->db->where('parent_id', 0);
        $rest = $this->db->get_where($this->table, array('status' => 1));
        if ($rest->num_rows() > 0) {
            foreach ($rest->result() as $r) {
                $tname = ucwords(strtolower($r->name_hn));
                $data[$r->id] = $tname;
                $data = $this->sub_child($r->id, $tname, $data);
            }
        }

        return $data;
    }

    function sub_child($parent_id, $name, $old_arr = array()) {
        $this->db->select('id, name, name_hn');
        $this->db->where('parent_id', $parent_id);
        $this->db->order_by('name', 'ASC');
        $rest = $this->db->get($this->table);
        if ($rest->num_rows() > 0) {
            foreach ($rest->result() as $r) {
                $fname = $name . ' &#x021D2; ' . ucwords(strtolower($r->name_hn));
                $old_arr[$r->id] = $fname;
                $old_arr = $this->sub_child($r->id, $fname, $old_arr);
            }
        }

        return $old_arr;
    }

    function getPosts($cat_id) {
        $this->db->select('id');
        $this->db->order_by('id', 'DESC');

        return $this->db->get_where('ai_posts', array('parent_id' => $cat_id, 'post_type' => 'post'))->result();
    }

    function All_post_categories($id) {
        $this->db->select('ai_categories.name,ai_categories.name_hn,ai_categories.id,ai_postcats.post_id');
        $this->db->from('ai_postcats');
        $this->db->join('ai_categories', 'ai_postcats.category_id = ai_categories.id');
        $this->db->where('ai_postcats.post_id', $id);
        $query = $this->db->get();

        return $query->result();
    }

    function latest_category($limit = false, $parent_id = false) {
        $this->db->select("id");
        $this->db->order_by("id", "DESC");
        if ($limit) {
            $this->db->limit($limit);
        }
        if ($parent_id) {
            $this->db->where("parent_id", $parent_id);
        }
        $this->db->where("status", 1);
        $rest = $this->db->get($this->table);

        return $rest->result();
    }


    function popular_category($limit = false) {
        $this->db->select("id,");
        $this->db->order_by("id", "DESC");
        if ($limit) {
            $this->db->limit($limit);
        }

        $this->db->where("status", 1);
        $this->db->where("popular_cat", 1);
        $rest = $this->db->get($this->table);

        return $rest->result();
    }

}