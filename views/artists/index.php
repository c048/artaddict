<section id="cSingleColumn">
    <div id="cSingleColumnArticles">
        <article class='bSingleColumnArticle'>
            <div class='eContentText'>
                <h4>Artists</h4>
                <p>
                    ArtAddict only offers work from known artists.
                </p>

                <ul>
                <?php
                    foreach ($this->artists as $key => $value) {
                        print '<li><a href=' . URL . 'artists/view/' . $value['artist_id'] . '>' . $value['artist_name'] . '</a></li>';
                    }
                ?>
                </ul>
                <p>
                    Check back often to discover new offers!
                </p>
            </div>
        </article>
    </div>
</section>