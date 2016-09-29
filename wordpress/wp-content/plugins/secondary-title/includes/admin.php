<?php
   /**
    * This file contains the functions used within the admin area.
    * The code for the plugin's settings page is stored separately within /includes/settings.php.
    *
    * @package    Secondary Title
    * @subpackage Administration
    */

   /**
    * Stop script when the file is called directly.
    */
   if(!function_exists("add_action")) {
      return false;
   }

   /**
    * Build the - invisible - secondary title input on edit pages
    * to let jQuery displaying it (see admin.js).
    *
    * @since 0.1
    *
    * @return bool
    */
   function init_secondary_title_admin_posts() {
      $title_input_position = secondary_title_get_setting("input_field_position");

      /** Verify if Secondary Title's settings allow the input box to be displayed */
      if(!secondary_title_verify_admin_page()) {
         return false;
      }

      ?>
      <input type="hidden" id="secondary-title-input-position" value="<?php echo $title_input_position; ?>"/>
      <input type="text" size="30" id="secondary-title-input" class="secondary-title-input" placeholder="<?php _e("Enter secondary title here", "secondary_title"); ?>" name="secondary_post_title" hidden value="<?php echo get_post_meta(get_the_ID(), "_secondary_title", true); ?>"/>
      <?php
      return true;
   }

   add_action("admin_head", "init_secondary_title_admin_posts");

   function secondary_title_change_column_position() {
      $column_position = secondary_title_get_setting("column_position");
      if($column_position !== "left") {
         return;
      }
      ?>
      <script type="text/javascript">
         jQuery(document).ready(
            function () {
               var secondaryTitleHeadCell, primaryTitleHeadCell, posts, primaryTitleColumn, secondaryTitleColumn, post;

               secondaryTitleHeadCell = jQuery("#secondary_title");
               primaryTitleHeadCell   = jQuery("#title");
               posts                  = jQuery("#the-list").find("tr");

               /** Stop script if there's no secondary title column */
               if (secondaryTitleHeadCell.length === 0) {
                  return false;
               }

               /**
                * Function to move columns, including header cells.
                *
                * @since 1.0.0
                */
               function moveColumns() {
                  secondaryTitleHeadCell.insertBefore(primaryTitleHeadCell);
                  posts.each(
                     function () {
                        post = jQuery(this);
                        post.find(".column-secondary_title").insertBefore(post.find(".column-title"));
                     }
                  );
               }

               moveColumns();
            }
         );
      </script>
      <?php
   }

   add_action("admin_head", "secondary_title_change_column_position");