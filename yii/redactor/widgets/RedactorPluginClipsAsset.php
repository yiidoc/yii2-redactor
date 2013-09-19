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
    public $depends = array('yii\redactor\widgets\RedactorAsset');
    public $js = array(
        'plugins/clips/clips.js',
    );
    public $css = array(
        'plugins/clips/clips.css'
    );

    public function init()
    {
        $this->sourcePath = Yii::getAlias('@yii/redactor/assets');
    }

}