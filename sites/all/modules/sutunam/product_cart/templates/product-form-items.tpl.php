
<table class="tbl-cart-products" border="1" style="width: 100%">
    <thead>
    <tr>
        <td class="category_name"><?php echo t('Type machine')?></td>
        <td class="product_name"><?php echo t('Modèle')?></td>
        <td class="qty"><?php echo t('quantité')?></td>
        <td class="view_more"></td>
        <td class="delete_title"><?php echo t('Delete')?></td>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach($products as $product){
        $term=taxonomy_term_load($product->field_category['und'][0]['tid']);
        $term = i18n_taxonomy_localize_terms($term);
        ?>
        <tr>
            <td class="category-name"><?php echo $term->name?><div class="product_name_mobile"><?php echo $product->title?></div></td>
            <td class="product-name"><?php echo $product->title?></td>
            <td class="qty">
                <!--<input class="quantity" data-type="product" type="text" min="1" data-pid="<?php echo $product->nid?>" name="quanity_<?php echo $product->nid?>" value="<?php echo $session['product_cart'][$product->nid]['quantity']?>">-->
                <select class="quantity" data-type="product" type="text" min="1" data-pid="<?php echo $product->nid?>" name="quanity_<?php echo $product->nid?>" >
                    <?php
                    for($i=1;$i<=20;$i++){
                        echo '<option '.($session['product_cart'][$product->nid]['quantity']==$i?'selected="selected"':'').' value="'.$i.'">'.$i.'</option>';
                    }
                    ?>
                </select>
            </td>
            <td class="view-link">
                <!--<a href="<?php echo file_create_url($product->field_file['und'][0]['uri'])?>"><?php echo t('Voir fiche')?></a>-->
                <a href="<?php echo url('node/'.$product->nid)?>"><?php echo t('Voir fiche')?></a>
            </td>
            <td class="delete"><a data-pid="<?php echo $product->nid?>" class="btn-cart-remove" type="product" href="javascript:void(0)">Remove</a></td>
        </tr>
        <script>
        (function($){
            $(document).ready(function(){
                $(function(){
                    $('[name=quanity_<?php echo $product->nid?>]').editableSelect({ effects: 'fade',filter: false });
                })

            })
        })(jQuery)
            </script>
    <?php
    }
    foreach($options as $option){

        ?>
        <tr>
            <td class="category-name"><?php echo $option['category_product'][$language]->name?>
             <div class="bullet_info show_mobile">
                <div class="icon">i</div>
                    <div class="product_info">
                        <?php echo t('Vous serez recontacté par un de nos agents commerciaux qui vous orientera vers le modèle adapté a vos besoin.'); ?>
                        <br/>
                        <?php echo t('Energy')?>: <?php echo $option['energy'][$language]->name?>
                        <br/>
                        <?php echo t('Height')?>: <?php echo $option['height']?>
                        <br/>
                        <?php echo t('Width')?>: <?php echo $option['width']?>
                        <br/>
                        <?php echo t('Maximum charge')?>: <?php echo $option['maximum_charge']?>
                        <br/>
                        <?php echo t('Maximum Range')?>: <?php echo $option['maximum_range']?>
                        </div>
                </div>
            </td>
            <td class="bullet_info">
                <div class="icon">i</div>
                <div class="product_info">
                    <?php echo t('Vous serez recontacté par un de nos agents  commerciaux qui vous orientera vers le modèle adapté a vos besoin.'); ?>
                    <br/>
                    <?php echo t('Energy')?>: <?php echo $option['energy'][$language]->name?>
                    <br/>
                    <?php echo t('Height')?>: <?php echo $option['height']?>
                    <br/>
                    <?php echo t('Width')?>: <?php echo $option['width']?>
                    <br/>
                    <?php echo t('Maximum charge')?>: <?php echo $option['maximum_charge']?>
                    <br/>
                    <?php echo t('Maximum Range')?>: <?php echo $option['maximum_range']?>
                    </div>
            </td>
            <td class="qty">
               <!-- <input class="quantity" data-type="option" type="text" min="1" data-pid="<?php echo $option['id']?>"  name="quantity_<?php echo $option['id']?>" value="<?php echo $option['quantity']?>">-->
                <select class="quantity" data-type="option" type="text" min="1" data-pid="<?php echo $option['id']?>" name="quanity_<?php echo $option['id']?>" >
                    <?php
                    for($i=1;$i<=20;$i++){
                        echo '<option '.($option['quantity']==$i?'selected="selected"':'').' value="'.$i.'">'.$i.'</option>';
                    }
                    ?>
                </select>
            </td>
            <td>
            </td>
            <td class="delete"><a data-pid="<?php echo $option['id']?>" class="btn-cart-remove" type="option" href="javascript:void(0)">Remove</a></td>
        </tr>

        <script>
            (function($){
                $(document).ready(function(){
                    $(function(){
                        $('[name=quanity_<?php echo $option['id']?>]').editableSelect({ effects: 'fade', filter: false });
                        $('.category-name').on('click','.bullet_info.show_mobile',function(){
                            $('.product_info').toggle();
                        });
                    })

                })
            })(jQuery)
        </script>
    <?php
    }
    ?>
    </tbody>
</table>
<script>
    (function($){
        $(document).ready(function(){
            $('.btn-cart-remove').click(function(){
                var pdid=$(this).attr("data-pid");
                var type=$(this).attr("type");
                var obj=$(this);
                $.ajax({
                    url:'/ajax/product/cart/remove',
                    type:'post',
                    data:{nid:pdid,type:type},
                    success:function(response){
                        obj.parent().parent().remove();
                        location.reload();
                    }
                })
            })
            $('.tbl-cart-products').on('click','.es-list',function(e){
                var input=$(this).prev();
                var pdid=input.attr("data-pid");
                var type=input.attr("data-type");
                var quantity=$(this).find('li.selected').attr('value');
                $.ajax({
                    url:'/ajax/product/cart/change_quantity',
                    type:'post',
                    data:{nid:pdid,type:type,quantity:quantity},
                    success:function(response){
                    }
                })
            })
            $('.tbl-cart-products').on('change','.quantity',function(e){
                var pdid=$(this).attr("data-pid");
                var type=$(this).attr("data-type");
                var quantity=$(this).val();
                $.ajax({
                    url:'/ajax/product/cart/change_quantity',
                    type:'post',
                    data:{nid:pdid,type:type,quantity:quantity},
                    success:function(response){
                    }
                })
            })

        })
    })(jQuery)


</script>
