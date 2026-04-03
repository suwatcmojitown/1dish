<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if ($this->session->flashdata('success')): ?>
<div class="alert-success"><?php echo $this->session->flashdata('success'); ?></div>
<?php endif; ?>

<div class="toolbar" style="margin-bottom:12px">
  <a href="<?php echo base_url('cms/place/add'); ?>" class="btn btn-primary">+ เพิ่มร้านค้า</a>
  <?php if (!empty($category_sel) || !empty($district_sel)): ?>
  <a href="<?php echo base_url('cms/place'); ?>" class="btn btn-ghost btn-sm">ล้าง filter</a>
  <?php endif; ?>
  <span class="result-count">ทั้งหมด <?php echo $total; ?> ร้าน</span>
</div>

<!-- Filter หมวดหมู่ -->
<div class="filter-bar">
  <div class="filter-label">หมวดหมู่</div>
  <div class="filter-pills">
    <?php if ($categoryList): foreach ($categoryList as $cat): ?>
    <?php $active = in_array($cat->name, $category_sel) ? 'active' : ''; ?>
    <button class="pill <?php echo $active; ?>" data-group="category" data-val="<?php echo $cat->name; ?>">
      <?php echo $cat->name; ?>
    </button>
    <?php endforeach; endif; ?>
  </div>
</div>

<!-- Filter อำเภอ -->
<div class="filter-bar" style="margin-bottom:18px">
  <div class="filter-label">อำเภอ</div>
  <div class="filter-pills">
    <?php if ($districtList): foreach ($districtList as $dist): ?>
    <?php $active = in_array($dist->name, $district_sel) ? 'active' : ''; ?>
    <button class="pill <?php echo $active; ?>" data-group="district" data-val="<?php echo $dist->name; ?>">
      <?php echo $dist->name; ?>
    </button>
    <?php endforeach; endif; ?>
  </div>
</div>

<div class="card">
  <div class="table-wrap">
    <table>
      <thead>
        <tr>
          <th>รูป</th><th>ร้านค้า</th><th>หมวดหมู่</th><th>อำเภอ</th><th>สถานะ</th><th style="text-align:center">action</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($list): foreach ($list as $row): ?>
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
            <?php if (!empty($row->signature_dish_name)): ?>
            <div class="place-dish"><?php echo $row->signature_dish_name; ?></div>
            <?php endif; ?>
            <div class="place-meta">
              <span class="place-id">#<?php echo isset($row->review_id) ? $row->review_id : '-'; ?></span>
              <?php if (!empty($row->reviewer_name)): ?>
              เขียนโดย <?php echo $row->reviewer_name; ?>
              <?php endif; ?>
            </div>
            <?php if (!empty($row->review_created_at)): ?>
            <div class="place-date"><?php echo format_datetime($row->review_created_at); ?></div>
            <?php endif; ?>
          </td>
          <td><span class="badge badge-blue"><?php echo $row->category_name; ?></span></td>
          <td><?php echo $row->district_name; ?></td>
          <td>
            <?php
            $badge = 'badge-gray'; $label = '-';
            if (!empty($row->review_status)) {
                if ($row->review_status == 'pending')       { $badge = 'badge-warn';  $label = 'pending'; }
                if ($row->review_status == 'approved')      { $badge = 'badge-green'; $label = 'approved'; }
                if ($row->review_status == 'approved_seal') { $badge = 'badge-blue';  $label = 'seal'; }
            }
            ?>
            <span class="badge <?php echo $badge; ?>"><?php echo $label; ?></span>
          </td>
          <td style="text-align:center">
            <div class="action-row" style="justify-content:center">
              <?php if (!empty($row->review_id)): ?>
              <a href="<?php echo base_url('cms/comment?place_id=' . $row->place_id); ?>"
                 class="icon-btn <?php echo $row->comment_pending > 0 ? 'has-comment' : ''; ?>"
                 title="<?php echo $row->comment_total; ?> comment<?php echo $row->comment_pending > 0 ? ' ('.$row->comment_pending.' รอ approve)' : ''; ?>"
                 style="width:auto;padding:0 10px;gap:5px;">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                <span style="font-size:12px;font-weight:600;line-height:1"><?php echo $row->comment_total; ?></span>
              </a>
              <?php endif; ?>
              <a href="<?php echo base_url('cms/place/edit/' . $row->place_id); ?>" class="icon-btn" title="แก้ไข">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
              </a>
              <button class="icon-btn danger" onclick="confirmDelete(<?php echo $row->place_id; ?>)" title="ลบ">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
              </button>
            </div>
          </td>
        </tr>
        <?php endforeach; else: ?>
        <tr><td colspan="6" style="text-align:center;color:var(--muted);padding:32px">ไม่พบร้านค้า</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<!-- Paging -->
<?php
$total_pages = ceil($total / $per_page);
if ($total_pages < 1) $total_pages = 1;
$qs = '';
foreach ($category_sel as $c) $qs .= '&category[]=' . urlencode($c);
foreach ($district_sel  as $d) $qs .= '&district[]='  . urlencode($d);
?>
<div class="paging">
  <?php if ($current_page > 1): ?>
  <a href="<?php echo base_url('cms/place?page=' . ($current_page - 1) . $qs); ?>" class="page-btn">&#8592; ก่อนหน้า</a>
  <?php else: ?>
  <span class="page-btn disabled">&#8592; ก่อนหน้า</span>
  <?php endif; ?>

  <?php for ($i = 1; $i <= $total_pages; $i++): ?>
  <a href="<?php echo base_url('cms/place?page=' . $i . $qs); ?>"
     class="page-btn <?php echo $i == $current_page ? 'active' : ''; ?>">
    <?php echo $i; ?>
  </a>
  <?php endfor; ?>

  <?php if ($current_page < $total_pages): ?>
  <a href="<?php echo base_url('cms/place?page=' . ($current_page + 1) . $qs); ?>" class="page-btn">ถัดไป &#8594;</a>
  <?php else: ?>
  <span class="page-btn disabled">ถัดไป &#8594;</span>
  <?php endif; ?>

  <span class="page-info">หน้า <?php echo $current_page; ?> / <?php echo $total_pages; ?></span>
</div>

<script>
// เก็บ filter ที่เลือกไว้
var selected = {
    category: <?php echo json_encode($category_sel); ?>,
    district:  <?php echo json_encode($district_sel); ?>
};

$('.pill').on('click', function() {
    var group = $(this).data('group');
    var val   = $(this).data('val');
    var idx   = selected[group].indexOf(val);

    if (idx > -1) {
        selected[group].splice(idx, 1);
        $(this).removeClass('active');
    } else {
        selected[group].push(val);
        $(this).addClass('active');
    }
    applyFilter();
});

function applyFilter() {
    var qs = '?page=1';
    $.each(selected.category, function(i, v) { qs += '&category[]=' + encodeURIComponent(v); });
    $.each(selected.district,  function(i, v) { qs += '&district[]='  + encodeURIComponent(v); });
    window.location.href = '<?php echo base_url('cms/place'); ?>' + qs;
}

function confirmDelete(place_id) {
    if (confirm('ต้องการลบร้านค้านี้?')) {
        $.ajax({
            type: 'POST',
            url:  '<?php echo base_url('cms/place/delete'); ?>',
            data: { place_id: place_id },
            success: function() { location.reload(); }
        });
    }
}
</script>
