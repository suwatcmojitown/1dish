<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if ($this->session->flashdata('success')): ?>
<div class="alert-success"><?php echo $this->session->flashdata('success'); ?></div>
<?php endif; ?>
<?php if ($this->session->flashdata('error')): ?>
<div class="alert-error"><?php echo $this->session->flashdata('error'); ?></div>
<?php endif; ?>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:18px;align-items:start">

  <!-- ข้อมูลส่วนตัว -->
  <div>
    <form method="POST" action="<?php echo base_url('cms/member/update'); ?>">
      <input type="hidden" name="user_id" value="<?php echo $member->user_id; ?>">
      <div class="form-section">
        <div class="form-section-title">ข้อมูลส่วนตัว</div>
        <div class="form-group" style="margin-bottom:12px">
          <label>ชื่อที่แสดง</label>
          <input type="text" name="display_name" value="<?php echo $member->display_name; ?>">
        </div>
        <div class="form-group" style="margin-bottom:12px">
          <label>Email</label>
          <input type="text" name="email" value="<?php echo $member->email; ?>">
        </div>
        <div class="form-group" style="margin-bottom:0">
          <label>Username</label>
          <input type="text" value="<?php echo $member->username; ?>" disabled style="opacity:.5">
        </div>
      </div>
      <div style="display:flex;justify-content:flex-end;gap:8px;margin-top:12px">
        <a href="<?php echo base_url('cms/member'); ?>" class="btn btn-ghost">ยกเลิก</a>
        <button type="submit" class="btn btn-primary">บันทึก</button>
      </div>
    </form>
  </div>

  <!-- Activity + Reset Password -->
  <div style="display:flex;flex-direction:column;gap:18px">

    <!-- Activity -->
    <div class="form-section">
      <div class="form-section-title">Activity</div>
      <div style="display:flex;gap:24px">
        <div>
          <div class="influ-stat-val"><?php echo $member->point_total; ?></div>
          <div class="influ-stat-lbl">Point</div>
        </div>
        <div>
          <div class="influ-stat-val"><?php echo $commentCount; ?></div>
          <div class="influ-stat-lbl">Comment</div>
        </div>
      </div>
      <?php if ($badgeList): ?>
      <div style="margin-top:12px;display:flex;flex-wrap:wrap;gap:6px">
        <?php foreach ($badgeList as $b): ?>
        <span class="badge badge-teal"><?php echo $b->name; ?></span>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>
    </div>

    <!-- Reset Password -->
    <form method="POST" action="<?php echo base_url('cms/member/reset_password'); ?>">
      <input type="hidden" name="user_id" value="<?php echo $member->user_id; ?>">
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

  </div>
</div>
