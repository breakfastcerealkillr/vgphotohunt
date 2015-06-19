<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
$cakeDescription = 'VG Photo Hunt';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>
            <?= $cakeDescription ?>:
            <?= $this->fetch('title') ?>
        </title>
        <?= $this->Html->meta('icon') ?>
        <?= $this->Html->css('bootstrap.css') ?>
        <?= $this->Html->css('normalize.css') ?>
        <?= $this->Html->css('jquery.fancybox.css') ?>
        <?= $this->Html->css('webflow.css') ?>
        <?= $this->Html->css('vgph2.webflow.css') ?>

        <?= $this->Html->script('jquery') ?>
        <?= $this->Html->script('jquery-ui') ?>
        <?= $this->Html->script('jquery.fancybox') ?>
        <?= $this->Html->script('jflash') ?>
        <?= $this->Html->script('bootstrap') ?>
        <?= $this->Html->script('modernizr') ?>
        <?= $this->Html->script('webflow') ?>
        
        <?= $this->Html->meta('icon', 'img/favicon.png'); ?>
        <?= $this->fetch('css') ?>
        <?= $this->fetch('script') ?>
        <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.4.7/webfont.js"></script>
    </head>
    <body>
<header class="header">
    <div class="w-nav navbar1" data-collapse="medium" data-animation="default" data-duration="400" data-contain="1">
      <div class="w-container">
        <div class="div-navlogo">
          <div class="w-slider slider-header" data-animation="slide" data-duration="500" data-infinite="1" data-delay="4000" data-autoplay="1">
            <div class="w-slider-mask">
            <div class="w-slide"><?= $this->Html->image('beta.png', ['alt' => 'daddy']) ?></div>
              <div class="w-slide"><?= $this->Html->image('daddy.png', ['alt' => 'daddy']) ?></div>
              <div class="w-slide"><?= $this->Html->image('rawr.png', ['alt' => 'skyreeem']) ?></div>
              <div class="w-slide"><?= $this->Html->image('infected.png', ['alt' => 'zambos']) ?></div>
              <div class="w-slide"><?= $this->Html->image('hcrab.png', ['alt' => 'halflife']) ?></div>
              <div class="w-slide"><?= $this->Html->image('elite.png', ['alt' => 'halo']) ?></div>
              <div class="w-slide"></div>
            </div>
            <div class="w-slider-arrow-left"></div>
            <div class="w-slider-arrow-right"></div>
          </div>
          <?= $this->Html->link($this->Html->image('header-logo.png', ['alt' => 'logo']), ['controller' => 'pages', 'action' => 'index'], ['class'=>'w-nav-brand logo', 'escape' => false]); ?>
        </div>
        <div class="w-clearfix div-header">
        <?php if($loggedin == true) : ?>
        <div class="portrait-container">
            <div class="text-right" style="display: inline-block; margin-right: 10px;">
                <p style="font-size: 20pt;"><?= $this->Html->link($username,['controller' => 'Users', 'action' => 'view', $user_id], ['class' => 'header-text']); ?></p>
                <p><?= $this->Html->link('Log Out',['controller' => 'Users', 'action' => 'logout'], ['class' => 'header-text']); ?></p>
            </div>
            <div class="portrait-bg" style="background-image: url(<?= $this->request->base ?>/../portraits/<?= $current_user->current_portrait ?>.png);">
                <?php if($current_user->avatar != null) : ?>
                <div class="avatar-bg" style="background-image: url(<?= $this->request->base . '/../avatars/'. $current_user->avatar .'.png'; ?>)">
                    <?= $this->Html->image($this->request->base . '/../img/blank.png', ['url' => ['controller' => 'Users', 'action' => 'view', $user_id], 'style' => 'width: 100%; height: 100%;']); ?>
                </div>
                <?php else: ?>
                <div class="avatar-bg" style="background-image: url(<?= $this->request->base . '/../avatars/default.png'; ?>)">
                    <?= $this->Html->image($this->request->base . '/../img/blank.png', ['url' => ['controller' => 'Users', 'action' => 'view', $user_id], 'style' => 'width: 100%; height: 100%;']); ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php else: ?>
        <?= $this->Html->link('LOGIN',['controller' => 'Users', 'action' => 'login'], ['class' => 'button login']); ?>
        <?= $this->Html->link($this->Html->image('twitter.png', ['alt' => 'logo', 'class'=>'img-social']), 'https://twitter.com/GhettoHikes', ['class'=>'w-inline-block social-links', 'target'=>'_blank', 'escape' => false]); ?>
        <?= $this->Html->link($this->Html->image('youtube.png', ['alt' => 'logo', 'class'=>'img-social']), 'https://www.youtube.com/channel/UCs7yDP7KWrh0wd_4qbDP32g', ['class'=>'w-inline-block social-links', 'target'=>'_blank', 'escape' => false]); ?>
        <?= $this->Html->link($this->Html->image('facebook.png', ['alt' => 'logo', 'class'=>'img-social']), 'https://twitter.com/GhettoHikes', ['class'=>'w-inline-block social-links', 'target'=>'_blank', 'escape' => false]); ?>
        <?php endif; ?>
        </div>
      </div>
    </div>
</header>
<main class="main">
    <div class="container-nav">
        <?= $this->Html->link($this->Html->image('nav-buttons_01.png', ['class'=>'img-nav img-nav-left']), ['controller' => 'pages', 'action' => 'what'], ['class'=>'', 'escape' => false]); ?>
        <?= $this->Html->link($this->Html->image('nav-buttons_02.png', ['class'=>'img-nav img-nav-center']), ['controller' => 'hunts', 'action' => 'view'], ['class'=>'', 'escape' => false]); ?>
        <?= $this->Html->link($this->Html->image('nav-buttons_03.png', ['class'=>'img-nav img-nav-right']), ['controller' => 'hunts', 'action' => 'view'], ['class'=>'', 'escape' => false]); ?>
    </div>
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>

                

</main>
<footer class="footer">
  <div class="row">
    <div class="col-sm-2 col-sm-offset-4" style="display: flex; align-items: top; flex-direction: row; justify-content: space-between;">
        <div style="display: inline-block">
            
            <?= $this->Html->link('HOME', 'http://vgphotohunt.com', ['class' => 'footer-link']) ?><br />
            <?= $this->Html->link('ABOUT', ['controller' => 'Pages', 'action' => 'what'], ['class' => 'footer-link']) ?><br />
            <?= $this->Html->link('HUNTS', ['controller' => 'Hunts', 'action' => 'view'], ['class' => 'footer-link']) ?><br />
            <?= $this->Html->link('VOTE', ['controller' => 'Hunts', 'action' => 'view'], ['class' => 'footer-link']) ?>
        </div>
        <div class="text-right" style="display: inline-block;">
            <?= $this->Html->link('SIGN IN', ['controller' => 'Users', 'action' => 'login'], ['class' => 'footer-link']) ?><br />
            <?= $this->Html->link('SIGN UP', ['controller' => 'Users', 'action' => 'register'], ['class' => 'footer-link']) ?><br />
            <?= $this->Html->link('RESET PASSWORD', ['controller' => 'Users', 'action' => 'forgotPass'], ['class' => 'footer-link']) ?>
        </div>
        

    </div>
    <div class="col-sm-4 text-center">
        <div class="social-text">FIND US ON <br />
          <?= $this->Html->link($this->Html->image('twitter.png', ['alt' => 'logo', 'class'=>'img-social']), 'https://twitter.com/GhettoHikes', ['class'=>'w-inline-block social-links findus', 'target'=>'_blank', 'escape' => false]); ?>
          <?= $this->Html->link($this->Html->image('youtube.png', ['alt' => 'logo', 'class'=>'img-social']), 'https://www.youtube.com/channel/UCs7yDP7KWrh0wd_4qbDP32g', ['class'=>'w-inline-block social-links findus', 'target'=>'_blank', 'escape' => false]); ?>
          <?= $this->Html->link($this->Html->image('facebook.png', ['alt' => 'logo', 'class'=>'img-social']), 'https://twitter.com/GhettoHikes', ['class'=>'w-inline-block social-links findus', 'target'=>'_blank', 'escape' => false]); ?>
        </div>
    </div>
  </div>
  <div class="row">
      <div class="footer-text">@ 2015 BY VBH. All Rights Reserved.</div>
  </div>
</footer>
</body>
</html>