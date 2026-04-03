<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div style="max-width:1280px;margin:0 auto;padding:24px 32px 80px">

  <!-- BANNER AD -->
  <div style="position:relative;border-radius:16px;overflow:hidden;height:200px;background:#005e97;margin-bottom:32px">
    <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuCyA3ub7i2_hQW3trbxjz3eCIpvP4yo6cfawbGLMkAGzo0g5uGwO1A_J0aM_FyTdJ1Kpqb1yikmLr5-bFRmDyEmDEy1YL2Fzl4ToI0F0l6TWlbRab8u-Jqj_qHGVkcfYaEQG9XiivQJ1CMmcPT8-RzuVTFQIo8FEGUa-ximgCo14QfbstZd6QWOfeTZ-URrocZdJM43UitCoWOKWxv8R_5sms7i9CgeM8x71PosJ65jNX-4i3FzMinS1IySBrOVcedcjlaYZGJS2u0D"
         style="width:100%;height:100%;object-fit:cover;opacity:.6;position:absolute;inset:0"/>
    <div style="position:absolute;inset:0;background:linear-gradient(to right,rgba(0,94,151,.85),transparent);display:flex;flex-direction:column;justify-content:center;padding:40px">
      <div style="display:inline-flex;align-items:center;gap:6px;background:rgba(255,255,255,.15);backdrop-filter:blur(8px);padding:3px 12px;border-radius:999px;margin-bottom:10px;width:fit-content">
        <span class="material-symbols-outlined" style="font-size:14px;color:#fff;font-variation-settings:'FILL' 1">verified</span>
        <span style="font-size:10px;font-weight:700;color:#fff;text-transform:uppercase;letter-spacing:.1em">TAT Rayong Official</span>
      </div>
      <h2 style="font-size:32px;font-weight:900;color:#fff;margin:0 0 6px 0">Seafood Festival 2024</h2>
      <p style="font-size:15px;color:rgba(255,255,255,.9);margin:0">Experience the freshest tides from Ban Phe to Klaeng.</p>
    </div>
  </div>

  <!-- HEADER + SEARCH -->
  <div style="margin-bottom:28px">
    <h1 class="font-thai" style="font-size:42px;font-weight:900;margin:0 0 16px 0">สำรวจรสชาติระยอง</h1>
    <div style="position:relative;max-width:680px">
      <input id="search-input" type="text" placeholder="ค้นหาร้านอาหาร เมนู หรืออำเภอ..."
             value="<?php echo htmlspecialchars($keyword); ?>"
             oninput="debounceSearch()"
             style="width:100%;height:52px;padding:0 20px 0 50px;border-radius:999px;border:1px solid #e5e7eb;background:#fff;box-shadow:0 2px 12px rgba(25,28,29,.06);font-size:14px;font-family:'Kanit',sans-serif;outline:none;box-sizing:border-box"/>
      <svg width="18" height="18" fill="none" stroke="#005e97" stroke-width="2" viewBox="0 0 24 24"
           style="position:absolute;left:18px;top:50%;transform:translateY(-50%)">
        <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
      </svg>
    </div>
  </div>

  <!-- FILTERS -->
  <div style="display:flex;flex-direction:column;gap:10px;margin-bottom:24px">
    <!-- หมวดหมู่ -->
    <div style="display:flex;gap:8px;overflow-x:auto;padding-bottom:4px" class="no-scrollbar">
      <button onclick="setCat('')" data-cat=""
              class="filter-cat"
              style="display:flex;align-items:center;gap:6px;padding:8px 18px;border-radius:999px;border:2px solid <?php echo $category_id=='' ? '#005e97' : '#e5e7eb'; ?>;background:<?php echo $category_id=='' ? '#005e97' : '#fff'; ?>;color:<?php echo $category_id=='' ? '#fff' : '#707882'; ?>;font-size:13px;font-weight:700;white-space:nowrap;cursor:pointer;font-family:'Kanit',sans-serif">
        <span class="material-symbols-outlined" style="font-size:16px">restaurant</span> ทั้งหมด
      </button>
      <?php if ($categoryList): foreach ($categoryList as $cat): ?>
      <button onclick="setCat(<?php echo $cat->category_id; ?>)" data-cat="<?php echo $cat->category_id; ?>"
              class="filter-cat"
              style="padding:8px 18px;border-radius:999px;border:2px solid <?php echo $category_id==$cat->category_id ? '#005e97' : '#e5e7eb'; ?>;background:<?php echo $category_id==$cat->category_id ? '#005e97' : '#fff'; ?>;color:<?php echo $category_id==$cat->category_id ? '#fff' : '#707882'; ?>;font-size:13px;font-weight:600;white-space:nowrap;cursor:pointer;font-family:'Kanit',sans-serif">
        <?php echo $cat->name; ?>
      </button>
      <?php endforeach; endif; ?>
    </div>
    <!-- อำเภอ -->
    <div style="display:flex;align-items:center;gap:8px;overflow-x:auto;padding-bottom:4px" class="no-scrollbar">
      <span style="font-size:11px;font-weight:700;color:#005e97;text-transform:uppercase;letter-spacing:.08em;white-space:nowrap;margin-right:4px">อำเภอ:</span>
      <button onclick="setDist('')" data-dist=""
              class="filter-dist"
              style="padding:5px 14px;border-radius:8px;background:<?php echo $district_id=='' ? '#005e97' : '#fff'; ?>;color:<?php echo $district_id=='' ? '#fff' : '#707882'; ?>;font-size:11px;font-weight:700;border:1px solid <?php echo $district_id=='' ? '#005e97' : '#e5e7eb'; ?>;cursor:pointer;white-space:nowrap;font-family:'Kanit',sans-serif">
        ทั้งหมด
      </button>
      <?php if ($districtList): foreach ($districtList as $dist): ?>
      <button onclick="setDist(<?php echo $dist->district_id; ?>)" data-dist="<?php echo $dist->district_id; ?>"
              class="filter-dist"
              style="padding:5px 14px;border-radius:8px;background:<?php echo $district_id==$dist->district_id ? '#005e97' : '#fff'; ?>;color:<?php echo $district_id==$dist->district_id ? '#fff' : '#707882'; ?>;font-size:11px;font-weight:600;border:1px solid <?php echo $district_id==$dist->district_id ? '#005e97' : '#e5e7eb'; ?>;cursor:pointer;white-space:nowrap;font-family:'Kanit',sans-serif">
        <?php echo $dist->name; ?>
      </button>
      <?php endforeach; endif; ?>
    </div>
  </div>

  <!-- RESULT COUNT -->
  <p id="result-count" style="font-size:13px;color:#707882;margin-bottom:16px">
    พบ <?php echo $total; ?> ร้าน
  </p>

  <!-- GRID -->
  <div id="explore-grid" style="display:grid;grid-template-columns:repeat(4,1fr);gap:20px;margin-bottom:32px">
    <?php
    $mockDishes = array('แกงคั่วสับปะรดระยอง','กุ้งผัดพริกเกลือ','อเมริกาโน่น้ำผึ้ง','ปลากะพงเกลือ','ส้มตำทะเล','ข้าวผัดปูไข่เค็ม','ก๋วยเตี๋ยวต้มยำ');
    if (!empty($places)): foreach ($places as $i => $p):
      $imgSrc = !empty($p->cover_image) ? base_url($p->cover_image) : (!empty($p->shop_image) ? (strpos($p->shop_image,'http')===0 ? $p->shop_image : base_url($p->shop_image)) : '');
      $dish   = !empty($p->signature_dish_name) ? $p->signature_dish_name : $mockDishes[$i % count($mockDishes)];
    ?>
    <a href="<?php echo base_url('place/'.$p->place_id); ?>"
       style="text-decoration:none;display:flex;flex-direction:column;background:#fff;border-radius:16px;overflow:hidden;box-shadow:0 4px 12px rgba(25,28,29,.07);border:1px solid #e5e7eb;transition:transform .2s,box-shadow .2s"
       onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 12px 28px rgba(25,28,29,.12)'"
       onmouseout="this.style.transform='';this.style.boxShadow='0 4px 12px rgba(25,28,29,.07)'">
      <!-- รูป -->
      <div style="position:relative;overflow:hidden;aspect-ratio:16/9">
        <?php if ($imgSrc): ?>
        <img src="<?php echo $imgSrc; ?>" alt="<?php echo $p->place_name; ?>"
             style="width:100%;height:100%;object-fit:cover;transition:transform .5s"
             onmouseover="this.style.transform='scale(1.06)'" onmouseout="this.style.transform=''"/>
        <?php else: ?>
        <div style="width:100%;height:100%;background:#f0f1f2;display:flex;align-items:center;justify-content:center">
          <svg width="36" height="36" fill="none" stroke="#c0c7d2" stroke-width="1.5" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/></svg>
        </div>
        <?php endif; ?>
        <?php if (!empty($p->review_status) && $p->review_status == 'approved_seal'): ?>
        <div style="position:absolute;top:10px;right:10px;background:#005e97;width:28px;height:28px;border-radius:50%;display:flex;align-items:center;justify-content:center;box-shadow:0 2px 6px rgba(0,0,0,.2)">
          <span class="material-symbols-outlined" style="font-size:14px;color:#fff;font-variation-settings:'FILL' 1">verified</span>
        </div>
        <?php endif; ?>
      </div>
      <!-- ข้อมูล -->
      <div style="padding:16px;flex:1;display:flex;flex-direction:column">
        <div style="display:flex;align-items:center;gap:6px;margin-bottom:6px">
          <?php if (!empty($p->category_name)): ?>
          <span style="font-size:10px;font-weight:700;color:#fff;background:#005e97;padding:2px 8px;border-radius:999px"><?php echo $p->category_name; ?></span>
          <?php endif; ?>
          <?php if (!empty($p->district_name)): ?>
          <span style="font-size:11px;color:#b0b7c3">· <?php echo $p->district_name; ?></span>
          <?php endif; ?>
        </div>
        <h3 style="font-size:15px;font-weight:700;color:#191c1d;margin:0 0 10px 0"><?php echo $p->place_name; ?></h3>
        <div style="margin-top:auto;display:flex;align-items:center;gap:6px;background:rgba(0,94,151,.07);border-radius:8px;padding:6px 10px">
          <span class="material-symbols-outlined" style="font-size:13px;color:#005e97;font-variation-settings:'FILL' 1;flex-shrink:0">stars</span>
          <span style="font-size:11px;font-weight:700;color:#005e97;overflow:hidden;text-overflow:ellipsis;white-space:nowrap"><?php echo $dish; ?></span>
        </div>
      </div>
    </a>
    <?php endforeach; endif; ?>
  </div>

  <!-- EMPTY STATE -->
  <div id="empty-state" style="display:<?php echo empty($places) ? 'block' : 'none'; ?>;text-align:center;padding:80px 0">
    <span class="material-symbols-outlined" style="font-size:56px;color:#c0c7d2;display:block;margin-bottom:12px">search_off</span>
    <p style="font-size:16px;font-weight:600;color:#707882">ไม่พบร้านที่ตรงกับเงื่อนไข</p>
    <p style="font-size:13px;color:#b0b7c3;margin-top:4px">ลองปรับ filter หรือคำค้นหาใหม่นะครับ</p>
  </div>

  <!-- PAGINATION -->
  <div id="pagination" style="display:flex;justify-content:center;align-items:center;gap:6px;margin-bottom:48px">
    <?php
    $totalPage = ceil($total / $limit);
    if ($totalPage > 1):
      // prev
      if ($page > 1): ?>
      <a href="<?php echo base_url('explore?page='.($page-1).'&category_id='.$category_id.'&district_id='.$district_id.'&q='.urlencode($keyword)); ?>"
         style="width:36px;height:36px;border-radius:8px;border:1px solid #e5e7eb;background:#fff;display:flex;align-items:center;justify-content:center;color:#005e97;text-decoration:none">
        <span class="material-symbols-outlined" style="font-size:18px">chevron_left</span>
      </a>
      <?php endif;
      for ($i = 1; $i <= $totalPage; $i++):
        if ($i === 1 || $i === $totalPage || ($i >= $page-1 && $i <= $page+1)): ?>
        <a href="<?php echo base_url('explore?page='.$i.'&category_id='.$category_id.'&district_id='.$district_id.'&q='.urlencode($keyword)); ?>"
           style="width:36px;height:36px;border-radius:8px;border:1px solid <?php echo $i==$page ? '#005e97' : '#e5e7eb'; ?>;background:<?php echo $i==$page ? '#005e97' : '#fff'; ?>;color:<?php echo $i==$page ? '#fff' : '#191c1d'; ?>;font-weight:<?php echo $i==$page ? '700' : '500'; ?>;display:flex;align-items:center;justify-content:center;font-size:13px;text-decoration:none">
          <?php echo $i; ?>
        </a>
        <?php elseif ($i === $page-2 || $i === $page+2): ?>
        <span style="color:#b0b7c3;align-self:center">···</span>
        <?php endif;
      endfor;
      // next
      if ($page < $totalPage): ?>
      <a href="<?php echo base_url('explore?page='.($page+1).'&category_id='.$category_id.'&district_id='.$district_id.'&q='.urlencode($keyword)); ?>"
         style="width:36px;height:36px;border-radius:8px;border:1px solid #e5e7eb;background:#fff;display:flex;align-items:center;justify-content:center;color:#005e97;text-decoration:none">
        <span class="material-symbols-outlined" style="font-size:18px">chevron_right</span>
      </a>
      <?php endif;
    endif; ?>
  </div>

</div>

<script>
var activeCat  = '<?php echo $category_id; ?>';
var activeDist = '<?php echo $district_id; ?>';
var baseUrl    = '<?php echo base_url(); ?>';
var searchTimer = null;

function setCat(id) {
  activeCat = id;
  document.querySelectorAll('.filter-cat').forEach(function(btn) {
    var active = btn.dataset.cat == id;
    btn.style.background  = active ? '#005e97' : '#fff';
    btn.style.color       = active ? '#fff'    : '#707882';
    btn.style.borderColor = active ? '#005e97' : '#e5e7eb';
  });
  doSearch(1);
}

function setDist(id) {
  activeDist = id;
  document.querySelectorAll('.filter-dist').forEach(function(btn) {
    var active = btn.dataset.dist == id;
    btn.style.background  = active ? '#005e97' : '#fff';
    btn.style.color       = active ? '#fff'    : '#707882';
    btn.style.borderColor = active ? '#005e97' : '#e5e7eb';
  });
  doSearch(1);
}

function debounceSearch() {
  clearTimeout(searchTimer);
  searchTimer = setTimeout(function() { doSearch(1); }, 350);
}

function doSearch(page) {
  var q = document.getElementById('search-input').value;
  document.getElementById('explore-grid').style.opacity = '.5';

  $.ajax({
    type:     'POST',
    url:      baseUrl + 'explore/search',
    data:     { category_id: activeCat, district_id: activeDist, q: q, page: page },
    dataType: 'json',
    success:  function(res) {
      renderGrid(res.places);
      renderPagination(res.total, res.page, res.limit);
      document.getElementById('result-count').textContent = 'พบ ' + res.total + ' ร้าน';
      document.getElementById('explore-grid').style.opacity = '1';
    }
  });
}

var mockDishes = ['แกงคั่วสับปะรดระยอง','กุ้งผัดพริกเกลือ','อเมริกาโน่น้ำผึ้ง','ปลากะพงเกลือ','ส้มตำทะเล','ข้าวผัดปูไข่เค็ม','ก๋วยเตี๋ยวต้มยำ'];
var noImg = '<div style="width:100%;aspect-ratio:16/9;background:#f0f1f2;display:flex;align-items:center;justify-content:center"><svg width="36" height="36" fill="none" stroke="#c0c7d2" stroke-width="1.5" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/></svg></div>';

function renderGrid(places) {
  var grid  = document.getElementById('explore-grid');
  var empty = document.getElementById('empty-state');

  if (!places || places.length === 0) {
    grid.innerHTML = '';
    empty.style.display = 'block';
    return;
  }
  empty.style.display = 'none';

  grid.innerHTML = places.map(function(p, i) {
    var imgSrc = p.cover_image || p.shop_image || '';
    var img    = imgSrc
      ? '<img src="' + (imgSrc.match(/^http/) ? imgSrc : baseUrl + imgSrc) + '" style="width:100%;aspect-ratio:16/9;object-fit:cover;transition:transform .5s" onmouseover="this.style.transform=\'scale(1.06)\'" onmouseout="this.style.transform=\'\'"/>'
      : noImg;

    var dish = p.signature_dish_name || mockDishes[i % mockDishes.length];
    var seal = p.review_status === 'approved_seal'
      ? '<div style="position:absolute;top:10px;right:10px;background:#005e97;width:28px;height:28px;border-radius:50%;display:flex;align-items:center;justify-content:center;box-shadow:0 2px 6px rgba(0,0,0,.2)"><span class="material-symbols-outlined" style="font-size:14px;color:#fff;font-variation-settings:\'FILL\' 1">verified</span></div>'
      : '';

    return '<a href="' + baseUrl + 'place/' + p.place_id + '" style="text-decoration:none;display:flex;flex-direction:column;background:#fff;border-radius:16px;overflow:hidden;box-shadow:0 4px 12px rgba(25,28,29,.07);border:1px solid #e5e7eb;transition:transform .2s,box-shadow .2s" onmouseover="this.style.transform=\'translateY(-4px)\';this.style.boxShadow=\'0 12px 28px rgba(25,28,29,.12)\'" onmouseout="this.style.transform=\'\';this.style.boxShadow=\'0 4px 12px rgba(25,28,29,.07)\'">' +
      '<div style="position:relative;overflow:hidden">' + img + seal + '</div>' +
      '<div style="padding:16px;flex:1;display:flex;flex-direction:column">' +
        '<div style="display:flex;align-items:center;gap:6px;margin-bottom:6px">' +
          (p.category_name ? '<span style="font-size:10px;font-weight:700;color:#fff;background:#005e97;padding:2px 8px;border-radius:999px">' + p.category_name + '</span>' : '') +
          (p.district_name ? '<span style="font-size:11px;color:#b0b7c3">· ' + p.district_name + '</span>' : '') +
        '</div>' +
        '<h3 style="font-size:15px;font-weight:700;color:#191c1d;margin:0 0 10px 0">' + p.place_name + '</h3>' +
        '<div style="margin-top:auto;display:flex;align-items:center;gap:6px;background:rgba(0,94,151,.07);border-radius:8px;padding:6px 10px">' +
          '<span class="material-symbols-outlined" style="font-size:13px;color:#005e97;font-variation-settings:\'FILL\' 1;flex-shrink:0">stars</span>' +
          '<span style="font-size:11px;font-weight:700;color:#005e97;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">' + dish + '</span>' +
        '</div>' +
      '</div>' +
    '</a>';
  }).join('');
}

function renderPagination(total, page, limit) {
  var totalPage = Math.ceil(total / limit);
  var pag = document.getElementById('pagination');
  if (totalPage <= 1) { pag.innerHTML = ''; return; }

  var html = '';
  if (page > 1) {
    html += '<button onclick="doSearch(' + (page-1) + ')" style="width:36px;height:36px;border-radius:8px;border:1px solid #e5e7eb;background:#fff;cursor:pointer;display:flex;align-items:center;justify-content:center;color:#005e97"><span class="material-symbols-outlined" style="font-size:18px">chevron_left</span></button>';
  }
  for (var i = 1; i <= totalPage; i++) {
    if (i === 1 || i === totalPage || (i >= page-1 && i <= page+1)) {
      html += '<button onclick="doSearch(' + i + ')" style="width:36px;height:36px;border-radius:8px;border:1px solid ' + (i===page?'#005e97':'#e5e7eb') + ';background:' + (i===page?'#005e97':'#fff') + ';color:' + (i===page?'#fff':'#191c1d') + ';font-weight:' + (i===page?'700':'500') + ';cursor:pointer;font-size:13px;font-family:\'Kanit\',sans-serif">' + i + '</button>';
    } else if (i === page-2 || i === page+2) {
      html += '<span style="color:#b0b7c3;align-self:center">···</span>';
    }
  }
  if (page < totalPage) {
    html += '<button onclick="doSearch(' + (page+1) + ')" style="width:36px;height:36px;border-radius:8px;border:1px solid #e5e7eb;background:#fff;cursor:pointer;display:flex;align-items:center;justify-content:center;color:#005e97"><span class="material-symbols-outlined" style="font-size:18px">chevron_right</span></button>';
  }
  pag.innerHTML = html;
}
</script>
