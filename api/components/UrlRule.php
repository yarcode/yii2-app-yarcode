<?php
/**
 * Created by PhpStorm.
 * User: olegy
 */

namespace api\components;

class UrlRule extends \yii\rest\UrlRule
{
    public $patterns = [
        'POST,GET list' => 'list',
        'POST total' => 'total',
        'OPTIONS list' => 'list-options',
        'PUT,PATCH {id}' => 'update',
        'DELETE {id}' => 'delete',
        'GET,HEAD {id}' => 'view',
        'POST' => 'create',
        'GET,HEAD' => 'index',
        'OPTIONS total' => 'total-options',
        'OPTIONS {id}' => 'options',
        'OPTIONS ' => 'options',
    ];

}
