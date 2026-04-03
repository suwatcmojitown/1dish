<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if ($this->session->flashdata('success')): ?>
<div class="alert-success"><?php echo $this->session->flashdata('success'); ?></div>
<?php endif; ?>

<div style="display:grid;grid-template-columns:1fr 320px;gap:20px;align-items:start">

  <!-- List -->
  <div class="card">
    <div class="card-header">
      <div class="card-title">อำเภอทั้งหมด</div>
    </div>
    <div class="table-wrap">
      <table>
        <thead>
          <tr><th>#</th><th>ชื่ออำเภอ</th><th>Slug</th><th style="text-align:center">action</th></tr>
        </thead>
        <tbody>
          <?php if ($list): foreach ($list as $row): ?>
          <tr>
            <td class="mono"><?php echo $row->district_id; ?></td>
            <td><strong><?php echo $row->name; ?></strong></td>
            <td class="mono"><?php echo $row->slug; ?></td>
            <td style="text-align:center">
              <button class="icon-btn edit-btn" title="แก้ไข"
                data-id="<?php echo $row->district_id; ?>"
                data-name="<?php echo htmlspecialchars($row->name, ENT_QUOTES); ?>"
                data-slug="<?php echo htmlspecialchars($row->slug, ENT_QUOTES); ?>">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
              </button>
            </td>
          </tr>
          <?php endforeach; else: ?>
          <tr><td colspan="4" style="text-align:center;color:var(--muted);padding:24px">ยังไม่มีอำเภอ</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Form -->
  <div>
    <form id="district-form" method="POST" action="<?php echo base_url('cms/district/save'); ?>">
      <input type="hidden" id="dist-id" name="district_id" value="">
      <div class="form-section">
        <div class="form-section-title" id="form-title">เพิ่มอำเภอ</div>
        <div class="form-group" style="margin-bottom:12px">
          <label>ชื่ออำเภอ</label>
          <input type="text" id="dist-name" name="name" placeholder="เช่น อำเภอเมืองระยอง" required>
        </div>
        <div class="form-group" style="margin-bottom:0">
          <label>Slug</label>
          <input type="text" id="dist-slug" name="slug" placeholder="เช่น mueang-rayong" required>
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
  $('#dist-id').val(id);
  $('#dist-name').val(name);
  $('#dist-slug').val(slug);
  $('#form-title').text('แก้ไขอำเภอ');
  $('#btn-submit').text('บันทึก');
  $('#btn-cancel').show();
  $('#district-form').attr('action', '<?php echo base_url('cms/district/update'); ?>');
  window.scrollTo(0, 0);
});

function resetForm() {
  $('#dist-id').val('');
  $('#dist-name').val('');
  $('#dist-slug').val('');
  $('#form-title').text('เพิ่มอำเภอ');
  $('#btn-submit').text('+ เพิ่ม');
  $('#btn-cancel').hide();
  $('#district-form').attr('action', '<?php echo base_url('cms/district/save'); ?>');
}
</script>
