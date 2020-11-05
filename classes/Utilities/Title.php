<?php

namespace Effix\Utilities;

class Title
{
    public function __construct()
    {
        $this->change_post_title();
    }

    public function change_post_title()
    {
        $connected_title = 'Mon compte';
        $visitor_title = 'Se connecter';

        if (is_user_logged_in()) {
            $post_update = array(
                'ID'         => 9,
                'post_title' => $connected_title
            );
            wp_update_post($post_update);
        } else {
            $post_update = array(
                'ID'         => 9,
                'post_title' => $visitor_title
            );
            wp_update_post($post_update);
        }
    }
}
