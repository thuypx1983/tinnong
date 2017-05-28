<?php

$vocabulary = taxonomy_vocabulary_machine_name_load('product_category');
$categories = entity_load('taxonomy_term', FALSE, array('vid' => $vocabulary->vid));

?>
<script>
    var lang = jQuery('html').attr('lang');
</script>
<div class="block_add_more_product">
    <div class="title_addmore">
        <?php echo t('Ajouter une machine supplémentaire')?>
    </div>
    <div class="product-filter">
        <div class="product-cart-filter">
            <div class="category-filter">
                <div class="require"><?php echo t('* Champs obligatoires')?></div>
                <select id="category_product" class="selectpicker">
                    <option value=""><?php echo t('Chariots télescopiques rotatifs')?></option>
                    <?php foreach($categories as $category){
                        echo '<option value="'.$category->tid.'">'.i18n_taxonomy_term_name($category,$GLOBALS['language']->language).'</option>';
                    }?>
                </select>
                
            </div>

            <div class="filter-item">
                <div class="title"><?php echo t('Energy')?></div>
                <select id="energy"  disabled="disabled" class="selectpicker">
                    <option value=""><?php echo t('Energy')?></option>
                </select>
            </div>

            <div class="filter-item">
            <div class="title"><?php echo t('Height')?></div>  
            <select id="height"  disabled="disabled" class="selectpicker">
                    <option value=""><?php echo t('Height')?></option>
                </select>
            </div>
            <div class="filter-item">
                <div class="title"><?php echo t('Width')?></div>  
                <select id="width"  disabled="disabled" class="selectpicker">
                    <option value=""><?php echo t('Width')?></option>
                </select>

            </div>
            <div class="filter-item ">
                <div class="title"><?php echo t('Maximum charge')?></div>  
                <select id="maximum_charge"  disabled="disabled" class="selectpicker">
                    <option value=""><?php echo t('Maximum charge')?></option>
                </select>
            </div>
            <div class="filter-item last maximum_range">
                <div class="title"><?php echo t('Maximum Range')?></div>  
                <select id="maximum_range"  disabled="disabled" class="selectpicker">
                    <option value=""><?php echo t('Maximum Range')?></option>
                </select>
            <div>

            </div>
        </div>
            <div id="add-option">
                <button type="button" id="add-option"><?php echo t('Ajouter'); ?></button>
            </div>
        </div>
    </div>

</div>
<script>
    var inputs= ['#category_product','#energy','#height','#width','#maximum_charge','#maximum_range'];
    (function($){

        $(document).ready(function(){

            setTimeout(function(){

                resetWhenChange('#category_product');
                if($('#category_product').val()=="") return false;

                var catid=$('#category_product').val();
                $.ajax({
                    url:'<?php echo url('ajax/product/cart/getfeture')?>',
                    type:'post',
                    dataType:'json',
                    data:{type:'engine',catid:catid},
                    success:function(response){
                        $('#energy').html(response.option);
                        $('#energy').prop("disabled", false);
                        $('#energy').selectpicker('refresh');
                    }
                })
            },1000)

            $('#category_product').change(function(){
                resetWhenChange('#category_product');
                if($(this).val()=="") return false;

                var catid=$('#category_product').val();
                $.ajax({
                    url:'<?php echo url('ajax/product/cart/getfeture')?>',
                    type:'post',
                    dataType:'json',
                    data:{type:'engine',catid:catid},
                    success:function(response){
                        $('#energy').html(response.option);
                        $('#energy').prop("disabled", false);
                        $('#energy').selectpicker('refresh');
                    }
                })
            })
            $('#energy').change(function(){
                resetWhenChange('#energy');
                if($(this).val()=="") return false;
                var catid=$('#category_product').val();
                var energyid=$('#energy').val();
                $.ajax({
                    url:'<?php echo url('/ajax/product/cart/getfeture')?>',
                    type:'post',
                    dataType:'json',
                    data:{type:'height',catid:catid,energyid:energyid},
                    success:function(response){
                        $('#height').html(response.option);
                        $('#height').prop("disabled", false);
                        $('#height').selectpicker('refresh');
                    }
                })
            })
            $('#height').change(function(){
                resetWhenChange('#height');
                if($(this).val()=="") return false;

                var catid=$('#category_product').val();
                var energyid=$('#energy').val();
                var height=$('#height').val();
                $.ajax({
                    url:'<?php echo url('ajax/product/cart/getfeture')?>',
                    type:'post',
                    dataType:'json',
                    data:{type:'width',catid:catid,energyid:energyid,height:height},
                    success:function(response){
                        $('#width').html(response.option);
                        $('#width').prop("disabled", false);
                        $('#width').selectpicker('refresh');

                    }
                })
            })
            $('#width').change(function(){
                resetWhenChange('#width');
                if($(this).val()=="") return false;

                var catid=$('#category_product').val();
                var energyid=$('#energy').val();
                var height=$('#height').val();
                var width=$('#width').val();
                $.ajax({
                    url:'<?php echo url('ajax/product/cart/getfeture')?>',
                    type:'post',
                    dataType:'json',
                    data:{type:'maximum_charge',catid:catid,energyid:energyid,height:height,width:width},
                    success:function(response){
                        $('#maximum_charge').html(response.option);
                        $('#maximum_charge').prop("disabled", false);
                        $('#maximum_charge').selectpicker('refresh');
                    }
                })
            })
            $('#maximum_charge').change(function(){
                resetWhenChange('#maximum_charge');
                if($(this).val()=="") return false;

                var catid=$('#category_product').val();
                var energyid=$('#energy').val();
                var height=$('#height').val();
                var width=$('#width').val();
                var maximum_charge=$('#maximum_charge').val();
                $.ajax({
                    url:'<?php echo url('ajax/product/cart/getfeture')?>',
                    type:'post',
                    dataType:'json',
                    data:{type:'maximum_range',catid:catid,energyid:energyid,height:height,width:width,maximum_charge:maximum_charge},
                    success:function(response){
                        console.log(response);
                        $('#maximum_range').html(response.option);
                        $('#maximum_range').prop("disabled", false);
                        $('#maximum_range').selectpicker('refresh');
                        
                    }
                })
            })
        })

        $('#add-option').click(function(){
            var obj=$(this);
            obj.prop('disabled',true);
            var data={};
            for(i=0;i<inputs.length;i++){
                data[inputs[i]]= $(inputs[i]).val();

            }
            $.ajax({
                url:'<?php echo url('ajax/product/cart/add_option')?>',
                type:'post',
                data:data,
                success:function(response){
                    obj.prop('disabled',false);
                    $('#edit-submitted-step-content-step-1-items').html(response);
                    location.reload();
                    $('html, body').animate({
                        scrollTop: $(".step1").offset().top
                    }, 100);
                }
            })
        })

        $('.title_addmore').click(function(){
            $('.product-filter').toggle();
        })

        function resetWhenChange(id){

            if($('#category_product').val()==12 || $('#category_product').val()==4){
                $('.maximum_range').hide();
            }else{
                $('.maximum_range').show();
            }

            $('#product-cart-result-search').html("");
            if(id=='#category_product'){
                $('#add-option').prop('disabled',true);
            }else{
                $('#add-option').prop('disabled',false);
            }
            for(start=(inputs.indexOf(id)+1);start<inputs.length;start++){
                var id_next=inputs[start];
                $(id_next).find('.option-value').remove();
                $(id_next).prop("disabled", true);
                $(id_next).selectpicker('refresh');
            }
        }
    })(jQuery)
</script>