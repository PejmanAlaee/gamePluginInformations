<?php

/*
Plugin Name: setInformations
Plugin URI: www.pejmanAlaee.ir/
Description: .
Author: pejman
Author URI: /
Text Domain: wordpress-auth
Domain Path: /languages/
Version: 5.6.1
*/

define('WF_data_DIR', plugin_dir_path(__FILE__));
define('WF_data_URL', plugin_dir_url(__FILE__));
define('WF_data_INC', WF_data_DIR . '/inc/');
define('WF_data_tpl', WF_data_DIR . '/tpl/');
define('HMIC_NO_ICON_URL', plugin_dir_url(__FILE__) . 'assets/image/no-icon.png');





register_activation_hook(__File__, "myPluginIns");

function myPluginIns()
{
    register_uninstall_hook(__FILE__, "MY_PLUGIN_UNINSTALL");
}

function MY_PLUGIN_UNINSTALL()
{
}




add_action('wp_head', function () {
    ?>

<?php
    
    //echo PHP_EOL . print_r(get_post_types()) . PHP_EOL;
    //  global $wp_query;
    // print_r($wp_query);
    //print_r(get_taxonomies());
}, 9999);

add_action('init', function () {

    $args = array(
        'show_ui'   => true,
        'public'    => true,
        //        'show_in_nav_menus' => false,
        //        'show_in_menu' => false,
        //'description'   => 'digital download ebook file...',
        'labels'    => array(
            'name'              => 'بازی ها',
            'singular_name'     => 'بازی',
            'name_admin_bar'    => 'بازی جدید',
            'add_new'           => 'بازی جدید',
            'not_found'         => 'بازی یافت نشد',
            'search'            => 'جستجوی بازی',
            'add_new_item'      => 'افزودن بازی جدید',
            'featured_image'    => 'کاور بازی',
            'set_featured_image' => 'مشخص کردن جلد بازی',
            'remove_featured_image' => 'حذف جلد بازی',
            'use_featured_image'    => 'استفاده از کاور',
            //'view_item'         => 'نمایش ژانر'
            'edit_item' => 'ویرایش بازی'

        ),
        //'show_in_admin_bar' => false,
        'menu_position'     => 5,
        //خارج شدن از قسمت جست و جو
        //        'exclude_from_search'   => true,
        //سلسله مراتب (انتخاب برگه مادر )
        'hierarchical'      => true,
        'query_var'     => 'hmgame',
        //
        'taxonomies'    => array(),
        'supports' => array('thumbnail', 'title', 'comments', 'editor', 'page-attributes'),
        'menu_icon' => plugin_dir_url(__FILE__) . 'images/random_message_icon.png',
        'register_meta_box_cb' => 'hm_add_metabox',

        'rewrite' => array(
            'slug' => 'game'
        ),
        //'capability_type' => array( 'book', 'books' )

    );

    register_post_type('book', $args);
}, 999);

function hm_add_metabox($post)
{
    add_meta_box('test', 'discription', function ($post) {

        $w = $post;

        include WF_data_INC . "front/formDiscription.php";
    });
}
add_action('save_post', 'save_data_info');
add_action('edit_post', 'save_data_info');

function save_data_info($post_id)
{

    if (!isset($_POST['discriptionInput'])) return;
    global $wpdb;
    update_post_meta($post_id, '_hmci_discription', sanitize_text_field($_POST['discriptionInput']));
}




add_action('init', 'hmpt_register_taxonomy');
function hmpt_register_taxonomy()
{

    $args = array(
        'show_ui'   => true,
        'labels'    => array(
            'name'                       => 'genre',
            'singular_name'              => 'genre',
            'search_items'               => __('Search Writers'),
            'popular_items'              => __('Popular Writers'),
            'all_items'                  => __('All Writers'),
            'parent_item'                => null,
            'parent_item_colon'          => null,
            'edit_item'                  => 'genre',
            'update_item'                => __('Update Writer'),
            'add_new_item'               => 'افزودن genre جدید',
            'new_item_name'              => __('New Writer Name'),
            'separate_items_with_commas' => __('Separate writers with commas'),
            'add_or_remove_items'        => __('Add or remove writers'),
            'choose_from_most_used'      => 'از genre هایی که بیشتر استفاده شده',
            'not_found'                  => __('No writers found.'),
            'menu_name'                  => 'genres',
        ),
        'show_in_nav_menus' => false,
        'show_admin_column' => true,
        //        'hierarchical'      => true,
        //ساخت متاباکس اختصاصی
        'meta_box_cb'       => 'hmps_taxonomy_metabox2'
    );

    register_taxonomy('game_genre', array('book'), $args);
}


add_action('init', 'hmpt_register_taxonomy2');
function hmpt_register_taxonomy2()
{

    $args = array(
        'show_ui'   => true,
        'labels'    => array(
            'name'                       => 'p2e',
            'singular_name'              => 'p2e',
            'search_items'               => __('Search Writers'),
            'popular_items'              => __('Popular Writers'),
            'all_items'                  => __('All Writers'),
            'parent_item'                => null,
            'parent_item_colon'          => null,
            'edit_item'                  => 'ویرایش p2e',
            'update_item'                => __('Update Writer'),
            'add_new_item'               => 'افزودن p2e جدید',
            'new_item_name'              => __('New Writer Name'),
            'separate_items_with_commas' => __('Separate writers with commas'),
            'add_or_remove_items'        => __('Add or remove writers'),
            'choose_from_most_used'      => 'از p2e هایی که بیشتر استفاده شده',
            'not_found'                  => __('No writers found.'),
            'menu_name'                  => 'p2e',
        ),
        'show_in_nav_menus' => false,
        'show_admin_column' => true,
        //        'hierarchical'      => true,
        //ساخت متاباکس اختصاصی
        'meta_box_cb'       => 'hmps_taxonomy_metabox'
    );

    register_taxonomy('game_p2e', array('book'), $args);
}



add_action('init', 'hmpt_register_taxonomy3');
function hmpt_register_taxonomy3()
{

    $args = array(
        'show_ui'   => true,
        'labels'    => array(
            'name'                       => 'NFT',
            'singular_name'              => 'NFT',
            'search_items'               => __('Search Writers'),
            'popular_items'              => __('Popular Writers'),
            'all_items'                  => __('All Writers'),
            'parent_item'                => null,
            'parent_item_colon'          => null,
            'edit_item'                  => 'ویرایش NFT',
            'update_item'                => __('Update Writer'),
            'add_new_item'               => 'افزودن NFT جدید',
            'new_item_name'              => __('New Writer Name'),
            'separate_items_with_commas' => __('Separate writers with commas'),
            'add_or_remove_items'        => __('Add or remove writers'),
            'choose_from_most_used'      => 'از NFT هایی که بیشتر استفاده شده',
            'not_found'                  => __('No writers found.'),
            'menu_name'                  => 'NFT',
        ),
        'show_in_nav_menus' => false,
        'show_admin_column' => true,
        //        'hierarchical'      => true,
        //ساخت متاباکس اختصاصی
        'meta_box_cb'       => 'hmps_taxonomy_metabox'
    );

    register_taxonomy('game_NFT', array('book'), $args);
}



add_action('init', 'hmpt_register_taxonomy4');
function hmpt_register_taxonomy4()
{

    $args = array(
        'show_ui'   => true,
        'labels'    => array(
            'name'                       => 'F2P',
            'singular_name'              => 'F2P',
            'search_items'               => __('Search Writers'),
            'popular_items'              => __('Popular Writers'),
            'all_items'                  => __('All Writers'),
            'parent_item'                => null,
            'parent_item_colon'          => null,
            'edit_item'                  => 'ویرایش F2P',
            'update_item'                => __('Update Writer'),
            'add_new_item'               => 'افزودن F2P جدید',
            'new_item_name'              => __('New Writer Name'),
            'separate_items_with_commas' => __('Separate writers with commas'),
            'add_or_remove_items'        => __('Add or remove writers'),
            'choose_from_most_used'      => 'از F2P هایی که بیشتر استفاده شده',
            'not_found'                  => __('No writers found.'),
            'menu_name'                  => 'F2P',
        ),
        'show_in_nav_menus' => false,
        'show_admin_column' => true,
        //        'hierarchical'      => true,
        //ساخت متاباکس اختصاصی
        'meta_box_cb'       => 'hmps_taxonomy_metabox'
    );

    register_taxonomy('game_F2P', array('book'), $args);
}


add_action('init', 'hmpt_register_taxonomy5');
function hmpt_register_taxonomy5()
{

    $args = array(
        'show_ui'   => true,
        'labels'    => array(
            'name'                       => 'device',
            'singular_name'              => 'device',
            'search_items'               => __('Search Writers'),
            'popular_items'              => __('Popular Writers'),
            'all_items'                  => __('All Writers'),
            'parent_item'                => null,
            'parent_item_colon'          => null,
            'edit_item'                  => 'ویرایش device',
            'update_item'                => __('Update Writer'),
            'add_new_item'               => 'افزودن device جدید',
            'new_item_name'              => __('New Writer Name'),
            'separate_items_with_commas' => __('Separate writers with commas'),
            'add_or_remove_items'        => __('Add or remove writers'),
            'choose_from_most_used'      => 'از device هایی که بیشتر استفاده شده',
            'not_found'                  => __('No writers found.'),
            'menu_name'                  => 'device',
        ),
        'show_in_nav_menus' => false,
        'show_admin_column' => true,
        //        'hierarchical'      => true,
        //ساخت متاباکس اختصاصی
        'meta_box_cb'       => 'hmps_taxonomy_metabox2'
    );

    register_taxonomy('game_device', array('book'), $args);
}



add_action('init', 'hmpt_register_taxonomy6');
function hmpt_register_taxonomy6()
{

    $args = array(
        'show_ui'   => true,
        'labels'    => array(
            'name'                       => 'blockChain',
            'singular_name'              => 'blockChain',
            'search_items'               => __('Search Writers'),
            'popular_items'              => __('Popular Writers'),
            'all_items'                  => __('All Writers'),
            'parent_item'                => null,
            'parent_item_colon'          => null,
            'edit_item'                  => 'ویرایش blockChain',
            'update_item'                => __('Update Writer'),
            'add_new_item'               => 'افزودن blockChain جدید',
            'new_item_name'              => __('New Writer Name'),
            'separate_items_with_commas' => __('Separate writers with commas'),
            'add_or_remove_items'        => __('Add or remove writers'),
            'choose_from_most_used'      => 'از blockChain هایی که بیشتر استفاده شده',
            'not_found'                  => __('No writers found.'),
            'menu_name'                  => 'blockChain',
        ),
        'show_in_nav_menus' => false,
        'show_admin_column' => true,
        //        'hierarchical'      => true,
        //ساخت متاباکس اختصاصی
        'meta_box_cb'       => 'hmps_taxonomy_metabox3'
    );

    register_taxonomy('blockChain', array('book'), $args);
}


add_action('init', 'hmpt_register_taxonomy7');
function hmpt_register_taxonomy7()
{

    $args = array(
        'show_ui'   => true,
        'labels'    => array(
            'name'                       => 'DigitalCurrency',
            'singular_name'              => 'DigitalCurrency',
            'search_items'               => __('Search Writers'),
            'popular_items'              => __('Popular Writers'),
            'all_items'                  => __('All Writers'),
            'parent_item'                => null,
            'parent_item_colon'          => null,
            'edit_item'                  => 'ویرایش DigitalCurrency',
            'update_item'                => __('Update Writer'),
            'add_new_item'               => 'افزودن DigitalCurrency جدید',
            'new_item_name'              => __('New Writer Name'),
            'separate_items_with_commas' => __('Separate writers with commas'),
            'add_or_remove_items'        => __('Add or remove writers'),
            'choose_from_most_used'      => 'از DigitalCurrency هایی که بیشتر استفاده شده',
            'not_found'                  => __('No writers found.'),
            'menu_name'                  => 'DigitalCurrency',
        ),
        'show_in_nav_menus' => false,
        'show_admin_column' => true,
        //        'hierarchical'      => true,
        //ساخت متاباکس اختصاصی
        'meta_box_cb'       => 'hmps_taxonomy_metabox2'
    );

    register_taxonomy('DigitalCurrency', array('book'), $args);
}



function hmps_taxonomy_metabox3($post, $box)
{
    $taxonomy = 'blockChain';
    $tax = get_taxonomy($taxonomy);
    $term_ids = wp_get_object_terms($post->ID, $taxonomy, array('fields' => 'ids'));
    $term_id = isset($term_ids[0]) ? $term_ids[0] : 0;
    $args = array(
        'hide_empty' => 0,
    );

    $termss = get_terms('blockChain', $args);

?>
    <div id="taxonomy-<?php echo $taxonomy; ?>">
        <?php if (current_user_can($tax->cap->edit_terms)) : ?>
            <?php foreach ($termss as $term) : ?>
                <label for="hmic_software_<?php echo $term->slug; ?>">
                    <img data-term-slug="<?php echo $term->slug; ?>" title="<?php echo esc_attr($term->name); ?> | <?php echo esc_attr($term->description); ?>" id="hmic_software_<?php echo $term->slug; ?>" src="<?php echo hmic_get_term_meta($term->term_id, 'software_icon', true); ?>" class="<?php if ($term->term_id == $term_id) echo 'selected'; ?>" width="32" height="32" />
                </label>
            <?php endforeach; ?>
            <input type="hidden" id="hmic_software_select_input" name="tax_input[<?php echo esc_attr($taxonomy); ?>]" value="<?php echo $term->slug; ?>" />
        <?php endif; ?>
    </div>
<?php


}

function hmic_update_term_meta($term_id, $meta_key, $meta_value)
{
    global $wp_version;
    if (version_compare($wp_version, '4.4', '>=')) {
        return update_term_meta($term_id, $meta_key, $meta_value);
    } else {
        return update_option("taxonomy_{$term_id}_{$meta_key}", $meta_value);
    }
}

//get_term_meta($term_id, $key, $single)

function hmic_get_term_meta($term_id, $key, $single)
{
    global $wp_version;
    if (version_compare($wp_version, '4.4', '>=')) {
        return get_term_meta($term_id, $key, $single);
    } else {
        return get_option("taxonomy_{$term_id}_{$key}", '');
    }
}

//add field

add_action('blockChain_add_form_fields', function ($taxonomy) {
?>
    <div class="form-field">
        <label for="">آیکون بلاک چین </label>
        <p class="description">آیکون بلاک چین را انتخاب کنید</p>
        <input type="hidden" name="hiddenInput" id="hiddenInput" value="<?php echo HMIC_NO_ICON_URL   ?>" />
        <img class="img_blockChain" width="64px" height="64px" src="<?php echo HMIC_NO_ICON_URL ?>;" />
        <input type="button" value="انتخابblockChain" id="btn_blockChain" />
    </div>

<?php

});

//save tax
add_action('create_blockChain', 'hmic_save_blockChain');
add_action('edited_blockChain', 'hmic_save_blockChain');

function hmic_save_blockChain($term_id)
{
    if (isset($_POST['hiddenInput'])) {
        $icon_url = esc_url_raw($_POST['hiddenInput']);
        hmic_update_term_meta($term_id, 'software_icon', $icon_url);
    }
}




//save tax
add_action('create_blockChain', 'hmic_save_blockChain');
add_action('edited_blockChain', 'hmic_save_blockChain');

function hmic_save_software($term_id)
{
    if (isset($_POST['hiddenInput'])) {
        $icon_url = esc_url_raw($_POST['hiddenInput']);
        hmic_update_term_meta($term_id, 'software_icon', $icon_url);
    }
}

//add column
add_filter('manage_edit-blockChain_columns', function ($columns) {
    $columns['software_icon'] = 'آیکون نرم افزار';
    return $columns;
});

//add column data
add_filter('manage_blockChain_custom_column', function ($out, $column_name, $term_id) {

    if ($column_name == 'software_icon') {
        $icon_url = hmic_get_term_meta($term_id, 'software_icon', true);
        $out = '<img src="' . esc_url($icon_url) . '" width="48" height="48"/>';
    }
    return $out;
}, 10, 3);


add_action('admin_enqueue_scripts', function ($hook) {

    if ($hook == 'edit-tags.php' && $_GET['taxonomy'] == 'blockChain') {
        wp_enqueue_script('hmic-select-icon', plugin_dir_url(__FILE__) . 'assets/js/select_icon.js', array('jquery', 'media-upload', 'thickbox'));
        wp_enqueue_style('thickbox');
    }
    if ($hook == 'post.php' || $hook == 'post-new.php') {
        wp_enqueue_style('hmic-select-icon-post', plugin_dir_url(__FILE__) . 'assets/css/select_icon.css');
        wp_enqueue_script('hmic-select-icon-post', plugin_dir_url(__FILE__) . 'assets/js/select_icon.js');
    }
});



function hmps_taxonomy_metabox2($post, $box)
{
    //echo '<pre class="ltr left-align">';
    //print_r( $box );
    //echo '</pre>';

    $taxonomy = $box['args']['taxonomy'];
    //echo $taxonomy;

    $tax = get_taxonomy($taxonomy);

    //print_r( $tax );

    $selected = wp_get_object_terms($post->ID, $taxonomy, array('fields' => 'ids'));
    // $selected_term_id = isset($selected[0]) ? $selected[0] : 0;
    //print_r($selected);
    if (!isset($selected[0])) {
        $selected_term_id = 0;
        $q = 0;
    } else {
        $selected_term_id =  $selected;
        $q = count($selected);
    }
    $b = 0;

?>
    <div id="taxonomy-<?php echo $taxonomy; ?>">
        <?php if (current_user_can($tax->cap->edit_terms)) : ?>

            <?php foreach (get_terms($taxonomy, array('hide_empty' => 0)) as $term) :   $counter = 0; ?>

                <?php for ($i = 0; $i < $q; $i++) { ?>

                    <?php
                    if ($selected_term_id[$i] == $term->term_id) {
                        $b = $i;
                        $counter = 1;
                    ?>
                        <div>
                            <input type="checkbox" id="book_author_<?php echo esc_attr($term->slug); ?>" name="tax_input[<?php echo $taxonomy; ?>][]" value="<?php echo esc_attr($term->slug); ?>" <?php checked($term->term_id, $selected_term_id[$i]); ?> />
                            <label for="book_author_<?php echo $term->slug; ?>"><?php echo $term->name; ?></label>
                        </div>
                <?php
                    }
                }
                ?>
                <?php if ($counter == 0) { ?>
                    <div>
                        <input type="checkbox" id="book_author_<?php echo esc_attr($term->slug); ?>" name="tax_input[<?php echo $taxonomy; ?>][]" value="<?php echo esc_attr($term->slug); ?>" ?>
                        <label for="book_author_<?php echo $term->slug; ?>"><?php echo $term->name; ?></label>
                    </div>
            <?php    }
            endforeach; ?>

        <?php endif; ?>
    </div>
<?php
}


function hmps_taxonomy_metabox($post, $box)
{

    //echo '<pre class="ltr left-align">';
    // print_r( $box );
    //echo '</pre>';

    $taxonomy = $box['args']['taxonomy'];
    //echo $taxonomy;

    $tax = get_taxonomy($taxonomy);

    //print_r( $tax );

    $selected = wp_get_object_terms($post->ID, $taxonomy, array('fields' => 'ids'));

    $selected_term_id = isset($selected[0]) ? $selected[0] : 0;

    //print_r($selected);

?>
    <div id="taxonomy-<?php echo $taxonomy; ?>">
        <?php if (current_user_can($tax->cap->edit_terms)) : ?>
            <?php foreach (get_terms($taxonomy, array('hide_empty' => 0)) as $term) : ?>
                <p>
                    <input type="radio" id="book_author_<?php echo esc_attr($term->slug); ?>" name="tax_input[<?php echo $taxonomy; ?>][]" value="<?php echo esc_attr($term->slug); ?>" <?php echo checked($term->term_id, $selected_term_id); ?> />
                    <label for="book_author_<?php echo $term->slug; ?>"><?php echo $term->name; ?></label>
                </p>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
<?php
}
/*
add_filter('the_content', function ($content) {
    global $post_type;

    if ($post_type != 'book')
        return $content;

    $content .= get_the_term_list(get_the_ID(), 'book_author', 'before', 'serp00', 'after');
    return $content;
});
*/


include WF_data_INC . "informationShortCode.php";
include WF_data_INC . "setCssAndJsFile.php";


if (is_admin()) {

    include WF_data_INC . 'admin/menu.php';
}
