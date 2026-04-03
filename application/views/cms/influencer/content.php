<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div style="display:grid;grid-template-columns:1fr 380px;gap:24px;align-items:start">

  <!-- ฝั่งซ้าย: รายการ -->
  <div>
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px">
      <div style="display:flex;align-items:center;gap:8px">
        <span style="font-weight:600;font-size:14px">คลิป TikTok ทั้งหมด</span>
        <span class="badge badge-blue"><?php echo count($contents); ?></span>
      </div>
    </div>

    <div id="content-list" class="space-y-3">
      <?php if ($contents): foreach ($contents as $c): ?>
      <div class="card" style="padding:16px;display:flex;align-items:flex-start;gap:14px" data-id="<?php echo $c->content_id; ?>">
        <!-- TikTok Preview -->
        <div style="width:60px;height:80px;background:#000;border-radius:8px;overflow:hidden;flex-shrink:0;display:flex;align-items:center;justify-content:center">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="white"><path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-2.88 2.5 2.89 2.89 0 01-2.89-2.89 2.89 2.89 0 012.89-2.89c.28 0 .54.04.79.1V9.01a6.33 6.33 0 00-.79-.05 6.34 6.34 0 00-6.34 6.34 6.34 6.34 0 006.34 6.34 6.34 6.34 0 006.33-6.34V8.69a8.27 8.27 0 004.84 1.56V6.8a4.85 4.85 0 01-1.07-.11z"/></svg>
        </div>
        <div style="flex:1;min-width:0">
          <p style="font-size:11px;color:var(--muted);font-weight:600;margin:0 0 4px 0">ID: <?php echo $c->tiktok_id; ?></p>
          <p style="font-size:14px;font-weight:600;margin:0 0 8px 0;line-height:1.4"><?php echo $c->title; ?></p>
          <div style="display:flex;gap:8px">
            <button onclick="editContent(<?php echo $c->content_id; ?>, '<?php echo addslashes($c->tiktok_id); ?>', '<?php echo addslashes($c->title); ?>', <?php echo $c->sort_order; ?>)"
                    class="btn btn-ghost btn-sm">แก้ไข</button>
            <button onclick="deleteContent(<?php echo $c->content_id; ?>)"
                    class="btn btn-ghost btn-sm" style="color:var(--danger)">ลบ</button>
            <a href="https://www.tiktok.com/@/video/<?php echo $c->tiktok_id; ?>" target="_blank"
               class="btn btn-ghost btn-sm">ดู TikTok ↗</a>
          </div>
        </div>
        <div style="flex-shrink:0;text-align:center">
          <span style="font-size:10px;color:var(--muted)">ลำดับ</span>
          <div style="font-size:18px;font-weight:700"><?php echo $c->sort_order; ?></div>
        </div>
      </div>
      <?php endforeach; else: ?>
      <div class="card" style="text-align:center;padding:48px;color:var(--muted)">
        <p>ยังไม่มีคลิป TikTok — เพิ่มจากฝั่งขวาได้เลยครับ</p>
      </div>
      <?php endif; ?>
    </div>
  </div>

  <!-- ฝั่งขวา: form -->
  <div class="card" style="padding:24px">
    <h3 style="font-weight:700;font-size:15px;margin:0 0 20px 0" id="form-title">เพิ่มคลิป TikTok</h3>

    <input type="hidden" id="content_id" value=""/>

    <div style="margin-bottom:14px">
      <label class="form-label">TikTok Video ID หรือ URL *</label>
      <input type="text" id="tiktok_id" class="form-control"
             placeholder="เช่น 7483578329157684501 หรือ URL เต็ม"/>
      <p style="font-size:11px;color:var(--muted);margin-top:4px">วาง URL เต็มได้เลย ระบบจะแกะ ID ให้อัตโนมัติ</p>
    </div>

    <div style="margin-bottom:14px">
      <label class="form-label">ชื่อคลิป / คำอธิบาย *</label>
      <textarea id="title" class="form-control" rows="3" placeholder="ชื่อหรือคำอธิบายสั้นๆ ของคลิปนี้"></textarea>
    </div>

    <div style="margin-bottom:20px">
      <label class="form-label">ลำดับการแสดงผล</label>
      <input type="number" id="sort_order" class="form-control" value="0" min="0"/>
    </div>

    <div style="display:flex;gap:8px">
      <button onclick="saveContent()" class="btn btn-primary" style="flex:1">
        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/></svg>
        บันทึก
      </button>
      <button onclick="resetForm()" class="btn btn-ghost">ยกเลิก</button>
    </div>
  </div>
</div>

<!-- Toast -->
<div id="toast" style="display:none;position:fixed;bottom:24px;right:24px;background:#1a1a1a;color:#fff;padding:12px 20px;border-radius:10px;font-size:13px;font-weight:500;z-index:999"></div>

<script>
var baseUrl = '<?php echo base_url(); ?>';

function saveContent() {
  var tiktok_id  = document.getElementById('tiktok_id').value.trim();
  var title      = document.getElementById('title').value.trim();
  var sort_order = document.getElementById('sort_order').value;
  var content_id = document.getElementById('content_id').value;

  if (!tiktok_id || !title) {
    showToast('กรุณากรอก ID และชื่อคลิป');
    return;
  }

  $.ajax({
    type:     'POST',
    url:      baseUrl + 'cms/influencer/content/save',
    data:     { content_id: content_id, tiktok_id: tiktok_id, title: title, sort_order: sort_order },
    dataType: 'json',
    success:  function(res) {
      if (res.success) {
        showToast('✓ บันทึกเรียบร้อยแล้ว');
        setTimeout(function() { location.reload(); }, 800);
      }
    }
  });
}

function editContent(id, tiktok_id, title, sort_order) {
  document.getElementById('content_id').value  = id;
  document.getElementById('tiktok_id').value   = tiktok_id;
  document.getElementById('title').value        = title;
  document.getElementById('sort_order').value   = sort_order;
  document.getElementById('form-title').textContent = 'แก้ไขคลิป TikTok';
  window.scrollTo({ top: 0, behavior: 'smooth' });
}

function deleteContent(id) {
  if (!confirm('ต้องการลบคลิปนี้ไหม?')) return;
  $.ajax({
    type:     'POST',
    url:      baseUrl + 'cms/influencer/content/delete',
    data:     { content_id: id },
    dataType: 'json',
    success:  function(res) {
      if (res.success) {
        showToast('ลบเรียบร้อยแล้ว');
        setTimeout(function() { location.reload(); }, 600);
      }
    }
  });
}

function resetForm() {
  document.getElementById('content_id').value  = '';
  document.getElementById('tiktok_id').value   = '';
  document.getElementById('title').value        = '';
  document.getElementById('sort_order').value   = '0';
  document.getElementById('form-title').textContent = 'เพิ่มคลิป TikTok';
}

function showToast(msg) {
  var t = document.getElementById('toast');
  t.textContent = msg;
  t.style.display = 'block';
  setTimeout(function() { t.style.display = 'none'; }, 3000);
}
</script>
