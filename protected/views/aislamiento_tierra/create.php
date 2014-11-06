<?php
    if  (isset($_GET['id']))
    {
       $modeloId=Motores::model()->findByAttributes(array("TAG"=>$_GET['id']));
    }
?>


<style type="text/css">
  
    div.loading {
    background-color: #FFFFFF;
    background-image: url('/images/loading.gif');
    background-position:  100px;
    background-repeat: no-repeat;
    opacity: 1;
}
div.loading * {
    opacity: .8;
}
  

     
    
</style> 

<?php 
/*
$this->widget( 'ext.EChosen.EChosen', array(
  'target' => 'select',
  'useJQuery' => true,
  'debug' => false,
)); 
*/
?>




<script type="text/javascript">
    // función que actualiza el campo de Area dependiendo del campo de proceso
    function updateFieldArea()
    {
<?php
echo CHtml::ajax(array(
    'type' => 'GET', //request type
    'data' => array('proceso' => 'js:document.getElementById("proceso").value'),
    'url' => CController::createUrl('/motores/dynamicArea'), //url to call.
    //'update' => '#Visitas_idDoctor', //selector to update
    'success' => 'updateAreaDropdown',
    'beforeSend' => 'function(){
      $("#myDiv").addClass("loading");}',
    'complete' => 'function(){
      $("#myDiv").removeClass("loading");}',
    'dataType' => 'json')
);
?>
        //document.getElementById('Examenes_convenio').selectedIndex = conv;
        return false;
    }
    
    function updateFieldEquipo()
    {
<?php
echo CHtml::ajax(array(
    'type' => 'GET', //request type
    'data' => array('area' => 'js:document.getElementById("area").value'),
    'url' => CController::createUrl('/motores/dynamicEquipo'), //url to call.
    //'update' => '#Visitas_idDoctor', //selector to update
    'success' => 'updateEquipoDropdown',
     'beforeSend' => 'function(){
      $("#myDiv").addClass("loading");}',
    'complete' => 'function(){
      $("#myDiv").removeClass("loading");}',
    'dataType' => 'json')
);
?>
        //document.getElementById('Examenes_convenio').selectedIndex = conv;
        return false;
    }

    function updateFieldMotor()
    {
<?php
echo CHtml::ajax(array(
    'type' => 'GET', //request type
    'data' => array('equipo' => 'js:document.getElementById("equipo").value'),
    'url' => CController::createUrl('/motores/dynamicFMotor'), //url to call.
    //'update' => '#Visitas_idDoctor', //selector to update
    'success' => 'updateMotorDropdown',
     'beforeSend' => 'function(){
      $("#myDiv").addClass("loading");}',
    'complete' => 'function(){
      $("#myDiv").removeClass("loading");}',
    'dataType' => 'json')
);
?>
        //document.getElementById('Examenes_convenio').selectedIndex = conv;
        return false;
    }

    function updateGridFechas()
    {
<?php
echo CHtml::ajax(array(
    'type' => 'GET', //request type
    'data' => array('TAG' => 'js:document.getElementById("motor").value'),
    'update'=>'#gridFechas',
    'url' => CController::createUrl('/aislamiento_tierra/dynamicFechas'), //url to call.
    //'update' => '#Visitas_idDoctor', //selector to update
    //'success' => 'updateContGridMotores',
    //'dataType' => 'json'
    )
);
?>
        //document.getElementById('Examenes_convenio').selectedIndex = conv;
        return false;
    }

    // función que cambia los datos de el Dropdownlist de Area
    function updateAreaDropdown(data)
    {
        $('#area').html(data.value1);
        updateFieldEquipo();
         // actualiza el echosen de area
        
        
    };

  function updateEquipoDropdown(data)
    {
        $('#equipo').html(data.value1);
        $('#motor').html('<option value="0"></option>');
       
        updateFieldMotor();
    };
 

    // función que cambia los datos de el Dropdownlist de Equipo
    function updateMotorDropdown(data)
    {
        $('#Aislamiento_tierra_TAG').html(data.value1);
         
        //updateGridFechas();
        //updateGraph();
    };


</script>


<?php
$this->breadcrumbs=array(
	'Aislamiento Tierra'=>array(Yii::t('app', 'index')),
	Yii::t('app', 'Crear'),
);

$this->menu=array(
	array('label'=>'Lista mediciones', 'url'=>array('index')),
	array('label'=>'Gestionar mediciones', 'url'=>array('admin')),
);
?>

<?php $this->setPageTitle (' Crear medición Aislamiento tierra '); ?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'aislamiento-tierra-form',
	'enableAjaxValidation'=>true,
)); 
?>


<?php echo $form->errorSummary($model); ?>

<div id="myDiv" class="forms100cb" styler="text-align:left;">
            <div class="forms50c" styler="width:50%;">
                <b>Area:</b>
                <?php
                    $valor=isset($modeloId)?$modeloId->Proceso:"";
// dibuja el dropDownList de Proceso, seleccionando los valores diferentes presentes en la tabla Estructura col. Proceso
                echo CHtml::dropDownList(
                        'proceso', $valor, CHtml::listData(Estructura::model()->findAllbySql(
                                        'SELECT DISTINCT Proceso FROM estructura ORDER BY Proceso ASC', array()), 'Proceso', 'Proceso'
                        ), array(
                    //'onfocus' => 'updateFieldArea()',
                    'onchange' => 'updateFieldArea()',
                    'styler' => 'width:100%;',
                    'class'=>'select',
                
                        )
                );
                ?>
                <!-- an la app original era:SELECT DISTINCT Area , Indicativo FROM Estructura WHERE (Proceso=@Proceso) ORDER BY Indicativo ASC -->
            </div>
            <div class="forms50c" styler="width:50%;">
                <b>Proceso:</b>
                <?php
                 $valor=isset($modeloId)?$modeloId->Area:"";
                // dibuja el dropDownList de Area, dependiendo del proceso selecccionado
                echo CHtml::dropDownList(
                        'area', $valor, CHtml::listData(Estructura::model()->findAllbySql(
                                        'SELECT DISTINCT Area FROM estructura WHERE Proceso="'.(isset($modeloId)?$modeloId->Proceso:"ELABORACION").'" ORDER BY Area ASC', array()), 'Area', 'Area'
                        ), array(
                    //'onfocus' => 'updateFieldArea()',
                    'onchange' => 'updateFieldEquipo()',
                    'styler' => 'width:100%;',
                    'class'=>'select',
                    'empty'=>'Seleccione el proceso',
                        )
                );
                ?>
            </div>
            <div>
                <b>Equipo:</b>
                <?php
                $valor=isset($modeloId)?$modeloId->Equipo:"";
                // dibuja el dropDownList de Proceso, seleccionando los valores diferentes presentes en la tabla Estructura col. Proceso
                echo CHtml::dropDownList(
                        'equipo', $valor, CHtml::listData(Estructura::model()->findAllbySql(
                                        'SELECT Equipo FROM estructura WHERE Area="'.(isset($modeloId)?$modeloId->Area:"FILTRACION").'" ORDER BY Equipo ASC', array()), 'Equipo', 'Equipo'
                        ), array(
                    //'onfocus' => 'updateFieldEquipo()',
                    'onchange' => 'updateFieldMotor()',
                    'styler' => 'width:100%;',
                    'class'=>'select',
                    'empty'=>'Seleccione el equipo',
                        )
                );
                ?>
            </div>
            <div>
                <b>Motor:</b>
                <?php
                 $valor=isset($modeloId)?$modeloId->TAG:"";
                // dibuja el dropDownList de Proceso, seleccionando los valores diferentes presentes en la tabla Estructura col. Proceso
                echo CHtml::dropDownList(
                        'Aislamiento_tierra[TAG]', $valor, CHtml::listData(Motores::model()->findAllbySql(
                                        'SELECT TAG, CONCAT(TAG," - ",Motor) as Motor FROM motores WHERE Equipo="'.(isset($modeloId)?$modeloId->Equipo:"ANILLO DE CONTRAPRESION").'" ORDER BY TAG ASC', array()), 'TAG', 'Motor'
                        ), array(
                    //'onfocus' => 'updateFieldEquipo()',
                    'styler' => 'width:100%;',
                    'class'=>'select',
                    'empty'=>'Seleccione el motor',
                        )
                );
                ?>
                <?php echo $form->error($model, 'TAG'); ?>
            </div>
</div>

<?php
// renderiza el resto del form
echo $this->renderPartial('_form', array(
	'model'=>$model,
	'form' =>$form
	)); ?>

<div class="row buttons forms100c">
	<?php echo CHtml::submitButton(Yii::t('app', 'Guardar')); ?>
</div>

<?php $this->endWidget(); ?>

</div>
