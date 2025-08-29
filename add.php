<?php include 'db.php'; ?>
<?php include 'layout.php'; ?>
<?php startLayout("Add Product"); ?>

<h3>Add Product</h3>
<form method="post" enctype="multipart/form-data">
  <div class="mb-3">
    <label>Name</label>
    <input type="text" name="name" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Description</label>
    <textarea name="description" class="form-control"></textarea>
  </div>
  <div class="mb-3">
    <label>Price</label>
    <input type="number" step="0.01" name="price" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Product Image</label>
    <input type="file" name="image" class="form-control">
  </div>
  <button type="submit" class="btn btn-success">Save</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST['name'];
  $desc = $_POST['description'];
  $price = $_POST['price'];

  $imageName = "";
  if (!empty($_FILES['image']['name'])) {
      $imageName = time() . "_" . basename($_FILES['image']['name']);
      move_uploaded_file($_FILES['image']['tmp_name'], "uploads/".$imageName);
  }

  $sql = "INSERT INTO products (name, description, price, image) VALUES ('$name', '$desc', '$price', '$imageName')";
  if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Product added!'); window.location='Admin.php';</script>";
  } else {
    echo "Error: " . $conn->error;
  }
}
?>

<?php endLayout(); ?>
