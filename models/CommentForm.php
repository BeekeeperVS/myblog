<?php
/**
 * Created by PhpStorm.
 * User: vitalii
 * Date: 27.12.18
 * Time: 13:17
 */

namespace app\models;



use Yii;
use yii\base\Model;

class CommentForm extends Model
{
    public $comment;

     public function rules()
     {

         return [
             [['comment'], 'required'],
             [['comment'], 'string','length'=>[3,255]],
         ];

     }
    public function addComment($id){
        $comment= new Comment();
        $comment->text=$this->comment;
        $comment->user_id= ((Yii::$app->user->isGuest)?16:(Yii::$app->user->id));
        $comment->date=date('Y-m-d');
        $comment->article_id = $id;
        return $comment->save();

    }
}