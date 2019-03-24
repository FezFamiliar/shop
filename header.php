<header>
  <div class="row">
      <a href="index.php" class="login"><?= $lang['home']; ?></a>
      <a href="register.php" class="login"><?= $lang['signup']; ?></a>
      <a href="login.php" class="login"><?= $lang['login']; ?></a>
    <div class="logo">
        <h1>Welcome <span class="logged"><?if(isset($_SESSION['username'])) echo $_SESSION['username']; ?></span> to the supermarket</h1>
    </div>
    <? if(isset($_SESSION['username'])): ?>
      <a href="index.php?logout=true" class="logout">Logout</a>
    <? endif; ?>

    <div class="cart">
      <div class="notification">
        <span class="notification"><? echo isset($_SESSION['cart']['total']) ? $_SESSION['cart']['total'] : 0; ?></span>
      </div>
        <i class="fas fa-shopping-cart" data-toggle="modal" data-target="#exampleModal"></i>
    </div>
  </div>
</header>

<div class="modal fade" id="exampleModal" tabindex.php="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2>Your Products:</h2>
          <span data-dismiss="modal" class="close-modal">&times;</span>
      </div>
      <div class="modal-body">

        <table class="hide">
          <tr>
           <th><b>Name</b></th>
           <th><b>Description</b></th>
           <th><b>Price</b></th>
           <th><b>Quantity</b></th>
           <th><b>Action</b></th>
         </tr>
       <?  if(isset($_SESSION['cart'])):
              foreach ($_SESSION['cart'] as $key => $products):
               if($key == 'total') continue;
               ?>
               <tr>
                 <td>
                   <?= $products['name']; ?>
                </td>
                <td>
                  <?= $products['description']; ?>
                </td>
                <td>
                  <?= $products['price']; ?>
                </td>
                <td>
                  <?= $products['quantity']; ?>
                </td>
                <td align="middle">
                  <i class="fas fa-times clear" data-id="<?= $key;?>"></i>
                </td>
              </tr>
        <? endforeach;endif;?>
        </table>
        <div id="table">

        </div>
      </div>
      <div class="modal-footer">
        <a class="btn-primary" data-dismiss="modal">Close</a>
        <a class="btn-primary" href="checkout.php">Checkout</a>
      </div>
    </div>
  </div>
</div>
