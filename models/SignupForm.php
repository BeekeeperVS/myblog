<?php
/**
 * Created by PhpStorm.
 * User: vitalii
 * Date: 26.12.18
 * Time: 12:16
 */

namespace app\models;


use yii\base\Model;

class SignupForm extends Model
{
    public $name;
    public $email;
    public $password;

    public function rules()
    {
        return [
            [ ['name','email','password'], 'required' ],
            [['name'], 'string'],
            [['email'], 'email'],
            [['name'], 'unique', 'targetClass'=>'app\models\User', 'targetAttribute'=>'name'],
            [['email'], 'unique', 'targetClass'=>'app\models\User', 'targetAttribute'=>'email']
        ];
    }

    public function signup(){
        if ($this->validate()){
            $user = new User();
            $user->attributes=$this->attributes;
            return $user->create();
        }
    }



}