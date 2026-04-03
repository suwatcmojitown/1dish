<?php defined('BASEPATH') OR exit('No direct script access allowed');
$name = !empty($influencer->display_name) ? $influencer->display_name : $influencer->user_display_name;
?>

<style>
.inf-stats-grid  { display:grid; grid-template-columns:repeat(2,1fr); gap:12px; }
@media(min-width:640px) { .inf-stats-grid { grid-template-columns:repeat(4,1fr); } }
@media(min-width:1024px) { .inf-cover-height { height:420px !important; } }
.inf-rev-grid { display:grid; grid-template-columns:1fr; gap:16px; }
@media(min-width:640px) { .inf-rev-4-wrap { grid-template-columns:repeat(2,1fr) !important; } }
@media(min-width:1024px) { .inf-rev-4-wrap { grid-template-columns:repeat(4,1fr) !important; } }
.inf-tiktok-wrap { display:flex; gap:14px; overflow-x:auto; padding-bottom:8px; scroll-snap-type:x mandatory; }
.inf-tiktok-wrap::-webkit-scrollbar { display:none; }

@media(min-width:640px)  { .inf-stats-grid { grid-template-columns:repeat(4,1fr); } .inf-rev-grid { grid-template-columns:repeat(2,1fr); } }
@media(min-width:1024px) { .inf-rev-grid { grid-template-columns:repeat(3,1fr); } }
</style>

<!-- ───── COVER IMAGE ───── -->
<?php if (!empty($influencer->cover_image)): ?>
<section style="width:100%;height:320px;overflow:hidden;position:relative">
  <img src="<?php echo base_url($influencer->cover_image); ?>"
       style="width:100%;height:100%;object-fit:cover"/>
  <div style="position:absolute;inset:0;background:linear-gradient(to bottom,transparent 40%,rgba(25,28,29,.5) 100%)"></div>
</section>
<?php else: ?>
<section style="width:100%;height:200px;background:linear-gradient(135deg,#005e97 0%,#003d66 100%)"></section>
<?php endif; ?>

<!-- ───── PROFILE HEADER ───── -->
<section class="py-12 px-8">
  <div class="max-w-[1280px] mx-auto">
    <div style="display:flex;flex-wrap:wrap;gap:28px;align-items:flex-start">

      <!-- Avatar -->
      <div style="position:relative;flex-shrink:0">
        <?php if (!empty($influencer->avatar)): ?>
        <img src="<?php echo base_url($influencer->avatar); ?>"
             style="width:140px;height:140px;border-radius:20px;object-fit:cover;box-shadow:0 8px 24px rgba(25,28,29,.12)"/>
        <?php else: ?>
        <div style="width:140px;height:140px;border-radius:20px;background:#005e97;display:flex;align-items:center;justify-content:center;box-shadow:0 8px 24px rgba(25,28,29,.12)">
          <span style="font-size:52px;font-weight:900;color:#fff"><?php echo mb_substr($name,0,1); ?></span>
        </div>
        <?php endif; ?>
        <?php if ($influencer->is_tat_verified): ?>
        <div style="position:absolute;bottom:-10px;left:50%;transform:translateX(-50%);background:#fff;border-radius:999px;padding:4px 12px;display:flex;align-items:center;gap:5px;box-shadow:0 2px 8px rgba(25,28,29,.12);border:1px solid #e5e7eb;white-space:nowrap">
          <span class="material-symbols-outlined" style="font-size:13px;color:#005e97;font-variation-settings:'FILL' 1">verified</span>
          <span style="font-size:9px;font-weight:700;color:#191c1d;text-transform:uppercase;letter-spacing:.07em">TAT Verified</span>
        </div>
        <?php endif; ?>
      </div>

      <!-- Info -->
      <div style="flex:1;min-width:220px">
        <h1 class="font-thai" style="font-size:clamp(28px,4vw,48px);font-weight:900;color:#191c1d;margin:0 0 10px 0;line-height:1.15">
          <?php echo $name; ?>
        </h1>
        <?php if (!empty($influencer->bio)): ?>
        <p style="font-size:15px;color:#707882;line-height:1.7;margin:0 0 20px 0;max-width:600px"><?php echo $influencer->bio; ?></p>
        <?php endif; ?>
        <!-- Social buttons -->
        <div style="display:flex;flex-wrap:wrap;gap:8px">
          <?php if (!empty($influencer->tiktok_url)): ?>
          <a href="<?php echo $influencer->tiktok_url; ?>" target="_blank" rel="noopener"
             style="display:flex;align-items:center;gap:7px;background:#111;color:#fff;padding:10px 18px;border-radius:999px;font-size:13px;font-weight:700;text-decoration:none;transition:opacity .2s"
             onmouseover="this.style.opacity='.8'" onmouseout="this.style.opacity='1'">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="white"><path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-2.88 2.5 2.89 2.89 0 01-2.89-2.89 2.89 2.89 0 012.89-2.89c.28 0 .54.04.79.1V9.01a6.33 6.33 0 00-.79-.05 6.34 6.34 0 00-6.34 6.34 6.34 6.34 0 006.34 6.34 6.34 6.34 0 006.33-6.34V8.69a8.27 8.27 0 004.84 1.56V6.8a4.85 4.85 0 01-1.07-.11z"/></svg>
            TikTok
          </a>
          <?php endif; ?>
          <?php if (!empty($influencer->ig_url)): ?>
          <a href="<?php echo $influencer->ig_url; ?>" target="_blank" rel="noopener"
             style="display:flex;align-items:center;gap:7px;background:linear-gradient(135deg,#f09433,#e6683c,#dc2743,#cc2366,#bc1888);color:#fff;padding:10px 18px;border-radius:999px;font-size:13px;font-weight:700;text-decoration:none;transition:opacity .2s"
             onmouseover="this.style.opacity='.8'" onmouseout="this.style.opacity='1'">
            <span class="material-symbols-outlined" style="font-size:15px">photo_camera</span>Instagram
          </a>
          <?php endif; ?>
          <?php if (!empty($influencer->youtube_url)): ?>
          <a href="<?php echo $influencer->youtube_url; ?>" target="_blank" rel="noopener"
             style="display:flex;align-items:center;gap:7px;background:#ff0000;color:#fff;padding:10px 18px;border-radius:999px;font-size:13px;font-weight:700;text-decoration:none;transition:opacity .2s"
             onmouseover="this.style.opacity='.8'" onmouseout="this.style.opacity='1'">
            <span class="material-symbols-outlined" style="font-size:15px;font-variation-settings:'FILL' 1">play_circle</span>YouTube
          </a>
          <?php endif; ?>
          <?php if ($influencer->is_tat_verified): ?>
          <div style="display:flex;align-items:center;gap:7px;background:rgba(0,129,115,.08);color:#00665a;padding:10px 18px;border-radius:999px;font-size:13px;font-weight:700;border:1px solid rgba(0,129,115,.2)">
            <span class="material-symbols-outlined" style="font-size:15px">handshake</span>พันธมิตร ททท. ระยอง
          </div>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <!-- Stats -->
    <div class="inf-stats-grid" style="margin-top:40px">
      <?php
      $stats = array(
        array('val'=>$influencer->trusted_review_count, 'label'=>'รีวิวที่น่าเชื่อถือ', 'color'=>'#005e97'),
        array('val'=>$influencer->district_explored,    'label'=>'อำเภอที่สำรวจ',       'color'=>'#9b4500'),
        array('val'=>number_format((float)$influencer->avg_score,1), 'label'=>'คะแนนเฉลี่ย', 'color'=>'#00665a'),
        array('val'=>$influencer->traveler_guided>=1000 ? round($influencer->traveler_guided/1000).'k' : $influencer->traveler_guided,
              'label'=>'นักท่องเที่ยวที่แนะนำ', 'color'=>'#191c1d'),
      );
      foreach ($stats as $s): ?>
      <div style="background:#fff;border-radius:16px;padding:20px;text-align:center;border:1px solid #e5e7eb;box-shadow:0 4px 12px rgba(25,28,29,.05)">
        <div style="font-size:34px;font-weight:900;color:<?php echo $s['color']; ?>;line-height:1"><?php echo $s['val']; ?></div>
        <div style="font-size:10px;font-weight:700;color:#707882;text-transform:uppercase;letter-spacing:.08em;margin-top:5px"><?php echo $s['label']; ?></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ───── TIKTOK SECTION ───── -->
<?php if (!empty($tiktoks)): ?>
<section class="py-12 px-8" style="background:#191c1d">
  <div class="max-w-[1280px] mx-auto">
    <div style="display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:28px;gap:12px;flex-wrap:wrap">
      <div>
        <span style="font-size:10px;font-weight:700;color:rgba(255,255,255,.4);text-transform:uppercase;letter-spacing:.12em;display:block;margin-bottom:6px">Social Bites</span>
        <h2 class="font-thai" style="font-size:28px;font-weight:900;color:#fff;margin:0;font-style:italic;display:flex;align-items:center;gap:8px">
          <span class="material-symbols-outlined" style="font-size:22px">music_note</span>TikTok Journeys
        </h2>
      </div>
    </div>
    <div class="inf-tiktok-wrap">
      <?php foreach ($tiktoks as $t): ?>
      <div style="flex:none;width:220px;scroll-snap-align:start">
        <div onclick="openTikTokModal('<?php echo $t->tiktok_id; ?>','<?php echo addslashes($t->title); ?>')"
             style="position:relative;border-radius:16px;overflow:hidden;aspect-ratio:9/16;cursor:pointer;background:#111;box-shadow:0 8px 24px rgba(0,0,0,.3)"
             onmouseover="this.querySelector('.inf-play').style.opacity='1'"
             onmouseout="this.querySelector('.inf-play').style.opacity='0'">
          <img id="inf-thumb-<?php echo $t->tiktok_id; ?>"
               style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;display:none"/>
          <div id="inf-fallback-<?php echo $t->tiktok_id; ?>" style="position:absolute;inset:0;background:linear-gradient(135deg,#1a1a2e,#16213e);display:flex;align-items:center;justify-content:center">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="white" style="opacity:.2"><path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-2.88 2.5 2.89 2.89 0 01-2.89-2.89 2.89 2.89 0 012.89-2.89c.28 0 .54.04.79.1V9.01a6.33 6.33 0 00-.79-.05 6.34 6.34 0 00-6.34 6.34 6.34 6.34 0 006.34 6.34 6.34 6.34 0 006.33-6.34V8.69a8.27 8.27 0 004.84 1.56V6.8a4.85 4.85 0 01-1.07-.11z"/></svg>
          </div>
          <div class="inf-play" style="position:absolute;inset:0;background:rgba(0,0,0,.35);display:flex;align-items:center;justify-content:center;opacity:0;transition:opacity .25s;z-index:2">
            <div style="width:52px;height:52px;border-radius:50%;background:rgba(255,255,255,.2);backdrop-filter:blur(10px);display:flex;align-items:center;justify-content:center;border:2px solid rgba(255,255,255,.4)">
              <span class="material-symbols-outlined" style="font-size:30px;color:#fff;font-variation-settings:'FILL' 1">play_arrow</span>
            </div>
          </div>
          <div style="position:absolute;bottom:0;left:0;right:0;background:linear-gradient(to top,rgba(0,0,0,.9),transparent);padding:24px 12px 12px;z-index:1">
            <p style="font-size:11px;color:#fff;font-weight:600;margin:0;line-height:1.4;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden"><?php echo $t->title; ?></p>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ───── REVIEWS SECTION ───── -->
<section class="py-12 px-8">
  <div class="max-w-[1280px] mx-auto">
    <div style="display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:28px;gap:12px;flex-wrap:wrap">
      <div>
        <span style="font-size:11px;font-weight:700;color:#9b4500;text-transform:uppercase;letter-spacing:.1em;display:block;margin-bottom:4px">One Dish Reviews</span>
        <h2 class="font-thai" style="font-size:28px;font-weight:900;margin:0">รีวิวทั้งหมด</h2>
      </div>
    </div>

    <?php if (!empty($reviews)): ?>
    <div class="inf-rev-4-wrap" style="display:grid;grid-template-columns:repeat(2,1fr);gap:16px">
      <style>
        @media(min-width:768px) { .inf-rev-4-wrap { grid-template-columns:repeat(4,1fr) !important; } }
      </style>
      <?php foreach ($reviews as $r): ?>
      <a href="<?php echo base_url('place/'.$r->place_id); ?>"
         style="text-decoration:none;display:flex;flex-direction:column;background:#fff;border-radius:20px;overflow:hidden;box-shadow:0 4px 16px rgba(25,28,29,.07);border:1px solid #e5e7eb;transition:transform .2s,box-shadow .2s"
         onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 12px 28px rgba(25,28,29,.12)'"
         onmouseout="this.style.transform='';this.style.boxShadow='0 4px 16px rgba(25,28,29,.07)'">
        <!-- รูป 16:9 -->
        <div style="position:relative;overflow:hidden;aspect-ratio:16/9">
          <?php $img = !empty($r->cover_image) ? base_url($r->cover_image) : ''; ?>
          <?php if ($img): ?>
          <img src="<?php echo $img; ?>" style="width:100%;height:100%;object-fit:cover;transition:transform .5s"
               onmouseover="this.style.transform='scale(1.06)'" onmouseout="this.style.transform=''"/>
          <?php else: ?>
          <div style="width:100%;height:100%;background:#f0f1f2;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:8px">
            <svg width="36" height="36" fill="none" stroke="#c0c7d2" stroke-width="1.5" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/></svg>
            <span style="font-size:11px;color:#c0c7d2">ยังไม่มีรูปภาพ</span>
          </div>
          <?php endif; ?>
          <!-- category badge -->
          <?php if (!empty($r->status)): ?>
          <?php if ($r->status == 'approved_seal'): ?>
          <div style="position:absolute;top:10px;right:10px;background:rgba(255,255,255,.9);backdrop-filter:blur(6px);border-radius:8px;padding:3px 9px;display:flex;align-items:center;gap:3px;box-shadow:0 2px 6px rgba(0,0,0,.1)">
            <span class="material-symbols-outlined" style="font-size:11px;color:#005e97;font-variation-settings:'FILL' 1">verified</span>
            <span style="font-size:8px;font-weight:700;color:#191c1d;text-transform:uppercase;letter-spacing:.05em">Seal</span>
          </div>
          <?php endif; ?>
          <?php endif; ?>
        </div>
        <!-- ข้อมูล -->
        <div style="padding:14px 16px 16px;flex:1;display:flex;flex-direction:column;gap:6px">
          <h3 style="font-size:14px;font-weight:700;color:#191c1d;margin:0;line-height:1.35;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden">
            <?php echo !empty($r->title) ? $r->title : $r->place_name; ?>
          </h3>
          <p style="font-size:11px;color:#707882;margin:0;display:flex;align-items:center;gap:3px">
            <span class="material-symbols-outlined" style="font-size:12px;color:#b0b7c3">location_on</span>
            <?php echo $r->place_name; ?><?php if (!empty($r->district_name)): ?>, <?php echo $r->district_name; ?><?php endif; ?>
          </p>
          <?php if (!empty($r->signature_dish_name)): ?>
          <div style="margin-top:4px;display:flex;align-items:center;gap:6px;background:#005e97;border-radius:10px;padding:8px 12px">
            <span class="material-symbols-outlined" style="font-size:14px;color:#fff;font-variation-settings:'FILL' 1;flex-shrink:0">stars</span>
            <div style="min-width:0">
              
              <p style="font-size:14px;color:#fff;font-weight:700;margin:0;overflow:hidden;text-overflow:ellipsis;white-space:nowrap"><?php echo $r->signature_dish_name; ?></p>
            </div>
          </div>
          <?php endif; ?>
        </div>
      </a>
      <?php endforeach; ?>
    </div>

    <!-- PAGINATION -->
    <?php $totalPage = ceil($total / $limit); if ($totalPage > 1): ?>
    <div style="display:flex;justify-content:center;align-items:center;gap:6px;margin-top:40px">
      <?php if ($page > 1): ?>
      <a href="<?php echo base_url('curator/'.$influencer->influencer_id.'?page='.($page-1)); ?>"
         style="width:36px;height:36px;border-radius:8px;border:1px solid #e5e7eb;background:#fff;display:flex;align-items:center;justify-content:center;color:#005e97;text-decoration:none">
        <span class="material-symbols-outlined" style="font-size:18px">chevron_left</span>
      </a>
      <?php endif; ?>
      <?php for ($i=1; $i<=$totalPage; $i++):
        if ($i===1 || $i===$totalPage || ($i>=$page-1 && $i<=$page+1)): ?>
      <a href="<?php echo base_url('curator/'.$influencer->influencer_id.'?page='.$i); ?>"
         style="width:36px;height:36px;border-radius:8px;border:1px solid <?php echo $i==$page?'#005e97':'#e5e7eb'; ?>;background:<?php echo $i==$page?'#005e97':'#fff'; ?>;color:<?php echo $i==$page?'#fff':'#191c1d'; ?>;font-weight:<?php echo $i==$page?'700':'500'; ?>;display:flex;align-items:center;justify-content:center;font-size:13px;text-decoration:none">
        <?php echo $i; ?>
      </a>
      <?php elseif ($i===$page-2 || $i===$page+2): ?>
      <span style="color:#b0b7c3;align-self:center">···</span>
      <?php endif; ?>
      <?php endfor; ?>
      <?php if ($page < $totalPage): ?>
      <a href="<?php echo base_url('curator/'.$influencer->influencer_id.'?page='.($page+1)); ?>"
         style="width:36px;height:36px;border-radius:8px;border:1px solid #e5e7eb;background:#fff;display:flex;align-items:center;justify-content:center;color:#005e97;text-decoration:none">
        <span class="material-symbols-outlined" style="font-size:18px">chevron_right</span>
      </a>
      <?php endif; ?>
    </div>
    <?php endif; ?>

    <?php else: ?>
    <div style="text-align:center;padding:80px 0;color:#b0b7c3">
      <span class="material-symbols-outlined" style="font-size:56px;display:block;margin-bottom:12px">rate_review</span>
      <p style="font-size:15px;font-weight:600">ยังไม่มีรีวิวที่เผยแพร่</p>
    </div>
    <?php endif; ?>
  </div>
</section>

<!-- TikTok Modal -->
<div id="tiktok-modal"
     style="display:none;position:fixed;inset:0;z-index:9999;background:rgba(0,0,0,.85);backdrop-filter:blur(8px);align-items:center;justify-content:center"
     onclick="closeTikTokModal(event)">
  <div style="position:relative;width:340px;max-width:90vw;aspect-ratio:9/16;border-radius:20px;overflow:hidden;box-shadow:0 24px 64px rgba(0,0,0,.5)">
    <button onclick="closeTikTokModalBtn()"
            style="position:absolute;top:12px;right:12px;z-index:10;width:36px;height:36px;border-radius:50%;background:rgba(0,0,0,.5);border:none;color:#fff;cursor:pointer;display:flex;align-items:center;justify-content:center">
      <span class="material-symbols-outlined" style="font-size:20px">close</span>
    </button>
    <div id="tiktok-modal-frame" style="width:100%;height:100%"></div>
  </div>
  <div style="position:absolute;bottom:28px;left:50%;transform:translateX(-50%);text-align:center;max-width:340px;padding:0 20px">
    <p id="tiktok-modal-title" style="color:#fff;font-size:13px;font-weight:600;line-height:1.5;text-shadow:0 2px 8px rgba(0,0,0,.8)"></p>
  </div>
</div>

<script>
var baseUrl = '<?php echo base_url(); ?>';

window.addEventListener('load', function() {
  <?php foreach ($tiktoks as $t): ?>
  (function(id) {
    $.getJSON(baseUrl + 'home/tiktok-thumb?id=' + id, function(data) {
      if (data.url) {
        var img = document.getElementById('inf-thumb-' + id);
        var fb  = document.getElementById('inf-fallback-' + id);
        if (img) { img.src = data.url; img.style.display = 'block'; }
        if (fb)  fb.style.display = 'none';
      }
    });
  })('<?php echo $t->tiktok_id; ?>');
  <?php endforeach; ?>
});

function openTikTokModal(id, title) {
  var modal = document.getElementById('tiktok-modal');
  document.getElementById('tiktok-modal-title').textContent = title;
  document.getElementById('tiktok-modal-frame').innerHTML =
    '<iframe src="https://www.tiktok.com/embed/v2/' + id +
    '?autoplay=1" style="width:100%;height:100%;border:none" allowfullscreen allow="autoplay;encrypted-media"></iframe>';
  modal.style.display = 'flex';
  document.body.style.overflow = 'hidden';
}
function closeTikTokModal(e) {
  if (e.target !== document.getElementById('tiktok-modal')) return;
  closeTikTokModalBtn();
}
function closeTikTokModalBtn() {
  document.getElementById('tiktok-modal-frame').innerHTML = '';
  document.getElementById('tiktok-modal').style.display = 'none';
  document.body.style.overflow = '';
}
document.addEventListener('keydown', function(e) { if (e.key==='Escape') closeTikTokModalBtn(); });
</script>
