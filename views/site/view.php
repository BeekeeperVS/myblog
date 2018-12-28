<?php

use yii\helpers\Html;
use yii\helpers\Url;
    use yii\widgets\ActiveForm;
?>
<?php
$article->viewedCounter();
?>
<!--main content start-->
<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <article class="post">
                    <div class="post-thumb">
                        <a href="blog.html"><img src="<?= $article->getImage(); ?>" alt=""></a>
                    </div>
                    <div class="post-content">
                        <header class="entry-header text-center text-uppercase">
                            <h6><a href="<?= Url::toRoute(['site/category', 'id'=>$article->category->id]); ?>"><?= $article->category->title; ?></a></h6>

                            <h1 class="entry-title"><a href="<?= Url::toRoute(['site/view', 'id'=>$article->id]); ?>"><?= $article->title; ?></a></h1>


                        </header>
                        <div class="entry-content">
                            <p><?= $article->content; ?></p>
                        </div>
                        <div class="decoration">
                            <?php foreach ($article->tags as $tag): ?>
                            <a href="#" class="btn btn-default"><?= $tag->title;?></a>
                            <?php endforeach;?>
                        </div>

                        <div class="social-share">
							<span
                                class="social-share-title pull-left text-capitalize">By <?= $article->author->name; ?> On <?= $article->getDate(); ?></span>
                            <ul class="text-center pull-right">
                                <li><a class="s-facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a class="s-twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a class="s-google-plus" href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li><a class="s-linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a class="s-instagram" href="#"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </article>
            <?= $this->render('/partitions/comment', [
                'comments'=>$comments,
                'article'=>$article,
                'model'=>$model,
            ]);?>
            </div>

            <?= $this->render('/partitions/sidebar', [
                'popular'=>$popular,
                'recent'=>$recent,
                'categories'=>$categories,
            ]); ?>
        </div>
    </div>
</div>
<!-- end main content-->