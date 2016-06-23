<?php

namespace app\commands;

use Yii;
use yii\console\Controller;
use yii\db\Connection;

class GameController extends Controller
{
    public function actionExport()
    {
        $db = new Connection([
            'dsn' => 'mysql:host=localhost;dbname=ubs',
            'username' => 'root',
            'password' => 'gw4t3sns',
            'charset' => 'utf8',
        ]);

        $sql = 'SELECT * FROM Game ORDER BY id ASC';
        $games = $db->createCommand($sql)->queryAll();

        $export = [];
        foreach ($games as $game) {
            $export[$game['id']] = [
                'name' => $game['name'],
                'title' => $game['title'],
                'storeProducts' => [],
                'products' => [],
            ];
        }

        $sql = 'SELECT * FROM GameProduct ORDER BY id ASC';
        $gp = $db->createCommand($sql)->queryAll();
        foreach ($gp as $product) {
            $tmpProduct = [
                'name' => $product['name'],
                'description' => $product['description'],
                'isPackage' => $product['is_package'],
                'image' => $product['image'],
                'data' => $product['data'],
                'package' => []
            ];

            if ($product['is_package']) {
                $sql = 'SELECT count, name FROM Package LEFT JOIN GameProduct ON GameProduct.id = Package.child_id WHERE parent_id = '.$product['id'].' ORDER BY Package.id ASC';
                $package = $db->createCommand($sql)->queryAll();
                foreach ($package as $item) {
                    $tmpProduct['package'][] = [
                        'name' => $item['name'],
                        'count' => $item['count']
                    ];
                }
            }

            $export[$product['game_id']]['products'][] = $tmpProduct;
        }

        $sql = 'SELECT StoreProduct.*, GameProduct.name as gpName FROM StoreProduct LEFT JOIN GameProduct ON StoreProduct.gameProduct_id = GameProduct.id ORDER BY StoreProduct.id ASC';
        $sp = $db->createCommand($sql)->queryAll();
        foreach ($sp as $product) {
            $export[$product['game_id']]['storeProducts'][] = [
                'name' => $product['name'],
                'gameProduct' => $product['gpName'],
                'storeId' => $product['store_id'],
                'title' => $product['title'],
                'description' => $product['description'],
                'consumable' => $product['consumable'],
                'price' => $product['price'],
                'store' => $product['store'],
            ];
        }

        try {
            file_put_contents(Yii::getAlias('@app/web/media/dump.json'), json_encode(array_values($export)));

            echo 'Создан файл экспорта: ' . Yii::getAlias('@app/web/media/dump.json') . PHP_EOL;
            echo 'Команда для импорта: mongoimport --db {db} --collection {colletction} ' . Yii::getAlias('@app/web/media/dump.json') . ' --jsonArray' . PHP_EOL;

            return self::EXIT_CODE_NORMAL;
        } catch (\Exception $e) {
            echo 'Не удалось создать файл экспорта: ' . $e->getMessage() . PHP_EOL;

            return self::EXIT_CODE_ERROR;
        }
    }
}
