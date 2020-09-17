<?php 
    get_header(); ?>

    <div class="page-banner">
        <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('./images/ocean.jpg');?>);"></div>
        <div class="page-banner__content container container--narrow">
        <h1 class="page-banner__title">Past Events</h1>
        <div class="page-banner__intro">
            <p>Recap of the past events</p>
        </div>
        </div>  
    </div>

    <div class="container container--narrow page-section">
    <?php 
            $today = date('Ymd');
            $pastEvents = new WP_Query(array(
            //this fuction make sure pagination work, cuz we are using a custume query
            'paged'=> get_query_var('paged', 1),
            'post_type' => 'event',
            'meta_key' => 'event_date',
            'orderby' => 'meta_value_num',
            'order' => 'ASC',
            //check that the passed events wont sbe display in the upcoming event section
            'meta_query' => array(
                array(
                'key' => 'event_date',
                'compare' => '<',
                'value' => $today,
                'type' => 'numeric'
                )
            )
            ));

            while($pastEvents->have_posts( )) {
                $pastEvents->the_post(); ?>
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
            echo paginate_links( array(
            //need to be use when using a custume query
                'total' => $pastEvents->max_num_pages
            ));
        ?>
        </div>
        <?php get_footer( );
        ?>