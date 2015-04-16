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
        <?= $this->Html->css('webflow.css') ?>
        <?= $this->Html->css('vgph2.webflow.css') ?>

        <?= $this->Html->script('jquery') ?>
        <?= $this->Html->script('jflash') ?>
        <?= $this->Html->script('bootstrap') ?>
        <?= $this->Html->script('modernizr') ?>

        <?= $this->fetch('css') ?>
        <?= $this->fetch('script') ?>
        <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.4.7/webfont.js"></script>
    </head>
    <body>
    <div class="w-section header">
    <div class="w-nav navbar1" data-collapse="medium" data-animation="default" data-duration="400" data-contain="1">
      <div class="w-container">
        <div class="w-clearfix div-navlogo">
          <div class="w-slider slider-header" data-animation="slide" data-duration="500" data-infinite="1" data-delay="4000" data-autoplay="1">
            <div class="w-slider-mask">
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
        <div class="w-clearfix div-header"><a class="button login" href="#">LOGIN</a>
          <?= $this->Html->link($this->Html->image('twitter.png', ['alt' => 'logo', 'class'=>'img-social']), 'https://twitter.com/GhettoHikes', ['class'=>'w-inline-block social-links', 'target'=>'_blank', 'escape' => false]); ?>
          <?= $this->Html->link($this->Html->image('youtube.png', ['alt' => 'logo', 'class'=>'img-social']), 'https://www.youtube.com/channel/UCs7yDP7KWrh0wd_4qbDP32g', ['class'=>'w-inline-block social-links', 'target'=>'_blank', 'escape' => false]); ?>
          <?= $this->Html->link($this->Html->image('facebook.png', ['alt' => 'logo', 'class'=>'img-social']), 'https://twitter.com/GhettoHikes', ['class'=>'w-inline-block social-links', 'target'=>'_blank', 'escape' => false]); ?>
        </div>
        <div class="w-nav-button">
          <div class="w-icon-nav-menu"></div>
        </div>
      </div>
    </div>
  </div>
  <div class="w-section nav">
    <div class="w-container container-nav"><?= $this->Html->link($this->Html->image('nav-buttons_03.png', ['alt' => 'logo', 'class'=>'img-nav']), ['controller' => 'pages', 'action' => 'index'], ['class'=>'', 'target'=>'_blank', 'escape' => false]); ?>
        <?= $this->Html->link($this->Html->image('nav-buttons_02.png', ['alt' => 'logo', 'class'=>'img-nav join']), ['controller' => 'pages', 'action' => 'index'], ['class'=>'', 'target'=>'_blank', 'escape' => false]); ?>
        <?= $this->Html->link($this->Html->image('nav-buttons_01.png', ['alt' => 'logo', 'class'=>'img-nav']), ['controller' => 'pages', 'action' => 'index'], ['class'=>'', 'target'=>'_blank', 'escape' => false]); ?>
    </div>
  </div>
  <div class="w-section main">
    <div class="main-boarder">
      <div class="w-container main-container">
        <div class="w-row main-row">
            <?= $this->fetch('content') ?>
        </div>
      </div>
    </div>
  </div>             
  <div class="w-section footer">
    <div class="w-container">
      <div class="w-row">
        <div class="w-col w-col-6 footer-index">
          <div class="w-row index-inner">
            <div class="w-col w-col-4">
              <div class="social-text">INDEX</div>
            </div>
            <div class="w-col w-col-4">
              <div class="w-clearfix links"><a class="footer-link" href="#">HOME</a><a class="footer-link" href="#">ABOUT US</a><a class="footer-link" href="#">VOTE</a><a class="footer-link" href="#">PROFILE</a>
              </div>
            </div>
            <div class="w-col w-col-4">
              <div class="w-clearfix links"><a class="footer-link" href="#">LOGIN</a><a class="footer-link" href="#">SIGNUP</a><a class="footer-link" href="#">RESET_PASSWORD</a>
              </div>
            </div>
          </div>
          <div class="index-title">This is some text inside of a div block.</div>
        </div>
        <div class="w-col w-col-6 footer-social">
          <div class="div-social">
            <div class="social-text">FIND US ON</div>
          <?= $this->Html->link($this->Html->image('twitter.png', ['alt' => 'logo', 'class'=>'img-social']), 'https://twitter.com/GhettoHikes', ['class'=>'w-inline-block social-links findus', 'target'=>'_blank', 'escape' => false]); ?>
          <?= $this->Html->link($this->Html->image('youtube.png', ['alt' => 'logo', 'class'=>'img-social']), 'https://www.youtube.com/channel/UCs7yDP7KWrh0wd_4qbDP32g', ['class'=>'w-inline-block social-links findus', 'target'=>'_blank', 'escape' => false]); ?>
          <?= $this->Html->link($this->Html->image('facebook.png', ['alt' => 'logo', 'class'=>'img-social']), 'https://twitter.com/GhettoHikes', ['class'=>'w-inline-block social-links findus', 'target'=>'_blank', 'escape' => false]); ?>
          </div>
        </div>
      </div>
    </div>
    <div class="footer-text">@ 2015 BY VBH. All Rights Reserved.</div>
  </div>
  <script type="text/javascript" src="js/webflow.js"></script>
    </body>
</html>
