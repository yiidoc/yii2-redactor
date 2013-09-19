<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace yii\redactor\actions;
use Yii;
use yii\helpers\FileHelper;
use yii\helpers\Json;
use yii\web\HttpException;

/**
 * @author Nghia Nguyen <yiidevelop@hotmail.com>
 * @since 2.0
 */
class ClipboardUploadAction extends \yii\base\Action
{
    public $uploadDir = '@webroot/uploads';
    private $_contentType;
    private $_data;
    private $_filename;

    public function init()
    {
        if (!Yii::$app->request->isAjax) {
            throw new HttpException(403, 'This action allow only ajaxRequest');
        }
        $this->_contentType = Yii::$app->request->getPost('contentType');
        $this->_data = Yii::$app->request->getPost('data');
    }

    public function run()
    {
        if ($this->_contentType && $this->_data) {
            if (file_put_contents($this->getPath(), base64_decode($this->_data))) {
                echo Json::encode(array('filelink' => $this->getUrl(), 'filename' => $this->getFilename()));
            }
        }
    }

    protected function getExtensionName()
    {
        $mimeTypes = require (Yii::getAlias('@yii/helpers/mimeTypes.php'));
        return (array_search($this->_contentType, $mimeTypes) !== false) ? array_search($this->_contentType, $mimeTypes) : 'png';
    }

    protected function getFilename()
    {
        if (!$this->_filename) {
            $this->_filename = substr(uniqid(md5(rand()), true), 0, 10) . '.' . $this->getExtensionName();
        }
        return $this->_filename;
    }

    protected function getPath()
    {
        if (Yii::$app->user->isGuest) {
            $path = Yii::getAlias($this->uploadDir) . DIRECTORY_SEPARATOR . 'guest';
        } else {
            $path = Yii::getAlias($this->uploadDir) . DIRECTORY_SEPARATOR . Yii::$app->user->id;
        }
        FileHelper::createDirectory($path);
        return $path . DIRECTORY_SEPARATOR . $this->getFilename();
    }

    protected function getUrl()
    {
        return str_replace(DIRECTORY_SEPARATOR, '/', str_replace(Yii::getAlias('@webroot'), '', $this->getPath()));
    }

}