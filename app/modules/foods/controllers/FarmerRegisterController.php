<?php

class FarmerRegisterController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array(
					'index',
					'view',
					'saveFarmerRegister',
                    'getFoodAlias',
                    'getFarmerFoods'
				),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	public function actionSaveFarmerRegister() {
		$name = Yii::app()->request->getPost('name');
		$cpf = Yii::app()->request->getPost('cpf');
		$phone = Yii::app()->request->getPost('phone');
		$groupType = Yii::app()->request->getPost('groupType');
        $foodsRelation = Yii::app()->request->getPost('foodsRelation');

        var_dump($name, $cpf, $phone, $groupType, $foodsRelation);

        if(!empty($name) && !empty($cpf) && !empty($phone) && !empty($groupType)) {
            $farmerRegister = new FarmerRegister();

            $farmerRegister->name = $name;
            $farmerRegister->cpf = $cpf;
            $farmerRegister->phone = $phone;
            $farmerRegister->group_type = $groupType;

            if($farmerRegister->save()) {
                foreach ($foodsRelation as $foodData) {
                    $farmerFoods =  new FarmerFoods;

                    $farmerFoods->food_fk = $foodData['id'];
                    $farmerFoods->farmer_fk = $farmerRegister->id;
                    $farmerFoods->amount = $foodData['amount'];
                    $farmerFoods->measurementUnit = $foodData['measurementUnit'];

                    $farmerFoods->save();
                }
            }
        }
	}

    public function actionGetFarmerFoods() {
        $id = Yii::app()->request->getPost('id');

        $criteria = new CDbCriteria();
        $criteria->with = array('foodFk');
        $criteria->condition = 't.farmer_fk = ' . $id;
        $farmerFoodsData = FarmerFoods::model()->findAll($criteria);

        $values = [];
        foreach ($farmerFoodsData as $foods) {
            $values[] = array(
                'description' => $foods->foodFk->description,
                'amount' => $foods->amount,
                'measurementUnit' => $foods->measurementUnit,
            );
        }

        echo json_encode($values);
    }

    public function actionGetFoodAlias()
    {
        $criteria = new CDbCriteria();
        $criteria->select = 'id, description, measurementUnit';
        $criteria->condition = 'alias_id = t.id';

        $foods_description = Food::model()->findAll($criteria);

        $values = [];
        foreach ($foods_description as $food) {
            $values[$food->id] = (object) [
                'description' => $food->description,
                'measurementUnit' => $food->measurementUnit
            ];
        }

        echo json_encode($values);
    }

	public function actionCreate() {
		$model=new FarmerRegister;
        $modelFarmerFoods = new FarmerFoods;

		if(isset($_POST['FarmerRegister']))
		{
			$model->attributes=$_POST['FarmerRegister'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model, 'modelFarmerFoods'=>$modelFarmerFoods,
		));
	}

	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$modelFarmerFoods=$this->loadFarmerFoodsModel($id);

		if(isset($_POST['FarmerRegister']))
		{
			$model->attributes=$_POST['FarmerRegister'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model, 'modelFarmerFoods'=>$modelFarmerFoods,
		));
	}

	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('FarmerRegister');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	public function actionAdmin()
	{
		$model=new FarmerRegister('search');
		$model->unsetAttributes();
		if(isset($_GET['FarmerRegister']))
			$model->attributes=$_GET['FarmerRegister'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function loadModel($id)
	{
		$model=FarmerRegister::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

    public function loadFarmerFoodsModel($id)
	{
		$modelFarmerFoods = FarmerFoods::model()->find(
            array(
                'condition' => 'farmer_fk = :id',
                'params' => array(':id' => $id),
            )
        );
		if($modelFarmerFoods===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $modelFarmerFoods;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='farmer-register-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
