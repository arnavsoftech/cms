<?php

function admin_url($file = '', $redirect = false)
{
    $f = config_item('admin_folder');
    $url = site_url($f) . '/';
    if ($file <> '') {
        $url .= $file;
    }
    if ($redirect) {
        $cur = urlencode(current_url());
        $url .= '?redirect_to=' . $cur;
    }
    return $url;
}

function admin_view($view = '')
{
    $f = config_item('admin_view');
    return $f . '/' . $view;
}

function inr_rs($amt)
{
    return ' <i class="fa fa-inr"></i> ' . number_format($amt, 2);
}

function upload_dir($file = '')
{
    $f = config_item('upload_folder');
    return $f . '/' . $file;
}

function theme_url($file = '')
{
    $url = base_url('/ai-content/themes/' . $file);
    return $url;
}

function theme_option($optname)
{
    $CI = &get_instance();
    $v = $CI->Setting_model->get_option_value($optname);
    return $v;
}

function getCustomUrl($file = '')
{
    $url = site_url($file);
    if (preg_match('/^(.+)\.qissey.com$/', $_SERVER['HTTP_HOST'], $matches) && count($matches) == 2 && $matches[1] != 'www') {
        $url = str_replace('www', 'hindi', $url);
    }
    return $url;
}



function getFeedText($text)
{
    $chars = array('&nbsp;', '&ldquo;');
    $text = htmlentities(strip_tags($text, '<p>'));
    $text = htmlspecialchars($text);
    $text = str_replace($chars, '', $text);
    $text = preg_replace('#(<[a-z ]*)(style=("|\')(.*?)("|\'))([a-z ]*>)#', '\\1\\6', $text);
    return $text;
}

function get_custom_page($id)
{
    $ob  = array();
    $pages = config_item('pages');
    foreach ($pages as $page) {
        if ($page['id'] == $id) {
            if (!isset($page['layout'])) {
                $page['layout'] = 'page';
            }
            $ob = $page;
        }
    }
    return $ob;
}

function get_field($field, $page_id)
{
    $CI = &get_instance();
    $v = $CI->db->get_where("page_meta", array('page_id' => $page_id, 'meta_name' => $field))->row();
    if (is_object($v)) {
        return $v->meta_value;
    }
    return null;
}
