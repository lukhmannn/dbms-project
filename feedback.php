<?php include('config/constants.php');?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <section id="header">
        <a href="#"><img src="images/logo.jpg" class="logo" alt=""></a>
            

        <div>
            <ul id="navbar">
                <li><a class="active" href="<?php echo SITEURL; ?>">Home</a></li>
                <li><a href="<?php echo SITEURL; ?>categories.php">Categories</a></li>
                <li><a href="<?php echo SITEURL; ?>foods.php">Foods</a></li>
                <li><a href="<?php echo SITEURL; ?>feedback.php">Contact</a></li>
                <!-- <li><a href="mycart.php">My Cart (0)</a></li> -->
                <li><a href="userlogout.php">Logout</a></li>
                
            </ul>
        </div>

            <div class="clearfix"></div>
    </section>
    <!-- Navbar Section Ends Here -->
    <?php
        
        if(isset($_POST['submit']))
        {
            uploadData();
        }

    function uploadData()
    {

        
        if(isset($_POST['submit']))
        {
            $email=$_POST['email'];
            $feedBack=$_POST['feedBack'];
            echo  '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            feedback is submitted from' .$email. 'thankyou</div>';
    
        }
            $sql="INSERT INTO `storedfeedbacks` (`email`, `feedBack`, `date`) VALUES ('$email', '$feedBack', current_timestamp())";
            $res=mysqli_query($conn,$sql);

            if($res==true)
                                {
                                    //query exec and order saved
                                    $_SESSION['submit']="<div class='success text-center'>Order Placed Successfully</div>";
                                    header('location:'.SITEURL);
                                }
                                else
                                {
                                    //failed to save order
                                    $_SESSION['submit']="<div class='error text-center'>Failed To Order Food</div>";
                                    header('location:'.SITEURL);
                                }
    }
    ?>


    <div class="container mt-5">
        <h2 class="text-center">Enter Your Feedback</h2>
        <form action="feedback.php" method="POST">
        <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com">
                </div>
                <div class="mb-3">
                <label for="feedBack" class="form-label">Enter Your Feedback</label>
                <textarea class="form-control" name="feedBack" id="feedBack" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    
    <!-- social Section Starts Here -->
 <!-- <section class="social">
        <div class="container text-center">
            <ul>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/50/000000/facebook-new.png"/></a>
                </li>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/48/000000/instagram-new.png"/></a>
                </li>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/48/000000/twitter.png"/></a>
                </li>
            </ul>
        </div>
    </section>
    < social Section Ends Here -->

    <!-- footer Section Starts Here -->
    <!-- <section class="footer"> -->
        <!-- <div class="container text-center">
            <p>All rights reserved. Designed By <a href="#">OnlyFoods</a></p>
        </div>
    </section> -->
    <!-- footer Section Ends Here -->

</body>
</html>