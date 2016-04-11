<?php
namespace frontend\models;

use common\models\User;
use common\models\Codes;
use yii\helpers\ArrayHelper;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;

    public $code;

    public $jabber;
    public $icq;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['code', 'in', 'range' => ArrayHelper::map(Codes::findAll(['used'=>0]), 'id', 'code')],
            ['code', 'required'],
            [['jabber', 'icq'], 'safe']
        ];
    }

   
    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->jabber = $this->jabber;
        $user->icq = $this->icq;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        
        if($user->save()){
            $code = Codes::findOne(['code'=>$this->code]);
            $code->used = 1;
            $code->user_id = $user->id;
            $code->save();
            return $user;  
        }

        return null;
    }
}
