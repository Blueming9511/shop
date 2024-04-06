<?php
include "header.php";
include "sidebar.php";
include "class/category_class.php";
?>

<?php
$category = new Category;
$showCategory = $category->showCategory();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $categoryName = $_POST['categoryName'];
  $insert = $category->insertCategory($categoryName);
}
?>

<div class="right">
  <div class="list">
    <h1>CATEGORIES LIST</h1>
    <table>
      <tr>
        <th>No.</th>
        <th>ID</th>
        <th>Name</th>
        <th colspan = "2">Action</th>
      </tr>
      <?php
      if ($showCategory) {
        $i = 0;
        while ($result = $showCategory->fetch_assoc()) {
          $i++;
      ?>
          <tr>
            <td><?php echo $i ?></td>
            <td><?php echo $result['category_id'] ?></td>
            <td><?php echo $result['category_name'] ?></td>
            <td>
              
              <a class="btn" href="categoryedit.php?category_id=<?php echo $result['category_id'] ?>">
                Edit
              </a>
            </td>
            <td>
              <a class="btn" href="categorydelete.php?category_id= <?php echo $result['category_id'] ?>">
                Delete
              </a>
            </td>



          </tr>
      <?php
        }
      }
      ?>
    </table>
  </div>
</div>
</section>
</body>

</html>