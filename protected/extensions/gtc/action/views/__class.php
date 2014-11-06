    <div class="row">
        <?php echo $form->labelEx($model,'className'); ?>
        <?php echo $form->textField($model,'className',array('size'=>65)); ?>
        <div class="tooltip">
            Validator class name must only contain word characters.
        </div>
        <?php echo $form->error($model,'className'); ?>
    </div>

	<div class="row sticky">
		<?php echo $form->labelEx($model,'baseClass'); ?>
        <?php $this->widget(
            'ext.gtc.action.widgets.simpleFilter.JSimpleFilter',
            array(
                'model'=>$model,
                'attribute'=>'baseClass',
                'htmlOptions'=>array('size'=>65),
                'data'=>array(
                    'CAction',
                    'XRenderAction',
                ),
                'showAll' => true,
            ));
        ?>
		<div class="tooltip">
			This is the class that the new action class will extend from.
			Please make sure the class exists and can be autoloaded.<br/><br/>
            When the input has focus and the up or down keys are pressed,
            all base classes are shown.
		</div>
		<?php echo $form->error($model,'baseClass'); ?>
	</div>
	<div class="row sticky">
		<?php echo $form->labelEx($model,'scriptPath'); ?>
		<?php echo $form->textField($model,'scriptPath', array('size'=>65)); ?>
		<div class="tooltip">
			This refers to the directory that the new view script file should be generated under.
			It should be specified in the form of a path alias, for example, <code>application.validator</code>,
			<code>mymodule.views</code>.
            <br /><br />When running the generator on Mac OS, Linux or Unix, you may need to change the
permission of the script path so that it is full writeable. <br />Otherwise you will get a generation error.
		</div>
		<?php echo $form->error($model,'scriptPath'); ?>
	</div>