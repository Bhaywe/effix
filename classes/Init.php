<?php

namespace Effix;

use Effix\Subscription\Purchase;
use Effix\Subscription\Update;
use Effix\Utilities\Title;


class Init
{
    public function __construct()
    {
        add_action('init', [$this, 'update_subscription']);
        add_action('init', [$this, 'change_title']);
        new Purchase();
    }

    public function update_subscription()
    {
        new Update();
    }

    public function change_title()
    {
        new Title();
    }
}
