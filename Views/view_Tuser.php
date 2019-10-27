<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<html lang="en" class="no-js main">
<head>
    <title>Account</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://s3-us-west-2.amazonaws.com/s.cdpn.io/905237/bonsaiUI-custombuild.css" />
    <link rel="stylesheet" href="css/wallet.scss">
    <!--<link rel="stylesheet" href="css/main.css">-->
</head>
<body>
<section>
    <h1>Account</h1>
    <div class="box">
        <table>
            <thead>
            <tr>
                <th scope="col">From account</th>
                <th scope="col">To account</th>
                <th scope="col">Amount</th>
                <th scope="col">Currency</th>
            </tr>
            </thead>
                <?php foreach ($data as $a): ?>
                <tr>
                    <td scope="col"><?= e($a['from_account']) ?></td>
                    <td scope="col"><?= e($a['to_account']) ?></td>
                    <td scope="col"><?= e($a['amount']) ?></td>
                    <td scope="col"><?= e($a['currency']) ?></td>
                </tr>
        <?php endforeach ?>
        </table>
        <div class="form-group">
            <a class="btn float-right login_btn" href="?controller=login&action=destroy">Log Out</a>
        </div>
        <div class="form-group">
            <a class="btn float-right login_btn" href="?controller=user&action=account">New Account</a>
        </div>
        <div class="form-group">
            <a class="btn float-right login_btn" href="?controller=user&action=transaction">New Transactions</a>
        </div>
        <div class="form-group">
            <a class="btn float-right login_btn" href="?controller=user&action=balance">Account</a>
        </div>
    </div>
</section>
<!-- Jquery Library files -->
<script
    src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>
</body>
</html>

