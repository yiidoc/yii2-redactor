<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace yii\redactor\actions;

use Yii;
use yii\web\HttpException;
use yii\helpers\FileHelper;

/**
 * @author Nghia Nguyen <yiidevelop@hotmail.com>
 * @since 2.0
 */
class ImageGetJsonAction extends \yii\base\Action
{
    public function init()
    {
        if (!Yii::$app->request->isAjax) {
            throw new HttpException(403, 'This action allow only ajaxRequest');
        }
    }

    public function run()
    {
        $filesPath = FileHelper::findFiles(Yii::$app->controller->module->getSaveDir(), [
            'recursive' => true,
            'only' => ['*.jpg', '*.jpeg', '*.jpe', '*.png', '*.gif']
        ]);
        if (is_array($filesPath) && count($filesPath)) {
            $result = [];
            foreach ($filesPath as $filePath) {
                $url = Yii::$app->controller->module->getUrl(pathinfo($filePath, PATHINFO_BASENAME));
                $result[] = ['thumb' => $url, 'image' => $url];
            }
            return $result;
        }
    }

}
