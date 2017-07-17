<?php
/**
 * Created by PhpStorm.
 * User: olegy
 */

return array_merge(
    [
        'v1/' => 'v1/api',
    ],
    [
        // must be at the end of
        '<module:[\wd-]+>/<controller:[\wd-]+>' => '<module>/<controller>',
        '<module:[\wd-]+>/<controller:[\wd-]+>/<action:[\wd-]+>' => '<module>/<controller>/<action>',
        '<version:[\wd-]+>/<module:[\wd-]+>/<controller:[\wd-]+>/<action:[\wd-]+>' => '<version>/<module>/<controller>/<action>',
    ]
);
