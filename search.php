<?php 

global $wp_query;
$search_query = get_search_query();

$args_page = array(
	'post_type' => 'page',
	'posts_per_page' => -1,
	's' => $search_query
);
$page_query = new WP_Query($args_page);

$args_post = array(
	'post_type' => 'post',
	'posts_per_page' => -1,
	's' => $search_query
);
$post_query = new WP_Query($args_post);


$total_results = $page_query->found_posts + $post_query->found_posts;

get_header(); ?>



<div class="c-search-header u-hero-pt ">

  <div class="c-search-header__wrapper o-wrapper o-wrapper--medium">        
    <div class="c-search-header__content">
        <h1 class="u-mb-4 u-h2">Search result</h1>
        <div class="c-search-form">
			<form action="/" class="result-form">
					<div class="c-search-form__row">
						<input type="text" name="s" placeholder="Search for a topic or keyword..." value="<?php echo esc_attr($search_query); ?>" required>
						<button class="c-button c-button--secondary" data-label="Search">Search</button>
					</div>
					<input type="hidden" name="sort" value="" id="js-field-sort">
					<input type="hidden" name="type" value="" id="js-field-type">
					<input type="hidden" name="action" value="search">
			</form>
		</div>
		
    </div>
  </div>

</div>


<section class="u-pt-10 u-pb-10 c-page-search">
	<div class="o-wrapper o-wrapper--medium">

		<div class="c-search-filter u-mb-4">
			<div class="c-search-filter__total" id="js-result-total">
				<?php echo $total_results ?> result<?php echo $total_results != 1 ? 's' : ''; ?> found
			</div>
			<a href="#" class="btn btn-default c-search-filter__button" id="js-filter-button"><i class="icon-filter"></i> Filter</a>
			<div class="c-search-filter__dropdown">

				<div class="c-search-filter__title">
					<i class="icon-filter"></i> Filter
					<a class="c-search-filter__close" id="js-filter-close"><i class="icon-times"></i></a>
				</div>

				<div class="c-dropdown single search" id="js-search-sorting">
					<div class="c-dropdown__label search">Relevance</div>
					<div class="c-dropdown__list search">
						<div class="c-dropdown__item selected" data-value="relevance">Relevance</div>
						<div class="c-dropdown__item" data-value="a-z">Alphabetical (A-Z)</div>
						<div class="c-dropdown__item" data-value="z-a">Alphabetical (Z-A)</div>
						<div class="c-dropdown__item" data-value="new">Newest to oldest</div>
						<div class="c-dropdown__item" data-value="old">Oldest to newest</div>
					</div>
				</div> <!-- .c-dropdown -->
				<div class="c-dropdown multiple search" id="js-search-type">
					<div class="c-dropdown__label search" data-label="Filter by type">Filter by type</div>
					<div class="c-dropdown__list search">
						<div class="c-dropdown__item" data-value="page">Pages</div>
						<div class="c-dropdown__item" data-value="post">News</div>
					</div>
				</div> <!-- .c-dropdown -->

				<div class="c-search-filter__save">
					<a class="c-button c-button--primary" data-label="Save and close" id="js-filter-save">Save and close</a> 
				</div>

			</div>
		</div> <!-- .c-search-filter -->

		<div class="c-result" id="js-search-result">


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

			<?php if ($post_query->have_posts()) : ?>
			<div class="c-result__section u-pt-5 u-pb-5">
				<h5>News</h5>
				<div class="c-search-items">
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


		</div> <!-- .c-search-result -->

	</div>
</section>

<?php get_footer(); ?>