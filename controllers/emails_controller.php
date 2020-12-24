<?php
    require_once __DIR__ . "/../config/db_config.php";
    require_once __DIR__ . "/../views/emails_view.php";
    require_once __DIR__ . "/../models/Email_model.php";

    $model = new Email_model();
    
    //declaring variables to prevent errors
    $emails = '';
    //todo declare some variables


    if(isset($_POST['delete'])){
        $model->delete_email_from_db($_POST['email_id']);
    }

    if(isset($_POST['order'])){
        if($_POST['order'] === 'date_desc'){
            $emails = $model->get_emails_from_db_order_by_date_desc();
        } else if ($_POST['order'] === 'date_asc'){
            $emails = $model->get_emails_from_db_order_by_date_asc();
        } else if ($_POST['order'] === 'name_asc'){
            $emails = $model->get_emails_from_db_order_by_name_asc();
        } else if ($_POST['order'] === 'name_desc'){
            $emails = $model->get_emails_from_db_order_by_name_desc();
        }
    } else{
        $emails = $model->get_emails_from_db_order_by_date_desc();
    }
    if(isset($_POST['filter'])){
        $emails = $model->get_emails_from_db_filter_by_provider($_POST['filter']);
    }
    if(isset($_POST['search'])){
        $search_value = $_POST['search'];
        $search_value = strip_tags($search_value);
        $search_value = strtolower($search_value);
        $search_value = str_replace(' ', '', $search_value);
        $search_value = htmlspecialchars($search_value);
        $emails = $model->get_emails_from_db_by_reference($search_value);
    }
    //todo transform post into get requests
    //export csv



    $distinct_email_providers = $model->get_distinct_email_providers();



    $form = new Email_view($emails, $distinct_email_providers);
    $form->html();
?>