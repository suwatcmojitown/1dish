<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php if (empty($places)): ?>
<div class="text-center py-16" style="color:#707882">
  <div style="font-size:48px;margin-bottom:12px;opacity:.3">🍽️</div>
  <p style="font-size:14px">ไม่พบร้านในหมวดหมู่นี้</p>
</div>
<?php return; endif; ?>

<?php
// no-image placeholder HTML
function noImgBlock($ratio = '16/9') {
    return '<div style="width:100%;aspect-ratio:' . $ratio . ';background:#f0f1f2;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:6px">'
         . '<svg width="36" height="36" fill="none" stroke="#b0b7c3" stroke-width="1.5" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/></svg>'
         . '<span style="font-size:10px;color:#b0b7c3;font-weight:600">ยังไม่มีรูปภาพ</span>'
         . '</div>';
}

function getImgTag($p, $baseUrl, $ratio = '16/9', $classes = '') {
    if (!empty($p->cover_image)) {
        return '<img alt="' . $p->place_name . '" class="' . $classes . '" style="width:100%;aspect-ratio:' . $ratio . ';object-fit:cover" src="' . $baseUrl . $p->cover_image . '"/>';
    }
    if (!empty($p->shop_image)) {
        $src = (strpos($p->shop_image, 'http') === 0) ? $p->shop_image : $baseUrl . $p->shop_image;
        return '<img alt="' . $p->place_name . '" class="' . $classes . '" style="width:100%;aspect-ratio:' . $ratio . ';object-fit:cover" src="' . $src . '"/>';
    }
    return noImgBlock($ratio);
}

$mockDishes = array(
  'แกงคั่วสับปะรดระยอง','กุ้งผัดพริกเกลือกระเทียม',
  'อเมริกาโน่น้ำผึ้งระยอง','ปลากะพงเกลือ',
  'ส้มตำทะเล','ข้าวผัดปูไข่เค็ม','ก๋วยเตี๋ยวต้มยำ',
);
?>

<div class="space-y-6">

  <!-- 3 card ใหญ่ -->
  <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <?php foreach (array_slice($places, 0, 3) as $i => $p): ?>
    <a href="<?php echo base_url('place/' . $p->place_id); ?>"
       class="bg-white rounded-2xl overflow-hidden group cursor-pointer flex flex-col transition-all duration-200 hover:-translate-y-1"
       style="box-shadow:0 4px 16px rgba(25,28,29,.07);border:1px solid #e5e7eb">
      <!-- รูป -->
      <div class="relative overflow-hidden group-hover:[&_img]:scale-105">
        <?php echo getImgTag($p, base_url(), '16/9', 'transition-transform duration-500'); ?>
        <?php if (!empty($p->category_name)): ?>
        <div class="absolute top-3 left-3 text-white font-bold uppercase shadow-sm"
             style="background:rgba(155,69,0,.9);font-size:9px;letter-spacing:.08em;padding:3px 10px;border-radius:999px">
          <?php echo $p->category_name; ?>
        </div>
        <?php endif; ?>
        <?php if (!empty($p->review_status) && $p->review_status == 'approved_seal'): ?>
        <div class="absolute top-3 right-3 flex items-center justify-center rounded-full shadow"
             style="width:28px;height:28px;background:#005e97">
          <span class="material-symbols-outlined text-white" style="font-size:14px;font-variation-settings:'FILL' 1;">verified</span>
        </div>
        <?php endif; ?>
      </div>
      <!-- body -->
      <div class="p-5 flex-grow">
        <h3 class="font-thai font-bold mb-1.5" style="font-size:17px"><?php echo $p->place_name; ?></h3>
        <p class="line-clamp-2 leading-relaxed" style="font-size:12px;color:#707882">
          <?php echo !empty($p->review_title) ? $p->review_title : (!empty($p->district_name) ? $p->district_name : $p->category_name); ?>
        </p>
      </div>
      <!-- dish badge -->
      <?php $dish = !empty($p->signature_dish_name) ? $p->signature_dish_name : $mockDishes[$i % count($mockDishes)]; ?>
      <div class="px-4 pb-4">
        <div class="flex items-center gap-3 rounded-2xl px-4 py-3" style="background:#005e97">
          <span class="material-symbols-outlined flex-shrink-0"
                style="font-size:20px;color:#fff;font-variation-settings:'FILL' 1;">stars</span>
          <div style="min-width:0">
            
            <p style="font-size:14px;color:#fff;font-weight:700;line-height:1;overflow:hidden;text-overflow:ellipsis;white-space:nowrap"><?php echo $dish; ?></p>
          </div>
        </div>
      </div>
    </a>
    <?php endforeach; ?>
  </div>

  <!-- 4 card เล็ก -->
  <?php if (count($places) > 3): ?>
  <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
    <?php foreach (array_slice($places, 3, 4) as $i => $p): ?>
    <a href="<?php echo base_url('place/' . $p->place_id); ?>"
       class="bg-white rounded-xl overflow-hidden cursor-pointer flex flex-col transition-all duration-200 hover:-translate-y-1"
       style="box-shadow:0 4px 12px rgba(25,28,29,.06);border:1px solid #e5e7eb">
      <div class="overflow-hidden group-hover:[&_img]:scale-105">
        <?php echo getImgTag($p, base_url(), '1/1', 'transition-transform duration-500'); ?>
      </div>
      <div class="p-3">
        <h4 class="font-bold truncate mb-2" style="font-size:13px"><?php echo $p->place_name; ?></h4>
        <?php $dish_s = !empty($p->signature_dish_name) ? $p->signature_dish_name : $mockDishes[($i + 3) % count($mockDishes)]; ?>
        <div class="flex items-center gap-2 rounded-xl px-3 py-2" style="background:#005e97">
          <span class="material-symbols-outlined flex-shrink-0"
                style="font-size:15px;color:#fff;font-variation-settings:'FILL' 1;">stars</span>
          <div style="min-width:0">
            
            <p style="font-size:11px;color:#fff;font-weight:700;line-height:1;overflow:hidden;text-overflow:ellipsis;white-space:nowrap"><?php echo $dish_s; ?></p>
          </div>
        </div>
      </div>
    </a>
    <?php endforeach; ?>
  </div>
  <?php endif; ?>

</div>
