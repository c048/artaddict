<div id="c_content">
    
    <h1><?php echo htmlspecialchars($this->title) ?></h1>
    
    <form action="<?php echo URL; ?>admin_background/create" enctype="multipart/form-data" method="post" id="eFormUpload">
        
        <label>Name</label>
        <?php if (isset($this->errorMsg['background_name'])) { echo '<p class="eFormWarning">' . ($this->errorMsg['background_name']) . '</p>'; } ?>
        <input type="text" name="background_name" value="<?php if (isset($_POST['background_name'])) { echo htmlspecialchars($_POST['background_name']); } ?>"/>
        
        <label>Image</label>
        <?php if (isset($this->errorMsg['background_img'])) { echo '<p class="eFormWarning">' . ($this->errorMsg['background_img']) . '</p>'; } ?>
        <p class="eFormComment">Drag & drop a file in the area below or click on the area to select a file.</p>
        <input type="file" name="background_img"/>
        
        <hr/>
        
        <div class="contentControl contentControlLeft">
            <input class="eButtonForm" type="submit" name="background_submit" value="Create" />
            <a href="<?php echo URL; ?>admin_background/index">Cancel</a>
        </div>
        
    </form>
    
</div>