<?php class AI_Post
{
    var $id;
    var $row;
    var $status;
    var $image_src;

    function __construct($id)
    {
        $this->id = $id;
        $CI = &get_instance();
        $row = $CI->Post_model->getRowArray($id);
        $this->status = $row['status'];
        $this->image_src = $row['image'];
        $this->row = $row;
    }

    function __get($key)
    {
        if (isset($this->row[$key])) {
            return $this->row[$key];
        } else {
            return FALSE;
        }
    }
    function getImages()
    {
        $file = $this->row['image'];
        $default_image = 'default.gif';
        if ($file == '') {
            $file = theme_url('img/' . $default_image);
            return $file;
        } else {
            if (!file_exists(upload_dir($file))) {
                return theme_url('img/' . $default_image);
            } else {
                return base_url(upload_dir($file));
            }
        }
    }
    function __set($key, $val)
    {
        $this->row[$key] = $val;
    }

    function ID()
    {
        return $this->id;
    }

    function title()
    {
        return $this->row['post_title'];
    }

    function data($key)
    {
        if (isset($this->row[$key])) {
            return $this->row[$key];
        } else {
            return NULL;
        }
    }

    function hasImage()
    {
        if (isset($this->row['image'])) {
            return true;
        } else {
            return false;
        }
    }

    function description()
    {
        return $this->row['description'];
    }

    function parentName()
    {
        $parent_id = $this->row['parent_id'];
        if ($parent_id == 0) {
            return "TOP";
        }
        $CI = &get_instance();
        if ($this->isPost()) {
            $c = $CI->Category_model->getRow($parent_id);

            return $c->name;
        } else {
            if ($parent_id > 0) {
                $p = $CI->Post_model->getRow($parent_id);

                return $p->post_title;
            } else {
                return 'Top Level Page';
            }
        }
    }

    function parentLink()
    {
        $parent_id = $this->row['parent_id'];
        if ($parent_id == 0) {
            $link = site_url();
        } else {
            $c = new AI_Category($parent_id);
            $link = $c->permalink();
        }

        return $link;
    }

    function get_tag_url()
    {
        $url = '';
        $tags = $this->row['tagging'];
        if (isset($tags)) {
            $arr = explode(',', $tags);
            if (count($arr) > 0) {
                foreach ($arr as $t) {
                    if ($t != '') {
                        $url .= '<a class="btn btn-sm btn-xs btn-dark" title="' . $t . '" href="' . site_url('tag') . '/' . strtolower(url_title($t)) . '">#' . $t . '</a>, ';
                    }
                }
                $url = rtrim($url, ', ');
            }

            return $url;
        } else {
            return $url;
        }
    }

    function post_parentLink()
    {
        $link = site_url();

        return $link;
    }

    function isPost()
    {
        if ($this->row['post_type'] == 'post') {
            return true;
        } else {
            return false;
        }
    }

    function isPage()
    {
        if ($this->isPost()) {
            return false;
        } else {
            return true;
        }
    }

    function excerpt()
    {
        if ($this->data('excerpt') <> '') {
            return $this->data('excerpt');
        } else {
            $text = $this->description();
            $text = strip_tags($text);
            $text = word_limiter($text, 40);

            return $text;
        }
    }

    function metaTitle()
    {
        $title = $this->data('meta_title');
        if ($title == '') {
            $title = $this->title();
        }

        return $title;
    }

    function metaDescription()
    {
        $desc = $this->data('meta_description');
        if ($desc == '') {
            $desc = $this->excerpt();
        }

        return $desc;
    }

    function metaKeywords()
    {
        return $this->data('meta_keywords');
    }

    function status()
    {
        return $this->data('status');
    }

    function no_follow()
    {
        $rel_no = '';
        $rel    = $this->data('no_follow');
        if ($rel == 1) {
            $nofollow  = 'rel="nofollow"';
            return $nofollow;
        } else {
            $rel_no;
        }
    }

    function post_type()
    {
        return $this->data('post_type');
    }

    function permalink()
    {
        if ($this->isPage()) {
            $parent = $this->data('parent_id');
            if ($parent == 0) {
                $link = site_url('pages/' . $this->data('slug'));
            } else {
                $t = new AI_Post($parent);
                $link = $t->permalink() . '/' . $this->data('slug');
            }
        } else {
            $link = site_url('posts/' . $this->data('slug') . '/' . $this->ID());
        }

        return $link;
    }

    function post_permalink()
    {
        $link = $this->data('slug') . '-' . $this->ID() . '.html';;

        return $link;
    }

    function created_date()
    {
        return date('M j , Y', strtotime($this->data('created')));
    }

    function image($size = 'sm', $options = array())
    {
        if ($this->isGallery()) {
            $g = $this->getGallery();
            $img = $g->getDefault();
            $str = '<img src="' . base_url(upload_dir($img['image'])) . '" alt="' . $img['image_alt'] . '" title = "' . $img['image_title'] . '" ' . $this->__arr_to_str($options) . ' onError="' . theme_url("img/default.gif") . '" />';

            return $str;
        } else {
            $fname = $this->getImgSizeName($size);
            $str = '<img src="' . base_url(upload_dir($fname)) . '" alt="' . $this->title() . '" title = "' . $this->title() . '" ' . $this->__arr_to_str($options) . ' onError="this.src=\'' . theme_url("img/default.gif") . '\'" />';

            return $str;
        }
    }

    function getImgUrl()
    {
        return base_url(upload_dir($this->image_src));
    }

    private function getImgSizeName($size = false)
    {
        $file = $this->row['image'];
        $default_image = 'default.jpg';
        if ($file == '') {
            $file = $default_image;
        }
        $file = basename($file);
        $filearr = explode('.', $file);
        $file_p = $filearr[0];
        $file_a = $filearr[1];
        if ($size) {
            $fname = $file_p . '-' . $size . '.' . $file_a;
            if (!file_exists(upload_dir($fname))) {
                $fname = $default_image;
            }
        } else {
            $fname = $this->row['image'];
        }

        return $fname;
    }

    private function __arr_to_str($arr)
    {
        $str = '';
        foreach ($arr as $key => $value) {
            $str .= $key . '="' . $value . '" ';
        }

        return $str;
    }

    public static function create($id)
    {
        $p = new AI_Post($id);

        return $p;
    }

    function views()
    {
        return 5000 + intval($this->view_count);
    }

    public function  updateCount()
    {
        $CI = &get_instance();
        $sql = "UPDATE ai_posts SET view_count = view_count + 1 WHERE id = '" . $this->ID() . "'";
        $CI->db->query($sql);
    }

    public function author($link = true)
    {
        $CI = &get_instance();
        $sql = "SELECT * FROM ai_users WHERE id = '" . $this->row['user_id'] . "' LIMIT 1";
        $u = $CI->db->query($sql)->row();
        $name = $u->first_name . ' ' . $u->last_name;
        if ($link) {
            $name = '<a href="' . site_url('authors/' . url_title($name)) . '">' . $name . '</a>';
        }

        return $name;
    }

    function isGallery()
    {
        $gid = $this->row['gallery_id'];
        if ($gid > 0) {
            return true;
        } else {
            return false;
        }
    }

    function getGallery()
    {
        if ($this->isGallery()) {
            $gid = $this->row['gallery_id'];
            $g = new AI_Gallery();
            $g->init($gid);

            return $g;
        } else {
            return array();
        }
    }
}

class AI_Gallery
{
    var $ID;
    var $row;
    var $index;
    var $gallery;
    var $images;

    function __construct()
    {
        $CI = &get_instance();
        $CI->load->model("Gallery_model");
        $this->index = 1;
    }

    function init($id)
    {
        $this->ID = $id;
        $CI = &get_instance();
        $this->gallery = $CI->Gallery_model->getRow($id);
        $this->images = $CI->Gallery_model->get_images($id);
    }

    function getImages()
    {
        return $this->images;
    }

    function getImage()
    {
        $imgar = $this->getImages();

        return $imgar[$this->index];
    }

    function setIndex($index)
    {
        $this->index = $index - 1;
    }

    function getDefault()
    {
        $img_index = 1;
        $cover_image_id = $this->gallery->cover_image;
        if ($cover_image_id != 0) {
            $imgarr = $this->getImages();
            foreach ($imgarr as $ind => $imr) {
                if ($imr['id'] == $cover_image_id) {
                    $img_index = $ind + 1;
                }
            }
        }
        $this->setIndex($img_index);

        return $this->getImage();
    }
}

class AI_Article
{
    protected $_id;
    protected $_row;
    private $_table;
    protected $db;
    protected $lang_id;


    function __construct($id)
    {
        $this->_id = $id;
        $this->_table = 'ai_posts';
        $this->db = DB();
        $sql = "SELECT * FROM ai_posts WHERE id = $id LIMIT 1";
        $rest = $this->db->query($sql);
        $this->_row = $rest->first_row('array');
    }
    function ID()
    {
        return $this->_id;
    }

    function contentHtmlWithAds($show_ads = true)
    {
        $html = $this->content();
        $str = $this->first_para($html);
        $add_str = '';

        if ($show_ads) {
            $ads = new Ads_model();
            $ads_str = $ads->pageAds('inside_article', TRUE);
            $ads_str    = $ads_str['code'] != '' ? $ads_str['code'] : '<img class="img-responsive" src="' . site_url('ai-content/uploads/' . $ads_str['banner_image']) . '">';
            $ad_div = '<div class="">' . $ads_str . '</div>';
            $replace_string = $str . $add_str;
            $html = str_replace($str, $replace_string, $html);
        }
        $html_arr = explode('<p>', $html);



        $newhtml_arr = array();
        foreach ($html_arr as $text) {
            if (trim($text) <> '') {
                $newhtml_arr[] = $text;
            }
        }

        if (isset($newhtml_arr[3])) {
            // $newhtml_arr[3] .= $ad_div;
        }
        if (isset($newhtml_arr[2])) {
            $newhtml_arr[2] .= $this->addMoreArticlesLinks(-10);
        }
        if (isset($newhtml_arr[0])) {
            $newhtml_arr[0] .= $this->addMoreArticlesLinks(2);
        }

        $html = implode('<p>', $newhtml_arr);
        return $html;
    }
    function title()
    {
        return $this->_row['post_title'];
    }

    function permalink()
    {

        $link = site_url() . $this->_row['slug'] . '-' . $this->ID() . '.html';;
        return $link;
    }

    function addMoreArticlesLinks($position)
    {
        $id = $this->ID();
        $n1id = $id + $position;
        $id = $this->nextSimilarArticle($n1id);
        if ($id != '') {
            $n = new AI_Article($id);
            if (($n <> NULL) && ($n->title() <> '')) {
                $str = '<p><a href="' . $n->permalink() . '"><b>ये भी पढ़े: </b>' . $n->title() . '</a></p>';
                return $str;
            } else {
                return NULL;
            }
        }
    }

    function nextSimilarArticle($id)
    {
        $sql = "SELECT id FROM ai_posts WHERE id > $id and post_type='post' ORDER BY id ASC LIMIT 1";
        $row = $this->db->query($sql)->first_row('array');

        if (is_array($row) && count($row) > 0) {
            return $row['id'];
        } else {
            return false;
        }
    }

    function content()
    {
        $this->applyExternalLinks();
        return $this->_row['description'];
    }

    function applyExternalLinks()
    {
        $text = $this->_row['description'];
        $sql = "SELECT * FROM ai_interlink";
        $rest = $this->db->query($sql)->result_array();

        if (is_array($rest) && count($rest) > 0) {
            foreach ($rest as $r) {
                $link = '<a class="inner-links" href="' . $r['url'] . '" target="_blank">' . $r['title'] . '</a>';
                $from = '/' . preg_quote($r['title'], '/') . '/';
                $text = preg_replace($from, $link, $text, 1);
            }
        }

        $this->_row['description'] = $text;

        //return $this;
        return $this->_row['description'];
    }

    function first_para($string)
    {

        $string = substr($string, 0, strpos($string, "</p>") + 4);
        return $string;
    }
}
