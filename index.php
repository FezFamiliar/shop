<?
include 'config.php';

if(isset($_GET['cart'])) header( "refresh:0;url=".str_replace('&cart=true','',$_SERVER['REQUEST_URI']));
if(isset($_GET['payed'])){

 foreach ($_SESSION['cart'] as $key => $products) {
       if($key == 'total')continue;
        mysqli_query($conn,"UPDATE `products` SET stock = stock - '".$products['quantity']."' WHERE id = '". $products['id']."'");
 }

 unset($_SESSION['cart']);
 header("refresh:0;url=index.php");
}
//print_array($_SESSION);

if(isset($_GET['logout'])){

  unset($_SESSION['username']);
  header("refresh:0;url=index.php");
}
include 'header.php';
$page = 3;

if($_SERVER['REQUEST_METHOD'] == 'POST'){


  $_SESSION['cart'][$_SESSION['cart']['total']] = array(

    'id' => trim($_POST['id']),
    'name' => trim($_POST['name']),
    'description' =>  trim($_POST['description']),
    'price' => trim($_POST['price']),
    'quantity' => trim($_POST['quantity'])

  );


}

if(isset($_GET['category_id'])){

  $max_query = mysqli_query($conn,"SELECT count(id) FROM products WHERE category_id = '".$_GET['category_id']."'");

  $max = mysqli_fetch_array($max_query);
  $_SESSION['totalpage'] = ceil($max[0]/$page);
  $start = ($_GET['page'] * $page) - $page;
  $product_query = mysqli_query($conn,"SELECT * FROM products WHERE category_id = '".$_GET['category_id']."' LIMIT $start,$page");
}
include 'menu.php';

   if(isset($_GET['category_id'])): ?>
       <section class="container">
           <? while($row = mysqli_fetch_array($product_query)): ?>
             <div class="products" >
               <div class="stock <?= ($row['stock'] > 0) ? 'on' : 'off' ?>">
                <span><?= ($row['stock'] > 0) ? 'Pe stock' : 'Stock epuizat'?></span>
               </div>
               <form action="<?= $_SERVER['REQUEST_URI']; ?>&cart=true" method="POST">
                  <a href="<?= $row['image'] ?>" data-lightbox="image"><img src="<?= $row['image'] ?>" width=200 height=200></a>
                  <h2><?= $row['name']; ?></h2>
                  <p><?= $row['description']; ?></p>
                  <span><?= $row['price'] . $currency;?>
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
           <? endwhile; ?>
              <a href="?category_id=<?= $_GET['category_id']; ?>&page=<?= (($_GET['page'] + 1) % ($_SESSION['totalpage']+1) == 0) ? 1 : $_GET['page'] + 1; ?>">
                <img src="lightbox/images/next.png" class="next">
              </a>
            <div class="pages">
                <? for($i = 1; $i <= $_SESSION['totalpage']; $i++): ?>
                  <a href="?category_id=<?= $_GET['category_id']; ?>&page=<?= $i; ?>" class="<? if($_GET['page'] == $i) echo 'selected'; ?>"><?= $i; ?></a>
                <? endfor; ?>
            </div>
       </section>
        <div class="slide-container">
          <form action="range" method="POST" autocomplete="off">
            <p>Filter by price:</p>
            <input type="range" name="range-price" id="slider" min="1" max="200" value="100">
            <input type="submit" value="Filter">
          </form>
          <span></span>
        </div>
 <? endif; ?>
