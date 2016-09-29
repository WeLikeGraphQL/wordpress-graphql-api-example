<?php
   /**
    * Plugin Name:  Secondary Title
    * Plugin URI:   http://www.koljanolte.com/wordpress/plugins/secondary-title/
    * Description:  Adds a secondary title to posts, pages and custom post types.
    * Version:      1.9.0
    * Author:       Kolja Nolte
    * Author URI:   http://www.koljanolte.com
    * License:      GPLv2 or later
    * License URI:  http://www.gnu.org/licenses/gpl-2.0.html
    */

   /**
    * Stop script when the file is called directly.
    */
   if(!function_exists("add_action")) {
      return false;
   }

   /** Install default settings (if not set yet) */
   register_activation_hook(__FILE__, "secondary_title_install");

   /** Include plugin files */
   $include_directories = array(
      "includes"
   );

   /** Loop through the set directories */
   foreach((array)$include_directories as $include_directory) {
      $include_directory = plugin_dir_path(__FILE__) . $include_directory;
      $include_directory = realpath($include_directory);

      /** Skip directory if it's not a valid directory */
      if(!is_dir($include_directory)) {
         continue;
      }

      /** Gather all .php files within the current directory */
      $include_files = glob($include_directory . "/*.php");
      foreach((array)$include_files as $include_file) {
         /** Skip file if file is not valid */
         if(!is_file($include_file)) {
            continue;
         }

         /** Include current file */
         include_once($include_file);
      }
   }