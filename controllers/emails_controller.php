<?php
    require_once __DIR__ . "/../config/db_config.php";
    require_once __DIR__ . "/../views/emails_view.php";
    require_once __DIR__ . "/../models/Email_model.php";

    $model = new Email_model();
    
    $emails = [];
    
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }
    $no_of_records_per_page = 10;
    $offset = ($page-1) * $no_of_records_per_page;

    if(isset($_POST['delete'])){
        $model->delete_email_from_db($_POST['delete']);
    }

    if(isset($_POST['csv'])){
        $csv_data = $_POST['csv'];
        $csv_data_from_db = $model->get_emails_for_csv_exporting($csv_data);
        
        //export csv_data_from_db
        $headers = ["id", "email", "email_provider", "date_subscribed"];
        $fh = fopen("file.csv", "w");
        fputcsv($fh, $headers);
        foreach($csv_data_from_db as $fields){
            fputcsv($fh, $fields);
        }
        fclose($fh);
    } 

    if(isset($_POST['submit'])){
        $order_by = '';
        $direction = '';
        $email_provider = '';
        $search_value = '';

        switch ($_POST['order']) {
            case 'date_desc':
                $order_by = 'date_subscribed';
                $direction = 'DESC';
                break;
            case 'date_asc':
                $order_by = 'date_subscribed';
                $direction = 'ASC';
                break;
            case 'name_desc':
                $order_by = 'email';
                $direction = 'DESC';
                break;
            case 'name_asc':
                $order_by = 'email';
                $direction = 'ASC';
                break;
        }

        if(isset($_POST['search'])){
            $search_value = $_POST['search'];
            $search_value = strip_tags($search_value);
            $search_value = strtolower($search_value);
            $search_value = str_replace(' ', '', $search_value);
            $search_value = htmlspecialchars($search_value);
        }

        if(isset($_POST['email_provider'])){
            $email_provider = $_POST['email_provider'];
        }
        $emails = $model->get_emails_with_conditions($order_by, $direction, $email_provider, $search_value);
        } else{
            $total_email_count = $model->get_count();
            $total_pages = ceil($total_email_count/$no_of_records_per_page);
            echo 'Showing ' . $offset . '-' . ($offset+10) . ' of ' . $total_email_count;
            $emails = $model->get_emails($offset, $no_of_records_per_page);
    }
    
    



    $distinct_email_providers = $model->get_distinct_email_providers();
    $form = new Email_view($emails, $distinct_email_providers, $total_pages);
    $form->html();
?>