<?php include('partials-front/menu.php'); ?>

<?php
if(isset($_SESSION['order']))
{
    echo $_SESSION['order'];

}
?>


  <section id="home">
    <div class="content1">
      <div class="title">
        <h1>Delicious Cakes <br> For You</h1>
      </div>
      <div class="image"></div>
    </div>
    <div class="content2">
      <div class="image"></div>
      <div class="title">
        <p><b>It's always good time for cakes! Made with care and prepared with love.</b></p>
        <p><b>Find Your Favourite Now!</b></p>
        <button><a href="#Catalog">Order Now</a></button>
      </div>
    </div>
    <div class="social-container">
      <ul class="social-icons">
        <li><a href="https://www.facebook.com/profile.php?id=100090908554533&mibextid=ZbWKwL"><i class="fa fa-facebook-f"></i></a></li>
        <li><a href="https://www.instagram.com/cakefantasy_/profilecard/?igsh=MWk0Znl0NWk4dXhrOQ=="><i class="fa fa-instagram"></i></a></li>
        <li><a href="https://wa.me/message/Z45ZRTGDQPORP1"><i class="fa fa-whatsapp"></i></a></li>
      </ul>
    </div>
  </section>


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


<section id="Newcard">
    <h1> <b> New Products </b></h1>
    <div class="container1">
        <div class="card">
            <img src="images/cheesecake.jpg" alt="Cheese Cake">
            <div class="intro">
                <h1>Cheesecake</h1>
                <h5>Your Ultimate Cheesecake Craving</h5>
            </div>
        </div>
        <div class="card">
            <img src="images/macaroon.jpg" alt="Macaroons">
            <div class="intro">
                <h1>Macaroons</h1>
                <h5>Daisy Miller Delightful Bites</h5>
            </div>
        </div>
        <div class="card">
            <img src="images/brownie.jpg" alt="Brownies">
            <div class="intro">
                <h1>Brownies</h1>
                <h5>Brownie Bliss in Every Bite</h5>
            </div>
        </div>
    </div>
</section>

<section id="Choose">
    <div class="Choose">
        <h1> WHY CHOOSE US </h1>
        <img src="images/cupcakes-1.png">
        <div class="para1">
            <h3> QUALITY PRODUCTS</h3> 
            <p> We guarantee the quality of all the <br> cakes we provide as they are baked<br> using the freshest ingredients </p>  
        </div>
        <div class="para2">
            <h3> CATERING SERVICE </h3> 
            <p> Our bakery also provides an <br>outstanding catering service for events<br> and special occasions </p>  
        </div>
        <div class="para3">
            <h3> DELIVERY SERVICE </h3> 
            <p> We accept delivery by<br> our friendly clients are <br>requested to deliver the order </p>  
        </div>
        <div class="para4">
            <h3> ONLINE PAYMENT </h3> 
            <p> We accept all kinds<br> of online payments<br> including Visa, MasterCard </p>  
        </div>
    </div>
</section>

<section id="Sale">
    <div class="Sale">
        <h3>Summer Sale</h3><br>
        <h4>UP TO 5% ON SELECTED CAKES</h4><br>
        
        <p>Purchase our tasty cakes and sweets <br> for your next event or family functions at our <br> online shop and save more money than anywhere</p>
        <button><a href="catagory.php">Order Now</a></button>

    </div>
    
</section>

<section id="Aboutus">
    <div class="Aboutus">
        <h1>About Us</h1>
        <img src="images/logo.jpg" alt="Avatar">
        <div class="container4">
        <p>We specialize in selling cakes, cupcakes and desserts. But we also have two cozy cafes. In them you can not only try some of the best cakes in our city. You can have a wonderful time with the whole family. We allow people to order individual cakes according to their design for any holiday.</p>
    </div>
</section>



<?php include('partials-front/footer.php'); ?>
























