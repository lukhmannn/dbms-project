<?php include('partials-front/menu.php');?>

<?php
        //check whether food id is set or not
        if(isset($_GET['food_id']))
        {
            //get food id and details of selected food
            $food_id=$_GET['food_id'];

            //get the dtails of the selected food
            $sql="SELECT * FROM tbl_food WHERE id=$food_id";
            //execute the query
            $res=mysqli_query($conn,$sql);
            //count the rows
            $count=mysqli_num_rows($res);
            //chedck whether data is available or not
            if($count==1)
            {
                //we have data
                //get the data from db
                $row=mysqli_fetch_assoc($res);
                $title=$row['title'];
                $price=$row['price'];
            
                $image_name=$row['image_name'];
            }
            else
            {
                //food not available
                header('location:'.SITEURL);
            }
        }
        else
        {
            //redirect to home page
            header('location:'.SITEURL);
        }

?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-searchhh">
        <div class="container">
            
            <!-- <h2 class="text-center text-white">Fill this form to confirm your order.</h2> -->

            <form action="" method ="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <?php 
                                //check whether the image is available or not
                                if($image_name=="")
                                {
                                    //image no
                                    echo "<div class='error'>Image Not Available</div>";
                                }
                                else
                                {
                                    //image yes
                                    ?>
                                        
                                        <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">

                                    <?php
                                }
                        
                        ?>
                       
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">


                        <p class="food-price">₹<?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <form> 
                    <!-- <legend>Delivery Details</legend> -->
                    <br>
                    <div class="input-box">Full Name</div>
                    <input type="text" name="full-name" placeholder="Enter Your Full Name" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="Enter Your Contact No." class="input-responsive" required>

                    <!-- <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="Enter Your Email" class="input-responsive" required> -->

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="5" placeholder="Enter Your Address" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </form>

            </form>

            <?php
                    //check if submit btn clicked
                    if(isset($_POST['submit']))
                    {
                        //get all the details from the form

                        $food=$_POST['food'];
                        $price=$_POST['price'];
                        $qty=$_POST['qty'];
                        $total=$price * $qty;

                        $order_date=date("Y-m-d h:i:sa");

                        $status="Ordered";

                        $customer_name=$_POST['full-name'];
                        $customer_contact=$_POST['contact'];
                        $customer_email=$_POST['email'];
                        $customer_address=$_POST['address'];

                        //save the order in db
                        //sql to save
                        $sql2="INSERT INTO tbl_order SET 
                                food='$food',price=$price,qty=$qty,total=$total,order_date='$order_date',
                                status='$status',customer_name='$customer_name',customer_contact='$customer_contact',
                                customer_email='$customer_email',customer_address='$customer_address'
                                ";

                                //echo $sql2; die();

                                //exec the query
                                $res2 =mysqli_query($conn,$sql2);

                                //check if query exec or not
                                if($res2==true)
                                {
                                    //query exec and order saved
                                    $_SESSION['order']="<div class='success text-center'>Order Placed Successfully</div>";
                                    header('location:'.SITEURL);
                                }
                                else
                                {
                                    //failed to save order
                                    $_SESSION['order']="<div class='error text-center'>Failed To Order Food</div>";
                                    header('location:'.SITEURL);
                                }
                        
                    }
            
            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php include('partials-front/footer.php');?>