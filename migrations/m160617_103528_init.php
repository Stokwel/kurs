<?php

class m160617_103528_init extends \yii\mongodb\Migration
{
    public function up()
    {
        $this->db = Yii::$app->get('mongodb');

        $this->createIndex('game', [
            'name' => 1,
        ], [
            'unique' => true,
        ]);

        $this->createIndex('user', [
            'username' => 1
        ], [
            'unique' => true,
        ]);

        $this->db->getCollection('user')->insert([
            'username' => 'admin',
            'email'    => 'admin@example.com',
            'password' => '$2a$10$JTJf6/XqC94rrOtzuF397OHa4mbmZrVTBOQCmYD9U.obZRUut4BoC'
        ]);

        return true;
    }

    public function down()
    {
        return true;
    }

}
