<?php

namespace app\components;

use Yii;

class User extends \yii\web\User
{
    public $roles = [
        'admin' => -1
    ];

    public function getHomeUrl()
    {
        $identity  = $this->getIdentity();
        $teacherId = $identity->teacher_id;
        $url       = 'site/index';
        if ($teacherId == -1) {
            $url = 'admin/index';
        }

        return $url;
    }

    public function can($permissionName, $params = [], $allowCaching = true)
    {
        $identity = $this->getIdentity();

        if (isset($this->roles[$permissionName]) && $identity) {
            return $this->roles[$permissionName] == $identity->teacher_id;
        }

        return false;
    }
}
