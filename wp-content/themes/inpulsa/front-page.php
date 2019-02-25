<?php get_header(); ?>

<?php $args_blog = array(
    'post_type' => 'projets',
    'posts_per_page' => 6
);
$req_blog = new WP_Query($args_blog); ?>




<?php if ($req_blog->have_posts()): ?>

<section class="container-fluid section-accueil d-flex justify-content-center align-items-center">
    <h1>
      <a href="" class="typewrite" data-period="2000" data-type='[ "Une ambiance qui motive", "Une méthode qui fait ses preuves", "Une filière pleine davenir", "Une reconversion qui me réussit" ]'>
        <span class="wrap"></span>
      </a>
    </h1>
    
</section>
<section class="container section-presentation d-flex flex-column justify-content-center align-items-center">
    <div class="lapromo ">
        <h2 class="text-center">La Promo 23</h2>
        <p class="text-center">Access Code School</p>
        <hr class="text-center">
    </div>
    <div class="text-presentation">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-4 d-flex flex-column justify-content-start align-items-center">
                <img src="../../../gravit/agile.png" alt="" class="mb-4">
                <h3 class="text-center">Méthode</h3>
                <p class="">À travers des projets nous apprenons à utiliser les languages et outils de dévelopement web. La méthode agile nous donne la possibilité de travailler selon nos préférences ce qui armonise le travail en équipe et permet de retenir plus facilement.</p>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-4 d-flex flex-column justify-content-start align-items-center">
                <img src="../../../gravit/polyvalence.png" alt="" class="mb-4">
                <h3 class="text-center">Polyvalence</h3>
                <p class="">Pour arriver à un projet fini, il est souvent nécessaire d'avoir des connaissances en front-end et back end. Le front est plus axé sur se que l'utilisateur voit, le back lui concerne la partie fonctionement du projet. Nous avons la chance d'aborder les deux cotés se qui nous permet de devenir autonome.</p>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-4 d-flex flex-column justify-content-start align-items-center">
                <img src="../../../gravit/realisme.png" alt="" class="mb-4">
                <h3 class="text-center">Réalisme</h3>
                <p class="">Parce que le monde du travail est plein d'exigences et demande du professionnalisme, nous passons 2 mois en entreprise afin de pratiqué ce que nous voyons pendant la formation. Cela nous permet de nous projeté vers un futur emploi dans le web.</p>
            </div>
        </div>
    </div>
</section>
<div class="container-fluid img-codeur">

</div>
<section id="blog-front" class="section-projet d-flex flex-column justify-content-center align-items-center">
    <h4 class="text-center mb-5">Nos projets récents</h4>
    <img src="../../../gravit/lg_logo_langues.png" alt="techno" class="techno mb-5">
    <div class="container-fluid all-projets">
        <div class="container">
            <div class="row">
                
                <?php while($req_blog->have_posts() ): $req_blog->the_post(); ?>
                
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 mb-3 d-flex flex-column justify-content-center align-items-center projets">
                    

                    <div class="panel panel-default">
                        <div class="panel-body">
                            <?php the_content(); ?>
                        </div>
                      
                    </div>  
                </div>
            
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>
    </div>

</section>

<?php endif; ?>

<?php get_footer(); ?>


<!-- <div class="image-projet">
<div class="panel-heading">
                        <h2 class="text-center"><?php the_title(); ?></h2>
                    </div>

  <div class="panel-footer">
                            <p class="text-center">
                            <?php
                                    echo inpulsa_give_me_meta_01(
                                        esc_attr( get_the_date( 'c') ),
                                        esc_html( get_the_date()),
                                        get_the_category_list( ', '),
                                        get_the_tag_list('', ', ')
                                    ); ?>
                            </p>
                        </div>


    <?php the_post_thumbnail('medium',
        array('class' => 'img-fluid aligncenter img-projet' ) ); ?>
</div> 