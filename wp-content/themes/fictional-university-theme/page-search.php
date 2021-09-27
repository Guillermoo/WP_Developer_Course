<?php
    while (have_posts()) {
        the_post();
    get_header();
    pageBanner();
?>

  

    <div class="container container--narrow page-section">

        <?php 
            $parent_id = wp_get_post_parent_id( get_the_ID() );
            if ($parent_id)  { ?>
            <div class="metabox metabox--position-up metabox--with-home-link">
                <p>
                <a class="metabox__blog-home-link" href="<?php echo get_permalink( $parent_id );  ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to <?php echo get_the_title($parent_id);  ?></a> <span class="metabox__main"><?php the_title();  ?></span>
                </p>
            </div>
        <?php }
            ?>


    <?php 
    
        $testArray = get_pages(array(
            'child_of' => get_the_ID()
        ));
     //Si es padre o es hijo. Es decir, si no tiene hijos no hará nada.
        if ($parent_id || $testArray) { ?>
    
      <div class="page-links">
        <h2 class="page-links__title"><a href="<?php echo get_permalink(get_the_ID() ); ?>"><?php echo the_title(); ?></a></h2>
        <ul class="min-list">

            <?php 
            
            if ($parent_id) {
                $findChildrenOf = $parent_id;
            }else{
                $findChildrenOf = get_the_ID();
            }

            $atributos = array(
                'depth'        => 0,
                'child_of'     => $findChildrenOf,
                'exclude'      => '',
                'title_li'     => NULL,
                'sort_column'  => 'menu_order, post_title'        
            );    
            wp_list_pages($atributos);     
            
            
            ?>
        </ul>
      </div>
    <?php } 
    
    get_search_form();
    
    ?>

    
</div>

<?php
    }
  get_footer();
?>