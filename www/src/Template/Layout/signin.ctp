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
$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
    <head>
        <?php echo $this->Html->charset(); ?>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
              <title> <?php echo $cakeDescription; ?>: <?php echo $this->fetch('title'); ?></title>
              <?php echo $this->Html->meta('icon'); ?>

              <!-- Font Awesome -->
              <?php echo $this->Html->css('/node_modules/font-awesome/css/font-awesome.min.css');?>
              <!-- Bootstrap core CSS -->
              <?php echo $this->Html->css('/node_modules/mdbootstrap/css/bootstrap.min.css'); ?>

              <!-- Material Design Bootstrap -->
              <?php echo $this->Html->css('/node_modules/mdbootstrap/css/mdb.min.css'); ?>
              <!-- Your custom styles (optional) -->
              <?php echo $this->Html->css('/node_modules/mdbootstrap/css/style.css'); ?>

              <!-- Toastr Modern Notification for MDB -->
              <?php echo $this->Html->css('/node_modules/toastr/build/toastr.min.css'); ?>

              <!-- JQuery -->
              <?php echo $this->Html->script('/node_modules/mdbootstrap/js/jquery-3.1.1.min.js'); ?>
              <?php //echo $this->Html->script('/node_modules/mdbootstrap/js/popper.min.js'); ?>

              <!-- Bootstrap core JavaScript -->
              <?php echo $this->Html->script('/node_modules/mdbootstrap/js/bootstrap.min.js'); ?>

              <?php echo $this->fetch('meta'); ?>
              <?php echo $this->fetch('css'); ?>
              <?php echo $this->fetch('script'); ?>
    </head>
    <body>
        

        <main>
            <?php echo $this->Flash->render(); ?>
            <?php echo $this->fetch('content'); ?>
        </main>

        <!-- SCRIPTS -->
        <!-- Bootstrap tooltips -->
        <?php echo $this->Html->script('/node_modules/mdbootstrap/js/tether.min.js'); ?>
        <!-- MDB core JavaScript -->
        <?php echo $this->Html->script('/node_modules/mdbootstrap/js/mdb.min.js'); ?>

        <!--toastr modern notification-->
        <?php echo $this->Html->script('/node_modules/toastr/build/toastr.min.js'); ?>
        
        <!--Load initial for infinite-scroll-->
        <?php //echo $this->Html->script('/node_modules/infinite-scroll/dist/infinite-scroll.pkgd.min.js');?>
        <?php echo $this->element('common/utilityScript');?>
        <?php echo $this->element('modal/modal');?>
        <!--EEN SCRIPT SECTION-->
    </body>
</html>
