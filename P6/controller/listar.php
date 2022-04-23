<!-- en este fichero damos cuerpo a las funciones listar haciendo las llamadas pertinentes en cada una de las opciones -->
<?php
function listarProfesores($lista)
{
?>

    <div class="container">
        <h3 style="color: royalblue;">Teachers table</h3>
        <div class="table-responsive">
            <table class="table table-light table-striped table-bordered table-hover text-center">
                <thead class="table-primary">
                    <tr>
                        <th>Id_teacher</th>
                        <th>Name</th>
                        <th>Surname</th>
                        <th>Telephone</th>
                        <th>Nif</th>
                        <th>Email</th>
                        <th>Changes</th>
                    </tr>
                    </tr>
                </thead>
                <tbody class="table-success">
                    <?php

                    foreach ($lista as $teacher) {
                    ?>
                        <tr>
                            <td>
                                <?php echo ($teacher->id_teacher) ?></td>
                            <td>
                                <?php echo ($teacher->name) ?></td>
                            <td>
                                <?php echo ($teacher->surname) ?></td>
                            <td>
                                <?php echo ($teacher->telephone) ?></td>
                            <td>
                                <?php echo ($teacher->nif) ?></td>
                            <td>
                                <?php echo ($teacher->email) ?></td>
                            <td>
                                <form action="../view/admin.php" method='post'>
                                    <input type="hidden" name="id2Profesor" value=<?php echo ($teacher->id_teacher); ?>>
                                    <input type="hidden" name="name2" value=<?php echo ($teacher->name); ?>>
                                    <input type="hidden" name="surname2" value=<?php echo ($teacher->surname); ?>>
                                    <input type="hidden" name="telephone2" value=<?php echo ($teacher->telephone); ?>>
                                    <input type="hidden" name="nif2" value=<?php echo ($teacher->nif); ?>>
                                    <input type="hidden" name="email2" value=<?php echo ($teacher->email); ?>>
                                    <button class='btn btn-warning btn-listado' type='submit' name='modificarProfesor' value="Alterar Registro">
                                            Confirm Update
                                        </button>
                                </form>
                            </td>
                        </tr>
                    <?php    } ?>
                </tbody>
            </table>
        </div>
    </div>
    </div><br><br>
<?php
}
function listarAgenda($lista)
{
?>
    <div class="container">
        <h3 style="color: royalblue;">Schedule table</h3>
        <div class="table-responsive">
            <table class="table table-light table-striped table-bordered table-hover text-center">
                <thead class="table-primary">
                    <tr>
                        <th>id_schedule</th>
                        <th>id_class</th>
                        <th>time_start</th>
                        <th>time_end</th>
                        <th>day</th>
                        <th>Changes</th>
                    </tr>
                    </tr>
                </thead>
                <tbody class="table-success">
                    <?php
                    foreach ($lista as $schedule) {
                    ?>
                        <tr>
                            <td>
                                <?php echo ($schedule->id_schedule) ?></td>
                            <td>
                                <?php echo ($schedule->id_class) ?></td>
                            <td>
                                <?php echo ($schedule->time_start) ?></td>
                            <td>
                                <?php echo ($schedule->time_end) ?></td>
                            <td>
                                <?php echo ($schedule->day) ?></td>
                            <td>
                                <form action="../view/admin.php" method='post'>
                                    <input type="hidden" name="id2Agenda" value=<?php echo ($schedule->id_schedule); ?>>
                                    <input type="hidden" name="idclassAgenda2" value=<?php echo ($schedule->id_class); ?>>
                                    <input type="hidden" name="inicioAgenda2" value=<?php echo ($schedule->time_start); ?>>
                                    <input type="hidden" name="finAgenda2" value=<?php echo ($schedule->time_end); ?>>
                                    <input type="hidden" name="day2" value=<?php echo ($schedule->day); ?>>
                                    <button class='btn btn-warning btn-listado' type='submit' name='modificarAgenda' value="Alterar Registro">
                                            Confirm Update
                                        </button>
                                </form>
                            </td>
                        </tr>
                    <?php    } ?>
                </tbody>
            </table>
        </div>
    </div>
    </div><br><br>
<?php
}
function listarCursos($lista)
{
?>
    <div class="container">
        <h3 style="color: royalblue;">Courses table</h3>
        <div class="table-responsive">
            <table class="table table-light table-striped table-bordered table-hover text-center">
                <thead class="table-primary">
                    <tr>
                        <th>Id_course</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Date_start</th>
                        <th>Date_end</th>
                        <th>Active</th>
                        <th>Changes</th>
                    </tr>
                    </tr>
                </thead>
                <tbody class="table-success">
                    <?php
                    foreach ($lista as $courses) {
                    ?>
                        <tr>
                            <td>
                                <?php echo ($courses->id_course) ?></td>
                            <td>
                                <?php echo ($courses->name) ?></td>
                            <td>
                                <?php echo ($courses->description) ?></td>
                            <td>
                                <?php echo ($courses->date_start) ?></td>
                            <td>
                                <?php echo ($courses->date_end) ?></td>
                            <td>
                                <?php echo ($courses->active) ?></td>
                            <td>
                                <form action="../view/admin.php" method='post'>
                                    <input type="hidden" name="id2Curso" value=<?php echo ($courses->id_course); ?>>
                                    <input type="hidden" name="nameCurso2" value=<?php echo ($courses->name); ?>>
                                    <input type="hidden" name="descripcionCurso2" value=<?php echo ($courses->description); ?>>
                                    <input type="hidden" name="inicioCurso2" value=<?php echo ($courses->date_start); ?>>
                                    <input type="hidden" name="finCurso2" value=<?php echo ($courses->date_end); ?>>
                                    <input type="hidden" name="activo2" value=<?php echo ($courses->active); ?>>
                                    <button class='btn btn-warning btn-listado' type='submit' name='modificarCursos' value="Alterar Registro">
                                            Confirm Update
                                        </button>
                                </form>
                            </td>
                        </tr>
                    <?php    } ?>
                </tbody>
            </table>
        </div>
    </div>
    </div><br><br>
<?php
}

function listarClases($lista)
{
?>
    <div class="container">
        <h3 style="color: royalblue;">Classes table</h3>
        <div class="table-responsive">
            <table class="table table-light table-striped table-bordered table-hover text-center">
                <thead class="table-primary">
                    <tr>
                        <th>id_class</th>
                        <th>id_teacher</th>
                        <th>id_course</th>
                        <th>id_schedule</th>
                        <th>name</th>
                        <th>color</th>
                        <th>Changes</th>
                    </tr>
                    </tr>
                </thead>
                <tbody class="table-success">
                    <?php
                    foreach ($lista as $class) {
                    ?>
                        <tr>
                            <td>
                                <?php echo ($class->id_class) ?></td>
                            <td>
                                <?php echo ($class->id_teacher) ?></td>
                            <td>
                                <?php echo ($class->id_course) ?></td>
                            <td>
                                <?php echo ($class->id_schedule) ?></td>
                            <td>
                                <?php echo ($class->name) ?></td>
                            <td>
                                <?php echo ($class->color) ?></td>
                            <td>
                                <form action="../view/admin.php" method='post'>
                                    <input type="hidden" name="id2class" value=<?php echo ($class->id_class); ?>>
                                    <input type="hidden" name="id2classTeacher" value=<?php echo ($class->id_teacher); ?>>
                                    <input type="hidden" name="id2classCourse" value=<?php echo ($class->id_course); ?>>
                                    <input type="hidden" name="id2classAgenda" value=<?php echo ($class->id_schedule); ?>>
                                    <input type="hidden" name="nameclass2" value=<?php echo ($class->name); ?>>
                                    <input type="hidden" name="colorclass2" value=<?php echo ($class->color); ?>>
                                    <button class='btn btn-warning btn-listado' type='submit' name='modificarClases' value="Alterar Registro">
                                            Confirm Update
                                        </button>
                                </form>
                            </td>
                        </tr>
                    <?php    } ?>
                </tbody>
            </table>
        </div>
    </div>
    </div><br><br>
<?php
}
function listarStudent($lista)
{
?>
    <div class="container">
        <h3 style="color: royalblue;">Students table</h3>
        <div class="table-responsive">
            <table class="table table-light table-striped table-bordered table-hover text-center">
                <thead class="table-primary">
                    <tr>
                        <th>Id_student</th>
                        <th>username</th>
                        <th>pass</th>
                        <th>email</th>
                        <th>name</th>
                        <th>surname</th>
                        <th>telephone</th>
                        <th>nif</th>
                        <th>date_registered</th>
                        <th>Changes</th>
                    </tr>
                    </tr>
                </thead>
                <tbody class="table-success">
                    <?php
                    foreach ($lista as $student) {
                    ?>
                        <tr>
                            <td>
                                <?php echo ($student->id) ?></td>
                            <td>
                                <?php echo ($student->username) ?></td>
                            <td>
                                <?php echo ($student->pass) ?></td>
                            <td>
                                <?php echo ($student->email) ?></td>
                            <td>
                                <?php echo ($student->name) ?></td>
                            <td>
                                <?php echo ($student->surname) ?></td>
                            <td>
                                <?php echo ($student->telephone) ?></td>
                            <td>
                                <?php echo ($student->nif) ?></td>
                            <td>
                                <?php echo ($student->date_registered) ?></td>
                            <td>
                                <form action="../view/admin.php" method='post'>
                                    <input type="hidden" name="id2student" value=<?php echo ($student->id); ?>>
                                    <input type="hidden" name="username2student" value=<?php echo ($student->username); ?>>
                                    <input type="hidden" name="pass2student" value=<?php echo ($student->pass); ?>>
                                    <input type="hidden" name="email2student" value=<?php echo ($student->email); ?>>
                                    <input type="hidden" name="name2student" value=<?php echo ($student->name); ?>>
                                    <input type="hidden" name="surname2student" value=<?php echo ($student->surname); ?>>
                                    <input type="hidden" name="telephone2student" value=<?php echo ($student->telephone); ?>>
                                    <input type="hidden" name="nif2student" value=<?php echo ($student->nif); ?>>
                                    <input type="hidden" name="data2student" value=<?php echo ($student->date_registered); ?>>
                                    <button class='btn btn-warning btn-listado' type='submit' name='modificarEstudiante' value="Alterar Registro">
                                            Confirm Update
                                        </button>
                                </form>
                            </td>
                        </tr>
                    <?php    } ?>
                </tbody>
            </table>
        </div>
    </div>
    </div><br><br>
<?php
}
function listarEnrollment($lista)
{
?>
    <div class="container">
        <h3 style="color: royalblue;">Enrollment table</h3>
        <div class="table-responsive">
            <table class="table table-light table-striped table-bordered table-hover text-center">
                <thead class="table-primary">
                    <tr>
                        <th>id_enrollment</th>
                        <th>id_student</th>
                        <th>id_course</th>
                        <th>status</th>
                        <th>Changes</th>
                    </tr>
                    </tr>
                </thead>
                <tbody class="table-success">
                    <?php
                    foreach ($lista as $enrollment) {
                    ?>
                        <tr>
                            <td>
                                <?php echo ($enrollment->id_enrollment) ?></td>
                            <td>
                                <?php echo ($enrollment->id_student) ?></td>
                            <td>
                                <?php echo ($enrollment->id_course) ?></td>
                            <td>
                                <?php echo ($enrollment->status) ?></td>
                            <td>
                                <form action="../view/admin.php" method='post'>
                                    <input type="hidden" name="id2Enroll" value=<?php echo ($enrollment->id_enrollment); ?>>
                                    <input type="hidden" name="id2studentEnroll" value=<?php echo ($enrollment->id_student); ?>>
                                    <input type="hidden" name="id2courseEnroll" value=<?php echo ($enrollment->id_course); ?>>
                                    <input type="hidden" name="status2Enroll" value=<?php echo ($enrollment->status); ?>>
                                    <button class='btn btn-warning btn-listado' type='submit' name='modificarEnrollment' value="Alterar Registro">
                                            Confirm Update
                                        </button>
                                </form>
                            </td>
                        </tr>
                    <?php    } ?>
                </tbody>
            </table>
        </div>
    </div>
    </div><br><br>
<?php
}
?>