<?php
/**
 * Created by PhpStorm.
 * User: vitalii
 * Date: 20.12.18
 * Time: 10:50
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<div class="article-form">

    <?php $form = ActiveForm::begin() ?>

    <?= Html::dropDownList('tags', $selectedTags, $tags, ['class'=>'form-cntrol', 'multiple'=>true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end() ?>

</div>