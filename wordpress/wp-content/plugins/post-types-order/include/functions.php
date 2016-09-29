<?php

    
    /**
    * Return the user level
    * 
    * This is deprecated, will be removed in the next versions
    * 
    * @param mixed $return_as_numeric
    */
    function userdata_get_user_level($return_as_numeric = FALSE)
        {
            global $userdata;
            
            $user_level = '';
            for ($i=10; $i >= 0;$i--)
                {
                    if (current_user_can('level_' . $i) === TRUE)
                        {
                            $user_level = $i;
                            if ($return_as_numeric === FALSE)
                                $user_level = 'level_'.$i;    
                            break;
                        }    
                }        
            return ($user_level);
        }
        
    
    function cpt_get_options()
        {
            //make sure the vars are set as default
            $options = get_option('cpto_options');
            
            $defaults   = array (
                                    'show_reorder_interfaces'   =>  array(),
                                    'autosort'                  =>  1,
                                    'adminsort'                 =>  1,
                                    'capability'                =>  'install_plugins',
                                    'navigation_sort_apply'     =>  1,
                                    
                                );
            $options          = wp_parse_args( $options, $defaults );
            
            return $options;            
        }
        
    function cpt_info_box()
        {
            ?>
                <div id="cpt_info_box">
                     <div id="p_right"> 
                        
                        <div id="p_socialize">
                            
                            <div class="p_s_item s_f">
                                <div id="fb-root"></div>
                                <script>(function(d, s, id) {
                                  var js, fjs = d.getElementsByTagName(s)[0];
                                  if (d.getElementById(id)) return;
                                  js = d.createElement(s); js.id = id;
                                  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5";
                                  fjs.parentNode.insertBefore(js, fjs);
                                }(document, 'script', 'facebook-jssdk'));</script>
                                
                                <div class="fb-like" data-href="https://www.facebook.com/Nsp-Code-190329887674484/" data-layout="button_count" data-action="like" data-show-faces="true" data-share="false"></div>
                                
                            </div>
                            
                            <div class="p_s_item s_t">
                                <a href="https://twitter.com/share" class="twitter-share-button" data-url="http://www.nsp-code.com" data-text="Define custom order for your post types through an easy to use javascript AJAX drag and drop interface. No theme code updates are necessarily, this plugin will take care of query update." data-count="none">Tweet</a><script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>
                            </div>
                            
                            <div class="p_s_item s_gp">
                                <!-- Place this tag in your head or just before your close body tag -->
                                <script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>

                                <!-- Place this tag where you want the +1 button to render -->
                                <div class="g-plusone" data-size="small" data-annotation="none" data-href="http://nsp-code.com/"></div>
                            </div>
                            
                            <div class="clear"></div>
                        </div>
                        
                        <div id="donate_form">
                            <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
                            <input type="hidden" name="cmd" value="_s-xclick">
                            <input type="hidden" name="hosted_button_id" value="CU22TFDKJMLAE">
                            <input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                            <img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
                            </form>
                        </div>
                    </div>
                    
                    <p><?php _e('Did you find this plugin useful? Please support our work with a donation or write an article about this plugin in your blog with a link to our site', 'post-types-order') ?> <a href="http://www.nsp-code.com/" target="_blank"><strong>http://www.nsp-code.com/</strong></a>.</p>
                    <h4><?php _e('Did you know there is available an Advanced version of this plug-in?', 'post-types-order') ?> <a target="_blank" href="http://www.nsp-code.com/premium-plugins/wordpress-plugins/advanced-post-types-order/"><?php _e('Read more', 'post-types-order') ?></a></h4>
                    <p><?php _e('Check our', 'post-types-order') ?> <a target="_blank" href="http://wordpress.org/plugins/taxonomy-terms-order/">Category Order - Taxonomy Terms Order</a> <?php _e('plugin which allow to custom sort categories and custom taxonomies terms', 'post-types-order') ?> </p>
                    
                    <div class="clear"></div>
                </div>
            
            <?php   
        }

?>