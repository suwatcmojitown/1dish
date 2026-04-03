<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if ($this->session->flashdata('success')): ?>
<div class="alert-success"><?php echo $this->session->flashdata('success'); ?></div>
<?php endif; ?>

<div class="card">
  <div class="table-wrap">
    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>ชื่อ</th>
          <th>Username</th>
          <th>Email</th>
          <th style="text-align:center">Point</th>
          <th style="text-align:center">Comment</th>
          <th>Badge</th>
          <th>สถานะ</th>
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
          <td style="text-align:center">
            <span class="mono" style="color:var(--accent2);font-weight:600"><?php echo $row->point_total; ?></span>
          </td>
          <td style="text-align:center">
            <span class="mono"><?php echo $row->comment_count; ?></span>
          </td>
          <td>—</td>
          <td>
            <?php if ($row->status == 'banned'): ?>
            <span class="badge badge-red">banned</span>
            <?php else: ?>
            <span class="badge badge-green">active</span>
            <?php endif; ?>
          </td>
          <td style="text-align:center">
            <div class="action-row" style="justify-content:center">
              <a href="<?php echo base_url('cms/member/edit/' . $row->user_id); ?>" class="icon-btn" title="แก้ไข">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
              </a>
              <?php if ($row->status == 'active'): ?>
              <button class="icon-btn danger" title="ban" onclick="toggleBan(<?php echo $row->user_id; ?>,'banned',this)">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"/></svg>
              </button>
              <?php else: ?>
              <button class="icon-btn" title="unban" style="color:var(--success)" onclick="toggleBan(<?php echo $row->user_id; ?>,'active',this)">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
              </button>
              <?php endif; ?>
            </div>
          </td>
        </tr>
        <?php endforeach; else: ?>
        <tr><td colspan="9" style="text-align:center;color:var(--muted);padding:32px">ไม่พบสมาชิก</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<script>
function toggleBan(user_id, status, btn) {
    var msg = status == 'banned' ? 'ต้องการ ban สมาชิกนี้?' : 'ต้องการ unban สมาชิกนี้?';
    if (!confirm(msg)) return;
    $.ajax({
        type: 'POST',
        url:  '<?php echo base_url('cms/member/ban'); ?>',
        data: { user_id: user_id, status: status },
        success: function() { location.reload(); }
    });
}
</script>
