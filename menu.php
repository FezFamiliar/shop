<div class="aside">
  <ul>
    <?
    $result = mysqli_query($conn,"SELECT * FROM categories");

       while($row = mysqli_fetch_array($result)): ?>
        <li>
          <a href="?category_id=<?= $row['id']; ?>&page=1" class="<? if(isset($_GET['category_id']) && $_GET['category_id'] == $row['id']) echo 'menu-highlight';?>"><?= $row['name']; ?></a>
        </li>
      <? endwhile; ?>
    <? if(isset($_GET['category_id'])): ?>
      <a href="?category_id=<?= $_GET['category_id']; ?>&page=<?= (($_GET['page']) % ($_SESSION['totalpage']+1) == 1) ? $_SESSION['totalpage'] : $_GET['page'] - 1; ?>"class="prev">
        <img src="lightbox/images/prev.png">
      </a>
    <? endif; ?>
  </ul>
  <form action="search.php" method="GET" class="search-form" autocomplete="off">
    <input type="text" name="search-term">
    <input type="submit" value="Search">
  </form>
</div>
