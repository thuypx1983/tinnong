
<div class="stick_mobile <?php if(isset($node->field_file['und'][0]['uri'])) echo "has_file" ?>">
	<div class="bt_preview" onclick="history.go(-1);return true;" ><?php echo t('preview page')?></div>
	<div class="scroll_description"><?php echo t('scroll to description')?></div>
	<?php if(isset($node->field_file['und'][0]['uri'])) {
        $file=file_create_url($node->field_file['und'][0]['uri']);
        ?>
        <div class="download_file"><a href="<?php echo $file?>"><?php echo t('download file')?></a></div>
     <?php
    }?>

	<div class="add_to_cart"><a class="btn-product-cart" data-pid="<?php echo $node->nid ?>"><?php print t('Add to cart')?></a></div>
</div>
