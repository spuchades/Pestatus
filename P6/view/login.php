<?php
//veremos como a lo largo de la aplicacion hacemos uso de session_start, funcion propia de php que permite crear sesion
session_start();
//llamada a header
$head  = "templates/header.php";
require($head);
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="../view/css/custom.css" rel="stylesheet" />
    <title>PeStatus Academy</title>
</head>

<body>

    <header>
        <div class="col-md-12 text-center">
            <h1 class="text-success">PeStatus Academy</h1>
        </div>

    </header>


    <!--Formulario acceso aplicacion y/o de registro, diseñado mediante bootstrap -->

    <div class="container">
        <div class="col-5">
            <h3 class="text-success">Login</h3>
            <form method="post" action="" name="login">

                <div class="form-group mb-3"  style="color:black">
                    <label for="nombre" class="form-label"><strong>Insert your mail:</strong> </label>
                    <input type="text" class="form-control" id="email_login" name="email_login" require placeholder="Insert your mail">
                </div>

                <div class="form-group mb-3" style="color: black">
                    <label for="clave" class="form-label"> <strong>Insert your password:</strong> </label>
                    <input type="password" class="form-control" id="password_login" name="password_login" require placeholder="Insert your password">
                </div>

                <button value="btnSignUp" type="submit" class="btn btn-primary">Confirm</button><br><br>


                <h3 class="text-success">Register</h3>

                <div class="mb-3">
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#createStudent">
                        Student account
                    </button>
                </div>
                <div class="mb-3">
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#createAdmin">
                        Administrator account
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- En el caso que el usuario no este registrado, hemos decidido introducir un modal tanto para usuario como para admin que recogerá los datos de alta-->
    <div class="modal fade" id="createStudent" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="createStudentLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createStudentLabel">Create student account</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="" name="login">
                        <div class="form-group">
                            <label>User name</label>
                            <input class="form-control" type="text" required name="username" />
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input class="form-control" type="text" required name="password" />
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" type="email" required name="email" />
                        </div>

                        <div class="form-group">
                            <label>Name</label>
                            <input class="form-control" type="text" required name="name" />
                        </div>

                        <div class="form-group">
                            <label>Surname</label>
                            <input class="form-control" type="text" required name="surname" />
                        </div>

                        <div class="form-group">
                            <label>Telephone</label>
                            <input class="form-control" type="text" required name="telephone" />
                        </div>

                        <div class="form-group">
                            <label>NIF</label>
                            <input class="form-control" type="text" required name="nif" />
                        </div>
                        <input class="btn btn-primary" type="submit" value="Crear" />
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Aquí observamos como comentado anteriormente modal para crear administrador -->
    <div class="modal fade" id="createAdmin" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createAdmin">Create admin account</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="">
                        <div class="form-group">
                            <label>Username Admin</label>
                            <input class="form-control" type="text" require name="username_admin" required/>
                        </div>
                        <div class="form-group">
                            <label>Name Admin</label>
                            <input class="form-control" type="text" require name="name_admin" required/>
                        </div>
                        <div class="form-group">
                            <label>Email Admin</label>
                            <input class="form-control" type="email" require name="email_admin" required/>
                        </div>
                        <div class="form-group">
                            <label>Password Admin</label>
                            <input class="form-control" type="password" require name="password_admin" required/>
                        </div>
                        <input class="btn btn-primary" type="submit" value="Crear" />
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</body>

<?php
//mediante la funcion requier_once permitimos el acceso al contenido de dicho require durante la ejecucion y solo durante la ejecuacion, 
//en este aspecto radica la diferencia respecto al require utilizado por ejemplo en los header y footer
require_once '../controller/config/Conexion.php';
require_once '../controller/crud/Crud.php';


//con la funcion isset lograremos determinar si la respuesta a los datos analizados es true or false
if (isset($_POST["email_login"]) && (!empty($_POST["email_login"]))) {

    //Como deciamos antes, estas serán las variables a analizar
    $email = $_POST["email_login"];
    $pass = $_POST["password_login"];

    //como el login es comun tanto para students como para admin, declaramos tanto un objeto para students como para admin
    $crudStudents = new Crud("students");
    $crudAdmins = new Crud("users_admin");

    //hacemos uso de los objetos declarados anteriormente
    $user = $crudStudents->get();
    $admins = $crudAdmins->get();
    $lista = count($user);
    // por mediacion de un foreach iniciamos recorrido para determinar si es admin
    foreach ($admins as $admin) {
        if ($admin->email == $email) {
            if ($admin->password == $pass) {
                $_SESSION["email"] = $email;
                $_SESSION["id"] = $admin->id_user_admin;
                $_SESSION["username"] = $admin->username;
                $_SESSION["name"] = $admin->name;
                $_SESSION["password"] = $admin->password;
                $_SESSION["admin"] = $admin->email;
                $_SESSION["tipoUsuario"] = "Admin";
                //la siguiente linea recarga pagina deseada una vez terminar recorrido y determina si esta todo ok o no
                echo "<script> window.location='./admin.php'; </script>";
            }
        }
    }

    // de lo contrario, entra en un while que hace lo propio para usuario
    $i = 0;
    while ($i < $lista) {

        if ($user[$i]->email == $email) {
            if ($user[$i]->pass == $pass) {                

                $_SESSION["login"] = $email;
                $_SESSION["name"] = $user[$i]->name;

                $_SESSION["id"] = $user[$i]->id;
                $_SESSION["username"] = $user[$i]->username;
                $_SESSION["password"] = $user[$i]->pass;
                $_SESSION["surname"] = $user[$i]->surname;
                $_SESSION["telephone"] = $user[$i]->telephone;
                $_SESSION["nif"] = $user[$i]->nif;
                $_SESSION["fechaActual"] = $user[$i]->date_registered;
                $_SESSION["tipoUsuario"] = "Student";
                //misma utilidad que en linea 191
                echo "<script> window.location='./main.php'; </script>";
                
            }
        }
        $i++;
    }
}


//para el alta de un student hemos creado una funcion, como vemos pasamos los valores introducidos en el modal para a traves del insert introducirlos en la bbdd
function insertStudent()
{

    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $telephone = $_POST["telephone"];
    $nif = $_POST["nif"];

    #de nuevo objeto crudStudents que hace uso del insert contenido en el crud.php
    $crudStudents = new Crud("students");

    #finalizamos insert
    $crudStudents->insert([
        //Podemos observar que no introducimos id al ser AI
        "username" => $username,
        "pass" => $password,
        "email" => $email,
        "name" => $name,
        "surname" => $surname,
        "telephone" => $telephone,
        "nif" => $nif,
    ]);
}

//Misma operacion para admin
function insertarAdmin()
//pasamos valores introducimos en el modal alta admin
{
    $name_admin = $_POST["username_admin"];
    $surname_admin = $_POST["name_admin"];
    $email_admin = $_POST["email_admin"];
    $pass_admin = $_POST["password_admin"];
    #de nuevo objeto crudAdmin que hace uso del insert contenido en el crud.php
    $crudAdmin = new Crud('users_admin');

    #finalizamos insert
    $crudAdmin->insert([
        //Podemos observar que no introducimos id al ser AI
        "username" => $name_admin,
        "name" => $surname_admin,
        "email" => $email_admin,
        "password" => $pass_admin
    ]);
}

//mensaje mediante alert al haber insertado con exito tanto user como admin
if (isset($_POST["name"]) && (!empty($_POST["name"]))) {
    insertStudent();
    echo '<script language="javascript">';
    echo 'alert("Estudiante registrado con éxito")'; 
    echo '</script>';
} else if (isset($_POST["name_admin"]) && (!empty($_POST["name_admin"]))) { 
    insertarAdmin();
    echo '<script language="javascript">';
    echo 'alert("Admin registrado con éxito")'; 
    echo '</script>';
}
?>

<?php
$footer  = "templates/footer.php";
require($footer);
?>