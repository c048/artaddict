<div id="c_content">
    <h1><?php echo htmlspecialchars($this->title); ?></h1>
    
    <table id="b_listData" cellpadding="0" cellspacing="0">
        
        <tr>
            <th class="eTableMediumColumn"><a href="<?php if (isset($this->sort) && $this->sort == 'background_name') { $l_sOrder = $this->order;} else { $l_sOrder = 'asc';} echo URL . 'admin_background&sort=background_name&order='. $l_sOrder  . '&page=' . $this->pageCount['current']; ?>">Background Name<?php if (isset($this->sort) && $this->sort == 'background_name') { echo '<img src="' . URL . 'public/assets/siteart/arrow_sort_' . $this->order . '.png"/>';} ?></a></th>
            <th><a href="<?php if (isset($this->sort) && $this->sort == 'background_img') { $l_sOrder = $this->order;} else { $l_sOrder = 'asc';} echo URL . 'admin_background&sort=background_img&order='. $l_sOrder . '&page=' . $this->pageCount['current']; ?>">Background Image<?php if (isset($this->sort) && $this->sort == 'background_img') { echo '<img src="' . URL . 'public/assets/siteart/arrow_sort_' . $this->order . '.png"/>';} ?></a></th>
            <th colspan="2" />
        </tr>
        
        <?php foreach($this->backgroundList as $key => $value) { ?>
        <tr>
            <td><?php echo $value['background_name']; ?></td>
            <td><?php echo $value['background_img']; ?></td>
            <td class="eTailField"><a href="<?php echo URL . 'admin_background/edit/' . $value['background_id']; ?>">edit</a></td>
            <td class="eTailField eTableLast"><a href="<?php echo URL . 'admin_background/delete/' . $value['background_id']; ?>">delete</a></td>
        </tr>
        <?php } ?>
        
    </table>
    
    <?php if($this->pageCount['total']>1) { if($this->order == 'asc') {$l_sCurOrder= 'desc';} else {$l_sCurOrder= 'asc';}?>
    <div class="contentPager">
        
        <a <?php if($this->pageCount['current']==1) { echo 'class=hidden';} ?> href="<?php echo URL . 'admin_background&sort=' . $this->sort . '&order=' . $l_sCurOrder . '&page=' . ($this->pageCount['current']-1); ?>"><img src="<?php echo URL ?>public/assets/siteart/arrow_sort_left.png"/>Prev</a>
        <p><?php for ($i=1; $i <= $this->pageCount['total']; $i++) { echo ' <a href="' . URL . 'admin_background&sort=' . $this->sort . '&order=' . $l_sCurOrder . '&page=' . $i . '">' . $i . '</a> ';} ?></p>
        <a <?php if($this->pageCount['current']==$this->pageCount['total']) { echo 'class=hidden';} ?> href="<?php echo URL . 'admin_background&sort=' . $this->sort . '&order=' . $l_sCurOrder . '&page=' . ($this->pageCount['current']+1); ?>">Next<img src="<?php echo URL ?>public/assets/siteart/arrow_sort_right.png"/></a>
    
    </div>
    <?php } ?>
    
    <div class="contentControl contentControlRight">
        <a href="<?php echo URL; ?>admin_background/create">Add new</a>
    </div>
</div>