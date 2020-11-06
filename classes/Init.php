<?php

namespace Effix;

use Effix\Subscription\Purchase;
use Effix\Subscription\Update;

use Effix\Utilities\Title;
use Effix\Utilities\Menu;
use Effix\Utilities\Scripts;
use Effix\Utilities\Widgets;
use Effix\Utilities\Supports;

class Init
{
    public function __construct()
    {
        new Scripts();
        new Menu();
        new Update();
        new Title();
        new Purchase();
        new Widgets();
        new Supports();
    }
}
