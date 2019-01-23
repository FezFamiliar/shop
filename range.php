<?php
include 'config.php';
include 'header.php';


$price_target = trim($_POST['range-price']);
$range = "SELECT * FROM `products` WHERE price BETWEEN 0  AND '".$price_target."' LIMIT 10";
 $result = mysqli_query($conn,$range);
    if(mysqli_num_rows($result) > 0):
      while($row = mysqli_fetch_array($result)):
    ?>
    <div class="products search-products-frame">
      <div class="stock <?= ($row['stock'] > 0) ? 'on' : 'off' ?>">
       <span><?= ($row['stock'] > 0) ? 'Pe stock' : 'Stock epuizat'?></span>
      </div>
      <form action="range.php" method="POST">
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
<? endwhile;else: 'No products found!';endif; ?>
