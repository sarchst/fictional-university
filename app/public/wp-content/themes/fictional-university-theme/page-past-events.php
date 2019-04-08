
<?php
get_header();
pageBanner(array(
  'title'=>'Past Events',
  'subtitle'=>'A recap of our past events.'
));
?>


<div class="container container--narrow page-section">
  <?php
  $today = date('Ymd');
  $pastEvents = new WP_Query(array( // gets the posts
    'paged' => get_query_var('paged', 1),
    'post_type' => 'event',
    'orderby' => 'meta_value_num', // order by cutstom array_count_values
    'meta_key' => 'event_date',
    'order' => 'ASC',
    'meta_query' => array(
      array(

        'key' => 'event_date',
        'compare' => '<',
        'value' => $today,
        'type' => 'numeric'
      )
    )

  ));
  while($pastEvents->have_posts()) {
    $pastEvents->the_post();
    get_template_part('template-parts/content-event'); }
  echo paginate_links(array(
    'total' => $pastEvents->max_num_pages
  ));
  ?>

</div>



<?php
get_footer();
?>
