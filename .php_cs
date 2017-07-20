<?php
/**
 * @author Antonov Oleg <theorder83dev@gmail.com>
 */

$finder = \PhpCsFixer\Finder::create()
    ->exclude([
        'vendor',
        'common/tests',
        'api/tests',
        'backend/tests',
        'frontend/tests',
    ])
    ->in(__DIR__);

return \PhpCsFixer\Config::create()
    ->setRules([
            '@PSR2' => true,
    ])
    ->setFinder($finder);