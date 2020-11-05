<?php

namespace Effix;

use Effix\Subscription\Purchase;
use Effix\Subscription\Update;
use Effix\Utilities\Title;


// use DateTime;

class Init
{
    public function __construct()
    {
        add_action('init', [$this, 'call_cron']);
        add_action('init', [$this, 'change_title']);
        new Purchase();
    }
    public function call_cron()
    {
        new Update();
        // $timestamp = new DateTime('now');
        // wp_schedule_event($timestamp, 'daily', 'cron_job_effix');
    }

    public function change_title()
    {
        new Title();
    }
}
