<?php
class Home_view
{
    public function html()
    {
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pineapple.</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link rel="stylesheet" href="./public/assets/main.css">
</head>

<body>
    <div id="grid">
        <div id="left">
            <div id="top_bar">
                <a href="#" id="logo_pineapple">
                    <i class="fas fa-leaf"></i>
                    <span class="subheading" id="pineapple">pineapple.</span>
                </a>
                <div id="top_bar_links">
                    <a href="#" class="subheading">About</a>
                    <a href="#" class="subheading">How it works</a>
                    <a href="#" class="subheading">Contact</a>
                </div>

            </div>
            <p class="heading" id="heading">Subscribe to newsletter</p>
            <p class="subheading" id="subheading">Subscribe to our newsletter and get 10% discount on pineapple glasses.
            </p>
            <div id="input">
                <form action="" method="POST" id="form">
                    <div id="email_form">
                        <input type="email" name="email" id="email" placeholder="Type your email address here..." autofocus> <br>
                        <label for="email" class="subheading" id="errors"></label>
                        <label class="heading" id="submit_btn">
                            <input type="submit" id="submit" name="submit">
                            <i class="fas fa-long-arrow-alt-right"></i>
                        </label>
                    </div>
                        
                        <label id="tos">
                            <input type="checkbox" name="tos" id="tos_btn">
                            <span class="subheading">
                                I agree to <a href="#" class="link">terms of service</a>
                            </span>
                        </label>
                </form>
            </div>
            <hr>
            <div id="social_icons">
                <a href="#">
                    <div class="social facebook">
                        <i class="fab fa-facebook-f"></i>
                    </div>
                </a>
                <a href="#">
                    <div class="social instagram">
                        <i class="fab fa-instagram"></i>
                    </div>
                </a>
                <a href="#">
                    <div class="social twitter">
                        <i class="fab fa-twitter"></i>
                    </div>
                </a>
                <a href="#">
                    <div class="social youtube">
                        <i class="fab fa-youtube"></i>
                    </div>
                </a>
            </div>
        </div>

        <div id="right">
            <img src="./public/assets/images/image_summer.png" alt="">
        </div>
    </div>


    <!-- <script src="./public/scripts/app.js"></script> -->
</body>

</html>

<?php
    }
}
?>