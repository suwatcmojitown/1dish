<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- SECTION HEADER -->
<div class="w-full max-w-[1280px] mx-auto px-8 pt-12 pb-8">
  <a href="<?php echo base_url('news'); ?>"
     class="inline-flex items-center gap-1 text-xs text-outline hover:text-primary transition-colors mb-4">
    <span class="material-symbols-outlined" style="font-size:15px">arrow_back</span>
    กลับหน้าข่าวทั้งหมด
  </a>
  <div class="border-l-8 border-secondary pl-5">
    <p class="text-xs font-bold text-secondary uppercase tracking-widest mb-1">Tag Archive</p>
    <h1 class="font-thai text-5xl font-black text-on-surface">
      หัวข้อ: <span class="text-primary">#<?php echo htmlspecialchars($tag); ?></span>
    </h1>
  </div>
</div>

<!-- MAIN LAYOUT -->
<div class="w-full max-w-[1280px] mx-auto px-8 pb-20">
  <div class="grid grid-cols-12 gap-12">

    <!-- LEFT: News Grid -->
    <div class="col-span-12 lg:col-span-8">

      <?php if (!empty($newsList)): ?>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
        <?php foreach ($newsList as $n): ?>
        <a href="<?php echo base_url('news/'.$n->news_id); ?>"
           class="group bg-surface-container-lowest rounded-xl overflow-hidden border border-outline-variant/20 hover:shadow-xl hover:shadow-primary/5 transition-all"
           style="text-decoration:none">
          <div class="aspect-[16/9] overflow-hidden">
            <?php if (!empty($n->thumbnail)): ?>
            <img src="<?php echo base_url($n->thumbnail); ?>"
                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"/>
            <?php else: ?>
            <div class="w-full h-full bg-surface-container flex items-center justify-center">
              <span class="material-symbols-outlined text-outline-variant" style="font-size:32px">newspaper</span>
            </div>
            <?php endif; ?>
          </div>
          <div class="p-6">
            <span class="inline-block px-3 py-1 bg-secondary-container text-on-secondary-container rounded-md text-xs font-bold mb-3 uppercase">
              <?php echo $n->category; ?>
            </span>
            <h2 class="font-thai text-lg font-bold text-on-surface mb-3 leading-snug group-hover:text-primary transition-colors"
                style="display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden">
              <?php echo $n->title; ?>
            </h2>
            <?php if (!empty($n->excerpt)): ?>
            <p class="text-on-surface-variant text-sm leading-relaxed mb-4"
               style="display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden">
              <?php echo $n->excerpt; ?>
            </p>
            <?php endif; ?>
            <div class="flex items-center justify-between pt-4 border-t border-outline-variant/10">
              <span class="text-xs text-outline">
                <?php echo date('d M Y', strtotime($n->published_at ?: $n->created_at)); ?>
              </span>
              <span class="text-primary font-bold text-xs flex items-center gap-0.5 group-hover:gap-1.5 transition-all">
                Read More <span class="material-symbols-outlined" style="font-size:14px">arrow_forward</span>
              </span>
            </div>
          </div>
        </a>
        <?php endforeach; ?>
      </div>

      <!-- Pagination -->
      <?php $totalPage = ceil($total / $limit); if ($totalPage > 1): ?>
      <div class="flex justify-center items-center gap-2">
        <?php if ($page > 1): ?>
        <a href="<?php echo base_url('news/tag/'.urlencode($tag).'?page='.($page-1)); ?>"
           class="w-10 h-10 rounded-full border border-outline-variant flex items-center justify-center text-primary hover:bg-primary hover:text-white transition-all"
           style="text-decoration:none">
          <span class="material-symbols-outlined" style="font-size:18px">chevron_left</span>
        </a>
        <?php endif; ?>
        <?php for ($i=1; $i<=$totalPage; $i++):
          if ($i===1 || $i===$totalPage || ($i>=$page-1 && $i<=$page+1)): ?>
        <a href="<?php echo base_url('news/tag/'.urlencode($tag).'?page='.$i); ?>"
           class="w-10 h-10 rounded-full flex items-center justify-center text-sm font-bold transition-all"
           style="text-decoration:none;background:<?php echo $i==$page?'#005e97':'transparent'; ?>;color:<?php echo $i==$page?'#fff':'#191c1d'; ?>;border:1px solid <?php echo $i==$page?'#005e97':'#c0c7d2'; ?>">
          <?php echo $i; ?>
        </a>
        <?php elseif ($i===$page-2 || $i===$page+2): ?>
        <span class="text-outline">···</span>
        <?php endif; endfor; ?>
        <?php if ($page < $totalPage): ?>
        <a href="<?php echo base_url('news/tag/'.urlencode($tag).'?page='.($page+1)); ?>"
           class="w-10 h-10 rounded-full border border-outline-variant flex items-center justify-center text-primary hover:bg-primary hover:text-white transition-all"
           style="text-decoration:none">
          <span class="material-symbols-outlined" style="font-size:18px">chevron_right</span>
        </a>
        <?php endif; ?>
      </div>
      <?php endif; ?>

      <?php else: ?>
      <div class="text-center py-20 text-outline">
        <span class="material-symbols-outlined block mb-3" style="font-size:56px">label_off</span>
        <p class="font-thai text-base font-semibold">ไม่พบข่าวที่มีแท็ก #<?php echo htmlspecialchars($tag); ?></p>
        <a href="<?php echo base_url('news'); ?>"
           class="inline-flex items-center gap-2 mt-4 px-6 py-2.5 bg-primary text-white rounded-full text-sm font-bold hover:opacity-90 transition-opacity"
           style="text-decoration:none">
          ดูข่าวทั้งหมด
        </a>
      </div>
      <?php endif; ?>

    </div>

    <!-- RIGHT: Sidebar -->
    <aside class="col-span-12 lg:col-span-4 space-y-8" style="position:sticky;top:96px;align-self:start">

      <!-- Trending Tags -->
      <div class="bg-surface-container-low rounded-2xl p-6">
        <h3 class="font-thai text-base font-bold mb-5 flex items-center gap-2">
          <span class="material-symbols-outlined text-secondary" style="font-size:20px">trending_up</span>
          Trending Topics
        </h3>
        <div class="flex flex-wrap gap-2">
          <?php
          $CI =& get_instance();
          $CI->db->select('tag, COUNT(*) as cnt');
          $CI->db->from('news_tag');
          $CI->db->join('news', 'news_tag.news_id = news.news_id');
          $CI->db->where('news.status', 'published');
          $CI->db->group_by('tag');
          $CI->db->order_by('cnt', 'DESC');
          $CI->db->limit(10);
          $trending = $CI->db->get()->result();
          foreach ($trending as $t):
            $isActive = mb_strtolower($t->tag) === mb_strtolower($tag);
          ?>
          <a href="<?php echo base_url('news/tag/'.urlencode($t->tag)); ?>"
             class="px-4 py-1.5 rounded-full text-sm font-thai font-semibold border transition-all hover:border-secondary hover:text-secondary"
             style="text-decoration:none;background:<?php echo $isActive?'#fc8a40':'#fff'; ?>;color:<?php echo $isActive?'#fff':'#191c1d'; ?>;border-color:<?php echo $isActive?'#fc8a40':'#c0c7d2'; ?>">
            #<?php echo $t->tag; ?>
          </a>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- Latest News -->
      <div>
        <h3 class="font-thai text-base font-bold mb-5 pb-3 border-b border-outline-variant flex items-center gap-2">
          <span class="material-symbols-outlined text-primary" style="font-size:20px">analytics</span>
          ข่าวล่าสุด
        </h3>
        <?php
        $CI->db->select('news_id, title, category, published_at, created_at');
        $CI->db->from('news');
        $CI->db->where('status', 'published');
        $CI->db->order_by('published_at', 'DESC');
        $CI->db->limit(4);
        $latest = $CI->db->get()->result();
        ?>
        <div class="space-y-5">
          <?php foreach ($latest as $i => $ln): ?>
          <a href="<?php echo base_url('news/'.$ln->news_id); ?>"
             class="group flex gap-4" style="text-decoration:none">
            <div class="text-3xl font-black text-outline-variant/40 group-hover:text-primary/30 transition-colors leading-none w-8 flex-shrink-0">
              <?php echo str_pad($i+1, 2, '0', STR_PAD_LEFT); ?>
            </div>
            <div>
              <h4 class="font-thai text-sm font-bold text-on-surface group-hover:text-primary transition-colors leading-snug mb-1"
                  style="display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden">
                <?php echo $ln->title; ?>
              </h4>
              <span class="text-[10px] text-outline uppercase tracking-wide">
                <?php echo $ln->category; ?> · <?php echo date('d M Y', strtotime($ln->published_at ?: $ln->created_at)); ?>
              </span>
            </div>
          </a>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- Newsletter -->
      <div class="bg-primary rounded-2xl p-6 relative overflow-hidden">
        <div class="absolute top-0 right-0 opacity-10 pointer-events-none">
          <span class="material-symbols-outlined text-white" style="font-size:100px">mail</span>
        </div>
        <div class="relative z-10">
          <h3 class="font-thai text-lg font-bold text-white mb-1">ไม่พลาดทุกความเคลื่อนไหว</h3>
          <p class="text-sm text-white/70 mb-4 leading-relaxed">รับข่าวสารจาก ททท. ระยอง ส่งตรงถึงอีเมลคุณ</p>
          <input type="email" placeholder="อีเมลของคุณ"
                 class="w-full bg-white/10 border-none rounded-lg py-2.5 px-4 text-white placeholder:text-white/50 text-sm mb-2 focus:ring-2 focus:ring-secondary font-thai"/>
          <button class="w-full bg-white text-primary font-bold py-2.5 rounded-lg text-sm hover:bg-secondary hover:text-white transition-all font-thai">
            Subscribe Now
          </button>
        </div>
      </div>

    </aside>
  </div>
</div>
