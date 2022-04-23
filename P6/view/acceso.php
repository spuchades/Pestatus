<!-- interfaz de acceso principal, llamada en require del index.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="./view/css/custom.css" rel="stylesheet" />
    <title>PeStatus</title>
</head>
<?php
$header  = "view/templates/header.php";
require($header);
?>
<body>

    <header>
        <div>
            <div class="container">
                <div class="container">
                    <h3 style="color: green;">PeStatus Academy </h3>
                    <form>
                        <a href="view/login.php">Access</a>
                    </form>
                </div>
            </div>
        </div>
    </header>


</body>

<?php
$footer  = "templates/footer.php";
require($footer);
?>