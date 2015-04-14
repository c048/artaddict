<div id="c_login">
    <h1>Artaddict</h1><br/>
    <form action="./login/run" method="post" enctype="multipart/form-data" id="eFormUpload">
        <label>Username</label>
        <input type="text" value="<?php //echo ("check('element0')");  ?>" name="login"/>
        <label>Password</label>
        <input type="password" value="<?php //echo ("check('element1')");  ?>" name="password"/>
        
        <div style="display: none;">
            <label>Spam Protection: Please don't fill this in</label>
            <textarea name="comment" rows="1" cols="1"></textarea>
        </div>
        <input class="eButtonForm" type="submit" name="submit" value="Submit" />
    </form>
</div>