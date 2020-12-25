<?php
    require_once __DIR__ . "/../config/db_config.php";
    require_once __DIR__ . "/../views/emails_view.php";
    require_once __DIR__ . "/../models/Email_model.php";

    $model = new Email_model();
    
    $emails = [];
    $no_of_records_per_page = 10;

    if (isset($_GET['page'])) {
        $current_page = $_GET['page'];
    } else {
        $current_page = 1;
    }
    $offset = ($current_page-1) * $no_of_records_per_page;

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

    if(isset($_GET['order'])){
        $order_by = '';
        $direction = '';
        $email_provider = '';
        $search_value = '';

        switch ($_GET['order']) {
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

        if(isset($_GET['search'])){
            $search_value = $_GET['search'];
            $search_value = strip_tags($search_value);
            $search_value = strtolower($search_value);
            $search_value = str_replace(' ', '', $search_value);
            $search_value = htmlspecialchars($search_value);
        }

        if(isset($_GET['email_provider'])){
            $email_provider = $_GET['email_provider'];
        }

        $total_email_count = $model->get_emails_count($email_provider, $search_value);
        $total_pages = ceil($total_email_count/$no_of_records_per_page);

        $emails = $model->get_emails($order_by, $direction, $email_provider, $search_value, $offset, $no_of_records_per_page);
    } else {
        $total_email_count = $model->get_emails_count('', '');
        $total_pages = ceil($total_email_count/$no_of_records_per_page);
        $emails = $model->get_emails('date_subscribed', 'DESC', '', '', $offset, $no_of_records_per_page);
    }
    
    $distinct_email_providers = $model->get_distinct_email_providers();
    $form = new Email_view($emails, $distinct_email_providers, $total_pages);
    $form->html();
?>