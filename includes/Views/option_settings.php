<?php
    $arr = get_option('yay_settings');
    if(!empty($arr)){
        foreach($arr as $key => $value){
            echo '<input type="checkbox" name="vehicle" class="vehicle"
                 data-cost="',$value['cost'],'"/>';
            echo '<label>',$value['value'].' ('.wc_price($value['cost']) . ')','</label>';
            echo '<br>';
        }
    }
    else{  
        echo 'False';
        echo '<br>';
    }
?>

<?php 
    $product = wc_get_product();
    $product->get_price();
?>
<div id="total" data-cost="<?php echo $product->get_price(); ?>">Total price: <span id="total1"><?php echo wc_price($product->get_price()); ?></span></div>
