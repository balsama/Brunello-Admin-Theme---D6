<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $language->language ?>" lang="<?php echo $language->language ?>" dir="<?php echo $language->dir ?>">

<head>
  <title><?php print $head_title; ?></title>

  <?php print $head; ?>
  <?php print $styles; ?>
  <!--[if lte IE 8]>
    <style type="text/css" media="all">@import "<?php echo $base_path . path_to_theme() ?>/ie.css";</style>
  <![endif]-->
  <!--[if lte IE 6]>
    <style type="text/css" media="all">@import "<?php echo $base_path . path_to_theme() ?>/ie6.css";</style>
  <![endif]-->
  <?php print $scripts; ?>

</head>

<body class="<?php print $body_classes; ?>">

  <div id="skip-link">
    <a href="#main-content"><?php print t('Skip to main content'); ?></a>
  </div>

  <div class="element-invisible"><a id="main-content"></a></div>

  <div id="branding" class="clearfix">

    <?php if (!empty($breadcrumb)): ?><?php print $breadcrumb; ?><?php endif; ?>

    <?php if (!empty($title)): ?>
      <h1 class="page-title"><?php print $title; ?></h1>
    <?php endif; ?>

    <?php if (!empty($primary_local_tasks)): ?><ul class="tabs primary"><?php print $primary_local_tasks; ?></ul><?php endif; ?>

  </div>

  <div id="page">
    <?php if (!empty($secondary_local_tasks)): ?><ul class="tabs secondary"><?php print $secondary_local_tasks; ?></ul><?php endif; ?>

    <div id="content" class="clearfix">

      <?php if (!empty($messages)): ?>
        <div id="console" class="clearfix"><?php print $messages; ?></div>
      <?php endif; ?>

      <?php if (!empty($help)): ?>
        <div id="help">
          <?php print $help; ?>
        </div>
      <?php endif; ?>

      <?php if (!empty($action_links)): ?><ul class="action-links"><?php print drupal_render($action_links); ?></ul><?php endif; ?>

      <div id="outer-box" style="width: 1200px;">
        <div id="sidebar-box" style="float: left; width: 200px; margin-right: 10px;">
          <?php print $sidebar; ?>
        </div>
        <div id="content-box" style="float: right; width: 980px;">
          <?php print $content; ?>
        </div>
        <div style="clear: both;"
      </div>

    </div>

    <div id="footer">
      <?php if (!empty($feed_icons)): ?><?php print $feed_icons; ?><?php endif; ?>
    </div>

  </div>

  <?php print $closure; ?>
  <script type="text/javascript" >
  $(document).ready(function() {
    //Add IDs of text areas for rich text editor
    $("#edit-field-copy-0-value").markItUp(mySettings);
  });
  </script>
</body>
</html>
