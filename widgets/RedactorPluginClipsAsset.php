<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace yii\redactor\widgets;

use Yii;

/**
 * @author Nghia Nguyen <yiidevelop@hotmail.com>
 * @since 2.0
 */
class RedactorPluginClipsAsset extends \yii\web\AssetBundle
{

    public $sourcePath = '@vendor/yiidoc/yii2-redactor/assets';
    public $depends = ['yii\redactor\widgets\RedactorAsset'];
    public $js = ['plugins/clips/clips.js'];
    public $css = ['plugins/clips/clips.css'];

}