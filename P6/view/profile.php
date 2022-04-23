<?php

$head  = "templates/headerlogin.php";

require($head);
require_once '../controller/config/Conexion.php';
require_once '../controller/crud/Crud.php';

if (!(isset($_SESSION["login"]))) {
    echo "You are not logged";
    header("Location: ./login.php");
}


//comenzamos comparacion para update del email
if (isset($_POST["emailEdit"]) && (!empty($_POST["emailEdit"]))) {
    if ($_SESSION["tipoUsuario"] == "Student") {

        $passwordEdit = $_POST["passwordEdit"];
        $emailEdit = $_POST["emailEdit"];
        $usernameEdit = $_POST['usernameEdit'];

        //creamos objeto en variable que asume funciones crud
        $crud = new Crud("students");

        //Guardamos id
        $id = $_SESSION["id"];
        //consultamos mediante crud
        $crud->where("id", "=", $id)->update([
            "pass" => $passwordEdit,
            "email" => $emailEdit,
            "username" => $usernameEdit
        ]);
        $_SESSION["username"] = $usernameEdit;
        $_SESSION["login"] = $emailEdit;
        $_SESSION["pass"] = $passwordEdit;
        //alert para confirmar update
        // echo "<script> alert ('Student modified correctly.')</script>";
    }
    //misma operacion para caso admin
    if ($_SESSION["tipoUsuario"] == "Admin") {

        $passwordEdit = $_POST["passwordEdit"];
        $emailEdit = $_POST["emailEdit"];

        #creamos objeto en variable que asume funciones crud
        $crud = new Crud("users_admin");

        //Guardamos id
        $id = $_SESSION["id"];
        //consultamos mediante crud
        $crud->where("id_user_admin", "=", $id)->update([
            "email" => $emailEdit,
            "password" => $passwordEdit,
        ]);
        // echo "<script> alert ('Admin modified correctly.')</script>";
    }
}
?>

<div class="container-fluid row">
    <div class="container-fluid col-6">
        <div>
            <!-- info principal usuario -->
            <h3 class="text-success">User profile<br></h3>
            <h4><?php echo $_SESSION["name"] . " " . $_SESSION["surname"]; ?></h4>
            <h5><?php echo $_SESSION["tipoUsuario"]; ?><br><br></h5>
        </div>
        <div class="container">
            <!-- form que recoge datos a modificar -->
            <h3 class="text-success">Edit Profile</h3>
            <form method="post" action="">
                <div class="mb-3">
                    <label>Update email</label>
                    <input class="form-control" type="email" required name="emailEdit" value="" placeholder="Writte your new mail" />
                </div>
                <div class="mb-3">
                    <label>Update Password</label>
                    <input class="form-control" type="text" required name="passwordEdit" value="" placeholder="Writte your new password" />
                </div>
                <div class="mb-3">
                    <label>Update username</label>
                    <input class="form-control" type="text" required name="usernameEdit" value="" placeholder="Writte your new username" />
                </div>
                <button value="btnSave" type="submit" class=" btn btn-block mybtn btn-primary tx-tfm">Save</button>
                <div class="form-group">
                    <button type="button" class="btn btn-primary mt-2" data-toggle="modal" data-target="#help">
                        Help
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="container-fluid col-3">
        <!-- datos completos usuario logeado -->
        <p>
        <h3 class="text-success"> <strong>User info</strong> </h3>
        </p>
        <p><strong>Name: </strong> <?php echo $_SESSION["name"]; ?> </p>
        <p><strong>Surname: </strong><?php echo $_SESSION["surname"]; ?> </p>
        <p><strong>Username: </strong> <?php echo $_SESSION["username"]; ?> </p>
        <p><strong>Email: </strong><?php echo $_SESSION["login"]; ?> </p>
        <p><strong>Telephone: </strong> <?php echo $_SESSION["telephone"]; ?> </p>
        <p><strong>NIF: </strong> <?php echo $_SESSION["nif"]; ?> </p>
        <p><strong>Date registered: </strong><?php echo date("Y-m-d", strtotime($_SESSION["fechaActual"])); ?> </p>
    </div>
</div><br><br>
<!-- boton de ayuda mediante modal -->
<div class="modal fade" id="help" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Help</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>You can modify personal data such as username, password and email.</p>
                <p>Confirm changes by pressing save button.</p>

            </div>
        </div>
    </div>
</div>


<?php
$footer  = "templates/footer.php";
require($footer);
?>