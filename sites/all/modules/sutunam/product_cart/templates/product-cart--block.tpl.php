<?php
$url_checkout = url('node/21');
$language = $GLOBALS['language']->language;
$qty=0;
foreach($_SESSION['product_cart'] as $item){
    if(isset($item['quantity']))$qty+=(int)$item['quantity'];
}

foreach($_SESSION['product_cart_option'] as $item){
    if(isset($item['quantity']))$qty+=(int)$item['quantity'];
}

?>
<div class="cart-introduction">
    <div class="cart-service">
        <?php echo t('Demande de devis') ?>
        <span class="description"><?php echo t('Reponse sous 12h') ?></span>
    </div>
</div>
<div class="product-cart-view">
    <?php if (count($item_list) == 0 AND count($option_list) == 0) {


        ?>
        <a class="cart-number cart-empty" href="<?php echo $url_checkout ?>" ><span
                class="cart_title_mobile"><?php echo t(' Votre devis') ?></span><span class="number">0</span></a>
        <div class="product-cart-popup">
            <div class="product-cart-popup-header">
                <div class="popup-cart-left">
                    <span class="count-item"><?php echo 0 ?></span>
                    <span class="count-title"><?php echo t('Devis') ?></span>
                </div>
            </div>
            <div class="cart-checkout">
                <a href="<?php echo $url_checkout ?>"><?php echo t('Finalisez votre demande de devis') ?></a>
            </div>
        </div>
    <?php
    } else {
        $c = 0;
        foreach ($item_list as $items) {
            $c += count($items);
        }
        ?>
        <a class="cart-number cart-view" href="<?php echo $url_checkout ?>"><span
                class="cart_title_mobile"><?php echo t(' Votre devis') ?></span> <span
                class="number"><?php echo($qty) ?></span></a>
        <div class="product-cart-popup">
            <div class="product-cart-popup-header">
                <div class="popup-cart-left">
                    <span class="count-item"><?php echo($qty) ?></span>
                    <span class="count-title"><?php echo t('Demande de devis') ?></span>
                </div>
                <div class="popup-cart-right">
                    <a id="clear-cart" class="clear-cart" href="javascipt:void(0);"><?php echo t('Clear') ?></a>
                </div>
            </div>
            <div class="product-cart-popup-title">
                <span><?php echo t('Vos machines selectionneés') ?></span>
            </div>
            <ul class="product-cart-lists">
                <?php
                foreach ($item_list as $tid => $items) {
                    $term = taxonomy_term_load($tid);
                    echo '<li class="cart-category">' . $term->name . '</li>';

                    foreach ($items as $node) {
                        ?>
                        <li>
                            <div class="product-title"><?php echo $node->title?></div>
                            <div class="product-remove">
                                <button class="btn-product-cart-remove" type="product"
                                        data-pid="<?php echo $node->nid?>"><?php echo t('Remove')?></button>
                                <a href="<?php echo url('node/' . $node->nid)?>"><?php echo t('Voir fiche')?></a>
                            </div>
                        </li>
                    <?php
                    }
                }

                foreach ($option_list as $option) {
                    echo '<li class="cart-category">' . $option['category_product'][$language]->name . '
                    <div class="product-remove option">
                        <button class="btn-product-cart-remove" type="option" data-pid="' . $option['id'] . '">' . t('Remove') . '</button>
                    </div>
                </li>';
                    ?>
                <?php
                }
                ?>
            </ul>
            <div class="cart-checkout">
                <a href="<?php echo $url_checkout ?>"><?php echo t('Finalisez votre demande de devis') ?></a>
            </div>
        </div>
    <?php
    } ?>
</div>
<script>
    (function ($) {
        $(document).ready(function () {
            $('.btn-product-cart-remove').click(function () {
                var pdid = $(this).attr("data-pid");
                var type = $(this).attr("type");
                $.ajax({
                    url: '/ajax/product/cart/remove',
                    type: 'post',
                    data: {nid: pdid, type: type},
                    success: function (response) {
                        $('#block-product-cart-product-cart-block').replaceWith(response);

                    }
                })
            })
            $('.clear-cart').click(function (e) {
                e.preventDefault()
                $.ajax({
                    url: '/ajax/product/cart/remove_all',
                    type: 'post',
                    success: function (response) {
                        $('#block-product-cart-product-cart-block').replaceWith(response);

                    }
                })
            })
        })
    })(jQuery)
</script>