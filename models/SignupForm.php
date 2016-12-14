<?php
namespace app\models;

use yii\base\Model;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $first_name;
    public $second_name;
    public $third_name;
    public $address_residence;
    public $place_work;
    public $birth_date;

    public function attributeLabels()
    {
        return [
            'username' => 'Логин',
            'password' => 'Пароль',
            'first_name' => 'Имя',
            'second_name' => 'Фамилия',
            'third_name' => 'Отчество',
            'address_residence' => 'Место проживания',
            'place_work' => 'Место работы',
            'birth_date' => 'Дата рождения'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'first_name', 'second_name', 'third_name', 'address_residence', 'place_work', 'birth_date'], 'required'],
            [['username', 'first_name', 'second_name', 'third_name', 'address_residence', 'place_work'], 'trim'],
            [['username', 'first_name', 'second_name', 'third_name', 'address_residence', 'place_work'], 'string', 'min' => 2, 'max' => 255],

            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This username has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['birth_date', 'date', 'timestampAttribute' => 'birth_date', 'format' => 'dd-MM-yyyy'],
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
        $user->setPasswordAndSalt($this->password);
        $user->first_name = $this->first_name;
        $user->second_name = $this->second_name;
        $user->third_name = $this->third_name;
        $user->address_residence = $this->address_residence;
        $user->place_work = $this->place_work;
        $user->birth_date = $this->birth_date;

        return $user->save() ? $user : null;
    }
}
