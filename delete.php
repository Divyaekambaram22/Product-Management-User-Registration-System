<?php include 'db.php'; ?>
<?php
$id = $_GET['id'];
$result = $conn->query("SELECT image FROM products WHERE id=$id");
$row = $result->fetch_assoc();
if (!empty($row['image']) && file_exists("uploads/".$row['image'])) {
    unlink("uploads/".$row['image']);
}
$conn->query("DELETE FROM products WHERE id=$id");
echo "<script>alert('Product deleted!'); window.location='Admin.php';</script>";
?>
