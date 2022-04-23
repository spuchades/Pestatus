<?php
session_start();
require_once("config/Conexion.php");
require_once("crud/Crud.php");

//por mediacion del insert insertamos datos introducidos en el form o modal correspondiente
if (isset($_POST["username_stu"])){
    $_SESSION['userNameStudent']=$_POST["username_stu"];
    $_SESSION['passwordStudent']=$_POST["password_stu"];
    $_SESSION['nameStudent']=$_POST["name_stu"];
    $_SESSION['surnameStudent']=$_POST["surname_stu"];
    $_SESSION['telephoneStudent']=$_POST["telephone_stu"];
    $_SESSION['nifStudent']=$_POST["nif_stu"];
    $_SESSION['dayStudent']=$_POST["day_stu"];
    $_SESSION['emailStudent']=$_POST["email_stu"];
}

//por mediacion del insert insertamos datos introducidos en el form o modal correspondiente
if (isset($_POST["name"])){
    $_SESSION['nameProfesor']=$_POST["name"];
    $_SESSION['surnameProfesor']=$_POST["surname"];
    $_SESSION['telephoneProfesor']=$_POST["telephone"];
    $_SESSION['nifProfesor']=$_POST["nif"];
    $_SESSION['emailProfesor']=$_POST["email"];
}

//aplicamos update via boton correspondiente
if(isset($_SESSION["nameProfesor"])&&!(empty($_SESSION["nameProfesor"]))&&$_POST['accion']=='ModificarPro'){

  
    $id=$_SESSION['idProfesor'];
    $name=$_SESSION['nameProfesor'];
    $surname=$_SESSION['surnameProfesor'];
    $telephone=$_SESSION['telephoneProfesor'];
    $nif=$_SESSION['nifProfesor'];
    $email=$_SESSION['emailProfesor'];
    $crud = new Crud("teachers");
    $crud->where("id_teacher","=",$id)->update([
        "id_teacher"=>$id,  
        "name"=>$name,
        "surname"=>$surname,
        "telephone"=>$telephone,
        "nif"=>$nif,
        "email"=>$email
    ]);
    $_SESSION['trueModificacion']=true;
    header("Location: ../view/admin.php");

}

//aplicamos delete via boton correspondiente
if(isset($_SESSION["nameProfesor"])&&!(empty($_SESSION["nameProfesor"]))&&$_POST['accion']=='EliminarPro'){

   $crud = new Crud("teachers");
   $id=$_SESSION['idProfesor'];
   $crud->where("id_teacher","=",$id)->delete();
   $_SESSION['trueDelete']=true;
   header("Location: ../view/admin.php");

}

//aplicamos update via boton correspondiente
if(isset($_POST['name_curso'])&&!(empty($_POST['name_curso']))&&$_POST['accion']=='ModificarCur'){
    $id=$_SESSION['idCurso'];
    $name=$_POST['name_curso'];
    $description=$_POST['description_curso'];
    $inicio=$_POST['inicio_curso'];
    $fin=$_POST['fin_curso'];
    $activo=$_POST['activo'];
    $crud = new Crud("courses");
    $crud->where("id_course","=",$id)->update([
        "id_course"=>$id,  
        "name"=>$name,
        "description"=>$description,
        "date_start"=>$inicio,
        "date_end"=>$fin,
        "active"=>$activo
    ]);
    $_SESSION['trueModificacion']=true;
    header("Location: ../view/admin.php");

}

//aplicamos delete via boton correspondiente
if(isset($_POST['name_curso'])&&!(empty($_POST['name_curso']))&&$_POST['accion']=='EliminarCur'){
    $crud = new Crud("courses");
    $id=$_SESSION['idCurso'];
    $crud->where("id_course","=",$id)->delete();
    $_SESSION['trueDelete']=true;
    header("Location: ../view/admin.php");
}

//aplicamos update via boton correspondiente
if(isset($_POST['id_class_agenda'])&&!(empty($_POST['id_class_agenda']))&&$_POST['accion']=='ModificarAge'){
    $id=$_SESSION['id2Agenda'];
    $idAgenda=$_POST['id_class_agenda'];
    $inicioA=$_POST['inicio_agenda'];
    $finA=$_POST['fin_agenda'];
    $dia=$_POST['dia_agenda'];
    $crud = new Crud("schedule");
    $crud->where("id_schedule","=",$id)->update([
        "id_schedule"=>$id,  
        "id_class"=>$idAgenda,
        "time_start"=>$inicioA,
        "time_end"=>$finA,
        "day"=>$dia
    ]);
    $_SESSION['trueModificacion']=true;
    header("Location: ../view/admin.php");

}

//aplicamos delete via boton correspondiente
if(isset($_POST['id_class_agenda'])&&!(empty($_POST['id_class_agenda']))&&$_POST['accion']=='EliminarAge'){
    $crud = new Crud("schedule");
    $id=$_SESSION['id2Agenda'];
    $crud->where("id_schedule","=",$id)->delete();
    $_SESSION['trueDelete']=true;
    header("Location: ../view/admin.php");
}


//aplicamos update via boton correspondiente
if(isset($_POST['nombre_clase'])&&!(empty($_POST['nombre_clase']))&&$_POST['accion']=='ModificarClasClas'){

    $id=$_SESSION['idclass'];
    $idAgenda=$_POST['id_class_agenda'];
    $idprofesorC=$_POST['prof_clase'];
    $idcursoC=$_POST['curs_clase'];
    $idagendaC=$_POST['agen_clase'];
    $name=$_POST['nombre_clase'];
    $color=$_POST['color_clase'];
    $crud = new Crud("class");
    $crud->where("id_class","=",$id)->update([
        "id_class"=>$id,  
        "id_teacher"=>$idprofesorC,
        "id_course"=>$idcursoC,
        "id_schedule"=>$idagendaC,
        "name"=>$name,
        "color"=>$color
    ]);
    $_SESSION['trueModificacion']=true;
    header("Location: ../view/admin.php");

}

//aplicamos delete via boton correspondiente
if(isset($_POST['nombre_clase'])&&!(empty($_POST['nombre_clase']))&&$_POST['accion']=='EliminarClas'){
    $crud = new Crud("class");
    $id=$_SESSION['idclass'];
    $crud->where("id_class","=",$id)->delete();
    $_SESSION['trueDelete']=true;
    header("Location: ../view/admin.php");
}

//aplicamos update via boton correspondiente
if(isset($_SESSION['userNameStudent'])&&!(empty($_SESSION['userNameStudent']))&&$_POST['accion']=='ModificarStu'){

    $id=$_SESSION['idstudent'];
    $username=$_SESSION['userNameStudent'];
    $password=$_SESSION['passwordStudent'];
    $name= $_SESSION['nameStudent'];
    $surname=$_SESSION['surnameStudent'];
    $telephone=$_SESSION['telephoneStudent'];
    $nif= $_SESSION['nifStudent'];
    $fecha_actual=$_SESSION['dayStudent'];
    $email=$_SESSION['emailStudent'];
    $crud = new Crud("students");
    $crud->where("id","=",$id)->update([
        "id"=>$id,
        "username" => $username,
        "pass" => $password,
        "email" => $email,
        "name" => $name,
        "surname" => $surname,
        "telephone" => $telephone,
        "nif" => $nif,
        "date_registered" => $fecha_actual
    ]);
    $_SESSION['trueModificacion']=true;
    header("Location: ../view/admin.php");

}

//aplicamos delete via boton correspondiente
if(isset($_POST['username_stu'])&&!(empty($_POST['username_stu']))&&$_POST['accion']=='EliminarStu'){
    $crud = new Crud("students");
    $id=$_SESSION['idstudent'];
    $crud->where("id","=",$id)->delete();
    $_SESSION['trueDelete']=true;
    header("Location: ../view/admin.php");
}


//aplicamos update via boton correspondiente
if(isset($_POST['stuEnroll'])&&!(empty($_POST['stuEnroll']))&&$_POST['accion']=='ModificarEnroll'){
    $id=$_SESSION['idEnroll'];
    $idstu=$_POST['stuEnroll'];
    $idcurso=$_POST['cursostudentselect'];
    $statusA=$_POST['statusSelect'];
    $crud = new Crud("enrollment");
    $crud->where("id_enrollment","=",$id)->update([
        "id_enrollment"=>$id,  
        "id_student"=>$idstu,
        "id_course"=>$idcurso,
        "status"=>$status
    ]);
    $_SESSION['trueModificacion']=true;
    header("Location: ../view/admin.php");

}

//aplicamos delete via boton correspondiente
if(isset($_POST['stuEnroll'])&&!(empty($_POST['stuEnroll']))&&$_POST['accion']=='EliminarEnroll'){
    echo "entro en eliminarEnroll";
    $crud = new Crud("enrollment");
    $id=$_SESSION['idEnroll'];
    $crud->where("id_enrollment","=",$id)->delete();
    $_SESSION['trueDelete']=true;
    header("Location: ../view/admin.php");
}else{
    echo("Not enter, problems enrollment");
}


//de mismo modo que hicimos en otros fichero construimos un switch que determinara opcion elegida
if(isset($_POST["crear"])&&!(empty($_POST["crear"]))){    
    $btn=$_POST["crear"];  
    switch($btn){
        case 'CreateProfesor':
            insertarProfesor();
            break;
        case 'CreateAgenda':
            insertarAgenda();
            break;
        case 'CreateCurso':
            insertarCurso();
            break;
        case 'CreateClase':
            insertarClase();
            break;
        case 'CreateStudent':
            insertStudent();
            break;
        case 'CreateEnroll':
            insertEnroll();
            break;        
    }
}

// ****************************************************************************************************************************************
// damos forma a las funciones que ejecutan la parte correspondiente del crud
// tener en cuenta que en todas ellas no se hace referencia al id puesto que es AI
function insertEnroll(){

    $idStudentEnroll=$_POST["stuEnroll"];
    $idCursoEnroll=$_POST["cursostudentselect"];
    $status = $_POST["statusSelect"];
    //creamos objeto y ejecutamos insert en tabla y campos determinados
    $crud = new Crud("enrollment");
    $crud->insert([
        "id_student"=>$idStudentEnroll,
        "id_course"=>$idCursoEnroll,
        "status"=>$status
    ]);
    $_SESSION["trueInsert"]=true;
    header("Location: ../view/admin.php");  
}

function insertStudent(){

$username=$_POST["username_stu"];
$password=$_POST["password_stu"];
$email=$_POST["email_stu"];
$name=$_POST["name_stu"];
$surname=$_POST["surname_stu"];
$telephone=$_POST["telephone_stu"];
$nif=$_POST["nif_stu"];
$fecha_actual =$_POST["day_stu"];
//creamos objeto y ejecutamos insert en tabla y campos determinados
$crud = new Crud("students");
$crud->insert([   
    "username" => $username,
    "pass" => $password,
    "email" => $email,
    "name" => $name,
    "surname" => $surname,
    "telephone" => $telephone,
    "nif" => $nif,
    "date_registered" => $fecha_actual
]);

$_SESSION["trueInsert"]=true;
header("Location: ../view/admin.php");   

}
function insertarAdmin(){
$name_admin = $_POST["username_admin"];
$surname_admin = $_POST["name_admin"];
$email_admin = $_POST["email_admin"];
$pass_admin = $_POST["password_admin"];
//creamos objeto y ejecutamos insert en tabla y campos determinados
$crud = new Crud('users_admin');
$crud->insert([
    "username" => $name_admin,
    "name" => $surname_admin,
    "email" => $email_admin,
    "password" => $pass_admin
]);
$_SESSION["trueInsert"]=true;
header("Location: ../view/admin.php");
}

function insertarProfesor(){
    $exito=false;
    $name=$_POST["name"];
    $surname=$_POST["surname"];
    $telephone=$_POST["telephone"];
    $nif=$_POST["nif"];
    $email=$_POST["email"];  
    //creamos objeto y ejecutamos insert en tabla y campos determinados    
    $crud = new Crud("teachers");
    $crud->insert([ 
    "name" => $name,
    "surname" => $surname,
    "telephone" => $telephone,
    "nif" => $nif,
    "email" => $email        
    ]);
    $exito=true;
    $_SESSION["trueInsert"]=true;
    header("Location: ../view/admin.php");    
    return $exito;
}

function insertarCurso(){
    $exito=false;
    $name=$_POST["name_curso"];
    $description=$_POST["description_curso"];
    $inicio=$_POST["inicio_curso"];
    $fin=$_POST["fin_curso"];
    $activo=$_POST["activo"];
    //creamos objeto y ejecutamos insert en tabla y campos determinados    
    $crud = new Crud("courses");
    $crud->insert([
        "name" => $name,
        "description" => $description,
        "date_start" => $inicio,
        "date_end" => $fin,
        "active" => $activo
    ]);
    $exito=true;
    $_SESSION["trueInsert"]=true;
    header("Location: ../view/admin.php");    
    return $exito;
}

function insertarAgenda(){
    $exito=false;
    $id_class=$_POST["id_class_agenda"];
    $inicio=$_POST["inicio_agenda"];
    $fin=$_POST["fin_agenda"];
    $dia=$_POST["dia_agenda"];   
    //creamos objeto y ejecutamos insert en tabla y campos determinados
    $crud = new Crud("schedule");    
    $crud->insert([        
        "id_class" => $id_class,
        "time_start" => $inicio,
        "time_end" => $fin,
        "day" => $dia        
    ]);
    $exito=true;
    $_SESSION["trueInsert"]=true;
    header("Location: ../view/admin.php");    
    return $exito;
}

function insertarClase(){
    $exito=false;
    $idprofesor = $_POST["prof_clase"];
    $idcurso = $_POST["curs_clase"];
    $idagenda =$_POST["agen_clase"];
    $name=$_POST["nombre_clase"];
    $color =$_POST["color_clase"]; 
    //creamos objeto y ejecutamos insert en tabla y campos determinados
    $crud = new Crud("class");    
    $crud->insert([       
        "id_teacher" => $idprofesor,
        "id_course" => $idcurso,
        "id_schedule" => $idagenda,
        "name"=> $name,
        "color"=> $color        
    ]);
    $exito=true;
    $_SESSION["trueInsert"]=true;
    header("Location: ../view/admin.php");    
    return $exito;    
}
