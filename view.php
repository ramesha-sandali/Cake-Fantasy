<?php include('partials-front/menu.php'); ?>
<link rel="stylesheet" href="css/stylesQV.css">

<div class="quick-view-container">

<?php
if (isset($_GET['id'])) 
{
    $id = (int) $_GET['id'];

    $sql = "SELECT * FROM tbl_cakes WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) 
    {
        $row = mysqli_fetch_assoc($result);
?>

        <div class="product-image">
            <img src="<?php echo SITEURL; ?>images/<?php echo $row['image_name']; ?>" 
                 alt="<?php echo $row['title']; ?>">
        </div>

        <div class="product-details">
            <h2><?php echo $row['title']; ?></h2>
            <p><?php echo $row['description']; ?></p>
            <p>Price: RS. <?php echo $row['price']; ?></p>

            <a href="<?php echo SITEURL; ?>add_to_cart.php?id=<?php echo $id; ?>&action=add">
                <button>Add to Cart</button>
            </a>
        </div>

<?php
    }
    else
    {
        echo "Cake not found.";
    }
}
?>

</div>