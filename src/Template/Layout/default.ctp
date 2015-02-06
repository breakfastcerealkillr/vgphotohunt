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
        <?= $this->Html->css('vgphotohunt.css') ?>

        <?= $this->Html->script('jquery') ?>
        <?= $this->Html->script('bootstrap') ?>


        <?= $this->fetch('css') ?>
        <?= $this->fetch('script') ?>
    </head>
    <body>
        <div class="page-header cc">
            <div class="row">
                <div class="col-md-12">
                    <div class="Grid grid-bottom">
                        <div class="Grid-cell grid-1of2 logoside">
                            <div class="logobg">
                                <?= $this->Html->image('logo.png', ['class' => 'logoimg', 'alt' => 'logo', 'url' => ['controller' => 'pages', 'action' => 'index']]) ?>
                            </div>
                        </div>
                        <div class="Grid-cell grid-1of2 rightside">
                            <div class="logindiv">
                                <?php if ($loggedin): ?> 
                                    <?= $this->Html->image('header_login.png', ['alt' => 'logout', 'url' => ['controller' => 'users', 'action' => 'logout']]) ?>
                                <?php else: ?>
                                    <?= $this->Html->image('header_login.png', ['alt' => 'login', 'url' => ['controller' => 'users', 'action' => 'login']]) ?>
                                <?php endif; ?>
                            </div>
                            <div class="navcontainer">
                                <div class="hbuttondiv">
                                    <?= $this->Html->image('header_what.png', ['class' => 'hbutton', 'alt' => 'about', 'url' => ['controller' => 'pages', 'action' => 'what']]) ?>
                                </div>
                                <div class="hbuttondiv">
                                    <?= $this->Html->image('header_join.png', ['class' => 'hbutton', 'alt' => 'register', 'url' => ['controller' => 'users', 'action' => 'register']]) ?>
                                </div>
                                <div class="hbuttondiv">
                                    <?= $this->Html->image('header_vote.png', ['class' => 'hbutton', 'alt' => 'vote', 'url' => ['controller' => 'hunts', 'action' => 'openvotes']]) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container maincontainer">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
        <?= $this->Html->script('popovers') ?>
        <div style="margin-bottom: 100px;"></div>
    </body>
</html>
