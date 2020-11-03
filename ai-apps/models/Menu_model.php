<?php class Menu_model extends Master_model
{
    function __construct()
    {
        parent::__construct();
        $this->table = 'ai_menu';
    }

    public function all_groups()
    {
        $data = array();
        $rest = $this->db->get('ai_menugroup');
        if ($rest->num_rows() > 0) {
            foreach ($rest->result_array() as $row) {
                $row['links'] = $this->get_links($row['id']);
                $data[] = $row;
            }
        }
        $rest->free_result();

        return $data;
    }

    public function get_links($group_id, $parent = 0)
    {
        $data = array();
        $this->db->order_by('sequence', 'ASC');
        $this->db->where('group_id', $group_id);
        $this->db->where('menu_parent', $parent);
        $rest = $this->db->get($this->table);
        if ($rest->num_rows() > 0) {
            foreach ($rest->result_array() as $row) {
                $tmenu = $this->get_menu($row['id']);
                $row['href'] = $tmenu['link_url'];
                $data[$row['id']] = $row;
                $data[$row['id']]['children'] = $this->get_links($group_id, $row['id']);
            }
        }
        $rest->free_result();

        return $data;
    }

    public function get_group($id)
    {
        return $this->db->get_where('ai_menugroup', "id = $id")->first_row('array');
    }

    function deleteGroup($id)
    {
        $this->db->where('group_id', $id);
        $this->db->delete($this->table);
        $this->db->flush_cache();
        $this->db->where('id', $id);
        $this->db->delete('ai_menugroup');
    }

    public function get_menu($id)
    {
        $data = $this->db->get_where($this->table, "id = '$id'")->first_row('array');
        $slug = $data['menu_url'];
        if ($data['link_type'] == 1) {
            $slug = $data['menu_url'];
        } else if ($data['link_type'] == 2) {
            $cat = new AI_Category($data['menu_url']);
            $slug = $cat->permalink();
        } else {
            $c = new AI_Post($data['menu_url']);
            $slug = $c->permalink();
        }
        $data['link_url'] = $slug;

        return $data;
    }

    public function groupadd($save)
    {
        if ($save['id']) {
            $this->db->where('id', $save['id']);
            $this->db->update('ai_menugroup', $save);

            return $save['id'];
        } else {
            $this->db->insert('ai_menugroup', $save);

            return $this->db->insert_id();
        }
    }

    function remove_link($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }

    function remove_link_url($link_type, $link_url)
    {
        $this->db->where('link_type', $link_type);
        $this->db->where('menu_url', $link_url);
        $this->db->delete($this->table);

        return true;
    }

    function simpleMenu($menu_id, $args = array(), $parent_id = 0, $level = 1)
    {
        $ul_class = isset($args['ul_class']) ? $args['ul_class'] : 'menu';
        $sep = isset($args['sep']) ? $args['sep'] : false;
        $this->db->where('group_id', $menu_id);
        $this->db->where('menu_parent', $parent_id);
        $this->db->order_by('sequence', 'ASC');
        $rest = $this->db->get($this->table);
        $data = $rest->result_array();
        $msg = '';
        if (count($data) > 0) {
            $msg .= '<ul class="' . $ul_class . '">' . "\r\n";
            foreach ($data as $d) {
                $m = $this->get_menu($d['id']);
                $url = $m['link_url'];

                $hasChild = $this->hasChildren($d['id']);
                if ($hasChild) {
                    $a_class = "";
                } else {
                    $a_class = "";
                }

                if ($m['use_heading'] == 1) {
                    $msg .= '<li><h6>' . $d['menu_title'] . '</h6>';
                } else {
                    if ($hasChild) {
                        $msg .= '<li class="dropdown">';
                        //$msg .= '<a  href="' . $url .'" class="'.$a_class.'" >'. $d['menu_title']. '</a>';
                        $msg .= '<a class="dropdown-toggle" data-toggle="dropdown" href="' . $url . '">' . $d['menu_title'] . '<span
                            class="caret"></span></a>';
                    } else {
                        $msg .= '<li><a href="' . $url . '">' . $d['menu_title'] . '</a>';
                    }
                }
                $args['ul_class'] = '';
                if ($level > 2) {
                    $args['ul_class'] = '';
                }
                $msg .= $this->simpleMenu($menu_id, $args, $m['id'], ++$level);
                $msg .= '</li>' . "\r\n";
            }
            $msg .= '</ul>' . "\r\n";
        }

        return $msg;
    }

    function hasChildren($parent_id)
    {
        $rest = $this->db->get_where("ai_menu", array("menu_parent" => $parent_id));
        return ($rest->num_rows() > 0);
    }

    function megaMenu($menu_id, $args = array(), $parent_id = 0, $level = 1)
    {
        $ul_class = isset($args['ul_class']) ? $args['ul_class'] : 'menu';
        $sep = isset($args['sep']) ? $args['sep'] : false;
        $this->db->where('group_id', $menu_id);
        $this->db->where('menu_parent', $parent_id);
        $this->db->order_by('sequence', 'ASC');
        $rest = $this->db->get($this->table);
        $data = $rest->result_array();
        $msg = '';
        if (count($data) > 0) {
            $msg .= '<ul class="' . $ul_class . '">' . "\r\n";
            foreach ($data as $d) {
                $m = $this->get_menu($d['id']);
                $url = $m['link_url'];
                if ($m['use_heading'] == 1) {
                    $msg .= '<li><h6>' . $d['menu_title'] . '</h6>';
                } else {
                    $msg .= '<li><a href="' . $url . '">' . $d['menu_title'] . '</a>';
                }
                if ($m['menu_parent'] == 0) {
                    $level = 1;
                }
                $args['ul_class'] = 'menu-' . $level;
                $msg .= $this->megaMenu($menu_id, $args, $m['id'], ++$level);
                $msg .= '</li>' . "\r\n";
            }
            $msg .= '</ul>' . "\r\n";
        }

        return $msg;
    }
}
