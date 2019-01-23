<?php

function print_array($array){

  if(is_array($array)){

    echo '<pre>';
    print_r($array);
    echo '</pre>';

  }else echo 'its not ana array!';


}
 ?>
