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
        public function get_distinct_email_providers(){
            $sql = "SELECT DISTINCT email_provider FROM emails ORDER BY email_provider ASC";
            $response = DB::run($sql)->fetch_all(MYSQLI_ASSOC);
            return $response;
        }
        public function get_emails_from_db_order_by_date_desc(){
            $sql = "SELECT * FROM emails ORDER BY date_subscribed DESC";
            $response = DB::run($sql)->fetch_all(MYSQLI_ASSOC);
            return $response;
        }
        public function get_emails_from_db_order_by_date_asc(){
            $sql = "SELECT * FROM emails ORDER BY date_subscribed ASC";
            $response = DB::run($sql)->fetch_all(MYSQLI_ASSOC);
            return $response;
        }
        public function get_emails_from_db_order_by_name_asc(){
            $sql = "SELECT * FROM emails ORDER BY email ASC";
            $response = DB::run($sql)->fetch_all(MYSQLI_ASSOC);
            return $response;
        }
        public function get_emails_from_db_order_by_name_desc(){
            $sql = "SELECT * FROM emails ORDER BY email DESC";
            $response = DB::run($sql)->fetch_all(MYSQLI_ASSOC);
            return $response;
        }
        public function get_emails_from_db_filter_by_provider($email_provider){
            $sql = "SELECT * FROM emails WHERE email_provider = '$email_provider'";
            $response = DB::run($sql)->fetch_all(MYSQLI_ASSOC);
            return $response;
        }
        public function get_emails_from_db_by_reference($search_value){
            $sql = "SELECT * FROM emails WHERE email LIKE '%" . "$search_value" . "%'";
            $response = DB::run($sql)->fetch_all(MYSQLI_ASSOC);
            return $response;
        }

    };
?>
