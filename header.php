<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>EFFIX</title>
</head>

<body>

     <header class="header">
          <div class="flex header__box">
               <div class="header__logo">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/logo-effix.png" alt="Logo Effix">
               </div>
               <nav class="main-nav u-margin-bottom-big container" id="nav-menu">
                    <?php wp_nav_menu(
                         array(
                              'theme_location' => 'main_nav',
                              'container' => 'ul',
                              'menu_class' => 'main-nav__menu container-big flex'
                         )
                    ); ?>
               </nav>
               <nav class="login-nav" id="login-menu">
                    <?php wp_nav_menu(
                         array(
                              'theme_location' => 'login_nav',
                              'container' => 'ul',
                              'menu_class' => 'login-nav__menu flex'
                         )
                    ); ?>
               </nav>
          </div>
     </header>
     <main>