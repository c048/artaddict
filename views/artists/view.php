<section id="cSingleColumn">
    <div id="cSingleColumnArticles">
        <div class='bSingleColumnArticle'>
            <header class='eContentText'>
                <h4><?php echo htmlspecialchars($this->artist['artist_name'], ENT_QUOTES, "UTF-8"); ?></h4>
            </header>
            
            <?php foreach($this->products as $key => $value) :?>
            <article class="bContentProduct"s>
                <figure class="eProductImage">
                    <a class="eProductHeroImg" href="<?php echo URL . 'public/assets/product/' . $value['article_img'] ?>"><img class="product_image_thumb" src="<?php echo URL . 'public/assets/product/thumb/' . $value['article_img'] ?>" alt="<?php echo $value['article_name']; ?>_img"/></a>
                </figure>
                <div class="bProductInfo" data-id="<?php echo ($value['article_id']); ?>" data-name="<?php echo ($value['article_name']); ?>" data-price="<?php echo ($value['article_price']); ?>" data-thumb="<?php echo URL . 'public/assets/product/thumb/' . $value['article_img'] ?>">
                    <h2><?php echo ($value['article_name']); ?></h2>
                    <p><?php echo (nl2br($value['article_description'])); ?></p>
                    <div class="eProductPrice">
                        <?php if (!empty($value['article_price'])) :?>
                        <p><?php echo ($value['article_price'] . " &euro;"); ?></p>
                        <input class="eButtonProduct" type="button" value="Add to cart" />
                        <?php else : ?>
                        <a class="eButtonProduct" href="<?php echo URL . 'contact'; ?>">Price on request</a>
                        <?php endif; ?>
                    </div>
                </div>
            </article>
            <?php endforeach;?>
            
        </div>
    </div>
</section>