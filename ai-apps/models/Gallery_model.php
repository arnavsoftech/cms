<?php
class Gallery_model extends Master_model
{
    public function __construct()
    {
        parent::__construct();
        $this->table = 'gallery';
    }
    public function get_galleries()
    {
        $this->db->where('status', 1);
        $this->db->order_by('id', 'DESC');
        return $this->db->get('gallery')->result_array();
    }
    public function get_sub_galleries($limit = false)
    {
        // $this -> db -> where('status', 1);
        $this->db->limit($limit);
        $this->db->order_by('id', 'DESC');
        return $this->db->get('gallery_img')->result_array();
    }
    function  gallery_of_photo($gallery_id, $id)
    {
        $this->db->where('gallery_id', $gallery_id);
        $this->db->where('id', $id);
        return $this->db->get('gallery_img')->first_row('array');
    }
    public function get_galleries_admin()
    {
        $this->db->order_by('id', 'DESC');
        return $this->db->get('gallery')->result_array();
    }
    public function get_gallery($id)
    {
        return $this->db->get_where('gallery', "id = $id")->first_row('array');
    }
    public function gallery_slug($slug)
    {
        return $this->db->get_where('gallery', array('slug' => $slug))->first_row('array');
    }
    function position_photo($id, $gal_id)
    {
        $this->db->select('count(id) as total');
        $arr    = array('id <=' => $id, 'gallery_id' => $gal_id);
        return $this->db->get_where('gallery_img', $arr)->first_row('array');
    }
    public function get_images($gallery_id)
    {
        return $this->db->get_where('gallery_img', "gallery_id = $gallery_id")->result_array();
    }
    public function get_image($id)
    {
        return $this->db->get_where('gallery_img', "id = $id")->first_row('array');
    }
    function get_latest_cover_photo($gallery_id)
    {
        $this->db->select('image_alt,image,image_title,id,slug');
        $this->db->order_by('gallery_id	', 'desc');
        return $this->db->get_where('gallery_img', "gallery_id = $gallery_id")->first_row('array');
    }
    public function save_image($save)
    {
        if ($save['id']) {
            $this->db->where('id', $save['id']);
            $this->db->update('gallery_img', $save);
        } else {
            $this->db->insert('gallery_img', $save);
        }
    }
    function get_gallery_url($url, $id = false)
    {
        $this->db->select('slug, id');
        $this->db->where('slug', $url);
        $rest = $this->db->get('gallery');
        if ($rest->num_rows() == 0) {
            return $url;
        } else {
            $cr = $rest->first_row();
            if ($cr->id == $id) {
                return $url;
            } else {
                $url = $url . '1';
                return $this->get_gallery_url($url, $id);
            }
        }
    }
    function cover_image($gallery_id)
    {
        $this->db->select('cover_image');
        $row = $this->db->get_where('gallery', array('id' => $gallery_id))->first_row('array');
        if ($row) {
            $img_id = $row['cover_image'];
            $img_row = $this->get_image($img_id);
            return $img_row;
        } else {
            return false;
        }
    }
    function related_galleries($sports_id, $limit = false)
    {
        $this->db->where('sports_id', $sports_id);
        if ($limit) {
            $this->db->limit($limit);
        }
        $this->db->where('status', 1);
        $this->db->order_by('id', 'DESC');
        return $this->db->get('gallery')->result_array();
    }
    function count_images($gallery_id)
    {
        return $this->db->get_where('ai_images', "gallery_id = $gallery_id")->num_rows();
    }

    function nextPhotoLink($cur_id)
    {
        $sql = "SELECT id, gallery_id FROM ai_images WHERE gallery_id = (SELECT gallery_id FROM gallery_img WHERE id = '$cur_id')";
        $img_arr = $this->db->query($sql)->result_array();
        $nid = 0;
        if (is_array($img_arr) && count($img_arr) > 0) {
            foreach ($img_arr as $k => $pid) {
                if ($pid['id'] == $cur_id) {
                    $nid = $k + 1;
                }
            }
        }
        if (isset($img_arr[$nid]['id'])) {
            $nid = $img_arr[$nid]['id'];
        } else {
            //echo $img_arr[0]['gallery_id'] - 1;
            $nid = $this->prevGallery($img_arr[0]['gallery_id']);
        }
        return $this->photoLink($nid);
    }

    function nextGallery($cur_gallery_id)
    {
        $this->db->where('id >= ', $cur_gallery_id);
        $this->db->order_by('id', 'ASC');
        $allgals = $this->db->select('id')->where('status', 1)->get('gallery')->result_array();
        $nid = 0;
        if (is_array($allgals) && count($allgals) > 0) {
            foreach ($allgals as $k => $g) {
                if ($g['id'] == $cur_gallery_id) {
                    $nid = $k + 1;
                }
            }
        }
        if (isset($allgals[$nid])) {
            $nid = $allgals[$nid]['id'];
        } else {
            $nid = $allgals[0]['id'];
        }
        $row = $this->db->get_where('gallery_img', array('gallery_id' => $nid))->first_row();
        return $row->id;
    }
    function next_img_url($gallery_id, $img_id)
    {
        $this->db->where('id >= ', $img_id);
        $this->db->order_by('id', 'ASC');
        $condition  = array('gallery_id' => $gallery_id);
        $allgals = $this->db->select('id,slug,gallery_id')->where($condition)->get('gallery_img')->result_array();

        $nid = 0;

        if (is_array($allgals) && count($allgals) > 0) {
            foreach ($allgals as $k => $g) {
                if ($g['id'] == $img_id) {
                    $nid = $k + 1;
                }
            }
        }
        if (isset($allgals[$nid])) {
            $nid = $allgals[$nid]['id'];
        } else {
            $nid = $allgals[0]['id'];
        }
        $row = $this->db->get_where('gallery_img', array('id' => $nid, 'gallery_id' => $gallery_id))->first_row();
        $url = '';
        if ($row->id !== $img_id) {
            $slug  = ($row->slug == '') ? url_title($row->title) . '-' . $row->id . '.html' : $row->slug . '-' . $row->id . '.html';
            $url = '<a class="btn btn-sm btn-outline-secondary" href="' . site_url('gallery/' . $gallery_id . '/' . $slug) . '">Next</a>';
        }
        return $url;
    }
    function prev_img_url($gallery_id, $img_id)
    {
        $this->db->where('id <= ', $img_id);
        $this->db->order_by('id', 'ASC');
        $condition  = array('gallery_id' => $gallery_id);
        $allgals = $this->db->select('id,slug,gallery_id')->where($condition)->get('gallery_img')->result_array();
        $nid = 0;
        if (is_array($allgals) && count($allgals) > 0) {
            foreach ($allgals as $k => $g) {
                if ($g['id'] == $img_id) {
                    $nid = $k - 1;
                }
            }
        }
        if (isset($allgals[$nid])) {
            $nid = $allgals[$nid]['id'];
        } else {
            $nid = $allgals[count($allgals) - 1]['id'];
        }
        $url = '';
        $row = $this->db->get_where('gallery_img', array('id' => $nid, 'gallery_id' => $gallery_id))->first_row();
        if ($row->id !== $img_id) {
            $slug  = ($row->slug == '') ? url_title($row->title) . '-' . $row->id . '.html' : $row->slug . '-' . $row->id . '.html';
            $url = '<a class="btn btn-sm btn-outline-secondary" href="' . site_url('gallery/' . $gallery_id . '/' . $slug) . '">Prev</a>';
        }
        return $url;
    }


    function prevGallery($cur_gallery_id)
    {
        $this->db->where('id <= ', $cur_gallery_id);
        $this->db->order_by('id', 'ASC');
        $allgals = $this->db->select('id')->where('status', 1)->get('gallery')->result_array();
        $nid = 0;
        if (is_array($allgals) && count($allgals) > 0) {
            foreach ($allgals as $k => $g) {
                if ($g['id'] == $cur_gallery_id) {
                    $nid = $k - 1;
                }
            }
        }
        if (isset($allgals[$nid])) {
            $nid = $allgals[$nid]['id'];
        } else {
            $nid = $allgals[count($allgals) - 1]['id'];
        }

        $row = $this->db->get_where('gallery_img', array('gallery_id' => $nid))->first_row();
        return $row->id;
    }



    function photoLink($cur_id)
    {
        $im = $this->get_image($cur_id);
        $slug  = ($im['slug'] == '') ? url_title($im['title']) : $im['slug'];
        $url = site_url('gallery/' . $slug . '/' . $im['id']);
        return $url;
    }

    function prevPhotoLink($cur_id)
    {
        $sql = "SELECT id, gallery_id FROM gallery_img WHERE gallery_id = (SELECT gallery_id FROM gallery_img WHERE id = '$cur_id')";
        $img_arr = $this->db->query($sql)->result_array();
        $nid = 0;
        if (is_array($img_arr) && count($img_arr) > 0) {
            foreach ($img_arr as $k => $pid) {
                if ($pid['id'] == $cur_id) {
                    $nid = $k - 1;
                }
            }
        }
        if (isset($img_arr[$nid]['id'])) {
            $nid = $img_arr[$nid]['id'];
        } else {
            $nid = $this->prevGallery($img_arr[0]['gallery_id']);
        }
        return $this->photoLink($nid);
    }
}
