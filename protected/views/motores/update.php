<?php
$this->breadcrumbs=array(
	'Motores'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	Yii::t('app', 'Actualizar'),
);

$this->menu=array(
	array('label'=>'Lista de Motores', 'url'=>array('index')),
	array('label'=>'Nuevo Motor', 'url'=>array('create')),
	array('label'=>'Detalles Detalles', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Gestionar Motores', 'url'=>array('admin')),
);
?>

<?php
$nombre="";
$modelTMP=Motores::model()->findByAttributes(array('TAG'=>$model->TAG));
if (isset($modelTMP->Motor))
        $nombre=$modelTMP->Motor;
if (isset($modelTMP->TAG))
        $nombre=$nombre.' ('.$modelTMP->TAG.')';

?>

<?php $this->setPageTitle(' Actualizar Motor:'.$nombre.''); ?>
<div class="form"><style>    .forms50cr{  float:left;    }</style>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'motores-form',
	'enableAjaxValidation'=>true,
    'htmlOptions'=>array('enctype' => 'multipart/form-data'),
)); 
echo $this->renderPartial('_form', array(
	'model'=>$model,
    'modelArchivo' => $modelArchivo,
	'form' =>$form
	)); ?>

<div class="row buttons forms100c">
	<?php echo CHtml::submitButton(Yii::t('app', 'Actualizar')); ?>
</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
