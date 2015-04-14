<div id="c_content">
    
    <h1>
        <?php echo $this->title; ?>
    </h1>
    
    <table id="b_listData" cellpadding="0" cellspacing="0">
        
        <tr>
            <th class="eTableTinyColumn">
                <a href="<?php if (isset($this->sort) && $this->sort == 'artist_order') { $l_sOrder = $this->linkOrder;} else { $l_sOrder = 'asc';} echo URL . 'admin_artist&sort=artist_order&order='. $l_sOrder . '&page=' . $this->pageCount['current']; ?>">Order<?php if (isset($this->sort) && $this->sort == 'artist_order') { echo '<img src="' . URL . 'public/assets/siteart/arrow_sort_' . $this->linkOrder . '.png"/>';} ?></a>
            </th>
            <th class="eTableMediumColumn">
                <a href="<?php if (isset($this->sort) && $this->sort == 'artist_name') { $l_sOrder = $this->linkOrder;} else { $l_sOrder = 'asc';} echo URL . 'admin_artist&sort=artist_name&order='. $l_sOrder . '&page=' . $this->pageCount['current']; ?>">Name<?php if (isset($this->sort) && $this->sort == 'artist_name') { echo '<img src="' . URL . 'public/assets/siteart/arrow_sort_' . $this->linkOrder . '.png"/>';} ?></a>
            </th>
            <th>
                <a href="<?php if (isset($this->sort) && $this->sort == 'artist_description') { $l_sOrder = $this->linkOrder;} else { $l_sOrder = 'asc';} echo URL . 'admin_artist&sort=artist_description&order='. $l_sOrder . '&page=' . $this->pageCount['current']; ?>">Description<?php if (isset($this->sort) && $this->sort == 'artist_description') { echo '<img src="' . URL . 'public/assets/siteart/arrow_sort_' . $this->linkOrder . '.png"/>';} ?></a>
            </th>
            <th class="eTableMediumColumn">
                <a href="<?php if (isset($this->sort) && $this->sort == 'background_name') { $l_sOrder = $this->linkOrder;} else { $l_sOrder = 'asc';} echo URL . 'admin_artist&sort=background_name&order='. $l_sOrder . '&page=' . $this->pageCount['current']; ?>">Background<?php if (isset($this->sort) && $this->sort == 'background_name') { echo '<img src="' . URL . 'public/assets/siteart/arrow_sort_' . $this->linkOrder . '.png"/>';} ?></a>
            </th>
            <th colspan="4"/>
        </tr>
        
        <?php foreach($this->artistList as $key => $value) :?>
        <tr>
            <td class="eRightSided"><?php echo htmlspecialchars($value['artist_order'], ENT_QUOTES, "UTF-8"); ?></td>
            <td><?php echo htmlspecialchars($value['artist_name'], ENT_QUOTES, "UTF-8"); ?></td>
            <td>
            <?php if(strlen($value['artist_description'])>78) {
                echo htmlspecialchars(substr($value['artist_description'], 0, 75) . '...', ENT_QUOTES, "UTF-8"); 
            } else {
                echo htmlspecialchars($value['artist_description'], ENT_QUOTES, "UTF-8");
            }
            ?>
            </td>
            <td><?php if(empty($value['background_name'])){ echo 'default';} else { echo htmlspecialchars($value['background_name'], ENT_QUOTES, "UTF-8"); } ?></td>
            <td class="eTailSort"><a href="<?php echo URL . 'admin_artist/ordering&sort=' . $this->sort . '&order=' . $this->order . '&page=' . $this->pageCount['current'] . '&move=';
                if ($this->sort == 'artist_order' && $this->order == 'desc') {echo 'dwn';} else {echo 'up';}
                echo '&pos=' . $value['artist_order']; ?>"><img src="<?php echo URL ?>public/assets/siteart/arrow_sort_asc.png"/></a></td>
            <td class="eTailSort"><a href="<?php echo URL . 'admin_artist/ordering&sort=' . $this->sort . '&order=' . $this->order . '&page=' . $this->pageCount['current'] . '&move=';
                if ($this->sort == 'artist_order' && $this->order == 'desc') {echo 'up';} else {echo 'dwn';}
                echo '&pos=' . $value['artist_order']; ?>"><img src="<?php echo URL ?>public/assets/siteart/arrow_sort_desc.png"/></a></td>
            <td class="eTailField"><a href="<?php echo URL . 'admin_artist/edit/' . $value['artist_id']; ?>">edit</a></td>
            <td class="eTailField eTableLast"><a href="<?php echo URL . 'admin_artist/delete/' . $value['artist_id']; ?>">delete</a></td>
        </tr>
        <?php endforeach; ?>
            
    </table>
    
    <?php if($this->pageCount['total']>1) :?>
    <div class="contentPager">
        <a <?php if($this->pageCount['current']==1) { echo 'class=hidden';} ?> href="<?php echo URL . 'admin_artist&sort=' . $this->sort . '&order=' . $this->order . '&page=' . ($this->pageCount['current']-1); ?>"><img src="<?php echo URL ?>public/assets/siteart/arrow_sort_left.png"/>Prev</a>
        <p><?php for ($i=1; $i <= $this->pageCount['total']; $i++) { echo ' <a href="' . URL . 'admin_artist&sort=' . $this->sort . '&order=' . $this->order . '&page=' . $i . '">' . $i . '</a> ';} ?></p>
        <a <?php if($this->pageCount['current']==$this->pageCount['total']) { echo 'class=hidden';} ?> href="<?php echo URL . 'admin_artist&sort=' . $this->sort . '&order=' . $this->order . '&page=' . ($this->pageCount['current']+1); ?>">Next<img src="<?php echo URL ?>public/assets/siteart/arrow_sort_right.png"/></a>
    </div>
    <?php endif; ?>
    
    <div class="contentControl contentControlRight">
        <a href="<?php echo URL; ?>admin_artist/create">Add new</a>
    </div>
</div>