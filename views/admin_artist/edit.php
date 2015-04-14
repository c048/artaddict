<div id="c_content">
    
    <h1>
       <?php echo htmlspecialchars($this->title) ?>
    </h1>
    
    <form action="<?php echo URL; ?>admin_artist/edit/<?php echo $this->artist['artist_id'] ?>" method="post" enctype="multipart/form-data" id="eFormUpload">

        <label>Name</label>
        <?php if (isset($this->errorMsg['artist_name'])) { echo '<p class="eFormWarning">' . ($this->errorMsg['artist_name']) . '</p>'; } ?>
        <input type="text" value="<?php if (isset($this->artist['artist_name'])) { echo $this->artist['artist_name']; } ?>" name="artist_name"/>

        <label>Description</label>
        <textarea name="artist_description"><?php if (isset($this->artist['artist_description'])) { echo $this->artist['artist_description']; } ?></textarea>
        
        <label>Background image</label>
        <select name="background_id">
            <option value="0">default</option>
            <?php foreach ($this->backgroundList as $key => $value) {
                echo '<option value="' . htmlspecialchars($value['background_id']) . '"';
                if ($value['background_id'] == $this->artist['background_id']) { echo 'selected'; }
                echo '>' . htmlspecialchars($value['background_name']) . '</option>';
            } ?>
        </select>
        <hr/>
    
        <div class="contentControl">
            <input class="eButtonForm" type="submit" name="artist_submit" value="Save" />
            <a href="<?php echo URL; ?>admin_artist/index">Cancel</a>
        </div>
        
    </form>
    
</div>