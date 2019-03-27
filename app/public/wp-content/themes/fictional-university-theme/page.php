<?php
get_header();

while(have_posts()) {
  the_post();?>
  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/ocean.jpg') ?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title"><?php the_title() ?></h1>
      <div class="page-banner__intro">
        <p>DONT FORGET TO REPLACE ME LATER</p>
      </div>
    </div>
  </div>

  <div class="container container--narrow page-section">

  <?php
  $theParent = wp_get_post_parent_id(get_the_ID()); // returns the parent ID of a child page, or 0 if a parent page
  if ($theParent) { ?>
    <div class="metabox metabox--position-up metabox--with-home-link">
      <p><a class="metabox__blog-home-link" href="<?php echo get_permalink($theParent)?>"><i class="fa fa-home" aria-hidden="true"></i> Back to <?php echo get_the_title($theParent); ?></a> <span class="metabox__main"><?php the_title() ?></span></p>
    </div>
    <?php }
  ?>

<?php
  $testArray = get_pages(array(
    'child_of' => get_the_ID() // returns list of children pages
  ));
  if($theParent or $testArray) { // to check if the page has a parent page or if it is a parent?>
    <div class="page-links">
      <h2 class="page-links__title"><a href="<?php echo get_permalink($theParent) ?>"><?php echo get_the_title($theParent) ?></a></h2>
      <ul class="min-list">
        <?php // for the right buttons
        if($theParent) { // if the page has a parent
          $findChildrenOf = $theParent; // want children of that parent
        } else {
          $findChildrenOf = get_the_ID(); // page is a parent, just get the ID
        }
          wp_list_pages(array(
            'title_li' => NULL,
            'child_of' => $findChildrenOf,
            'sort_column' => 'menu_order' // takes order from pages in admin
          )); ?>
      </ul>
    </div>
  <?php } ?>

    <div class="generic-content">
      <p><?php the_content() ?></p>

    </div>

  </div>



  <?php }

get_footer();

?>
