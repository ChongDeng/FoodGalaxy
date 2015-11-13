<?php
include ('food_galaxy_fns.php');
  // The shopping cart needs sessions, so start one  
   
   $search_key = $_GET['search_key'];
   do_html_header("Category: ".$search_key);
   $food_array = get_foods_of_category($search_key);
   display_foods_of_category($food_array);
   
   do_html_footer();
?>