<?php
class Home_view
{
    public function html($err_arr, $successful_submit)
    {
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pineapple.</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link rel="stylesheet" href="./public/assets/styles.css">
</head>

<body>
    <div class="left">
        <div id="top_bar">
            <a href="#" id="logo_pineapple">
                <img src="./public/assets/images/logo_pineapple.svg" alt="" id="pineapple_with_text">
                <img src="./public/assets/images/Union.png" alt="" id="pineapple_without_text">
            </a>
            <div id="top_bar_links">
                <a href="#" class="subheading">About</a>
                <a href="#" class="subheading">How it works</a>
                <a href="#" class="subheading">Contact</a>
            </div>

        </div>

        <div id="main">
            <div id="wrapper">
                <div id="banner">
                    <p class="heading" id="heading">
                        <?= $successful_submit? 'Thanks for subscribing!' : 'Subscribe to newsletter' ?>
                    </p>
                    <p class="subheading" id="subheading">
                        <?= $successful_submit? 'You have successfully subscribed to our email listing. Check your email for the discount code.' : 'Subscribe to our newsletter and get 10% discount on pineapple glasses.' ?>
                    </p>
                </div>
                <div id="input">
                    <?php if(!$successful_submit){ ?>
                    <form action="home.php" method="POST" id="form">
                        <div id="email_form">
                            <div id="email_wrapper">
                                <input type="email" name="email" id="email"
                                    placeholder="Type your email address here..." autofocus>
                                <label class="heading" id="submit_btn">
                                    <input type="submit" id="submit" name="submit">
                                    <div id="arrow">
                                    </div>
                                </label>
                            </div>
                            <br>
                            <label for="email" class="subheading" id="errors">
                                <?= $err_arr ? $err_arr[0] : '' ?>
                            </label>

                        </div>

                        <label id="tos">
                            <input type="checkbox" name="tos" id="tos_btn">
                            <span class="subheading">
                                I agree to <a href="#" class="link">terms of service</a>
                            </span>
                        </label>
                    </form>
                    <?php } ?>
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
        </div>
    </div>

    <div class="right">
    </div>


    <script src="./public/scripts/app.js"></script>
</body>

</html>

<?php
    }
}
?>