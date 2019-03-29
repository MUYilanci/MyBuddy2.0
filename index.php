<?php
if (isset($_GET['page'])){
    $page = $_GET['page'];
}
else{
    $page = 'home';
}
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>MyBuddy</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
    <link href="css/util.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
<?php include_once 'includes/navbar.inc.php' ?>
<?php include  'includes/'.$page.'.inc.php';?>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<script>
    $(document).ready(function () {
        $('#price').change(function () {
            $('#total').val($('#price').val());
            $('.deelnemersbetaling').removeClass('d-none');
        });
        $("input").change(function () {


            var someObj = {};
            someObj.checkedBoxes = [];
            someObj.notCheckedBoxes = [];

            $("input:checkbox").each(function () {
                if ($(this).is(":checked")) {
                    someObj.checkedBoxes.push($(this).attr("id"));
                } else {
                    someObj.notCheckedBoxes.push($(this).attr("id"));
                }
            });

            var aantalDeelnemers = 0;

            jQuery.each(someObj.checkedBoxes, function (f, item) {
                var checkid = this.replace("user_", "");
                var userPayCount = $("#percentage_" + checkid).val();
                aantalDeelnemers += parseInt(userPayCount, 10);

            });

            jQuery.each(someObj.checkedBoxes, function (index, item) {

                var checkid = this.replace("user_", "");
                var userPayCount = $("#percentage_" + checkid).val();
                var totalPrice = $('#total').val();
                var ppp = totalPrice / aantalDeelnemers * userPayCount;
                $("#price_" + checkid).val(Math.round(ppp * 100) / 100);
            });
            jQuery.each(someObj.notCheckedBoxes, function (index, item) {

                var checkid = this.replace("user_", "");
                $("#price_" + checkid).val("");
            });
        });
    });
</script>
</html>
