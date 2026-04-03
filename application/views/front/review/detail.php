<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<style>
/* Responsive review page */
.review-hero-text { padding: 28px 20px; }
.review-hero-text h1 { font-size: 28px; }
.review-layout { display: flex; flex-direction: column; gap: 32px; padding: 28px 16px 60px; }
.review-sidebar { position: static; }
.review-article { font-size: 15px; }

.review-body img {
  display: block !important;
  max-width: 100% !important;
  width: 100% !important;
  height: auto !important;
  border-radius: 16px;
  margin: 24px auto !important;
  object-fit: cover;
}
.review-body p { margin: 0 0 16px 0; }
.review-body ul, .review-body ol { padding-left: 20px; margin: 0 0 16px 0; }
.review-body li { margin-bottom: 8px; }
.review-body blockquote {
  border-left: 4px solid #005e97;
  margin: 24px 0;
  padding: 12px 20px;
  background: #f3f4f5;
  border-radius: 0 12px 12px 0;
  color: #005e97;
  font-style: italic;
  font-weight: 600;
}

@media (min-width: 768px) {
  .review-hero-text { padding: 40px 48px; }
  .review-hero-text h1 { font-size: 40px; }
  .review-layout { padding: 40px 32px 80px; }
}

@media (min-width: 1024px) {
  .review-hero-text { padding: 48px 64px; max-width: 800px; }
  .review-hero-text h1 { font-size: 52px; }
  .review-layout { flex-direction: row; align-items: flex-start; gap: 48px; padding: 48px 32px 80px; }
  .review-main { flex: 1; min-width: 0; }
  .review-sidebar { position: sticky; top: 88px; width: 360px; flex-shrink: 0; }
  .review-article { font-size: 17px; }
}
</style>

<!-- HERO -->
<section style="position:relative;width:100%;height:420px;overflow:hidden">
  <?php $heroImg = !empty($review->cover_image) ? base_url($review->cover_image) : (!empty($review->shop_image) ? base_url($review->shop_image) : ''); ?>
  <?php if ($heroImg): ?>
  <img src="<?php echo $heroImg; ?>" alt="<?php echo $review->place_name; ?>"
       style="width:100%;height:100%;object-fit:cover"/>
  <?php else: ?>
  <div style="width:100%;height:100%;background:linear-gradient(135deg,#005e97,#003d66)"></div>
  <?php endif; ?>
  <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(25,28,29,.85) 0%,rgba(25,28,29,.2) 50%,transparent 100%)"></div>
  <div class="review-hero-text" style="position:absolute;bottom:0;left:0;right:0">
    <div style="display:flex;align-items:center;gap:8px;margin-bottom:12px;flex-wrap:wrap">
      <?php if (!empty($review->category_name)): ?>
      <span style="background:#fc8a40;color:#fff;font-size:11px;font-weight:700;padding:4px 12px;border-radius:999px;text-transform:uppercase;letter-spacing:.06em">
        <?php echo $review->category_name; ?>
      </span>
      <?php endif; ?>
      <?php if ($review->status == 'approved_seal'): ?>
      <div style="background:rgba(248,249,250,.15);backdrop-filter:blur(8px);padding:4px 12px;border-radius:999px;display:flex;align-items:center;gap:6px">
        <span class="material-symbols-outlined" style="font-size:13px;color:#fff;font-variation-settings:'FILL' 1">verified</span>
        <span style="font-size:10px;font-weight:700;color:#fff;text-transform:uppercase;letter-spacing:.08em">แนะนำโดย ททท. ระยอง</span>
      </div>
      <?php endif; ?>
    </div>
    <h1 class="font-thai review-hero-text" style="font-weight:900;color:#fff;margin:0 0 8px 0;line-height:1.2;padding:0">
      <?php echo !empty($review->title) ? $review->title : $review->place_name; ?>
    </h1>
    <?php if (!empty($review->signature_dish_name)): ?>
    <p style="font-size:15px;color:rgba(255,255,255,.8);margin:0"><?php echo $review->signature_dish_name; ?></p>
    <?php endif; ?>
  </div>
</section>

<!-- MAIN CONTENT -->
<div style="max-width:1280px;margin:0 auto">
  <div class="review-layout">

    <!-- LEFT -->
    <div class="review-main">

      <!-- Reviewer -->
      <div style="display:flex;align-items:center;gap:14px;padding-bottom:24px;margin-bottom:24px;border-bottom:1px solid #e5e7eb;flex-wrap:wrap">
        <?php if (!empty($review->reviewer_avatar)): ?>
        <img src="<?php echo base_url($review->reviewer_avatar); ?>"
             style="width:52px;height:52px;border-radius:50%;object-fit:cover;flex-shrink:0"/>
        <?php else: ?>
        <div style="width:52px;height:52px;border-radius:50%;background:#005e97;display:flex;align-items:center;justify-content:center;color:#fff;font-size:18px;font-weight:700;flex-shrink:0">
          <?php echo strtoupper(mb_substr($review->reviewer_name ?? 'R', 0, 1)); ?>
        </div>
        <?php endif; ?>
        <div style="flex:1;min-width:0">
          <p style="font-size:16px;font-weight:700;color:#191c1d;margin:0">
            <?php echo !empty($review->reviewer_name) ? $review->reviewer_name : 'ผู้เขียน'; ?>
          </p>
          <?php if (!empty($review->reviewer_bio)): ?>
          <p style="font-size:12px;color:#707882;margin:3px 0 0 0"><?php echo $review->reviewer_bio; ?></p>
          <?php endif; ?>
        </div>
      </div>

      <!-- บทความ -->
      <?php if (!empty($review->body)): ?>
      <article class="review-article review-body" style="line-height:1.85;color:#404751;margin-bottom:36px">
        <?php echo $review->body; ?>
      </article>
      <?php endif; ?>

      <!-- TikTok Video -->
      <?php if (!empty($review->tiktok_url)):
        preg_match('/\/video\/(\d+)/', $review->tiktok_url, $m);
        $tiktok_id = !empty($m[1]) ? $m[1] : '';
      ?>
      <?php if ($tiktok_id): ?>
      <div style="background:#f3f4f5;border-radius:20px;padding:24px;margin-bottom:36px;border:1px solid #e5e7eb">
        <div style="display:flex;align-items:center;gap:10px;margin-bottom:20px">
          <span class="material-symbols-outlined" style="color:#9b4500;font-size:28px">play_circle</span>
          <h3 class="font-thai" style="font-size:18px;font-weight:700;margin:0">เส้นทางแห่งรสชาติ (วิดีโอ)</h3>
        </div>
        <div style="position:relative;max-width:300px;margin:0 auto;aspect-ratio:9/16;border-radius:16px;overflow:hidden;cursor:pointer;background:#000"
             onclick="playReviewTikTok(this, '<?php echo $tiktok_id; ?>')">
          <img id="review-thumb-<?php echo $tiktok_id; ?>"
               style="width:100%;height:100%;object-fit:cover;display:none"/>
          <div id="review-fallback-<?php echo $tiktok_id; ?>" style="position:absolute;inset:0;background:linear-gradient(135deg,#1a1a2e,#16213e);display:flex;align-items:center;justify-content:center">
            <svg width="36" height="36" viewBox="0 0 24 24" fill="white" style="opacity:.3"><path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-2.88 2.5 2.89 2.89 0 01-2.89-2.89 2.89 2.89 0 012.89-2.89c.28 0 .54.04.79.1V9.01a6.33 6.33 0 00-.79-.05 6.34 6.34 0 00-6.34 6.34 6.34 6.34 0 006.34 6.34 6.34 6.34 0 006.33-6.34V8.69a8.27 8.27 0 004.84 1.56V6.8a4.85 4.85 0 01-1.07-.11z"/></svg>
          </div>
          <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;z-index:1">
            <div style="width:60px;height:60px;border-radius:50%;background:rgba(255,255,255,.2);backdrop-filter:blur(10px);display:flex;align-items:center;justify-content:center;border:2px solid rgba(255,255,255,.4)">
              <span class="material-symbols-outlined" style="font-size:34px;color:#fff;font-variation-settings:'FILL' 1">play_arrow</span>
            </div>
          </div>
          <div class="tiktok-frame" style="position:absolute;inset:0;display:none"></div>
          <div style="position:absolute;bottom:0;left:0;right:0;background:linear-gradient(to top,rgba(0,0,0,.85),transparent);padding:20px 14px 14px;z-index:1">
            <p style="font-size:12px;color:#fff;font-weight:600;margin:0;line-height:1.4">
              <?php echo !empty($review->title) ? $review->title : $review->place_name; ?>
            </p>
          </div>
        </div>
      </div>
      <?php endif; ?>
      <?php endif; ?>

      <!-- Phase 2: comment -->

    </div>

    <!-- RIGHT: Sidebar -->
    <div class="review-sidebar" style="display:flex;flex-direction:column;gap:16px">

      <div style="background:#fff;border-radius:20px;padding:24px;box-shadow:0 4px 16px rgba(25,28,29,.06);border:1px solid #e5e7eb">

        <h4 class="font-thai" style="font-size:20px;font-weight:800;color:#005e97;margin:0 0 18px 0">
          <?php echo $review->place_name; ?>
        </h4>

        <!-- เวลาเปิดปิด -->
        <?php if (!empty($review->open_hours)): ?>
        <div style="display:flex;gap:10px;align-items:flex-start;margin-bottom:14px">
          <span class="material-symbols-outlined" style="color:#9b4500;font-size:20px;flex-shrink:0;margin-top:1px">schedule</span>
          <div>
            <p style="font-size:11px;font-weight:700;color:#707882;text-transform:uppercase;letter-spacing:.06em;margin:0 0 2px 0">เวลาเปิด-ปิด</p>
            <p style="font-size:13px;color:#191c1d;margin:0;line-height:1.5"><?php echo nl2br($review->open_hours); ?></p>
          </div>
        </div>
        <?php endif; ?>

        <!-- รูปหน้าร้าน -->
        <?php if (!empty($review->shop_image)): ?>
        <div style="border-radius:12px;overflow:hidden;aspect-ratio:4/3;margin-bottom:14px">
          <img src="<?php echo base_url($review->shop_image); ?>"
               style="width:100%;height:100%;object-fit:cover"/>
        </div>
        <?php endif; ?>

        <!-- Google Maps -->
        <?php if (!empty($review->lat) && $review->lat != 0): ?>
        <a href="https://www.google.com/maps?q=<?php echo $review->lat; ?>,<?php echo $review->lng; ?>"
           target="_blank" rel="noopener"
           style="display:flex;align-items:center;justify-content:center;gap:8px;background:#005e97;color:#fff;padding:11px 16px;border-radius:12px;text-decoration:none;font-size:14px;font-weight:700;margin-bottom:14px;transition:opacity .2s"
           onmouseover="this.style.opacity='.85'" onmouseout="this.style.opacity='1'">
          <span class="material-symbols-outlined" style="font-size:17px;font-variation-settings:'FILL' 1">near_me</span>
          นำทางไปร้านนี้
        </a>
        <?php endif; ?>

        <!-- Social links -->
        <?php if (!empty($review->fb_url) || !empty($review->ig_url) || !empty($review->place_tiktok)): ?>
        <div style="display:flex;flex-direction:column;gap:8px">
          <?php if (!empty($review->fb_url)): ?>
          <a href="<?php echo $review->fb_url; ?>" target="_blank" rel="noopener"
             style="display:flex;align-items:center;justify-content:space-between;padding:10px 14px;background:#f3f4f5;border-radius:10px;text-decoration:none;transition:background .2s"
             onmouseover="this.style.background='#e5e7eb'" onmouseout="this.style.background='#f3f4f5'">
            <span style="display:flex;align-items:center;gap:10px;font-size:13px;font-weight:700;color:#191c1d">
              <span class="material-symbols-outlined" style="color:#1877f2;font-size:18px">social_leaderboard</span>Facebook
            </span>
            <span class="material-symbols-outlined" style="font-size:16px;color:#b0b7c3">chevron_right</span>
          </a>
          <?php endif; ?>
          <?php if (!empty($review->ig_url)): ?>
          <a href="<?php echo $review->ig_url; ?>" target="_blank" rel="noopener"
             style="display:flex;align-items:center;justify-content:space-between;padding:10px 14px;background:#f3f4f5;border-radius:10px;text-decoration:none;transition:background .2s"
             onmouseover="this.style.background='#e5e7eb'" onmouseout="this.style.background='#f3f4f5'">
            <span style="display:flex;align-items:center;gap:10px;font-size:13px;font-weight:700;color:#191c1d">
              <span class="material-symbols-outlined" style="color:#e1306c;font-size:18px">photo_camera</span>Instagram
            </span>
            <span class="material-symbols-outlined" style="font-size:16px;color:#b0b7c3">chevron_right</span>
          </a>
          <?php endif; ?>
          <?php if (!empty($review->place_tiktok)): ?>
          <a href="<?php echo $review->place_tiktok; ?>" target="_blank" rel="noopener"
             style="display:flex;align-items:center;justify-content:space-between;padding:10px 14px;background:#f3f4f5;border-radius:10px;text-decoration:none;transition:background .2s"
             onmouseover="this.style.background='#e5e7eb'" onmouseout="this.style.background='#f3f4f5'">
            <span style="display:flex;align-items:center;gap:10px;font-size:13px;font-weight:700;color:#191c1d">
              <span class="material-symbols-outlined" style="font-size:18px">music_note</span>TikTok
            </span>
            <span class="material-symbols-outlined" style="font-size:16px;color:#b0b7c3">chevron_right</span>
          </a>
          <?php endif; ?>
        </div>
        <?php endif; ?>

      </div>
    </div>
  </div>
</div>

<script>
var baseUrl = '<?php echo base_url(); ?>';

function playReviewTikTok(el, id) {
  var frame = el.querySelector('.tiktok-frame');
  var play  = el.querySelector('div[style*="position:absolute;inset:0;display:flex"]');
  if (frame) {
    frame.style.display = 'block';
    frame.innerHTML = '<iframe src="https://www.tiktok.com/embed/v2/' + id + '?autoplay=1" style="width:100%;height:100%;border:none" allowfullscreen allow="autoplay;encrypted-media"></iframe>';
  }
  if (play) play.style.display = 'none';
}

<?php if (!empty($tiktok_id)): ?>
window.addEventListener('load', function() {
  $.getJSON(baseUrl + 'home/tiktok-thumb?id=<?php echo $tiktok_id; ?>', function(data) {
    if (data.url) {
      var img      = document.getElementById('review-thumb-<?php echo $tiktok_id; ?>');
      var fallback = document.getElementById('review-fallback-<?php echo $tiktok_id; ?>');
      if (img) { img.src = data.url; img.style.display = 'block'; }
      if (fallback) fallback.style.display = 'none';
    }
  });
});
<?php endif; ?>
</script>
