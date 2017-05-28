<ul class="products">
    <?php
    foreach ($item_list as $node) {
        ?>
        <li>
            <div class="product-title"><?php echo $node->title?></div>
        </li>
    <?php
    }
    ?>
</ul>