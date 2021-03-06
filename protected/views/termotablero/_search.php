<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
        'action'=>Yii::app()->createUrl($this->route),
        'method'=>'get',
)); ?>

     <div class="row">
                <?php echo $form->label($model,'Analista'); ?>
                <?php echo $form->textField($model,'Analista',array('size'=>50,'maxlength'=>50)); ?>
        </div>
    
<div class="row">
                <?php echo $form->label($model,'TAG'); ?>
                <?php echo $form->textField($model,'TAG',array('size'=>50,'maxlength'=>50)); ?>
        </div>
      
        <div class="row">
                 <?php $today = date("Y-m-d"); ?>

                <?php echo $form->label($model,'Fecha'); ?>
                <?php
//TODO: Corregir fecha al actualizar
                if (defined($model->Fecha))
                    $today = $model->Fecha;

               Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
                $this->widget('CJuiDateTimePicker', array(
                    'model' => $model, //Model object
                    'attribute' => 'Fecha', //attribute name
                    'mode' => 'datetime', //use "time","date" or "datetime" (default)
                    'language' => 'es',
                    'value' => $today,
                     'themeUrl' => '/themes',
                     'theme' => 'calendarioCbm',
                    'options' => array(
                        'dateFormat' => 'yy-mm-dd',
                        'showButtonPanel' => true,
                        "yearRange" => '1995:2070',
                        'changeYear' => true,
                      'buttonImage'=>'/images/calendar.png',
                  'showOn'=> "both",
                  'buttonText'=>"Seleccione la fecha",
                  'buttonImageOnly'=> true 
                     
                    ) // jquery plugin options
                    
                ));
                ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'OT'); ?>
                <?php echo $form->textField($model,'OT'); ?>
        </div>

   <!--     
    
   <div class="row">
                <?php echo $form->label($model,'id'); ?>
                <?php echo $form->textField($model,'id',array('size'=>20,'maxlength'=>20)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'Path'); ?>
                <?php echo $form->textField($model,'Path',array('size'=>60,'maxlength'=>200)); ?>
        </div>

      
        <div class="row">
                <?php echo $form->label($model,'Tamano'); ?>
                <?php echo $form->textField($model,'Tamano'); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'Criterio'); ?>
                <?php echo $form->textField($model,'Criterio',array('size'=>50,'maxlength'=>50)); ?>
        </div>
--->
        <div class="row buttons">
                <?php echo CHtml::submitButton(Yii::t('app', 'Buscar')); ?>
        </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
