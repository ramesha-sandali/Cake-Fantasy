<?php include('partials-front/menu.php'); ?>

<div class="inner-width">
    <form action="<?php echo SITEURL; ?>product-search.php" method="GET">
        <input type="search" name="search" placeholder="Search Here" required>
        <input type="submit" name="submit" value="search" class="btn-primary">
    </form>
</div> 

<section id="package">
    <div class="gallery">
        <?php
            //get the search keyword
            $search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
            
            if(!empty($search)) {
                $sql = "SELECT * FROM tbl_cakes WHERE title LIKE '%$search%' OR description LIKE '%$search%' ";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);

                if($count > 0){
                    while($row = mysqli_fetch_assoc($res))
                    {
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>
                            <div class="content3">
                                <img src="<?php echo SITEURL; ?>images/<?php echo $image_name; ?>">
                                <h2><?php echo $title; ?></h2>
                                <div class="button2">
                                    <button class="shop"><a href="<?php echo SITEURL; ?>view.php?id=<?php echo $id; ?>"> View & Order </a></button>
                                </div>
                            </div>
                        <?php
                    }
                }
                else{
                    echo "<script> alert('Product not available') </script>";
                }
            }
        ?>
    </div>
</section>
        
<?php include('partials-front/footer.php'); ?>
