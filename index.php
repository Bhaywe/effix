<?php get_header();

the_content();

if (is_user_logged_in()) {

    echo 'Welcome, registered user!';
} else {

    echo 'Welcome, visitor!';
};

get_footer();
