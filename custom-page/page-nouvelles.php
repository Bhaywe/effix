<?php

/**
 * Template Name: Nouvelles
 *
 */
get_header();
?>

<section class="news container">
     <h3 class="heading-tertiary u-margin-bottom-big">Nouvelles</h3>
     <nav class="news__categorie flex u-margin-bottom-big">

          <?php
          $categories = get_categories();
          foreach ($categories as $categorie) { ?>
          <?php echo '<div class="news__categorie--item"><a href="' . get_category_link($categorie->term_id) . '">' . $categorie->name . '</a></div>';
          } ?>
     </nav>
     <?php

     // affiche les 6 articles les plus récents


     $wp_query = new WP_Query(array('posts_per_page' => 6));

     if ($wp_query->have_posts()) :
          while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
               <article class="news__article flex u-margin-bottom-big">
                    <div class="news__article--thumb">
                         <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
                    </div>
                    <div class="news__article--item">
                         <div class="news__text">
                              <h4 class="heading-quaternary u-margin-bottom-xsmall"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                   <h5 class="heading-category u-padding-bottom-normal"> Catégorie:
                                        <?php foreach ((get_the_category()) as $cat) {
                                             echo $cat->name;
                                        }
                                        ?>
                                   </h5>
                                   <p><?php the_excerpt('Suite'); ?></p>
                         </div>
                    </div>

               </article>


     <?php endwhile;
     endif; ?>

</section>

<?php
get_footer();
?>