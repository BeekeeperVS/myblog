<?php

namespace app\controllers;

use app\models\Category;
use app\models\Comment;
use app\models\CommentForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Article;
use yii\data\Pagination;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public $layout = 'markup';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $data=Article::getAll(1);
        $popular = Article::getPopulation();
        $recent = Article::getResent();
        $categories = Category::getAll();
        return $this->render('index',[
            'articles' => $data['articles'],
            'pagination' =>$data['pagination'],
            'popular'=>$popular,
            'recent'=>$recent,
            'categories'=>$categories,
            ]);
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
    public function actionErr()
    {
        return $this->render('err');
    }
    public function actionComment($id){
        $model = new CommentForm();
        if (Yii::$app->request->isPost){
            if ($model->load(Yii::$app->request->post()) && $model->addComment($id)) {
                Yii::$app->getSession()->setFlash('comment', 'You comment will be added soon!');
                return $this->redirect(['site/view', 'id' => $id]);
            }
        }
    }
    public function actionView($id)
    {
        $article = Article::findOne($id);
        $popular = Article::getPopulation();
        $recent = Article::getResent();
        $categories = Category::getAll();
        $comments=$article->getСonfirmComments();
        $model = new CommentForm();

        return $this->render('view', [
            'folderMarkup'=>'../../web/public',
            'article'=>$article,
            'popular'=>$popular,
            'recent'=>$recent,
            'categories'=>$categories,
            'comments'=>$comments,
            'model'=>$model,
            ]);

    }
    public function actionCategory($id)
    {
        $data=Category::getArticlesByCategory($id,4);
        $popular = Article::getPopulation();
        $recent = Article::getResent();
        $categories = Category::getAll();
        $folderMarkup='../../web/public';
        return $this->render('category', [
            'articles' => $data['articles'],
            'pagination' =>$data['pagination'],
            'popular'=>$popular,
            'recent'=>$recent,
            'categories'=>$categories,
            'folderMarkup'=>$folderMarkup,
        ]);
    }
}
