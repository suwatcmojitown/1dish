<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div style="display:grid;grid-template-columns:1fr 380px;gap:20px;align-items:start">

  <!-- ฝั่งซ้าย: ร้านที่เลือกแล้ว -->
  <div>
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px">
      <div style="display:flex;align-items:center;gap:8px">
        <span style="font-weight:600;font-size:14px"><?php echo $shelf_label; ?></span>
        <span id="selected-count" class="badge badge-blue">0</span>
      </div>
      <button onclick="clearAll()" class="btn btn-ghost btn-sm" style="color:var(--danger)">ล้างทั้งหมด</button>
    </div>

    <div id="selected-zone"
         class="card"
         style="min-height:420px;padding:12px"
         ondragover="onDragOver(event)" ondragleave="onDragLeave(event)" ondrop="onDrop(event)">

      <div id="empty-state" style="display:<?php echo empty($shelf) ? 'flex' : 'none'; ?>;flex-direction:column;align-items:center;justify-content:center;height:300px;color:var(--muted)">
        <svg width="48" height="48" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" style="margin-bottom:12px;opacity:.3"><rect x="3" y="3" width="18" height="18" rx="3"/><path d="M12 8v8M8 12h8"/></svg>
        <p style="font-size:14px;font-weight:500">ยังไม่มีร้านที่เลือก</p>
        <p style="font-size:12px;margin-top:4px">กด Select จากรายการด้านขวา</p>
      </div>

      <!-- ร้านที่ถูกเลือกอยู่แล้วจาก DB -->
      <?php if ($shelf): foreach ($shelf as $item): ?>
      <div class="shelf-card" data-id="<?php echo $item->place_id; ?>" draggable="true"
           style="display:flex;align-items:center;gap:12px;background:var(--bg2);border:1px solid var(--border);border-radius:10px;padding:10px 12px;margin-bottom:8px;cursor:grab">
        <svg width="16" height="16" fill="none" stroke="var(--border)" stroke-width="2" viewBox="0 0 24 24" style="flex-shrink:0"><circle cx="9" cy="5" r="1" fill="currentColor"/><circle cx="9" cy="12" r="1" fill="currentColor"/><circle cx="9" cy="19" r="1" fill="currentColor"/><circle cx="15" cy="5" r="1" fill="currentColor"/><circle cx="15" cy="12" r="1" fill="currentColor"/><circle cx="15" cy="19" r="1" fill="currentColor"/></svg>
        <?php if (!empty($item->shop_image)): ?>
        <img src="<?php echo base_url($item->shop_image); ?>" style="width:44px;height:44px;border-radius:8px;object-fit:cover;flex-shrink:0"/>
        <?php else: ?>
        <div style="width:44px;height:44px;border-radius:8px;background:var(--bg3);display:flex;align-items:center;justify-content:center;flex-shrink:0;font-size:20px">🍽️</div>
        <?php endif; ?>
        <div style="flex:1;min-width:0">
          <div style="font-weight:600;font-size:13px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis"><?php echo $item->place_name; ?></div>
          <div style="font-size:11px;color:var(--muted);margin-top:2px"><?php echo $item->category_name; ?></div>
        </div>
        <!-- Sponsored toggle -->
        <label style="display:flex;align-items:center;gap:5px;cursor:pointer;flex-shrink:0" title="ร้านโฆษณา">
          <input type="checkbox" class="sponsored-cb" data-id="<?php echo $item->place_id; ?>"
                 <?php echo $item->is_sponsored ? 'checked' : ''; ?>
                 style="width:14px;height:14px;cursor:pointer;accent-color:#9b4500"/>
          <span style="font-size:10px;font-weight:700;color:var(--muted);text-transform:uppercase;letter-spacing:.04em">AD</span>
        </label>
        <button onclick="removePlace(<?php echo $item->place_id; ?>)" class="icon-btn danger">
          <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
        </button>
      </div>
      <?php endforeach; endif; ?>

    </div>

    <div style="display:flex;gap:8px;margin-top:12px">
      <button onclick="saveShelf()" class="btn btn-primary" style="flex:1">
        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
        บันทึก Shelf
      </button>
    </div>
  </div>

  <!-- ฝั่งขวา: ค้นหาและเลือกร้าน -->
  <div class="card" style="overflow:hidden;padding:0">

    <!-- Filter + Search -->
    <div style="padding:14px;border-bottom:1px solid var(--border);display:flex;flex-direction:column;gap:8px">
      <select id="filter-category" onchange="searchPlaces()"
              style="width:100%;border:1px solid var(--border);border-radius:8px;padding:8px 12px;font-size:13px;font-family:'Sarabun',sans-serif;background:var(--bg2);color:var(--text)">
        <option value="">ทุกหมวดหมู่</option>
        <?php if ($categoryList): foreach ($categoryList as $cat): ?>
        <option value="<?php echo $cat->name; ?>"><?php echo $cat->name; ?></option>
        <?php endforeach; endif; ?>
      </select>
      <div style="position:relative">
        <input id="search-input" type="text" placeholder="ค้นหาชื่อร้าน..."
               oninput="searchPlaces()"
               style="width:100%;border:1px solid var(--border);border-radius:8px;padding:8px 36px 8px 12px;font-size:13px;font-family:'Sarabun',sans-serif;background:var(--bg2);outline:none"/>
        <svg width="15" height="15" fill="none" stroke="var(--muted)" stroke-width="2" viewBox="0 0 24 24"
             style="position:absolute;right:12px;top:50%;transform:translateY(-50%)"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
      </div>
    </div>

    <!-- Place List -->
    <div id="place-list" style="max-height:460px;overflow-y:auto;divide-y:1px solid var(--border)">
      <div style="text-align:center;padding:32px;color:var(--muted);font-size:13px">กำลังโหลด...</div>
    </div>

  </div>
</div>

<!-- Toast -->
<div id="toast" style="display:none;position:fixed;bottom:24px;right:24px;background:#1a1a1a;color:#fff;padding:12px 20px;border-radius:10px;font-size:13px;font-weight:500;z-index:999;box-shadow:0 4px 16px rgba(0,0,0,.2)"></div>

<script>
var selectedIds = [<?php if ($shelf): echo implode(',', array_column((array)$shelf, 'place_id')); endif; ?>];
var baseUrl     = '<?php echo base_url(); ?>';
var shelfType   = '<?php echo $shelf_type; ?>';
var searchTimer = null;

// ===== SEARCH =====
function searchPlaces() {
  clearTimeout(searchTimer);
  searchTimer = setTimeout(function() {
    var q        = document.getElementById('search-input').value;
    var category = document.getElementById('filter-category').value;
    var exclude  = selectedIds.join(',');

    $.ajax({
      url:      baseUrl + 'cms/shelf/search',
      data:     { q: q, category: category, exclude: exclude },
      success:  renderList,
      error:    function() { showToast('โหลดข้อมูลไม่สำเร็จ'); }
    });
  }, 300);
}

function renderList(places) {
  var list = document.getElementById('place-list');
  if (!places || places.length === 0) {
    list.innerHTML = '<div style="text-align:center;padding:32px;color:var(--muted);font-size:13px">ไม่พบร้านที่ค้นหา</div>';
    return;
  }
  list.innerHTML = places.map(function(p) {
    var img = p.shop_image
      ? '<img src="' + baseUrl + p.shop_image + '" style="width:44px;height:44px;border-radius:8px;object-fit:cover;flex-shrink:0"/>'
      : '<div style="width:44px;height:44px;border-radius:8px;background:var(--bg3);display:flex;align-items:center;justify-content:center;flex-shrink:0;font-size:20px">🍽️</div>';
    return '<div style="display:flex;align-items:center;gap:12px;padding:10px 14px;border-bottom:1px solid var(--border);cursor:pointer" onclick="selectPlace(' + p.place_id + ',\'' + escHtml(p.name) + '\',\'' + escHtml(p.shop_image || '') + '\',\'' + escHtml(p.category_name || '') + '\')">' +
      img +
      '<div style="flex:1;min-width:0">' +
        '<div style="font-weight:600;font-size:13px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">' + p.name + '</div>' +
        '<div style="font-size:11px;color:var(--muted);margin-top:2px">' + (p.category_name || '') + '</div>' +
      '</div>' +
      '<button onclick="event.stopPropagation();selectPlace(' + p.place_id + ',\'' + escHtml(p.name) + '\',\'' + escHtml(p.shop_image || '') + '\',\'' + escHtml(p.category_name || '') + '\')" ' +
        'style="flex-shrink:0;background:#e85d04;color:#fff;border:none;border-radius:6px;padding:5px 12px;font-size:12px;font-weight:600;cursor:pointer;font-family:\'Sarabun\',sans-serif">' +
        'Select' +
      '</button>' +
    '</div>';
  }).join('');
}

// ===== SELECT =====
function selectPlace(id, name, img, category) {
  if (selectedIds.indexOf(id) > -1) return;
  selectedIds.push(id);

  var zone  = document.getElementById('selected-zone');
  var empty = document.getElementById('empty-state');
  empty.style.display = 'none';

  var imgEl = img
    ? '<img src="' + baseUrl + img + '" style="width:44px;height:44px;border-radius:8px;object-fit:cover;flex-shrink:0"/>'
    : '<div style="width:44px;height:44px;border-radius:8px;background:var(--bg3);display:flex;align-items:center;justify-content:center;flex-shrink:0;font-size:20px">🍽️</div>';

  var card = document.createElement('div');
  card.className   = 'shelf-card';
  card.dataset.id  = id;
  card.draggable   = true;
  card.style.cssText = 'display:flex;align-items:center;gap:12px;background:var(--bg2);border:1px solid var(--border);border-radius:10px;padding:10px 12px;margin-bottom:8px;cursor:grab;animation:fadeIn .2s ease';
  card.innerHTML =
    '<svg width="16" height="16" fill="none" stroke="var(--border)" stroke-width="2" viewBox="0 0 24 24" style="flex-shrink:0"><circle cx="9" cy="5" r="1" fill="currentColor"/><circle cx="9" cy="12" r="1" fill="currentColor"/><circle cx="9" cy="19" r="1" fill="currentColor"/><circle cx="15" cy="5" r="1" fill="currentColor"/><circle cx="15" cy="12" r="1" fill="currentColor"/><circle cx="15" cy="19" r="1" fill="currentColor"/></svg>' +
    imgEl +
    '<div style="flex:1;min-width:0">' +
      '<div style="font-weight:600;font-size:13px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">' + name + '</div>' +
      '<div style="font-size:11px;color:var(--muted);margin-top:2px">' + category + '</div>' +
    '</div>' +
    '<button onclick="removePlace(' + id + ')" class="icon-btn danger">' +
      '<svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>' +
    '</button>';

  card.addEventListener('dragstart', onDragStart);
  zone.appendChild(card);
  updateCount();
  searchPlaces();
}

// ===== REMOVE =====
function removePlace(id) {
  selectedIds = selectedIds.filter(function(x) { return x !== id; });
  var card = document.querySelector('.shelf-card[data-id="' + id + '"]');
  if (card) card.remove();
  if (selectedIds.length === 0) {
    document.getElementById('empty-state').style.display = 'flex';
  }
  updateCount();
  searchPlaces();
}

function clearAll() {
  if (!confirm('ต้องการล้างทั้งหมดไหม?')) return;
  selectedIds = [];
  document.querySelectorAll('.shelf-card').forEach(function(el) { el.remove(); });
  document.getElementById('empty-state').style.display = 'flex';
  updateCount();
  searchPlaces();
}

// ===== SAVE =====
function saveShelf() {
  var sponsoredIds = [];
  document.querySelectorAll('.sponsored-cb:checked').forEach(function(cb) {
    sponsoredIds.push(parseInt(cb.dataset.id));
  });
  $.ajax({
    type:     'POST',
    url:      baseUrl + 'cms/shelf/save',
    data:     { place_ids: selectedIds, sponsored_ids: sponsoredIds, shelf_type: shelfType },
    dataType: 'json',
    success:  function(res) {
      showToast('✓ บันทึก Shelf เรียบร้อยแล้ว');
    },
    error:    function() {
      showToast('เกิดข้อผิดพลาด กรุณาลองใหม่');
    }
  });
}

// ===== DRAG & DROP reorder =====
var dragId = null;

function onDragStart(e) {
  dragId = parseInt(e.currentTarget.dataset.id);
  e.dataTransfer.effectAllowed = 'move';
}

function onDragOver(e) {
  e.preventDefault();
  document.getElementById('selected-zone').style.borderColor = 'var(--accent)';
}

function onDragLeave(e) {
  document.getElementById('selected-zone').style.borderColor = '';
}

function onDrop(e) {
  e.preventDefault();
  document.getElementById('selected-zone').style.borderColor = '';
  if (dragId === null) return;
  dragId = null;
}

// ===== HELPERS =====
function updateCount() {
  document.getElementById('selected-count').textContent = selectedIds.length;
}

function escHtml(str) {
  return str.replace(/'/g, "\\'").replace(/"/g, '&quot;');
}

function showToast(msg) {
  var t = document.getElementById('toast');
  t.textContent = msg;
  t.style.display = 'block';
  setTimeout(function() { t.style.display = 'none'; }, 3000);
}

// เพิ่ม animation
var style = document.createElement('style');
style.textContent = '@keyframes fadeIn { from { opacity:0;transform:translateY(-6px); } to { opacity:1;transform:translateY(0); } }';
document.head.appendChild(style);

// โหลด list ครั้งแรก + bind drag ให้การ์ดที่มาจาก DB
document.querySelectorAll('.shelf-card').forEach(function(el) {
  el.addEventListener('dragstart', onDragStart);
});
updateCount();
searchPlaces();
</script>
