<!DOCTYPE html>
<html>
<title>Transactions</title>
<meta charset="utf-8">
<link rel="stylesheet" href="css/main.css">
<body>

<form action="?controller=user&action=create_transaction" method="post">
    <div class="container" id="main-content">
        <h2 style="color: white">Create transaction</h2>

        <p style="color: white"> From account :
            <select name="from">
                <?php foreach ($data as $z): ?>
                    <option value="<?= e($z['number']) ?>"><?= e($z['number']) ?></option>
                <?php endforeach ?>
            </select>
        </p>

        <p style="color: white"> To account : <input type="number" id="to_account" name="to_account" placeholder="receiver"> </p>

        <p style="color: white">
            Amount: <input type="number" id="amount" name="amount" placeholder="amount">
        </p>

        <p style="color: white">
            Currency:
            <select name="currency">
                <?php foreach ($data as $z): ?>
                    <option value="<?= e($z['id']) ?>"><?= e($z['name']) ?></option>
                <?php endforeach ?>
            </select>
        </p>
        <p>
            <input type="submit" value="send money">
        </p>
    </div>
</form>

</body>
</html>