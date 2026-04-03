<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if ($this->input->get('saved')): ?>
<div class="alert-success" style="margin-bottom:16px">✓ บันทึกเรียบร้อยแล้ว</div>
<?php endif; ?>

<form action="<?php echo base_url('cms/news/save'); ?>" method="POST" enctype="multipart/form-data">
  <?php if (!empty($news)): ?>
  <input type="hidden" name="news_id" value="<?php echo $news->news_id; ?>"/>
  <?php endif; ?>

  <div style="display:grid;grid-template-columns:1fr 380px;gap:24px;align-items:start">

    <!-- Main -->
    <div>
      <div class="card" style="padding:24px">

        <div class="form-group">
          <label class="form-label">หัวข้อข่าว *</label>
          <input type="text" name="title" class="form-control"
                 value="<?php echo !empty($news) ? htmlspecialchars($news->title) : ''; ?>"
                 placeholder="หัวข้อข่าวประชาสัมพันธ์" required/>
        </div>

        <div class="form-group">
          <label class="form-label">หมวดหมู่ *</label>
          <select name="category" class="form-control">
            <?php
            $cats = array('ท่องเที่ยว','อาหาร','กิจกรรม','ประชาสัมพันธ์','ข่าวสาร');
            foreach ($cats as $cat):
              $sel = (!empty($news) && $news->category == $cat) ? 'selected' : '';
            ?>
            <option value="<?php echo $cat; ?>" <?php echo $sel; ?>><?php echo $cat; ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="form-group">
          <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:6px">
            <label class="form-label" style="margin:0">สรุปสั้นๆ (excerpt) <span style="color:var(--muted);font-weight:400">— แสดงในหน้ารายการ</span></label>
            <button type="button"
                    style="display:flex;align-items:center;gap:5px;padding:4px 12px;border-radius:8px;background:linear-gradient(135deg,#4285f4,#0f9d58);color:#fff;border:none;cursor:pointer;font-size:11px;font-weight:700;font-family:inherit"
                    onclick="aiNewsAction('excerpt')">
              ✨ AI สรุป
            </button>
          </div>
          <textarea name="excerpt" id="news-excerpt" class="form-control" rows="2"
                    placeholder="สรุปเนื้อหา 1-2 บรรทัด"><?php echo !empty($news) ? htmlspecialchars($news->excerpt) : ''; ?></textarea>
          <div id="ai-excerpt-status" style="font-size:11px;color:var(--muted);margin-top:3px;display:none"></div>
        </div>

        <div class="form-group">
          <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:6px">
            <label class="form-label" style="margin:0">Tags <span style="color:var(--muted);font-weight:400;font-size:11px">— คั่นด้วย , เช่น ระยอง, ททท, เทศกาล</span></label>
            <button type="button"
                    style="display:flex;align-items:center;gap:5px;padding:4px 12px;border-radius:8px;background:linear-gradient(135deg,#4285f4,#0f9d58);color:#fff;border:none;cursor:pointer;font-size:11px;font-weight:700;font-family:inherit"
                    onclick="aiNewsAction('tags')">
              ✨ AI แนะนำ Tag
            </button>
          </div>
          <input type="text" name="tags" id="news-tags" class="form-control"
                 placeholder="ระยอง, ททท, อาหารทะเล, เทศกาล"
                 value="<?php echo htmlspecialchars($tags ?? ''); ?>"/>
          <p style="font-size:11px;color:var(--muted);margin-top:4px">ใช้สำหรับแนะนำข่าวที่เกี่ยวข้อง</p>
          <div id="ai-tags-status" style="font-size:11px;color:var(--muted);margin-top:3px;display:none"></div>
        </div>

        <div class="form-group">
          <label class="form-label">เนื้อหา</label>
          <textarea id="news-editor" name="body_raw"><?php echo !empty($news) ? $news->body : ''; ?></textarea>
          <input type="hidden" name="body" id="news-body" value="<?php echo !empty($news) ? htmlspecialchars($news->body) : ''; ?>"/>
        </div>

      </div>
    </div>

    <!-- Sidebar -->
    <div style="display:flex;flex-direction:column;gap:16px">

      <!-- การเผยแพร่ -->
      <div class="card" style="padding:20px">
        <h4 style="font-weight:700;font-size:14px;margin:0 0 16px 0">การเผยแพร่</h4>
        <div class="form-group">
          <label class="form-label">สถานะ</label>
          <select name="status" class="form-control" id="status-select" onchange="togglePublishDate()">
            <option value="draft"     <?php echo (empty($news) || $news->status == 'draft')     ? 'selected' : ''; ?>>ฉบับร่าง</option>
            <option value="published" <?php echo (!empty($news) && $news->status == 'published') ? 'selected' : ''; ?>>เผยแพร่</option>
          </select>
        </div>
        <div id="publish-date-wrap" class="form-group" style="display:<?php echo (!empty($news) && $news->status == 'published') ? 'block' : 'none'; ?>">
          <label class="form-label">วันที่เผยแพร่</label>
          <input type="datetime-local" name="published_at" class="form-control"
                 value="<?php echo !empty($news->published_at) ? date('Y-m-d\TH:i', strtotime($news->published_at)) : date('Y-m-d\TH:i'); ?>"/>
        </div>
        <div style="display:flex;gap:8px;margin-top:16px">
          <button type="submit" class="btn btn-primary" style="flex:1">
            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="margin-right:4px"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/></svg>
            บันทึก
          </button>
          <a href="<?php echo base_url('cms/news'); ?>" class="btn btn-ghost">ยกเลิก</a>
        </div>
      </div>

      <!-- Thumbnail -->
      <div class="card" style="padding:20px">
        <h4 style="font-weight:700;font-size:14px;margin:0 0 12px 0">รูป Thumbnail</h4>
        <div id="thumb-preview-wrap">
          <?php if (!empty($news->thumbnail)): ?>
          <div style="position:relative;margin-bottom:12px">
            <img id="thumb-preview-img" src="<?php echo base_url($news->thumbnail); ?>"
                 style="width:100%;border-radius:10px;object-fit:cover;aspect-ratio:16/9"/>
            <button type="button" onclick="removeThumb()"
                    style="position:absolute;top:6px;right:6px;width:28px;height:28px;border-radius:50%;background:rgba(0,0,0,.6);border:none;color:#fff;cursor:pointer;display:flex;align-items:center;justify-content:center;line-height:1">
              <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
          </div>
          <?php else: ?>
          <div id="thumb-placeholder" style="width:100%;aspect-ratio:16/9;background:var(--bg3);border-radius:10px;display:flex;align-items:center;justify-content:center;margin-bottom:12px">
            <svg width="36" height="36" fill="none" stroke="var(--border)" stroke-width="1.5" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/></svg>
          </div>
          <?php endif; ?>
        </div>
        <input type="hidden" name="remove_thumbnail" id="remove-thumbnail" value="0"/>
        <input type="file" name="thumbnail" id="thumb-file" accept="image/*" class="form-control"
               onchange="previewThumb(this)"/>
        <p style="font-size:11px;color:var(--muted);margin-top:6px">แนะนำขนาด 16:9 ไม่เกิน 2MB</p>
      </div>

    </div>
  </div>
</form>

<script>
// Froala Editor
new FroalaEditor('#news-editor', {
  key:            FROALA_KEY,
  height:         400,
  language:       'th',
  imageUploadURL: '<?php echo base_url("upload_image.php"); ?>',
  imageUploadParams: { folder: 'news' },
  toolbarButtons: {
    moreText:      { buttons: ['bold','italic','underline','strikeThrough','fontSize','textColor','clearFormatting'] },
    moreParagraph: { buttons: ['alignLeft','alignCenter','alignRight','formatOL','formatUL','indent','outdent'] },
    moreRich:      { buttons: ['insertLink','insertImage','insertTable','insertHR'] },
    moreMisc:      { buttons: ['undo','redo','html'] }
  },
  events: {
    'contentChanged': function() {
      document.getElementById('news-body').value = this.html.get();
    },
    'initialized': function() {
      // sync initial value
      document.getElementById('news-body').value = this.html.get();
    }
  }
});

function togglePublishDate() {
  var sel  = document.getElementById('status-select').value;
  var wrap = document.getElementById('publish-date-wrap');
  wrap.style.display = sel === 'published' ? 'block' : 'none';
}

function previewThumb(input) {
  if (!input.files || !input.files[0]) return;
  var reader = new FileReader();
  reader.onload = function(e) {
    var wrap = document.getElementById('thumb-preview-wrap');
    wrap.innerHTML =
      '<div style="position:relative;margin-bottom:12px">' +
        '<img id="thumb-preview-img" src="' + e.target.result + '" style="width:100%;border-radius:10px;object-fit:cover;aspect-ratio:16/9"/>' +
        '<button type="button" onclick="removeThumb()" style="position:absolute;top:6px;right:6px;width:28px;height:28px;border-radius:50%;background:rgba(0,0,0,.6);border:none;color:#fff;cursor:pointer;display:flex;align-items:center;justify-content:center">' +
          '<svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>' +
        '</button>' +
      '</div>';
    document.getElementById('remove-thumbnail').value = '0';
  };
  reader.readAsDataURL(input.files[0]);
}

function removeThumb() {
  var wrap = document.getElementById('thumb-preview-wrap');
  wrap.innerHTML =
    '<div style="width:100%;aspect-ratio:16/9;background:var(--bg3);border-radius:10px;display:flex;align-items:center;justify-content:center;margin-bottom:12px">' +
      '<svg width="36" height="36" fill="none" stroke="var(--border)" stroke-width="1.5" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/></svg>' +
    '</div>';
  // เคลียร์ file input
  var fileInput = document.getElementById('thumb-file');
  fileInput.value = '';
  // บอก backend ให้ลบรูป
  document.getElementById('remove-thumbnail').value = '1';
}

function aiNewsAction(type) {
  var baseUrl = '<?php echo base_url(); ?>';
  var body    = document.querySelector('#news-editor + .fr-box .fr-element')
                  ? document.querySelector('#news-editor + .fr-box .fr-element').innerHTML
                  : document.getElementById('news-editor').value;
  var title   = document.querySelector('input[name="title"]')?.value || '';
  var statusEl = document.getElementById('ai-' + type + '-status');

  statusEl.style.display = 'block';
  statusEl.style.color   = 'var(--muted)';
  statusEl.textContent   = '⏳ Gemini กำลังประมวลผล...';

  var url  = type === 'excerpt' ? baseUrl + 'cms/ai/news-excerpt' : baseUrl + 'cms/ai/news-tags';
  var data = type === 'excerpt' ? { body: body } : { title: title, body: body };

  $.ajax({
    type: 'POST', url: url, data: data, dataType: 'json',
    success: function(res) {
      if (res.success) {
        if (type === 'excerpt') {
          document.getElementById('news-excerpt').value = res.excerpt;
        } else {
          document.getElementById('news-tags').value = res.tags;
        }
        statusEl.style.color = '#00665a';
        statusEl.textContent = '✓ เสร็จแล้ว แก้ไขได้ตามต้องการ';
      } else {
        statusEl.style.color = 'var(--danger)';
        statusEl.textContent = '✕ ' + (res.error || 'เกิดข้อผิดพลาด');
      }
    },
    error: function() {
      statusEl.style.color = 'var(--danger)';
      statusEl.textContent = '✕ เชื่อมต่อ server ไม่ได้';
    }
  });
}
</script>
