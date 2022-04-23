<?php
$head  = "templates/headerlogin.php";
require($head);

if (!(isset($_SESSION["login"]))) {
    //mensaje emergente que nos avisa si no estas como usuario
    echo "You are not logged in";
    header("Location: ./login.php");
}
//require_once para conectar en el momento de la ejecuacion del mismo modo que el crud
require_once '../controller/config/Conexion.php';
require_once '../controller/crud/Crud.php';

//a continuacion, declaramos variable que determina la accion de $accion
$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";
//objeto de acceso a bbdd
$conexion = (new Conexion())->conectar();

//introducimos un switch que nos permitira elegir una opcion u otra
//dicho switch nos permitira filtrar los cursos agendados por dia, semana o mes.
switch ($accion) {
        //Consulta horario diario
    case "btnDaily":
        $sentencia = $conexion->prepare("SELECT sh.day, sh.time_start, sh.time_end, cl.name
                             FROM enrollment e, courses c, class cl, schedule sh
                            WHERE e.id_course=c.id_course 
                            AND e.id_student=:id 
                            AND c.id_course=cl.id_course 
                            AND sh.id_class=cl.id_class AND sh.day=:dataForm");
        //para poder filtrar opcion, tenemos que pasar id y fecha
        $sentencia->bindParam(':id', $_SESSION["id"]);
        $sentencia->bindParam(':dataForm', $_POST["viewDate"]);
        //al ejecutar la sentencia estamos recorriendo la consulta
        $sentencia->execute();
        //para finalmente en un fetchAll encapsular como objeto los datos en $listaDatos
        $listaDatos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        break;

    case "btnWeekly":
        //Consulta horario semanal
        $sentencia = $conexion->prepare("SELECT sh.day, sh.time_start, sh.time_end, cl.name
                             FROM enrollment e, courses c, class cl, schedule sh
                            WHERE e.id_course=c.id_course 
                            AND e.id_student=:id 
                            AND c.id_course=cl.id_course 
                            AND sh.id_class=cl.id_class AND sh.day BETWEEN :dataStart AND :dataEnd");
        //para poder filtrar opcion, tenemos que pasar id y fecha
        $sentencia->bindParam(':id', $_SESSION["id"]);
        $sentencia->bindParam(':dataStart', $_POST["viewDate"]);
        //para poder volcar la info semanal, sumamos al view data 6 dias
        $dataRecibida = $_POST["viewDate"];
        $dataWeek = strtotime('+6 day', strtotime($dataRecibida));
        $dataWeek = date('Y-m-d', $dataWeek);
        //por ultimo pasamos la info recogida en $dataweek
        $sentencia->bindParam(':dataEnd', $dataWeek);
        //al ejecutar la sentencia estamos recorriendo la consulta
        $sentencia->execute();
        //para finalmente en un fetchAll encapsular como objeto los datos en $listaDatos
        $listaDatos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        break;

    case "btnMonthly":
        //Consulta horario mensual
        $sentencia = $conexion->prepare("SELECT sh.day, sh.time_start, sh.time_end, cl.name
                             FROM enrollment e, courses c, class cl, schedule sh
                            WHERE e.id_course=c.id_course 
                            AND e.id_student=:id 
                            AND c.id_course=cl.id_course 
                            AND sh.id_class=cl.id_class AND sh.day BETWEEN :dataStart AND :dataEnd");
        //para poder filtrar opcion, tenemos que pasar id y fecha
        $sentencia->bindParam(':id', $_SESSION["id"]);
        $sentencia->bindParam(':dataStart', $_POST["viewDate"]);
        //para poder volcar la info semanal, sumamos al view data 30 dias
        $dataRecibida = $_POST["viewDate"];
        $dataWeek = strtotime('+30 day', strtotime($dataRecibida));
        $dataWeek = date('Y-m-d', $dataWeek);
        //por ultimo pasamos la info recogida en $dataweek
        $sentencia->bindParam(':dataEnd', $dataWeek);
        //al ejecutar la sentencia estamos recorriendo la consulta
        $sentencia->execute();
        //para finalmente en un fetchAll encapsular como objeto los datos en $listaDatos
        $listaDatos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        break;
    default:
}
//a continuacion pasamos a otro apartado de consultas, las cuales devuelven de manera mucho mas sencilla informacion como 
//cursos, enrollment, descripcion
$sentencia = $conexion->prepare("SELECT c.description FROM courses c, enrollment e
                                    WHERE e.id_course=c.id_course AND e.id_student=:id ");
//para poder filtrar opcion, tenemos que pasar id 
$sentencia->bindParam(':id', $_SESSION["id"]);
//al ejecutar la sentencia estamos recorriendo la consulta
$sentencia->execute();
//rellenamos el array listaCursos con los datos recogidos de la consulta ejecutada.
$listaCursos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>

<div align="center">
    <h3 class="text-success">Schedule student</h3>
</div>
<div class="container-fluid row justify-content-center">
    <div class="col-8 float">
        <!--damos vida al input que recoge la fecha a filtrar y los botones switch que determinan si el filtrado sera diario, semanal o mensual-->
        <div class="col-4">
            <h5>Insert planning courses</h5>
            <form method="post" action="" name="horarios">
                <div class="form-group">
                    <label>Insert date:</label>
                    <input class="form-control" type="text" required name="viewDate" placeholder="Enter date: aaaa-mm-dd" id="viewDate" />
                </div>
                <button value="btnDaily" type="submit" class="btn btn-primary" name="accion">
                    Dayli
                </button>
                <button value="btnWeekly" type="submit" class="btn btn-primary" name="accion">
                    Weekly
                </button>
                <button value="btnMonthly" type="submit" class="btn btn-primary" name="accion">
                    Monthly 
                </button><br><br>
            </form>
        </div> 
    </div>    
    <div class="col-8">    
        <!--apartado que muestra informacion general-->
        <div class="container-fluid">
            <div class="">
                <h3>Student info</h3>
            </div>           
            
                <p><strong>Name: </strong> <?php echo $_SESSION["name"]; ?> </p>
            
            
                <p><strong>Surname: </strong> <?php echo $_SESSION["surname"]; ?> </p>
            
            
                <p><strong>Username: </strong> <?php echo $_SESSION["username"]; ?> </p>
            
            
                <p><?php foreach ($listaCursos as $listCursos) { ?>
            
            
                <p><strong>Courses: </strong> <?php echo $listCursos['description']; ?></p>
            
        <?php } ?>
        <p><strong>Date registered:</strong> <?php echo date("Y-m-d", strtotime($_SESSION["fechaActual"])); ?> </p><br><br>
        </div>
    </div>
    <div class="col-8">
    <?php
//damos forma a la tabla que contiene la informacion filtrada en funcion del boton switch seleccionado
if (isset($_POST['viewDate'])) { ?>
    <div class="container-fluid row ">
        <table class="table table-hover table-success table-sm table-sm table-bordered">
            <thead class="">                
                <th>Day</th>
                <th>Start day</th>
                <th>Finish</th>
                <th>Class</th>
            </thead>
            <?php
            foreach ($listaDatos as $list) { ?>
                <tr class="table table-hover table-success table-sm table-bordered">
                    <td><?php echo $list['day']; ?></td>
                    <td><?php echo $list['time_start']; ?></td>
                    <td><?php echo $list['time_end']; ?></td>
                    <td><?php echo $list['name']; ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <!--realizando comparacion en funcion de opcion elegida-->
<?php } else {
    $sentencia = $conexion->prepare("SELECT sh.day, sh.time_start, sh.time_end, cl.name
                             FROM enrollment e, courses c, class cl, schedule sh
                            WHERE e.id_course=c.id_course 
                            AND e.id_student=:id 
                            AND c.id_course=cl.id_course 
                            AND sh.id_class=cl.id_class AND sh.day=CURRENT_DATE");
    //para poder filtrar opcion, tenemos que pasar id 
    $sentencia->bindParam(':id', $_SESSION["id"]);
    //al ejecutar la sentencia estamos recorriendo la consulta
    $sentencia->execute();
    //rellenamos el array listadatos con los datos recogidos de la consulta ejecutada.
    $listaDatos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>
    <div class="row">
        <table class="table table-hover table-success table-sm table-bordered">
            <thead>
                <th>Day</th>
                <th>Start day</th>
                <th>Finish</th>
                <th>Class</th>
            </thead>
            <?php
            foreach ($listaDatos as $list) { ?>
                <tr class="table table-hover table-success table-sm table-bordered">
                    <td><?php echo $list['day']; ?></td>
                    <td><?php echo $list['time_start']; ?></td>
                    <td><?php echo $list['time_end']; ?></td>
                    <td><?php echo $list['name']; ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
<?php } ?>
    </div>
</div>



<?php
$footer  = "templates/footer.php";
require($footer);
?>