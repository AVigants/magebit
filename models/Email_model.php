<?php

    class Email_model {

        public function insert_email_into_db(){
            $sql = "SELECT id, fname, username, about, profile_pic FROM users WHERE id = '$this->user_id'";
            $response = DB::run($sql)->fetch_assoc();
            return $response;
        }

        public function delete_email_from_db($email_id){
            $sql = "DELETE FROM emails WHERE id = '$email_id'";
            DB::run($sql);
        }

        public function get_emails_for_csv_exporting($id_arr){
            $sql = "SELECT * FROM emails WHERE id IN (";
            foreach ($id_arr as $key => $value){
                $sql_chain = $value . ', ';
                $sql = $sql . $sql_chain;
            }
            $sql = substr($sql, 0, -2);
            $sql = $sql . ')';
            $response = DB::run($sql)->fetch_all(MYSQLI_ASSOC);
            return $response;
        }

        public function get_distinct_email_providers(){
            $sql = "SELECT DISTINCT email_provider FROM emails ORDER BY email_provider ASC";
            $response = DB::run($sql)->fetch_all(MYSQLI_ASSOC);
            return $response;
        }

        public function get_emails_count($email_provider, $search_value){
            $sql = '';
            if(!$email_provider){
                $sql = "SELECT COUNT(email) AS num_emails FROM emails WHERE email LIKE '%" . "$search_value" . "%'";
            } else{
                $sql = "SELECT COUNT(email) AS num_emails FROM emails WHERE email_provider = '$email_provider' AND email LIKE '%" . "$search_value" . "%'";
            }
            $response = DB::run($sql)->fetch_assoc();
            $num_emails = $response['num_emails'];
            return $num_emails;
        }
        public function get_emails($order_by, $direction, $email_provider, $search_value, $offset, $no_of_records_per_page){
            $sql = '';
            if(!$email_provider){
                $sql = "SELECT * FROM emails WHERE email LIKE '%" . "$search_value" . "%' ORDER BY $order_by $direction LIMIT $offset, $no_of_records_per_page";
            } else{
                $sql = "SELECT * FROM emails WHERE email_provider = '$email_provider' AND email LIKE '%" . "$search_value" . "%' ORDER BY $order_by $direction LIMIT $offset, $no_of_records_per_page";
            }
            $response = DB::run($sql)->fetch_all(MYSQLI_ASSOC);
            return $response;
        }
    };




?>
