<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if ($this->session->flashdata('success')): ?>
<div class="alert-success"><?php echo $this->session->flashdata('success'); ?></div>
<?php endif; ?>

<div class="toolbar" style="margin-bottom:16px">
  <a href="<?php echo base_url('cms/user/add'); ?>" class="btn btn-primary">+ เพิ่มทีมงาน</a>
</div>

<div class="card">
  <div class="table-wrap">
    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>ชื่อ</th>
          <th>Username</th>
          <th>Email</th>
          <th>Role</th>
          <th>วันที่สร้าง</th>
          <th style="text-align:center">action</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($list): foreach ($list as $row): ?>
        <tr>
          <td class="mono"><?php echo $row->user_id; ?></td>
          <td><div style="font-weight:500"><?php echo $row->display_name; ?></div></td>
          <td class="mono"><?php echo $row->username; ?></td>
          <td style="font-size:12px;color:var(--muted)"><?php echo $row->email; ?></td>
          <td>
            <?php
            $roleClass = array(
                'super_admin' => 'badge-red',
                'admin'       => 'badge-blue',
                'influencer'  => 'badge-teal',
            );
            $cls = isset($roleClass[$row->role]) ? $roleClass[$row->role] : 'badge-gray';
            ?>
            <span class="badge <?php echo $cls; ?>"><?php echo $row->role; ?></span>
          </td>
          <td class="mono" style="font-size:12px"><?php echo format_datetime($row->created_at); ?></td>
          <td style="text-align:center">
            <a href="<?php echo base_url('cms/user/edit/' . $row->user_id); ?>" class="icon-btn" title="แก้ไข">
              <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
            </a>
          </td>
        </tr>
        <?php endforeach; else: ?>
        <tr><td colspan="7" style="text-align:center;color:var(--muted);padding:32px">ไม่พบทีมงาน</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
