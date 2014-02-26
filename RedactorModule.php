<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace yii\redactor;

/**
 * @author Nghia Nguyen <yiidevelop@hotmail.com>
 * @since 2.0
 */
class RedactorModule extends \yii\base\Module
{
    public $controllerNamespace = 'yii\redactor\controllers';
    public $defaultRoute = 'upload';
}