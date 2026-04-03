<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php
// Mock slides — ตอนเชื่อม DB จริงให้เปลี่ยนเป็น $hero_reviews array แทน
$slides = array();

if (!empty($hero_reviews)) {
    $slides = $hero_reviews;
} else {
    // fallback mock 3 slides
    $slides = array(
        array(
            'review_id'     => 0,
            'place_name'    => 'Fisherman\'s Wharf',
            'reviewer_name' => 'เชฟพิม แซ่บเว่อร์',
            'reviewer_role' => 'นักสำรวจรสชาติ',
            'avatar'        => '',
            'body'          => 'กลิ่นหอมของสับปะรดระยองย่างในแกงส้มแสนอร่อยนี้ บอกเล่าเรื่องราวของสวนผลไม้ชายฝั่งที่มาบรรจบกับผืนน้ำทะเล',
            'cover_image'   => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAD4W-xHW0x36m3eDArT7D7esJ6xeXC05BQ8u9FCnzNamlZ152_Yw08nPzUpGXAmvpjgEUt1iOZZuSsItOriNrwid2OmJxBLJ4DwJ8Q2lx1rEt4GR9ehtoZBtSye7FSCJotusGQ8adj072-U470mbY562uwvJJvm7OoL9_8NeS2hk83FR1vvQvM8wqs5j6u1sCk8OVOAxijgk1aBXJqEettj58CMmettYhr96eaLttp6IYrBC4hkzcmGBR3BaFMEEMbF_KZw6DcIZ2S',
        ),
        array(
            'review_id'     => 0,
            'place_name'    => 'Royal Rayong Grill',
            'reviewer_name' => 'มาร์ค เฉิน',
            'reviewer_role' => 'ภัณฑารักษ์อาวุโส',
            'avatar'        => '',
            'body'          => 'ปลากะพงเกลือที่นี่ไม่เหมือนที่ไหน เปลือกนอกกรอบ เนื้อในนุ่มฉ่ำ ราดน้ำจิ้มซีฟู้ดสูตรลับที่สืบทอดมากว่า 30 ปี',
            'cover_image'   => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCtbIz0-ZII-3LBBb3HcEMmDz3ce_qfYyEgA5nbXCTtodm2Agvbp8mvuAvn0FwPdSvzCzagSOBbP9cdPbd1iOsSMWpe1_Q2pcFkF9DzqgLmqLt1EbWh_KPsuZ1Tf1C47dhzQqXpl40a-UfRLd7NszjuWgcvb1R9GESXbm9-3cjYGO1wJ00kBf3qHUpJ9diQB9m1Gu1Eaon-5yamDoJ1N4RjiyolQfzvhskDwpeUuPqVSou1QjLPItL49_CvfAVwCcpkpe3gWSsM1uKN',
        ),
        array(
            'review_id'     => 0,
            'place_name'    => 'Old Town Cafe',
            'reviewer_name' => 'กัญญา สมศักดิ์',
            'reviewer_role' => 'Influencer · TAT Verified',
            'avatar'        => '',
            'body'          => 'ย่านเมืองเก่าระยองซ่อนคาเฟ่เล็กๆ ที่เต็มไปด้วยเรื่องราว กาแฟน้ำผึ้งระยองรสหวานอ่อนๆ คือสิ่งที่ทำให้ต้องกลับมาซ้ำ',
            'cover_image'   => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDBrjuLUylEa3CnDc7i5ERwcAvQKMfbR--gI2VKKkGb6Q6EsocCcvN9tYvbMxmjvP3aeozKTr4Hv3MvjtvTM5LSrhA5YuABLDvHK-9eWdGU8l68Ar1n6ukeSWnvK-e1A-U8hiAuTxAmcrUUFWEuVF0xObCViFT70u8DIVVwxcBWn-lhN4cBrIg9DN-G_M2NSwGUhiqLLG_se5afVIGFJGLu-yEmHiJJxkZGsWX8hrPufiNRf8LPslRO1nmY8hEiGdQpthbSgREnM8kK',
        ),
    );
}
?>

<div class="w-full max-w-[1280px] mx-auto">

  <!-- HERO SLIDER -->
  <section class="px-8 py-8 relative" id="hero-section">
    <div class="relative overflow-hidden">

      <!-- Slides -->
      <div id="hero-slides">
        <?php foreach ($slides as $i => $slide):
          $is_array = is_array($slide);
          $review_id    = $is_array ? $slide['review_id']     : $slide->review_id;
          $slide_place_id = $is_array ? ($slide['place_id'] ?? 0) : (isset($slide->place_id) ? $slide->place_id : 0);
          $place_name   = $is_array ? $slide['place_name']    : $slide->place_name;
          $reviewer     = $is_array ? $slide['reviewer_name'] : $slide->reviewer_name;
          $role         = $is_array ? ($slide['reviewer_role'] ?? 'นักสำรวจรสชาติ') : 'นักสำรวจรสชาติ';
          $avatar       = $is_array ? $slide['avatar']        : $slide->avatar;
          $body         = $is_array ? $slide['body']          : $slide->body;
          $cover        = $is_array ? $slide['cover_image']   : $slide->cover_image;
          $link         = $slide_place_id ? base_url('place/' . $slide_place_id) : '#';
        ?>
        <div class="hero-slide <?php echo $i === 0 ? 'block' : 'hidden'; ?>" data-slide="<?php echo $i; ?>">
          <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
            <!-- Left -->
            <div class="lg:col-span-5 z-10">
              <span class="text-xs uppercase tracking-widest text-secondary font-bold mb-3 block">เมนูเด็ดประจำสัปดาห์</span>
              <h1 class="text-4xl md:text-6xl font-thai font-extrabold text-on-surface leading-tight mb-4">
                ที่สุดของระยอง:<br/>
                <span class="text-primary italic">หนึ่งจาน หนึ่งเรื่องราว</span>
              </h1>
              <div class="glass-overlay p-5 rounded-xl border border-white/20 mb-6 editorial-shadow">
                <p class="text-base italic text-on-surface-variant mb-4">
                  "<?php echo mb_substr(strip_tags($body), 0, 120); ?>..."
                </p>
                <div class="flex items-center gap-3">
                  <?php if (!empty($avatar)): ?>
                  <img class="w-10 h-10 rounded-full object-cover flex-shrink-0" src="<?php echo base_url($avatar); ?>"/>
                  <?php else: ?>
                  <div class="w-10 h-10 rounded-full bg-primary-container flex items-center justify-center text-on-primary font-bold text-sm flex-shrink-0">
                    <?php echo strtoupper(mb_substr($reviewer, 0, 1)); ?>
                  </div>
                  <?php endif; ?>
                  <div>
                    <p class="font-bold text-sm"><?php echo $reviewer; ?></p>
                    <p class="text-xs text-outline font-medium"><?php echo $role; ?></p>
                  </div>
                </div>
              </div>
              <a href="<?php echo $link; ?>"
                 class="bg-primary text-on-primary px-6 py-3 rounded-full font-bold text-base hover:bg-primary-container transition-all inline-flex items-center gap-2">
                อ่านเรื่องราว <span class="material-symbols-outlined">arrow_forward</span>
              </a>
            </div>
            <!-- Right -->
            <div class="lg:col-span-7 relative">
              <div class="absolute -top-4 -right-4 z-20 bg-surface-container-lowest p-3 rounded-xl editorial-shadow flex flex-col items-center">
                <span class="material-symbols-outlined text-primary text-3xl" style="font-variation-settings: 'FILL' 1;">verified_user</span>
                <span class="text-[9px] font-bold text-center mt-1 uppercase tracking-tighter leading-none">TAT Verified<br/>Quality</span>
              </div>
              <div class="rounded-2xl overflow-hidden aspect-[16/10] shadow-2xl">
                <img alt="<?php echo $place_name; ?>"
                     class="w-full h-full object-cover transition-opacity duration-700"
                     src="<?php echo $cover; ?>"/>
              </div>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>

      <!-- Dots -->
      <div class="flex gap-2 mt-6" id="hero-dots">
        <?php foreach ($slides as $i => $s): ?>
        <button onclick="goSlide(<?php echo $i; ?>)"
                class="hero-dot transition-all duration-300 rounded-full <?php echo $i === 0 ? 'w-6 h-2 bg-primary' : 'w-2 h-2 bg-outline-variant'; ?>">
        </button>
        <?php endforeach; ?>
      </div>

    </div>
  </section>

</div>

<script>
var currentSlide = 0;
var totalSlides  = <?php echo count($slides); ?>;
var autoTimer    = null;

function goSlide(index) {
  // ซ่อน slide ปัจจุบัน
  document.querySelectorAll('.hero-slide').forEach(function(el) {
    el.classList.add('hidden');
    el.classList.remove('block');
  });

  // แสดง slide ใหม่
  document.querySelectorAll('.hero-slide')[index].classList.remove('hidden');
  document.querySelectorAll('.hero-slide')[index].classList.add('block');

  // อัปเดต dots
  document.querySelectorAll('.hero-dot').forEach(function(dot, i) {
    if (i === index) {
      dot.className = 'hero-dot transition-all duration-300 rounded-full w-6 h-2 bg-primary';
    } else {
      dot.className = 'hero-dot transition-all duration-300 rounded-full w-2 h-2 bg-outline-variant';
    }
  });

  currentSlide = index;
}

function nextSlide() {
  var next = (currentSlide + 1) % totalSlides;
  goSlide(next);
}

function startAuto() {
  autoTimer = setInterval(nextSlide, 5000);
}

function stopAuto() {
  if (autoTimer) clearInterval(autoTimer);
}

// หยุด auto เมื่อ hover
document.getElementById('hero-section').addEventListener('mouseenter', stopAuto);
document.getElementById('hero-section').addEventListener('mouseleave', startAuto);

// เริ่ม auto loop
startAuto();
</script>

<!-- SPOTLIGHT -->
<section class="px-8 py-6">
  <div class="max-w-[1280px] mx-auto">
  <div class="flex items-center gap-3 mb-6">
    <span class="bg-surface-container-high text-[10px] font-bold px-3 py-1 rounded text-outline uppercase tracking-wider">Rayong Spotlight</span>
    <div class="h-px flex-grow bg-outline-variant/20"></div>
  </div>
  <style>
    @media(min-width:640px)  { .spotlight-grid { grid-template-columns: repeat(3,1fr) !important; } }
    @media(min-width:1024px) { .spotlight-grid { grid-template-columns: repeat(6,1fr) !important; } }
  </style>
  <div class="spotlight-grid" style="display:grid;grid-template-columns:repeat(2,1fr);gap:16px">
    <?php if (!empty($spotlight)): foreach ($spotlight as $item): ?>
    <a href="<?php echo base_url('place/' . $item->place_id); ?>"
       class="flex flex-col gap-3 p-3 rounded-2xl bg-white editorial-shadow border border-outline-variant/10 hover:border-primary/40 transition-all cursor-pointer group relative">
      <?php if ($item->is_sponsored): ?>
      <span style="position:absolute;top:10px;right:10px;font-size:8px;font-weight:700;color:var(--outline);background:var(--surface-container);padding:2px 7px;border-radius:999px;letter-spacing:.06em;text-transform:uppercase;opacity:.7">Ad</span>
      <?php endif; ?>
      <?php if (!empty($item->shop_image) || !empty($item->cover_image)):
              $spotImg = !empty($item->cover_image) ? $item->cover_image : $item->shop_image;
            ?>
      <img alt="<?php echo $item->place_name; ?>" class="w-full rounded-xl object-cover transition-transform duration-500 group-hover:scale-105"
           style="aspect-ratio:4/3"
           src="<?php echo base_url($spotImg); ?>"/>
      <?php else: ?>
      <div class="w-full rounded-xl bg-surface-container flex items-center justify-center text-3xl" style="aspect-ratio:4/3">🍽️</div>
      <?php endif; ?>
      <div>
        <h4 class="font-thai font-bold group-hover:text-primary transition-colors truncate" style="font-size:13px"><?php echo $item->place_name; ?></h4>
        <p class="text-xs text-on-surface-variant truncate"><?php echo $item->category_name; ?></p>
      </div>
    </a>
    <?php endforeach; else: ?>
    <?php
    $mocks = array(
      array('name'=>'Royal Rayong Grill','sub'=>'Fine Seafood Dining','img'=>'https://lh3.googleusercontent.com/aida-public/AB6AXuCtbIz0-ZII-3LBBb3HcEMmDz3ce_qfYyEgA5nbXCTtodm2Agvbp8mvuAvn0FwPdSvzCzagSOBbP9cdPbd1iOsSMWpe1_Q2pcFkF9DzqgLmqLt1EbWh_KPsuZ1Tf1C47dhzQqXpl40a-UfRLd7NszjuWgcvb1R9GESXbm9-3cjYGO1wJ00kBf3qHUpJ9diQB9m1Gu1Eaon-5yamDoJ1N4RjiyolQfzvhskDwpeUuPqVSou1QjLPItL49_CvfAVwCcpkpe3gWSsM1uKN','sponsored'=>false),
      array('name'=>'Tide & Topping','sub'=>'Coastal Desserts','img'=>'https://lh3.googleusercontent.com/aida-public/AB6AXuBtaA_yEHZ3xsGzIhbMyOuXQyg2_PA8uWqk4ne22Ka9z-t9YwLBymoAycDS0YL18JjQZR2T_-elLjXenHYM6tmlc0KhQqskDa9PgXORyhk2tzo8ylhfSkOcT4ebFt9_Iq0MIGpZto6WD1JXoMBBRcHvfFV19UPc-Bdfiab9uciWBq5LjeyqkjT5S051Le2seS-yAUEtTx1YOTM4OadMXIJz6XvEvXFX5WePcpw6CLffNe22vtWxb1cDXWwBnGiUjWuEZaBpwGTdFRtC','sponsored'=>true),
      array('name'=>'Sea Breeze Sushi','sub'=>'Ocean-Fresh Fusion','img'=>'https://lh3.googleusercontent.com/aida-public/AB6AXuARUjr__zoUGCeSAyH-HGpjIKaI-KMysgxigIs5fuF9ZyjYlk3cBwJ2WllZhCEzPBAWjjPAjX6teBfvOEOcHTTMDNmbFX3L-lLuSGxpOQufWQobtbsaa7hxy3wuxlvcOYCz2GWeKFOMdGanoWcC5Q8R36S17-PesO6n7xMI2oe-Ln1CgmPLEn2zGp5d7usAUwpu08rmeIoIQq1IHHWp9xBXrpmfvfYKTKfZTaG9dHsihL4Qp1lLimUYZdgOaVd_nsArHnNzwsj1Th91','sponsored'=>false),
      array('name'=>'Green Leaf Retreat','sub'=>'Organic Artisan Cafe','img'=>'https://lh3.googleusercontent.com/aida-public/AB6AXuDBrjuLUylEa3CnDc7i5ERwcAvQKMfbR--gI2VKKkGb6Q6EsocCcvN9tYvbMxmjvP3aeozKTr4Hv3MvjtvTM5LSrhA5YuABLDvHK-9eWdGU8l68Ar1n6ukeSWnvK-e1A-U8hiAuTxAmcrUUFWEuVF0xObCViFT70u8DIVVwxcBWn-lhN4cBrIg9DN-G_M2NSwGUhiqLLG_se5afVIGFJGLu-yEmHiJJxkZGsWX8hrPufiNRf8LPslRO1nmY8hEiGdQpthbSgREnM8kK','sponsored'=>true),
      array('name'=>'Fisherman\'s Wharf','sub'=>'อาหารทะเลสด','img'=>'https://lh3.googleusercontent.com/aida-public/AB6AXuAD4W-xHW0x36m3eDArT7D7esJ6xeXC05BQ8u9FCnzNamlZ152_Yw08nPzUpGXAmvpjgEUt1iOZZuSsItOriNrwid2OmJxBLJ4DwJ8Q2lx1rEt4GR9ehtoZBtSye7FSCJotusGQ8adj072-U470mbY562uwvJJvm7OoL9_8NeS2hk83FR1vvQvM8wqs5j6u1sCk8OVOAxijgk1aBXJqEettj58CMmettYhr96eaLttp6IYrBC4hkzcmGBR3BaFMEEMbF_KZw6DcIZ2S','sponsored'=>false),
      array('name'=>'Old Town Cafe','sub'=>'คาเฟ่ย่านเมืองเก่า','img'=>'https://lh3.googleusercontent.com/aida-public/AB6AXuDBrjuLUylEa3CnDc7i5ERwcAvQKMfbR--gI2VKKkGb6Q6EsocCcvN9tYvbMxmjvP3aeozKTr4Hv3MvjtvTM5LSrhA5YuABLDvHK-9eWdGU8l68Ar1n6ukeSWnvK-e1A-U8hiAuTxAmcrUUFWEuVF0xObCViFT70u8DIVVwxcBWn-lhN4cBrIg9DN-G_M2NSwGUhiqLLG_se5afVIGFJGLu-yEmHiJJxkZGsWX8hrPufiNRf8LPslRO1nmY8hEiGdQpthbSgREnM8kK','sponsored'=>false),
    );
    foreach ($mocks as $m):
    ?>
    <div class="flex flex-col gap-3 p-3 rounded-2xl bg-white editorial-shadow border border-outline-variant/10 hover:border-primary/40 transition-all cursor-pointer group relative">
      <?php if ($m['sponsored']): ?>
      <span style="position:absolute;top:10px;right:10px;font-size:8px;font-weight:700;color:var(--outline);background:var(--surface-container);padding:2px 7px;border-radius:999px;letter-spacing:.06em;text-transform:uppercase;opacity:.7">Ad</span>
      <?php endif; ?>
      <img alt="<?php echo $m['name']; ?>" class="w-full rounded-xl object-cover" style="aspect-ratio:4/3" src="<?php echo $m['img']; ?>"/>
      <div>
        <h4 class="font-thai font-bold group-hover:text-primary transition-colors truncate" style="font-size:13px"><?php echo $m['name']; ?></h4>
        <p class="text-xs text-on-surface-variant truncate"><?php echo $m['sub']; ?></p>
      </div>
    </div>
    <?php endforeach; endif; ?>
  </div>
  </div>
</section>

<!-- FIND YOUR NEXT FAVORITE PLATE -->
<section class="bg-surface-container-low/40 py-12 border-y border-outline-variant/10 px-8">
  <div class="max-w-[1280px] mx-auto">
  <div class="mb-8 text-center">
    <h2 class="text-3xl font-thai font-extrabold mb-6">ค้นหาจานโปรดถัดไปของคุณ</h2>
    <!-- Filter หมวดหมู่ -->
    <div class="flex flex-col gap-4">
      <div class="flex flex-wrap justify-center gap-2">
        <button onclick="filterPlaces('','')"
                data-category="" data-district=""
                class="filter-cat flex items-center gap-1.5 px-5 py-2 rounded-full bg-white text-on-surface border border-outline-variant/20 hover:border-primary/40 transition-all text-sm font-medium">
          <span class="material-symbols-outlined text-base">restaurant</span> ทั้งหมด
        </button>
        <?php if ($categoryList): foreach ($categoryList as $cat): ?>
        <button onclick="filterPlaces(<?php echo $cat->category_id; ?>,'')"
                data-category="<?php echo $cat->category_id; ?>" data-district=""
                class="filter-cat flex items-center gap-1.5 px-5 py-2 rounded-full bg-white text-on-surface border border-outline-variant/20 hover:border-primary/40 transition-all text-sm font-medium">
          <?php echo $cat->name; ?>
        </button>
        <?php endforeach; endif; ?>
      </div>
      <!-- Filter อำเภอ -->
      <div class="flex flex-wrap justify-center gap-1.5">
        <?php if ($districtList): foreach ($districtList as $dist): ?>
        <button onclick="filterPlaces('',<?php echo $dist->district_id; ?>)"
                data-district="<?php echo $dist->district_id; ?>"
                class="filter-dist px-3 py-1 rounded-full bg-surface-container-highest text-on-surface-variant text-[11px] font-semibold border border-outline-variant/30 hover:bg-primary-container hover:text-on-primary-container transition-all">
          <?php echo $dist->name; ?>
        </button>
        <?php endforeach; endif; ?>
      </div>
    </div>
  </div>

  <!-- Grid ร้านค้า -->
  <div id="places-grid">
    <?php $this->load->view('front/home/_places_grid', array('places' => $places)); ?>
  </div>
  <!-- ปุ่มดูทั้งหมด -->
  <div id="search-link-wrap" style="text-align:center;margin-top:24px">
    <a id="search-link" href="<?php echo base_url('explore'); ?>"
       style="display:inline-flex;align-items:center;gap:6px;padding:10px 28px;border-radius:999px;border:2px solid #005e97;color:#005e97;font-size:14px;font-weight:700;text-decoration:none;transition:all .2s"
       onmouseover="this.style.background='#005e97';this.style.color='#fff'"
       onmouseout="this.style.background='transparent';this.style.color='#005e97'">
      ดูผลการค้นหาทั้งหมด
      <span class="material-symbols-outlined" style="font-size:18px">arrow_forward</span>
    </a>
  </div>
  </div>
</section>

<!-- TASTES RIGHT NEAR YOU -->
<section class="py-12 px-8">
  <div class="max-w-[1280px] mx-auto">
    <div style="display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:32px;gap:16px">
      <div>
        <h2 class="text-3xl font-thai font-bold mb-1">รสชาติใกล้คุณ</h2>
        <p style="font-size:13px;color:#707882;margin:0">ร้านเด็ดใกล้ตัวที่ผ่านการรับรองจากคนท้องถิ่น</p>
      </div>
      <button id="btn-enable-location" onclick="enableLocation()"
              style="flex-shrink:0;display:flex;align-items:center;gap:8px;background:#005e97;color:#fff;border:none;border-radius:999px;padding:10px 20px;font-size:14px;font-weight:700;cursor:pointer;white-space:nowrap;font-family:inherit;transition:opacity .15s"
              onmouseover="this.style.opacity='.85'" onmouseout="this.style.opacity='1'">
        <span class="material-symbols-outlined" style="font-size:18px">my_location</span>
        เปิดตำแหน่งของคุณ
      </button>
    </div>

    <!-- State: รอกด -->
    <div id="nearby-idle" class="rounded-2xl flex flex-col items-center justify-center py-16 gap-4"
         style="background:#f3f4f5;border:2px dashed #c0c7d2">
      <span class="material-symbols-outlined" style="font-size:48px;color:#c0c7d2">location_off</span>
      <p class="font-thai font-semibold" style="color:#707882">กดปุ่มด้านบนเพื่อหาร้านใกล้คุณ</p>
    </div>

    <!-- State: กำลังโหลด -->
    <div id="nearby-loading" class="hidden rounded-2xl flex flex-col items-center justify-center py-16 gap-4"
         style="background:#f3f4f5">
      <div style="width:36px;height:36px;border:3px solid #e5e7eb;border-top-color:#005e97;border-radius:50%;animation:spin .8s linear infinite"></div>
      <p class="font-thai" style="color:#707882;font-size:14px">กำลังหาร้านใกล้คุณ...</p>
    </div>

    <!-- State: แสดงผล -->
    <div id="nearby-grid" class="hidden">
      <div id="nearby-list"></div>
    </div>

    <!-- State: error -->
    <div id="nearby-error" class="hidden rounded-2xl flex flex-col items-center justify-center py-16 gap-3"
         style="background:#f3f4f5">
      <span class="material-symbols-outlined" style="font-size:40px;color:#c0c7d2">location_disabled</span>
      <p class="font-thai font-semibold" style="color:#707882">ไม่สามารถเข้าถึงตำแหน่งได้</p>
      <p style="font-size:12px;color:#b0b7c3">กรุณาอนุญาตการเข้าถึงตำแหน่งในเบราว์เซอร์</p>
    </div>
  </div>
</section>

<!-- RANDOMIZER -->
<section class="py-12 px-8 bg-surface-container-low/20">
  <div class="max-w-[1280px] mx-auto">
    <div class="text-center mb-10">
      <h2 class="text-3xl font-thai font-extrabold mb-2">เลือกไม่ถูก? ให้เราสุ่มให้</h2>
      <p style="font-size:13px;color:#707882">ค้นหารสชาติที่ใช่สำหรับมื้อนี้</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">

      <!-- ฝั่งซ้าย: filter -->
      <div class="lg:col-span-5 bg-white rounded-3xl p-8"
           style="box-shadow:0 8px 32px rgba(25,28,29,.07);border:1px solid #e5e7eb">

        <!-- Mode toggle -->
        <div class="mb-6">
          <p style="font-size:11px;font-weight:700;color:#707882;text-transform:uppercase;letter-spacing:.08em;margin-bottom:10px">ค้นหาแบบไหน?</p>
          <div style="display:flex;gap:8px">
            <button id="mode-distance" onclick="setMode('distance')"
                    style="flex:1;display:flex;align-items:center;justify-content:center;gap:6px;padding:10px 16px;border-radius:12px;font-size:13px;font-weight:700;border:2px solid #005e97;background:#005e97;color:#fff;cursor:pointer;transition:all .2s;font-family:inherit">
              <span class="material-symbols-outlined" style="font-size:16px">my_location</span> ตามระยะทาง
            </button>
            <button id="mode-district" onclick="setMode('district')"
                    style="flex:1;display:flex;align-items:center;justify-content:center;gap:6px;padding:10px 16px;border-radius:12px;font-size:13px;font-weight:700;border:2px solid #e5e7eb;background:#fff;color:#707882;cursor:pointer;transition:all .2s;font-family:inherit">
              <span class="material-symbols-outlined" style="font-size:16px">map</span> ตามอำเภอ
            </button>
          </div>
        </div>

        <!-- Distance pills -->
        <div id="panel-distance" class="mb-6">
          <p style="font-size:11px;font-weight:700;color:#707882;text-transform:uppercase;letter-spacing:.08em;margin-bottom:10px">ระยะทางจากคุณ</p>
          <div style="display:flex;gap:8px;flex-wrap:wrap">
            <?php foreach (array(5,10,20,50) as $km): ?>
            <button onclick="setRadius(<?php echo $km; ?>)" data-radius="<?php echo $km; ?>"
                    class="radius-btn"
                    style="padding:8px 18px;border-radius:10px;font-size:13px;font-weight:700;border:2px solid #e5e7eb;background:#fff;color:#707882;cursor:pointer;transition:all .2s;font-family:inherit">
              <?php echo $km; ?> กม.
            </button>
            <?php endforeach; ?>
          </div>
        </div>

        <!-- District pills -->
        <div id="panel-district" style="display:none" class="mb-6">
          <p style="font-size:11px;font-weight:700;color:#707882;text-transform:uppercase;letter-spacing:.08em;margin-bottom:10px">เลือกอำเภอ</p>
          <div style="display:flex;gap:6px;flex-wrap:wrap">
            <?php if ($districtList): foreach ($districtList as $dist): ?>
            <button onclick="setDistrict(<?php echo $dist->district_id; ?>)" data-dist="<?php echo $dist->district_id; ?>"
                    class="district-btn"
                    style="padding:7px 14px;border-radius:10px;font-size:12px;font-weight:600;border:2px solid #e5e7eb;background:#fff;color:#707882;cursor:pointer;transition:all .2s;font-family:inherit">
              <?php echo $dist->name; ?>
            </button>
            <?php endforeach; endif; ?>
          </div>
        </div>

        <!-- Category pills -->
        <div class="mb-8">
          <p style="font-size:11px;font-weight:700;color:#707882;text-transform:uppercase;letter-spacing:.08em;margin-bottom:10px">หมวดหมู่ (ไม่บังคับ)</p>
          <div style="display:flex;gap:6px;flex-wrap:wrap">
            <button onclick="setCategory('')" data-cat=""
                    class="cat-btn"
                    style="padding:7px 14px;border-radius:10px;font-size:12px;font-weight:600;border:2px solid #005e97;background:#005e97;color:#fff;cursor:pointer;transition:all .2s;font-family:inherit">
              ทั้งหมด
            </button>
            <?php if ($categoryList): foreach ($categoryList as $cat): ?>
            <button onclick="setCategory(<?php echo $cat->category_id; ?>)" data-cat="<?php echo $cat->category_id; ?>"
                    class="cat-btn"
                    style="padding:7px 14px;border-radius:10px;font-size:12px;font-weight:600;border:2px solid #e5e7eb;background:#fff;color:#707882;cursor:pointer;transition:all .2s;font-family:inherit">
              <?php echo $cat->name; ?>
            </button>
            <?php endforeach; endif; ?>
          </div>
        </div>

        <!-- Submit -->
        <button onclick="doRandom()"
                style="width:100%;display:flex;align-items:center;justify-content:center;gap:10px;padding:16px;border-radius:16px;font-size:16px;font-weight:700;border:none;background:#005e97;color:#fff;cursor:pointer;transition:all .2s;font-family:inherit"
                onmouseover="this.style.opacity='.85'" onmouseout="this.style.opacity='1'">
          <span class="material-symbols-outlined" style="font-size:22px">casino</span>
          สุ่มหาร้านที่ใช่เลย
        </button>
      </div>

      <!-- ฝั่งขวา: ผลลัพธ์ -->
      <div class="lg:col-span-7">

        <!-- Idle state -->
        <div id="random-idle" style="display:flex;flex-direction:column;align-items:center;justify-content:center;height:320px;background:#f3f4f5;border-radius:24px;border:2px dashed #c0c7d2;gap:12px">
          <span class="material-symbols-outlined" style="font-size:48px;color:#c0c7d2">casino</span>
          <p style="font-size:14px;font-weight:600;color:#707882">กดปุ่มสุ่มเพื่อหาร้านที่ใช่</p>
        </div>

        <!-- Loading state -->
        <div id="random-loading" style="display:none;flex-direction:column;align-items:center;justify-content:center;height:320px;background:#f3f4f5;border-radius:24px;gap:12px">
          <div style="width:40px;height:40px;border:3px solid #e5e7eb;border-top-color:#005e97;border-radius:50%;animation:spin .8s linear infinite"></div>
          <p style="font-size:14px;color:#707882">กำลังสุ่ม...</p>
        </div>

        <!-- No result -->
        <div id="random-empty" style="display:none;flex-direction:column;align-items:center;justify-content:center;height:320px;background:#f3f4f5;border-radius:24px;gap:12px">
          <span class="material-symbols-outlined" style="font-size:48px;color:#c0c7d2">search_off</span>
          <p style="font-size:14px;font-weight:600;color:#707882">ไม่พบร้านในเงื่อนไขนี้</p>
          <p style="font-size:12px;color:#b0b7c3">ลองปรับ filter แล้วสุ่มใหม่นะครับ</p>
        </div>

        <!-- Result -->
        <div id="random-result" style="display:none">
          <div style="position:relative;background:#fff;border-radius:24px;overflow:hidden;box-shadow:0 8px 32px rgba(25,28,29,.1);border:1px solid #e5e7eb">
            <!-- badge แนะนำ -->
            <div style="position:absolute;top:16px;right:16px;z-index:10">
              <div style="background:#9b4500;color:#fff;font-size:10px;font-weight:700;padding:4px 12px;border-radius:999px;text-transform:uppercase;letter-spacing:.06em">
                แนะนำสำหรับคุณ!
              </div>
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr">
              <!-- รูป -->
              <div id="random-img-wrap" style="height:320px;overflow:hidden"></div>
              <!-- ข้อมูล -->
              <div style="padding:28px;display:flex;flex-direction:column;justify-content:space-between">
                <div>
                  <div style="display:flex;align-items:center;gap:8px;margin-bottom:10px;flex-wrap:wrap">
                    <span id="random-cat" style="font-size:10px;font-weight:700;color:#fff;background:#005e97;padding:3px 10px;border-radius:999px;text-transform:uppercase;letter-spacing:.06em"></span>
                    <span id="random-dist-label" style="font-size:11px;color:#707882;display:flex;align-items:center;gap:3px">
                      <span class="material-symbols-outlined" style="font-size:13px;color:#9b4500">location_on</span>
                      <span id="random-district"></span>
                    </span>
                  </div>
                  <h3 id="random-name" style="font-size:26px;font-weight:800;color:#191c1d;margin:0 0 10px 0;line-height:1.2"></h3>
                  <p id="random-title" style="font-size:13px;color:#707882;line-height:1.6;margin:0 0 20px 0"></p>
                </div>
                <!-- dish badge -->
                <div>
                  <div id="random-dish" style="display:flex;align-items:center;gap:8px;background:#005e97;border-radius:14px;padding:12px 16px">
                    <span class="material-symbols-outlined" style="font-size:20px;color:#fff;font-variation-settings:'FILL' 1;flex-shrink:0">restaurant_menu</span>
                    <div style="min-width:0">
                      
                      <p id="random-dish-name" style="font-size:15px;color:#fff;font-weight:700;margin:0;overflow:hidden;text-overflow:ellipsis;white-space:nowrap"></p>
                    </div>
                  </div>
                  <a id="random-link" href="#"
                     style="display:flex;align-items:center;justify-content:center;gap:6px;margin-top:10px;padding:10px;border-radius:12px;border:2px solid #005e97;color:#005e97;font-size:13px;font-weight:700;text-decoration:none;transition:all .2s"
                     onmouseover="this.style.background='#005e97';this.style.color='#fff'" onmouseout="this.style.background='';this.style.color='#005e97'">
                    ดูรายละเอียดร้าน <span class="material-symbols-outlined" style="font-size:16px">arrow_forward</span>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>

<script>
// ===== RANDOMIZER =====
var randMode       = 'distance';  // 'distance' | 'district'
var randRadius     = 5;
var randDistrictId = '';
var randCategoryId = '';
var randUserLat    = '';
var randUserLng    = '';

function setMode(mode) {
  randMode = mode;
  // reset
  randRadius     = 5;
  randDistrictId = '';

  if (mode === 'distance') {
    document.getElementById('panel-distance').style.display = 'block';
    document.getElementById('panel-district').style.display = 'none';
    document.getElementById('mode-distance').style.background = '#005e97';
    document.getElementById('mode-distance').style.color = '#fff';
    document.getElementById('mode-distance').style.borderColor = '#005e97';
    document.getElementById('mode-district').style.background = '#fff';
    document.getElementById('mode-district').style.color = '#707882';
    document.getElementById('mode-district').style.borderColor = '#e5e7eb';
    setRadius(5);
  } else {
    document.getElementById('panel-distance').style.display = 'none';
    document.getElementById('panel-district').style.display = 'block';
    document.getElementById('mode-district').style.background = '#005e97';
    document.getElementById('mode-district').style.color = '#fff';
    document.getElementById('mode-district').style.borderColor = '#005e97';
    document.getElementById('mode-distance').style.background = '#fff';
    document.getElementById('mode-distance').style.color = '#707882';
    document.getElementById('mode-distance').style.borderColor = '#e5e7eb';
  }
}

function setRadius(km) {
  randRadius = km;
  document.querySelectorAll('.radius-btn').forEach(function(btn) {
    var active = parseInt(btn.dataset.radius) === km;
    btn.style.background    = active ? '#005e97' : '#fff';
    btn.style.color         = active ? '#fff' : '#707882';
    btn.style.borderColor   = active ? '#005e97' : '#e5e7eb';
  });
}

function setDistrict(id) {
  randDistrictId = id;
  document.querySelectorAll('.district-btn').forEach(function(btn) {
    var active = parseInt(btn.dataset.dist) === id;
    btn.style.background    = active ? '#005e97' : '#fff';
    btn.style.color         = active ? '#fff' : '#707882';
    btn.style.borderColor   = active ? '#005e97' : '#e5e7eb';
  });
}

function setCategory(id) {
  randCategoryId = id;
  document.querySelectorAll('.cat-btn').forEach(function(btn) {
    var active = btn.dataset.cat == id;
    btn.style.background    = active ? '#005e97' : '#fff';
    btn.style.color         = active ? '#fff' : '#707882';
    btn.style.borderColor   = active ? '#005e97' : '#e5e7eb';
  });
}

function showRandomState(state) {
  ['idle','loading','empty','result'].forEach(function(s) {
    var el = document.getElementById('random-' + s);
    el.style.display = (s === state) ? (s === 'result' ? 'block' : 'flex') : 'none';
  });
}

function doRandom() {
  if (randMode === 'distance') {
    // ขอ location ก่อน
    showRandomState('loading');
    // ใช้พิกัดอนุสาวรีย์สุนทรภู่ชั่วคราว (เปลี่ยนเป็น geolocation ตอน deploy HTTPS)
    randUserLat = 12.7469;
    randUserLng = 101.6611;
    callRandom();
  } else {
    if (!randDistrictId) {
      alert('กรุณาเลือกอำเภอก่อนนะครับ');
      return;
    }
    showRandomState('loading');
    callRandom();
  }
}

function callRandom() {
  var data = { category_id: randCategoryId };

  if (randMode === 'distance') {
    data.lat    = randUserLat;
    data.lng    = randUserLng;
    data.radius = randRadius;
  } else {
    data.district_id = randDistrictId;
  }

  $.ajax({
    type:     'POST',
    url:      baseUrl + 'home/random-place',
    data:     data,
    dataType: 'json',
    success:  function(place) {
      if (!place) {
        showRandomState('empty');
        return;
      }
      renderRandom(place);
      showRandomState('result');
    },
    error: function() {
      showRandomState('empty');
    }
  });
}

function renderRandom(p) {
  var mockDishes = ['แกงคั่วสับปะรดระยอง','กุ้งผัดพริกเกลือกระเทียม','อเมริกาโน่น้ำผึ้งระยอง','ปลากะพงเกลือ','ส้มตำทะเล','ข้าวผัดปูไข่เค็ม'];

  // รูป
  var imgSrc = p.cover_image || p.shop_image || '';
  var imgWrap = document.getElementById('random-img-wrap');
  if (imgSrc) {
    var src = imgSrc.match(/^http/) ? imgSrc : baseUrl + imgSrc;
    imgWrap.innerHTML = '<img src="'+src+'" style="width:100%;height:100%;object-fit:cover;transition:transform .6s" onmouseover="this.style.transform=\'scale(1.05)\'" onmouseout="this.style.transform=\'\'"/>';
  } else {
    imgWrap.innerHTML = '<div style="width:100%;height:100%;background:#f0f1f2;display:flex;align-items:center;justify-content:center"><svg width="48" height="48" fill="none" stroke="#b0b7c3" stroke-width="1.5" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/></svg></div>';
  }

  document.getElementById('random-name').textContent      = p.place_name || '';
  document.getElementById('random-cat').textContent       = p.category_name || '';
  document.getElementById('random-district').textContent  = p.district_name || '';
  document.getElementById('random-title').textContent     = p.review_title || p.category_name || '';
  document.getElementById('random-dish-name').textContent = p.signature_dish_name || mockDishes[0];
  document.getElementById('random-link').href             = baseUrl + 'place/' + p.place_id;

  // animation ผลลัพธ์
  var result = document.getElementById('random-result');
  result.style.opacity   = '0';
  result.style.transform = 'translateY(16px)';
  result.style.transition = 'opacity .4s ease, transform .4s ease';
  setTimeout(function() {
    result.style.opacity   = '1';
    result.style.transform = 'translateY(0)';
  }, 50);
}

// init
setRadius(5);
setCategory('');
</script>
</style>

<script>
// ===== NEARBY =====
function enableLocation() {
  showNearbyState('loading');
  document.getElementById('btn-enable-location').disabled = true;

  // TODO: เปลี่ยนเป็น navigator.geolocation ตอน deploy บน HTTPS
  // ใช้พิกัดอนุสาวรีย์สุนทรภู่ ระยอง เพื่อทดสอบ
  loadNearby(12.7469, 101.6611);
}

function loadNearby(lat, lng) {
  $.ajax({
    type:     'POST',
    url:      baseUrl + 'home/nearby',
    data:     { lat: lat, lng: lng },
    dataType: 'json',
    success:  function(places) {
      if (!places || places.length === 0) {
        showNearbyState('error');
        return;
      }
      renderNearby(places);
      showNearbyState('grid');
    },
    error: function() {
      showNearbyState('error');
    }
  });
}

function showNearbyState(state) {
  document.getElementById('nearby-idle').classList.add('hidden');
  document.getElementById('nearby-loading').classList.add('hidden');
  document.getElementById('nearby-grid').classList.add('hidden');
  document.getElementById('nearby-error').classList.add('hidden');
  document.getElementById('nearby-' + state).classList.remove('hidden');
}

function renderNearby(places) {
  var mockDishes = ['แกงคั่วสับปะรดระยอง','กุ้งผัดพริกเกลือกระเทียม','อเมริกาโน่น้ำผึ้งระยอง','ปลากะพงเกลือ','ส้มตำทะเล','ข้าวผัดปูไข่เค็ม'];

  var noImg = '<div style="width:72px;height:72px;background:#f0f1f2;display:flex;align-items:center;justify-content:center;border-radius:12px;flex-shrink:0">' +
    '<svg width="20" height="20" fill="none" stroke="#b0b7c3" stroke-width="1.5" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/></svg>' +
    '</div>';

  var cards = places.map(function(p, i) {
    var imgSrc = p.cover_image || p.shop_image || '';
    var imgEl  = imgSrc
      ? '<img src="' + (imgSrc.match(/^http/) ? imgSrc : baseUrl + imgSrc) + '" style="width:72px;height:72px;border-radius:12px;object-fit:cover;flex-shrink:0"/>'
      : noImg;

    var dish = p.signature_dish_name || mockDishes[i % mockDishes.length];
    var dist = p.distance_km < 1
      ? Math.round(p.distance_km * 1000) + ' ม.'
      : p.distance_km + ' กม.';

    return '<a href="' + baseUrl + 'place/' + p.place_id + '" ' +
      'style="display:flex;gap:14px;padding:16px;background:#fff;border-radius:16px;border:1px solid #e5e7eb;box-shadow:0 4px 16px rgba(25,28,29,.06);text-decoration:none;transition:transform .15s;align-items:flex-start" ' +
      'onmouseover="this.style.transform=\'translateY(-2px)\'" onmouseout="this.style.transform=\'\'">' +
      imgEl +
      '<div style="flex:1;min-width:0">' +
        '<div style="display:flex;align-items:center;justify-content:space-between;gap:6px;margin-bottom:3px">' +
          '<h3 style="font-size:15px;font-weight:700;color:#191c1d;margin:0;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">' + p.place_name + '</h3>' +
          '<span style="flex-shrink:0;font-size:10px;font-weight:700;color:#fff;background:#005e97;padding:2px 8px;border-radius:999px">' + dist + '</span>' +
        '</div>' +
        '<p style="font-size:11px;font-weight:600;color:#9b4500;text-transform:uppercase;letter-spacing:.04em;margin:0 0 6px 0">' +
          (p.category_name ? p.category_name.toUpperCase() : '') + (p.district_name ? ' · ' + p.district_name : '') +
        '</p>' +
        '<div style="display:flex;align-items:center;gap:5px;background:#005e97;border-radius:8px;padding:5px 10px">' +
          '<span class="material-symbols-outlined" style="font-size:13px;color:#fff;font-variation-settings:\'FILL\' 1;flex-shrink:0">stars</span>' +
          '<span style="font-size:11px;color:#fff;font-weight:700;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">' + dish + '</span>' +
        '</div>' +
      '</div>' +
    '</a>';
  });

  // แบ่ง 2 แถว x 3 คอลัมน์
  var html =
    '<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-bottom:16px">' +
      cards.slice(0, 3).join('') +
    '</div>' +
    '<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:16px">' +
      cards.slice(3, 6).join('') +
    '</div>';

  document.getElementById('nearby-list').innerHTML = html;
}
</script>

<script>
var activeCat  = '';
var activeDist = '';
var baseUrl    = '<?php echo base_url(); ?>';

function filterPlaces(catId, distId) {
  // toggle แต่ละตัวอิสระ ไม่ reset อีกฝ่าย
  if (catId !== undefined && catId !== '') {
    activeCat = (activeCat == catId) ? '' : catId;
  } else if (distId !== undefined && distId !== '') {
    activeDist = (activeDist == distId) ? '' : distId;
  } else {
    // กด "ทั้งหมด" — reset ทั้งคู่
    activeCat  = '';
    activeDist = '';
  }

  // อัปเดต active state ปุ่ม category
  document.querySelectorAll('.filter-cat').forEach(function(btn) {
    var isActive = btn.dataset.category == activeCat;
    btn.className = btn.className
      .replace('bg-primary text-on-primary border-primary', '')
      .replace('bg-white text-on-surface border-outline-variant/20', '');
    if (isActive) {
      btn.classList.add('bg-primary', 'text-on-primary', 'border-primary');
      btn.classList.remove('bg-white', 'text-on-surface');
    } else {
      btn.classList.add('bg-white', 'text-on-surface', 'border-outline-variant/20');
      btn.classList.remove('bg-primary', 'text-on-primary');
    }
  });

  // อัปเดต active state ปุ่ม district
  document.querySelectorAll('.filter-dist').forEach(function(btn) {
    var isActive = btn.dataset.district == activeDist;
    if (isActive) {
      btn.classList.add('bg-primary-container', 'text-on-primary-container');
      btn.classList.remove('bg-surface-container-highest', 'text-on-surface-variant');
    } else {
      btn.classList.add('bg-surface-container-highest', 'text-on-surface-variant');
      btn.classList.remove('bg-primary-container', 'text-on-primary-container');
    }
  });

  // แสดง loading
  document.getElementById('places-grid').style.opacity = '0.5';

  // AJAX
  $.ajax({
    url:      baseUrl + 'home/filter-places',
    data:     { category_id: activeCat, district_id: activeDist },
    dataType: 'json',
    success:  function(places) {
      renderGrid(places);
      document.getElementById('places-grid').style.opacity = '1';
    }
  });
}

function renderGrid(places) {
  if (!places || places.length === 0) {
    document.getElementById('places-grid').innerHTML =
      '<div class="text-center py-16" style="color:#707882">' +
      '<div style="font-size:48px;margin-bottom:12px;opacity:.3">🍽️</div>' +
      '<p style="font-size:14px">ไม่พบร้านในหมวดหมู่นี้</p></div>';
    return;
  }

  var mockDishes = ['แกงคั่วสับปะรดระยอง','กุ้งผัดพริกเกลือกระเทียม','อเมริกาโน่น้ำผึ้งระยอง','ปลากะพงเกลือ','ส้มตำทะเล','ข้าวผัดปูไข่เค็ม','ก๋วยเตี๋ยวต้มยำ'];

  var noImgLarge = '<div style="width:100%;aspect-ratio:16/9;background:#f0f1f2;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:6px"><svg width="36" height="36" fill="none" stroke="#b0b7c3" stroke-width="1.5" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/></svg><span style="font-size:10px;color:#b0b7c3;font-weight:600">ยังไม่มีรูปภาพ</span></div>';
  var noImgSmall = '<div style="width:100%;aspect-ratio:1/1;background:#f0f1f2;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:6px"><svg width="28" height="28" fill="none" stroke="#b0b7c3" stroke-width="1.5" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/></svg><span style="font-size:9px;color:#b0b7c3;font-weight:600">ยังไม่มีรูปภาพ</span></div>';

  function getImg(p, idx) {
    if (p.cover_image) return '<img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" style="aspect-ratio:16/9" src="' + (p.cover_image.match(/^http/) ? p.cover_image : baseUrl + p.cover_image) + '"/>';
    if (p.shop_image)  return '<img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" style="aspect-ratio:16/9" src="' + (p.shop_image.match(/^http/)  ? p.shop_image  : baseUrl + p.shop_image)  + '"/>';
    return noImgLarge;
  }

  function getImgSmall(p, idx) {
    if (p.cover_image) return '<img class="w-full h-full object-cover hover:scale-105 transition-transform duration-500" style="aspect-ratio:1/1" src="' + (p.cover_image.match(/^http/) ? p.cover_image : baseUrl + p.cover_image) + '"/>';
    if (p.shop_image)  return '<img class="w-full h-full object-cover hover:scale-105 transition-transform duration-500" style="aspect-ratio:1/1" src="' + (p.shop_image.match(/^http/)  ? p.shop_image  : baseUrl + p.shop_image)  + '"/>';
    return noImgSmall;
  }

  function dishBadgeLarge(p, idx) {
    var dish = p.signature_dish_name || mockDishes[idx % mockDishes.length];
    return '<div class="px-4 pb-4">' +
      '<div class="flex items-center gap-3 rounded-2xl px-4 py-3" style="background:#005e97">' +
        '<span class="material-symbols-outlined" style="font-size:20px;color:#fff;font-variation-settings:\'FILL\' 1;flex-shrink:0">stars</span>' +
        '<div style="min-width:0">' +
          
          '<p style="font-size:14px;color:#fff;font-weight:700;line-height:1;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">' + dish + '</p>' +
        '</div>' +
      '</div>' +
    '</div>';
  }

  function dishBadgeSmall(p, idx) {
    var dish = p.signature_dish_name || mockDishes[idx % mockDishes.length];
    return '<div class="flex items-center gap-2 rounded-xl px-3 py-2" style="background:#005e97">' +
      '<span class="material-symbols-outlined" style="font-size:15px;color:#fff;font-variation-settings:\'FILL\' 1;flex-shrink:0">stars</span>' +
      '<div style="min-width:0">' +
        
        '<p style="font-size:11px;color:#fff;font-weight:700;line-height:1;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">' + dish + '</p>' +
      '</div>' +
    '</div>';
  }

  var big   = places.slice(0, 3);
  var small = places.slice(3, 7);
  var html  = '<div class="space-y-6">';

  // 3 card ใหญ่
  html += '<div class="grid grid-cols-1 md:grid-cols-3 gap-6">';
  big.forEach(function(p, i) {
    var imgHtml = getImg(p, i);
    var cat    = p.category_name
      ? '<div class="absolute top-3 left-3 text-white font-bold uppercase shadow-sm" style="background:rgba(155,69,0,.9);font-size:9px;letter-spacing:.08em;padding:3px 10px;border-radius:999px">' + p.category_name + '</div>'
      : '';
    var seal   = p.review_status === 'approved_seal'
      ? '<div class="absolute top-3 right-3 flex items-center justify-center rounded-full shadow" style="width:28px;height:28px;background:#005e97"><span class="material-symbols-outlined text-white" style="font-size:14px;font-variation-settings:\'FILL\' 1;">verified</span></div>'
      : '';
    html +=
      '<a href="' + baseUrl + 'place/' + p.place_id + '" class="bg-white rounded-2xl overflow-hidden group cursor-pointer flex flex-col transition-all duration-200 hover:-translate-y-1" style="box-shadow:0 4px 16px rgba(25,28,29,.07);border:1px solid #e5e7eb">' +
        '<div class="relative overflow-hidden">' + imgHtml + cat + seal + '</div>' +
        '<div class="p-5 flex-grow">' +
          '<h3 class="font-thai font-bold mb-1.5" style="font-size:17px">' + p.place_name + '</h3>' +
          '<p class="line-clamp-2 leading-relaxed" style="font-size:12px;color:#707882">' + (p.review_title || p.district_name || p.category_name || '') + '</p>' +
        '</div>' +
        dishBadgeLarge(p, i) +
      '</a>';
  });
  html += '</div>';

  // 4 card เล็ก
  if (small.length > 0) {
    html += '<div class="grid grid-cols-2 md:grid-cols-4 gap-4">';
    small.forEach(function(p, i) {
      var imgHtml = getImgSmall(p, i + 3);
      html +=
        '<a href="' + baseUrl + 'place/' + p.place_id + '" class="bg-white rounded-xl overflow-hidden cursor-pointer flex flex-col transition-all duration-200 hover:-translate-y-1" style="box-shadow:0 4px 12px rgba(25,28,29,.06);border:1px solid #e5e7eb">' +
          '<div class="overflow-hidden">' + imgHtml + '</div>' +
          '<div class="p-3">' +
            '<h4 class="font-bold truncate mb-2" style="font-size:13px">' + p.place_name + '</h4>' +
            dishBadgeSmall(p, i + 3) +
          '</div>' +
        '</a>';
    });
    html += '</div>';
  }

  html += '</div>';
  document.getElementById('places-grid').innerHTML = html;

  // อัปเดต link ดูผลการค้นหาทั้งหมด
  var searchUrl = baseUrl + 'explore';
  var params = [];
  if (activeCat)  params.push('category_id=' + activeCat);
  if (activeDist) params.push('district_id=' + activeDist);
  if (params.length) searchUrl += '?' + params.join('&');
  var searchLink = document.getElementById('search-link');
  if (searchLink) searchLink.href = searchUrl;
}
</script>

<style>
/* ===== ANIMATION CSS ===== */

/* Fade up — สำหรับ element ที่ scroll เข้ามา */
.anim-fade-up {
  opacity: 0;
  transform: translateY(28px);
  transition: opacity .55s cubic-bezier(.22,1,.36,1), transform .55s cubic-bezier(.22,1,.36,1);
}
.anim-fade-up.visible {
  opacity: 1;
  transform: translateY(0);
}

/* Stagger delay สำหรับ card กลุ่ม */
.anim-fade-up:nth-child(1) { transition-delay: 0s; }
.anim-fade-up:nth-child(2) { transition-delay: .08s; }
.anim-fade-up:nth-child(3) { transition-delay: .16s; }
.anim-fade-up:nth-child(4) { transition-delay: .24s; }
.anim-fade-up:nth-child(5) { transition-delay: .32s; }
.anim-fade-up:nth-child(6) { transition-delay: .40s; }

/* Shimmer loading สำหรับ grid ตอน filter */
@keyframes shimmer {
  0%   { background-position: -600px 0; }
  100% { background-position: 600px 0; }
}
.shimmer {
  background: linear-gradient(90deg, #f0f1f2 25%, #e5e7eb 50%, #f0f1f2 75%);
  background-size: 600px 100%;
  animation: shimmer 1.4s infinite;
  border-radius: 16px;
}

/* Ripple effect บนปุ่ม */
.btn-ripple {
  position: relative;
  overflow: hidden;
}
.btn-ripple::after {
  content: '';
  position: absolute;
  inset: 0;
  background: rgba(255,255,255,.25);
  opacity: 0;
  border-radius: inherit;
  transition: opacity .3s;
}
.btn-ripple:active::after {
  opacity: 1;
}

/* Pulse สำหรับ icon ตำแหน่ง */
@keyframes pulse-ring {
  0%   { transform: scale(.9); box-shadow: 0 0 0 0 rgba(0,94,151,.4); }
  70%  { transform: scale(1);  box-shadow: 0 0 0 10px rgba(0,94,151,0); }
  100% { transform: scale(.9); box-shadow: 0 0 0 0 rgba(0,94,151,0); }
}
.pulse { animation: pulse-ring 2s infinite; }
</style>

<script>
// ===== SCROLL ANIMATION (Intersection Observer) =====
(function() {
  var els = document.querySelectorAll(
    'section, .shelf-card-item, #hero-section, ' +
    '[class*="rounded-2xl"], [class*="rounded-xl"]'
  );

  // เพิ่ม class anim-fade-up ให้ทุก section และ card
  var sections = document.querySelectorAll('section');
  sections.forEach(function(el) {
    el.classList.add('anim-fade-up');
  });

  var observer = new IntersectionObserver(function(entries) {
    entries.forEach(function(entry) {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.08, rootMargin: '0px 0px -40px 0px' });

  document.querySelectorAll('.anim-fade-up').forEach(function(el) {
    observer.observe(el);
  });
})();

// ===== SHIMMER LOADING สำหรับ filter grid =====
var _origFilterAjax = filterPlaces;
filterPlaces = function(catId, distId) {
  // แสดง shimmer ก่อน AJAX
  var grid = document.getElementById('places-grid');
  grid.innerHTML =
    '<div class="space-y-6">' +
      '<div class="grid grid-cols-1 md:grid-cols-3 gap-6">' +
        '<div class="shimmer" style="height:320px"></div>' +
        '<div class="shimmer" style="height:320px"></div>' +
        '<div class="shimmer" style="height:320px"></div>' +
      '</div>' +
      '<div class="grid grid-cols-2 md:grid-cols-4 gap-4">' +
        '<div class="shimmer" style="height:200px"></div>' +
        '<div class="shimmer" style="height:200px"></div>' +
        '<div class="shimmer" style="height:200px"></div>' +
        '<div class="shimmer" style="height:200px"></div>' +
      '</div>' +
    '</div>';
  _origFilterAjax(catId, distId);
};

// ===== HOVER LIFT สำหรับ card ที่โหลดใหม่จาก AJAX =====
// ใช้ event delegation แทนเพราะ card render ใหม่ทุกครั้ง
document.addEventListener('mouseover', function(e) {
  var card = e.target.closest('a[href*="place/"]');
  if (card && card.closest('#places-grid, #nearby-list')) {
    card.style.transform = 'translateY(-4px)';
    card.style.boxShadow = '0 12px 28px rgba(25,28,29,.12)';
  }
});
document.addEventListener('mouseout', function(e) {
  var card = e.target.closest('a[href*="place/"]');
  if (card && card.closest('#places-grid, #nearby-list')) {
    card.style.transform = '';
    card.style.boxShadow = '';
  }
});

// ===== HERO SLIDE TRANSITION — เพิ่ม fade =====
var _origGoSlide = goSlide;
goSlide = function(index) {
  var slides = document.querySelectorAll('.hero-slide');
  slides.forEach(function(el) {
    el.style.opacity = '0';
    el.style.transition = 'opacity .4s ease';
  });
  setTimeout(function() {
    _origGoSlide(index);
    document.querySelectorAll('.hero-slide').forEach(function(el) {
      if (!el.classList.contains('hidden')) {
        el.style.opacity = '1';
      }
    });
  }, 200);
};

// ===== PULSE บนปุ่ม location =====
var locBtn = document.getElementById('btn-enable-location');
if (locBtn) {
  locBtn.classList.add('btn-ripple');
}

// ===== FILTER PILL — active animation =====
document.querySelectorAll('.filter-cat, .filter-dist').forEach(function(btn) {
  btn.style.transition = 'all .2s cubic-bezier(.22,1,.36,1)';
});
</script>


<!-- ข่าวประชาสัมพันธ์ -->
<section class="py-12 px-8 bg-surface-container-low/30">
  <div class="max-w-[1280px] mx-auto">
    <div style="display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:28px;gap:16px">
      <div>
        <span style="font-size:11px;font-weight:700;color:#9b4500;text-transform:uppercase;letter-spacing:.1em;display:block;margin-bottom:4px">TAT Rayong</span>
        <h2 class="text-3xl font-thai font-extrabold" style="margin:0">ข่าวประชาสัมพันธ์</h2>
      </div>
      <a href="<?php echo base_url('news'); ?>" style="display:flex;align-items:center;gap:6px;color:#005e97;font-weight:700;font-size:14px;text-decoration:none;white-space:nowrap">
        ดูทั้งหมด
        <span class="material-symbols-outlined" style="font-size:20px">trending_flat</span>
      </a>
    </div>

    <?php if (!empty($newsList)): ?>
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px">

      <!-- card ใหญ่ซ้าย — อันแรก -->
      <?php $first = $newsList[0]; ?>
      <a href="<?php echo base_url('news/'.$first->news_id); ?>" style="text-decoration:none;display:flex;flex-direction:column;background:#fff;border-radius:20px;overflow:hidden;box-shadow:0 4px 16px rgba(25,28,29,.07);border:1px solid #e5e7eb;transition:transform .2s"
         onmouseover="this.style.transform='translateY(-3px)'" onmouseout="this.style.transform=''">
        <?php if (!empty($first->thumbnail)): ?>
        <img src="<?php echo base_url($first->thumbnail); ?>"
             style="width:100%;aspect-ratio:16/9;object-fit:cover"/>
        <?php else: ?>
        <div style="width:100%;aspect-ratio:16/9;background:#f0f1f2;display:flex;align-items:center;justify-content:center">
          <span class="material-symbols-outlined" style="font-size:40px;color:#c0c7d2">newspaper</span>
        </div>
        <?php endif; ?>
        <div style="padding:20px;flex:1;display:flex;flex-direction:column;justify-content:space-between">
          <div>
            <span style="display:inline-block;font-size:10px;font-weight:700;color:#fff;background:#005e97;padding:2px 10px;border-radius:999px;margin-bottom:10px;text-transform:uppercase;letter-spacing:.06em">
              <?php echo $first->category; ?>
            </span>
            <h3 style="font-size:18px;font-weight:700;color:#191c1d;margin:0 0 8px 0;line-height:1.4"><?php echo $first->title; ?></h3>
            <?php if (!empty($first->excerpt)): ?>
            <p style="font-size:13px;color:#707882;margin:0;line-height:1.6;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden"><?php echo $first->excerpt; ?></p>
            <?php endif; ?>
          </div>
          <div style="display:flex;align-items:center;gap:8px;margin-top:14px">
            <div style="width:28px;height:28px;border-radius:50%;background:#005e97;display:flex;align-items:center;justify-content:center;flex-shrink:0">
              <span class="material-symbols-outlined" style="font-size:14px;color:#fff">person</span>
            </div>
            <div>
              <p style="font-size:12px;font-weight:600;color:#191c1d;margin:0"><?php echo $first->author_name; ?></p>
              <p style="font-size:11px;color:#b0b7c3;margin:0"><?php echo date('d M Y', strtotime($first->published_at ?: $first->created_at)); ?></p>
            </div>
          </div>
        </div>
      </a>

      <!-- 3 card เล็กขวา -->
      <div style="display:flex;flex-direction:column;gap:14px">
        <?php foreach (array_slice($newsList, 1, 3) as $n): ?>
        <a href="<?php echo base_url('news/'.$n->news_id); ?>" style="text-decoration:none;display:flex;gap:14px;background:#fff;border-radius:16px;overflow:hidden;box-shadow:0 4px 12px rgba(25,28,29,.06);border:1px solid #e5e7eb;padding:14px;align-items:flex-start;transition:transform .2s"
           onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform=''">
          <?php if (!empty($n->thumbnail)): ?>
          <img src="<?php echo base_url($n->thumbnail); ?>"
               style="width:88px;height:64px;object-fit:cover;border-radius:10px;flex-shrink:0"/>
          <?php else: ?>
          <div style="width:88px;height:64px;background:#f0f1f2;border-radius:10px;flex-shrink:0;display:flex;align-items:center;justify-content:center">
            <span class="material-symbols-outlined" style="font-size:24px;color:#c0c7d2">newspaper</span>
          </div>
          <?php endif; ?>
          <div style="flex:1;min-width:0">
            <span style="display:inline-block;font-size:9px;font-weight:700;color:#005e97;background:rgba(0,94,151,.08);padding:1px 8px;border-radius:999px;margin-bottom:5px;text-transform:uppercase;letter-spacing:.05em">
              <?php echo $n->category; ?>
            </span>
            <h4 style="font-size:14px;font-weight:700;color:#191c1d;margin:0 0 5px 0;line-height:1.4;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden"><?php echo $n->title; ?></h4>
            <p style="font-size:11px;color:#b0b7c3;margin:0"><?php echo $n->author_name; ?> · <?php echo date('d M Y', strtotime($n->published_at ?: $n->created_at)); ?></p>
          </div>
        </a>
        <?php endforeach; ?>
      </div>

    </div>
    <?php else: ?>
    <div style="text-align:center;padding:48px;color:#b0b7c3">
      <span class="material-symbols-outlined" style="font-size:48px;margin-bottom:8px;display:block">newspaper</span>
      <p>ยังไม่มีข่าวประชาสัมพันธ์</p>
    </div>
    <?php endif; ?>
  </div>
</section>

<!-- INFLUENCER BUZZ -->
<section class="py-12 px-8">
  <div class="max-w-[1280px] mx-auto">
    <div style="display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:32px;gap:16px">
      <div>
        <span style="font-size:11px;font-weight:700;color:#9b4500;text-transform:uppercase;letter-spacing:.1em;display:block;margin-bottom:4px">Trend Tracker</span>
        <h2 class="text-4xl font-thai font-black" style="margin:0">Influencer Buzz</h2>
      </div>
      <a href="#" style="display:flex;align-items:center;gap:6px;color:#005e97;font-weight:700;font-size:14px;text-decoration:none">
        ดูทั้งหมด
        <span class="material-symbols-outlined" style="font-size:20px">trending_flat</span>
      </a>
    </div>

    <!-- TikTok cards -->
    <div class="no-scrollbar" style="display:flex;gap:14px;overflow-x:auto;padding-bottom:8px;scroll-snap-type:x mandatory">
      <?php if (!empty($influencerContent)): foreach ($influencerContent as $c): ?>
      <div style="flex:none;width:calc((100% - 56px) / 5);min-width:200px;scroll-snap-align:start">
        <div onclick="openTikTokModal('<?php echo $c->tiktok_id; ?>', '<?php echo addslashes($c->title); ?>')"
             style="position:relative;border-radius:16px;overflow:hidden;aspect-ratio:9/16;cursor:pointer;background:#111;box-shadow:0 8px 24px rgba(0,0,0,.15)"
             onmouseover="this.querySelector('.play-overlay').style.opacity='1'"
             onmouseout="this.querySelector('.play-overlay').style.opacity='0'">
          <!-- Thumbnail จาก TikTok -->
          <img id="thumb-<?php echo $c->tiktok_id; ?>"
               style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;object-position:center;display:none"/>
          <!-- Fallback background -->
          <div id="fallback-<?php echo $c->tiktok_id; ?>" style="position:absolute;inset:0;background:linear-gradient(135deg,#1a1a2e 0%,#16213e 50%,#0f3460 100%);display:flex;align-items:center;justify-content:center">
            <svg width="40" height="40" viewBox="0 0 24 24" fill="white" style="opacity:.25"><path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-2.88 2.5 2.89 2.89 0 01-2.89-2.89 2.89 2.89 0 012.89-2.89c.28 0 .54.04.79.1V9.01a6.33 6.33 0 00-.79-.05 6.34 6.34 0 00-6.34 6.34 6.34 6.34 0 006.34 6.34 6.34 6.34 0 006.33-6.34V8.69a8.27 8.27 0 004.84 1.56V6.8a4.85 4.85 0 01-1.07-.11z"/></svg>
          </div>
          <!-- Play overlay -->
          <div class="play-overlay" style="position:absolute;inset:0;background:rgba(0,0,0,.35);display:flex;align-items:center;justify-content:center;opacity:0;transition:opacity .25s;z-index:2">
            <div style="width:60px;height:60px;border-radius:50%;background:rgba(255,255,255,.2);backdrop-filter:blur(10px);display:flex;align-items:center;justify-content:center;border:2px solid rgba(255,255,255,.4)">
              <span class="material-symbols-outlined" style="font-size:36px;color:#fff;font-variation-settings:'FILL' 1">play_arrow</span>
            </div>
          </div>
          <!-- ชื่อคลิป — ต้องอยู่ใน position absolute และ overflow hidden -->
          <div style="position:absolute;bottom:0;left:0;right:0;background:linear-gradient(to top,rgba(0,0,0,.92) 0%,rgba(0,0,0,.5) 60%,transparent 100%);padding:40px 14px 14px;z-index:1">
            <p style="font-size:12px;color:#fff;font-weight:600;margin:0;line-height:1.5;overflow:hidden;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;word-break:break-word">
              <?php echo $c->title; ?>
            </p>
          </div>
        </div>
      </div>
      <?php endforeach; else: ?>
      <?php foreach (array(1,2,3,4,5) as $i): ?>
      <div style="flex:none;width:calc((100% - 56px) / 5);min-width:200px;scroll-snap-align:start">
        <div style="border-radius:16px;overflow:hidden;background:linear-gradient(135deg,#1a1a2e,#16213e);aspect-ratio:9/16"></div>
      </div>
      <?php endforeach; endif; ?>
    </div>
  </div>
</section>

<!-- TikTok Modal -->
<div id="tiktok-modal"
     style="display:none;position:fixed;inset:0;z-index:9999;background:rgba(0,0,0,.85);backdrop-filter:blur(8px);align-items:center;justify-content:center"
     onclick="closeTikTokModal(event)">
  <div style="position:relative;width:360px;max-width:90vw;aspect-ratio:9/16;border-radius:20px;overflow:hidden;box-shadow:0 24px 64px rgba(0,0,0,.5)">
    <!-- Close button -->
    <button onclick="closeTikTokModal()"
            style="position:absolute;top:12px;right:12px;z-index:10;width:36px;height:36px;border-radius:50%;background:rgba(0,0,0,.5);border:none;color:#fff;cursor:pointer;display:flex;align-items:center;justify-content:center;backdrop-filter:blur(4px)">
      <span class="material-symbols-outlined" style="font-size:20px">close</span>
    </button>
    <!-- iframe -->
    <div id="tiktok-modal-frame" style="width:100%;height:100%"></div>
  </div>
  <!-- ชื่อคลิปใต้ modal -->
  <div style="position:absolute;bottom:32px;left:50%;transform:translateX(-50%);text-align:center;max-width:360px;padding:0 20px">
    <p id="tiktok-modal-title" style="color:#fff;font-size:13px;font-weight:600;line-height:1.5;text-shadow:0 2px 8px rgba(0,0,0,.8)"></p>
  </div>
</div>

<script>
function openTikTokModal(tiktokId, title) {
  var modal = document.getElementById('tiktok-modal');
  var frame = document.getElementById('tiktok-modal-frame');
  var label = document.getElementById('tiktok-modal-title');

  frame.innerHTML = '<iframe src="https://www.tiktok.com/embed/v2/' + tiktokId +
    '?autoplay=1" style="width:100%;height:100%;border:none" ' +
    'allowfullscreen allow="autoplay;encrypted-media"></iframe>';
  label.textContent = title;
  modal.style.display = 'flex';
  document.body.style.overflow = 'hidden';
}

function closeTikTokModal(event) {
  // ถ้าคลิก overlay (ไม่ใช่ content ข้างใน) หรือกดปุ่ม close
  if (event && event.target !== document.getElementById('tiktok-modal')) return;
  var modal = document.getElementById('tiktok-modal');
  var frame = document.getElementById('tiktok-modal-frame');
  frame.innerHTML = '';
  modal.style.display = 'none';
  document.body.style.overflow = '';
}

// กด ESC ปิด modal
document.addEventListener('keydown', function(e) {
  if (e.key === 'Escape') {
    var modal = document.getElementById('tiktok-modal');
    if (modal.style.display === 'flex') {
      document.getElementById('tiktok-modal-frame').innerHTML = '';
      modal.style.display = 'none';
      document.body.style.overflow = '';
    }
  }
});

// โหลด thumbnail ผ่าน backend proxy
window.addEventListener('load', function() {
  <?php if (!empty($influencerContent)): foreach ($influencerContent as $c): ?>
  (function(id) {
    $.getJSON(baseUrl + 'home/tiktok-thumb?id=' + id, function(data) {
      if (data.url) {
        var img = document.getElementById('thumb-' + id);
        var fallback = document.getElementById('fallback-' + id);
        if (img) {
          img.src = data.url;
          img.style.display = 'block';
          if (fallback) fallback.style.display = 'none';
        }
      }
    });
  })('<?php echo $c->tiktok_id; ?>');
  <?php endforeach; endif; ?>
});
</script>
