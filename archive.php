<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
get_header();
?>
<div id="content" class="section">


  <?php if (have_posts()) : ?>
   
    <div class="entry">
      <?php the_archive_title( '<h1 class="title">', '</h1>' ); ?>
      <?php
      global $paged;
      if ($paged == 0) {
         the_archive_description( '', '' );
      }
      ?>
    </div>

    <ul class="container docked">
      
      <?php
      $key = 0;
      while (have_posts()) : the_post();
      $key++;
        // cfvalue:field 
        if ($key % 3 == 0) {
          echo '<li class="box last">';
        }
        else if (($key - 1) % 3 == 0) {
          echo '<li class="box first">';
        }
        else {
          echo '<li class="box">';
        }

        echo get_marctv_teaser(get_the_ID(), true, '', 'medium', true, '', '', false);

        if ($key % 3 == 0 && $key < 6) {
          echo '</ul><ul class="container docked">';
        }
        
        echo '</li>';
      endwhile;

      echo '</ul>';

    else :
      if (is_category()) { // If this is a category archive
        printf("<h1 class='center'>Sorry, but there aren't any posts in the %s category yet.</h1>", single_cat_title('', false));
      } else if (is_date()) { // If this is a date archive
        echo("<h1>Sorry, but there aren't any posts with this date.</h1>");
      } else if (is_author()) { // If this is a category archive
        $userdata = get_userdatabylogin(get_query_var('author_name'));
        printf("<h1 class='center'>Sorry, but there aren't any posts by %s yet.</h1>", $userdata->display_name);
      } else {
        echo("<h1 class='center'>No posts found.</h1>");
      }
      get_search_form();
    endif;
    ?>

    <div class="nav-article">
        <?php the_posts_navigation(); ?>
    </div>


</div>

<?php get_footer(); ?>