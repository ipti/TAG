<?php

class StudentIdentificationController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = 'fullmenu';
    private $STUDENT_IDENTIFICATION = 'StudentIdentification';
    private $STUDENT_DOCUMENTS_AND_ADDRESS = 'StudentDocumentsAndAddress';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('index', 'view', 'create', 'update', 'getcities'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'modelStudentIdentification' => $this->loadModel($id, $this->STUDENT_IDENTIFICATION),
            'modelStudentDocumentsAndAddress' => $this->loadModel($id, $this->STUDENT_DOCUMENTS_AND_ADDRESS),
        ));
    }

    
    public function actionGetCities() {
        $student = new StudentIdentification();
        $student->attributes = $_POST[$this->STUDENT_IDENTIFICATION];

        $data = EdcensoCity::model()->findAll('edcenso_uf_fk=:uf_id', array(':uf_id' => (int) $student->edcenso_uf_fk));
        $data = CHtml::listData($data, 'id', 'name');

        echo CHtml::tag('option', array('value' => 'NULL'), 'Selecione uma cidade', true);
        foreach ($data as $value => $name) {
            echo CHtml::tag('option', array('value' => $value), CHtml::encode($name), true);
        }
    }
    
    
    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $modelStudentIdentification = new StudentIdentification;
        $modelStudentDocumentsAndAddress = new StudentDocumentsAndAddress;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($modelStudentIdentification);

        if (isset($_POST[$this->STUDENT_IDENTIFICATION]) && isset($_POST[$this->STUDENT_DOCUMENTS_AND_ADDRESS])) {
            $modelStudentIdentification->attributes = $_POST[$this->STUDENT_IDENTIFICATION];
            $modelStudentDocumentsAndAddress->attributes = $_POST[$this->STUDENT_DOCUMENTS_AND_ADDRESS];
            if ($modelStudentIdentification->validate() && $modelStudentDocumentsAndAddress->validate()) {
                if ($modelStudentIdentification->save()) {
                    $modelStudentDocumentsAndAddress->student_fk = $modelStudentIdentification->inep_id;
                    $modelStudentDocumentsAndAddress->student_identification_fk = $modelStudentIdentification->id;
                    if ($modelStudentDocumentsAndAddress->save()) {
                        $this->redirect(array('view', 'id' => $modelStudentIdentification->id));
                    }
                }
            }
            if ($modelStudentIdentification->save() && $modelStudentDocumentsAndAddress->save()) {
                Yii::app()->user->setFlash('success', Yii::t('default', 'Student Created Successful:'));
                $this->redirect(array('index'));
            }
        }

        $this->render('create', array(
            'modelStudentIdentification' => $modelStudentIdentification,
            'modelStudentDocumentsAndAddress' => $modelStudentDocumentsAndAddress
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $modelStudentIdentification = $this->loadModel($id, $this->STUDENT_IDENTIFICATION);
        $modelStudentDocumentsAndAddress = $this->loadModel($id, $this->STUDENT_DOCUMENTS_AND_ADDRESS);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($modelStudentIdentification);

        if (isset($_POST[$this->STUDENT_IDENTIFICATION]) && isset($_POST[$this->STUDENT_DOCUMENTS_AND_ADDRESS])) {
            $modelStudentIdentification->attributes = $_POST[$this->STUDENT_IDENTIFICATION];
            $modelStudentDocumentsAndAddress->attributes = $_POST[$this->STUDENT_DOCUMENTS_AND_ADDRESS];
            if ($modelStudentIdentification->validate() && $modelStudentDocumentsAndAddress->validate()) {
                if ($modelStudentIdentification->save()) {
                    $modelStudentDocumentsAndAddress->student_fk = $modelStudentIdentification->inep_id;
                    $modelStudentDocumentsAndAddress->student_identification_fk = $modelStudentIdentification->id;
                    if ($modelStudentDocumentsAndAddress->save()) {
                        $this->redirect(array('view', 'id' => $modelStudentIdentification->id));
                    }
                }
            }
        }

        $this->render('update', array(
            'modelStudentIdentification' => $modelStudentIdentification,
            'modelStudentDocumentsAndAddress' => $modelStudentDocumentsAndAddress
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModel($id, $this->STUDENT_DOCUMENTS_AND_ADDRESS)->delete();
            $this->loadModel($id, $this->STUDENT_IDENTIFICATION)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider($this->STUDENT_IDENTIFICATION,
                        array('pagination' => array(
                                'pageSize' => 12,
                        )));
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $modelStudentIdentification = new StudentIdentification('search');
        $modelStudentIdentification->unsetAttributes();  // clear any default values
        $modelStudentDocumentsAndAddress = new StudentDocumentsAndAddress('search');
        $modelStudentDocumentsAndAddress->unsetAttributes();  // clear any default values

        if (isset($_GET[$this->STUDENT_IDENTIFICATION]) && isset($_GET[$this->STUDENT_DOCUMENTS_AND_ADDRESS])) {
            $modelStudentIdentification->attributes = $_GET[$this->STUDENT_IDENTIFICATION];
            $modelStudentDocumentsAndAddress->attributes = $_GET[$this->STUDENT_DOCUMENTS_AND_ADDRESS];
        }
        $this->render('admin', array(
            'modelStudentIdentification' => $modelStudentIdentification,
            'modelStudentDocumentsAndAddress' => $modelStudentDocumentsAndAddress,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id, $model) {
        $return = null;

        if ($model == $this->STUDENT_IDENTIFICATION) {
            $return = StudentIdentification::model()->findByPk($id);
        } else if ($model == $this->STUDENT_DOCUMENTS_AND_ADDRESS) {

            $student_inep_ip = StudentIdentification::model()->findByPk($id)->inep_id;

            $return = ($student_inep_ip == null) ? StudentDocumentsAndAddress::model()->findByAttributes(array('student_identification_fk' => $id)) : StudentDocumentsAndAddress::model()->findByAttributes(array('student_fk' => $student_inep_ip));
        }

        if ($return === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $return;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'student') {
            echo CActiveForm::validate($model);
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
