<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace yii\redactor\controllers;

/**
 * @author Nghia Nguyen <yiidevelop@hotmail.com>
 * @since 2.0
 */
class UploadController extends \yii\web\Controller
{

    public function actions()
    {
        return array(
            'file' => array(
                'class' => \yii\redactor\actions\FileUploadAction::className()
            ),
            'image' => array(
                'class' => \yii\redactor\actions\ImageUploadAction::className()
            ),
            'imagejson' => array(
                'class' => \yii\redactor\actions\ImageGetJsonAction::className()
            ),
            'clipboard' => array(
                'class' => \yii\redactor\actions\ClipboardUploadAction::className()
            )
        );
    }

}