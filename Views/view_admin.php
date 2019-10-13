<!DOCTYPE html>
<html>
<head>
    <title>admin</title>

    <!--Bootsrap 4 CDN-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!--Custom styles-->
    <link rel="stylesheet" href="css/admin.scss">
</head>
<main>
    <section>
        <div class="rad-body-wrapper rad-nav-min">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-xs-6">
                        <div class="rad-info-box rad-txt-success">
                            <span class="heading">number of account</span>

                            <span class="value"><span><?php print_r($data['accounts']) ?></span></span>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xs-6">
                        <div class="rad-info-box rad-txt-primary">
                            <span class="heading">Money all account</span>

                            <span class="value"><span><?php print_r($data['money']) ?></span></span>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xs-6">
                        <div class="rad-info-box rad-txt-danger">
                            <span class="heading">number of users</span>
                            <span class="value"><span><?php print_r($data['users']) ?></span></span>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xs-6">
                        <div class="rad-info-box">
                            <span class="heading">number transactions</span>

                            <span class="value"><span><?php print_r($data['transactions']) ?></span></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>