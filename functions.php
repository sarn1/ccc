<?php

//event expresso query add_filters
function my_posts_join( $sql ) {
	$sql .= ' INNER JOIN ' . EEM_Datetime::instance()->table() . ' ON ( ' . EEM_Event::instance()->table() . '.ID = ' . EEM_Datetime::instance()->table() . '.' . EEM_Event::instance()->primary_key_name() . ' ) ';
	return $sql;
}
function my_posts_where_upcoming( $sql ) {
	$sql .= ' AND ' . EEM_Datetime::instance()->table() . '.DTT_EVT_end >= "' . current_time( 'mysql', true );
	return $sql;
}
function my_posts_where_past( $sql ) {
	$sql .= ' AND ' . EEM_Datetime::instance()->table() . '.DTT_EVT_end <= "' . current_time( 'mysql', true );
	return $sql;
}
function my_posts_orderby_upcoming ( $sql ) {
	$sql .= '" order by '. EEM_Datetime::instance()->table() . '.DTT_EVT_start asc';
	return $sql;
}
function my_posts_orderby_past ( $sql ) {
	$sql .= '" order by '. EEM_Datetime::instance()->table() . '.DTT_EVT_end desc';
	return $sql;
}



if (!function_exists('pq')) {
  function pq($str, $return = false, $more = true)
  {
    ini_set('memory_limit', -1); // lol
    ob_start();
    echo '><pre>';
    if ($more)
      var_dump($str);
    else
      print_r($str);
    echo '</pre>';
    $out = preg_replace(
      [
        "/=>\n\s*/",
        '/(\s)NULL(\s)/',
        "#\"(https?://|/?/)(.*)\"#",
      ],
      [
        " => ",
        '$1null$2',
        '"<a href="$1$2">$1$2</a>"',
      ],
      ob_get_clean()
    );
    if ($return)
      return $out;
    echo $out;
  }
  function pqd($str, $die = "", $return = false, $more = true)
  {
    pq($str, $return, $more);
    die($die);
  }
}

//custom hack to get post turn on for event expresso
add_action('action_hook_espresso_new_event_right_column_bottom', 'my_custom_post_option_default_switcher');
function my_custom_post_option_default_switcher(){
?>
<script>
jQuery(document).ready(function($) {
$("select[name='create_post']").val("Y");
});
</script>
<?php
}

//nav menus

$navmenus = array(

	'Main Menu'

);



//widget areas

$widgetareas = array(

	'Sidebar', 'Footer'

);



 



//enable theme features

add_theme_support('menus'); //enable menus

add_theme_support('post-thumbnails'); //enable post thumbnails



 



//register nav menus



add_action('init','jet4_register_nav_menus');



function jet4_register_nav_menus() {



	global $navmenus;

	if (function_exists('register_nav_menus')) {

		$navmenus_proc = array();

		foreach($navmenus as $menu) {

			$key = sanitize_title($menu);

			$val = $menu;

			$navmenus_proc[$key] = $val;

		}

		register_nav_menus($navmenus_proc);

	}

}





//automatically assign categories to blog post - assign all blog post as blog 

/*

function add_category_automatically1($post_ID) {  

    global $wpdb;  

        if(!in_category('bundle')){  

            $cat = array(1);  

            wp_set_object_terms($post_ID, $cat, 'category', true);  

        }  

}  



add_action('publish_post', 'add_category_automatically1');  

*/



//register widget areas



add_action('init','jet4_register_widget_areas');



function jet4_register_widget_areas() {

	global $widgetareas;

	if (function_exists('register_sidebar')) {

		foreach ($widgetareas as $widgetarea) {

			register_sidebar(array(

				'name'          => $widgetarea,

				'id'            => sanitize_title($widgetarea),

				'before_widget' => '<div id="%1$s" class="widget '.(string)sanitize_title($widgetarea).' %2$s %1$s">',

				'after_widget'  => '</div>',

				'before_title'  => '<h2>',

				'after_title'   => '</h2>'

			));

		}

	}

}







//register theme script



add_action('init','jet4_register_theme_script');



function jet4_register_theme_script() {



	if ( !is_admin() ) {

		wp_register_script('jet4_theme_script',	get_bloginfo('template_directory') . '/includes/scripts.js',	array('jquery'));

		wp_enqueue_script('jet4_theme_script');	

		

		wp_register_script('jet4_theme_script2',	get_bloginfo('template_directory') . '/includes/ga-tracker.js',	array('jquery'));

		wp_enqueue_script('jet4_theme_script2');	



		wp_register_script('jet4_theme_script3',	get_bloginfo('template_directory') . '/includes/html5shiv.js' );

		wp_enqueue_script('jet4_theme_script3');	

		wp_register_script('jet4_theme_script4',	get_bloginfo('template_directory') . '/includes/html5shiv-printshiv.js' );

		wp_enqueue_script('jet4_theme_script4');

		

		/* optional for JQuery backwards compatibility		*/	
		//wp_register_script('jet4_theme_script5',	get_bloginfo('template_directory') . '/includes/jquery-migrate-1.1.0.min.js' );
		//wp_enqueue_script('jet4_theme_script5');		
	

		wp_register_script('jet4_theme_script6',	get_bloginfo('template_directory') . '/includes/modernizr.js' );
		wp_enqueue_script('jet4_theme_script6');	


		//bootstrap menu scripts
	    wp_register_script('jquery.bootstrap.min', get_template_directory_uri() . '/includes/bootstrap/js/bootstrap.min.js', array( 'jquery' ));
    	wp_enqueue_script('jquery.bootstrap.min');
	}



}

//boot strap menu
require_once('includes/wp_bootstrap_navwalker.php');

function add_nav_class($output) {
    $output= preg_replace('/<a/', '<a class="button"', $output, -1);
    return $output;
}
add_filter('wp_nav_menu', 'add_nav_class');






add_action( 'wp_enqueue_scripts', 'prefix_add_my_stylesheet' );

function prefix_add_my_stylesheet() {

	

        // Respects SSL, Style.css is relative to the current file

        wp_register_style( 's452-normalize-style', get_bloginfo('template_directory').'/includes/normalize.css' , __FILE__ );

        wp_enqueue_style( 's452-normalize-style' );

		wp_register_style( 's452-wp-core-style', get_bloginfo('template_directory').'/includes/wp-styles.css' , __FILE__ );

        wp_enqueue_style( 's452-wp-core-style' );



   	//bootstrap menu css
    wp_register_style( 'bootstrap.min', get_template_directory_uri() . '/includes/bootstrap/css/bootstrap.min.css' );
    wp_enqueue_style( 'bootstrap.min' );
    wp_register_style( 'bootstrap-theme.min.css', get_template_directory_uri() . '/includes/bootstrap/css/bootstrap-theme.min.css' );
    wp_enqueue_style( 'bootstrap-theme.min.css' );


        wp_register_style( 's452-style', get_bloginfo('template_directory').'/style.css' , __FILE__ );

        wp_enqueue_style( 's452-style' );
    }

	



//automatically assign categories to blog post - assign all blog post as blog 

/*

function add_category_automatically1($post_ID) {  

    global $wpdb;  

        if(!in_category('bundle')){  

            $cat = array(1);  

            wp_set_object_terms($post_ID, $cat, 'category', true);  

        }  

}  



add_action('publish_post', 'add_category_automatically1');  

*/





/*



add_filter('tiny_mce_before_init', 'restrict_font_choices' );

function restrict_font_choices( $initArray ) {

    $initArray['theme_advanced_fonts'] =

        //'Abel = Abel, sans-serif;'.

		'Andale Mono=andale mono,times;'.

        'Arial=arial,helvetica,sans-serif;'.

        //'Arial Black=arial black,avant garde;'.

        'Book Antiqua=book antiqua,palatino;'.

        //'Comic Sans MS=comic sans ms,sans-serif;'.

        //'Cantana One=Cantata One, serif;'.

		'Courier New=courier new,courier;'.

        'Georgia=georgia,palatino;'.

        'Helvetica=helvetica;'.

        //'Impact=impact,chicago;'.

        //'Symbol=symbol;'.

        'Tahoma=tahoma,arial,helvetica,sans-serif;'.

        'Terminal=terminal,monaco;'.

        'Times New Roman=times new roman,times;'.

        'Trebuchet MS=trebuchet ms,geneva;'.

        'Verdana=verdana,geneva;'.

        //'Webdings=webdings;'.

        //'Wingdings=wingdings,zapf dingbats'.

        '';

    return $initArray;



}
*/


function wwiz_mce_inits($initArray){
    $initArray['height'] = '600px';
    $initArray['theme_advanced_font_sizes'] = '10px,12px,13px,14px,15px,16px,18px,20px,22px,24px,26px,28px,30px,32px,34px,36px,38px,40px';
    $initArray['font_size_style_values'] = '10px,12px,13px,14px,15px,16px,18px,20px,22px,24px,26px,28px,30px,32px,34px,36px,38px,40px';
    return $initArray;
}
add_filter('tiny_mce_before_init', 'wwiz_mce_inits');





?>