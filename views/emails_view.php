<?php

class Email_view
{
    private $emails;
    // private $email_providers;
    public function __construct($emails = [], $distinct_email_providers = [])
    {
        $this->emails = $emails;
        $this->distinct_email_providers = $distinct_email_providers;
    }
    public function html()
    {


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>emails</title>
    <style>
        html, body{
            margin: 1%;
        }
        table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
        }
        th, td {
            padding: 10px;
        }
        form{
            display:inline-block;
        }
    </style>
</head>
<body>
    <label for="">
        Filter emails whose providers are: 
        <form method="POST">
            <select name="filter" onchange="this.form.submit()">
                <option value=""></option>
                <?php foreach($this->distinct_email_providers as $email_provider){ ?>
                    <option value="<?= $email_provider['email_provider'] ?>"> <?= $email_provider['email_provider'] ?> </option>
                <?php } ?>
            </select>
            <noscript><input type="submit" value="Submit"></noscript>
        </form>
    </label>
    <br> <br>

    <label for="">
        Order by:
        <form method="POST">
            <select name="order" onchange="this.form.submit()">
                <option value=""></option>
                <option value="date_desc">Date NEWEST</option>
                <option value="date_asc">Date OLDEST</option>
                <option value="name_asc">Name A-Z</option>
                <option value="name_desc">Name Z-A</option>
            </select>
            <noscript><input type="submit" value="Submit"></noscript>
        </form>
    </label>
    <br> <br>

    <label for="">
        <form method="POST">
            <input type="search" name="search" placeholder="Search for an email...">
            <input type="submit" value="Search">
        </form>
    </label>
    <br> <br>
    <table>
        <tr>
            <th>Email</th>
            <th>Email Provider</th>
            <th>Date Subscribed</th>
            <th>Actions</th>
        </tr>
        <?php foreach($this->emails as $email){ ?>
            <tr id="<?= $email['id'] ?>">
                <td><?= $email['email'] ?></td>
                <td><?= $email['email_provider'] ?></td>
                <td><?= $email['date_subscribed'] ?></td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="email_id" value="<?= $email['id'] ?>">
                        <button type="submit" name="delete">Delete</button>
                    </form>
                    <label>CSV export
                        <input type="checkbox">
                    </label>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>

<?php
    }
}
?>