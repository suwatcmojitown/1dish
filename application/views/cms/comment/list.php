<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if ($this->session->flashdata('success')): ?>
<div class="alert-success"><?php echo $this->session->flashdata('success'); ?></div>
<?php endif; ?>

<?php if ($place_id): ?>
<div style="margin-bottom:16px">
  <a href="<?php echo base_url('cms/comment'); ?>" class="btn btn-ghost btn-sm">← ดู comment ทั้งหมด</a>
</div>
<?php endif; ?>

<!-- Filter tabs -->
<div class="filter-bar" style="margin-bottom:18px">
  <?php
  $tabs = array(
    ''         => array('label' => 'ทั้งหมด',    'count' => $total_all,      'badge' => 'badge-gray'),
    'pending'  => array('label' => 'รอ approve', 'count' => $total_pending,  'badge' => 'badge-warn'),
    'approved' => array('label' => 'Approved',   'count' => $total_approved, 'badge' => 'badge-green'),
    'rejected' => array('label' => 'Rejected',   'count' => $total_rejected, 'badge' => 'badge-red'),
  );
  foreach ($tabs as $val => $tab):
    $url = $val == ''
      ? base_url('cms/comment') . ($place_id ? '?place_id='.$place_id : '')
      : base_url('cms/comment') . '?status='.$val . ($place_id ? '&place_id='.$place_id : '');
    $active = $status_sel == $val;
  ?>
  <a href="<?php echo $url; ?>"
     class="filter-tab <?php echo $active ? 'active' : ''; ?>">
    <?php echo $tab['label']; ?>
    <span class="filter-tab-count <?php echo $active ? '' : $tab['badge']; ?>">
      <?php echo $tab['count']; ?>
    </span>
  </a>
  <?php endforeach; ?>
</div>

<div class="card">
  <div class="table-wrap">
    <table>
      <thead>
        <tr>
          <th style="width:60px">ปก</th>
          <th>ร้านค้า / รีวิว</th>
          <th style="width:130px">โดย</th>
          <th>comment</th>
          <th style="white-space:nowrap;width:140px">วันที่</th>
          <th style="width:90px">สถานะ</th>
          <th style="text-align:center;width:80px">action</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($list): foreach ($list as $row): ?>
        <tr>
          <td>
            <div class="place-thumb">
              <?php if (!empty($row->cover_image)): ?>
              <img src="<?php echo base_url($row->cover_image); ?>" style="width:50px;height:40px;object-fit:cover;border-radius:8px;">
              <?php else: echo '&#127829;'; endif; ?>
            </div>
          </td>
          <td>
            <div class="place-name"><?php echo $row->place_name; ?></div>
            <div class="place-meta" style="margin-top:2px"><?php echo $row->review_title; ?></div>
          </td>
          <td>
            <div style="font-weight:500;font-size:13px"><?php echo $row->user_name; ?></div>
            <?php if (!empty($row->badge_name)): ?>
            <span class="badge badge-teal" style="margin-top:3px;font-size:10px"><?php echo $row->badge_name; ?></span>
            <?php elseif ($row->user_role == 'influencer'): ?>
            <span class="badge badge-blue" style="margin-top:3px;font-size:10px">Influencer</span>
            <?php endif; ?>
          </td>
          <td>
            <div class="comment-preview" onclick="showComment(<?php echo $row->comment_id; ?>)">
              <?php echo $row->body; ?>
            </div>
            <?php if (!empty($row->image)): ?>
            <div style="margin-top:4px">
              <img src="<?php echo base_url($row->image); ?>" style="width:36px;height:30px;object-fit:cover;border-radius:4px;border:1px solid var(--border);cursor:pointer" onclick="showComment(<?php echo $row->comment_id; ?>)">
            </div>
            <?php endif; ?>
          </td>
          <td class="mono" style="font-size:12px;white-space:nowrap"><?php echo format_datetime($row->created_at); ?></td>
          <td>
            <?php
            $badge = 'badge-warn'; $label = 'pending';
            if ($row->status == 'approved') { $badge = 'badge-green'; $label = 'approved'; }
            if ($row->status == 'rejected') { $badge = 'badge-red';   $label = 'rejected'; }
            ?>
            <span class="badge <?php echo $badge; ?>"><?php echo $label; ?></span>
          </td>
          <td style="text-align:center">
            <div class="action-row" style="justify-content:center">
              <?php if ($row->status != 'approved'): ?>
              <form method="POST" action="<?php echo base_url('cms/comment/approve'); ?>" style="display:inline">
                <input type="hidden" name="comment_id" value="<?php echo $row->comment_id; ?>">
                <input type="hidden" name="place_id"   value="<?php echo $place_id; ?>">
                <button type="submit" class="icon-btn" title="approve" style="color:var(--success)">
                  <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                </button>
              </form>
              <?php endif; ?>
              <?php if ($row->status != 'rejected'): ?>
              <form method="POST" action="<?php echo base_url('cms/comment/reject'); ?>" style="display:inline">
                <input type="hidden" name="comment_id" value="<?php echo $row->comment_id; ?>">
                <input type="hidden" name="place_id"   value="<?php echo $place_id; ?>">
                <button type="submit" class="icon-btn danger" title="reject">
                  <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
              </form>
              <?php endif; ?>
            </div>
          </td>
        </tr>
        <?php endforeach; else: ?>
        <tr><td colspan="7" style="text-align:center;color:var(--muted);padding:32px">ไม่พบ comment</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<!-- Modal -->
<div id="comment-modal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.45);z-index:999;align-items:center;justify-content:center">
  <div style="background:var(--bg2);border-radius:14px;width:90%;max-width:580px;max-height:82vh;display:flex;flex-direction:column;overflow:hidden;box-shadow:0 8px 32px rgba(0,0,0,.2)">
    <div style="padding:16px 22px;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;flex-shrink:0">
      <div style="font-weight:600;font-size:15px">รายละเอียด comment</div>
      <button onclick="closeModal()" style="background:none;border:none;cursor:pointer;color:var(--muted);font-size:22px;line-height:1;padding:0 4px">&times;</button>
    </div>
    <div id="modal-body" style="padding:22px;overflow-y:auto;flex:1;font-size:14px;line-height:1.7;color:var(--text)"></div>
    <div id="modal-footer" style="padding:14px 22px;border-top:1px solid var(--border);display:flex;justify-content:flex-end;gap:8px;flex-shrink:0"></div>
  </div>
</div>

<script>
var comments = {
  <?php if ($list): foreach ($list as $row): ?>
  <?php echo $row->comment_id; ?>: {
    body:        <?php echo json_encode($row->body); ?>,
    image:       <?php echo json_encode(!empty($row->image) ? base_url($row->image) : ''); ?>,
    user:        <?php echo json_encode($row->user_name); ?>,
    badge:       <?php echo json_encode($row->badge_name ?: ''); ?>,
    role:        <?php echo json_encode($row->user_role); ?>,
    status:      <?php echo json_encode($row->status); ?>,
    comment_id:  <?php echo $row->comment_id; ?>,
    place_id:    <?php echo json_encode($place_id); ?>,
    approve_url: <?php echo json_encode(base_url('cms/comment/approve')); ?>,
    reject_url:  <?php echo json_encode(base_url('cms/comment/reject')); ?>
  },
  <?php endforeach; endif; ?>
};

function showComment(id) {
  var c = comments[id];
  if (!c) return;

  var badge = c.badge
    ? '<span class="badge badge-teal" style="font-size:11px;margin-left:6px">'+c.badge+'</span>'
    : (c.role == 'influencer' ? '<span class="badge badge-blue" style="font-size:11px;margin-left:6px">Influencer</span>' : '');

  var img = c.image
    ? '<div style="margin-top:16px"><img src="'+c.image+'" style="max-width:100%;border-radius:8px;border:1px solid var(--border)"></div>'
    : '';

  document.getElementById('modal-body').innerHTML =
    '<div style="display:flex;align-items:center;gap:6px;margin-bottom:14px;padding-bottom:12px;border-bottom:1px solid var(--border)">' +
    '<span style="font-weight:600;font-size:14px">'+c.user+'</span>' + badge + '</div>' +
    '<div style="white-space:pre-wrap">'+c.body+'</div>' + img;

  var footer = '';
  if (c.status != 'approved') {
    footer += '<form method="POST" action="'+c.approve_url+'" style="display:inline">' +
              '<input type="hidden" name="comment_id" value="'+c.comment_id+'">' +
              '<input type="hidden" name="place_id" value="'+c.place_id+'">' +
              '<button type="submit" class="btn btn-success-soft">✓ Approve</button></form>';
  }
  if (c.status != 'rejected') {
    footer += '<form method="POST" action="'+c.reject_url+'" style="display:inline">' +
              '<input type="hidden" name="comment_id" value="'+c.comment_id+'">' +
              '<input type="hidden" name="place_id" value="'+c.place_id+'">' +
              '<button type="submit" class="btn btn-danger-soft">✕ Reject</button></form>';
  }
  footer += '<button onclick="closeModal()" class="btn btn-ghost">ปิด</button>';
  document.getElementById('modal-footer').innerHTML = footer;
  document.getElementById('comment-modal').style.display = 'flex';
}

function closeModal() {
  document.getElementById('comment-modal').style.display = 'none';
}

document.getElementById('comment-modal').addEventListener('click', function(e) {
  if (e.target === this) closeModal();
});
</script>
