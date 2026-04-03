<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<style>
.news-body img,
.news-body img.fr-fic,
.news-body img.fr-dib { display:block !important; max-width:100% !important; width:100% !important; height:auto !important; border-radius:12px; margin:24px auto !important; }
.news-body p   { margin:0 0 20px 0; line-height:1.9; }
.news-body h2  { font-size:clamp(18px,3vw,24px); font-weight:700; color:#005e97; margin:40px 0 16px 0; }
.news-body h3  { font-size:clamp(16px,2.5vw,20px); font-weight:700; margin:32px 0 12px 0; }
.news-body blockquote { border-left:4px solid #005e97; margin:28px 0; padding:16px 24px; background:#f3f4f5; border-radius:0 12px 12px 0; color:#9b4500; font-weight:600; font-size:clamp(15px,2vw,18px); }
.news-body ul, .news-body ol { padding-left:20px; margin:0 0 20px 0; }
.news-body li  { margin-bottom:8px; line-height:1.7; }
.news-body figure { margin:32px 0; }
.news-body figcaption { text-align:center; font-size:13px; color:#707882; margin-top:8px; }

/* share bar mobile */
.share-bar-mobile { display:flex; gap:8px; margin-bottom:24px; }
.share-bar-desktop { display:none; }
@media(min-width:1024px) {
  .share-bar-mobile { display:none; }
  .share-bar-desktop { display:flex; }
}

/* sidebar */
.news-detail-layout { display:block; }
.news-detail-sidebar { display:none; }
@media(min-width:1024px) {
  .news-detail-layout { display:grid; grid-template-columns:48px 1fr 300px; gap:32px; }
  .news-detail-sidebar { display:flex; }
}
</style>

<!-- HERO -->
<section style="position:relative;width:100%;height:clamp(240px,45vw,480px);overflow:hidden">
  <?php if (!empty($news->thumbnail)): ?>
  <img src="<?php echo base_url($news->thumbnail); ?>" style="width:100%;height:100%;object-fit:cover"/>
  <?php else: ?>
  <div style="width:100%;height:100%;background:linear-gradient(135deg,#005e97,#003d66)"></div>
  <?php endif; ?>
  <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(25,28,29,.85) 0%,rgba(25,28,29,.2) 50%,transparent 100%)"></div>
  <div style="position:absolute;bottom:0;left:0;right:0;padding:clamp(16px,4vw,80px)">
    <div style="max-width:900px">
      <span style="background:#fc8a40;color:#fff;font-size:11px;font-weight:700;padding:4px 14px;border-radius:999px;text-transform:uppercase;letter-spacing:.06em;display:inline-block;margin-bottom:12px">
        <?php echo $news->category; ?>
      </span>
      <h1 class="font-thai" style="font-size:clamp(18px,4vw,48px);font-weight:900;color:#fff;margin:0 0 14px 0;line-height:1.2">
        <?php echo $news->title; ?>
      </h1>
      <div style="display:flex;align-items:center;gap:12px;flex-wrap:wrap">
        <div style="display:flex;align-items:center;gap:8px">
          <div style="width:28px;height:28px;border-radius:50%;background:#005e97;display:flex;align-items:center;justify-content:center;color:#fff;font-size:11px;font-weight:700;flex-shrink:0">
            <?php echo mb_substr($news->author_name ?? 'A', 0, 1); ?>
          </div>
          <span style="font-size:13px;color:rgba(255,255,255,.9);font-weight:600"><?php echo $news->author_name ?? 'Editorial Staff'; ?></span>
        </div>
        <span style="width:4px;height:4px;border-radius:50%;background:rgba(255,255,255,.4)"></span>
        <span style="font-size:13px;color:rgba(255,255,255,.8)">
          <?php
            $date = $news->published_at ?: $news->created_at;
            $months = array('','ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.');
            echo date('j', strtotime($date)) . ' ' . $months[(int)date('n', strtotime($date))] . ' ' . (date('Y', strtotime($date)) + 543);
          ?>
        </span>
      </div>
    </div>
  </div>
</section>

<!-- MAIN -->
<div style="max-width:1280px;margin:0 auto;padding:32px 24px 64px">

  <!-- Share bar mobile -->
  <div class="share-bar-mobile">
    <button onclick="navigator.share ? navigator.share({title:document.title,url:location.href}) : navigator.clipboard.writeText(location.href)"
            style="padding:8px 16px;border-radius:999px;background:#f3f4f5;border:none;cursor:pointer;display:flex;align-items:center;gap:6px;font-size:12px;font-weight:600">
      <span class="material-symbols-outlined" style="font-size:16px">share</span>แชร์
    </button>
    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(current_url()); ?>" target="_blank"
       style="padding:8px 16px;border-radius:999px;background:#1877f2;color:#fff;text-decoration:none;display:flex;align-items:center;gap:6px;font-size:12px;font-weight:600">
      <svg width="14" height="14" fill="white" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
      Facebook
    </a>
    <a href="https://line.me/R/msg/text/?<?php echo urlencode($news->title . ' ' . current_url()); ?>" target="_blank"
       style="padding:8px 16px;border-radius:999px;background:#00b900;color:#fff;text-decoration:none;display:flex;align-items:center;gap:6px;font-size:12px;font-weight:600">
      <span class="material-symbols-outlined" style="font-size:16px">chat_bubble</span>Line
    </a>
  </div>

  <div class="news-detail-layout" style="align-items:start">

    <!-- Share bar desktop (sticky left) -->
    <div class="share-bar-desktop" style="position:sticky;top:96px;flex-direction:column;align-items:center;gap:12px">
      <span style="font-size:9px;font-weight:700;color:#b0b7c3;text-transform:uppercase;letter-spacing:.1em;writing-mode:vertical-rl;transform:rotate(180deg)">Share</span>
      <button onclick="navigator.share ? navigator.share({title:document.title,url:location.href}) : navigator.clipboard.writeText(location.href)"
              style="width:40px;height:40px;border-radius:50%;background:#f3f4f5;border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all .2s"
              onmouseover="this.style.background='#005e97';this.style.color='#fff'" onmouseout="this.style.background='#f3f4f5';this.style.color=''">
        <span class="material-symbols-outlined" style="font-size:18px">share</span>
      </button>
      <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(current_url()); ?>" target="_blank"
         style="width:40px;height:40px;border-radius:50%;background:#f3f4f5;display:flex;align-items:center;justify-content:center;text-decoration:none;transition:background .2s"
         onmouseover="this.style.background='#1877f2'" onmouseout="this.style.background='#f3f4f5'">
        <svg width="16" height="16" fill="#1877f2" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
      </a>
      <a href="https://line.me/R/msg/text/?<?php echo urlencode($news->title . ' ' . current_url()); ?>" target="_blank"
         style="width:40px;height:40px;border-radius:50%;background:#f3f4f5;display:flex;align-items:center;justify-content:center;text-decoration:none;transition:background .2s"
         onmouseover="this.style.background='#00b900'" onmouseout="this.style.background='#f3f4f5'">
        <span class="material-symbols-outlined" style="font-size:18px;color:#00b900">chat_bubble</span>
      </a>
    </div>

    <!-- Article body -->
    <div>
      <?php if (!empty($news->excerpt)): ?>
      <p class="font-thai" style="font-size:clamp(15px,2vw,18px);color:#707882;line-height:1.8;margin:0 0 28px 0;padding:0 0 28px 20px;border-left:4px solid #005e97;font-style:italic">
        <?php echo $news->excerpt; ?>
      </p>
      <?php endif; ?>

      <article class="font-thai news-body" style="font-size:clamp(15px,2vw,17px);color:#404751;font-family:'Sarabun',sans-serif">
        <?php echo $news->body; ?>
      </article>

      <!-- Tags -->
      <div style="display:flex;flex-wrap:wrap;gap:8px;margin-top:40px;padding-top:24px;border-top:1px solid #e5e7eb">
        <?php if (!empty($tags)): foreach ($tags as $t): ?>
        <a href="<?php echo base_url('news/tag/'.urlencode($t)); ?>"
           style="padding:5px 14px;background:#f3f4f5;border-radius:6px;font-size:12px;font-weight:600;color:#707882;text-decoration:none;transition:all .2s"
           onmouseover="this.style.background='#005e97';this.style.color='#fff'"
           onmouseout="this.style.background='#f3f4f5';this.style.color='#707882'">
          #<?php echo $t; ?>
        </a>
        <?php endforeach; else: ?>
        <span style="padding:5px 14px;background:#f3f4f5;border-radius:6px;font-size:12px;font-weight:600;color:#707882">#ระยอง</span>
        <?php endif; ?>
      </div>
    </div>

    <!-- Sidebar (desktop only) -->
    <div class="news-detail-sidebar" style="position:sticky;top:96px;flex-direction:column;gap:28px">
      <?php if (!empty($related)): ?>
      <div>
        <h3 class="font-thai" style="font-size:15px;font-weight:700;margin:0 0 16px 0;display:flex;align-items:center;gap:8px">
          <span style="width:20px;height:3px;background:#9b4500;border-radius:999px;display:inline-block"></span>
          ข่าวที่คุณอาจสนใจ
        </h3>
        <div style="display:flex;flex-direction:column;gap:16px">
          <?php foreach ($related as $r): ?>
          <a href="<?php echo base_url('news/'.$r->news_id); ?>"
             style="text-decoration:none"
             onmouseover="this.querySelector('h4').style.color='#005e97'"
             onmouseout="this.querySelector('h4').style.color='#191c1d'">
            <?php if (!empty($r->thumbnail)): ?>
            <div style="border-radius:10px;overflow:hidden;aspect-ratio:16/9;margin-bottom:8px">
              <img src="<?php echo base_url($r->thumbnail); ?>"
                   style="width:100%;height:100%;object-fit:cover;transition:transform .5s"
                   onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform=''"/>
            </div>
            <?php else: ?>
            <div style="border-radius:10px;background:#f0f1f2;aspect-ratio:16/9;margin-bottom:8px;display:flex;align-items:center;justify-content:center">
              <span class="material-symbols-outlined" style="color:#c0c7d2;font-size:24px">newspaper</span>
            </div>
            <?php endif; ?>
            <span style="font-size:9px;font-weight:700;color:#005e97;text-transform:uppercase;letter-spacing:.06em;margin-bottom:4px;display:block"><?php echo $r->category; ?></span>
            <h4 class="font-thai" style="font-size:13px;font-weight:700;color:#191c1d;margin:0;line-height:1.4;transition:color .2s;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden">
              <?php echo $r->title; ?>
            </h4>
          </a>
          <?php endforeach; ?>
        </div>
      </div>
      <?php endif; ?>

      <!-- Ads -->
      <div style="background:#f3f4f5;border-radius:12px;aspect-ratio:1/1;display:flex;flex-direction:column;align-items:center;justify-content:center;border:2px dashed #e5e7eb">
        <span style="font-size:9px;font-weight:700;color:#b0b7c3;text-transform:uppercase;letter-spacing:.1em;margin-bottom:8px">Advertisement</span>
        <span class="material-symbols-outlined" style="font-size:32px;color:#c0c7d2">ads_click</span>
      </div>
    </div>
  </div>

  <!-- Related (mobile) -->
  <?php if (!empty($related)): ?>
  <div style="margin-top:40px;padding-top:32px;border-top:1px solid #e5e7eb" class="lg:hidden">
    <h3 class="font-thai" style="font-size:15px;font-weight:700;margin:0 0 16px 0">ข่าวที่คุณอาจสนใจ</h3>
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(240px,1fr));gap:16px">
      <?php foreach ($related as $r): ?>
      <a href="<?php echo base_url('news/'.$r->news_id); ?>"
         style="text-decoration:none;background:#fff;border-radius:12px;overflow:hidden;border:1px solid #e5e7eb">
        <?php if (!empty($r->thumbnail)): ?>
        <img src="<?php echo base_url($r->thumbnail); ?>" style="width:100%;aspect-ratio:16/9;object-fit:cover"/>
        <?php endif; ?>
        <div style="padding:12px">
          <span style="font-size:9px;font-weight:700;color:#005e97;text-transform:uppercase;display:block;margin-bottom:4px"><?php echo $r->category; ?></span>
          <h4 class="font-thai" style="font-size:13px;font-weight:700;color:#191c1d;margin:0;line-height:1.4"><?php echo $r->title; ?></h4>
        </div>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
  <?php endif; ?>

</div>

<!-- Bottom ads -->
<div style="max-width:1280px;margin:0 auto 48px;padding:0 24px">
  <div style="background:#f3f4f5;border-radius:16px;height:80px;display:flex;flex-direction:column;align-items:center;justify-content:center;border:1px solid #e5e7eb">
    <span style="font-size:9px;font-weight:700;color:#b0b7c3;text-transform:uppercase;letter-spacing:.1em;margin-bottom:4px">Google Ads Sponsor</span>
    <span class="font-thai" style="font-size:12px;color:#b0b7c3">แบนเนอร์โฆษณา 728 x 90</span>
  </div>
</div>
