<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>1Dish CMS</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;500;600&family=IBM+Plex+Mono:wght@400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url(); ?>froala_editor/css/froala_editor.pkgd.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>froala_editor/css/froala_style.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/cms.css">
<style>
  a, button, [onclick],
  input[type="submit"], input[type="button"], input[type="checkbox"], input[type="radio"],
  select, label[for], [role="button"] { cursor: pointer !important; }
</style>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="<?php echo base_url(); ?>froala_editor/js/froala_editor.pkgd.min.js"></script>
<script>
  var FROALA_KEY = '2J1B10dA5B4F4C3A3C3I3C-22VKOG1FGULVKHXDXNDXc2a1Kd1SNdF3H3A8B5D4A3C3E3B2A13==';
</script>
</head>
<body>
<?php echo $header; ?>
<div class="wrapper">
    <?php echo $sidebar; ?>
    <main class="main">
        <?php echo $content; ?>
    </main>
</div>
<?php echo $footer; ?>
<script src="<?php echo base_url(); ?>assets/js/cms.js"></script>
</body>
</html>
