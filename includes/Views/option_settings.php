<?php
    $arr = get_option('yay_settings');
    if(!empty($arr)){
        foreach($arr as $key => $value){
            echo '<input type="checkbox" name="vehicle['.$value['value'].']" class="vehicle"
                 data-cost="',$value['cost'],'" value="',$value['cost'],'" style="margin: 10px;"/>';
            echo '<label>',$value['value'].' ('.wc_price($value['cost']) . ')','</label>';
            echo '<br>';
        }
    }
?>

<?php 
    $product = wc_get_product();
    $product->get_price();
?>
<div id="total" data-cost="<?php echo $product->get_price(); ?>">Total price: <span id="total_last"><?php echo wc_price($product->get_price()); ?></span></div>
