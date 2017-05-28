
<div>
    <?php
    foreach($products as $product){
        $image_src = image_style_url('thumbnail', $product->field_image['und'][0]['uri']);
        ?>
        <div class="item">
            <div><img src="<?php echo $image_src?>"></div>
            <div><?php echo $product->title?></div>
            <div class="action_bottom">
                <div class="product-cart-add">
                    <button data-pid="<?php echo $product->nid?>" class="btn-product-cart"><span><?php print t('Ajouter au devis')?></span></button>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
</div>