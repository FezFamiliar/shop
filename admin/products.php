<?
include 'config.php';
include 'header.php';
if(!isset($_GET['page'])) $_GET['page'] = 1;
$page = $_GET['page'];
$max_query = mysqli_query($conn,"SELECT count(id) FROM products");
$max = mysqli_fetch_array($max_query);
$end = 10;
$_SESSION['products_total'] = ceil($max[0]/$end);
$start = ($page * $end) - $end;
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['action']) && $_GET['action'] == 'add'){

  //  print_array($_FILES);
    $category_id = mysqli_real_escape_string($conn,$_POST['category']);
    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $description = mysqli_real_escape_string($conn,$_POST['descriere']);
    $price = mysqli_real_escape_string($conn,$_POST['price']);
    $dir = '';
     $get_category =  mysqli_query($conn,"SELECT * FROM `categories` WHERE id ='".$category_id."'");
     if(mysqli_num_rows($get_category) > 0){

       $c_name = mysqli_fetch_array($get_category);
       $dir = $c_name['name'];
     }
    $_FILES['image']['name'] = $name .'.jpg';
    $dir_name = 'images/' . lcfirst($dir) . '/' . $_FILES['image']['name'];
    if(!is_dir('../images/'.$dir))
      mkdir('../images/'.lcfirst($dir), 0777, true);

    $save_dir = '../images/' . lcfirst($dir) . '/' . basename($_FILES['image']['name']);
    copy($_FILES['image']['tmp_name'],$save_dir);

  //  echo "INSERT INTO `products`(category_id,name,description,price) VALUES('".$category_id."' ,'".$name."', '".$description."' , '".$price."',)";
    mysqli_query($conn,"INSERT INTO `products`(category_id,name,description,image,price) VALUES('".$category_id."' ,'".$name."', '".$description."' ,'".$dir_name."' ,'".$price."')");
   header("refresh:0;products.php");
}

if(isset($_GET['action']) && $_GET['action'] == 'remove'){

  $query = "DELETE FROM `products` WHERE id = '".$_GET['edit_id']."'";
  mysqli_query($conn,$query);
  //  header("refresh:0;products.php");
}


if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['action']) && $_GET['action'] == 'edit'){


  $name = mysqli_real_escape_string($conn,$_POST['name']);
  $description = mysqli_real_escape_string($conn,$_POST['descriere']);
  $price = mysqli_real_escape_string($conn,$_POST['price']);

  if(!empty($name) && !empty($description) && !empty($price))
    $query = "UPDATE `products` SET name ='".$name."',description ='".$description."',price ='".$price."' WHERE id = '".$_POST['product_id']."'";
  else if(!empty($name) && !empty($description) && empty($price))
    $query = "UPDATE `products` SET name ='".$name."',description ='".$description."' WHERE id = '".$_POST['product_id']."'";
  else if(!empty($name) && empty($description) && !empty($price))
    $query = "UPDATE `products` SET name ='".$name."',price ='".$price."' WHERE id = '".$_POST['product_id']."'";
  else if(empty($name) && !empty($description) && !empty($price))
    $query = "UPDATE `products` SET description ='".$description."',price ='".$price."' WHERE id = '".$_POST['product_id']."'";
  else if(empty($name) && !empty($description) && empty($price))
    $query = "UPDATE `products` SET description ='".$description."' WHERE id = '".$_POST['product_id']."'";
  else if(!empty($name) && empty($description) && empty($price))
    $query = "UPDATE `products` SET name ='".$name."' WHERE id = '".$_POST['product_id']."'";
  else if(empty($name) && empty($description) && !empty($price))
    $query = "UPDATE `products` SET price ='".$price."' WHERE id = '".$_POST['product_id']."'";

  mysqli_query($conn,$query);
  header("refresh:0;products.php");
}
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Administration area</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
<link rel="stylesheet" href="admin_style.css">
</head>
<body>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <h1>Products</h1>
      </div>
      <div class="col-md-6 pull">
        <a class="btn btn-primary add" href="products.php?action=add">Adauga</a>
      </div>
      <div class="col-md-12">
        <? if(isset($_GET['action']) && $_GET['action'] == 'edit'):
          $category_query = mysqli_query($conn,"SELECT * FROM categories");
          ?>
        <form action="products.php?action=edit" method="POST" autocomplete="off">
          <br>
          Nume:
          <input type="text" name="name" class="form-control">
          <br>
          Descriere:
          <input type="text" name="descriere" class="form-control">
          <br>
          Pret:
          <input type="text" name="price" class="form-control">
          <br>
          <input type="hidden" name="product_id" value="<?= $_GET['edit_id']; ?>">
          <input type="submit" value="Salveaza" class="btn btn-primary submit">
        </form>

      <? endif; ?>
            <? if(isset($_GET['action']) &&  $_GET['action'] == 'add'):

                $category_query = mysqli_query($conn,"SELECT * FROM categories");
               ?>
              <form action="products.php?action=add" method="POST" enctype="multipart/form-data" autocomplete="off">
                Categorie:
                <select name="category" class="form-control">
                  <option></option>
                  <? while($row = mysqli_fetch_array($category_query)): ?>
                    <option value="<?= $row['id']; ?>"><?= $row['name']; ?></option>
                  <? endwhile; ?>
                </select>
                <br>
                Nume:
                <input type="text" name="name" class="form-control">
                <br>
                Descriere:
                <input type="text" name="descriere" class="form-control">
                <br>
                Image:
                <input type="file" name="image">
                <br>
                Pret:
                <input type="text" name="price" class="form-control">
                <br>
                <input type="submit" value="Salveaza" class="btn btn-primary submit">
              </form>
            <? endif; ?>
      </div>
    </div>

    <table>
      <tr>
        <th width=200><b>ID</b></th>
        <th width=300><b>Name</b></th>
        <th width=500><b>Categorie</b></th>
        <th width=200><b>Action</b></th>
      </tr>
      <?
        $result = mysqli_query($conn,"SELECT * FROM products LIMIT $start,$end");
        while($row = mysqli_fetch_array($result)):
          $get_category = mysqli_query($conn,"SELECT name FROM categories WHERE id ='".$row['category_id']."'");
          while($row_j = mysqli_fetch_array($get_category)):
       ?>
       <tr>
         <td><?= $row['id']; ?></td>
         <td><?= $row['name']; ?></td>
         <td><?= $row_j['name']; ?></td>
         <td>
           <i class="fas fa-pencil-alt" onclick="window.location='products.php?page=<?= $_GET['page']; ?>&edit_id=<?= $row['id']; ?>&action=edit'"></i>
           &nbsp;&nbsp;&nbsp;
           <i class="far fa-times-circle" onclick="if(confirm('Are you sure?'))window.location='products.php?page=<?= $_GET['page']; ?>&edit_id=<?= $row['id']; ?>&action=remove'"></i>
         </td>
       </tr>
     <? endwhile;endwhile;?>
    </table>
    <br>
    <a href="products.php?page=<?= ($_GET['page'] - 1 == 0) ? $_SESSION['products_total'] : $_GET['page'] - 1;?>">
      <i class="fas fa-arrow-left arrow-page"></i>
    </a>
    &nbsp;&nbsp;&nbsp;
    <? for($i = 1;$i <= $_SESSION['products_total']; $i++): ?>
      <a href="products.php?page=<?= $i; ?>" class="<? if($_GET['page'] == $i) echo 'selected'; ?>"><?= $i; ?></a>
    <? endfor; ?>
    &nbsp;&nbsp;&nbsp;
    <a href="products.php?page=<?=  ($_GET['page'] + 1 == $_SESSION['products_total']+1) ? 1 : $_GET['page'] + 1; ?>">
        <i class="fas fa-arrow-right arrow-page"></i>
    </a>
  </div>
</body>
