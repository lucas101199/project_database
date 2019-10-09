<html lang="en" class="no-js main">
<head>
    <title>Account</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://s3-us-west-2.amazonaws.com/s.cdpn.io/905237/bonsaiUI-custombuild.css" />
    <link rel="stylesheet" href="css/wallet.scss">
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
            <?php foreach ($balance as $a): ?>
            <td>
                <th scope="col"><?= e($a['number']) ?></th>
                <th scope="col"><?= e($a['balance']) ?></th>
                <th scope="col"><?= e($a['currency']) ?></th>
            </td>
            <?php endforeach ?>
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

