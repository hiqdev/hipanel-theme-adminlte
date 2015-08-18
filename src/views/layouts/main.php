<?php

/**
 * Theme main layout.
 *
 * @var frontend\components\View View
 * @var string                   Content
 */
use hipanel\widgets\Alert;
use Yii;
use yii\helpers\Html;
use yii\helpers\JsonHelper;
use yii\widgets\Breadcrumbs;

// Collapse Side bar
$this->registerJs(<<<'JS'
$(".sidebar-toggle").on("click", function() {
    var collapsed_sidebar = $('body').hasClass('sidebar-collapse') ? 1 : 0;
    $.post( "/thememanager/settings/collapsed-sidebar", {collapsed_sidebar: collapsed_sidebar});
});
JS
);
?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <?= $this->render('//layouts/head') ?>
</head>
<body class="sidebar-mini <?= $this->bodyClasses ?>">
<?php $this->beginBody(); ?>
<!-- Site wrapper -->
<div class="wrapper">

    <!-- header logo: style can be found in header.less -->
    <header class="main-header">
        <a href="<?= Yii::$app->homeUrl ?>" class="logo">
            <span class="logo-mini">&nbsp;</span>
            <span class="logo-lg">&nbsp;</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <div class="navbar-custom-menu">
                <?= $this->render('navbar-custom-menu'); ?>
            </div>
        </nav>
    </header>

    <!-- =============================================== -->

    <!-- Left side column. contains the sidebar -->

    <?= $this->render('sidebar'); ?>

    <!-- =============================================== -->

    <!-- Right side column. Contains the navbar and content of the page -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <?= $this->title ?>
                <?php if (isset($this->subtitle)) : ?>
                    <small><?= $this->subtitle ?></small>
                <?php endif; ?>
            </h1>
            <?= Breadcrumbs::widget([
                'homeLink' => [
                    'label' => '<i class="fa fa-dashboard"></i> ' . Yii::t('app', 'Home'),
                    'url'   => '/',
                ],
                'encodeLabels' => false,
                'tag'          => 'ol',
                'links'        => $this->breadcrumbs->getItemsArray(),
            ]) ?>
        </section>

        <!-- Main content -->
        <section class="content container-fluid"><div class="row"><div class="col-md-12">
            <?= Alert::widget(); ?>
            <?= $content ?>
        </div></div></section>
    </div><!-- /.content-wrapper -->

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <? $version = Yii::$app->extensions['hiqdev/hipanel-core']['version'] ?>
            <? if ($version=='9999999-dev') {
                    $v = file_get_contents(Yii::getAlias('@hipanel/../.git/refs/heads/master'));
                    $version = $v ? substr($v, 0, 7) : $version;
            } ?>
            Powered by <a href="https://hipanel.com/">HiPanel</a> version <?= $version ?>
        </div>
        <strong>Copyright &copy; 2014-2015 <?= Html::a(Yii::$app->params['orgName'], Yii::$app->params['orgUrl']); ?>.</strong> All rights reserved.
    </footer>
</div><!-- ./wrapper -->
<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>
