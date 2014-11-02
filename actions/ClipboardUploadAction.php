<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace yii\redactor\actions;

use Yii;
use yii\web\HttpException;

/**
 * @author Nghia Nguyen <yiidevelop@hotmail.com>
 * @since 2.0
 */
class ClipboardUploadAction extends \yii\base\Action
{
    private $_contentType;
    private $_data;
    private $_filename;

    public function init()
    {
        if (!Yii::$app->request->isAjax) {
            throw new HttpException(403, 'This action allow only ajaxRequest');
        }
        $this->_contentType = Yii::$app->request->post('contentType');
        $this->_data = Yii::$app->request->post('data');
    }

    public function run()
    {
        if ($this->_contentType && $this->_data) {
            if (file_put_contents(Yii::$app->controller->module->getFilePath($this->fileName), base64_decode($this->_data))) {
                return [
                    'filelink' => Yii::$app->controller->module->getUrl($this->fileName),
                    'filename' => $this->fileName
                ];
            } else {
                return ['error' => 'Unable to save file'];
            }
        }
    }

    protected function getExtensionName()
    {
        $mimeTypes = require(Yii::getAlias('@yii/helpers/mimeTypes.php'));
        return (array_search($this->_contentType, $mimeTypes) !== false) ? array_search($this->_contentType, $mimeTypes) : 'png';
    }

    protected function getFileName()
    {
        if (!$this->_filename) {
            $this->_filename = substr(uniqid(md5(rand()), true), 0, 10) . '.' . $this->getExtensionName();
        }
        return $this->_filename;
    }
}