<?php

namespace app\models;

use Yii;
use yii\data\Pagination;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string $title
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
        ];
    }
    public function getArticle(){
        return $this->hasMany(Article::className(),['category_id'=>'id']);
    }
    public function getArticleCount(){
        return $this->getArticle()->count();
    }
    public static function getAll(){
        return Category::find()->all();
    }
    public static function getArticlesByCategory($id, $pageSize=1){
       // $sql = 'SELECT * FROM article WHERE category_id=:id';
        $query = Article::find()->where(['category_id'=>$id]);//Article::findBySql($sql,[':id'=>$id]);
        $countQuery = $query->count();
        $pagination = new Pagination(['totalCount' => $countQuery, 'defaultPageSize'=>$pageSize]);
        $articles = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        return [
            'articles' => $articles,
            'pagination' =>$pagination,
        ];
    }

}
