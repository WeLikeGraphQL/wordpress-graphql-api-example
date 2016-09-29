<?php
   /*
    * This file handles everything within the "Settings" > "Secondary Title"
    * settings page within the admin area.
    *
    * @package       Secondary Title
    * @subpackage    Administration
    */

   /**
    * Stop script when the file is called directly.
    */
   if(!function_exists("add_action")) {
      return false;
   }

   /**
    * Build the option page.
    *
    * @since 0.1
    */
   function secondary_title_settings_page() {
      /** Check if the submit button was hit and call is authorized */
      $reset_url = wp_nonce_url(get_admin_url() . "options-general.php?page=secondary-title&action=reset", "secondary_title_reset_settings", "nonce");
      $saved     = false;
      $reset     = false;

      if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["nonce"]) && wp_verify_nonce($_POST["nonce"], "secondary_title_save_settings") && secondary_title_update_settings($_POST)) {
         $saved = true;
      }
      elseif($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["action"], $_GET["nonce"]) && wp_verify_nonce($_GET["nonce"], "secondary_title_reset_settings")) {
         if(secondary_title_reset_settings()) {
            $reset = true;
         }
      }

      $settings = secondary_title_get_settings(false);
      ?>
      <form method="post" action="" class="wrap metabox-holder" id="secondary-title-settings">
         <input type="hidden" id="text-confirm-reset" value="<?php _e("Are you sure you want to reset all settings?", "secondary_title"); ?>"/>

         <h1 class="page-title">
            <i class="fa fa-cog"></i>
            <?php echo "Secondary Title &raquo; " . get_admin_page_title(); ?>
         </h1>
         <?php
            if($saved) {
               ?>
               <div class="updated">
                  <p><?php _e("The settings have been successfully updated.", "secondary_title"); ?></p>
               </div>
               <?php
            }
            elseif($reset) {
               ?>
               <div class="updated">
                  <p><?php _e("The settings have been successfully reset.", "secondary_title"); ?></p>
               </div>
               <?php
            }
         ?>

         <div class="postboxes" id="postbox-general-settings">
            <div class="postbox">
               <div class="content-toggler" title="<?php _e("Collapse/expand section", "secondary_title"); ?>"></div>
               <h3 class="postbox-title hndle">
                  <?php _e("General Settings", "secondary_title"); ?>
               </h3>
               <div class="inside opened">
                  <p class="intro">
                     <?php _e("This section lets you change the most basic settings about how Secondary Title is supposed to behave.", "secondary_title"); ?>
                  </p>
                  <table class="form-table">
                     <tr id="row-auto-show">
                        <th>
                           <label for="auto-show-on">
                              <i class="fa fa-magic"></i>
                              <?php _e("Auto show", "secondary_title"); ?>:
                           </label>
                        </th>
                        <td>
                           <div class="radios" id="auto-show">
                              <input type="radio" id="auto-show-on" name="auto_show" value="on"<?php checked($settings["auto_show"], "on"); ?>/>
                              <label for="auto-show-on"><?php _e("On", "secondary_title"); ?></label>

                              <input type="radio" id="auto-show-off" name="auto_show" value="off"<?php checked($settings["auto_show"], "off"); ?>/>
                              <label for="auto-show-off"><?php _e("Off", "secondary_title"); ?></label>
                           </div>

                           <p id="auto-show-on-description" class="description"<?php checked($settings["auto_show"], "off"); ?> hidden>
                              <?php _e("Automatically merges the secondary title with the standard title.", "secondary_title"); ?>
                           </p>

                           <p id="auto-show-off-description" class="description">
                              <?php
                                 echo sprintf(__('To manually insert the secondary title in your theme, use %s or %s. See the <a href="%s" title="See official documentation" target="_blank" >official documentation</a> for additional parameters.', "secondary_title"), "<code>&lt;?php echo get_secondary_title(); ?&gt;</code>", "<code>&lt;?php the_secondary_title(); ?&gt;</code>", "http://www.koljanolte.com/wordpress/plugins/secondary-title/#Parameters");
                              ?>
                           </p>
                        </td>
                     </tr>
                     <tr id="row-title-format">
                        <th>
                           <label for="title-format">
                              <i class="fa fa-keyboard-o"></i>
                              <?php _e("Title format", "secondary_title"); ?>:
                           </label>
                        </th>
                        <td>
                           <input type="hidden" id="title-format-backup" value="<?php echo stripslashes(esc_attr(get_option("secondary_title_title_format"))); ?>"/>
                           <input type="text" name="title_format" id="title-format" class="regular-text" placeholder="<?php _e("E.g.: %secondary_title%: %title%", "secondary_title"); ?>" value="<?php echo stripslashes(esc_attr(get_option("secondary_title_title_format"))); ?>" autocomplete="off"/>
                           <a href="#" id="reset-title-format" type="reset" class="button">
                              <i class="fa fa-undo"></i>
                              <?php _e("Reset", "secondary_title"); ?>
                           </a>

                           <p class="description">
                              <?php echo sprintf(__('Replaces the default title with the given format. Use %s for the main title and %s for the secondary title.', "secondary_title"), '<code class="pointer" title="' . __("Add title to title format input", "secondary_title") . '">%title%</code>', '<code class="pointer" title="' . __("Add secondary title to title format input", "secondary_title") . '">%secondary_title%</code>'); ?>
                           </p>

                           <?php
                              $random_post = new WP_Query(
                                 array(
                                    "post_type" => "any",
                                    "meta_key"  => "_secondary_title",
                                    "showposts" => 1
                                 )
                              );

                              if($random_post->found_posts) {
                                 $post_id = $random_post->posts[0]->ID;
                                 ?>
                                 <input type="hidden" id="random-post-title" value="<?php echo get_the_title($post_id); ?>"/>
                                 <input type="hidden" id="random-post-secondary-title" value="<?php echo get_secondary_title($post_id); ?>"/>

                                 <div id="title-format-preview">
                                    <p><strong>Preview:</strong></p>
                                    <span class="text-field"></span>
                                 </div>
                                 <?php
                              }
                           ?>

                           <p class="description">
                              <?php
                                 echo sprintf(__('<b>Note:</b> To style the output, use the <a href="%s" title="See an explanation on w3schools.com" target="_blank">style HTML attribute</a>, e.g.:<br />%s', "secondary_title"), "http://www.w3schools.com/tags/att_global_style.asp", '<code title="' . __("Add code to title format input", "secondary_title") . '">' . esc_attr('<span style="color:#ff0000;font-size:14px;">%secondary_title%</span>') . "</code>");
                              ?>
                           </p>
                        </td>
                     </tr>
                  </table>
               </div>
            </div>

            <div class="postboxes" id="postbox-display-rules">
               <div class="postbox">
                  <div class="content-toggler"></div>
                  <h3 class="postbox-title hndle">
                     <?php _e("Display Rules", "secondary_title"); ?>
                  </h3>
                  <div class="inside">
                     <p class="intro">
                        <?php _e("These options let you specify where the secondary title is allowed to be displayed and where not. Unselecting all fields deactivates the limit completely.", "secondary_title"); ?>
                     </p>
                     <table class="form-table">
                        <tr>
                           <th>
                              <i class="fa fa-filter"></i>
                              <?php _e("Only show in main post", "secondary_title"); ?>:
                           </th>
                           <td>
                              <div class="radios">
                                 <input type="radio" id="only-show-in-main-post-on" name="only_show_in_main_post" value="on"<?php checked($settings["only_show_in_main_post"], "on"); ?>/>
                                 <label for="only-show-in-main-post-on"><?php _e("On", "secondary_title"); ?></label>

                                 <input type="radio" id="only-show-in-main-post-off" name="only_show_in_main_post" value="off"<?php checked($settings["only_show_in_main_post"], "off"); ?>/>
                                 <label for="only-show-in-main-post-off"><?php _e("Off", "secondary_title"); ?></label>
                              </div>
                              <p class="description">
                                 <?php _e("Only displays the secondary title if the post is a main post and <strong>not</strong> within a widget etc.", "secondary_title"); ?>
                              </p>
                           </td>
                        </tr>
                        <tr id="row-post-types">
                           <th>
                              <i class="fa fa-file-text-o"></i>
                              <?php _e("Post types", "secondary_title"); ?>:
                           </th>
                           <td>
                              <div class="post-types">
                                 <?php
                                    $post_types = get_post_types(
                                       array(
                                          "public" => true
                                       )
                                    );

                                    foreach((array)$post_types as $post_type) {
                                       $post_type       = get_post_type_object($post_type);
                                       $post_type_posts = new WP_Query(
                                          array(
                                             "post_type" => $post_type->name
                                          )
                                       );

                                       $post_type_posts_count = $post_type_posts->found_posts;
                                       $post_types            = secondary_title_get_setting("post_types");
                                       $checked               = "";
                                       if(in_array($post_type->name, $post_types, false)) {
                                          $checked = " checked";
                                       }
                                       ?>
                                       <p class="post-type">
                                          <input type="checkbox" name="post_types[]" id="post-type-<?php echo $post_type->name; ?>" value="<?php echo $post_type->name; ?>"<?php echo $checked; ?>/>
                                          <label for="post-type-<?php echo $post_type->name; ?>">
                                             <?php echo $post_type->labels->name; ?>
                                             <small>
                                                (<?php echo _n("1 post", sprintf("%s posts", $post_type_posts_count), $post_type_posts_count); ?>)
                                             </small>
                                          </label>
                                       </p>
                                       <?php
                                    }
                                 ?>
                              </div>
                              <p class="description">
                                 <?php _e("Only displays the secondary title if post among the selected post types.", "secondary_title"); ?>
                              </p>
                           </td>
                        </tr>
                        <tr id="row-categories">
                           <th>
                              <i class="fa fa-folder-o"></i>
                              <?php _e("Categories", "secondary_title"); ?>:
                           </th>
                           <td>
                              <div class="list">
                                 <?php
                                    $categories = get_categories(
                                       array(
                                          "hide_empty" => false
                                       )
                                    );

                                    foreach((array)$categories as $category) {
                                       $allowed_categories = secondary_title_get_setting("categories");
                                       $checked            = "";

                                       if(in_array($category->term_id, $allowed_categories, false)) {
                                          $checked = " checked";
                                       }
                                       ?>
                                       <div class="list-item" title="<?php echo sprintf(__("There are %s posts in %s", "secondary_title"), $category->count, $category->name); ?>">
                                          <input type="checkbox" name="categories[]" id="category-<?php echo $category->term_id; ?>" value="<?php echo $category->term_id; ?>"<?php echo $checked; ?>/>
                                          <label for="category-<?php echo $category->term_id; ?>">
                                             <?php
                                                echo $category->name;
                                             ?>
                                          </label>
                                       </div>
                                       <?php
                                    }
                                 ?>
                                 <div class="clear"></div>
                                 <div class="list-actions">
                                    <span id="select-all-categories-container">
                                       <a href="#" id="select-all-categories">
                                          <?php _e("Select all", "secondary_title"); ?>
                                       </a>
                                    </span>
                                    <span id="unselect-all-categories-container" hidden>
                                       <a href="#" id="unselect-all-categories">
                                          <?php _e("Unselect all", "secondary_title"); ?>
                                       </a>
                                    </span>
                                 </div>
                                 <p class="description">
                                    <?php _e("Displays the secondary title only if post is among the selected categories.", "secondary_title"); ?>
                                 </p>
                              </div>
                           </td>
                        </tr>
                        <tr id="row-post-ids">
                           <th>
                              <label for="post-ids">
                                 <i class="fa fa-sort-numeric-asc"></i>
                                 <?php _e("Post IDs", "secondary_title"); ?>:
                              </label>
                           </th>
                           <td>
                              <input type="text" name="post_ids" id="post-ids" class="regular-text" placeholder="<?php _e("E.g. 13, 71, 33", "secondary_title"); ?>" value="<?php echo implode(", ", secondary_title_get_setting("post_ids")); ?>"/>
                              <p class="description">
                                 <?php _e("Only uses the secondary title if post is among the entered post IDs. Use commas to separate multiple IDs.", "secondary_title"); ?>
                              </p>
                           </td>
                        </tr>
                     </table>
                  </div>
               </div>
               <div class="postbox opened">
                  <div class="content-toggler" title="<?php _e("Collapse/expand section", "secondary_title"); ?>"></div>
                  <h3 class="postbox-title hndle">
                     <?php _e("Miscellaneous Settings ", "secondary_title"); ?>
                  </h3>
                  <div class="inside">
                     <table class="form-table">
                        <tr>
                           <th>
                              <label for="include-in-search-on">
                                 <i class="fa fa-search"></i>
                                 <?php _e("Include in search", "secondary_title"); ?>:
                              </label>
                           </th>
                           <td>
                              <div class="radios">
                                 <input type="radio" name="include_in_search" id="include-in-search-on" value="on" <?php checked($settings["include_in_search"], "on"); ?>>
                                 <label for="include-in-search-on">
                                    <?php _e("On", "secondary_title"); ?>
                                 </label>

                                 <input type="radio" name="include_in_search" id="include-in-search-off" value="off" <?php checked($settings["include_in_search"], "off"); ?>>
                                 <label for="include-in-search-off">
                                    <?php _e("Off", "secondary_title"); ?>
                                 </label>
                              </div>
                              <p class="description">
                                 <?php _e("Makes the secondary title searchable.", "secondary_title"); ?>
                              </p>
                           </td>
                        </tr>
                        <tr>
                           <th>
                              <label for="input-field-position-top">
                                 <i class="fa fa-arrow-up"></i>
                                 <?php _e("Input field position", "secondary_title"); ?>:
                              </label>
                           </th>
                           <td>
                              <div class="radios">
                                 <input type="radio" name="input_field_position" id="input-field-position-top" value="above" <?php checked($settings["input_field_position"], "above"); ?>/>
                                 <label for="input-field-position-top"><?php _e("Above standard title", "secondary_title"); ?></label>

                                 <input type="radio" name="input_field_position" id="input-field-position-bottom" value="below" <?php checked($settings["input_field_position"], "below"); ?>/>
                                 <label for="input-field-position-bottom"><?php _e("Below standard title", "secondary_title"); ?></label>
                              </div>
                              <p class="description"><?php echo sprintf(__('Defines whether input field for the secondary title should be displayed above or below<br />the standard title <strong>within the add/edit post/page area</strong> on the admin Dashboard.<br />See the <a href="%s" title="See the FAQ" target="_blank">FAQ</a> if you want to apply the same effect on your front end.', "secondary_title"), "http://www.koljanolte.com/wordpress/plugins/secondary-title/#faq-7"); ?></p>
                           </td>
                        </tr>
                        <tr>
                           <th>
                              <label for="column-position-left">
                                 <i class="fa fa-columns"></i>
                                 <?php _e("Column position", "secondary_title"); ?>:
                              </label>
                           </th>
                           <td>
                              <div class="radios">
                                 <input type="radio" name="column_position" id="column-position-left" value="left" <?php checked($settings["column_position"], "left"); ?>>
                                 <label for="column-position-left">
                                    <?php _e("Left of primary title", "secondary_title"); ?>
                                 </label>

                                 <input type="radio" name="column_position" id="column-position-right" value="right" <?php checked($settings["column_position"], "right"); ?>>
                                 <label for="column-position-right">
                                    <?php _e("Right of primary title", "secondary_title"); ?>
                                 </label>
                              </div>
                              <p class="description">
                                 <?php echo sprintf(__("Specifies the position of the secondary title in regard to the primary title on <a href=\"%s\">post overview</a> pages within the Dashboard.", "secondary_title"), get_admin_url() . "edit.php"); ?>
                              </p>
                           </td>
                        </tr>
                     </table>
                  </div>
               </div>
            </div>
         </div>

         <div id="buttons" class="buttons">
            <button type="submit" class="button-primary">
               <i class="fa fa-floppy-o"></i>
               <?php _e("Save Changes", "secondary_title"); ?>
            </button>

            <a href="<?php echo $reset_url; ?>" type="reset" class="button reset-button">
               <i class="fa fa-trash-o"></i>
               <?php _e("Reset Settings", "secondary_title"); ?>
            </a>
         </div>

         <?php wp_nonce_field("secondary_title_save_settings", "nonce"); ?>

         <div id="report-bug">
            <i class="fa fa-bug"></i>
            <?php echo sprintf(__('Found an error? Help making Secondary Title better by <a href="%s" title="Click here to report a bug" target="_blank">quickly reporting the bug</a>.', "secondary_title"), "http://www.wordpress.org/support/plugin/secondary-title#postform"); ?>
         </div>
      </form>
      <?php
   }