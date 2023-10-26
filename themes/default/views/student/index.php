<div id="mainPage" class="main">
    <?php
    $this->setPageTitle('TAG - ' . Yii::t('default', 'Student Identifications'));
    $contextDesc = Yii::t('default', 'Available actions that may be taken on StudentIdentification.');
    $this->menu = array(
        array('label' => Yii::t('default', 'Create a new StudentIdentification'), 'url' => array('create'), 'description' => Yii::t('default', 'This action create a new StudentIdentification')),
    );
    $themeUrl = Yii::app()->theme->baseUrl;
    $cs = Yii::app()->getClientScript();

    ?>

    <div class="row-fluid">
        <div class="span12">
            <h1><?php echo Yii::t('default', 'Student Identifications') ?></h1>
            <div class="t-buttons-container">
                <!--<a href="<?= CHtml::normalizeUrl(array('student/create')) ?>" class="btn btn-primary btn-icon glyphicons circle_plus"><i></i> Alunos PNE</a>-->
                <a class="t-button-primary" href="<?= CHtml::normalizeUrl(array('student/create')) ?>"><?= Yii::t('default', 'Add') ?></a>
                <div class="mobile-row">
                    <a class="t-button-secondary" href="<?= CHtml::normalizeUrl(array('student/create', 'simple' => 1)) ?>"> <?= Yii::t('default', 'Add (Fast)') ?></a>
                    <a class="t-button-secondary" href="<?= CHtml::normalizeUrl(array('wizard/configuration/student')) ?>">Matrícula em Grupo</a>
                </div>
            </div>
        </div>      
    </div>

    <div class="tag-inner">
        <?php if (Yii::app()->user->hasFlash('error')) : ?>
            <div class="alert alert-error">
                <?php echo Yii::app()->user->getFlash('error') ?>
            </div>
            <?php
            if (isset($buttons))
                echo $buttons;
            ?>
            <br />
        <?php endif ?>
        <?php if (Yii::app()->user->hasFlash('success')) : ?>
            <div class="alert alert-success">
                <?php echo Yii::app()->user->getFlash('success') ?>
            </div>
            <?php
            if (isset($buttons))
                echo $buttons;
            ?>
        <?php endif ?>
        <div class="widget clearmargin">
            <div class="widget-body">
                <div class="grid-view">
                    <table id="student-identification-table" class="display js-tag-table student-table 
                        tag-table-primary table table-condensed table-striped table-hover table-primary table-vertical-center checkboxs" 
                        style="width:100%" aria-label="students table">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Filiação Principal</th>
                                <th>Data de Nascimento</th>
                                <th>ID INEP</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
</div>
    <div class="columntwo">
    </div>
</div>

</div>

<script>
    $(document).on("click", "#student-delete", function (event) {
        event.preventDefault();
        var confirmation = confirm("Tem certeza que deseja excluir? Essa ação não pode ser desfeita!");
        if (confirmation) {
        window.location.href = event.currentTarget.href;
        }
    });
</script>
