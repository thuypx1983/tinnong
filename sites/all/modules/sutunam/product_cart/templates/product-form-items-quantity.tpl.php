<div class="reservation-calendar-each-items" style="display: none">
    <table class="tbl-cart-products-quantity" border="1" style="width: 100%">
        <thead>
        <tr>
            <td><?php echo t('Category') ?></td>
            <td><?php echo t('Type de Machine') ?></td>
            <td><?php echo t('Durée prévisionelle (jours)') ?></td>
            <td><?php echo t('quantity') ?></td>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($products as $product) {
            $term = taxonomy_term_load($product->field_category['und'][0]['tid']);
            ?>
            <tr>
                <td><?php echo erm?></td>
                <td><?php echo $product->title?></td>
                <td>
                    <div>
                        <select>
                            <option value="" selected="selected">Month</option>
                            <option value="1">Jan</option>
                            <option value="2">Feb</option>
                            <option value="3">Mar</option>
                            <option value="4">Apr</option>
                            <option value="5">May</option>
                            <option value="6">Jun</option>
                            <option value="7">Jul</option>
                            <option value="8">Aug</option>
                            <option value="9">Sep</option>
                            <option value="10">Oct</option>
                            <option value="11">Nov</option>
                            <option value="12">Dec</option>
                        </select>
                        <select>
                            <option value="" selected="selected">Day</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                            <option value="16">16</option>
                            <option value="17">17</option>
                            <option value="18">18</option>
                            <option value="19">19</option>
                            <option value="20">20</option>
                            <option value="21">21</option>
                            <option value="22">22</option>
                            <option value="23">23</option>
                            <option value="24">24</option>
                            <option value="25">25</option>
                            <option value="26">26</option>
                            <option value="27">27</option>
                            <option value="28">28</option>
                            <option value="29">29</option>
                            <option value="30">30</option>
                            <option value="31">31</option>
                        </select>
                        <select>
                            <option value="" selected="selected">Year</option>
                            <option value="2016">2016</option>
                            <option value="2017">2017</option>
                            <option value="2018">2018</option>
                            <option value="2019">2019</option>
                            <option value="2021">2021</option>
                            <option value="2020">2020</option>
                        </select>
                        <input type="number" min="1" name="duration_<?php echo $product->nid?>" value="1">
                    </div>
                </td>
                <td>
                    <a href="<?php echo file_create_url($product->field_file['und'][0]['uri'])?>"><?php echo t('Download pdf')?></a>
                </td>
                <td><a data-pid="<?php echo $product->nid?>" class="btn-cart-remove" type="option"
                       href="javascript:void(0)">Remove</a></td>
            </tr>
        <?php
        }
        foreach ($options as $option) {

            ?>
            <tr>
                <td><?php echo $option['category_product'][$language]->name?></td>
                <td>
                    Energy:<?php echo $option['energy'][$language]->name?>
                    <br/>
                    Height:<?php echo $option['height']?>
                    <br/>
                    Width:<?php echo $option['width']?>
                    <br/>
                    Max Charge:<?php echo $option['maximum_charge']?>
                    <br/>
                    Max Range:<?php echo $option['maximum_range']?>
                </td>
                <td>
                    <select>
                        <option value="" selected="selected">Month</option>
                        <option value="1">Jan</option>
                        <option value="2">Feb</option>
                        <option value="3">Mar</option>
                        <option value="4">Apr</option>
                        <option value="5">May</option>
                        <option value="6">Jun</option>
                        <option value="7">Jul</option>
                        <option value="8">Aug</option>
                        <option value="9">Sep</option>
                        <option value="10">Oct</option>
                        <option value="11">Nov</option>
                        <option value="12">Dec</option>
                    </select>
                    <select>
                        <option value="" selected="selected">Day</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                        <option value="21">21</option>
                        <option value="22">22</option>
                        <option value="23">23</option>
                        <option value="24">24</option>
                        <option value="25">25</option>
                        <option value="26">26</option>
                        <option value="27">27</option>
                        <option value="28">28</option>
                        <option value="29">29</option>
                        <option value="30">30</option>
                        <option value="31">31</option>
                    </select>
                    <select>
                        <option value="" selected="selected">Year</option>
                        <option value="2016">2016</option>
                        <option value="2017">2017</option>
                        <option value="2018">2018</option>
                        <option value="2019">2019</option>
                        <option value="2021">2021</option>
                        <option value="2020">2020</option>
                    </select>
                    <input type="number" min="1" name="duration_<?php echo $product->nid?>" value="1">
                </td>
                <td>
                </td>
                <td><a data-pid="<?php echo $option['id']?>" class="btn-cart-remove" type="option"
                       href="javascript:void(0)">Remove</a></td>
            </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
</div>
<script>
    (function ($) {
        $(document).ready(function () {


        })
    })(jQuery)
</script>