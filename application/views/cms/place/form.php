<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php
$is_edit   = isset($place);
$place_id  = $is_edit ? $place->place_id  : '';
$review_id = ($is_edit && isset($review)) ? $review->review_id : '';
?>

<div class="page-form-header">
  <div class="page-form-title"><?php echo $is_edit ? 'แก้ไขร้านค้า' : 'เพิ่มร้านค้า'; ?></div>
  <div class="page-form-sub">ข้อมูลร้านค้าและรีวิวจะถูกบันทึกพร้อมกัน</div>
</div>

<form id="placeForm" method="POST" enctype="multipart/form-data"
      action="<?php echo base_url($is_edit ? 'cms/place/update' : 'cms/place/save'); ?>">

  <?php if ($is_edit): ?>
  <input type="hidden" name="place_id"  value="<?php echo $place_id; ?>">
  <input type="hidden" name="review_id" value="<?php echo $review_id; ?>">
  <?php endif; ?>

  <!-- ส่วนที่ 1: ข้อมูลร้านค้า -->
  <div class="form-section">
    <div class="form-section-title">1 — ข้อมูลร้านค้า</div>
    <div class="form-grid">
      <div class="form-group form-full">
        <label>ชื่อร้านค้า / สถานที่</label>
        <input type="text" name="name" placeholder="เช่น Krua Ban Phe"
               value="<?php echo $is_edit ? $place->name : ''; ?>" required>
      </div>
      <div class="form-group">
        <label>หมวดหมู่</label>
        <select name="category_id" required>
          <option value="">-- เลือกหมวดหมู่ --</option>
          <?php if ($categoryList): foreach ($categoryList as $cat): ?>
          <option value="<?php echo $cat->category_id; ?>"
            <?php echo ($is_edit && $place->category_id == $cat->category_id) ? 'selected' : ''; ?>>
            <?php echo $cat->name; ?>
          </option>
          <?php endforeach; endif; ?>
        </select>
      </div>
      <div class="form-group">
        <label>อำเภอ</label>
        <select name="district_id" required>
          <option value="">-- เลือกอำเภอ --</option>
          <?php if ($districtList): foreach ($districtList as $dist): ?>
          <option value="<?php echo $dist->district_id; ?>"
            <?php echo ($is_edit && $place->district_id == $dist->district_id) ? 'selected' : ''; ?>>
            <?php echo $dist->name; ?>
          </option>
          <?php endforeach; endif; ?>
        </select>
      </div>
      <div class="form-group">
        <label>เวลาเปิด-ปิด</label>
        <input type="text" name="open_hours" placeholder="เช่น ทุกวัน 10:00 - 21:00"
               value="<?php echo $is_edit ? $place->open_hours : ''; ?>">
      </div>
      <div class="form-group">
        <label>Facebook URL</label>
        <input type="text" name="fb_url" placeholder="https://facebook.com/..."
               value="<?php echo $is_edit ? $place->fb_url : ''; ?>">
      </div>
      <div class="form-group">
        <label>Instagram URL</label>
        <input type="text" name="ig_url" placeholder="https://instagram.com/..."
               value="<?php echo $is_edit ? $place->ig_url : ''; ?>">
      </div>
      <div class="form-group">
        <label>TikTok URL</label>
        <input type="text" name="tiktok_url" placeholder="https://tiktok.com/..."
               value="<?php echo $is_edit ? $place->tiktok_url : ''; ?>">
      </div>
    </div>
  </div>

  <!-- ส่วนที่ 2: พิกัดและภาพหน้าร้าน -->
  <div class="form-section">
    <div class="form-section-title">2 — พิกัดและภาพหน้าร้าน</div>
    <div class="form-grid">
      <div class="form-group">
        <label>Latitude</label>
        <input type="text" name="lat" placeholder="เช่น 12.6408"
               value="<?php echo $is_edit ? $place->lat : ''; ?>">
      </div>
      <div class="form-group">
        <label>Longitude</label>
        <input type="text" name="lng" placeholder="เช่น 101.5687"
               value="<?php echo $is_edit ? $place->lng : ''; ?>">
      </div>
      <div class="form-group form-full">
        <label>ภาพหน้าร้าน</label>
        <?php if ($is_edit && !empty($place->shop_image)): ?>
        <div style="margin-bottom:10px">
          <img src="<?php echo base_url($place->shop_image); ?>" style="max-width:200px;border-radius:8px;border:1px solid var(--border);">
        </div>
        <input type="hidden" name="shop_image_hidden" value="<?php echo $place->shop_image; ?>">
        <?php endif; ?>
        <input type="file" name="shop_image" accept="image/*" style="background:var(--bg3);border:1px solid var(--border);border-radius:8px;padding:8px;">
        <small style="color:var(--muted);font-size:12px">JPG, PNG — เพื่อให้รู้จักตำแหน่งร้านได้ง่ายขึ้น</small>
      </div>
    </div>
  </div>

  <!-- ส่วนที่ 3: รีวิว -->
  <div class="form-section">
    <div class="form-section-title">3 — รีวิว</div>
    <div class="form-grid">
      <div class="form-group form-full">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:6px">
          <label style="margin:0">หัวข้อรีวิว</label>
          <button type="button" id="btn-gen-title"
                  style="display:flex;align-items:center;gap:5px;padding:4px 12px;border-radius:8px;background:linear-gradient(135deg,#4285f4,#0f9d58);color:#fff;border:none;cursor:pointer;font-size:11px;font-weight:700;font-family:inherit;transition:opacity .2s"
                  onclick="aiGenTitle()">
            ✨ AI Gen Title
          </button>
        </div>
        <input type="text" name="review_title" id="review-title" placeholder="เช่น The Salt-Crusted Sea Bass of Ban Phe"
               value="<?php echo ($is_edit && isset($review)) ? $review->title : ''; ?>">
        <div id="ai-title-status" style="font-size:11px;color:var(--muted);margin-top:3px;display:none"></div>

        <!-- Inline title suggestions panel -->
        <div id="ai-title-panel" style="display:none;margin-top:10px;border:1px solid #e5e7eb;border-radius:12px;overflow:hidden;background:#f8f9fa">
          <div style="padding:10px 14px;background:#fff;border-bottom:1px solid #e5e7eb;display:flex;align-items:center;justify-content:space-between">
            <span style="font-size:12px;font-weight:700;color:var(--text)">✨ เลือก Title ที่ชอบ</span>
            <span style="font-size:11px;color:var(--muted)">คลิกเพื่อใช้งาน</span>
          </div>
          <div id="ai-title-list" style="padding:10px;display:flex;flex-direction:column;gap:6px"></div>
        </div>
      </div>
      <div class="form-group form-full">
        <label>ชื่อเมนูเด่น (Signature Dish)</label>
        <input type="text" name="signature_dish_name" placeholder="เช่น ปลากะพงเกลือ"
               value="<?php echo ($is_edit && isset($review)) ? $review->signature_dish_name : ''; ?>">
      </div>
      <div class="form-group form-full">
        <label>ภาพปกรีวิว</label>

        <!-- Tab toggle -->
        <div style="display:flex;gap:0;margin-bottom:12px;border:1px solid var(--border);border-radius:8px;overflow:hidden;width:fit-content">
          <button type="button" id="tab-upload" onclick="switchCoverTab('upload')"
                  style="padding:6px 16px;font-size:12px;font-weight:700;border:none;cursor:pointer;font-family:inherit;background:#005e97;color:#fff;transition:all .2s">
            📁 อัปโหลดเอง
          </button>
          <button type="button" id="tab-ai" onclick="switchCoverTab('ai')"
                  style="padding:6px 16px;font-size:12px;font-weight:700;border:none;cursor:pointer;font-family:inherit;background:var(--bg2);color:var(--muted);transition:all .2s">
            ✨ Gen ด้วย AI
          </button>
        </div>

        <!-- Tab: อัปโหลดเอง -->
        <div id="cover-tab-upload">
          <?php if ($is_edit && isset($review) && !empty($review->cover_image)): ?>
          <div style="margin-bottom:10px">
            <img src="<?php echo base_url($review->cover_image); ?>" style="max-width:200px;border-radius:8px;border:1px solid var(--border);">
          </div>
          <input type="hidden" name="cover_image_hidden" value="<?php echo $review->cover_image; ?>">
          <?php else: ?>
          <input type="hidden" name="cover_image_hidden" id="cover-image-hidden" value="">
          <?php endif; ?>
          <input type="file" name="cover_image" accept="image/*" style="background:var(--bg3);border:1px solid var(--border);border-radius:8px;padding:8px;width:100%">
          <small style="color:var(--muted);font-size:12px">JPG, PNG — ภาพปกสำหรับแสดงในหน้ารีวิว</small>
        </div>

        <!-- Tab: Gen ด้วย AI -->
        <div id="cover-tab-ai" style="display:none">
          <div style="border:1px solid var(--border);border-radius:12px;padding:16px;background:var(--bg2)">

            <!-- Upload reference images -->
            <div style="margin-bottom:12px">
              <div style="font-size:11px;font-weight:700;color:var(--muted);text-transform:uppercase;letter-spacing:.05em;margin-bottom:6px">1. อัปโหลดรูปอาหารอ้างอิง (สูงสุด 5 ภาพ)</div>
              <div id="cover-dropzone"
                   onclick="document.getElementById('ai-cover-ref').click()"
                   ondragover="coverDragOver(event)" ondragleave="coverDragLeave(event)" ondrop="coverDrop(event)"
                   style="border:2px dashed var(--border);border-radius:10px;padding:20px;text-align:center;cursor:pointer;transition:all .2s;background:#fff">
                <svg width="24" height="24" fill="none" stroke="var(--muted)" stroke-width="1.5" viewBox="0 0 24 24" style="margin-bottom:6px"><rect x="3" y="3" width="18" height="18" rx="3"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/></svg>
                <div style="font-size:12px;color:var(--muted)">คลิกหรือลากภาพมาวาง</div>
                <div style="font-size:11px;color:var(--muted);margin-top:2px">JPG, PNG — สูงสุด 5 ภาพ</div>
              </div>
              <input type="file" id="ai-cover-ref" accept="image/*" multiple style="display:none" onchange="coverFileSelect(this)"/>
              <div id="cover-thumb-list" style="display:flex;flex-wrap:wrap;gap:8px;margin-top:8px"></div>
            </div>

            <!-- Prompt -->
            <div style="margin-bottom:12px">
              <div style="font-size:11px;font-weight:700;color:var(--muted);text-transform:uppercase;letter-spacing:.05em;margin-bottom:6px">2. Prompt (แก้ไขได้)</div>
              <textarea id="ai-cover-prompt" rows="5"
                        style="width:100%;border:1px solid var(--border);border-radius:8px;padding:10px;font-size:12px;font-family:inherit;resize:vertical;background:#fff;color:var(--text)"
>ฉันต้องการให้รูปอาหารนี้ดูสวยงามและน่ารับประทานยิ่งขึ้น เหมือนถ่ายโดยช่างภาพมืออาชีพ มีการจัดแสงแบบธรรมชาติ แต่ยังคงความเป็นธรรมชาติของอาหารไว้ ทำให้ภาพดูมีรสชาติมากขึ้นกว่าในรูปเดิม มีการจัดแสง มีการเปลี่ยนฉากพื้นหลัง เปลี่ยนพื้นโต๊ะให้อิงจากพื้นโต๊ะในภาพ แต่ขอให้สะอาดและดูใหม่ ไม่ต้องมีควัน ทำให้เห็นภาพอาหารนี้แล้วหิวไปเลย</textarea>
            </div>

            <!-- Model selector -->
            <div style="margin-bottom:12px">
              <div style="font-size:11px;font-weight:700;color:var(--muted);text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px">3. เลือกโหมด</div>
              <div style="display:grid;grid-template-columns:1fr 1fr;gap:8px">
                <label id="model-card-fast" onclick="selectModel('fast')"
                       style="cursor:pointer;border:2px solid #005e97;border-radius:10px;padding:10px 12px;background:#f0f6ff;transition:all .2s">
                  <input type="radio" name="cover_model" value="gemini-3.1-flash-image-preview" checked style="display:none"/>
                  <div style="font-size:13px;font-weight:700;color:#005e97;margin-bottom:2px">⚡ เร็ว</div>
                  <div style="font-size:11px;color:var(--muted)">Nano Banana 2 — ~15-30 วิ</div>
                </label>
                <label id="model-card-pro" onclick="selectModel('pro')"
                       style="cursor:pointer;border:2px solid var(--border);border-radius:10px;padding:10px 12px;background:#fff;transition:all .2s">
                  <input type="radio" name="cover_model" value="gemini-3-pro-image-preview" style="display:none"/>
                  <div style="font-size:13px;font-weight:700;color:var(--text);margin-bottom:2px">🧠 คิด (Pro)</div>
                  <div style="font-size:11px;color:var(--muted)">Nano Banana Pro — ~30-90 วิ</div>
                </label>
              </div>
            </div>

            <!-- Gen button + timer -->
            <button type="button" id="btn-cover-gen" onclick="genCoverImage()"
                    style="display:flex;align-items:center;justify-content:center;gap:8px;width:100%;padding:10px;border-radius:8px;background:linear-gradient(135deg,#4285f4,#0f9d58);color:#fff;border:none;cursor:pointer;font-size:13px;font-weight:700;font-family:inherit;transition:opacity .2s">
              ✨ Gen ภาพปก
            </button>

            <!-- Status + timer -->
            <div id="cover-gen-status" style="display:none;margin-top:8px;text-align:center">
              <div id="cover-status-text" style="font-size:12px;color:var(--muted);margin-bottom:4px"></div>
              <div id="cover-timer-wrap" style="display:none;align-items:center;justify-content:center;gap:8px">
                <div style="height:3px;flex:1;background:var(--border);border-radius:99px;overflow:hidden">
                  <div id="cover-timer-bar" style="height:100%;background:linear-gradient(90deg,#4285f4,#0f9d58);width:0%;transition:width .5s linear"></div>
                </div>
                <span id="cover-timer-text" style="font-size:11px;font-weight:700;color:#005e97;min-width:32px;text-align:right">0s</span>
              </div>
            </div>

            <!-- Result -->
            <div id="cover-gen-result" style="display:none;margin-top:14px">
              <div style="font-size:11px;font-weight:700;color:var(--muted);text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px">3. ผลลัพธ์ — ถ้าชอบกด "ใช้ภาพนี้"</div>
              <img id="cover-gen-img" style="max-width:100%;border-radius:10px;border:1px solid var(--border);display:block"/>
              <button type="button" onclick="useCoverImage()"
                      style="margin-top:8px;width:100%;padding:8px;border-radius:8px;background:#005e97;color:#fff;border:none;cursor:pointer;font-size:12px;font-weight:700;font-family:inherit">
                ✓ ใช้ภาพนี้เป็นภาพปกรีวิว
              </button>
              <div id="cover-used-notice" style="display:none;margin-top:6px;padding:6px 10px;border-radius:6px;background:#e8f5e9;color:#00665a;font-size:12px;font-weight:600">
                ✓ เลือกภาพนี้แล้ว จะถูกบันทึกเมื่อกด "บันทึก"
              </div>
            </div>

          </div>
          <input type="hidden" name="cover_image_hidden_ai" id="cover-image-hidden-ai" value="">
        </div>

      </div>
      <div class="form-group form-full">
        <label>เนื้อหารีวิว <span style="color:var(--muted);font-weight:400;font-size:11px">— แทรกภาพในเนื้อหาได้ผ่าน Froala</span></label>
        <textarea id="review-body" name="body"><?php echo ($is_edit && isset($review)) ? $review->body : ''; ?></textarea>
      </div>

      <!-- AI Summarize -->
      <div class="form-group form-full">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:6px">
          <label style="margin:0">สรุปสั้นๆ (Excerpt) <span style="color:var(--muted);font-weight:400;font-size:11px">— แสดงในหน้า list</span></label>
          <button type="button" id="btn-ai-summarize"
                  style="display:flex;align-items:center;gap:6px;padding:5px 14px;border-radius:8px;background:linear-gradient(135deg,#4285f4,#0f9d58);color:#fff;border:none;cursor:pointer;font-size:12px;font-weight:700;font-family:inherit;transition:opacity .2s"
                  onmouseover="this.style.opacity='.85'" onmouseout="this.style.opacity='1'"
                  onclick="aiSummarize()">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="white"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 14.5v-9l6 4.5-6 4.5z"/></svg>
            สรุปด้วย Gemini AI
          </button>
        </div>
        <textarea name="excerpt" id="review-excerpt" class="form-control" rows="3"
                  placeholder="กด 'สรุปด้วย Gemini AI' เพื่อให้ AI ช่วยสรุป หรือพิมพ์เองได้เลย"><?php echo ($is_edit && isset($review) && !empty($review->excerpt)) ? htmlspecialchars($review->excerpt) : ''; ?></textarea>
        <div id="ai-status" style="font-size:12px;color:var(--muted);margin-top:4px;display:none"></div>
      </div>
      <div class="form-group">
        <label>Link วิดีโอ TikTok / YouTube</label>
        <input type="text" name="video_url" placeholder="https://tiktok.com/... หรือ https://youtube.com/..."
               value="<?php echo ($is_edit && isset($review)) ? $review->video_url : ''; ?>">
      </div>
    </div>
  </div>

  <!-- ส่วนที่ 4: ตั้งค่า -->
  <div class="form-section">
    <div class="form-section-title">4 — ตั้งค่า</div>
    <div class="form-grid">
      <div class="form-group">
        <label>เขียนโดย Influencer</label>
        <select name="influencer_id">
          <option value="">-- เลือก Influencer --</option>
          <?php if ($influencerList): foreach ($influencerList as $inf): ?>
          <option value="<?php echo $inf->influencer_id; ?>"
            <?php echo ($is_edit && isset($review) && $review->influencer_id == $inf->influencer_id) ? 'selected' : ''; ?>>
            <?php echo $inf->display_name; ?>
          </option>
          <?php endforeach; endif; ?>
        </select>
      </div>
      <div class="form-group">
        <label>สถานะรีวิว</label>
        <select name="review_status">
          <option value="pending"       <?php echo ($is_edit && isset($review) && $review->status == 'pending')       ? 'selected' : ''; ?>>pending (รอ approve)</option>
          <option value="approved"      <?php echo ($is_edit && isset($review) && $review->status == 'approved')      ? 'selected' : ''; ?>>approved</option>
          <option value="approved_seal" <?php echo ($is_edit && isset($review) && $review->status == 'approved_seal') ? 'selected' : ''; ?>>approved + seal of approval</option>
        </select>
      </div>
    </div>
  </div>

  <div class="form-footer">
    <a href="<?php echo base_url('cms/place'); ?>" class="btn btn-ghost">ยกเลิก</a>
    <button type="submit" class="btn btn-primary">บันทึกร้านค้าและรีวิว</button>
  </div>

</form>

<script src="<?php echo base_url(); ?>froala_editor/js/froala_editor.pkgd.min.js"></script>
<script>
new FroalaEditor('#review-body', {
    key: '2J1B10dA5B4F4C3A3C3I3C-22VKOG1FGULVKHXDXNDXc2a1Kd1SNdF3H3A8B5D4A3C3E3B2A13==',
    heightMin: 300,
    imageUploadURL: '<?php echo base_url('upload_image.php'); ?>',
    imageUploadParams: {
        id: 'my_editor'
    }
});

// ── Cover Image Tab ───────────────────────────────────
var coverRefImages = []; // { dataUrl, mime }
var coverTimerInterval = null;
var coverSelectedModel = 'fast';

function switchCoverTab(tab) {
  var isUpload = tab === 'upload';
  document.getElementById('cover-tab-upload').style.display = isUpload ? 'block' : 'none';
  document.getElementById('cover-tab-ai').style.display     = isUpload ? 'none' : 'block';
  document.getElementById('tab-upload').style.background    = isUpload ? '#005e97' : 'var(--bg2)';
  document.getElementById('tab-upload').style.color         = isUpload ? '#fff' : 'var(--muted)';
  document.getElementById('tab-ai').style.background        = isUpload ? 'var(--bg2)' : '#005e97';
  document.getElementById('tab-ai').style.color             = isUpload ? 'var(--muted)' : '#fff';
}

function selectModel(type) {
  coverSelectedModel = type;
  var fastCard = document.getElementById('model-card-fast');
  var proCard  = document.getElementById('model-card-pro');
  if (type === 'fast') {
    fastCard.style.borderColor = '#005e97'; fastCard.style.background = '#f0f6ff';
    fastCard.querySelector('div').style.color = '#005e97';
    proCard.style.borderColor  = 'var(--border)'; proCard.style.background = '#fff';
    proCard.querySelector('div').style.color = 'var(--text)';
  } else {
    proCard.style.borderColor  = '#9b4500'; proCard.style.background = '#fff8f0';
    proCard.querySelector('div').style.color = '#9b4500';
    fastCard.style.borderColor = 'var(--border)'; fastCard.style.background = '#fff';
    fastCard.querySelector('div').style.color = 'var(--text)';
  }
}

function coverDragOver(e) { e.preventDefault(); document.getElementById('cover-dropzone').style.borderColor = '#005e97'; document.getElementById('cover-dropzone').style.background = '#f0f6ff'; }
function coverDragLeave(e) { document.getElementById('cover-dropzone').style.borderColor = 'var(--border)'; document.getElementById('cover-dropzone').style.background = '#fff'; }
function coverDrop(e) { e.preventDefault(); coverDragLeave(e); addCoverFiles(e.dataTransfer.files); }
function coverFileSelect(input) { addCoverFiles(input.files); input.value = ''; }

function addCoverFiles(files) {
  Array.from(files).forEach(function(file) {
    if (coverRefImages.length >= 5) return;
    if (!file.type.startsWith('image/')) return;
    var reader = new FileReader();
    reader.onload = function(e) {
      coverRefImages.push({ dataUrl: e.target.result, mime: file.type });
      renderCoverThumbs();
    };
    reader.readAsDataURL(file);
  });
}

function renderCoverThumbs() {
  var list = document.getElementById('cover-thumb-list');
  list.innerHTML = coverRefImages.map(function(img, i) {
    return '<div style="position:relative;width:64px;height:64px;border-radius:8px;overflow:hidden;border:1px solid var(--border);flex-shrink:0">' +
      '<img src="' + img.dataUrl + '" style="width:100%;height:100%;object-fit:cover"/>' +
      '<button type="button" onclick="removeCoverThumb(' + i + ')" style="position:absolute;top:2px;right:2px;width:16px;height:16px;border-radius:50%;background:rgba(0,0,0,.65);border:none;color:#fff;font-size:9px;cursor:pointer;line-height:1;padding:0">✕</button>' +
    '</div>';
  }).join('');
}

function removeCoverThumb(i) { coverRefImages.splice(i, 1); renderCoverThumbs(); }

function startCoverTimer(maxSec) {
  var elapsed  = 0;
  var timerWrap = document.getElementById('cover-timer-wrap');
  var timerBar  = document.getElementById('cover-timer-bar');
  var timerText = document.getElementById('cover-timer-text');
  timerWrap.style.display = 'flex';
  timerBar.style.width = '0%';
  clearInterval(coverTimerInterval);
  coverTimerInterval = setInterval(function() {
    elapsed++;
    timerText.textContent = elapsed + 's';
    timerBar.style.width  = Math.min((elapsed / maxSec) * 100, 95) + '%';
  }, 1000);
}

function stopCoverTimer(elapsed) {
  clearInterval(coverTimerInterval);
  document.getElementById('cover-timer-bar').style.width = '100%';
  document.getElementById('cover-timer-text').textContent = elapsed + 's ✓';
}

function genCoverImage() {
  var prompt  = document.getElementById('ai-cover-prompt').value.trim();
  var btn     = document.getElementById('btn-cover-gen');
  var statusWrap = document.getElementById('cover-gen-status');
  var statusText = document.getElementById('cover-status-text');

  if (coverRefImages.length === 0) {
    statusWrap.style.display = 'block';
    statusText.style.color   = 'var(--danger)';
    statusText.textContent   = 'กรุณาอัปโหลดรูปอ้างอิงก่อนครับ';
    document.getElementById('cover-timer-wrap').style.display = 'none';
    return;
  }

  var modelId  = coverSelectedModel === 'pro' ? 'gemini-3-pro-image-preview' : 'gemini-3.1-flash-image-preview';
  var maxSec   = coverSelectedModel === 'pro' ? 90 : 30;
  var startTime = Date.now();

  btn.disabled = true; btn.textContent = '⏳ กำลัง Gen...';
  statusWrap.style.display = 'block';
  statusText.style.color   = 'var(--muted)';
  statusText.textContent   = coverSelectedModel === 'pro'
    ? '🧠 Nano Banana Pro กำลังคิด อาจใช้เวลา 30-90 วินาที...'
    : '⚡ Nano Banana 2 กำลัง Gen อาจใช้เวลา 15-30 วินาที...';
  document.getElementById('cover-gen-result').style.display  = 'none';
  document.getElementById('cover-used-notice').style.display = 'none';

  startCoverTimer(maxSec);

  var images = coverRefImages.map(function(img) {
    return { data: img.dataUrl.split(',')[1], mime: img.mime };
  });

  $.ajax({
    type: 'POST', url: '<?php echo base_url("cms/ai/cover-gen"); ?>',
    data: { images: images, prompt: prompt, model: modelId },
    dataType: 'json',
    success: function(res) {
      var elapsed = Math.round((Date.now() - startTime) / 1000);
      stopCoverTimer(elapsed);
      if (res.success) {
        document.getElementById('cover-gen-img').src = '<?php echo base_url(); ?>' + res.path;
        document.getElementById('cover-gen-img').dataset.path = res.path;
        document.getElementById('cover-gen-result').style.display = 'block';
        statusText.style.color = '#00665a';
        statusText.textContent = '✓ Gen เสร็จใน ' + elapsed + ' วินาที';
      } else {
        statusText.style.color = 'var(--danger)';
        statusText.textContent = '✕ ' + (res.error || 'เกิดข้อผิดพลาด');
      }
    },
    error: function() {
      stopCoverTimer(0);
      statusText.style.color = 'var(--danger)';
      statusText.textContent = '✕ เชื่อมต่อ server ไม่ได้';
    },
    complete: function() { btn.disabled = false; btn.textContent = '✨ Gen ภาพปก'; }
  });
}

function useCoverImage() {
  var img = document.getElementById('cover-gen-img');
  document.getElementById('cover-image-hidden-ai').value = img.dataset.path;
  var fileInput = document.querySelector('input[name="cover_image"]');
  if (fileInput) fileInput.disabled = true;
  document.getElementById('cover-used-notice').style.display = 'block';
}
function aiGenTitle() {
  var baseUrl   = '<?php echo base_url(); ?>';
  var placeName = document.querySelector('input[name="name"]')?.value || '';
  var dish      = document.querySelector('input[name="signature_dish_name"]')?.value || '';
  var body      = document.querySelector('#review-body + .fr-box .fr-element')
                    ? document.querySelector('#review-body + .fr-box .fr-element').innerHTML
                    : document.getElementById('review-body').value;
  var statusEl  = document.getElementById('ai-title-status');
  var panel     = document.getElementById('ai-title-panel');
  var btn       = document.getElementById('btn-gen-title');

  if (!body.replace(/<[^>]+>/g,'').trim() && !placeName) {
    statusEl.style.display = 'block';
    statusEl.style.color   = 'var(--danger)';
    statusEl.textContent   = 'กรุณากรอกเนื้อหารีวิวหรือชื่อร้านก่อนครับ';
    return;
  }

  btn.disabled        = true;
  btn.style.opacity   = '.6';
  btn.textContent     = '⏳ กำลัง Gen...';
  statusEl.style.display = 'none';
  panel.style.display    = 'none';

  $.ajax({
    type: 'POST',
    url:  baseUrl + 'cms/ai/gen-title',
    data: { place_name: placeName, dish: dish, body: body },
    dataType: 'json',
    success: function(res) {
      if (res.success && res.titles && res.titles.length) {
        renderTitlePanel(res.titles);
      } else {
        statusEl.style.display = 'block';
        statusEl.style.color   = 'var(--danger)';
        statusEl.textContent   = '✕ ' + (res.error || 'เกิดข้อผิดพลาด');
      }
    },
    error: function() {
      statusEl.style.display = 'block';
      statusEl.style.color   = 'var(--danger)';
      statusEl.textContent   = '✕ เชื่อมต่อ server ไม่ได้';
    },
    complete: function() {
      btn.disabled      = false;
      btn.style.opacity = '1';
      btn.textContent   = '✨ AI Gen Title';
    }
  });
}

function renderTitlePanel(titles) {
  var list  = document.getElementById('ai-title-list');
  var panel = document.getElementById('ai-title-panel');

  list.innerHTML = titles.map(function(t) {
    var len   = t.length;
    var color = len <= 60 ? '#00665a' : len <= 70 ? '#9b4500' : 'var(--danger)';
    var badge = len <= 60 ? '✓ SEO ดี' : len <= 70 ? '⚠ ยาวนิดหน่อย' : '✕ ยาวเกิน';
    return '<div onclick="selectTitle(\'' + t.replace(/'/g,"\\'") + '\')" ' +
      'style="cursor:pointer;padding:10px 14px;border-radius:8px;border:1px solid #e5e7eb;background:#fff;transition:all .15s" ' +
      'onmouseover="this.style.borderColor=\'#005e97\';this.style.background=\'#f0f6ff\'" ' +
      'onmouseout="this.style.borderColor=\'#e5e7eb\';this.style.background=\'#fff\'">' +
        '<div style="font-size:13px;font-weight:600;color:#191c1d;margin-bottom:3px">' + t + '</div>' +
        '<div style="font-size:10px;font-weight:700;color:' + color + '">' + len + ' ตัวอักษร — ' + badge + '</div>' +
    '</div>';
  }).join('');

  // slide down
  panel.style.display  = 'block';
  panel.style.maxHeight = '0';
  panel.style.overflow  = 'hidden';
  panel.style.transition = 'max-height .35s ease';
  setTimeout(function() { panel.style.maxHeight = '600px'; }, 10);
}

function selectTitle(title) {
  document.getElementById('review-title').value = title;
  // slide up panel
  var panel = document.getElementById('ai-title-panel');
  panel.style.maxHeight = '0';
  setTimeout(function() { panel.style.display = 'none'; }, 350);
  var statusEl = document.getElementById('ai-title-status');
  statusEl.style.display = 'block';
  statusEl.style.color   = '#00665a';
  statusEl.textContent   = '✓ เลือก Title แล้ว แก้ไขได้ตามต้องการ';
}

function aiSummarize() {
  var btn    = document.getElementById('btn-ai-summarize');
  var status = document.getElementById('ai-status');
  var output = document.getElementById('review-excerpt');

  // ดึงเนื้อหาจาก Froala
  var body = document.querySelector('#review-body + .fr-box .fr-element')
               ? document.querySelector('#review-body + .fr-box .fr-element').innerHTML
               : document.getElementById('review-body').value;

  if (!body || body.replace(/<[^>]+>/g,'').trim().length < 20) {
    status.style.display = 'block';
    status.style.color   = 'var(--danger)';
    status.textContent   = 'กรุณากรอกเนื้อหารีวิวก่อนนะครับ';
    return;
  }

  btn.disabled        = true;
  btn.style.opacity   = '.6';
  status.style.display = 'block';
  status.style.color   = 'var(--muted)';
  status.textContent   = '⏳ Gemini กำลังสรุป...';

  $.ajax({
    type:     'POST',
    url:      '<?php echo base_url("cms/ai/summarize"); ?>',
    data:     { body: body },
    dataType: 'json',
    success: function(res) {
      if (res.success) {
        output.value         = res.summary;
        status.style.color   = '#00665a';
        status.textContent   = '✓ สรุปเสร็จแล้ว สามารถแก้ไขได้ตามต้องการครับ';
      } else {
        status.style.color   = 'var(--danger)';
        status.textContent   = '✕ ' + (res.error || 'เกิดข้อผิดพลาด');
        if (res.raw) console.log('Gemini raw:', res.raw);
      }
    },
    error: function() {
      status.style.color   = 'var(--danger)';
      status.textContent   = '✕ เชื่อมต่อ server ไม่ได้';
    },
    complete: function() {
      btn.disabled      = false;
      btn.style.opacity = '1';
    }
  });
}
</script>
