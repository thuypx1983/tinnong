<?php
$url_checkout=url('node/21');
?>
<!--<div class="cart-introduction">
    <div class="cart-service">
        <?php //echo t('Demande de devis')?>
        <span class="description"><?php //echo t('Reponse sous 12h')?></span>
    </div>
</div>-->
<div class="product-cart-view add_tocart_popup">
     <div class="product-cart-popup">
        <div class="cart-icon"> <img class="img_scroll" src="<?php print '/sites/all/themes/bootstrap/images/icon_poup_cart.png';?>"></div>
        <div class="product-cart-popup-title">
            <span><?php echo t('Sản phẩm của bạn đã được thêm vào giỏ hàng')?></span>
        </div>
         <table class="table">
             <thead>
             <tr>
                 <th>Sản phẩm</th>
                 <th>Số lượng</th>
                 <th>Thành tiền</th>
                 <th style="text-align: center">Xóa</th>
             </tr>
             </thead>
             <tbody>
             <?php
             foreach ($item_list as $item_id=>$item) {
                 echo '<tr data-pid="'.$item_id.'">';
                     ?>
                     <td align="left">
                         <?php echo $item['node']->title?>
                     </td>
                     <td align="left">
                         <input data-pid="<?php echo $item_id?>" class="quantity" type="number" data-pid="<?php echo $item_id?>" name="quantity" min="1" max="15" data-price="<?php echo (int)$item['node']->field_price['und'][0]['value'];?>" value="<?php echo $item['quantity']?>">

                     </td>
                     <td align="left">
                         <?php echo number_format($item['node']->field_price['und'][0]['value']*$item['quantity'])?>đ
                     </td>
                     <td align="middle">
                         <i style="cursor: pointer" data-pid="<?php echo $item_id?>" class="fa fa-trash"></i>
                     </td>
                 <?php
             }

             ?>
             </tbody>
         </table>
        <div class="cart-checkout">
            <a class="bnt-continue" href="javascript:void(0)"><?php echo t('TIẾP TỤC MUA HÀNG')?></a>
            <a class="btn-view-cart" href="<?php echo $url_checkout?>"><?php echo t('THANH TOÁN')?></a>
        </div>
    </div>
</div>
<script type="text/javascript">

    (function($){
        $(document).ready(function(){
            jQuery('.bnt-continue').click(function(){
                jQuery.fancybox.close();
            })

            $('.fa-trash').click(function(){
                var pdid=$(this).attr("data-pid");
                var type='product';
                var row=$(this).parent().parent();
                row.remove();
                $.ajax({
                    url:'<?php echo url('ajax/product/cart/remove')?>',
                    type:'post',
                    dataType:'json',
                    data:{nid:pdid,type:type},
                    success:function(response){

                    }
                })
            })
            $('.quantity').change(function(){
                var pdid=$(this).attr("data-pid");
                var type='product';
                var quantity=$(this).val();
                $.ajax({
                    url:'<?php echo url('ajax/product/cart/change_quantity')?>',
                    type:'post',
                    dataType:'json',
                    data:{pdid:pdid,type:type,quantity:quantity},
                    success:function(response){

                    }
                })
            })
        })

    })(jQuery)
</script>