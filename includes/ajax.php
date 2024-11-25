<?php

add_action("wp_ajax_get_news", "get_news");
add_action("wp_ajax_nopriv_get_news", "get_news");

function get_news() {

    $data_ppp = $_POST['posts_per_page'];
    $data_paged = $_POST['paged'];
    $data_cats = $_POST['cats'] ? $_POST['cats'] : array();
    $data_search = $_POST['search'];

    // split the categories
    $data_cats = explode(',', $data_cats);
    
    $args = array(
      'post_type' => 'post',
      'posts_per_page' => $data_ppp,
      'post_status' => 'publish',
      'paged' => $data_paged
    );
  
    if ($data_search) {
        $args['s'] = $data_search;
    }

    if (count($data_cats) > 0) {
      $args['category__in'] = $data_cats;
    }

    //print_r($args);
  
    $the_query = new WP_Query($args);
  
    $paged = $data_paged ? $data_paged : 1;
    $pagenum = $paged < 1 ? 1 : $paged;
    $first = ( ( $pagenum - 1 ) * $posts_per_page ) + 1;
    $last = $first + $the_query->post_count - 1;
    $result_text = "Showing $first - $last of $the_query->found_posts articles";
  
    ob_start();
    ?>
  
      <div class="c-blog-list__wrapper">
        <div class="c-posts">
          <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>	
          <?php include get_template_directory() . '/template-parts/post-item.php'; ?>
          <?php endwhile; ?>
        </div>
      </div> <!-- .blog-list__wrapper -->
  
      <div class="c-blog-list__pages" id="js-filter-pagination">
        <?php
            $base = '/news/';
            $orig_req_uri = $_SERVER['REQUEST_URI'];
            // Overwrite the REQUEST_URI variable
            $_SERVER['REQUEST_URI'] = $base;

            base_ajax_post_navi($the_query->max_num_pages, $paged);

            // Restore the REQUEST_URI variable
            $_SERVER['REQUEST_URI'] = $orig_req_uri;
        ?>
      </div>
  
    <?php
    $output = ob_get_contents();
    ob_end_clean();
  
    $result = array();
    $result['data'] = $output;
    $result['text'] = $result_text;
    $result['total'] = $the_query->found_posts;
  
  
    echo json_encode($result);
  die();
}




add_action("wp_ajax_search", "search");
add_action("wp_ajax_nopriv_search", "search");

function search() {

  $data_sort = $_POST['sort'];
  $data_type = $_POST['type'] ? $_POST['type'] : 'team-member,page,post';
  $data_search = $_POST['s'];
  $total_results = 0;

  // split the types
  $data_type = explode(',', $data_type);
  
  if (in_array('page', $data_type)) {
    $args_page = array(
      'post_type' => 'page',
      'posts_per_page' => -1,
      'post_status' => 'publish',
      's' => $data_search
    );

    $args_page = returnSorting($args_page, $data_sort);
    //print_r($args_page);
    $page_query = new WP_Query($args_page);
    $total_results += $page_query->found_posts;
  }

  if (in_array('post', $data_type)) {
    $args_post = array(
      'post_type' => 'post',
      'posts_per_page' => -1,
      'post_status' => 'publish',
      's' => $data_search
    );

    $args_post = returnSorting($args_post, $data_sort);
    //print_r($args_post);
    $post_query = new WP_Query($args_post);
    $total_results += $post_query->found_posts;
  }





  ob_start();
  ?>
  <?php if (in_array('page', $data_type)) : ?>
    <?php if ($page_query->have_posts()) : ?>
      <div class="c-result__section u-pt-5 u-pb-5">
      <h5>Pages</h5>
      <div class="c-search-items">
        <?php while ($page_query->have_posts()) : $page_query->the_post(); ?>	
          <div class="c-search-item">
            <div class="c-search-item__item">
              <div class="c-search-item__content">
                <a href="<?php the_permalink() ?>" class="c-search-item__title"><?php the_title() ?></a>
                <div class="c-search-item__desc"><?php the_excerpt(); ?></div>
                <a href="<?php the_permalink(); ?>" class="c-link c-link--secondary">Read more</a>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
        </div>
      </div>
      <?php endif; ?>
    <?php endif; ?>

    <?php if (in_array('post', $data_type)) : ?>
      <?php if ($post_query->have_posts()) : ?>
      <div class="c-result__section u-pt-5 u-pb-5">
        <h5>News</h5>
        <div class="b-posts">
        <?php while ($post_query->have_posts()) : 
              $post_query->the_post(); 
              $image = get_field('post_image');
              $excerpt = get_field('post_excerpt');
        ?>	
          <div class="c-search-item c-search-item--post">
            <div class="c-search-item__item">
              <div class="c-search-item__image" style="background-image:url(<?php echo $image['sizes']['thumbnail']; ?>)"></div>
              <div class="c-search-item__content">
                <a href="<?php the_permalink() ?>" class="c-search-item__title"><?php the_title() ?></a>
                <div class="c-search-item__desc"><?php echo $excerpt; ?></div>
                <a href="<?php the_permalink(); ?>" class="c-link c-link--secondary">Read more</a>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
        </div>
      </div>
      <?php endif; ?>
    <?php endif; ?>



  <?php
  $output = ob_get_contents();
  ob_end_clean();

  $result = array();
  $result['data'] = $output;
  $result['total'] = $total_results;

  echo json_encode($result);

  die();
}


function returnSorting($args = array(), $data_sort) {
  if ($data_sort) {
    switch ($data_sort) {

      case 'relevance': 
        $args['orderby'] = 'relevance'; 
        break;
      case 'menu_order': 
        $args['orderby'] = 'menu_order'; 
        $args['order'] = 'asc';
        break;
      case 'a-z': 
        $args['orderby'] = 'title'; 
        $args['order'] = 'asc'; 
        break;
      case 'z-a': 
        $args['orderby'] = 'title'; 
        $args['order'] = 'desc'; 
        break;
      case 'new': 
        $args['orderby'] = 'date'; 
        $args['order'] = 'desc'; 
        break;
      case 'old': 
        $args['orderby'] = 'date'; 
        $args['order'] = 'asc'; 
        break;

    }

  }    
  
  return $args;
  
}



function custom_ajax_login() {
    // Verify nonce for security
    check_ajax_referer('ajax-login-nonce', 'security');

    // Get user credentials
    $username = $_POST['username'];
    $password = $_POST['password'];
    $redirect_to = $_POST['redirect_to'];

    // Try to sign in the user
    $user = wp_signon(array(
        'user_login'    => $username,
        'user_password' => $password,
        'remember'      => true
    ));

    // Check for errors
    if (is_wp_error($user)) {
        wp_send_json_error(array('message' => $user->get_error_message()));
    } else {
        // Successful login
        wp_send_json_success(array('redirect_url' => $redirect_to)); // Redirect to home
    }

    wp_die();
}

// Register the AJAX actions for logged-in and logged-out users
add_action('wp_ajax_custom_ajax_login', 'custom_ajax_login');
add_action('wp_ajax_nopriv_custom_ajax_login', 'custom_ajax_login');
