<div id="c_content">
    
    <h1>
        <?php echo $this->title; ?>
    </h1>
    
    <form action="<?php echo URL; ?>admin_article/create" enctype="multipart/form-data"  method="post" id="eFormUpload">
        
        <label>Article Name</label>
        <?php if (isset($this->errorMsg['article_name'])) { echo '<p class="eFormWarning">' . ($this->errorMsg['article_name']) . '</p>'; } ?>
        <input type="text" name="article_name" value="<?php if (isset($_POST['article_name'])) { echo htmlspecialchars($_POST['article_name']); }  ?>"/>

        <label>Artist</label>
        <select name="artist_id">
            <option value="0">none</option>
            <?php foreach ($this->artistList as $key => $value) {
                echo '<option value="' . htmlspecialchars($value['artist_id']) . '"';
                if (isset($_POST['artist_id']) && $value['artist_id'] == $_POST['artist_id']) {
                    echo ' selected ';
                }
                echo '>' . htmlspecialchars($value['artist_name']) . '</option>';
            } ?>
        </select>

        <label>Article price</label>
        <p class="eFormComment">Leave empty or "0" for "price on request".</p>
        <input type="text" name="article_price" value="<?php if (isset($_POST['article_price'])) { echo htmlspecialchars($_POST['article_price']); }  ?>"/>

        <label>Article Description</label>
        <textarea name="article_description"><?php if (isset($_POST['article_description'])) { echo htmlspecialchars($_POST['article_description']); }  ?></textarea>

        <label>Article Image</label>
        <?php if (isset($this->errorMsg['article_img'])) { echo '<p class="eFormWarning">' . ($this->errorMsg['article_img']) . '</p>'; } ?>
        <input type="file" name="article_img"/>

        <hr/>    
        
        <div class="contentControl">
            <input class="eButtonForm" type="submit" name="article_submit" value="Submit" />
            <a href="<?php echo URL; ?>admin_article/index">Cancel</a>
        </div>
        
    </form>
    
</div>