<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- HEADER -->
<div class="max-w-[1280px] mx-auto px-6 md:px-8 pt-10 pb-8">
  <?php
    $label = '';
    if ($keyword) $label = '"'.$keyword.'"';
    elseif ($category_name && $district_name) $label = $category_name . ' · ' . $district_name;
    elseif ($category_name) $label = $category_name;
    elseif ($district_name) $label = $district_name;
    else $label = 'ทั้งหมด';
  ?>
  <h1 class="font-thai" style="font-size:clamp(22px,4vw,36px);font-weight:900;margin:0 0 6px 0">
    ผลการค้นหาสำหรับ: <span style="color:#005e97"><?php echo $label; ?></span>
  </h1>
  <p style="font-size:14px;color:#707882;margin:0 0 20px 0">
    Found <strong><?php echo $total; ?></strong> curated locations matching your taste.
  </p>

  <!-- Active filter pills -->
  <?php if ($category_id || $district_id || $keyword): ?>
  <div style="display:flex;gap:8px;flex-wrap:wrap;align-items:center">
    <span style="font-size:12px;color:#b0b7c3;font-weight:600">กรองโดย:</span>
    <?php if ($keyword): ?>
    <a href="<?php echo base_url('search?'.($category_id?'category_id='.$category_id:'').($district_id?'&district_id='.$district_id:'')); ?>"
       style="display:inline-flex;align-items:center;gap:6px;padding:5px 12px;border-radius:999px;background:#005e97;color:#fff;font-size:12px;font-weight:700;text-decoration:none">
      <span class="material-symbols-outlined" style="font-size:13px">search</span>
      "<?php echo htmlspecialchars($keyword); ?>"
      <span class="material-symbols-outlined" style="font-size:13px">close</span>
    </a>
    <?php endif; ?>
    <?php if ($category_name): ?>
    <a href="<?php echo base_url('search?'.($keyword?'q='.urlencode($keyword):'').($district_id?'&district_id='.$district_id:'')); ?>"
       style="display:inline-flex;align-items:center;gap:6px;padding:5px 12px;border-radius:999px;background:#9b4500;color:#fff;font-size:12px;font-weight:700;text-decoration:none">
      <span class="material-symbols-outlined" style="font-size:13px">restaurant</span>
      <?php echo $category_name; ?>
      <span class="material-symbols-outlined" style="font-size:13px">close</span>
    </a>
    <?php endif; ?>
    <?php if ($district_name): ?>
    <a href="<?php echo base_url('search?'.($keyword?'q='.urlencode($keyword):'').($category_id?'&category_id='.$category_id:'')); ?>"
       style="display:inline-flex;align-items:center;gap:6px;padding:5px 12px;border-radius:999px;background:#00665a;color:#fff;font-size:12px;font-weight:700;text-decoration:none">
      <span class="material-symbols-outlined" style="font-size:13px">location_on</span>
      <?php echo $district_name; ?>
      <span class="material-symbols-outlined" style="font-size:13px">close</span>
    </a>
    <?php endif; ?>
    <a href="<?php echo base_url('search'); ?>"
       style="display:inline-flex;align-items:center;gap:4px;padding:5px 12px;border-radius:999px;border:1px solid #e5e7eb;background:#fff;color:#707882;font-size:12px;font-weight:600;text-decoration:none">
      ล้างทั้งหมด
    </a>
  </div>
  <?php endif; ?>
</div>

<!-- GRID -->
<div class="max-w-[1280px] mx-auto px-6 md:px-8 pb-20">
  <?php if (!empty($places)): ?>

  <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
    <?php foreach ($places as $p):
      $img      = !empty($p->cover_image) ? base_url($p->cover_image) : (!empty($p->shop_image) ? (strpos($p->shop_image,'http')===0 ? $p->shop_image : base_url($p->shop_image)) : '');
      $is_seal  = $p->review_status === 'approved_seal';
      $dish     = !empty($p->signature_dish_name) ? $p->signature_dish_name : '—';
      $sub      = !empty($p->review_title) ? $p->review_title : (!empty($p->district_name) ? $p->district_name : $p->category_name);
      $link     = base_url('place/'.$p->place_id);
    ?>
    <a href="<?php echo $link; ?>"
       class="bg-white rounded-2xl overflow-hidden group flex flex-col transition-all duration-200 hover:-translate-y-1"
       style="box-shadow:0 4px 16px rgba(25,28,29,.07);border:1px solid #e5e7eb;text-decoration:none">

      <!-- รูป -->
      <div style="position:relative;overflow:hidden">
        <?php if ($img): ?>
        <img src="<?php echo $img; ?>" alt="<?php echo $p->place_name; ?>"
             class="transition-transform duration-500 group-hover:scale-105"
             style="width:100%;aspect-ratio:16/9;object-fit:cover"/>
        <?php else: ?>
        <div style="width:100%;aspect-ratio:16/9;background:#f0f1f2;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:6px">
          <svg width="36" height="36" fill="none" stroke="#b0b7c3" stroke-width="1.5" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/></svg>
          <span style="font-size:10px;color:#b0b7c3;font-weight:600">ยังไม่มีรูปภาพ</span>
        </div>
        <?php endif; ?>
        <?php if (!empty($p->category_name)): ?>
        <div style="position:absolute;top:12px;left:12px;background:rgba(155,69,0,.9);color:#fff;font-size:9px;font-weight:700;letter-spacing:.08em;padding:3px 10px;border-radius:999px;text-transform:uppercase">
          <?php echo $p->category_name; ?>
        </div>
        <?php endif; ?>
        <?php if ($is_seal): ?>
        <div style="position:absolute;top:12px;right:12px;width:28px;height:28px;background:#005e97;border-radius:50%;display:flex;align-items:center;justify-content:center;box-shadow:0 2px 6px rgba(0,0,0,.2)">
          <span class="material-symbols-outlined text-white" style="font-size:14px;font-variation-settings:'FILL' 1">verified</span>
        </div>
        <?php endif; ?>
      </div>

      <!-- Body -->
      <div class="p-5 flex-grow">
        <h3 class="font-thai font-bold mb-1.5" style="font-size:17px;color:#191c1d"><?php echo $p->place_name; ?></h3>
        <p class="line-clamp-2 leading-relaxed" style="font-size:12px;color:#707882"><?php echo $sub; ?></p>
      </div>

      <!-- Dish badge -->
      <div class="px-4 pb-4">
        <div class="flex items-center gap-3 rounded-2xl px-4 py-3" style="background:#005e97">
          <span class="material-symbols-outlined flex-shrink-0" style="font-size:20px;color:#fff;font-variation-settings:'FILL' 1">stars</span>
          <p style="font-size:14px;color:#fff;font-weight:700;line-height:1;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;margin:0"><?php echo $dish; ?></p>
        </div>
      </div>

    </a>
    <?php endforeach; ?>
  </div>

  <!-- Pagination -->
  <?php $totalPage = ceil($total / $limit); if ($totalPage > 1): ?>
  <?php $qs = ($category_id ? '&category_id='.$category_id : '').($district_id ? '&district_id='.$district_id : ''); ?>
  <div style="display:flex;justify-content:center;align-items:center;gap:6px">
    <?php if ($page > 1): ?>
    <a href="<?php echo base_url('search?page='.($page-1).$qs); ?>"
       class="flex items-center justify-center w-10 h-10 rounded-full border border-outline-variant text-primary hover:bg-primary hover:text-white transition-all"
       style="text-decoration:none">
      <span class="material-symbols-outlined" style="font-size:18px">chevron_left</span>
    </a>
    <?php endif; ?>
    <?php for ($i=1; $i<=$totalPage; $i++):
      if ($i===1 || $i===$totalPage || ($i>=$page-1 && $i<=$page+1)): ?>
    <a href="<?php echo base_url('search?page='.$i.$qs); ?>"
       class="flex items-center justify-center w-10 h-10 rounded-full font-bold text-sm transition-all"
       style="text-decoration:none;background:<?php echo $i==$page?'#005e97':'transparent'; ?>;color:<?php echo $i==$page?'#fff':'#191c1d'; ?>;border:1px solid <?php echo $i==$page?'#005e97':'#c0c7d2'; ?>">
      <?php echo $i; ?>
    </a>
    <?php elseif ($i===$page-2 || $i===$page+2): ?>
    <span class="text-outline">···</span>
    <?php endif; endfor; ?>
    <?php if ($page < $totalPage): ?>
    <a href="<?php echo base_url('search?page='.($page+1).$qs); ?>"
       class="flex items-center justify-center w-10 h-10 rounded-full border border-outline-variant text-primary hover:bg-primary hover:text-white transition-all"
       style="text-decoration:none">
      <span class="material-symbols-outlined" style="font-size:18px">chevron_right</span>
    </a>
    <?php endif; ?>
  </div>
  <?php endif; ?>

  <?php else: ?>
  <div class="text-center py-20" style="color:#b0b7c3">
    <div style="font-size:56px;margin-bottom:12px;opacity:.3">🍽️</div>
    <p class="font-thai font-bold text-base mb-2" style="color:#707882">ไม่พบร้านที่ตรงกับเงื่อนไข</p>
    <p style="font-size:14px;margin:0 0 24px 0">ลองเปลี่ยน หมวดหมู่ หรือ อำเภอ ดูครับ</p>
    <a href="<?php echo base_url('search'); ?>"
       class="inline-flex items-center gap-2 px-6 py-2.5 bg-primary text-white rounded-full text-sm font-bold hover:opacity-90 transition-opacity"
       style="text-decoration:none">ดูทั้งหมด</a>
  </div>
  <?php endif; ?>
</div>
