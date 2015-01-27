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

        <?= $this->Html->script('jquery') ?>
        <?= $this->Html->script('bootstrap') ?>


        <?= $this->fetch('css') ?>
        <?= $this->fetch('script') ?>
    </head>
    <body>
        <div class="page-header">
            <div class="row">
                <div class="col-md-12">
                    <h1><?= $this->Html->link('VG Photo Hunt', '/') ?></h1>
                    <span class="pull-right">
                        <?php if (isset($user_id)): ?>
                            Hi, <?= $username ?>!
                            <br>
                            <?= $this->Html->link('Profile', ['controller' => 'users', 'action' => 'profile']) ?>
                            <br>
                            <?= $this->Html->link('Logout', ['controller' => 'users', 'action' => 'logout']) ?>
                        <?php else: ?>
                            <?= $this->Html->link('Login', ['controller' => 'users', 'action' => 'login']) ?>
                            <br>
                            <?= $this->Html->link('Register', ['controller' => 'users', 'action' => 'register']) ?>
                        <?php endif ?>
                    </span>
                </div>
            </div>
        </div>

        <?= $this->Flash->render() ?>

        <div class="row">
            <?= $this->fetch('content') ?>
        </div>
        <?= $this->Html->script('popovers') ?>
    </body>
</html>
