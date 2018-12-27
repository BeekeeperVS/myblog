<?php
namespace app\controllers;
use app\models\SignupForm;
use app\models\User;
use yii\web\Controller;
use Yii;
use app\models\LoginForm;

class AuthController extends Controller
{
    public $layout = 'markup';

    /**
     * Login action.
     *
     * @return Response|string
     */

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
    public function actionSignup()
    {
//        Yii::$app->user->logout();
        $model = new SignupForm();
        if($model->load(Yii::$app->request->post()) && $model->validate()){
            if($model->signup()){
                return $this->redirect(['auth/login']);
            }
        }
        return $this->render('signup',['model'=>$model]);
    }
//    public function actionTest(){
//        $user = User::findOne(1);
//        Yii::$app->user->login($user);
//        if (Yii::$app->user->isGuest){
//            var_dump('Guest'); die;
//        }
//        else{
//            var_dump('Login user'); die;
//        }
//    }

}