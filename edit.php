<?php include 'db.php'; ?>
<?php include 'layout.php'; ?>

<?php
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM products WHERE id=$id");
$product = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST['name'];
  $desc = $_POST['description'];
  $price = $_POST['price'];

  $imageName = $product['image']; 
  if (!empty($_FILES['image']['name'])) {
      $imageName = time() . "_" . basename($_FILES['image']['name']);
      move_uploaded_file($_FILES['image']['tmp_name'], "uploads/".$imageName);
  }

  $sql = "UPDATE products SET name='$name', description='$desc', price='$price', image='$imageName' WHERE id=$id";
  if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Product updated!'); window.location='Admin.php';</script>";
  } else {
    echo "Error: " . $conn->error;
  }
}
?>

<?php startLayout("Edit Product"); ?>

<h3>Edit Product</h3>
<form method="post" enctype="multipart/form-data">
  <div class="mb-3">
    <label>Name</label>
    <input type="text" name="name" class="form-control" value="<?php echo $product['name']; ?>" required>
  </div>
  <div class="mb-3">
    <label>Description</label>
    <textarea name="description" class="form-control"><?php echo $product['description']; ?></textarea>
  </div>
  <div class="mb-3">
    <label>Price</label>
    <input type="number" step="0.01" name="price" class="form-control" value="<?php echo $product['price']; ?>" required>
  </div>
  <div class="mb-3">
    <label>Product Image</label><br>
    <?php if (!empty($product['image'])): ?>
      <img src="uploads/<?php echo $product['image']; ?>" width="100"><br><br>
    <?php endif; ?>
    <input type="file" name="image" class="form-control">
  </div>
  <button type="submit" class="btn btn-primary">Update</button>
</form>

<?php endLayout(); ?>
