<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>1Dish CMS - Login</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;500;600&family=IBM+Plex+Mono:wght@400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/cms.css">
</head>
<body>

<div class="login-page">
  <div class="login-card">

    <div class="login-logo">
      <div class="logo-mark">RC</div>
      <div>
        <div class="logo-text">Rayong Curator</div>
        <div class="logo-sub">CMS Admin</div>
      </div>
    </div>

    <?php if ($this->session->flashdata('error')): ?>
    <div class="alert-error">
      <?php echo $this->session->flashdata('error'); ?>
    </div>
    <?php endif; ?>

    <form action="<?php echo base_url('cms/login/submit'); ?>" method="POST">
      <div class="form-group">
        <label>ชื่อผู้ใช้</label>
        <input type="text" name="username" placeholder="กรอก username" autocomplete="username" required>
      </div>
      <div class="form-group">
        <label>รหัสผ่าน</label>
        <input type="password" name="password" placeholder="กรอกรหัสผ่าน" autocomplete="current-password" required>
      </div>
      <button type="submit" class="btn-login">เข้าสู่ระบบ</button>
    </form>

  </div>
</div>

</body>
</html>
