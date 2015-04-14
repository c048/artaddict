<div id="c_content">
    <h1>Articles</h1>
    <table id="b_listData" cellpadding="0" cellspacing="0">
        
        <tr>
            <th class="eTableNanoColumn">
                <a href="<?php if (isset($this->sort) && $this->sort == 'article_id') { $l_sOrder = $this->linkOrder; } else { $l_sOrder = 'asc'; } echo URL . 'admin_article&sort=article_id&order='. $l_sOrder . '&page=' . $this->pageCount['current']; ?>">Id<?php if (isset($this->sort) && $this->sort == 'article_id') {echo '<img src="' . URL . 'public/assets/siteart/arrow_sort_' . $this->linkOrder . '.png"/>';} ?></a>
            </th>
            <th class="eTableMediumColumn">
                <a href="<?php if (isset($this->sort) && $this->sort == 'artist_name') { $l_sOrder = $this->linkOrder;} else { $l_sOrder = 'asc';} echo URL . 'admin_article&sort=artist_name&order='. $l_sOrder . '&page=' . $this->pageCount['current']; ?>">Artist<?php if (isset($this->sort) && $this->sort == 'artist_name') { echo '<img src="' . URL . 'public/assets/siteart/arrow_sort_' . $this->linkOrder . '.png"/>';} ?></a>
            </th>
            <th>
                <a href="<?php if (isset($this->sort) && $this->sort == 'article_name') { $l_sOrder = $this->linkOrder;} else { $l_sOrder = 'asc';} echo URL . 'admin_article&sort=article_name&order='. $l_sOrder . '&page=' . $this->pageCount['current']; ?>">Name<?php if (isset($this->sort) && $this->sort == 'article_name') { echo '<img src="' . URL . 'public/assets/siteart/arrow_sort_' . $this->linkOrder . '.png"/>';} ?></a>
            </th>
            <th>
                <a href="<?php if (isset($this->sort) && $this->sort == 'article_description') { $l_sOrder = $this->linkOrder;} else { $l_sOrder = 'asc';} echo URL . 'admin_article&sort=article_description&order='. $l_sOrder . '&page=' . $this->pageCount['current']; ?>">Description<?php if (isset($this->sort) && $this->sort == 'article_description') { echo '<img src="' . URL . 'public/assets/siteart/arrow_sort_' . $this->linkOrder . '.png"/>';} ?></a>
            </th>
            <th class="eTableSmallColumn">
                <a href="<?php if (isset($this->sort) && $this->sort == 'article_price') { $l_sOrder = $this->linkOrder;} else { $l_sOrder = 'asc';} echo URL . 'admin_article&sort=article_price&order='. $l_sOrder . '&page=' . $this->pageCount['current']; ?>">Price<?php if (isset($this->sort) && $this->sort == 'article_price') { echo '<img src="' . URL . 'public/assets/siteart/arrow_sort_' . $this->linkOrder . '.png"/>';} ?></a>
            </th>
            <th colspan="2"/>
        </tr>
        
        <?php foreach($this->articleList as $key => $value) :?>
        <tr>
            <td class="eRightSided"><?php echo htmlspecialchars($value['article_id']); ?></td>
            <td><?php if(empty($value['artist_name'])) {echo 'No Artist Selected';} else {echo htmlspecialchars($value['artist_name']);} ?></td>
            <td><?php echo htmlspecialchars($value['article_name']); ?></td>
            <td>
            <?php if(strlen($value['article_description'])>53) {
                echo htmlspecialchars(substr($value['article_description'], 0, 50) . '...'); 
            } else {
                echo $value['article_description'];
            }
            ?>
            </td>
            <td class="eRightSided"><?php if(empty($value['article_price'])) { echo 'Price on Request'; } else { echo htmlspecialchars($value['article_price']) . " &euro;"; } ?></td>
            <td class="eTailField"><a href="<?php echo URL . 'admin_article/edit/' . $value['article_id']; ?>">edit</a></td>
            <td class="eTailField eTableLast"><a href="<?php echo URL . 'admin_article/delete/' . $value['article_id']; ?>">delete</a></td>
        </tr>
        <?php endforeach; ?>
        
    </table>
    
    <?php if($this->pageCount['total']>1) :?>
    <div class="contentPager">
        <a <?php if($this->pageCount['current']==1) { echo 'class=hidden';} ?> href="<?php echo URL . 'admin_article&sort=' . $this->sort . '&order=' . $this->order . '&page=' . ($this->pageCount['current']-1); ?>"><img src="<?php echo URL ?>public/assets/siteart/arrow_sort_left.png"/>Prev</a>
        <p><?php for ($i=1; $i <= $this->pageCount['total']; $i++) { echo ' <a href="' . URL . 'admin_article&sort=' . $this->sort . '&order=' . $this->order . '&page=' . $i . '">' . $i . '</a> ';} ?></p>
        <a <?php if($this->pageCount['current']==$this->pageCount['total']) { echo 'class=hidden';} ?> href="<?php echo URL . 'admin_article&sort=' . $this->sort . '&order=' . $this->order . '&page=' . ($this->pageCount['current']+1); ?>">Next<img src="<?php echo URL ?>public/assets/siteart/arrow_sort_right.png"/></a>
    </div>
    <?php endif; ?>
    
    <div class="contentControl contentControlRight">
        <a href="<?php echo URL; ?>admin_article/create">Add new</a>
    </div>
</div>