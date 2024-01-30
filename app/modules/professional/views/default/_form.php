<?php
/* @var $this ProfessionalController */
/* @var $modelProfessional Professional */
/* @var $form CActiveForm */
?>

<div class="form">

	<?php
	$baseScriptUrl = Yii::app()->controller->module->baseScriptUrl;
	$themeUrl = Yii::app()->theme->baseUrl;
    $cs = Yii::app()->getClientScript();

	$cs->registerScriptFile($baseScriptUrl . '/common/js/professional.js?v=1.1', CClientScript::POS_END);

	$form = $this->beginWidget(
		'CActiveForm',
		array(
			'id' => 'professional-form',
			'enableAjaxValidation' => false,
		)
	);
	?>
	<div class="row-fluid hidden-print">
		<div class="span12">
			<h1>
				<?php echo $title; ?>
			</h1>
			<div class="tag-buttons-container buttons">
				<button class="t-button-primary pull-right save-professional" type="submit">
					<?= $modelProfessional->isNewRecord ? Yii::t('default', 'Create') : Yii::t('default', 'Save') ?>
				</button>
			</div>
		</div>
	</div>

	<div class="tag-inner">
		<?php if (Yii::app()->user->hasFlash('success') && (!$modelProfessional->isNewRecord)): ?>
			<div class="alert alert-success">
				<?php echo Yii::app()->user->getFlash('success') ?>
			</div>
		<?php endif ?>
		<div class="widget widget-tabs border-bottom-none">
			<?php echo $form->errorSummary($modelProfessional); ?>
			<div class="alert alert-error professional-error no-show"></div>
			<div class="widget-body form-horizontal">
				<div class="tab-content">
					<div class="tab-pane active" id="professional-identify">
						<div>
							<h3>Dados Básicos</h3>
						</div>
						<div class="row-fluid">
							<div class="span6">
								<div class="separator">
									<div class="control-group">
										<div class="controls">
											<?php echo $form->label($modelProfessional, 'name', array('class' => 'control-label')); ?>
										</div>
										<div class="controls">
											<?php echo $form->textField($modelProfessional, 'name', array('size' => 60, 'maxlength' => 100)); ?>
											<?php echo $form->error($modelProfessional, 'name'); ?>
										</div>
									</div>
									<div class="control-group">
										<div class="controls">
											<?php echo $form->label($modelProfessional, 'cpf_professional', array('class' => 'control-label')); ?>
										</div>
										<div class="controls">
											<?php echo $form->textField($modelProfessional, 'cpf_professional', array('size' => 60, 'maxlength' => 100, 'class' => 'cpf-input')); ?>
											<?php echo $form->error($modelProfessional, 'cpf_professional'); ?>
										</div>
									</div>
									<div class="control-group">
										<div class="controls">
											<?php echo $form->label($modelProfessional, 'speciality', array('class' => 'control-label')); ?>
										</div>
										<div class="controls">
											<?php echo $form->textField($modelProfessional, 'speciality', array('size' => 100)); ?>
											<?php echo $form->error($modelProfessional, 'speciality'); ?>
										</div>
									</div>
									<div class="control-group">
										<div class="controls">
											<?php echo $form->label($modelProfessional, 'fundeb', array('class' => 'control-label', 'style' => 'width: 70px;')); ?>
											<?php echo $form->checkBox($modelProfessional, 'fundeb', array('value' => 1, 'uncheckValue' => 0)); ?>
										</div>
										<div class="controls">
											<?php echo $form->error($modelProfessional, 'fundeb'); ?>
										</div>
									</div>
								</div>
							</div>
							<?php if(!$modelProfessional->isNewRecord) {?>
							<div class="span6">
								<div class="row">
									<a href="#" class="t-button-primary new-attendance-button" id="new-attendance-button">Adicionar Atendimento</a>
								</div>
								<div class="attendance-container">
									<div class="form-attendance" style="display: none;">
										<div>
											<h3>Atendimento</h3>
										</div>
										<div class="control-group">
											<div class="controls">
												<?php echo $form->label($modelAttendance, 'date', array('class' => 'control-label')); ?>
											</div>
											<div class="controls">
												<?php 
													$this->widget('zii.widgets.jui.CJuiDatePicker', array(
														'model' => $modelAttendance,
														'attribute' => 'date',
														'options' => array(
															'dateFormat' => 'dd/mm/yy',
															'changeYear' => true,
															'changeMonth' => true,
															'yearRange' => '2000:' . date('Y'),
															'showOn' => 'focus',
															'maxDate' => 0
														),
														'htmlOptions' => array(
															'readonly' => 'readonly',
															'style' => 'cursor: pointer;',
															'placeholder' => 'Clique aqui para escolher a data'
														),
													));
												
													echo $form->error($modelAttendance, 'date');
												?>
											</div>
										</div>
										<div class="control-group">
											<div class="controls">
												<?php echo $form->label($modelAttendance, 'local', array('class' => 'control-label')); ?>
											</div>
											<div class="controls">
												<?php echo $form->textField($modelAttendance, 'local', array('size' => 60, 'maxlength' => 100, 'placeholder' => 'Informe o local do atendimento')); ?>
												<?php echo $form->error($modelAttendance, 'local'); ?>
											</div>
										</div>
									</div>
									<div id="attendances" class="widget widget-scroll margin-bottom-none table-responsive">
										<h3>
											Atendimentos
										</h3>
										<div style="max-height: 300px; overflow-y: scroll;">
											<table class="tag-table-primary table-bordered table-striped"
												aria-describedby="tabela de atendimentos">
												<thead>
													<tr>
														<th style="text-align: center; min-width: 200px;">Data</th>
														<th style="text-align: center; min-width: 200px;">Local</th>
													</tr>
												</thead>
												<tbody>
													<?php
													foreach ($modelAttendances as $attendance) {
													?>
														<tr>
															<td style="text-align: center;"><?php echo date("d/m/Y", strtotime($attendance->date)) ?></td>
															<td style="text-align: center;"><?php echo $attendance->local?></td>
														</tr>
													<?php
													}
													?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php }?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php $this->endWidget(); ?>
</div>

<script type="text/javascript">
    // Aplica a máscara e validação do CPF
    $(document).ready(function(){
        $('.cpf-input').mask('999.999.999-99', {placeholder: '___.___.___-__'});
        $('.cpf-input').blur(function(){
            var cpf = $(this).val().replace(/[^0-9]+/g,'');

            if(cpf.length == 11){
                var v = [];
                var sum = 0;

                // Validar CPF
                for (var i = 1; i <= 9; i++) {
                    sum += parseInt(cpf.substring(i-1, i)) * (11 - i);
                }

                var remainder = (sum * 10) % 11;

                if ((remainder === 10) || (remainder === 11)) {
                    remainder = 0;
                }

                if (remainder !== parseInt(cpf.substring(9, 10))) {
                    v.push(false);
                }

                sum = 0;

                for (var i = 1; i <= 10; i++) {
                    sum += parseInt(cpf.substring(i-1, i)) * (12 - i);
                }

                remainder = (sum * 10) % 11;

                if ((remainder === 10) || (remainder === 11)) {
                    remainder = 0;
                }

                if (remainder !== parseInt(cpf.substring(10, 11))) {
                    v.push(false);
                }

                if(v.length === 0){
                    // CPF válido
					$(".save-professional").removeAttr('disabled');
					$(this).css('border', '1px solid #ccc');
					$(this).css('color', 'black');
                    $(this).removeClass('error');
                    $(this).next('.error-message').remove();
                }else{
                    // CPF inválido
					$(".save-professional").attr('disabled', 'disabled');
					$(this).css('border', '1px solid red');
					$(this).css('color', 'red');
                    $(this).next('.error-message').remove();
                    $(this).after('<div class="error-message">CPF inválido</div>');
                }
            }else{
                // CPF inválido
				$(".save-professional").attr('disabled', 'disabled');
				$(this).css('border', '1px solid red');
				$(this).css('color', 'red');
                $(this).next('.error-message').remove();
                $(this).after('<div class="error-message">CPF inválido</div>');
            }
        });
    });
</script>

<style>

.error-message {
    color: red;
    font-size: 12px;
    margin-top: 5px;
}

</style>
