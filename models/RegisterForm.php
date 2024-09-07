<?php

namespace app\models;

use yii\base\Model;

class RegisterForm extends Model
{

    public $username;
    public $email;
    public $password;

    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username',
                'required',
                'message' => 'Поле "Имя пользователя" должно быть заполнено'
            ],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Это имя уже занято'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['email', 'trim'],
            ['email',
                'required',
                'message' => 'Поле "email" должно быть заполнено'
            ],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Этот email же используется'],
            ['password',
                'required',
                'message' => 'Поле "Пароль" должно быть заполнено'
            ],
            ['password', 'string', 'min' => 6],
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
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $saved = $user->save();
        return $saved ? $user : null;
    }

}