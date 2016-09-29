<?php
/*
Plugin Name: Post Types Order
Plugin URI: http://www.nsp-code.com
Description: Posts Order and Post Types Objects Order using a Drag and Drop Sortable javascript capability
Author: Nsp Code
Author URI: http://www.nsp-code.com 
Version: 1.8.6
Text Domain: post-types-order
Domain Path: /languages/
*/

    define('CPTPATH',   plugin_dir_path(__FILE__));
    define('CPTURL',    plugins_url('', __FILE__));


    register_deactivation_hook(__FILE__, 'CPTO_deactivated');
    register_activation_hook(__FILE__, 'CPTO_activated');

    function CPTO_activated() 
        {
            $options          =     cpt_get_options();
                
            update_option('cpto_options', $options);
        }

    function CPTO_deactivated() 
        {
            
        }
        
    include_once(CPTPATH . '/include/functions.php');
    include_once(CPTPATH . '/include/walkers.php');
    include_once(CPTPATH . '/include/cpto-class.php');

    add_filter('pre_get_posts', 'CPTO_pre_get_posts');
    function CPTO_pre_get_posts($query)
        {
            //--  lee@cloudswipe.com requirement
            global $post;
            if(is_object($post) && isset($post->ID) && $post->ID < 1)
                { return $query; }  // Stop running the function if this is a virtual page
            //--
               
            //no need if it's admin interface
            if (is_admin())
                return $query;
            
            //check for ignore_custom_sort
            if (isset($query->query_vars['ignore_custom_sort']) && $query->query_vars['ignore_custom_sort'] === TRUE)
                return $query; 
            
            //ignore if  "nav_menu_item"
            if(isset($query->query_vars)    &&  isset($query->query_vars['post_type'])   && $query->query_vars['post_type'] ==  "nav_menu_item")
                return $query;    
                
            $options          =     cpt_get_options();
            
            //if auto sort    
            if ($options['autosort'] == "1")
                {
                    //remove the supresed filters;
                    if (isset($query->query['suppress_filters']))
                        $query->query['suppress_filters'] = FALSE;    
                    
         
                    if (isset($query->query_vars['suppress_filters']))
                        $query->query_vars['suppress_filters'] = FALSE;
         
                }
                
            return $query;
        }

    add_filter('posts_orderby', 'CPTOrderPosts', 99, 2);
    function CPTOrderPosts($orderBy, $query) 
        {
            global $wpdb;
            
            $options          =     cpt_get_options();
            
            //check for ignore_custom_sort
            if (isset($query->query_vars['ignore_custom_sort']) && $query->query_vars['ignore_custom_sort'] === TRUE)
                return $orderBy;  
            
            //ignore the bbpress
            if (isset($query->query_vars['post_type']) && ((is_array($query->query_vars['post_type']) && in_array("reply", $query->query_vars['post_type'])) || ($query->query_vars['post_type'] == "reply")))
                return $orderBy;
            if (isset($query->query_vars['post_type']) && ((is_array($query->query_vars['post_type']) && in_array("topic", $query->query_vars['post_type'])) || ($query->query_vars['post_type'] == "topic")))
                return $orderBy;
                
            //check for orderby GET paramether in which case return default data
            if (isset($_GET['orderby']) && $_GET['orderby'] !=  'menu_order')
                return $orderBy;
            
            if (is_admin())
                    {
                        
                        if ($options['adminsort'] == "1" || 
                            //ignore when ajax Gallery Edit default functionality 
                            (defined('DOING_AJAX') && isset($_REQUEST['action']) && $_REQUEST['action'] == 'query-attachments')
                            )
                            {
                                
                                global $post;
                                
                                //temporary ignore ACF group and admin ajax calls, should be fixed within ACF plugin sometime later
                                if (is_object($post) && $post->post_type    ==  "acf-field-group"
                                        ||  (defined('DOING_AJAX') && isset($_REQUEST['action']) && strpos($_REQUEST['action'], 'acf/') === 0))
                                    return $orderBy;
                                    
                                $orderBy = "{$wpdb->posts}.menu_order, {$wpdb->posts}.post_date DESC";
                            }
                    }
                else
                    {
                        //ignore search
                        if($query->is_search())
                            return($orderBy);
                        
                        if ($options['autosort'] == "1")
                            {
                                if(trim($orderBy) == '')
                                    $orderBy = "{$wpdb->posts}.menu_order ";
                                else
                                    $orderBy = "{$wpdb->posts}.menu_order, " . $orderBy;
                            }
                    }

            return($orderBy);
        }

    $is_configured = get_option('CPT_configured');
    if ($is_configured == '')
        add_action( 'admin_notices', 'CPTO_admin_notices');
        
    function CPTO_admin_notices()
        {
            if (isset($_POST['form_submit']))
                return;
            ?>
                <div class="error fade">
                    <p><strong><?php _e('Post Types Order must be configured. Please go to', 'post-types-order') ?> <a href="<?php echo get_admin_url() ?>options-general.php?page=cpto-options"><?php _e('Settings Page', 'post-types-order') ?></a> <?php _e('make the configuration and save', 'post-types-order') ?></strong></p>
                </div>
            <?php
        }


    add_action( 'plugins_loaded', 'cpto_load_textdomain'); 
    function cpto_load_textdomain() 
        {
            load_plugin_textdomain('post-types-order', FALSE, dirname( plugin_basename( __FILE__ ) ) . '/languages');
        }
      
    add_action('admin_menu', 'cpto_plugin_menu'); 
    function cpto_plugin_menu() 
        {
            include (CPTPATH . '/include/options.php');
            add_options_page('Post Types Order', '<img class="menu_pto" src="'. CPTURL .'/images/menu-icon.png" alt="" />Post Types Order', 'manage_options', 'cpto-options', 'cpt_plugin_options');
        }

        
    add_action('wp_loaded', 'initCPTO' ); 	
    function initCPTO() 
        {
	        global $custom_post_type_order, $userdata;

            $options          =     cpt_get_options();

            if (is_admin())
                {
                    if(isset($options['capability']) && !empty($options['capability']))
                        {
                            if(current_user_can($options['capability']))
                                $custom_post_type_order = new CPTO(); 
                        }
                    else if (is_numeric($options['level']))
                        {
                            if (userdata_get_user_level(true) >= $options['level'])
                                $custom_post_type_order = new CPTO();     
                        }
                        else
                            {
                                $custom_post_type_order = new CPTO();   
                            }
                }        
        }
        
        
    add_filter('init', 'cpto_setup_theme');
    function cpto_setup_theme()    
        {
            if(is_admin())
                return;
            
            //check the navigation_sort_apply option
            $options          =     cpt_get_options();
            
            $navigation_sort_apply   =  ($options['navigation_sort_apply'] ==  "1")    ?   TRUE    :   FALSE;
            $navigation_sort_apply   =  apply_filters('cpto/navigation_sort_apply', $navigation_sort_apply);
            
            if( !   $navigation_sort_apply)
                return;
            
            add_filter('get_previous_post_where', 'cpto_get_previous_post_where',   99, 3);
            add_filter('get_previous_post_sort', 'cpto_get_previous_post_sort');
            add_filter('get_next_post_where', 'cpto_get_next_post_where',           99, 3);
            add_filter('get_next_post_sort', 'cpto_get_next_post_sort');
        }
    
    function cpto_get_previous_post_where($where, $in_same_term, $excluded_terms)
        {
            global $post, $wpdb;

            if ( empty( $post ) )
                return $where;
            
            //?? WordPress does not pass through this varialbe, so we presume it's category..
            $taxonomy = 'category';
            if(preg_match('/ tt.taxonomy = \'([^\']+)\'/i',$where, $match)) 
                $taxonomy   =   $match[1];
            
            $_join = '';
            $_where = '';
            
            if ( $in_same_term || ! empty( $excluded_terms ) ) 
                {
                    $_join = " INNER JOIN $wpdb->term_relationships AS tr ON p.ID = tr.object_id INNER JOIN $wpdb->term_taxonomy tt ON tr.term_taxonomy_id = tt.term_taxonomy_id";
                    $_where = $wpdb->prepare( "AND tt.taxonomy = %s", $taxonomy );

                    if ( ! empty( $excluded_terms ) && ! is_array( $excluded_terms ) ) 
                        {
                            // back-compat, $excluded_terms used to be $excluded_terms with IDs separated by " and "
                            if ( false !== strpos( $excluded_terms, ' and ' ) ) 
                                {
                                    _deprecated_argument( __FUNCTION__, '3.3', sprintf( __( 'Use commas instead of %s to separate excluded terms.' ), "'and'" ) );
                                    $excluded_terms = explode( ' and ', $excluded_terms );
                                } 
                            else 
                                {
                                    $excluded_terms = explode( ',', $excluded_terms );
                                }

                            $excluded_terms = array_map( 'intval', $excluded_terms );
                        }

                    if ( $in_same_term ) 
                        {
                            $term_array = wp_get_object_terms( $post->ID, $taxonomy, array( 'fields' => 'ids' ) );

                            // Remove any exclusions from the term array to include.
                            $term_array = array_diff( $term_array, (array) $excluded_terms );
                            $term_array = array_map( 'intval', $term_array );
                    
                            $_where .= " AND tt.term_id IN (" . implode( ',', $term_array ) . ")";
                        }

                    if ( ! empty( $excluded_terms ) ) {
                        $_where .= " AND p.ID NOT IN ( SELECT tr.object_id FROM $wpdb->term_relationships tr LEFT JOIN $wpdb->term_taxonomy tt ON (tr.term_taxonomy_id = tt.term_taxonomy_id) WHERE tt.term_id IN (" . implode( $excluded_terms, ',' ) . ') )';
                    }
                }
                
            $current_menu_order = $post->menu_order;
            
            $query = "SELECT p.* FROM $wpdb->posts AS p
                        $_join
                        WHERE p.post_date < '". $post->post_date ."'  AND p.menu_order = '".$current_menu_order."' AND p.post_type = '". $post->post_type ."' AND p.post_status = 'publish' $_where";
            $results = $wpdb->get_results($query);
                    
            if (count($results) > 0)
                    {
                        $where .= " AND p.menu_order = '".$current_menu_order."'";
                    }
                else
                    {
                        $where = str_replace("p.post_date < '". $post->post_date  ."'", "p.menu_order > '$current_menu_order'", $where);  
                    }
            
            return $where;
        }
        
    function cpto_get_previous_post_sort($sort)
        {
            global $post, $wpdb;
            
            $sort = 'ORDER BY p.menu_order ASC, p.post_date DESC LIMIT 1';

            return $sort;
        }

    function cpto_get_next_post_where($where, $in_same_term, $excluded_terms)
        {
            global $post, $wpdb;

            if ( empty( $post ) )
                return $where;
            
            $taxonomy = 'category';
            if(preg_match('/ tt.taxonomy = \'([^\']+)\'/i',$where, $match)) 
                $taxonomy   =   $match[1];
            
            $_join = '';
            $_where = '';
                        
            if ( $in_same_term || ! empty( $excluded_terms ) ) 
                {
                    $_join = " INNER JOIN $wpdb->term_relationships AS tr ON p.ID = tr.object_id INNER JOIN $wpdb->term_taxonomy tt ON tr.term_taxonomy_id = tt.term_taxonomy_id";
                    $_where = $wpdb->prepare( "AND tt.taxonomy = %s", $taxonomy );

                    if ( ! empty( $excluded_terms ) && ! is_array( $excluded_terms ) ) 
                        {
                            // back-compat, $excluded_terms used to be $excluded_terms with IDs separated by " and "
                            if ( false !== strpos( $excluded_terms, ' and ' ) ) 
                                {
                                    _deprecated_argument( __FUNCTION__, '3.3', sprintf( __( 'Use commas instead of %s to separate excluded terms.' ), "'and'" ) );
                                    $excluded_terms = explode( ' and ', $excluded_terms );
                                } 
                            else 
                                {
                                    $excluded_terms = explode( ',', $excluded_terms );
                                }

                            $excluded_terms = array_map( 'intval', $excluded_terms );
                        }

                    if ( $in_same_term ) 
                        {
                            $term_array = wp_get_object_terms( $post->ID, $taxonomy, array( 'fields' => 'ids' ) );

                            // Remove any exclusions from the term array to include.
                            $term_array = array_diff( $term_array, (array) $excluded_terms );
                            $term_array = array_map( 'intval', $term_array );
                    
                            $_where .= " AND tt.term_id IN (" . implode( ',', $term_array ) . ")";
                        }

                    if ( ! empty( $excluded_terms ) ) {
                        $_where .= " AND p.ID NOT IN ( SELECT tr.object_id FROM $wpdb->term_relationships tr LEFT JOIN $wpdb->term_taxonomy tt ON (tr.term_taxonomy_id = tt.term_taxonomy_id) WHERE tt.term_id IN (" . implode( $excluded_terms, ',' ) . ') )';
                    }
                }
                
            $current_menu_order = $post->menu_order;
            
            //check if there are more posts with lower menu_order
            $query = "SELECT p.* FROM $wpdb->posts AS p
                        $_join
                        WHERE p.post_date > '". $post->post_date ."' AND p.menu_order = '".$current_menu_order."' AND p.post_type = '". $post->post_type ."' AND p.post_status = 'publish' $_where";
            $results = $wpdb->get_results($query);
                    
            if (count($results) > 0)
                    {
                        $where .= " AND p.menu_order = '".$current_menu_order."'";
                    }
                else
                    {
                        $where = str_replace("p.post_date > '". $post->post_date  ."'", "p.menu_order < '$current_menu_order'", $where);  
                    }
            
            return $where;
        }

    function cpto_get_next_post_sort($sort)
        {
            global $post, $wpdb; 
            
            $sort = 'ORDER BY p.menu_order DESC, p.post_date ASC LIMIT 1';
            
            return $sort;    
        }


?>