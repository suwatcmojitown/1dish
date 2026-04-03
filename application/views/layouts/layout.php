<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html class="light" lang="th">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title><?php echo isset($page_title) ? $page_title . ' — Rayong Curator' : 'Rayong Curator'; ?></title>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/tailwind.css"/>
<link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600;700;800&family=Sarabun:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Be+Vietnam+Pro:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<style>
  .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
  .editorial-shadow { box-shadow: 0 8px 24px rgba(25,28,29,0.06); }
  .glass-overlay { backdrop-filter: blur(20px); background: rgba(248,249,250,0.7); }
  .no-scrollbar::-webkit-scrollbar { display: none; }
  .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
  body { font-family: 'Kanit', sans-serif; }

  /* Cursor pointer ทุกอย่างที่ click ได้ */
  a, button, [onclick],
  input[type="submit"], input[type="button"], input[type="checkbox"], input[type="radio"],
  select, label[for],
  [role="button"], [role="link"], [role="tab"],
  .cursor-pointer { cursor: pointer !important; }
</style>
</head>
<body class="bg-surface text-on-surface">
<?php echo $header; ?>
<main>
  <?php echo $content; ?>
</main>
<?php echo $footer; ?>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</body>
</html>
