<!doctype html>
<html>
    <head>
        <title><?php if (isset($this->title)) { echo $this->title; } else { echo PROJECTNAME; }; ?></title>
        <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/style.css" />
        <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/themes/smoothness/jquery-ui.css" />
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/jquery-ui.min.js"></script>
        <script src="<?php echo URL; ?>public/js/custom.js"></script>
        <?php
            if (isset($this->js)){
                foreach ($this->js as $js) {
                    echo '<script src="' . URL . 'views/' . $js . '"></script>';
                }
            }
        ?>
    </head>
    <body>
        
        <?php Session::init(); ?>
        <div id="header">
            <?php if (Session::get('loggedIn') == false):?>
                <a href="<?php echo URL; ?>index">Index</a>
                <a href="<?php echo URL; ?>help">Help</a>
            <?php endif; ?>
            <?php if (Session::get('loggedIn') == true):?>
                <a href="<?php echo URL; ?>dashboard">Dashboard</a>
                <a href="<?php echo URL; ?>note">Notes</a>
                
                <?php if (Session::get('role') == 'owner'):?>
                    <a href="<?php echo URL; ?>user">Users</a>
                <?php endif; ?>
                    
                <a href="<?php echo URL; ?>dashboard/logout">Logout</a>
            <?php else: ?>
                <a href="<?php echo URL; ?>login">Login</a>
            <?php endif; ?>
        </div>
        
        <div id="content">