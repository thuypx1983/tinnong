<?php
$ar_compare=array(
    1=>array('title'=>t('Nacelles')),
    2=>array('title'=>t('Plateformes')),
    3=>array('title'=>t('Chariots')),
    4=>array('title'=>t('Mini-grues')),
)
?>
<div class="block-compare">
    <div class="title_compare">
        <span><?php echo t('Tableau comparateur');?></span>
    </div>
    <div class="content_compare">
        <div class="description_compare">
            <?php echo t('Huet location vous propose de voir toutes les machines <br/> d’une même catégorie via un tableau de critères :');?>
        </div>
        <div class="list-category-compare">
            <ul>
                <?php
                foreach ($ar_compare as $i=>$value) {
                    ?>
                    <li>
                        <a class="view_more" href="<?php echo url('compare/'.$i)?>"><?php echo t('Voir toutes les') ?></a>
                        <a class="category-title" href="<?php echo url('compare/'.$i)?>"><?php echo $value['title']?></a>
                    </li>
                <?php
                }
                ?>
            </ul>
        </div>
    </div>
</div>