<!doctype html>
<html lang="en">
    <head>
        <title><?php if (isset($this->title)) { echo PROJECTNAME . ' | ' . htmlspecialchars($this->title); } else { echo PROJECTNAME; }; ?></title>
        <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/style.css" />
        <link rel="icon" href="<?php echo URL; ?>public/assets/siteart/favicon.ico" type="image/x-icon">
        <script src="<?php echo URL; ?>public/js/script_base.js"></script>
        <?php
            if (isset($this->js)){
                foreach ($this->js as $js) {
                    echo '<script src="' . URL . 'public/js/' . $js . '.js"></script>';
                }
            }
        ?>
        
        <meta charset="UTF-8">
        
        <!--[if lt IE 9]>
            <script>
                document.createElement('header');
                document.createElement('figure');
                document.createElement('nav');
                document.createElement('section');
                document.createElement('article');
                document.createElement('aside');
                document.createElement('footer');
                document.createElement('hgroup');
            </script>
        <![endif]-->
        
        <style>
            body {background-image: url('<?php if(isset($this->artist['background_img'])) { print  URL . 'public/assets/bkgrnd/' . $this->artist['background_img'];} elseif (isset($this->background)) { print URL . 'public/assets/bkgrnd/' . $this->background; } else { print URL . 'public/assets/bkgrnd/bg.jpg'; }?>');}
        </style>
    </head>
    <body>
        <div id="c_wrapper">