<?php 

//=========== chargement des scripts

define('INPULSA_VERSION', '1.0.1');
function inpulsa_scripts(){

    //chargement des styles
    wp_enqueue_style( 'inpulsa_bootstrap-core', get_template_directory_uri() . '/css/bootstrap.min.css', array(), INPULSA_VERSION, 'all');
    wp_enqueue_style( 'inpulsa_custom', get_template_directory_uri() . '/style.css', array('inpulsa_bootstrap-core'), INPULSA_VERSION, 'all');

    //chargement des js
    wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), INPULSA_VERSION, true );
    // wp_enqueue_script( 'inpulsa_admin_script', get_template_directory_uri() . '/js/leaflet.js', array('jquery', 'bootstrap-js'), INPULSA_VERSION, true );
    wp_enqueue_script( 'inpulsa_admin_script', get_template_directory_uri() . '/js/inpulsa.js', array('jquery', 'bootstrap-js'), INPULSA_VERSION, true );

}

add_action('wp_enqueue_scripts', 'inpulsa_scripts');

//google font


function add_google_fonts() {
 
wp_enqueue_style( ' add_google_fonts ', 'https://fonts.googleapis.com/css?family=Proza+Libre|Quicksand|Amita', false );}
 
add_action( 'wp_enqueue_scripts', 'add_google_fonts' );

// font awesome

function wpb_load_fa() {
 
    wp_enqueue_style( 'wpb-fa', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css', false );}
     
    add_action( 'wp_enqueue_scripts', 'wpb_load_fa' );


// chargement de l'admin
function inpulsa_admin_init(){

// *******************action 1
    function inpulsa_admin_scripts(){
        if(!isset($_GET['page']) || $_GET['page'] != "inpulsa_theme_opts"){
            return;
        }
    // chargement des styles admin 
        wp_enqueue_style( 'bootstrap-adm-core', get_template_directory_uri() . '/css/bootstrap.min.css', array(), INPULSA_VERSION );
   
     // chargement des scripts admin
    wp_enqueue_media();
    wp_enqueue_script( 'inpulsa-admin-init' , get_template_directory_uri() . '/js/admin-options.js',
    array() , INPULSA_VERSION, true);
     }// fin de inpulsa_scripts

    add_action('admin_enqueue_scripts', 'inpulsa_admin_scripts');


// ********************action2

    include('includes/save-options-page.php');
    add_action('admin_post_inpulsa_save_options' , 'inpulsa_save_options');

} // fin de inpulsa_admin_init
    add_action('admin_init', 'inpulsa_admin_init');




// activation des options

function inpulsa_activ_options(){
    $theme_opts = get_option('inpulsa_opts');
    if(!$theme_opts){
        $opts = array(
            'image_01_url'             =>'',
            'legend_01'                =>''
        );
        add_option('inpulsa_opts' , $opts);

    }

}

add_action('after_switch_theme' , 'inpulsa_activ_options');


// *********************MENU OPTIONS DU THEME

function inpulsa_admin_menus(){
    add_menu_page(
        'Inpulsa Options',
        'Options du thème',
        'publish_pages',
        'inpulsa_theme_opts',
        'inpulsa_build_options_page'
    );
    include('includes/build-options-page.php'); //contient la fonction inpulsa_build_options_page
}

add_action('admin_menu' , 'inpulsa_admin_menus');


// utilitaires

function inpulsa_setup() {

// support des vignettes
add_theme_support('post-thumbnails');

//enlève le générateur de version
remove_action('wp_head', 'wp_generator');

//enlève les guillemets à la française
remove_filter ('the_content', 'wptexturize');

// support du titre 
add_theme_support('title-tag');

// register custom Navigation Walker
require_once('includes/wb_bootstrap_navwalker.php');

//activer la gestion des menus
register_nav_menus( array('primary' => 'principal', 'secondary' => 'deuxième' ) );
}

add_action('after_setup_theme', 'inpulsa_setup');

//  Commande pour afficher date et catégorie

function inpulsa_give_me_meta_01($date1, $date2, $cat) {

    $chaine = 'publié le <time class="entry-date" datetime="';
    $chaine .= $date1;
    $chaine .= '">';
    $chaine .= $date2;
    $chaine .= '</time> dans la catégorie ';
    $chaine .= $cat;
    // $chaine .= ' avec les étiquettes: '. $tags;

    return $chaine;

}

function new_excerpt_more($more) {
    return '';
    }
    add_filter('excerpt_more', 'new_excerpt_more', 21 );
    
    function the_excerpt_more_link( $excerpt ){
    $post = get_post();
    $excerpt .= '<a href="'. get_permalink($post->ID) . '">Lire la suite</a>.';
    return $excerpt;
    }
    add_filter( 'the_excerpt', 'the_excerpt_more_link', 21 );
