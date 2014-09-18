<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace yii\redactor\actions;

use Yii;
use yii\redactor\models\ImageUploadModel;
use yii\helpers\Json;

/**
 * @author Nghia Nguyen <yiidevelop@hotmail.com>
 * @since 2.0
 */
class ImageUploadAction extends \yii\base\Action {

    function run()
    {
        if (isset($_FILES)) {
            $model = new ImageUploadModel(['uploadDir' => $this->controller->module->uploadDir]);
            if ($model->upload()) {
                echo $model->toJson();
            } else {
                if ($model->firstErrors) {
                    echo Json::encode(['error' => $model->firstErrors[0]]);
                }
            }
        }
    }

}
