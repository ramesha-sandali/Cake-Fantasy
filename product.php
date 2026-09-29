<?php include('partials-front/menu.php'); ?>

    <section id="package">
        <div class="gallery">

        <?php
            if(isset ($_GET['catagory_id']))
            {
                $catagory_id = (int) $_GET['catagory_id'];
                $sql2 ="SELECT * FROM tbl_cakes WHERE catagory_id = $catagory_id";
            }else{
                $sql2 = "SELECT * FROM tbl_cakes";
            }
            //getting cakes from database
            //$sql2 = "SELECT tbl_cakes.* FROM tbl_cakes INNER JOIN tbl_catagory ON tbl_cakes.catagory_id = tbl_catagory.id";

            //execute the query
            $res2 = mysqli_query($conn, $sql2);
            //count rows
            $count2 = mysqli_num_rows($res2);

            //check whether the products is available or not
            if($count2>0)
            {
                //product available
                while($row=mysqli_fetch_assoc($res2))
                {
                    //get all the values
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    ?>

                        <div class="content3">
                            <?php
                             
                                //check whether image is available or not
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
                            <h2><?php echo $title; ?></h2>
                            <div class="button2">
                                <button class="shop">
                            <?php
                                 
                                echo "<a href='view.php?id=" . $row['id'] . "'>Add to cart</a><br>";?></button>
                            </div>
                        </div>   

                    <?php
                }
            }
            else{
                //product not available
                echo "<script> alert('Product not available') </script>";

            }
        ?>

        </div>
        

<?php include('partials-front/footer.php'); ?>
