var step=1;
var cart_error_step_1="Please add at least a product";
var windowsize=1;
var mobilesize=1280;
(function($){
    windowsize=$( window ).width();

    $(document).ready(function(){
        //add to cart
        $(document).on('click','.btn-product-cart',function(e){
            e.preventDefault();
            var pdid=$(this).attr("data-pid");
            var type='product';
            var quantity=$('.quantity').val();
            $.ajax({
                url:'/ajax/product/cart/add',
                type:'post',
                dataType:'json',
                data:{nid:pdid,type:type,quantity:quantity},
                success:function(response){
                    $('#block-product-cart-product-cart-block').replaceWith(response.block_cart);

                    $.fancybox(
                        response.popup_cart,
                        {   'autoDimensions'    : false,
                            tpl : {
                                closeBtn : '<a title="Close" class="fancybox-item fancybox-close" href="javascript:;">Fermer</a>'
                            }
                        }

                    );
                }
            })
        })
        $('.webform-client-form .product-quanity input').change(function(){
            var pdid=$(this).parent().parent().attr("data-pid");
            var type='product';
            var quantity=$(this).val();
            $.ajax({
                url:'/ajax/product/cart/change_quantity',
                type:'post',
                dataType:'json',
                data:{pdid:pdid,type:type,quantity:quantity},
                    success:function(response){

                    }
                })
            updateShoppingCart();
        })
        $('.webform-client-form .fa-trash').click(function(){

            var type='product';
            var row=$(this).parent().parent();
            var pdid=row.attr("data-pid");
            row.remove();
            $.ajax({
                url:'/ajax/product/cart/remove',
                type:'post',
                dataType:'json',
                data:{nid:pdid,type:type},
                success:function(response){

                }
            })
            updateShoppingCart();
        })

        function updateShoppingCart(){
            var total=0;
            $('#webform-client-form-21 .product-item').each(function(){
                var quantity=$(this).find('.product-quanity input').val();
                var price=$(this).find('.product-price').attr('data-price');
                var subtotal=parseInt(quantity)*parseInt(price);
                $(this).find('.product-subtotal').html(number_format(subtotal,'.',','));
                total+=subtotal;
                $('#webform-client-form-21').find('.cart-totall').html(number_format(total,'.',',')+' đ');
            })
        }

        var d=$('.node-type-tour .field-name-field-departure-day .field-items .field-item:first');
        if(d.length==1){
            $('.node-type-tour .field-name-field-available-seats').after(
                '<div class="field field-label-inline clearfix"><div class="field-label">Khởi hành:&nbsp;</div>'+ d.html()+' <a style="color: #0000cc" class="other-date" href="javascript:void(0)">Ngày khác</a></div>'
            );
            $('.node-type-tour').on('click','.other-date',function(){
                $('.horizontal-tabs-list .horizontal-tab-button-2 a').trigger('click');
                $('html,body').animate({scrollTop: $('.horizontal-tabs-list .horizontal-tab-button-2').offset().top});
                return false;
            })
        }

    })


})(jQuery)
function number_format (number, decimals, decPoint, thousandsSep) {

    number = (number + '').replace(/[^0-9+\-Ee.]/g, '')
    var n = !isFinite(+number) ? 0 : +number
    var prec = !isFinite(+decimals) ? 0 : Math.abs(decimals)
    var sep = (typeof thousandsSep === 'undefined') ? ',' : thousandsSep
    var dec = (typeof decPoint === 'undefined') ? '.' : decPoint
    var s = ''

    var toFixedFix = function (n, prec) {
        var k = Math.pow(10, prec)
        return '' + (Math.round(n * k) / k)
                .toFixed(prec)
    }

    // @todo: for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.')
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep)
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || ''
        s[1] += new Array(prec - s[1].length + 1).join('0')
    }

    return s.join(dec)
}
