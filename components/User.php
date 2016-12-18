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
        $url       = 'index';

        if ($identity->role == $this->roles['admin']) {
            $url = '/admin/index';
        }

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

    public function isAdmin()
    {
        $identity  = $this->getIdentity();
        if (!$identity) {
            return false;
        }

        return $this->getIdentity()->role == $this->roles['admin'];
    }
}
