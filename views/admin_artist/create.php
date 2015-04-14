<div id="c_content">
    
    <h1><?php echo $this->title ?></h1>
    
    <form action="<?php echo URL; ?>admin_artist/create" enctype="multipart/form-data" method="post" id="eFormUpload">
        
        <label>Name</label>
        <?php if (isset($this->errorMsg['artist_name'])) { echo '<p class="eFormWarning">' . ($this->errorMsg['artist_name']) . '</p>'; } ?>
        <input type="text" value="<?php if (isset($_POST['artist_name'])) { echo htmlspecialchars($_POST['artist_name']); } ?>" name="artist_name"/>

        <label>Description</label>
        <textarea name="artist_description"><?php if (isset($_POST['artist_description'])) { echo htmlspecialchars($_POST['artist_description']); } ?></textarea>

        <label>Background image</label>
        <select name="background_id">
            <option value="0">default</option>
            <?php foreach ($this->backgroundList as $key => $value) {
                echo '<option value="' . htmlspecialchars($value['background_id']) . '">' . htmlspecialchars($value['background_name']) . '</option>';
            } ?>
        </select>
        
        <hr/>
    
        <div class="contentControl">
            <input class="eButtonForm" type="submit" name="artist_submit" value="Create" />
            <a href="<?php echo URL; ?>admin_artist/index">Cancel</a>
        </div>

    </form>
    
</div>