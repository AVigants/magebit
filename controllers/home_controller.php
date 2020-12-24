<?php
    require_once __DIR__ . "/../config/db_config.php";
    require_once __DIR__ . "/../views/home_view.php";
    //declaring variables to prevent errors
    $email = '';
    $date_subscribed = '';
    $email_provider = '';
    $err_arr = [];
    $successful_submit = false;

    //submit event
    if (isset($_POST['submit'])) {
        $email = $_POST['email'];
        $email = strip_tags($email);
        $email = strtolower($email);
        $email = str_replace(' ', '', $email);
        $email = htmlspecialchars($email);
        
        $email_domain_extension = substr($email, -3);

        //$err_arr checks for subscribing

        if (!$email){
            $err_arr[] = 'Email address is required';
        }
        if (!preg_match('/^([a-z\d\.-]+)@([a-z\d-]+)\.([a-z]{2,8})(\.[a-z]{2,8})?$/', $email)) {
            $err_arr[] = 'Please provide a valid e-mail address';
        }
        if ($email_domain_extension == '.co'){
            $err_arr[] = 'We are not accepting subscriptions from Colombia emails';
        }
        if(!isset($_POST['tos'])){
            $err_arr[] = 'You must accept the terms and conditions';
        }

        if (!$err_arr) {
            $date_subscribed = date("Y-m-d H:i:s");
            $email_provider = substr($email, strpos($email, '@') + 1, strpos($email, '.') - strpos($email, '@') - 1);

            $sql = "INSERT INTO emails (email, email_provider, date_subscribed) VALUES ('$email', '$email_provider', '$date_subscribed')";
            DB::run($sql);
            $successful_submit = true;
        }
    }

    $form = new Home_view();
    $form->html($err_arr, $successful_submit, $successful_submit);
?>