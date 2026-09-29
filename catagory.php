<?php include('partials-front/menu.php'); ?>

    <section id="Catalog">
    <h1>What We Offer</h1>
    <div class="gallery">

    <?php
        //display all the catagories that are active
        $sql = "SELECT * FROM tbl_catagory";
        //execute the query
        $res = mysqli_query($conn, $sql);
        //count rows
        $count = mysqli_num_rows($res);

        //check whether catagories available or not
        if($count>0)
        {
            //catagories available
            while($row=mysqli_fetch_assoc($res))
            {
                $id = $row['id'];
                
                $title = $row['title'];
                $image_name = $row['image_name'];
                ?>

                    <div class="content3">
                        <?php
                            if($image_name=="")
                            {
                                //image not available
                                echo "<script> alert('Image not available') </script>";

                            }
                            else{
                                //image available
                                ?>
                                <img src="<?php echo SITEURL; ?>images/<?php echo $image_name; ?>">

                                <?php
                            }
                        ?>
                        <p><?php echo $title; ?></p>
                        <ul>
                            <li><i class="fa fa-star checked"></i></li>
                            <li><i class="fa fa-star checked"></i></li>
                            <li><i class="fa fa-star checked"></i></li>
                            <li><i class="fa fa-star checked"></i></li>
                            <li><i class="fa fa-star "></i></li>
                        </ul>
                        <div class="button1">
                            <button class="order-1"><?php
                                   
                                   echo "<a href='product.php?catagory_id=" . $row['id'] . "'>Order Now</a><br>";?></button>
                        </div>
                    </div>

                <?php
            }
        }
        else{
            //catagories not available
            echo "<script> alert('Catagory not available') </script>";

        }
    ?>

<div class="content3">
            <img src="images/custom.jpg">
            <p>Customize Your Owm</p>
            <ul>
                <li><i class="fa fa-star checked"></i></li>
                <li><i class="fa fa-star checked"></i></li>
                <li><i class="fa fa-star checked"></i></li>
                <li><i class="fa fa-star checked"></i></li>
                <li><i class="fa fa-star checked"></i></li>
            </ul>
            <div class="button1">
                <button class="order-6"><a href="customize.php">Order Now</a></button>
            </div>
        </div>          

    </div>

    
</section>

<?php include('partials-front/footer.php'); ?>


