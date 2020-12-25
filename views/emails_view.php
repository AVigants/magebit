<?php

class Email_view
{
    public function __construct($emails = [], $distinct_email_providers = [], $total_pages)
    {
        $this->emails = $emails;
        $this->distinct_email_providers = $distinct_email_providers;
        $this->total_pages = $total_pages;
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
        html,
        body {
            margin: 1%;
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
        }
    </style>
</head>

<body>
    <form action="emails.php" method="get">
        <?php if($this->total_pages > 1){ ?>
        <span>Page:</span>
        <?php for($page = 1; $page <= $this->total_pages; $page++){ ?>
        <input type="submit" name="page" value="<?= $page ?>">
        <?php } } ?>
        <br> <br>
        <label for="">
            Filter emails whose providers are:
            <select name="email_provider">
                <option value=""></option>
                <?php foreach($this->distinct_email_providers as $email_provider){ ?>
                <option value="<?= $email_provider['email_provider'] ?>" <?=(isset($_GET['email_provider']) &&
                    $_GET['email_provider']===$email_provider['email_provider']) ? "selected" : '' ?>>
                    <?= $email_provider['email_provider'] ?>
                </option>
                <?php } ?>
            </select>
        </label>
        <br> <br>

        <label for="">
            Order by:
            <select name="order">
                <?= isset($_GET['search']) ? $_GET['search'] : '' ?>
                <option value="date_desc" <?=(isset($_GET['order']) && $_GET['order']==='date_desc' )? "selected" : ''
                    ?>>
                    Date NEWEST
                </option>
                <option value="date_asc" <?=(isset($_GET['order']) && $_GET['order']==='date_asc' )? "selected" : '' ?>>
                    Date OLDEST
                </option>
                <option value="name_asc" <?=(isset($_GET['order']) && $_GET['order']==='name_asc' )? "selected" : '' ?>>
                    Name A-Z
                </option>
                <option value="name_desc" <?=(isset($_GET['order']) && $_GET['order']==='name_desc' )? "selected" : ''
                    ?>>
                    Name Z-A
                </option>
            </select>
        </label>
        <br> <br>

        <label for="">
            <input type="search" name="search" placeholder="Search for an email..."
                value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>">
        </label>
        <br> <br>
        <input type="submit" value="search">
    </form>
    <br> <br>

    <table>
        <tr>
            <th>Email</th>
            <th>Email Provider</th>
            <th>Date Subscribed</th>
            <th>Actions</th>
        </tr>
        <form action="emails.php" method="POST">
            <?php foreach($this->emails as $email){ ?>
            <tr id="<?= $email['id'] ?>">
                <td>
                    <?= $email['email'] ?>
                </td>
                <td>
                    <?= $email['email_provider'] ?>
                </td>
                <td>
                    <?= $email['date_subscribed'] ?>
                </td>
                <td>
                    <button type="submit" name="delete" value="<?= $email['id'] ?>">Delete</button>
                    <label>CSV export
                        <input type="checkbox" value="<?= $email['id'] ?>" name="csv[]">
                    </label>
                </td>
            </tr>
            <?php } ?>
    </table>
    <br>
    <input type="submit" value="Export as CSV">
    </form>

</body>

</html>

<?php
    }
}
?>