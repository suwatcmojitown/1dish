<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="stat-grid">
  <div class="stat-card blue">
    <div class="stat-label">ร้านค้าทั้งหมด</div>
    <div class="stat-value"><?php echo $total_place; ?></div>
  </div>
  <div class="stat-card teal">
    <div class="stat-label">รีวิว approved</div>
    <div class="stat-value"><?php echo $total_review; ?></div>
  </div>
  <div class="stat-card red">
    <div class="stat-label">รอ approve</div>
    <div class="stat-value"><?php echo $total_pending; ?></div>
  </div>
</div>

<?php if ($this->session->flashdata('success')): ?>
<div class="alert-success"><?php echo $this->session->flashdata('success'); ?></div>
<?php endif; ?>

<div class="card">
  <div class="card-header">
    <div class="card-title">รีวิวล่าสุด</div>
    <a href="<?php echo base_url('cms/review'); ?>" class="btn btn-ghost btn-sm">ดูทั้งหมด</a>
  </div>
  <div class="table-wrap">
    <table>
      <thead><tr>
        <th>รูป</th><th>ร้านค้า</th><th>หมวดหมู่</th><th>อำเภอ</th><th>สถานะ</th><th>action</th>
      </tr></thead>
      <tbody>
        <?php if ($review_list): foreach ($review_list as $row): ?>
        <tr>
          <td>
            <div class="place-thumb">
              <?php
                $thumb = !empty($row->cover_image) ? $row->cover_image : $row->shop_image;
              ?>
              <?php if (!empty($thumb)): ?>
              <img src="<?php echo base_url($thumb); ?>" style="width:70px;height:auto;object-fit:cover;border-radius:8px;display:block;">
              <?php else: echo '&#127829;'; endif; ?>
            </div>
          </td>
          <td>
            <div class="place-name"><?php echo $row->place_name; ?></div>
            <div class="place-dish"><?php echo $row->signature_dish_name; ?></div>
            <div class="place-meta">
              <span class="place-id">#<?php echo $row->review_id; ?></span>
              <?php if ($row->reviewer_name): ?> เขียนโดย <?php echo $row->reviewer_name; ?><?php endif; ?>
            </div>
            <div class="place-date"><?php echo format_datetime($row->created_at); ?></div>
          </td>
          <td><span class="badge badge-blue"><?php echo $row->category_name; ?></span></td>
          <td><?php echo $row->district_name; ?></td>
          <td>
            <?php
            $badge = 'badge-warn'; $label = 'pending';
            if ($row->review_status == 'approved')      { $badge = 'badge-green';  $label = 'approved'; }
            if ($row->review_status == 'approved_seal') { $badge = 'badge-blue';   $label = 'seal'; }
            ?>
            <span class="badge <?php echo $badge; ?>"><?php echo $label; ?></span>
          </td>
          <td>
            <a href="<?php echo base_url('cms/place/edit/' . $row->place_id); ?>" class="btn btn-ghost btn-sm">แก้ไข</a>
          </td>
        </tr>
        <?php endforeach; else: ?>
        <tr><td colspan="6" style="text-align:center;color:var(--muted);padding:30px">ยังไม่มีรีวิว</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
