<nav id="cMainNav">
        <ul>
                <li><a href="<?php print URL; ?>index">home</a></li>
                <li class="eListFold">
                        <a href="<?php print URL; ?>artists">artists</a>
                        <ul>
                            <?php foreach ($this->artists as $key => $value): ?>
                                <li><a href="<?php print URL . 'artists/view/' . $value['artist_id']; ?>"><?php print $value['artist_name']; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                </li>
                <li><a href="<?php print URL; ?>events">events</a></li>
                <li><a href="<?php print URL; ?>shipping">shipping & payment</a></li>
                <li><a href="<?php print URL; ?>yourwork">your work here</a></li>
                <li><a href="<?php print URL; ?>about">about us</a></li>
                <li><a href="<?php print URL; ?>contact">contact us</a></li>
        </ul>
        <?php if(isset($this->artist)) : ?>
        <h2>About <?php print htmlspecialchars($this->artist['artist_name'], ENT_QUOTES, "UTF-8"); ?></h2>
        <p><?php print nl2br($this->artist['artist_description']); ?></p>
        <?php endif; ?>
</nav>
