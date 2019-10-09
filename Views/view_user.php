<html lang="en" class="no-js main">
<head>
    <title>Account</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://s3-us-west-2.amazonaws.com/s.cdpn.io/905237/bonsaiUI-custombuild.css" />
    <link rel="stylesheet" href="css/wallet.scss">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<section>
    <h1>Account</h1>
    <div class="box">
        <table>
            <thead>
            <tr>
                <th scope="col">Num account</th>
                <th scope="col">Balance</th>
                <th scope="col">Currency</th>
            </tr>
            </thead>
            <?php
                $sum_account = 0;
                $sum_balance = 0;
            ?>
            <?php foreach ($data as $a): ?>
            <tr>
                <td scope="col"><?= e($a['number']) ?></td>
                <td scope="col"><?= e($a['balance']) ?></td>
                <td scope="col"><?= e($a['name']) ?></td>
            </tr>
            <?php
                $sum_account++;
                $sum_balance += e($a['balance']);
            ?>
            <?php endforeach ?>
            <thead>
            <tr>
                <th scope="col">Total num account</th>
                <th scope="col">Total balance</th>
                <th scope="col">Currency</th>
            </tr>
            </thead>
            <tr>
                <td scope="col"><?php echo $sum_account ?></td>
                <td scope="col"><?php echo $sum_balance ?></td>
                <td scope="col">euro</td>
            </tr>
        </table>
    </div>
</section>
<!-- Jquery Library files -->
<script
    src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>
</body>
</html>

