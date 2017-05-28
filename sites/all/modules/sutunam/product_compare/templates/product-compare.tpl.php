<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<?php
    $fields_new=array();
    foreach($fields as &$tpm){
        $tpm['weight']=$tpm['display']['teaser']['weight'];
    }
    unset($tpm);


    #sort array;
    usort($fields, function ($a, $b) {
        return $a['weight'] - $b['weight'];
    });


    foreach($fields as $name=>$value){
        $fields_new[$name]=$value;
        if($name=='field_image'){
            $fields_new['']=array('label'=>'','field_name'=>'cart');
        }
    }
?>

<?php
    $column ="";
    $images="";
     foreach($item_list as $node){
        $column_header="";
        $column_sub="";
          $column_sub.='
            <ul class="cd-features-list">';
             $column_sub.= '<li class="tt-model"><span>'.$node->title.'</span></li>';
             foreach($fields_new as $field){
                $field_name=$field['field_name'];
                $field_class=str_replace('_', '-', $field_name);
                $item=$node->$field_name;

                switch ($field_name){
                case 'field_image':
                    $img_url = $item[LANGUAGE_NONE][0]['uri'];
                    $img='<img src="'.image_style_url("style_300x300", $img_url).'" />';
                    $column_header.=$img;
                    $images.=$img;
                    break; 
                case 'field_engine':
                case 'field_category':
                    $term = taxonomy_term_load($item[LANGUAGE_NONE][0]['tid']);
                    $column_sub.= '<li class="'.$field_class.'" ><span>'.$term->name.'</span></li>';
                    break;
                case 'field_file':
                    if($node->field_file){
                    $file=file_create_url($node->field_file['und'][0]['uri']);
                    $column_sub.= '<li class="'.$field_class.'"><div class="link-pdf"><a href="'.$file.'"><img class="file-icon" src="/modules/file/icons/application-pdf.png" title="application/pdf" alt="PDF icon">'.t('Download PDF').'</a></div></li>';
                    }else{ $column_sub.= '<li></li>';}
                    break;
                case 'cart':
                    $column_sub.= '<li class="line-button-cart">
                        <div class="product-cart-add">
                            <button class="btn-product-cart" data-pid="'.$node->nid.'">
                                <span>'.t('Ajouter au devis').'</span>
                            </button>
                        </div>
                    </li>';
                    break;
                default:
                    $column_sub.= '<li class="'.$field_class.'"><span>'.($item?(isset($field['options'])?$field['options'][$item[LANGUAGE_NONE][0]['value']]:$item[LANGUAGE_NONE][0]['value']):'--').'<i>'.$field['description'].'</i></span> </li>';
                    break;
             }
            }
          $column_sub.='<li><div class="link"><a href="'.url('node/'.$node->nid).'">'.t('Voir la fiche détaillée').'</a></div></li></ul>';
          $column.='<li class="product"><div class="product-inner">'.$column_sub.'</div></li>';
        }
    ?>

<?php
    $columnTop ="";
     foreach($item_list as $node){
        $img='<img src="'.image_style_url("style_300x300", $node->field_image['und'][0]['uri']).'" />';
        $columnTop_header="";
        $columnTop_header_sub="";
        $columnTop.='<li class="product"><div class="product-inner"><div class="top-info"><div class="check"><span><span></span></span></div>'.$img.$columnTop_header.'</div>'.$columnTop_sub.'</div></li>';  
        }
?>
<!-- End  Please put images for me -->   
<section class="cd-intro">
    </section> <!-- .cd-intro -->

    <section class="cd-products-comparison-table">
            <div class="compare-ct">
                <div class="actions">
                    <a href="#0" class="bt-back"><span><?php print t('Retour a la liste des machines')?></span></a>
                    <a href="#0" class="filter"><span><?php print t('Comparer')?></span></a>
                    <a href="#0" class="reset hide"><span><?php print t('Réinitialiser')?></span></a>
                </div>
            </div>
        <div class="cd-products-table">
            <div class="features">
                <div class="features-inner"><div class="top-info"><div class="text-img"><?php print t('Masquer les images')?></div></div></div>
                <ul class="cd-features-list">
                    <li class="tt-model"><span><?php print t('Model')?></span></li>
                    <?php
                        foreach($fields_new as $field){                            
                            if($field['label']=='image'){
                                echo "";
                            }else{
                                echo "<li class=\"".$field['field_name']."\"><span>".t($field['label'])."</span></li>";
                            }
                        } 

                    ?>
                    <li class="link-to"><span></span></li>
                </ul>
            </div> <!-- .features -->
             <!-- <ul class="cd-table-navigation">
                    <li><a href="#0" class="prev inactive"></a></li>
                    <li><a href="#0" class="next"></a></li>
                 </ul> -->
            <div class="cd-products-wrapper">
                <!--  -->
                <div class="head-compare-list">
                    <ul class="cd-products-columns sliderTopCom">
                        <?php echo $columnTop?>
                    </ul>
                </div>
                <ul class="cd-products-columns sliderBottomCom">
                    <?php echo $column?></ul>                
            </div> <!-- .cd-products-wrapper -->
            
            
        </div> <!-- .cd-products-table -->

    </section>

    <script type="text/javascript">



    (function($){
            function listHover() {
                /*$( ".cd-features-list li" ).on('mouseover', function () {
                    var index= $(this).index();
                    $('ul.cd-features-list').each(function(i,object){
                        $(this).find('li').eq(index).addClass('hv-ac').siblings().removeClass('hv-ac');
                    });
                });*/
                $( ".cd-features-list li" ).on('click', function () {
                    var index= $(this).index();
                    $('ul.cd-features-list').each(function(i,object){
                        $(this).find('li').eq(index).addClass('cl-ac');
                    });
                });
                $( ".cd-features-list li" ).dblclick(function() {
                    var index= $(this).index();
                    $('ul.cd-features-list').each(function(i,object){
                        $(this).find('li').eq(index).removeClass('cl-ac');
                    });
                });
                $('.top-info .text-img').on('click', function (){
                    $('.top-info').toggleClass('hide-img');
                });
            }
            function listSlider() {
                $('.sliderBottomCom').slick({
                    slidesToShow: 5,
                    slidesToScroll: 1,
                    cssEase: 'ease',
                    asNavFor: '.sliderTopCom',
                    arrows: false,
                   /* infinite: false,*/
                    responsive: [
                    {
                      breakpoint: 1530,
                      settings: {
                        arrows: false,
                        slidesToShow: 4
                      }
                    },
                    {
                      breakpoint: 1024,
                      settings: {
                        arrows: false,
                        slidesToShow: 2
                      }
                    },
                    {
                      breakpoint: 768,
                      settings: {
                        arrows: false,
                        slidesToShow: 1
                      }
                    },
                    {
                      breakpoint: 480,
                      settings: {
                        arrows: false,
                        centerMode: true,
                        centerPadding: '0',
                        slidesToShow: 1
                      }
                    }
                  ]
                });
                $('.sliderTopCom').slick({
                    slidesToShow: 5,
                    slidesToScroll: 1,
                    cssEase: 'ease',
                   /* infinite: false,*/
                   asNavFor: '.sliderBottomCom',
                    responsive: [
                    {
                      breakpoint: 1530,
                      settings: {
                        arrows: true,
                        slidesToShow: 4
                      }
                    },
                    {
                      breakpoint: 1024,
                      settings: {
                        arrows: true,
                        slidesToShow: 2
                      }
                    },
                    {
                      breakpoint: 768,
                      settings: {
                        arrows: true,
                        slidesToShow: 1
                      }
                    },
                    {
                      breakpoint: 480,
                      settings: {
                        arrows: true,
                        centerMode: true,
                        centerPadding: '0',
                        slidesToShow: 1
                      }
                    }
                  ]
                });
                $( ".cd-products-wrapper .slick-track .product" ).on('click', function () {
                    var indexList = $(this).index();
                    $('.cd-products-wrapper .slick-track').each(function(i,object){
                        $(this).find('.product').eq(indexList).toggleClass('selected');
                    });
                });
                var filtered = false;
                $('.cd-products-wrapper .product').on('click', function(){
                   /* $(this).toggleClass('selected');*/
                    filtered = true;
                });
                $('.compare-ct .reset').on('click', function(){
                    $('.cd-products-wrapper .product').removeClass('selected');
                    filtered = false;
                    $( ".cd-features-list li" ).removeClass('cl-ac');
                    $('.compare-ct .reset').addClass('hide');
                    $('.compare-ct .filter').removeClass('hide');
                });
                $('.compare-ct .filter').on('click', function(){
                    if (filtered === true) {
                        $('.cd-products-columns').slick('slickUnfilter').slick('slickFilter', '.selected');
                        $( ".cd-features-list li" ).removeClass('cl-ac');
                        $('.compare-ct .reset').removeClass('hide');
                        $('.compare-ct .filter').addClass('hide');
                  } else {
                        $('.cd-products-columns').slick('slickUnfilter');
                        $( ".cd-features-list li" ).removeClass('cl-ac');
                  }

                });
                $('.compare-ct .reset').on('click', function(){
                    $('.cd-products-columns').slick('slickUnfilter');
                    $( ".cd-features-list li" ).removeClass('cl-ac');
                });

            }
            var navpos123 = $('.cd-products-table').offset();
            $(window).bind('scroll', function () {
                if ($(window).scrollTop() > navpos123.top) {
                    $('.cd-products-table').addClass('sticky');
                }
                else {
                    $('.cd-products-table').removeClass('sticky');
                }
            });

            //  
            listHover();
            listSlider();
            // Fixed img 
           /* window.resizeWithHeadTable = function () {
                var widthNameColImage = $('.slick-slide').width();
                $('.product-inner .top-info').css({width: widthNameColImage + 'px'});
            }
            resizeWithHeadTable();
            $(window).on('resize', function () {
                resizeWithHeadTable();
            });*/
            // js Back Page 
            $('a.bt-back').click(function(){
                parent.history.back();
                return false;
            });
        })(jQuery);
    </script>