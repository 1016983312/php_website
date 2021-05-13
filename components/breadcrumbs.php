<?php  
function get_breadcrumbs()   
{   
global $wp_query;   
if ( !is_home() ){   
echo '<ul>';   
echo '<a href="'. get_settings('home') .'">'. 首页 .'</a>';   
if ( is_category() )   
{   
$catTitle = single_cat_title( "", false );   
$cat = get_cat_ID( $catTitle );   
echo " &raquo; ". get_category_parents( $cat, TRUE, " &raquo; " ) ;   
}   
elseif ( is_archive() && !is_category() )   
{   
echo "&raquo; Archives";   
}   
elseif ( is_search() ) {   
echo "&raquo; Search Results";   
}   
elseif ( is_404() )   
{   
echo "&raquo; 404 Not Found";   
}   
elseif ( is_single() )   
{   
$category = get_the_category();   
$category_id = get_cat_ID( $category[0]->cat_name );   
echo '&raquo; '. get_category_parents( $category_id, TRUE, " &raquo; " );   
echo the_title('','', FALSE);   
}   
elseif ( is_page() )   
{   
$post = $wp_query->get_queried_object();   
if ( $post->post_parent == 0 ){   
echo "<li> &raquo; ".the_title('','', FALSE)."</li>";   
} else {   
$title = the_title('','', FALSE);   
$ancestors = array_reverse( get_post_ancestors( $post->ID ) );   
array_push($ancestors, $post->ID);   
foreach ( $ancestors as $ancestor ){   
if( $ancestor != end($ancestors) ){   
echo '<li> &raquo; <a href="'. get_permalink($ancestor) .'">'. strip_tags( apply_filters( 'single_post_title', get_the_title( $ancestor ) ) ) .'</a></li>';   
} else {   
echo '<li> &raquo; '. strip_tags( apply_filters( 'single_post_title', get_the_title( $ancestor ) ) ) .'</li>';   
}   
}   
}   
}   
echo "</ul>";
}   
}
?>