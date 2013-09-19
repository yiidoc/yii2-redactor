<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace yii\redactor\models;

use yii\web\UploadedFile;

/**
 * Description of RedactorModel
 *
 * @author Nghia
 */
class RedactorModel extends yii\base\Model
{

    public $file;
    public $uploadDir = '@webroot/upload';
    public $fileName;
    public $fileLink;

    public function rules()
    {
        return array(
            array('file', 'required'),
            array('file', 'file')
        );
    }

    public function beforeValidate()
    {
        $this->file = UploadedFile::getInstance($this, 'file');
    }

    public function upload()
    {
        
        $this->file->saveAs($file);
    }

}