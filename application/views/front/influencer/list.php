<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<section class="py-10 px-6 md:px-8">
  <div class="max-w-[1280px] mx-auto">
    <div style="margin-bottom:28px">
      <span style="font-size:11px;font-weight:700;color:#9b4500;text-transform:uppercase;letter-spacing:.1em;display:block;margin-bottom:4px">Curators</span>
      <h1 class="font-thai" style="font-size:clamp(24px,4vw,36px);font-weight:900;margin:0 0 6px 0">นักชิมระยองที่น่าเชื่อถือ</h1>
      <p style="font-size:14px;color:#707882;margin:0">คัดสรรโดย ททท. ระยอง</p>
    </div>

    <?php if (!empty($influencers)): ?>
    <style>@media(min-width:640px){.inf-list-grid{grid-template-columns:repeat(2,1fr) !important}}@media(min-width:1024px){.inf-list-grid{grid-template-columns:repeat(3,1fr) !important}}@media(min-width:1280px){.inf-list-grid{grid-template-columns:repeat(4,1fr) !important}}</style>
    <div class="inf-list-grid" style="display:grid;grid-template-columns:1fr;gap:20px">
      <?php foreach ($influencers as $inf):
        $name = !empty($inf->display_name) ? $inf->display_name : $inf->user_display_name;
      ?>
      <a href="<?php echo base_url('curator/'.$inf->influencer_id); ?>"
         style="text-decoration:none;background:#fff;border-radius:20px;overflow:hidden;box-shadow:0 4px 12px rgba(25,28,29,.07);border:1px solid #e5e7eb;transition:transform .2s,box-shadow .2s;display:flex;flex-direction:column"
         onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 12px 28px rgba(25,28,29,.12)'"
         onmouseout="this.style.transform='';this.style.boxShadow='0 4px 12px rgba(25,28,29,.07)'">
        <div style="height:90px;background:linear-gradient(135deg,#005e97,#003d66);overflow:hidden">
          <?php if (!empty($inf->cover_image)): ?>
          <img src="<?php echo base_url($inf->cover_image); ?>" style="width:100%;height:100%;object-fit:cover;opacity:.5"/>
          <?php endif; ?>
        </div>
        <div style="padding:0 20px 20px;flex:1">
          <div style="margin-top:-28px;margin-bottom:12px;position:relative;width:fit-content">
            <?php if (!empty($inf->avatar)): ?>
            <img src="<?php echo base_url($inf->avatar); ?>"
                 style="width:56px;height:56px;border-radius:12px;object-fit:cover;border:3px solid #fff;box-shadow:0 4px 8px rgba(25,28,29,.1)"/>
            <?php else: ?>
            <div style="width:56px;height:56px;border-radius:12px;background:#005e97;border:3px solid #fff;display:flex;align-items:center;justify-content:center;font-size:20px;font-weight:900;color:#fff">
              <?php echo mb_substr($name,0,1); ?>
            </div>
            <?php endif; ?>
            <?php if ($inf->is_tat_verified): ?>
            <div style="position:absolute;bottom:-4px;right:-4px;background:#005e97;border-radius:50%;width:18px;height:18px;display:flex;align-items:center;justify-content:center;border:2px solid #fff">
              <span class="material-symbols-outlined" style="font-size:10px;color:#fff;font-variation-settings:'FILL' 1">verified</span>
            </div>
            <?php endif; ?>
          </div>
          <h3 style="font-size:16px;font-weight:700;color:#191c1d;margin:0 0 4px 0"><?php echo $name; ?></h3>
          <?php if (!empty($inf->bio)): ?>
          <p style="font-size:12px;color:#707882;margin:0 0 14px 0;line-height:1.5;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden"><?php echo $inf->bio; ?></p>
          <?php endif; ?>
          <div style="display:flex;gap:16px;border-top:1px solid #f0f1f2;padding-top:12px">
            <div><div style="font-size:18px;font-weight:900;color:#005e97"><?php echo $inf->trusted_review_count; ?></div><div style="font-size:9px;font-weight:700;color:#b0b7c3;text-transform:uppercase;letter-spacing:.06em">รีวิว</div></div>
            <div><div style="font-size:18px;font-weight:900;color:#9b4500"><?php echo $inf->district_explored; ?></div><div style="font-size:9px;font-weight:700;color:#b0b7c3;text-transform:uppercase;letter-spacing:.06em">อำเภอ</div></div>
            <div><div style="font-size:18px;font-weight:900;color:#00665a"><?php echo number_format((float)$inf->avg_score,1); ?></div><div style="font-size:9px;font-weight:700;color:#b0b7c3;text-transform:uppercase;letter-spacing:.06em">คะแนน</div></div>
          </div>
        </div>
      </a>
      <?php endforeach; ?>
    </div>
    <?php else: ?>
    <div style="text-align:center;padding:80px 0;color:#b0b7c3">
      <span class="material-symbols-outlined" style="font-size:56px;display:block;margin-bottom:12px">person_search</span>
      <p style="font-size:15px;font-weight:600">ยังไม่มี Curator</p>
    </div>
    <?php endif; ?>
  </div>
</section>
