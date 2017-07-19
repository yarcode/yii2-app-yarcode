<?php
/**
 * @author Antonov Oleg <theorder83dev@gmail.com>
 */

return array_merge(
    [
        // must be at the end of
        '<version:[\wd-]+>/' => '<version>/api',
        '<module:[\wd-]+>/<controller:[\wd-]+>' => '<module>/<controller>',
        '<module:[\wd-]+>/<controller:[\wd-]+>/<action:[\wd-]+>' => '<module>/<controller>/<action>',
        '<version:[\wd-]+>/<module:[\wd-]+>/<controller:[\wd-]+>/<action:[\wd-]+>' => '<version>/<module>/<controller>/<action>',
    ]
);
