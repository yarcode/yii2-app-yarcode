#API Application

API Application is part of the yii-app-yarcode template to quickly create a REST API. 

Application has its own namespace and alias corresponding to its name. 

API are both web applications and both contain the web directory. That's the webroot you should point your web server to.

## Usage

For example, create a simple API for displaying a list of all profiles in the system.

Create `api/modules/v1/controllers/UserController.php` file

```
<?php
namespace api\modules\v1\controllers;

use api\components\Controller;
use common\models\UserProfile;

class UserController extends Controller
{
    /**
     * @return array
     */
    public function actionIndex()
    {
        return UserProfile::find()->all();
    }
}
```

Configure `api/modules/v1/config/roures.php` file
```
<?php 

return [
    ['class' => 'yii\rest\UrlRule', 'controller' => 'v1/user'],
];
```

It's all. Go to `{API_HOST}/v1/users`