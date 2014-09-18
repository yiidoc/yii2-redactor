<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace yii\redactor\widgets;

use Yii;
use yii\widgets\InputWidget;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\JsExpression;

/**
 * @author Nghia Nguyen <yiidevelop@hotmail.com>
 * @since 2.0
 */
class Redactor extends InputWidget {

    public $options = [];
    public $clientOptions = [
        'imageGetJson' => '/redactor/upload/imagejson',
        'imageUpload' => '/redactor/upload/image',
        'clipboardUploadUrl' => '/redactor/upload/clipboard',
        'fileUpload' => '/redactor/upload/file'
    ];

    public function init()
    {
        if ($this->hasModel()) {
            $this->options['id'] = Html::getInputId($this->model, $this->attribute);
        } else {
            $this->options['id'] = $this->getId();
        }
        if (isset($this->clientOptions['imageUpload'])) {
            $this->clientOptions['imageUploadErrorCallback'] = new JsExpression("function(json){alert(json.error);}");
        }
        if (isset($this->clientOptions['fileUpload'])) {
            $this->clientOptions['fileUploadErrorCallback'] = new JsExpression("function(json){alert(json.error);}");
        }
        $this->registerBundles();
        $this->registerScript();
    }

    public function run()
    {
        if ($this->hasModel()) {
            echo Html::activeTextarea($this->model, $this->attribute, $this->options);
        } else {
            echo Html::textarea($this->name, $this->value, $this->options);
        }
    }

    public function registerBundles()
    {
        $bundle = RedactorAsset::register($this->getView());
        $this->registerRegional($bundle);
        $this->registerPlugins($bundle);
    }

    /**
     * 
     * @param RedactorAsset $bundle 
     */
    public function registerRegional($bundle)
    {
        if (isset($this->clientOptions['lang'])) {
            $langAsset = 'lang/' . $this->clientOptions['lang'] . '.js';
            if (file_exists($bundle->sourcePath . '/' . $langAsset)) {
                $bundle->js[] = $langAsset;
            }
        }
        return $bundle;
    }

    /**
     * 
     * @param RedactorAsset $bundle 
     */
    public function registerPlugins($bundle)
    {
        if (isset($this->clientOptions['plugins']) && count($this->clientOptions['plugins'])) {
            foreach ($this->clientOptions['plugins'] as $plugin) {
                $js = 'plugins/' . $plugin . '/' . $plugin . '.js';
                if (file_exists(Yii::getAlias($bundle->sourcePath . DIRECTORY_SEPARATOR . $js))) {
                    $bundle->js[] = $js;
                }
                $css = 'plugins/' . $plugin . '/' . $plugin . '.css';
                if (file_exists(Yii::getAlias($bundle->sourcePath . '/' . $css))) {
                    $bundle->css[] = $css;
                }
            }
        }
        return $bundle;
    }

    public function registerScript()
    {
        $clientOptions = (count($this->clientOptions)) ? Json::encode($this->clientOptions) : '';
        $this->getView()->registerJs("jQuery('#{$this->options['id']}').redactor({$clientOptions});");
    }

}
