<?php
$head  = "templates/headerlogin.php";
require($head);
?>

<?php

if (!(isset($_SESSION["admin"])) && !empty($_SESSION['email'])) {
    //mensaje emergente que nos avisa si no estas como admin
    echo "You are not logged in as administrator";
    header("Location: ./login.php");
}

//variables globales donde pasaremos los datos introducidos en los forms (TEACHERS)
if (isset($_POST["name2"])) {
    $name2 = $_POST["name2"];
    $surname2 = $_POST["surname2"];
    $telephone2 = $_POST["telephone2"];
    $nif2 = $_POST["nif2"];
    $email2 = $_POST["email2"];
}


//variables globales donde pasaremos los datos introducidos en los forms (COURSES)
if (isset($_POST["nameCurso2"])) {
    $nameCurso2 = $_POST["nameCurso2"];
    $descricionCurso2 = $_POST["descripcionCurso2"];
    $inicioCurso2 = $_POST["inicioCurso2"];
    $finCurso2 = $_POST["finCurso2"];
    $activoCurso2 = $_POST["activo2"];
}

//variables globales donde pasaremos los datos introducidos en los forms (SCHEDULE)
if (isset($_POST["idclassAgenda2"])) {
    $dayAgenda2 = $_POST["day2"];
    $inicioAgenda2 = $_POST["inicioAgenda2"];
    $finAgenda2 = $_POST["finAgenda2"];
    $idclassAgenda2 = $_POST["idclassAgenda2"];
    $dayAgenda2 = $_POST["day2"];
}

//variables globales donde pasaremos los datos introducidos en los forms (CLASSES)
if (isset($_POST["nameclass2"])) {
    $id2classteacher = $_POST["id2classTeacher"];
    $id2classcourse = $_POST["id2classCourse"];
    $id2classagenda = $_POST["id2classAgenda"];
    $name2class = $_POST["nameclass2"];
    $color2class = $_POST["colorclass2"];
}

//variables globales donde pasaremos los datos introducidos en los forms(STUDENTS)
if (isset($_POST["username2student"])) {
    $username2student = $_POST["username2student"];
    $email2student = $_POST["email2student"];
    $name2student = $_POST["name2student"];
    $surname2student = $_POST["surname2student"];
    $telephone2student = $_POST["telephone2student"];
    $nif2student = $_POST["nif2student"];
    $date2student = $_POST["data2student"];
}

//variables globales donde pasaremos los datos introducidos en los forms(ENROLLMENT)
if (isset($_POST["status2Enroll"])) {
    $id2studentEnroll = $_POST["id2studentEnroll"];
    $id2courseEnroll = $_POST["id2courseEnroll"];
    $status2Enroll = $_POST["status2Enroll"];
}
//require_once para conectar en el momento de la ejecuacion del mismo modo que el crud, ademas un include para terminar de enlazar el list medinate el controller
require_once '../controller/config/Conexion.php';
require_once '../controller/crud/Crud.php';
include("../controller/listar.php");

//creamos objeto Crud, llamado 'x' y encapsulado en $x
$crudClass = new Crud('class');
$crudCourse = new Crud('courses');
$crudTeachers = new Crud('teachers');
$crudAgenda = new Crud('schedule');
$crudStudent = new Crud("students");
$crudEnroll = new Crud("enrollment");

//al $x encapsulado le pasamos una funcion concreta (get) incluida en el crud.php y renombramos como $listax
$listaClass = $crudClass->get();
$listaCourse = $crudCourse->get();
$listaTeachers = $crudTeachers->get();
$listaAgenda = $crudAgenda->get();
$listaStudent = $crudStudent->get();
$listaEnrollment = $crudEnroll->get();

//algo similar al get anterior haremos con el post, para los update, haciendo una comparacion isset de id que determinara el objeto a modificar
if (isset($name2)) {
    $_SESSION['idProfesor'] = $_POST['id2Profesor'];
} else if (isset($nameCurso2)) {

    $_SESSION['idCurso'] = $_POST['id2Curso'];
} else if (isset($idclassAgenda2)) {

    $_SESSION['id2Agenda'] = $_POST['id2Agenda'];
} else if (isset($name2class)) {

    $_SESSION['idclass'] = $_POST['id2class'];
} else if (isset($username2student)) {

    $_SESSION['idstudent'] = $_POST['id2student'];
} else if (isset($status2Enroll)) {

    $_SESSION['idEnroll'] = $_POST['id2Enroll'];
}
//finalmente la ultima de las opciones crud implementadas sería el listado mediante un swicht a traves del cual accedemos a las funciones listar
//incluidas en la linea 74
if (isset($_POST["accion"]) && !(empty($_POST["accion"]))) {

    $btn = $_POST["accion"];

    switch ($btn) {

        case 'ListarProfesor':
            listarProfesores($listaTeachers);
            break;
        case 'ListarCurso':
            listarCursos($listaCourse);
            break;
        case 'ListarAgenda':
            listarAgenda($listaAgenda);
            break;
        case 'ListarClase':
            listarClases($listaClass);
            break;
        case 'ListarStudent':
            listarStudent($listaStudent);
            break;
        case 'ListarEnroll':
            listarEnrollment($listaEnrollment);
            break;
    }
}
?>
<!-- por ultimo hemos introducido un mensaje que confirma si se ha ejecutado correctamente cada uno de los crud -->
<div id="message">
    <?php
    if (isset($_SESSION["trueInsert"]) && ($_SESSION["trueInsert"] == true)) {
        $exitoBootstrapInsert = "<div class='alert alert-success' role='alert'>
        Se ha insertado correctamente en la BBDD
    </div>";
        echo ($exitoBootstrapInsert);
        $_SESSION["trueInsert"] = false;
    }
    if (isset($_SESSION["trueModificacion"]) && ($_SESSION["trueModificacion"] == true)) {
        $exitoBootstrapModificacion = "<div class='alert alert-success' role='alert'>
        Se ha modificado correctamente el dato en la BBDD
    </div>";
        echo ($exitoBootstrapModificacion);
        $_SESSION["trueModificacion"] = false;
    }
    if (isset($_SESSION["trueDelete"]) && ($_SESSION["trueDelete"] == true)) {
        $exitoBootstrapDelete = "<div class='alert alert-success' role='alert'>
        Se ha Borrado correctamente el dato en la BBDD
    </div>";
        echo ($exitoBootstrapDelete);
        $_SESSION["trueDelete"] = false;
    }

    ?>
</div>
<!-- estructura visual, construida en base a tipo acordeon de Bootstrap -->
<div class="container">
    <div class="container">
        <h3 style="color: royalblue;">PeStatus academy</h3>
        <div class="container">
            <div id="accordion1">
                <div class="card">
                    <div class="card-header" id="cabecera1">
                        <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#respuesta1" aria-controls="respuesta1">
                                Manage teacher
                            </button>
                        </h5>
                    </div>
                    <div id="respuesta1" class="collapse" aria-labelledby="cabecera1" data-parent="#accordion1">
                        <div class="card-body margin-0">
                            <div class="container">
                                <form method="post" action="../controller/insert.php">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input class="form-control" type="text" required name="name" value=<?php if (isset($_POST["name2"])) echo ($name2); ?>>
                                    </div>
                                    <div class="form-group">
                                        <label>Surname</label>
                                        <input class="form-control" type="text" required name="surname" value=<?php if (isset($_POST["name2"])) echo ($surname2); ?>>
                                    </div>
                                    <div class="form-group">
                                        <label>Telephone</label>
                                        <input class="form-control" type="text" required name="telephone" value=<?php if (isset($_POST["name2"])) echo ($telephone2); ?>>
                                    </div>
                                    <div class="form-group">
                                        <label>NIF</label>
                                        <input class="form-control" type="text" required name="nif" value=<?php if (isset($_POST["name2"])) echo ($nif2); ?>>
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input class="form-control" type="email" required name="email" value=<?php if (isset($_POST["name2"])) echo ($email2); ?>>
                                    </div>
                                    <div class="row alterarBD">
                                        <div class="col-12">
                                            <button class="btn btn-primary" type="submit" value="CreateProfesor" name="crear">
                                                Create
                                            </button>
                                            <button type="submit" class="btn btn-warning float-left btn-listado" name="accion" value="ModificarPro">
                                                Update
                                            </button>
                                            <button type="submit" class="btn btn-danger btn-listado" name="accion" value="EliminarPro">
                                                Delete
                                            </button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                            <form action="" method="post">
                                <button type="submit" class="btn btn-info ml-4" name="accion" value="ListarProfesor">
                                    List
                                </button>
                            </form>

                        </div>
                    </div>
                </div>
                <!-- ****************************************************************************************************************************************************************** -->
                <div class="card">
                    <div class="card-header" id="cabecera2">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#respuesta2" aria-expanded="false" aria-controls="respuesta2">
                                Manage schedule
                            </button>
                        </h5>
                    </div>
                    <div id="respuesta2" class="collapse" aria-labelledby="cabecera2" data-parent="#accordion1">
                        <div class="card-body">
                            <form method="post" action="../controller/insert.php">
                                <div class="form-group">
                                    <label>Schedule name</label>
                                    <input class="form-control" type="text" name="id_class_agenda" value=<?php if (isset($_POST["idclassAgenda2"])) echo ($idclassAgenda2); ?>>
                                </div>
                                <div class="form-group">
                                    <label>Start hour</label>
                                    <input class="form-control" type="time" required name="inicio_agenda" value=<?php if (isset($_POST["idclassAgenda2"])) echo ($inicioAgenda2); ?>>
                                </div>
                                <div class="form-group">
                                    <label>Last hour</label>
                                    <input class="form-control" type="time" required name="fin_agenda" value=<?php if (isset($_POST["idclassAgenda2"])) echo ($finAgenda2); ?>>
                                </div>
                                <div class="form-group">
                                    <label>Day</label>
                                    <input class="form-control" type="date" required name="dia_agenda" value=<?php if (isset($_POST["idclassAgenda2"])) echo ($dayAgenda2); ?>>
                                </div>

                                <div class="row alterarBD">
                                    <div class="col-12">
                                        <button class="btn btn-primary" type="submit" value="CreateAgenda" name="crear">
                                            Create
                                        </button>
                                        <button type="submit" class="btn btn-warning float-left btn-listado" name="accion" value="ModificarAge">
                                            Update
                                        </button>
                                        <button type="submit" class="btn btn-danger btn-listado" name="accion" value="EliminarAge">
                                            Delete
                                        </button>
                                    </div>
                                </div>
                            </form>

                        </div>
                        <form action="" method="post">
                            <button type="submit" class="btn btn-info ml-4 mb-2" name="accion" value="ListarAgenda">
                                List
                            </button>
                        </form>

                    </div>
                </div>
                <!-- ****************************************************************************************************************************************************************** -->

                <div class="card">
                    <div class="card-header" id="cabecera3">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#respuesta3" aria-expanded="false" aria-controls="respuesta3">
                                Courses
                            </button>
                        </h5>
                    </div>
                    <div id="respuesta3" class="collapse" aria-labelledby="cabecera3" data-parent="#accordion1">
                        <div class="card-body">
                            <form method="post" action="../controller/insert.php">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input class="form-control" type="text" required name="name_curso" value=<?php if (isset($_POST["nameCurso2"])) echo ($nameCurso2); ?>>
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <input class="form-control" type="textarea" name="description_curso" value=<?php if (isset($_POST["nameCurso2"])) echo ($descricionCurso2); ?>>
                                </div>
                                <div class="form-group">
                                    <label>Start day</label>
                                    <input class="form-control" type="date" name="inicio_curso" value=<?php if (isset($_POST["nameCurso2"])) echo ($inicioCurso2); ?>>
                                </div>
                                <div class="form-group">
                                    <label>Last day</label>
                                    <input class="form-control" type="date" name="fin_curso" value=<?php if (isset($_POST["nameCurso2"])) echo ($finCurso2); ?>>
                                </div>
                                <div class="form-group">
                                    <label>Active</label>
                                    <input class="form-control" type="number" required name="activo" value=<?php if (isset($_POST["nameCurso2"])) echo ($activoCurso2); ?>>
                                </div>
                                <div class="row alterarBD">
                                    <div class="col-12">
                                        <button class="btn btn-primary" type="submit" value="CreateCurso" name="crear">
                                            Create
                                        </button>
                                        <button type="submit" class="btn btn-warning float-left " name="accion" value="ModificarCur">
                                            Update
                                        </button>
                                        <button type="submit" class="btn btn-danger " name="accion" value="EliminarCur">
                                            Delete
                                        </button>
                                    </div>

                                </div>
                            </form>
                        </div>
                        <form action="" method="post">
                            <button type="submit" class="btn btn-info ml-4 mb-2" name="accion" value="ListarCurso">
                                List
                            </button>
                        </form>
                    </div>
                </div>
                <!-- ****************************************************************************************************************************************************************** -->

                <div class="card">
                    <div class="card-header" id="cabecera4">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#respuesta4" aria-expanded="false" aria-controls="respuesta4">
                                Class
                            </button>
                        </h5>
                    </div>
                    <div id="respuesta4" class="collapse" aria-labelledby="cabecera4" data-parent="#accordion1">
                        <div class="card-body">
                            <form method="post" action="../controller/insert.php">
                                <div class="form-group">
                                    <label>Active teacher</label>

                                    <select name='prof_clase' class='form-control form-control-sm' placeholder='Elija Clase Existente:' value=<?php if (isset($_POST["nameclass2"])) echo ($id2classteacher); ?>>

                                        <?php

                                        for ($i = 0; $i < count($listaTeachers); $i++) {
                                        ?>
                                            <option name="idProfClass" value=<?php echo ($listaTeachers[$i]->id_teacher); ?>>Name: <?php echo ($listaTeachers[$i]->name . ' ' . $listaTeachers[$i]->surname); ?></option>
                                        <?php
                                        }

                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Active course</label>

                                    <select name='curs_clase' class='form-control form-control-sm' placeholder='Elija Clase Existente:' value=<?php if (isset($_POST["nameclass2"])) echo ($id2classcourse); ?>>

                                        <?php
                                        for ($i = 0; $i < count($listaCourse); $i++) {
                                        ?>
                                            <option name="idCursoClass" value=<?php echo ($listaCourse[$i]->id_course); ?>>Name: <?php echo ($listaCourse[$i]->name); ?></option>
                                        <?php
                                        }

                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Active schedule</label>

                                    <select name='agen_clase' class='form-control form-control-sm' placeholder='Elija Clase Existente:' value=<?php if (isset($_POST["nameclass2"])) echo ($id2classagenda); ?>>

                                        <?php
                                        for ($i = 0; $i < count($listaAgenda); $i++) {
                                        ?>
                                            <option name="idAgendaClass" value=<?php echo ($listaAgenda[$i]->id_schedule); ?>>Name: <?php echo ($listaAgenda[$i]->id_schedule . ' day: ' . $listaAgenda[$i]->day); ?></option>
                                        <?php
                                        }

                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Class name</label>
                                    <input class="form-control" type="text" required name="nombre_clase" value=<?php if (isset($_POST["nameclass2"])) echo ($name2class); ?>>
                                </div>
                                <div class="form-group">
                                    <label>Color</label>
                                    <input class="form-control" type="text" required name="color_clase" value=<?php if (isset($_POST["nameclass2"])) echo ($color2class); ?>>
                                </div>

                                <div class="row alterarBD">
                                    <div class="col-12">
                                        <button class="btn btn-primary" type="submit" value="CreateClase" name="crear">
                                            Create
                                        </button>
                                        <button type="submit" class="btn btn-warning float-left btn-listado" name="accion" value="ModificarClasClas">
                                            Update
                                        </button>
                                        <button type="submit" class="btn btn-danger btn-listado" name="accion" value="EliminarClas">
                                            Delete
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <form action="" method="post">
                            <button type="submit" class="btn btn-info ml-4 mb-2" name="accion" value="ListarClase">
                                List
                            </button>
                        </form>
                    </div>
                </div>
                <!-- ****************************************************************************************************************************************************************** -->
                <div class="card">
                    <div class="card-header" id="cabecera5">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#respuesta5" aria-expanded="false" aria-controls="respuesta3">
                                Students
                            </button>
                        </h5>
                    </div>
                    <div id="respuesta5" class="collapse" aria-labelledby="cabecera5" data-parent="#accordion1">
                        <div class="card-body">
                            <form method="post" action="../controller/insert.php">
                                <div class="form-group">
                                    <label>Name user</label>
                                    <input class="form-control" type="text" required name="username_stu" value=<?php if (isset($_POST["username2student"])) echo ($username2student); ?>>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="form-control" type="text" required name="password_stu" value=<?php if (isset($_POST["username2student"])) echo ($username2student); ?>>
                                </div>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input class="form-control" type="text" required name="name_stu" value=<?php if (isset($_POST["username2student"])) echo ($name2student); ?>>
                                </div>
                                <div class="form-group">
                                    <label>Surname</label>
                                    <input class="form-control" type="text" required name="surname_stu" value=<?php if (isset($_POST["username2student"])) echo ($surname2student); ?>>
                                </div>
                                <div class="form-group">
                                    <label>Telephopne</label>
                                    <input class="form-control" type="text" required name="telephone_stu" value=<?php if (isset($_POST["username2student"])) echo ($telephone2student); ?>>
                                </div>
                                <div class="form-group">
                                    <label>NIF</label>
                                    <input class="form-control" type="text" required name="nif_stu" value=<?php if (isset($_POST["username2student"])) echo ($nif2student); ?>>
                                </div>
                                <div class="form-group">
                                    <label>Registration date</label>
                                    <input class="form-control" type="Date" required name="day_stu" value=<?php if (isset($_POST["username2student"])) echo ($date2student); ?>>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="form-control" type="email" required name="email_stu" value=<?php if (isset($_POST["username2student"])) echo ($email2student); ?>>
                                </div>

                                <div class="row alterarBD">
                                    <div class="col-12">
                                        <button class="btn btn-primary" type="submit" value="CreateStudent" name="crear">
                                            Create
                                        </button>
                                        <button type="submit" class="btn btn-warning float-left btn-listado" name="accion" value="ModificarStu">
                                            Update
                                        </button>
                                        <button type="submit" class="btn btn-danger btn-listado" name="accion" value="EliminarStu">
                                            Delete
                                        </button>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <form action="" method="post">
                            <button type="submit" class="btn btn-info ml-4 mb-2" name="accion" value="ListarStudent">
                                List
                            </button>
                        </form>
                    </div>
                </div>
                <!-- ****************************************************************************************************************************************************************** -->
                <div class="card">
                    <div class="card-header" id="cabecera6">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#respuesta6" aria-expanded="false" aria-controls="respuesta3">
                                Enrollment
                            </button>
                        </h5>
                    </div>
                    <div id="respuesta6" class="collapse" aria-labelledby="cabecera6" data-parent="#accordion1">
                        <div class="card-body">
                            <form method="post" action="../controller/insert.php">
                                <div class="form-group">
                                    <label>Active student</label>

                                    <select name='stuEnroll' class='form-control form-control-sm' placeholder='Elija Clase Existente:' value=<?php if (isset($_POST["id2studentEnroll"])) echo ($id2studentEnroll); ?>>

                                        <?php

                                        for ($i = 0; $i < count($listaStudent); $i++) {
                                        ?>
                                            <option name="idstudentselect" value=<?php echo ($listaStudent[$i]->id); ?>>Name: <?php echo ($listaStudent[$i]->name . ' ' . $listaStudent[$i]->surname); ?></option>
                                        <?php
                                        }

                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Active course</label>

                                    <select name='cursostudentselect' class='form-control form-control-sm' placeholder='Elija Clase Existente:' value=<?php if (isset($_POST["id2studentEnroll"])) echo ($id2courseEnroll); ?>>

                                        <?php
                                        for ($i = 0; $i < count($listaCourse); $i++) {
                                        ?>
                                            <option name="idCursoSelect" value=<?php echo ($listaCourse[$i]->id_course); ?>>Nombre: <?php echo ($listaCourse[$i]->name); ?></option>
                                        <?php
                                        }

                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <input class="form-control" type="number" required name="statusSelect" value=<?php if (isset($_POST["id2studentEnroll"])) echo ($status2Enroll); ?>>
                                </div>


                                <?php if (isset($_SESSION['idEnroll'])) $_SESSION['idEnroll'] = $_POST['id2Enroll']; ?>

                                <div class="row alterarBD">
                                    <div class="col-12">
                                        <button class="btn btn-primary" type="submit" value="CreateEnroll" name="crear">
                                            Create
                                        </button>
                                        <button type="submit" class="btn btn-warning float-left btn-listado" name="accion" value="ModificarEnroll">
                                            Update
                                        </button>
                                        <button type="submit" class="btn btn-danger btn-listado" name="accion" value="EliminarEnroll">
                                            Delete
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <form action="" method="post">
                            <button type="submit" class="btn btn-info ml-4 mb-2" name="accion" value="ListarEnroll">
                                List
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div><br>
    </div>
</div><br><br>
<?php
$footer  = "templates/footer.php";
require($footer);
?>