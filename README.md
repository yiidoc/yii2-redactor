yii2-redactor
=============
Extension redactor for Yii2 Framework.

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist yiidoc/yii2-redactor "*"
```

or add

```json update
"yiidoc/yii2-redactor": "*"
```

to the `require` section of your composer.json.

Configure
-----------------

Add to config file (config/web.php or common\config\main.php) 

```
'modules' => [
        'redactor' => 'yii\redactor\RedactorModule',
    ],
```
or if you want to change the upload directory.
to path/to/uploadfolder
default value @webroot/uploads

```
'modules' => [
        'redactor' => [
            'class'=>'yii\redactor\RedactorModule',
            'uploadDir'=>'@webroot/path/to/uploadfolder'
        ],
    ],
```

note: You need to create uploads folder and chmod and set security for folder upload
reference: [Protect Your Uploads Folder with .htaccess](http://tomolivercv.wordpress.com/2011/07/24/protect-your-uploads-folder-with-htaccess/),
[How to Setup Secure Media Uploads](http://digwp.com/2012/09/secure-media-uploads/)

Config view/form

```
<?=$form->field($model, 'body')->widget(\yii\redactor\Redactor::className())?>
```
or config advanced redactor reference [Docs](http://imperavi.com/redactor/docs/)
```
<?=$form->field($model, 'body')->widget(\yii\redactor\Redactor::className(),[
    'clientOptions'=>[
        'imageGetJson' => '/redactor/upload/imagejson',
        'imageUpload' => '/redactor/upload/image',
        'clipboardUploadUrl' => '/redactor/upload/clipboard',
        'fileUpload' => '/redactor/upload/file',
        'lang'=>'zh_cn',
        'plugins'=>['clips','fontcolor']
    ]
])?>
```

Bummer! i was tested on my project but not have many time to write document on file and usage.
If you have problem please create a [issue](https://github.com/yiidoc/yii2-redactor/issues)

Thanks!