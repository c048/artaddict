<div id="c_userControl">
    <p>
    <?php 
    if (isset($_SESSION['user_name'])) { 
        $l_sName = $_SESSION['user_name'];
        echo "Logged in as $l_sName | ";
    } 
    ?><a href="<?php echo URL; ?>admin_artist/logout">Log out</a></p>
</div>