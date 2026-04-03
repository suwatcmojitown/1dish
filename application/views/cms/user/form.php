<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $is_edit = isset($user) && $user; ?>

<?php if ($this->session->flashdata('success')): ?>
<div class="alert-success"><?php echo $this->session->flashdata('success'); ?></div>
<?php endif; ?>
<?php if ($this->session->flashdata('error')): ?>
<div class="alert-error"><?php echo $this->session->flashdata('error'); ?></div>
<?php endif; ?>

<div style="display:grid;grid-template-columns:1fr <?php echo $is_edit ? '1fr' : ''; ?>;gap:18px;align-items:start">

  <!-- ข้อมูล -->
  <form method="POST" action="<?php echo base_url($is_edit ? 'cms/user/update' : 'cms/user/save'); ?>">
    <?php if ($is_edit): ?>
    <input type="hidden" name="user_id" value="<?php echo $user->user_id; ?>">
    <?php endif; ?>
    <div class="form-section">
      <div class="form-section-title">ข้อมูลทีมงาน</div>
      <div class="form-group" style="margin-bottom:12px">
        <label>ชื่อที่แสดง</label>
        <input type="text" name="display_name" value="<?php echo $is_edit ? $user->display_name : ''; ?>" required>
      </div>
      <div class="form-group" style="margin-bottom:12px">
        <label>Username</label>
        <input type="text" name="username" value="<?php echo $is_edit ? $user->username : ''; ?>" required>
      </div>
      <div class="form-group" style="margin-bottom:12px">
        <label>Email</label>
        <input type="text" name="email" value="<?php echo $is_edit ? $user->email : ''; ?>">
      </div>
      <?php if (!$is_edit): ?>
      <div class="form-group" style="margin-bottom:12px">
        <label>Password</label>
        <input type="password" name="password" required>
      </div>
      <?php endif; ?>
      <div class="form-group" style="margin-bottom:0">
        <label>Role</label>
        <select name="role" required>
          <option value="admin"       <?php echo ($is_edit && $user->role == 'admin')       ? 'selected' : ''; ?>>admin</option>
          <option value="super_admin" <?php echo ($is_edit && $user->role == 'super_admin') ? 'selected' : ''; ?>>super_admin</option>
          <option value="influencer"  <?php echo ($is_edit && $user->role == 'influencer')  ? 'selected' : ''; ?>>influencer</option>
        </select>
      </div>
    </div>
    <div style="display:flex;justify-content:flex-end;gap:8px;margin-top:12px">
      <a href="<?php echo base_url('cms/user'); ?>" class="btn btn-ghost">ยกเลิก</a>
      <button type="submit" class="btn btn-primary">บันทึก</button>
    </div>
  </form>

  <!-- Reset Password (edit only) -->
  <?php if ($is_edit): ?>
  <form method="POST" action="<?php echo base_url('cms/user/reset_password'); ?>">
    <input type="hidden" name="user_id" value="<?php echo $user->user_id; ?>">
    <div class="form-section">
      <div class="form-section-title">Reset Password</div>
      <div class="form-group" style="margin-bottom:0">
        <label>รหัสผ่านใหม่</label>
        <div style="display:flex;gap:8px">
          <input type="text" name="new_password" placeholder="กรอกรหัสผ่านใหม่" style="flex:1">
          <button type="submit" class="btn btn-warn-soft">Reset</button>
        </div>
      </div>
    </div>
  </form>
  <?php endif; ?>

</div>
