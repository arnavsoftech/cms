<?php
$config['admin_folder'] = 'admin'; //Admin Controller Folder name
$config['admin_view'] = ''; //Admin View Files Folder name
$config['upload_folder'] = 'ai-content/uploads';
$config['themes'] = 'diler';

if (!defined('ENG')) {
    define('ENG', 1);
}
if (!defined('HIN')) {
    define('HIN', 2);
}

$config['img_sizes'] = array(
    'md' => array(600, 450),
    'sm' => array(400, 300),
    'xs' => array(100, 75)
);

$config['menus'] = array(
    array('primary-menu', 'Primary Menu'),
    array('footer-menu', 'Footer Menu')
);

$config['layouts'] = array(
    'pages' => array(
        'page' => 'Page Default'
    ),
    'posts' => array(
        'single' => 'Post Default'
    ),
    'categories' => array(
        'category' => 'Category  Default'
    )
);

$config['pages'] = array(
    array(
        "id" => 1,
        'slug' => 'home',
        "name" => "Home Page",
        "layout" => "index",
        'fields' => array(
            array(
                'label' => 'Heading 1',
                'type' => 'text',
                'field' => 'box1'
            ),
            array(
                'label' => 'Below Text 1',
                'type' => 'text',
                'field' => 'box1_1'
            ),
            array(
                'label' => 'Heading 2',
                'type' => 'text',
                'field' => 'box2'
            ),
            array(
                'label' => 'Below Text 2',
                'type' => 'text',
                'field' => 'box2_1'
            ),
            array(
                'label' => 'Heading 3',
                'type' => 'text',
                'field' => 'box3'
            ),
            array(
                'label' => 'Below Text 3',
                'type' => 'text',
                'field' => 'box3_1'
            ),
            array(
                'label' => 'Bottom Heading',
                'type' => 'text',
                'field' => 'bheading'
            ),
            array(
                'label' => 'Bottom excerpt',
                'type' => 'text',
                'field' => 'bexcerpt'
            ),
            array(
                'label' => 'Qty number 1',
                'type' => 'text',
                'field' => 'qtyno1'
            ),
            array(
                'label' => 'Qty Text 1',
                'type' => 'text',
                'field' => 'qtytxt1'
            ),
            array(
                'label' => 'Help Details',
                'type' => 'editor',
                'field' => 'help_details'
            ),
        )
    ),
    array(
        "id" => 2,
        'slug' => 'general-information',
        "name" => "General Information",
        'layout' => 'about'
    ),
    array(
        "id" => 3,
        'slug' => 'letter',
        "name" => "Letter from Red Santa",
        'layout' => 'letter'
    ),
    array(
        "id" => 4,
        "name" => "Leadership",
        'slug' => 'leadership',
        'layout' => 'leadership',
        'fields' => array(
            array(
                'label' => 'Leadership Heading',
                'type' => 'text',
                'field' => 'head'
            ),
            array(
                'label' => 'Leadership Sub-heading',
                'type' => 'textarea',
                'field' => 'subhead'
            ),
            array(
                'label' => 'Leadership Below Photos',
                'type' => 'textarea',
                'field' => 'photos'
            ),
        )
    ),
    array(
        "id" => 5,
        "name" => "History",
        'slug' => 'history',
        'layout' => 'history'
    ),
    array(
        "id" => 6,
        "name" => "Foundation Facesheet",
        'slug' => 'foundation-factsheet',
        'layout' => 'foundation',
        'fields' => array(
            array(
                'label' => 'Foundation Facts',
                'type' => 'textarea',
                'field' => 'factsheet'
            ),
        )
    ),
    array(
        "id" => 7,
        'slug' => 'financial-audit',
        "name" => "Financial Audit",
        'layout' => 'audit'
    ),
    array(
        "id" => 8,
        "name" => "Contact us",
        'slug' => 'contact-us',
        'layout' => 'contact-us'
    ),
    array(
        "id" => 9,
        "name" => "Regional Offices",
        'slug' => 'regional-offices',
        'layout' => 'offices'
    ),
    array(
        "id" => 10,
        "name" => "What we Do",
        'slug' => 'what-we-do'
    ),
    array(
        "id" => 11,
        "name" => "Community Support",
        'layout' => 'emergency-response',
        'slug' => 'community-support',
        'fields' => array(
            array(
                'label' => 'Heading',
                'type' => 'text',
                'field' => 'heading'
            ),
            array(
                'label' => 'Vision Image',
                'type' => 'text',
                'field' => 'vision_url'
            ),
            array(
                'label' => 'Vision Block',
                'type' => 'editor',
                'field' => 'vision'
            ),
            array(
                'label' => 'Misson Image',
                'type' => 'text',
                'field' => 'mission_url'
            ),
            array(
                'label' => 'Mission Block',
                'type' => 'editor',
                'field' => 'mission'
            ),
        )
    ),
    array(
        "id" => 12,
        "name" => "Donation",
        'layout' => 'donate',
        'slug' => 'donation'
    ),
    array(
        "id" => 13,
        "name" => "Services",
        'slug' => 'services'
    ),
    array(
        "id" => 14,
        "name" => "Media",
        'slug' => 'media'
    ),
    array(
        "id" => 15,
        "name" => "Child Education",
        'slug' => 'child-education'
    ),
    array(
        "id" => 16,
        "name" => "How we do",
        'slug' => 'how-we-do',
        'fields' => array(
            array(
                'label' => 'Youtube Code',
                'type' => 'text',
                'field' => 'youtube'
            )
        )
    ),
    array(
        "id" => 17,
        "name" => "News",
        'slug' => 'news',
        'layout' => 'page'
    ),
    array(
        "id" => 18,
        "name" => "Career",
        'slug' => 'career',
        'layout' => 'page'
    ),
    array(
        "id" => 19,
        "name" => "Where we work",
        'slug' => 'where-we-work',
        'layout' => 'where-we-work'
    ),
    array(
        'id' => 20,
        'name' => 'Letter of Gratitude',
        'slug' => 'letter-of-gratitude',
        'layout' => 'gratitude',
    ),
    array(
        'id' => 21,
        'name' => 'Apply for Scholarship',
        'slug' => 'help-submission',
        'layout' => 'help-form'
    ),
    array(
        'id' => 22,
        'name' => 'Foundation Cares',
        'slug' => 'foundation-cares'
    ),
    array(
        'id' => 23,
        'name' => 'Resources for Volunteering',
        'slug' => 'resources'
    ),
    array(
        'id' => 24,
        'name' => 'How we make grants',
        'slug' => 'make-grants'
    ),
    array(
        'id' => 25,
        'name' => 'Information Sharing Approach',
        'slug' => 'information-sharing'
    ),
    array(
        'id' => 26,
        'name' => 'Global Access Policy',
        'slug' => 'global-access-policy'
    ),
    array(
        'id' => 27,
        'name' => 'Evaluation Policy',
        'slug' => 'evaluation-policy'
    ),
    array(
        'id' => 28,
        'name' => 'How we work',
        'slug' => 'how-we-work'
    ),
    array(
        'id' => 29,
        'name' => 'Privacy Policy',
        'slug' => 'privacy-policy'
    ),
    array(
        'id' => 30,
        'name' => 'Causes',
        'slug' => 'causes'
    ),
    array(
        'id' => 31,
        'name' => 'Testimonials',
        'slug' => 'testimonials',
        'layout' => 'testimonials'
    ),
    array(
        'id' => 32,
        'name' => 'Volunteer',
        'slug' => 'volunteer'
    ),
);
