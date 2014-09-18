<?php

namespace yii\redactor\actions;

use Yii;
use yii\redactor\models\FileUploadModel;
use yii\helpers\Json;

/**
 * @author Nghia Nguyen <yiidevelop@hotmail.com>
 * @since 2.0
 */
class FileUploadAction extends \yii\base\Action {

    function run()
    {
        if (isset($_FILES)) {
            $model = new FileUploadModel(['uploadDir' => $this->controller->module->uploadDir]);
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
