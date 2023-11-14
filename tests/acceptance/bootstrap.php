<?php
require_once 'vendor/autoload.php';
require_once 'app/vendor/autoload.php';
require_once __DIR__ . '/../providers/CustomProvider.php';

$yiit = __DIR__ . '\..\..\app\vendor\yiisoft\yii\framework\yiit.php';
require_once $yiit;

$config = __DIR__ . '/../../app/config/test.php';

Yii::createWebApplication($config);

require_once __DIR__ . "/../robots/LoginRobots.php";
require_once __DIR__ . "/../builders/LoginBuilder.php";

require_once __DIR__ . '/../robots/MatrixRobots.php';
require_once __DIR__ . '/../builders/MatrixBuilder.php';

require_once __DIR__ . "/../robots/ClassroomRobots.php";
require_once __DIR__ . "/../builders/ClassroomBuilder.php";

require_once __DIR__ . '/../robots/ManageStagesRobots.php';
require_once __DIR__ . '/../builders/ManageStagesBuilder.php';

require_once __DIR__ . '/../robots/StudentsRobots.php';
require_once __DIR__ . '/../builders/StudentBuilder.php';

require_once __DIR__ . "/../robots/WizardRobots.php";
require_once __DIR__ . '/../builders/WizardBuilder.php';

require_once __DIR__ . "/../robots/ClassPlanRobots.php";
require_once __DIR__ . '/../builders/ClassPlanBuilder.php';
