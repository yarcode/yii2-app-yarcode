<?php
/**
 * @author Antonov Oleg <theorder83dev@gmail.com>
 */

return array_merge(
    [
        '<version:[\wd-]+>/' => '<version>/api',
        // must be at the end of
        '<module:[\wd-]+>/<controller:[\wd-]+>' => '<module>/<controller>',
        '<module:[\wd-]+>/<controller:[\wd-]+>/<action:[\wd-]+>' => '<module>/<controller>/<action>',
        '<version:[\wd-]+>/<module:[\wd-]+>/<controller:[\wd-]+>/<action:[\wd-]+>' => '<version>/<module>/<controller>/<action>',
    ]
);
