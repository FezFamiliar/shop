<?

include 'config.php';
include 'header.php';

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id']) && isset($_POST['name']) && isset($_POST['description']) && isset($_POST['price'])){


  $_SESSION['cart'][$_SESSION['cart']['total']] = array(

    'id' => $_POST['id'],
    'name' => $_POST['name'],
    'description' =>  $_POST['description'],
    'price' => $_POST['price'],
    'quantity' => $_POST['quantity']

  );
  header("refresh:0;url=search.php?search-term=".$_GET['search-term']);
}
if(isset($_GET['search-term'])):
$term = mysqli_real_escape_string($conn,$_GET['search-term']);
$result = mysqli_query($conn,"SELECT * FROM `products` WHERE name LIKE '$term%' LIMIT 3");

  if(mysqli_num_rows($result) > 0):
      while($row = mysqli_fetch_array($result)):
?>
<div class="products search-products-frame">
  <div class="stock <?= ($row['stock'] > 0) ? 'on' : 'off' ?>">
   <span><?= ($row['stock'] > 0) ? 'Pe stock' : 'Stock epuizat'?></span>
  </div>
  <form action="<?= $_SERVER['REQUEST_URI']; ?>" method="POST">
      <a href="<?= $row['image'] ?>" data-lightbox="image"><img src="<?= $row['image'] ?>" width=200 height=200></a>
      <h2><?= $row['name']; ?></h2>
      <p><?= $row['description']; ?></p>
      <span><?= $row['price']; ?>
        <button type="submit" class="fake-button">
          <i class="fas fa-shopping-cart shopping-cart <? if($row['stock'] <= 0) echo 'disable'; ?>"></i>
        </button>
      </span>
      <input type="number" name="quantity" value="1" class="quantity">
      <input type="hidden" name="name" value="<?= $row['name']; ?>">
      <input type="hidden" name="description" value="<?= $row['description']; ?>">
      <input type="hidden" name="price" value="<?= $row['price']; ?>">
      <input type="hidden" name="id" value="<?= $row['id']; ?>">
  </form>
</div>
<? endwhile;else: echo 'no match!';endif;endif; ?>
