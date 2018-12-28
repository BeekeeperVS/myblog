<h4>Comments</h4>
<?php use yii\widgets\ActiveForm;

if($comments):?>
    <?php foreach ($comments as $comment):?>
        <div class="bottom-comment"><!--bottom comment-->
            <div class="comment-img">
                <img class="img-circle" src="<?= $comment->user->image; ?>" style="width: 50px" alt="">
            </div>
            <div class="comment-text">
                <a href="#" class="replay btn pull-right">Replay</a>
                <h5><?= $comment->user->name; ?></h5>
                <p class="comment-date">
                    <?= $comment->date ?>
                </p>
                <p class="para">
                    <?= $comment->text; ?>
                </p>
            </div>


        </div>
    <?php endforeach; ?>
<?php endif;?>
<div class="leave-comment"><!--leave comment-->
    <h4>Leave a reply</h4>
    <?php if(Yii::$app->getSession()->getFlash('comment')):?>
        <div class="alert alert-success" role="alert">
            <?= Yii::$app->getSession()->getFlash('comment');?>
        </div>
    <?php endif;?>
    <?php if(!(Yii::$app->user->isGuest)):?>
        <?php $form=ActiveForm::begin([
                'action'=>['site/comment', 'id'=>$article->id],
                'options'=>['class'=>'form-horizontal contact-form', 'rule'=>'form']
            ]
        ); ?>
        <?= $form->field($model, 'comment')->textarea([
            'class'=>'form-control',
            'placeholder'=>'Write Massage',

        ])->label(false)?>

        <button type='submit' class="btn send-btn">Post Comment</button>

        <?php ActiveForm::end();?>
    <?php else:?>
        <div class="alert alert-warning" role="alert">
            <p>You must register to send a comment</p>
        </div>
    <?php endif;?>
</div>