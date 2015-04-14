<div id="c_content">
    
    <h1>
        <?php echo $this->title; ?>
    </h1>
    
    <form action="<?php echo URL; ?>admin_article/edit/<?php echo $this->article['article_id'] ?>" enctype="multipart/form-data"  method="post" id="eFormUpload">
        
        <label>Article Name</label>
         <?php if (isset($this->errorMsg['article_name'])) { echo '<p class="eFormWarning">' . ($this->errorMsg['article_name']) . '</p>'; } ?>
        <input type="text" name="article_name" value="<?php if (isset($this->article['article_name'])) { echo $this->article['article_name']; } ?>"/>

        <label>Artist</label>
        <select name="artist_id">
            <option value="0">none</option>
            <?php foreach ($this->artistList as $key => $value) {
                echo '<option value="' . htmlspecialchars($value['artist_id']) . '"';
                if ($value['artist_id'] == $this->article['artist_id']) { echo 'selected'; }
                echo '>' . htmlspecialchars($value['artist_name']) . '</option>';
            } ?>
        </select>

        <label>Article price</label>
        <p class="eFormComment">Leave empty or "0" for "price on request".</p>
        <input type="text" name="article_price" value="<?php if (isset($this->article['article_price'])) { echo $this->article['article_price']; } ?>"/>

        <label>Article Description</label>
        <textarea name="article_description"><?php if (isset($this->article['article_description'])) { echo $this->article['article_description']; } ?></textarea>

        <label>Article Image</label>
        <?php   
            if (isset($this->errorMsg['article_img']))
                echo '<p class="eFormWarning">' . ($this->errorMsg['article_img']) . '</p>'; 
            if (isset($this->article['article_img']))
                echo '<img class="e_formImagePreview" src="' . URL . 'public/assets/product/' . $this->article['article_img'] . '" alt="preview_img" />'; 
        ?>
        <input type="file" name="article_img"/>
    
        <div class="contentControl">
            <input class="eButtonForm" type="submit" name="article_submit" value="Save" />
            <a href="<?php echo URL; ?>admin_article/index">Cancel</a>
        </div>
            
    </form>
    
</div>