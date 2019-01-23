<?

include 'config.php';
$total = 0;
 ?>
<div class="order-details">
  <h2>Your Order details are:</h2>
  <ul>
    <?
      if(isset($_SESSION['cart'])):
       foreach ($_SESSION['cart'] as $key => $value):
        if($key == 'total')continue;
        $total = $total + ($value['price'] * $value['quantity']);
        ?>
      <li><?= $value['name'] . ' - ' . $value['price'] . $currency .' x ' . $value['quantity']; ?></li>
    <? endforeach;endif; ?>
  </ul>
  <p><strong><?= 'Total: ' . $total . $currency; ?></strong></p>
  <a href="index.php">Home</a>
  <a href="index.php?payed=true">Pay</a>
</div>
<? include 'footer.php'; ?>
