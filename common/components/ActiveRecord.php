<?php

namespace common\components;

use YarCode\Yii2\Traits\CarbonModelTrait;
use YarCode\Yii2\Traits\FragileModelTrait;

/**
 * Class ActiveRecord
 * @package common\components
 */
class ActiveRecord extends \yii\db\ActiveRecord
{
    use CarbonModelTrait;
    use FragileModelTrait;
}