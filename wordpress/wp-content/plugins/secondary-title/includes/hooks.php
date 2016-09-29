<?php
   /**
    * This file contains the hooks used for Secondary Title.
    * Hooks are functions that modify WordPress core functions
    * and thus allow to change their output.
    *
    * @package    Secondary Title
    * @subpackage Global
    */

   /**
    * Stop script when the file is called directly.
    *
    * @since 0.1
    */
   if(!function_exists("add_action")) {
      return false;
   }

   /**
    * Loads the text domain for localization.
    *
    * @since 0.1
    */
   function secondary_title_init_translations() {
      $translation_path = plugin_dir_path(__FILE__) . "/../languages/" . get_site_option("WPLANG") . ".mo";

      load_textdomain("secondary_title", $translation_path);
   }

   add_action("init", "secondary_title_init_translations");

   /**
    * Updates the secondary title when "Edit post" screen
    * is being saved.
    *
    * @since 0.1
    *
    * @param $post_id
    *
    * @return mixed
    */
   function secondary_title_edit_post($post_id) {
      if(!isset($_POST["secondary_post_title"])) {
         return false;
      }

      /** Don't save on autosave */
      if(defined("DOING_AUTOSAVE") && DOING_AUTOSAVE) {
         return false;
      }

      /** Don't save if user doesn't have necessary permissions */
      if(isset($_POST["post_type"]) && "page" === $_POST["post_type"]) {
         if(!current_user_can("edit_page", $post_id)) {
            return false;
         }
      }
      else {
         if(!current_user_can("edit_post", $post_id)) {
            return false;
         }
      }

      return update_post_meta($post_id, "_secondary_title", stripslashes(esc_attr($_POST["secondary_post_title"])));
   }

   add_action("save_post", "secondary_title_edit_post");

   /**
    * Adds a "Secondary title" column to the posts/pages
    * overview (edit.php).
    *
    * @since 0.7
    *
    * @param $columns
    *
    * @return array
    */
   function secondary_title_overview_columns($columns) {
      $new_columns = array();

      foreach($columns as $column_slug => $column_title) {
         /** Insert the secondary title before the "author" column */

         if($column_slug === "author") {
            $new_columns["secondary_title"] = __("Secondary title", "secondary_title");
         }

         $new_columns[$column_slug] = $column_title;
      }

      return $new_columns;
   }

   /**
    * Displays the extra column for the post types for which
    * the secondary title has been activated.
    *
    * @since 0.7
    */
   function secondary_title_init_columns() {
      $allowed_post_types = (array)secondary_title_get_setting("post_types");
      $post_types         = get_post_types(
         array(
            "public" => true
         )
      );

      foreach($post_types as $post_type) {
         /** Add "Secondary title" column to activated post types */

         if(!isset($allowed_post_types[0]) || in_array($post_type, $allowed_post_types, false)) {
            /** Adding columns */
            add_filter("manage_{$post_type}_posts_columns", "secondary_title_overview_columns");

            /** Adding columns content */
            add_filter("manage_{$post_type}_posts_custom_column", "secondary_title_overview_column_content", 10, 2);
         }
      }
   }

   /** Display the column unless deactivated by filter */
   if(apply_filters("secondary_title_show_overview_column", true)) {
      add_action("admin_init", "secondary_title_init_columns");
   }

   /**
    * Displays the secondary title and lets
    * jQuery move it into the column.
    *
    * @param $column
    * @param $post_id
    *
    * @since 0.7
    */
   function secondary_title_overview_column_content($column, $post_id) {
      if($column === "secondary_title") {
         the_secondary_title($post_id);
      }
   }

   /**
    * If auto show function is set, replace the post titles
    * with custom title format.
    *
    * @since 0.1
    *
    * @param $title
    *
    * @return mixed
    */
   function secondary_title_auto_show($title) {
      global $post;

      /** Keep the standard title */
      $standard_title = $title;

      /** Don't do "auto show" when on admin area or if the post is not a valid post */
      if(!isset($post->ID) || is_admin()) {
         return $standard_title;
      }

      $secondary_title = get_secondary_title($post->ID, "", "", true);

      /** Validate secondary title */
      if(!$secondary_title || get_option("secondary_title_auto_show") === "off" || $title !== wptexturize($post->post_title) || is_admin()) {
         return $standard_title;
      }

      /** Apply title format */
      $format = str_replace('"', "'", stripslashes(get_option("secondary_title_title_format")));
      $title  = str_replace("%title%", $title, $format);
      $title  = str_replace("%secondary_title%", html_entity_decode($secondary_title), $title);

      /** Only display if title is within the main loop */
      if(secondary_title_get_setting("only_show_in_main_post") === "on") {
         global $wp_query;
         if(!$wp_query->in_the_loop) {
            return $standard_title;
         }
      }

      return $title;
   }

   add_filter("the_title", "secondary_title_auto_show");

   /**
    * Loads scripts and styles.
    *
    * @since 0.1
    */
   function secondary_title_scripts_and_styles() {
      $plugin_folder = plugin_dir_url(dirname(__FILE__));

      /** Scripts */
      wp_enqueue_script(
         "secondary-title-script-admin",
         "{$plugin_folder}scripts/admin.js"
      );
      wp_enqueue_script(
         "secondary-title-script-admin",
         "{$plugin_folder}scripts/admin.js"
      );

      wp_enqueue_style(
         "secondary-title-settings",
         "{$plugin_folder}styles/admin.css"
      );

      /** Styles */
      wp_enqueue_style(
         "secondary-font-awesome",
         "{$plugin_folder}fonts/font-awesome/css/font-awesome.min.css",
         array(),
         "4.4.0"
      );
   }

   add_action("admin_enqueue_scripts", "secondary_title_scripts_and_styles");

   /**
    * Initialize setting on admin interface.
    *
    * @since 0.1
    */
   function init_admin_settings() {
      /** Creates a new page on the admin interface */
      add_options_page(__("Settings", "secondary_title"), "Secondary Title", "manage_options", "secondary-title", "secondary_title_settings_page");
   }

   add_action("admin_menu", "init_admin_settings");

   /**
    * Registers the %secondary_title% tag as a
    * permalink tag.
    *
    * @since 0.8
    */
   function secondary_title_permalinks_init() {
      add_rewrite_tag("%secondary_title%", "([^&]+)");
   }

   add_action("init", "secondary_title_permalinks_init");

   /**
    * @param $permalink
    * @param $post
    *
    * @since 1.5.4
    *
    * @return mixed
    **/
   function secondary_title_modify_permalink($permalink, $post) {
      $secondary_title = get_secondary_title($post->ID);
      $secondary_title = sanitize_title_for_query($secondary_title);
      $placeholder     = "%secondary_title%";

      if($secondary_title) {
         $permalink = str_replace($placeholder, $secondary_title, $permalink);
      }
      else {
         /** Remove placeholder from permalink if no secondary title exists */
         $permalink = str_replace($placeholder, "", $permalink);
      }

      return $permalink;
   }

   add_filter("post_link", "secondary_title_modify_permalink", 10, 2);

   /**
    * Modifies the post titles in RSS feeds.
    *
    * @param $original_title
    *
    * @since 1.7
    *
    * @return string
    */
   function secondary_title_modify_feed_title($original_title) {
      global $post;

      /** Gather necessary settings */
      $auto_show            = secondary_title_get_setting("auto_show");
      $feed_title_auto_show = secondary_title_get_setting("feed_auto_show");
      $title                = $original_title;

      /** Only modify title if setting is set and auto show setting is off */
      if($feed_title_auto_show === "on" && $auto_show === "off") {
         $feed_title_format = secondary_title_get_setting("feed_title_format");
         $secondary_title   = get_secondary_title($post->ID);

         /** Only modify title if post actually has a secondary title */
         if($secondary_title) {
            $title        = $feed_title_format;
            $replacements = array(
               "%title%"           => $post->post_title,
               "%secondary_title%" => $secondary_title
            );

            /** Replace placeholders with replacements */
            foreach((array)$replacements as $placeholder => $replacement) {
               $title = str_replace($placeholder, $replacement, $title);
            }
         }
      }

      return (string)$title;
   }

   add_filter("the_title_rss", "secondary_title_modify_feed_title");

   /**
    * @param $pieces
    *
    * @since 1.8.0
    *
    * @return mixed
    */
   function secondary_title_extend_search($pieces) {
      if(is_search() && !is_admin()) {
         global $wpdb;

         $custom_field = "_secondary_title";
         $keywords     = explode(" ", get_query_var("s"));
         $query        = "((meta_key = '$custom_field')";

         foreach($keywords as $word) {
            $query .= " AND (wptest.meta_value  LIKE '%{$word}%')) OR ";
         }

         $pieces["where"] = str_replace(
            "((({$wpdb->posts}.post_title LIKE '%",
            "( {$query} (({$wpdb->posts}.post_title LIKE '%",
            $pieces["where"]
         );

         $pieces["join"] .= " INNER JOIN {$wpdb->postmeta} AS wptest ON ({$wpdb->posts}.ID = wptest.post_id)";
         $pieces["groupby"] = "{$wpdb->posts}.ID";
      }

      return $pieces;
   }

   /**
    * Extend WordPress search to include custom fields
    *
    * http://adambalee.com
    */

   /**
    * Joins posts and postmeta tables
    *
    * @param $join
    *
    * @since 1.9.0
    *
    * @return string
    */
   function secondary_title_search_join($join) {
      global $wpdb;

      if(is_search()) {
         $join .= " LEFT JOIN " . $wpdb->postmeta . " ON " . $wpdb->posts . ".ID = " . $wpdb->postmeta . ".post_id ";
      }

      return $join;
   }

   /**
    * Modifies the search query with posts_where.
    *
    * @param $where
    *
    * @since 1.9.0
    *
    * @return mixed
    */
   function secondary_title_search_where($where) {
      global $wpdb;

      if(is_search()) {
         $where = preg_replace(
            "/\(\s*" . $wpdb->posts . ".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
            "(" . $wpdb->posts . ".post_title LIKE $1) OR (" . $wpdb->postmeta . ".meta_value LIKE $1)",
            $where
         );
      }

      return $where;
   }

   /**
    * Prevents duplicates.
    *
    * @param $where
    *
    * @since 1.9.0
    *
    * @return string
    */
   function secondary_title_search_distinct($where) {
      if(is_search()) {
         return "DISTINCT";
      }

      return $where;
   }

   if(secondary_title_get_setting("include_in_search") === "on") {
      add_filter("posts_join", "secondary_title_search_join");
      add_filter("posts_where", "secondary_title_search_where");
      add_filter("posts_distinct", "secondary_title_search_distinct");
   }