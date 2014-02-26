<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace yii\redactor\models;

/**
 * @author Nghia Nguyen <yiidevelop@hotmail.com>
 * @since 2.0
 */
class ImageUploadModel extends FileUploadModel
{

    public function rules()
    {
        return [
            ['uploadDir', 'required'],
            ['file', 'file', 'types' => 'jpg,png,gif,bmp,jpe,jpeg,jpeg']
        ];
    }

}