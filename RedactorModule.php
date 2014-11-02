<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace yii\redactor;

use Yii;
use yii\helpers\FileHelper;

/**
 * @author Nghia Nguyen <yiidevelop@hotmail.com>
 * @since 2.0
 */
class RedactorModule extends \yii\base\Module
{

    public $controllerNamespace = 'yii\redactor\controllers';
    public $defaultRoute = 'upload';
    public $uploadDir = '@webroot/uploads';
    public $uploadUrl = '/uploads';

    public function getOwnerPath()
    {
        return Yii::$app->user->isGuest ? 'guest' : Yii::$app->user->id;
    }

    public function getSaveDir()
    {
        if (preg_match('/^\@/', $this->uploadDir)) {
            $path = Yii::getAlias($this->uploadDir);
        } else {
            $path = $this->uploadDir;
        }
        if (FileHelper::createDirectory($path . DIRECTORY_SEPARATOR . $this->getOwnerPath())) {
            return $path . DIRECTORY_SEPARATOR . $this->getOwnerPath();
        }
        return '';
    }

    public function getFilePath($fileName)
    {
        return $this->getSaveDir() . DIRECTORY_SEPARATOR . $fileName;
    }

    public function getUrl($fileName)
    {
        return $this->uploadUrl . '/' . $this->getOwnerPath() . '/' . $fileName;
    }
}
