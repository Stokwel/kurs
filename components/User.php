<?php

namespace app\components;

use Yii;

class User extends \yii\web\User
{
    public $roles = [
        'admin' => -1,
        'author' => 0
    ];

    public function getHomeUrl()
    {
        $identity  = $this->getIdentity();
        $url       = 'authors/index';
        /*if ($teacherId == -1) {
            $url = 'admin/index';
        } elseif ($teacherId > 0) {
            $url = 'teacher/index';
        }*/

        return $url;
    }

    public function can($permissionName, $params = [], $allowCaching = true)
    {
        $identity = $this->getIdentity();
        if (isset($this->roles[$permissionName]) && $identity) {
            return $this->roles[$permissionName] == $identity->role;
        }

        return false;
    }
}
