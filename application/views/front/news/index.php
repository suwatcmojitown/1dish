<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- HEADER -->
<section class="py-10 px-6 md:px-8" style="background:#fff;border-bottom:1px solid #e5e7eb">
  <div class="max-w-[1280px] mx-auto">
    <span style="font-size:11px;font-weight:700;color:#9b4500;text-transform:uppercase;letter-spacing:.1em;display:block;margin-bottom:4px">TAT Rayong</span>
    <h1 class="font-thai" style="font-size:clamp(24px,5vw,36px);font-weight:900;margin:0 0 20px 0">ข่าวประชาสัมพันธ์</h1>
    <div style="display:flex;gap:8px;flex-wrap:wrap">
      <a href="<?php echo base_url('news'); ?>"
         style="padding:7px 18px;border-radius:999px;font-size:13px;font-weight:700;text-decoration:none;border:2px solid <?php echo $cat=='' ? '#005e97' : '#e5e7eb'; ?>;background:<?php echo $cat=='' ? '#005e97' : '#fff'; ?>;color:<?php echo $cat=='' ? '#fff' : '#707882'; ?>">
        ทั้งหมด
      </a>
      <?php foreach (array('ท่องเที่ยว','อาหาร','กิจกรรม','ประชาสัมพันธ์','ข่าวสาร') as $c): ?>
      <a href="<?php echo base_url('news?cat='.urlencode($c)); ?>"
         style="padding:7px 18px;border-radius:999px;font-size:13px;font-weight:600;text-decoration:none;border:2px solid <?php echo $cat==$c ? '#005e97' : '#e5e7eb'; ?>;background:<?php echo $cat==$c ? '#005e97' : '#fff'; ?>;color:<?php echo $cat==$c ? '#fff' : '#707882'; ?>">
        <?php echo $c; ?>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- CONTENT -->
<div class="max-w-[1280px] mx-auto px-6 md:px-8 py-10">
  <?php if (!empty($newsList)): ?>

  <!-- Card ใหญ่อันแรก -->
  <?php $first = $newsList[0]; ?>
  <a href="<?php echo base_url('news/'.$first->news_id); ?>"
     style="text-decoration:none;display:block;background:#fff;border-radius:20px;overflow:hidden;box-shadow:0 4px 16px rgba(25,28,29,.07);border:1px solid #e5e7eb;margin-bottom:28px;transition:transform .2s,box-shadow .2s"
     onmouseover="this.style.transform='translateY(-3px)';this.style.boxShadow='0 12px 28px rgba(25,28,29,.12)'"
     onmouseout="this.style.transform='';this.style.boxShadow='0 4px 16px rgba(25,28,29,.07)'">
    <div style="display:grid;grid-template-columns:1fr">
      <style>@media(min-width:768px){.news-first-grid{grid-template-columns:1fr 1fr !important}}</style>
      <div class="news-first-grid" style="display:grid;grid-template-columns:1fr">
        <div style="overflow:hidden;aspect-ratio:16/9">
          <?php if (!empty($first->thumbnail)): ?>
          <img src="<?php echo base_url($first->thumbnail); ?>" style="width:100%;height:100%;object-fit:cover"/>
          <?php else: ?>
          <div style="width:100%;height:100%;background:#f0f1f2;display:flex;align-items:center;justify-content:center;min-height:200px">
            <span class="material-symbols-outlined" style="font-size:40px;color:#c0c7d2">newspaper</span>
          </div>
          <?php endif; ?>
        </div>
        <div style="padding:24px;display:flex;flex-direction:column;justify-content:center">
          <span style="display:inline-block;font-size:10px;font-weight:700;color:#fff;background:#005e97;padding:2px 10px;border-radius:999px;margin-bottom:10px;text-transform:uppercase;letter-spacing:.06em;width:fit-content">
            <?php echo $first->category; ?>
          </span>
          <h2 class="font-thai" style="font-size:clamp(16px,2.5vw,22px);font-weight:800;color:#191c1d;margin:0 0 10px 0;line-height:1.35">
            <?php echo $first->title; ?>
          </h2>
          <?php if (!empty($first->excerpt)): ?>
          <p style="font-size:14px;color:#707882;margin:0 0 16px 0;line-height:1.7;display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden">
            <?php echo $first->excerpt; ?>
          </p>
          <?php endif; ?>
          <div style="display:flex;align-items:center;gap:8px;font-size:12px;color:#b0b7c3">
            <span><?php echo $first->author_name; ?></span>
            <span>·</span>
            <span><?php echo date('d M Y', strtotime($first->published_at ?: $first->created_at)); ?></span>
          </div>
        </div>
      </div>
    </div>
  </a>

  <!-- Grid ข่าวอื่น -->
  <?php if (count($newsList) > 1): ?>
  <style>@media(min-width:640px){.news-grid{grid-template-columns:repeat(2,1fr) !important}}@media(min-width:1024px){.news-grid{grid-template-columns:repeat(3,1fr) !important}}</style>
  <div class="news-grid" style="display:grid;grid-template-columns:1fr;gap:20px;margin-bottom:40px">
    <?php foreach (array_slice($newsList, 1) as $n): ?>
    <a href="<?php echo base_url('news/'.$n->news_id); ?>"
       style="text-decoration:none;display:flex;flex-direction:column;background:#fff;border-radius:16px;overflow:hidden;box-shadow:0 4px 12px rgba(25,28,29,.07);border:1px solid #e5e7eb;transition:transform .2s,box-shadow .2s"
       onmouseover="this.style.transform='translateY(-3px)';this.style.boxShadow='0 10px 24px rgba(25,28,29,.1)'"
       onmouseout="this.style.transform='';this.style.boxShadow='0 4px 12px rgba(25,28,29,.07)'">
      <div style="overflow:hidden;aspect-ratio:16/9">
        <?php if (!empty($n->thumbnail)): ?>
        <img src="<?php echo base_url($n->thumbnail); ?>" style="width:100%;height:100%;object-fit:cover;transition:transform .5s"
             onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform=''"/>
        <?php else: ?>
        <div style="background:#f0f1f2;width:100%;height:100%;display:flex;align-items:center;justify-content:center;min-height:160px">
          <span class="material-symbols-outlined" style="font-size:32px;color:#c0c7d2">newspaper</span>
        </div>
        <?php endif; ?>
      </div>
      <div style="padding:16px;flex:1;display:flex;flex-direction:column">
        <span style="font-size:9px;font-weight:700;color:#005e97;text-transform:uppercase;letter-spacing:.06em;margin-bottom:6px;display:block"><?php echo $n->category; ?></span>
        <h3 class="font-thai" style="font-size:15px;font-weight:700;color:#191c1d;margin:0 0 8px 0;line-height:1.4;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden">
          <?php echo $n->title; ?>
        </h3>
        <?php if (!empty($n->excerpt)): ?>
        <p style="font-size:12px;color:#707882;line-height:1.6;margin:0 0 12px 0;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden">
          <?php echo $n->excerpt; ?>
        </p>
        <?php endif; ?>
        <div style="margin-top:auto;display:flex;align-items:center;gap:6px;font-size:11px;color:#b0b7c3;padding-top:10px;border-top:1px solid #f0f1f2">
          <span><?php echo $n->author_name; ?></span><span>·</span>
          <span><?php echo date('d M Y', strtotime($n->published_at ?: $n->created_at)); ?></span>
        </div>
      </div>
    </a>
    <?php endforeach; ?>
  </div>
  <?php endif; ?>

  <!-- Pagination -->
  <?php $totalPage = ceil($total / $limit); if ($totalPage > 1): ?>
  <div style="display:flex;justify-content:center;align-items:center;gap:6px">
    <?php if ($page > 1): ?>
    <a href="<?php echo base_url('news?page='.($page-1).($cat?'&cat='.urlencode($cat):'')); ?>"
       style="width:36px;height:36px;border-radius:8px;border:1px solid #e5e7eb;background:#fff;display:flex;align-items:center;justify-content:center;color:#005e97;text-decoration:none">
      <span class="material-symbols-outlined" style="font-size:18px">chevron_left</span>
    </a>
    <?php endif; ?>
    <?php for ($i=1; $i<=$totalPage; $i++):
      if ($i===1 || $i===$totalPage || ($i>=$page-1 && $i<=$page+1)): ?>
    <a href="<?php echo base_url('news?page='.$i.($cat?'&cat='.urlencode($cat):'')); ?>"
       style="width:36px;height:36px;border-radius:8px;border:1px solid <?php echo $i==$page?'#005e97':'#e5e7eb'; ?>;background:<?php echo $i==$page?'#005e97':'#fff'; ?>;color:<?php echo $i==$page?'#fff':'#191c1d'; ?>;font-weight:<?php echo $i==$page?'700':'500'; ?>;display:flex;align-items:center;justify-content:center;font-size:13px;text-decoration:none">
      <?php echo $i; ?>
    </a>
    <?php elseif ($i===$page-2 || $i===$page+2): ?>
    <span style="color:#b0b7c3">···</span>
    <?php endif; endfor; ?>
    <?php if ($page < $totalPage): ?>
    <a href="<?php echo base_url('news?page='.($page+1).($cat?'&cat='.urlencode($cat):'')); ?>"
       style="width:36px;height:36px;border-radius:8px;border:1px solid #e5e7eb;background:#fff;display:flex;align-items:center;justify-content:center;color:#005e97;text-decoration:none">
      <span class="material-symbols-outlined" style="font-size:18px">chevron_right</span>
    </a>
    <?php endif; ?>
  </div>
  <?php endif; ?>

  <?php else: ?>
  <div style="text-align:center;padding:80px 0;color:#b0b7c3">
    <span class="material-symbols-outlined" style="font-size:56px;display:block;margin-bottom:12px">newspaper</span>
    <p class="font-thai" style="font-size:16px;font-weight:600">ยังไม่มีข่าวประชาสัมพันธ์</p>
  </div>
  <?php endif; ?>
</div>
