<?php include('partials-front/menu.php');?>


<section class="food-searchh text-center">
        <div class="container">
            <form action="<?php echo SITEURL;?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>
        </div>
</section>
    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
                //DISPLAY all the categories that are actuve
                $sql = "SELECT * FROM tbl_category WHERE active='Yes' LIMIT 3";

                //execute the query
                $res= mysqli_query($conn,$sql);
                //count rows
                $count = mysqli_num_rows($res);

                //check whether catgory available
                if($count>0)
                {
                    //category available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //get the values
                        $id =$row['id'];
                        $title = $row['title'];
                        $image_name=$row['image_name'];
                        ?>

                        
                        <a href="<?php echo SITEURL;?>category-foods.php?category_id=<?php echo $id;?>">
                            <div class="box-3 float-container">
                                <?php
                                    if($image_name=="")
                                    {
                                        //image not available
                                        echo "<div class='error'>Image Not Found</div>";

                                    }
                                    else
                                    {
                                        //image available
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name;?>" alt="Pizza" class="img-responsive img-curve">

                                        <?php
                                    }
                                ?>
                                

                                <h3 class="float-text text-white"><?php echo $title; ?></h3>
                            </div>
                        </a>

                        <?php
                    }
                }
                else
                {
                    //category not available
                    echo "<div class='error'>Category Not Found</div>";
                }
            ?>



            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


    <?php include('partials-front/footer.php');?>