<?php 
    get_header(); ?>

    <div class="page-banner">
        <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('./images/ocean.jpg');?>);"></div>
        <div class="page-banner__content container container--narrow">
        <h1 class="page-banner__title">All Events</h1>
        <div class="page-banner__intro">
            <p>See what is going on in our world</p>
        </div>
        </div>  
    </div>

    <div class="container container--narrow page-section">
    <?php 
        while(have_posts( )) {
        the_post(); ?>
        <div class="event-summary">
            <a class="event-summary__date t-center" href="#">
                <span class="event-summary__month"><?php
                    $eventDate = new DateTime(get_field('event_date'));
                    echo $eventDate->format('M')
                    ?></span>
                <span class="event-summary__day"><?php 
                    $eventDate = new DateTime(get_field('event_date'));
                    echo $eventDate->format('n')
                ?></span>
                </a>
                <div class="event-summary__content">
                <h5 class="event-summary__title headline headline--tiny"><a href="<?php echo get_permalink( )?>"><?php the_title()?></a></h5>
                <p>Bring poems you&rsquo;ve wrote to the 100 building this Tuesday for an open mic and snacks. <a href="<?php echo get_permalink( )?>" class="nu gray">Learn more</a></p>
                </div>
            </div>
            <?php }
            //create pagination links whenever we get more than 10 post 
            echo paginate_links(  );
        ?>
    <hr class="section-break">

    <p>Looking fr a recap of past events? <a href="<?php echo site_url('/past-events')?>">Check out our past events page</a>
    </div>
    <?php get_footer( );
    ?>