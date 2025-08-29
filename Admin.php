<?php include 'db.php'; ?>
<?php include 'layout.php'; ?>
<?php startLayout("All Products"); ?>

<h3 class="mb-4">All Products</h3>
<div class="row">
<?php
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    echo '<div class="col-md-4 mb-3">';
    echo '<div class="card h-100">';
    if (!empty($row['image'])) {
        echo '<img src="uploads/'.$row['image'].'" class="card-img-top" style="height:200px; object-fit:cover;">';
    }
    echo '<div class="card-body">';
    echo '<h5 class="card-title">'.htmlspecialchars($row['name']).'</h5>';
    echo '<p class="card-text">'.htmlspecialchars($row['description']).'</p>';
    echo '<p><strong>₹'.number_format($row['price'], 2).'</strong></p>';
    echo '<a href="edit.php?id='.$row['id'].'" class="btn btn-primary btn-sm">Edit</a> ';
    echo '<a href="delete.php?id='.$row['id'].'" class="btn btn-danger btn-sm" onclick="return confirm(\'Delete this product?\')">Delete</a>';
    echo '</div></div></div>';
  }
} else {
  echo "<p>No products found.</p>";
}
?>
</div>

<?php endLayout(); ?>
