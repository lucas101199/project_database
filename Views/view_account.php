<!DOCTYPE html>
<html>
<head>
    <title>New Account</title>

    <!--Bootsrap 4 CDN-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!--Fontawesome CDN-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <!--Custom styles-->

</head>
<body>
    <form action="?controller=user&action=create_account" method="post">
        <div>
            <p>
                Currency:
                <select name="currency">
                    <?php foreach ($data as $z): ?>
                        <option value="<?= e($z['id']) ?>"><?= e($z['name']) ?></option>
                    <?php endforeach ?>
                </select>
            </p>
        </div>
        <div>
            <input type="submit" value="create">
        </div>
    </form>
</body>
</html>