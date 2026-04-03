<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<style>
.review-body img,
.review-body img.fr-fic,
.review-body img.fr-dib { display:block !important; max-width:100% !important; width:100% !important; height:auto !important; border-radius:12px; margin:24px auto !important; }
.review-body p   { margin:0 0 16px 0; line-height:1.9; }
.review-body h2  { font-size:clamp(18px,3vw,22px); font-weight:700; color:#005e97; margin:32px 0 14px 0; }
.review-body blockquote { border-left:4px solid #005e97; margin:24px 0; padding:14px 20px; background:#f3f4f5; border-radius:0 12px 12px 0; color:#9b4500; font-weight:600; }
.review-body ul, .review-body ol { padding-left:20px; margin:0 0 16px 0; }
.review-body li { margin-bottom:8px; line-height:1.7; }
</style>

<!-- HERO -->
<section style="position:relative;width:100%;height:clamp(240px,40vw,420px);overflow:hidden">
  <?php
    // ใช้ cover_image จาก review แรก ถ้าไม่มีค่อยใช้ shop_image
    $heroImg = '';
    if (!empty($reviews) && !empty($reviews[0]->cover_image)) {
        $heroImg = base_url($reviews[0]->cover_image);
    } elseif (!empty($place->shop_image)) {
        $heroImg = base_url($place->shop_image);
    }
  ?>
  <?php if ($heroImg): ?>
  <img src="<?php echo $heroImg; ?>" style="width:100%;height:100%;object-fit:cover"/>
  <?php else: ?>
  <div style="width:100%;height:100%;background:linear-gradient(135deg,#005e97,#003d66)"></div>
  <?php endif; ?>
  <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(25,28,29,.85) 0%,rgba(25,28,29,.2) 50%,transparent 100%)"></div>
  <div style="position:absolute;bottom:0;left:0;right:0;padding:clamp(16px,4vw,48px)">
    <span style="background:rgba(155,69,0,.9);color:#fff;font-size:10px;font-weight:700;padding:3px 12px;border-radius:999px;text-transform:uppercase;letter-spacing:.06em;display:inline-block;margin-bottom:10px">
      <?php echo $place->category_name; ?>
    </span>
    <h1 class="font-thai" style="font-size:clamp(24px,4vw,48px);font-weight:900;color:#fff;margin:0 0 8px 0;line-height:1.2">
      <?php echo $place->name; ?>
    </h1>
    <p style="font-size:14px;color:rgba(255,255,255,.8);display:flex;align-items:center;gap:6px">
      <span class="material-symbols-outlined" style="font-size:16px">location_on</span>
      <?php echo $place->district_name; ?>
    </p>
  </div>
</section>

<!-- MAIN -->
<div class="max-w-[1280px] mx-auto px-6 md:px-8 py-10">
  <div style="display:grid;grid-template-columns:1fr;gap:32px">
    <style>@media(min-width:1024px){.place-layout{grid-template-columns:1fr 320px !important}}</style>
    <div class="place-layout" style="display:grid;grid-template-columns:1fr;gap:32px">

      <!-- LEFT: Reviews -->
      <div>
        <?php if (!empty($reviews)): ?>
        <h2 class="font-thai" style="font-size:22px;font-weight:800;margin:0 0 20px 0">รีวิวจาก Curator</h2>
        <div style="display:flex;flex-direction:column;gap:24px">
          <?php foreach ($reviews as $r):
            $rname = !empty($r->influencer_display) ? $r->influencer_display : $r->reviewer_name;
          ?>
          <div style="background:#fff;border-radius:20px;overflow:hidden;box-shadow:0 4px 16px rgba(25,28,29,.07);border:1px solid #e5e7eb">
            <?php if (!empty($r->cover_image)): ?>
            <img src="<?php echo base_url($r->cover_image); ?>"
                 style="width:100%;aspect-ratio:16/9;object-fit:cover"/>
            <?php endif; ?>
            <div style="padding:20px">
              <!-- Reviewer -->
              <a href="<?php echo $r->influencer_id ? base_url('curator/'.$r->influencer_id) : '#'; ?>"
                 style="display:flex;align-items:center;gap:10px;margin-bottom:14px;text-decoration:none"
                 <?php echo $r->influencer_id ? '' : 'onclick="return false"'; ?>>
                <?php if (!empty($r->influencer_avatar)): ?>
                <img src="<?php echo base_url($r->influencer_avatar); ?>"
                     style="width:36px;height:36px;border-radius:50%;object-fit:cover;flex-shrink:0"/>
                <?php else: ?>
                <div style="width:36px;height:36px;border-radius:50%;background:#005e97;display:flex;align-items:center;justify-content:center;flex-shrink:0">
                  <span style="font-size:14px;color:#fff;font-weight:700"><?php echo mb_substr($rname,0,1); ?></span>
                </div>
                <?php endif; ?>
                <div>
                  <div style="font-size:13px;font-weight:700;color:#191c1d;display:flex;align-items:center;gap:5px;transition:color .2s"
                       onmouseover="this.style.color='#005e97'" onmouseout="this.style.color='#191c1d'">
                    <?php echo $rname; ?>
                    <?php if ($r->is_tat_verified): ?>
                    <span class="material-symbols-outlined" style="font-size:14px;color:#005e97;font-variation-settings:'FILL' 1">verified</span>
                    <?php endif; ?>
                  </div>
                  <div style="font-size:11px;color:#b0b7c3">Rayong Curator</div>
                </div>
              </a>
              <!-- Title -->
              <?php if (!empty($r->title)): ?>
              <h3 class="font-thai" style="font-size:18px;font-weight:800;color:#191c1d;margin:0 0 12px 0;line-height:1.35"><?php echo $r->title; ?></h3>
              <?php endif; ?>
              <!-- Signature dish -->
              <?php if (!empty($r->signature_dish_name)): ?>
              <div style="display:flex;align-items:center;gap:8px;background:#005e97;border-radius:12px;padding:10px 14px;margin-bottom:14px">
                <span class="material-symbols-outlined" style="font-size:16px;color:#fff;font-variation-settings:'FILL' 1;flex-shrink:0">stars</span>
                <p style="font-size:14px;color:#fff;font-weight:700;margin:0"><?php echo $r->signature_dish_name; ?></p>
              </div>
              <?php endif; ?>
              <!-- Body -->
              <?php if (!empty($r->body)): ?>
              <div class="font-thai review-body" style="font-size:16px;color:#404751;line-height:1.9;font-family:'Sarabun',sans-serif"><?php echo $r->body; ?></div>
              <?php endif; ?>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
        <?php else: ?>
        <div style="text-align:center;padding:60px 0;color:#b0b7c3">
          <span class="material-symbols-outlined" style="font-size:48px;display:block;margin-bottom:12px">rate_review</span>
          <p class="font-thai" style="font-size:15px;font-weight:600">ยังไม่มีรีวิว</p>
        </div>
        <?php endif; ?>
      </div>

      <!-- RIGHT: Sidebar ข้อมูลร้าน -->
      <div style="display:flex;flex-direction:column;gap:16px;align-self:start;position:sticky;top:96px">

        <!-- ข้อมูลร้าน -->
        <div style="background:#fff;border-radius:16px;padding:20px;box-shadow:0 4px 12px rgba(25,28,29,.07);border:1px solid #e5e7eb">
          <h3 class="font-thai" style="font-size:15px;font-weight:700;margin:0 0 14px 0">ข้อมูลร้าน</h3>

          <!-- สถานที่ตั้ง -->
          <?php if (!empty($place->address) || !empty($place->district_name)): ?>
          <div style="display:flex;gap:10px;margin-bottom:12px;align-items:flex-start">
            <span class="material-symbols-outlined" style="font-size:18px;color:#005e97;flex-shrink:0;font-variation-settings:'FILL' 1">location_on</span>
            <div>
              <div style="font-size:11px;font-weight:700;color:#b0b7c3;text-transform:uppercase;letter-spacing:.06em;margin-bottom:2px">สถานที่ตั้ง</div>
              <div style="font-size:13px;color:#191c1d"><?php echo !empty($place->address) ? $place->address : $place->district_name . ' ระยอง'; ?></div>
            </div>
          </div>
          <?php endif; ?>

          <!-- เวลาเปิด -->
          <?php if (!empty($place->open_hours)): ?>
          <div style="display:flex;gap:10px;margin-bottom:12px;align-items:flex-start">
            <span class="material-symbols-outlined" style="font-size:18px;color:#005e97;flex-shrink:0;font-variation-settings:'FILL' 1">schedule</span>
            <div>
              <div style="font-size:11px;font-weight:700;color:#b0b7c3;text-transform:uppercase;letter-spacing:.06em;margin-bottom:2px">เวลาทำการ</div>
              <div style="font-size:13px;color:#191c1d"><?php echo $place->open_hours; ?></div>
            </div>
          </div>
          <?php endif; ?>

          <!-- รูปหน้าร้าน -->
          <?php if (!empty($place->shop_image)): ?>
          <div style="border-radius:12px;overflow:hidden;margin:14px 0">
            <img src="<?php echo base_url($place->shop_image); ?>"
                 style="width:100%;aspect-ratio:4/3;object-fit:cover"/>
          </div>
          <?php endif; ?>

          <!-- ปุ่มนำทาง -->
          <?php if ($place->lat && $place->lng): ?>
          <a href="https://www.google.com/maps?q=<?php echo $place->lat; ?>,<?php echo $place->lng; ?>"
             target="_blank" rel="noopener"
             style="display:flex;align-items:center;justify-content:space-between;padding:14px 16px;background:#f3f4f5;border-radius:12px;text-decoration:none;margin-bottom:8px;transition:background .2s"
             onmouseover="this.style.background='#e5e7eb'" onmouseout="this.style.background='#f3f4f5'">
            <div style="display:flex;align-items:center;gap:12px">
              <div style="width:36px;height:36px;border-radius:50%;background:#005e97;display:flex;align-items:center;justify-content:center;flex-shrink:0">
                <span class="material-symbols-outlined" style="font-size:18px;color:#fff;font-variation-settings:'FILL' 1">near_me</span>
              </div>
              <span style="font-size:14px;font-weight:700;color:#191c1d">นำทางไปร้าน</span>
            </div>
            <span class="material-symbols-outlined" style="font-size:18px;color:#b0b7c3">open_in_new</span>
          </a>
          <?php endif; ?>

          <!-- Social links -->
          <?php if (!empty($place->fb_url)): ?>
          <a href="<?php echo $place->fb_url; ?>" target="_blank" rel="noopener"
             style="display:flex;align-items:center;justify-content:space-between;padding:14px 16px;background:#f3f4f5;border-radius:12px;text-decoration:none;margin-bottom:8px;transition:background .2s"
             onmouseover="this.style.background='#e5e7eb'" onmouseout="this.style.background='#f3f4f5'">
            <div style="display:flex;align-items:center;gap:12px">
              <div style="width:36px;height:36px;border-radius:50%;background:#1877f2;display:flex;align-items:center;justify-content:center;flex-shrink:0">
                <svg width="16" height="16" fill="white" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
              </div>
              <span style="font-size:14px;font-weight:700;color:#191c1d">Facebook</span>
            </div>
            <span class="material-symbols-outlined" style="font-size:18px;color:#b0b7c3">chevron_right</span>
          </a>
          <?php endif; ?>

          <?php if (!empty($place->ig_url)): ?>
          <a href="<?php echo $place->ig_url; ?>" target="_blank" rel="noopener"
             style="display:flex;align-items:center;justify-content:space-between;padding:14px 16px;background:#f3f4f5;border-radius:12px;text-decoration:none;margin-bottom:8px;transition:background .2s"
             onmouseover="this.style.background='#e5e7eb'" onmouseout="this.style.background='#f3f4f5'">
            <div style="display:flex;align-items:center;gap:12px">
              <div style="width:36px;height:36px;border-radius:50%;background:linear-gradient(135deg,#f09433,#dc2743,#bc1888);display:flex;align-items:center;justify-content:center;flex-shrink:0">
                <span class="material-symbols-outlined" style="font-size:18px;color:#fff">photo_camera</span>
              </div>
              <span style="font-size:14px;font-weight:700;color:#191c1d">Instagram</span>
            </div>
            <span class="material-symbols-outlined" style="font-size:18px;color:#b0b7c3">chevron_right</span>
          </a>
          <?php endif; ?>

          <?php if (!empty($place->tiktok_url)): ?>
          <a href="<?php echo $place->tiktok_url; ?>" target="_blank" rel="noopener"
             style="display:flex;align-items:center;justify-content:space-between;padding:14px 16px;background:#f3f4f5;border-radius:12px;text-decoration:none;transition:background .2s"
             onmouseover="this.style.background='#e5e7eb'" onmouseout="this.style.background='#f3f4f5'">
            <div style="display:flex;align-items:center;gap:12px">
              <div style="width:36px;height:36px;border-radius:50%;background:#111;display:flex;align-items:center;justify-content:center;flex-shrink:0">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="white"><path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-2.88 2.5 2.89 2.89 0 01-2.89-2.89 2.89 2.89 0 012.89-2.89c.28 0 .54.04.79.1V9.01a6.33 6.33 0 00-.79-.05 6.34 6.34 0 00-6.34 6.34 6.34 6.34 0 006.34 6.34 6.34 6.34 0 006.33-6.34V8.69a8.27 8.27 0 004.84 1.56V6.8a4.85 4.85 0 01-1.07-.11z"/></svg>
              </div>
              <span style="font-size:14px;font-weight:700;color:#191c1d">TikTok</span>
            </div>
            <span class="material-symbols-outlined" style="font-size:18px;color:#b0b7c3">chevron_right</span>
          </a>
          <?php endif; ?>
        </div>

        <!-- ร้านใกล้เคียง -->
        <?php if (!empty($nearby)): ?>
        <div style="background:#fff;border-radius:16px;padding:20px;box-shadow:0 4px 12px rgba(25,28,29,.07);border:1px solid #e5e7eb">
          <h3 class="font-thai" style="font-size:15px;font-weight:700;margin:0 0 14px 0">ร้านใกล้เคียง</h3>
          <div style="display:flex;flex-direction:column;gap:10px">
            <?php foreach ($nearby as $n): ?>
            <a href="<?php echo base_url('place/'.$n->place_id); ?>"
               style="display:flex;gap:10px;align-items:center;text-decoration:none"
               onmouseover="this.querySelector('.nb-name').style.color='#005e97'"
               onmouseout="this.querySelector('.nb-name').style.color='#191c1d'">
              <?php if (!empty($n->shop_image)): ?>
              <img src="<?php echo strpos($n->shop_image,'http')===0 ? $n->shop_image : base_url($n->shop_image); ?>"
                   style="width:48px;height:48px;border-radius:10px;object-fit:cover;flex-shrink:0"/>
              <?php else: ?>
              <div style="width:48px;height:48px;border-radius:10px;background:#f0f1f2;display:flex;align-items:center;justify-content:center;flex-shrink:0;font-size:20px">🍽️</div>
              <?php endif; ?>
              <div style="min-width:0">
                <span class="nb-name font-thai" style="font-size:13px;font-weight:600;color:#191c1d;display:block;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;transition:color .2s">
                  <?php echo $n->place_name; ?>
                </span>
                <span style="font-size:11px;color:#b0b7c3"><?php echo $n->category_name; ?></span>
              </div>
            </a>
            <?php endforeach; ?>
          </div>
        </div>
        <?php endif; ?>

      </div>
    </div>
  </div>
</div>
