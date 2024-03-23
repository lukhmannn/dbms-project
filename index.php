<?php include('partials-front/menu.php'); 

    if(!empty($_SESSION['id']))
    {
        $id=$_SESSION['id'];
        $res5=mysqli_query($conn,"SELECT * FROM tb_user WHERE id=$id");
        $row5=mysqli_fetch_assoc($res5);
    }
    else
    {
        header('location: userlogin.php');
    }

?>

<section id="hero">
        <section class="food-search text-center">
        <div>
            
            <form action="<?php echo SITEURL;?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
</section>

    <?php
            if(isset($_SESSION['order']))
            {
                echo $_SESSION['order'];
                unset($_SESSION['order']);
            }
    
    ?>
        
    <!-- CAtegories Section Starts Here -->
    <section id="feature" class="section-p1 categories">
        <div class="container">
            <h2 class="text-center">Explore</h2>

            <?php
                    //create swql query to display categories
                    $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";   
                    //EXEC THE QUERY
                    $res = mysqli_query($conn,$sql);
                    //count rows to check whether the catgory exists
                    $count =mysqli_num_rows($res);

                    if($count>0)
                    {
                        //category available
                        while($row=mysqli_fetch_assoc($res))
                        {
                            //get the values
                            $id = $row['id'];
                            $title = $row['title'];
                            $image_name = $row['image_name'];
                            ?>
                                    
                                    <a href="<?php echo SITEURL;?>category-foods.php?category_id=<?php echo $id;?>">
                                        <div  class="box-3 float-container">
                                            <?php 
                                            //check if img available
                                                if($image_name=="")
                                                {
                                                    //display message
                                                    echo "<div class='error'>Image Not Available</div>";
                                                }
                                                else
                                                {
                                                    //image available
                                                    ?>
                                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">

                                                    <?php
                                                }

                                            ?>

                                            <h6><?php echo $title;?></h6>
                                        </div>
                                    </a>

                            <?php
                        }
                    }
                    else
                    {
                        //category not available
                        echo "<div class='error'>Category Not Added</div>";
                    }

            ?>

        

          

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <form class="food-menu" method="POST">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 
                //GETTING FOODS FROM DATABASE THAT ARE ACTIVE AND FEATURED
                $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 6";

                //EXECTURE THE QUERY
                $res2 = mysqli_query($conn,$sql2);

                //count rows
                $count2 = mysqli_num_rows($res2);

                //check if food available or not
                if($count2>0)
                {
                    //food available
                    while($row=mysqli_fetch_assoc($res2))
                    {
                        //get all the values
                        $id =$row['id'];
                        $title = $row['title'];
                        $price=$row['price'];
                        $description = $row['description'];
                        $image_name=$row['image_name'];
                        ?>

                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php
                                    //check if image avaiblabe
                                    if($image_name=="")
                                    {
                                        //image nto available
                                        echo "<div class='error'>Image Not Available</div>";
                                    }                        
                                    else
                                    {
                                        //image available
                                        ?>

                                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name;?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve"> 

                                        <?php
                                    }        
                                ?>
                                
                            </div>

                            <div class="food-menu-desc">
                                <h4><?php echo $title; ?></h4>
                                <p class="food-price">₹<?php echo $price;?></p>
                                <p class="food-detail">
                                    <?php echo $description;?>
                                </p>
                                
                                <br>
                                <!-- <input type="hidden" name="title" value="<?php echo $title; ?>">
                                <input type="hidden" name="price" value="<?php echo $price; ?>">
                                <input type="number" name="quantity" value="1"> -->
                                <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                                <!-- <input type="submit" name="add_to_cart" class="btn btn-primary" value="Add To Cart"> -->
                            </div> 
                        </div>

                        <?php
                    }
                }
                else
                {
                    //not available
                    echo "<div class='error'>Food Not Available</div>";
                }
            
            ?>

          

         

            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="foods.php">See All Foods</a>
        </p>
            </form>
    <!-- fOOD Menu Section Ends Here -->

   

    <?php include('partials-front/footer.php');?>