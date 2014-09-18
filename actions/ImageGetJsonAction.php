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
use yii\helpers\Json;

/**
 * @author Nghia Nguyen <yiidevelop@hotmail.com>
 * @since 2.0
 */
class ImageGetJsonAction extends \yii\base\Action {

    private $_sourcePath;

    public function init()
    {
        if (!Yii::$app->request->isAjax) {
            throw new HttpException(403, 'This action allow only ajaxRequest');
        }
        $this->_sourcePath = $this->controller->module->uploadDir;
    }

    public function run()
    {
        $files = FileHelper::findFiles($this->getPath(), ['recursive' => true, 'only' => ['*.jpg', '*.jpeg', '*.jpe', '*.png', '*.gif']]);
        if (is_array($files) && count($files)) {
            $result = [];
            foreach ($files as $file) {
                $url = $this->getUrl($file);
                $result[] = ['thumb' => $url, 'image' => $url];
            }
            echo Json::encode($result);
        }
    }

    protected function getPath()
    {
        if (Yii::$app->user->isGuest) {
            return Yii::getAlias($this->_sourcePath) . DIRECTORY_SEPARATOR . 'guest';
        } else {
            return Yii::getAlias($this->_sourcePath) . DIRECTORY_SEPARATOR . Yii::$app->user->id;
        }
    }

    public function getUrl($path)
    {
        return str_replace(DIRECTORY_SEPARATOR, '/', str_replace(Yii::getAlias('@webroot'), '', $path));
    }

}
