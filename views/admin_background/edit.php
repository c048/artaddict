<div id="c_content">
    
    <h1><?php echo htmlspecialchars($this->title) ?></h1>
    
    <form action="<?php echo URL; ?>admin_background/edit/<?php echo $this->background['background_id'] ?>" enctype="multipart/form-data" method="post" id="eFormUpload">
        
        <?php if (isset($this->errorMsg)) { echo '<p class="eFormWarning">' . $this->errorMsg . '</p>'; } ?>
        
        <label>Name</label>
        <?php if (isset($this->errorMsg['background_name'])) { echo '<p class="eFormWarning">' . ($this->errorMsg['background_name']) . '</p>'; } ?>
        <input type="text" name="background_name" value="<?php if (isset($this->background['background_name'])) { echo $this->background['background_name']; } ?>"/>
        
        <label>Image</label>
        <?php 
            if (isset($this->errorMsg['background_img'])) { echo '<p class="eFormWarning">' . ($this->errorMsg['background_img']) . '</p>'; }
            if (isset($this->background['background_img'])) { echo '<img class="e_formImagePreview" src="' . URL . 'public/assets/bkgrnd/' . $this->background['background_img'] . '" alt="preview_img" />'; } 
        ?>
        <p class="eFormComment">Drag & drop a file in the area below or click on the area to select a file.</p>
        <input type="file" name="background_img"/>
        
        <hr/>
        
        <div class="contentControl">
            <input class="eButtonForm" type="submit" name="background_submit" value="Save" />
            <a href="<?php echo URL; ?>admin_background/index">Cancel</a>
        </div>
        
    </form>
    
</div>