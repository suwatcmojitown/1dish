<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<style>
.ig-wrap        { max-width: 960px; margin: 0 auto; }
.ig-header      { display:flex;align-items:center;gap:12px;margin-bottom:28px }
.ig-badge       { display:inline-flex;align-items:center;gap:6px;padding:4px 12px;border-radius:999px;background:linear-gradient(135deg,#4285f4,#0f9d58);color:#fff;font-size:11px;font-weight:700 }
.ig-grid        { display:grid;grid-template-columns:1fr 1fr;gap:20px }
.ig-panel       { background:#fff;border-radius:16px;border:1px solid var(--border);padding:20px }
.ig-label       { font-size:11px;font-weight:700;color:var(--muted);text-transform:uppercase;letter-spacing:.06em;margin-bottom:6px }
.ig-dropzone    { border:2px dashed var(--border);border-radius:12px;padding:24px;text-align:center;cursor:pointer;transition:all .2s;min-height:120px;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:8px }
.ig-dropzone:hover,.ig-dropzone.drag-over { border-color:#005e97;background:#f0f6ff }
.ig-thumb-list  { display:flex;flex-wrap:wrap;gap:8px;margin-top:10px }
.ig-thumb       { position:relative;width:72px;height:72px;border-radius:8px;overflow:hidden;border:1px solid var(--border) }
.ig-thumb img   { width:100%;height:100%;object-fit:cover }
.ig-thumb-del   { position:absolute;top:2px;right:2px;width:18px;height:18px;border-radius:50%;background:rgba(0,0,0,.65);border:none;color:#fff;font-size:10px;cursor:pointer;display:flex;align-items:center;justify-content:center;line-height:1 }
.ig-result-grid { display:grid;grid-template-columns:repeat(2,1fr);gap:12px;margin-top:12px }
.ig-result-img  { position:relative;border-radius:10px;overflow:hidden;background:var(--bg3) }
.ig-result-img img { width:100%;display:block }
.ig-result-actions { position:absolute;bottom:0;left:0;right:0;padding:8px;background:linear-gradient(to top,rgba(0,0,0,.7),transparent);display:flex;gap:6px;opacity:0;transition:opacity .2s }
.ig-result-img:hover .ig-result-actions { opacity:1 }
.ig-btn-use     { flex:1;padding:5px;border-radius:6px;background:#005e97;color:#fff;border:none;font-size:11px;font-weight:700;cursor:pointer }
.ig-btn-dl      { padding:5px 8px;border-radius:6px;background:rgba(255,255,255,.2);color:#fff;border:none;font-size:11px;cursor:pointer }
.ig-loading     { display:none;flex-direction:column;align-items:center;justify-content:center;padding:48px;gap:16px;color:var(--muted) }
.ig-spinner     { width:40px;height:40px;border:3px solid var(--border);border-top-color:#005e97;border-radius:50%;animation:spin .8s linear infinite }
@keyframes spin { to { transform:rotate(360deg) } }
.ig-empty       { text-align:center;padding:48px;color:var(--muted) }
.ig-prompt      { width:100%;border:1px solid var(--border);border-radius:10px;padding:12px;font-size:13px;font-family:inherit;resize:vertical;min-height:100px;background:var(--bg2);color:var(--text) }
.ig-prompt:focus { outline:none;border-color:#005e97 }
.ig-select      { width:100%;border:1px solid var(--border);border-radius:8px;padding:8px 10px;font-size:13px;background:var(--bg2);color:var(--text) }
.ig-gen-btn     { width:100%;padding:13px;border-radius:12px;background:linear-gradient(135deg,#4285f4,#0f9d58);color:#fff;border:none;font-size:14px;font-weight:700;cursor:pointer;transition:opacity .2s;margin-top:16px;font-family:inherit }
.ig-gen-btn:hover   { opacity:.88 }
.ig-gen-btn:disabled { opacity:.5;cursor:not-allowed }
.ig-tip         { font-size:11px;color:var(--muted);line-height:1.6;margin-top:8px }
.ig-saved-notice { display:none;margin-top:10px;padding:8px 12px;border-radius:8px;background:#e8f5e9;color:#00665a;font-size:12px;font-weight:600 }
@media(max-width:720px){ .ig-grid,.ig-result-grid { grid-template-columns:1fr } }
</style>

<div class="ig-wrap">

  <!-- Header -->
  <div class="ig-header">
    <div>
      <h2 style="font-size:20px;font-weight:800;margin:0 0 4px 0">AI Image Generator</h2>
      <p style="font-size:13px;color:var(--muted);margin:0">สร้างภาพด้วย Gemini Nano Banana 2 — ใส่ prompt และรูปอ้างอิง แล้วให้ AI gen ให้เลย</p>
    </div>
    <span class="ig-badge">✨ Nano Banana 2</span>
  </div>

  <div class="ig-grid">

    <!-- LEFT: Input -->
    <div style="display:flex;flex-direction:column;gap:16px">

      <!-- Upload reference images -->
      <div class="ig-panel">
        <div class="ig-label">📎 ภาพอ้างอิง (ไม่บังคับ)</div>
        <div class="ig-dropzone" id="dropzone" onclick="document.getElementById('file-input').click()"
             ondragover="onDragOver(event)" ondragleave="onDragLeave(event)" ondrop="onDrop(event)">
          <svg width="28" height="28" fill="none" stroke="var(--muted)" stroke-width="1.5" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="3"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/></svg>
          <span style="font-size:13px;color:var(--muted)">คลิกหรือลากภาพมาวางที่นี่</span>
          <span style="font-size:11px;color:var(--muted)">JPG, PNG — สูงสุด 5 ภาพ</span>
        </div>
        <input type="file" id="file-input" accept="image/*" multiple style="display:none" onchange="onFileSelect(this)"/>
        <div class="ig-thumb-list" id="thumb-list"></div>
      </div>

      <!-- Prompt -->
      <div class="ig-panel">
        <div class="ig-label">✍️ Prompt</div>
        <textarea class="ig-prompt" id="prompt-input" placeholder="เช่น: ภาพอาหารทะเลสดในบรรยากาศริมทะเลระยอง แสงอาทิตย์ยามเย็น สีโทนอบอุ่น ดูน่ากิน สไตล์ editorial photography"></textarea>
        <div class="ig-tip">💡 เคล็ดลับ: ระบุสไตล์ภาพ, แสง, สี, บรรยากาศ ยิ่งละเอียดยิ่งดี</div>

        <!-- Prompt presets -->
        <div style="margin-top:10px;display:flex;flex-wrap:wrap;gap:6px">
          <?php
          $presets = array(
            'อาหารทะเลริมทะเล' => 'ภาพอาหารทะเลสดบนโต๊ะไม้ริมชายหาดระยอง แสงธรรมชาติยามเย็น บรรยากาศอบอุ่น สไตล์ editorial food photography',
            'ร้านคาเฟ่สวย'     => 'ร้านคาเฟ่บรรยากาศอบอุ่น มีแสงธรรมชาติ ต้นไม้เขียวขจี กาแฟลาเต้อาร์ต สไตล์ lifestyle photography',
            'ของหวานไทย'        => 'ของหวานไทยสีสดใส ขนมหวานไทยโบราณจัดวางสวยงาม พื้นหลังสะอาด สไตล์ product photography',
            'วิวทะเลระยอง'      => 'วิวทะเลระยองสีฟ้าใส หาดทรายขาว ต้นมะพร้าว แสงอาทิตย์ยามเช้า บรรยากาศสงบ',
          );
          foreach ($presets as $label => $text):
          ?>
          <button type="button" onclick="setPrompt(<?php echo htmlspecialchars(json_encode($text)); ?>)"
                  style="padding:4px 10px;border-radius:999px;border:1px solid var(--border);background:var(--bg2);font-size:11px;cursor:pointer;color:var(--text);font-family:inherit;transition:all .15s"
                  onmouseover="this.style.borderColor='#005e97';this.style.color='#005e97'"
                  onmouseout="this.style.borderColor='var(--border)';this.style.color='var(--text)'">
            <?php echo $label; ?>
          </button>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- Settings -->
      <div class="ig-panel">
        <div class="ig-label">⚙️ ตั้งค่า</div>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px">
          <div>
            <div style="font-size:12px;font-weight:600;margin-bottom:4px">สัดส่วน</div>
            <select class="ig-select" id="aspect-ratio">
              <option value="4:3">4:3 — ทั่วไป</option>
              <option value="16:9">16:9 — Widescreen</option>
              <option value="1:1">1:1 — Square</option>
              <option value="3:4">3:4 — Portrait</option>
              <option value="9:16">9:16 — Story</option>
            </select>
          </div>
          <div>
            <div style="font-size:12px;font-weight:600;margin-bottom:4px">ขนาด</div>
            <select class="ig-select" id="image-size">
              <option value="1K">1K — เร็ว</option>
              <option value="2K">2K — คุณภาพดี</option>
            </select>
          </div>
        </div>
      </div>

      <button class="ig-gen-btn" id="gen-btn" onclick="generateImage()">
        ✨ สร้างภาพด้วย AI
      </button>

    </div>

    <!-- RIGHT: Result -->
    <div class="ig-panel" style="min-height:400px;display:flex;flex-direction:column">
      <div class="ig-label">🖼 ผลลัพธ์</div>

      <!-- Empty state -->
      <div class="ig-empty" id="result-empty">
        <svg width="48" height="48" fill="none" stroke="var(--border)" stroke-width="1.5" viewBox="0 0 24 24" style="margin-bottom:12px"><rect x="3" y="3" width="18" height="18" rx="3"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/></svg>
        <p style="font-size:14px;font-weight:600;margin:0 0 4px 0">ยังไม่มีภาพ</p>
        <p style="font-size:12px;margin:0">กรอก prompt แล้วกด "สร้างภาพ"</p>
      </div>

      <!-- Loading -->
      <div class="ig-loading" id="result-loading">
        <div class="ig-spinner"></div>
        <p style="font-size:13px;font-weight:600;margin:0">Gemini กำลังสร้างภาพ...</p>
        <p style="font-size:11px;color:var(--muted);margin:0">อาจใช้เวลา 10-30 วินาที</p>
      </div>

      <!-- Results -->
      <div id="result-area" style="display:none;flex:1;flex-direction:column">
        <div id="result-text" style="font-size:12px;color:var(--muted);margin-bottom:8px;display:none"></div>
        <div class="ig-result-grid" id="result-grid"></div>
        <div class="ig-saved-notice" id="saved-notice">✓ บันทึกภาพแล้ว สามารถนำไปใช้เป็น cover image ได้เลย</div>
        <button type="button" onclick="generateImage()" style="margin-top:12px;padding:8px;border-radius:8px;border:1.5px solid #005e97;background:transparent;color:#005e97;font-size:12px;font-weight:700;cursor:pointer;font-family:inherit">
          🔄 Gen ใหม่อีกครั้ง
        </button>
      </div>
    </div>

  </div>
</div>

<script>
var baseUrl  = '<?php echo base_url(); ?>';
var refImages = []; // { file, dataUrl, mime }

// ── Drag & Drop ─────────────────────────────────────────
function onDragOver(e) {
  e.preventDefault();
  document.getElementById('dropzone').classList.add('drag-over');
}
function onDragLeave(e) {
  document.getElementById('dropzone').classList.remove('drag-over');
}
function onDrop(e) {
  e.preventDefault();
  document.getElementById('dropzone').classList.remove('drag-over');
  addFiles(e.dataTransfer.files);
}
function onFileSelect(input) {
  addFiles(input.files);
  input.value = '';
}

function addFiles(files) {
  Array.from(files).forEach(function(file) {
    if (refImages.length >= 5) return;
    if (!file.type.startsWith('image/')) return;
    var reader = new FileReader();
    reader.onload = function(e) {
      refImages.push({ dataUrl: e.target.result, mime: file.type, name: file.name });
      renderThumbs();
    };
    reader.readAsDataURL(file);
  });
}

function renderThumbs() {
  var list = document.getElementById('thumb-list');
  list.innerHTML = refImages.map(function(img, i) {
    return '<div class="ig-thumb">' +
      '<img src="' + img.dataUrl + '"/>' +
      '<button class="ig-thumb-del" onclick="removeThumb(' + i + ')">✕</button>' +
    '</div>';
  }).join('');
}

function removeThumb(i) {
  refImages.splice(i, 1);
  renderThumbs();
}

// ── Prompt preset ────────────────────────────────────────
function setPrompt(text) {
  document.getElementById('prompt-input').value = text;
}

// ── Generate ─────────────────────────────────────────────
function generateImage() {
  var prompt = document.getElementById('prompt-input').value.trim();
  if (!prompt) {
    alert('กรุณากรอก prompt ก่อนนะครับ');
    return;
  }

  // show loading
  document.getElementById('result-empty').style.display   = 'none';
  document.getElementById('result-area').style.display    = 'none';
  document.getElementById('result-loading').style.display = 'flex';
  document.getElementById('gen-btn').disabled = true;
  document.getElementById('saved-notice').style.display = 'none';

  // เตรียม images payload
  var images = refImages.map(function(img) {
    var b64 = img.dataUrl.split(',')[1];
    return { data: b64, mime: img.mime };
  });

  $.ajax({
    type:     'POST',
    url:      baseUrl + 'cms/ai/imagegen/gen',
    data:     {
      prompt:       prompt,
      aspect_ratio: document.getElementById('aspect-ratio').value,
      image_size:   document.getElementById('image-size').value,
      images:       images,
    },
    dataType: 'json',
    success: function(res) {
      document.getElementById('result-loading').style.display = 'none';
      document.getElementById('gen-btn').disabled = false;

      if (res.success && res.images.length) {
        renderResults(res.images, res.text);
      } else {
        document.getElementById('result-empty').style.display = 'flex';
        alert('เกิดข้อผิดพลาด: ' + (res.error || 'ไม่ทราบสาเหตุ'));
      }
    },
    error: function() {
      document.getElementById('result-loading').style.display = 'none';
      document.getElementById('result-empty').style.display   = 'flex';
      document.getElementById('gen-btn').disabled = false;
      alert('เชื่อมต่อ server ไม่ได้');
    }
  });
}

function renderResults(images, text) {
  var grid = document.getElementById('result-grid');
  grid.innerHTML = images.map(function(path) {
    return '<div class="ig-result-img">' +
      '<img src="' + baseUrl + path + '" alt="AI Generated"/>' +
      '<div class="ig-result-actions">' +
        '<button class="ig-btn-use" onclick="saveAsCover(\'' + path + '\')">💾 ใช้เป็น Cover</button>' +
        '<a class="ig-btn-dl" href="' + baseUrl + path + '" download>⬇</a>' +
      '</div>' +
    '</div>';
  }).join('');

  if (text) {
    var textEl = document.getElementById('result-text');
    textEl.textContent = text;
    textEl.style.display = 'block';
  }

  document.getElementById('result-area').style.display = 'flex';
}

function saveAscover(path) {
  // คัดลอก path ไปยัง clipboard
  navigator.clipboard.writeText(path).then(function() {
    document.getElementById('saved-notice').style.display = 'block';
  }).catch(function() {
    document.getElementById('saved-notice').style.display = 'block';
  });
}
</script>
