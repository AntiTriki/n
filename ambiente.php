<?php
include_once('bar.php');

include_once('conexion.php');
date_default_timezone_set('America/La_Paz');

$id_emp=$_SESSION['id_emp'];
if(isset($_SESSION['id_ges']))
{
unset($_SESSION['id_ges']);
}
$link = new mysqli($mysql_host, $mysql_user, $mysql_password, $my_database);


$query_user = sprintf("SELECT
             u.correo,
						 u.razon_social,
						 u.sigla,
						 u.direccion,
						 u.nit,
						 u.nivel



						 FROM
             empresa u
 						 WHERE
						 u.id=$id_emp


						 ");
$link->set_charset("utf8");
$result_user = mysqli_query($link,$query_user) or die("Error usu:".mysqli_error($link));
$row2 = mysqli_fetch_array($result_user);
$_SESSION['nombreemp']=$row2['sigla'];
$_SESSION['nivelemp']=$row2['nivel'];

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <style>

        button, input, optgroup, select, textarea {

            color: #000000;
        }
    </style>
  </head>
  <body>



<div class="container" style="padding-top: 100px">
    <a href="gestiones/index.php"><img style="width:20px;margin-left:890px" src="css/imp.png" /></a>
    <div id="Productos" style="width: 60%;margin:auto"></div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('#Productos').jtable({
            title: 'Gestiones',
			toolbar: {
           hoverAnimation: true,
                    hoverAnimationDuration: 60,
                    hoverAnimationEasing: undefined,
                    items: [{
                        tooltip: 'Export to Exel',
                        text: 'XLS',
                        click: function () {
                            alert('excel');
                        }
                    },{
                        tooltip: 'Export to Pdf',
                        text: 'PDF',
                        click: function () {
                            alert('adobe');
                        }
                    }]
                },

            actions: {
                //READ
                listAction: 'gestiones.php?accion=listar',
                //CREATE
                createAction: 'gestiones.php?accion=crear',
                //UPDATE
                updateAction: 'gestiones.php?accion=actualizar',
                //DELETE
                deleteAction: 'gestiones.php?accion=eliminar'
            },
            fields: {
                id: {
                    title: 'Id Gestion',
                    key: true,
                    create: false,
                    edit: false,
                    list: false
                },
                nombre: {
                    title: 'Nombre',
                    width: '20%',
                    create: true,
                    edit: true,
                    list: true
                },
                fecha_inicio: {
                    title: 'Fecha de Inicio',
                    width: '20%',
                    type: 'date',
                    displayFormat: 'dd/mm/yy',
                    create: true,
                    edit: true,
                    list: true

                },
                fecha_fin: {
                    title: 'Fecha de Fin',
                    width: '20%',
                    type: 'date',
                    displayFormat: 'dd/mm/yy',
                    create: true,
                    edit: true,
                    list: true
                },
                estado: {
                    title: 'Estado',
                    width: '20%',
                    create: false,
                    edit: true,
                    list: true,
                    // type: 'checkbox',
                    // values: { 0: 'Cerrado', 1: 'Abierto' },
                    // defaultValue: 0
                    options: { 0: 'Cerrado', 1: 'Abierto' }
                },

                ShowDetailColumn: {
                    title: '',
                    create: false,
                    edit: false,
                    list: true,
                    display: function (data) {
                        return '<a href="interno.php?id=' + data.record.id + '"><img style="width:20px" src="22.png" /></a>';
                    },
                    width: '2%'
                },
            },
            //Initialize validation logic when a form is created
            formCreated: function (event, data) {
                data.form.find('input[name="nombre"]').addClass('validate[required]');
                data.form.find('input[name="fecha_inicio"]').addClass('validate[required]');
                data.form.find('input[name="fecha_fin"]').addClass('validate[required]');




                data.form.validationEngine();
                data.form.css('width','300px');


            },
            //Validate form when it is being submitted
            formSubmitting: function (event, data) {
                return data.form.validationEngine('validate');
            },
            //Dispose validation logic when form is closed
            formClosed: function (event, data) {
                data.form.validationEngine('hide');
                data.form.validationEngine('detach');
            }
        });

        //Load person list from server
        $('#Productos').jtable('load');

    });

</script>
</body>
</html>
