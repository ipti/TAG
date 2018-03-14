<?php

$baseScriptUrl = Yii::app()->controller->module->baseScriptUrl;

$cs = Yii::app()->getClientScript();
$cs->registerCssFile($baseScriptUrl . '/common/css/layout.css');
$cs->registerScriptFile($baseScriptUrl . '/common/js/quiz.js', CClientScript::POS_END);
$this->setPageTitle('TAG - ' . Yii::t('default', 'Question'));


$form = $this->beginWidget('CActiveForm', array(
    'id' => 'question-form',
    'enableAjaxValidation' => false,
));
?>

<div class="row-fluid  hidden-print">
    <div class="span12">
        <h3 class="heading-mosaic"><?php echo $title; ?></h3>  
        <div class="buttons">
            <?php echo CHtml::htmlButton('<i></i>' . ($question->isNewRecord ? Yii::t('default', 'Create') : Yii::t('default', 'Save')), array('id' => 'save_question_button', 'class' => 'btn btn-icon btn-primary last glyphicons circle_ok', 'type' => 'button'));
            ?>
            <?php 
                if(!$question->isNewRecord){
                    echo CHtml::htmlButton('<i></i>' . Yii::t('default', 'Delete'), array('id' => 'delete_question_button', 'class' => 'btn btn-icon btn-primary last glyphicons delete', 'type' => 'button'));
                }
            ?>
        </div>
    </div>
</div>

<div class="innerLR">
    <?php if (Yii::app()->user->hasFlash('success') && (!$question->isNewRecord)): ?>
        <div class="alert alert-success">
            <?php echo Yii::app()->user->getFlash('success') ?>
        </div>
    <?php endif ?>

    <?php if (Yii::app()->user->hasFlash('error') && (!$question->isNewRecord)): ?>
        <div class="alert alert-error">
            <?php echo Yii::app()->user->getFlash('error') ?>
        </div>
    <?php endif ?>
    
    <div class="widget widget-tabs border-bottom-none">
        <div class="widget-head  hidden-print">
            <ul class="tab-classroom">
                <li id="tab-question" class="active" ><a class="glyphicons adress_book" href="#question" data-toggle="tab"><i></i><?php echo Yii::t('default', 'Question') ?></a></li>
            </ul>
        </div>

        <div class="widget-body form-horizontal">
            <div class="tab-content">
                    
                <div class="tab-pane active" id="question">
                        <div class="row-fluid">
                            <div class=" span8">
                                <div class="control-group">                
                                    <?php echo $form->labelEx($question, 'description', array('class' => 'control-label')); ?>
                                    <div class="controls">
                                        <?php echo $form->textField($question, 'description', array('size' => 60, 'maxlength' => 255)); ?>
                                        <span style="margin: 0;" class="btn-action single glyphicons circle_question_mark" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo Yii::t('default', 'Question Description'); ?>"><i></i></span>
                                        <?php echo $form->error($question, 'name'); ?>
                                    </div>
                                </div> <!-- .control-group -->
                                <div class="control-group">
                                    <?php echo $form->labelEx($question, 'type', array('class' => 'control-label required')); ?>
                                    <div class="controls">
                                    <?php
                                        $quizs = Quiz::model()->findAll(
                                            "status = :status AND final_date >= :final_date",
                                            [
                                                ':status' => 1,
                                                ':final_date' => date('Y-m-d'),
                                            ]
                                        );

                                        echo $form->dropDownList($question, 'type',array(
                                                '1' => 'Subjetiva',
                                                '2' => 'Objetiva',
                                                '3' => 'Múltipla Escolha'
                                            ),
                                            array("prompt" => "Selecione o Tipo", 'class' => 'select-search-on')); ?>
                                        <?php echo $form->error($question, 'type'); ?>
                                    </div>
                                </div><!-- .control-group -->
                                <div class="control-group">
                                    <?php echo $form->labelEx($question, 'status', array('class' => 'control-label required')); ?>
                                    <div class="controls">
                                        <?php
                                        echo $form->DropDownList($question, 'status', array(
                                            null => 'Selecione o status',
                                            '1' => 'Ativo',
                                            '0' => 'Inativo'), array('class' => 'select-search-off'));
                                        ?>
                                        <?php echo $form->error($question, 'status'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	
</div>

<?php $form = $this->endWidget(); ?>