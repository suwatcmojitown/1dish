<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if ($this->session->flashdata('success')): ?>
<div class="alert-success"><?php echo $this->session->flashdata('success'); ?></div>
<?php endif; ?>

<div style="display:grid;grid-template-columns:1fr 340px;gap:20px;align-items:start">

  <!-- List -->
  <div class="card">
    <div class="card-header">
      <div class="card-title">หมวดหมู่ทั้งหมด</div>
    </div>
    <div class="table-wrap">
      <table>
        <thead>
          <tr><th>#</th><th>ชื่อ</th><th>Slug</th><th>Icon</th><th style="text-align:center">action</th></tr>
        </thead>
        <tbody>
          <?php if ($list): foreach ($list as $row): ?>
          <tr>
            <td class="mono"><?php echo $row->category_id; ?></td>
            <td><strong><?php echo $row->name; ?></strong></td>
            <td class="mono"><?php echo $row->slug; ?></td>
            <td class="mono" style="font-size:12px"><?php echo $row->icon; ?></td>
            <td style="text-align:center">
              <div class="action-row" style="justify-content:center">
                <button class="icon-btn edit-btn" title="แก้ไข"
                  data-id="<?php echo $row->category_id; ?>"
                  data-name="<?php echo htmlspecialchars($row->name, ENT_QUOTES); ?>"
                  data-slug="<?php echo htmlspecialchars($row->slug, ENT_QUOTES); ?>"
                  data-icon="<?php echo htmlspecialchars($row->icon ?: '', ENT_QUOTES); ?>">
                  <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                </button>
                <button class="icon-btn danger delete-btn" title="ลบ"
                  data-id="<?php echo $row->category_id; ?>">
                  <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
                </button>
              </div>
            </td>
          </tr>
          <?php endforeach; else: ?>
          <tr><td colspan="5" style="text-align:center;color:var(--muted);padding:24px">ยังไม่มีหมวดหมู่</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Form -->
  <div>
    <form id="category-form" method="POST" action="<?php echo base_url('cms/category/save'); ?>">
      <input type="hidden" id="cat-id" name="category_id" value="">
      <div class="form-section">
        <div class="form-section-title" id="form-title">เพิ่มหมวดหมู่</div>
        <div class="form-group" style="margin-bottom:12px">
          <label>ชื่อหมวดหมู่</label>
          <input type="text" id="cat-name" name="name" placeholder="เช่น อาหารทะเล" required>
        </div>
        <div class="form-group" style="margin-bottom:12px">
          <label>Slug</label>
          <input type="text" id="cat-slug" name="slug" placeholder="เช่น seafood" required>
        </div>
        <div class="form-group" style="margin-bottom:0">
          <label>Icon class</label>
          <input type="text" id="cat-icon" name="icon" placeholder="เช่น icon-seafood">
        </div>
      </div>
      <div style="display:flex;gap:8px;justify-content:flex-end;margin-top:12px">
        <button type="button" class="btn btn-ghost" id="btn-cancel" style="display:none" onclick="resetForm()">ยกเลิก</button>
        <button type="submit" class="btn btn-primary" id="btn-submit">+ เพิ่ม</button>
      </div>
    </form>
  </div>

</div>

<script>
$(document).on('click', '.edit-btn', function() {
  var id   = $(this).data('id');
  var name = $(this).data('name');
  var slug = $(this).data('slug');
  var icon = $(this).data('icon');
  $('#cat-id').val(id);
  $('#cat-name').val(name);
  $('#cat-slug').val(slug);
  $('#cat-icon').val(icon);
  $('#form-title').text('แก้ไขหมวดหมู่');
  $('#btn-submit').text('บันทึก');
  $('#btn-cancel').show();
  $('#category-form').attr('action', '<?php echo base_url('cms/category/update'); ?>');
  window.scrollTo(0, 0);
});

$(document).on('click', '.delete-btn', function() {
  var id = $(this).data('id');
  if (!confirm('ต้องการลบหมวดหมู่นี้?')) return;
  $.ajax({
    type: 'POST',
    url:  '<?php echo base_url('cms/category/delete'); ?>',
    data: { category_id: id },
    success: function() { location.reload(); }
  });
});

function resetForm() {
  $('#cat-id').val('');
  $('#cat-name').val('');
  $('#cat-slug').val('');
  $('#cat-icon').val('');
  $('#form-title').text('เพิ่มหมวดหมู่');
  $('#btn-submit').text('+ เพิ่ม');
  $('#btn-cancel').hide();
  $('#category-form').attr('action', '<?php echo base_url('cms/category/save'); ?>');
}
</script>
