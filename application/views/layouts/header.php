<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $current = $this->uri->segment(1) ?: 'home'; ?>

<!-- TOP BANNER AD -->
<div class="w-full bg-surface-container-low flex justify-center py-2 border-b border-outline-variant/20">
  <div class="w-full max-w-[1280px] h-[80px] rounded-xl overflow-hidden relative cursor-pointer mx-4">
    <img alt="TAT Rayong" class="w-full h-full object-cover"
         src="https://lh3.googleusercontent.com/aida-public/AB6AXuDXG4g9ZCWbfRTzsGfXUl8M4tY6tnRxL6zVClYc0BcDpdWf4un6CVhdHOtITkDAfmsN61BRJsC6FUhooj0IAD9uVtVq25CNzCBGEhbtmsvFc7BwQM3cW9WnpYgw9XJsiCu5w1zIFwKmiWOZNA8EKmuuvYfG0qelOXW1jsFhw1SoAI2XTIxXiasdpbxXmKAYRVtxOIPF8haGBAAdxAKyQFD1kMi5YaMPb8lA0MC1R_asjSZay08KmG0d1qXx_U6ths4PmEfGzvAI97M4"/>
    <div class="absolute inset-0 bg-black/40 flex items-center justify-between px-8 text-white">
      <div>
        <span class="text-[10px] uppercase tracking-widest font-bold bg-white/20 px-2 py-0.5 rounded mb-1 inline-block">สนับสนุนโดย ททท.</span>
        <h3 class="text-xl font-thai font-extrabold">เทศกาลผลไม้เมืองระยอง</h3>
      </div>
      <p class="text-sm font-medium hidden md:block text-right">ร่วมงานเทศกาลทุเรียนและมังคุด ประจำปี 2567<br/>สัมผัสรสชาติอันเป็นเอกลักษณ์</p>
    </div>
  </div>
</div>

<!-- NAVBAR -->
<nav class="sticky top-0 w-full z-50 bg-slate-50/80 backdrop-blur-xl border-b border-outline-variant/10">
  <div class="w-full max-w-[1280px] mx-auto flex justify-between items-center px-8 py-3">
    <div class="flex items-center gap-10">
      <a href="<?php echo base_url(); ?>" class="text-xl font-black text-blue-900 italic font-thai">Rayong Curator</a>
      <div class="hidden md:flex gap-6">
        <a href="<?php echo base_url(); ?>"
           class="<?php echo $current == 'home' || $current == '' ? 'text-blue-700 border-b-2 border-blue-700 pb-1' : 'text-slate-600 hover:text-blue-600'; ?> text-sm font-medium transition-colors">
          สำรวจ
        </a>
        <a href="#"
           class="text-slate-600 hover:text-blue-600 transition-colors text-sm font-medium">รสชาติ</a>
        <a href="#"
           class="text-slate-600 hover:text-blue-600 transition-colors text-sm font-medium">บันทึกการเดินทาง</a>
        <a href="#"
           class="text-slate-600 hover:text-blue-600 transition-colors text-sm font-medium">ท่องเที่ยวสีเขียว</a>
      </div>
    </div>
    <div class="flex items-center gap-4">
      <form id="search-form" action="<?php echo base_url('explore'); ?>" method="GET"
            class="hidden lg:flex items-center rounded-xl border border-outline-variant/30 gap-2 overflow-hidden"
            style="background:rgba(248,249,250,0.9);backdrop-filter:blur(8px);transition:width .35s cubic-bezier(.4,0,.2,1);width:160px"
            onsubmit="return validateSearch(this)">
        <input id="search-input" name="q"
               class="bg-transparent border-none focus:ring-0 text-sm font-thai flex-1"
               style="padding:7px 0 7px 14px;min-width:0;outline:none;transition:opacity .3s"
               placeholder="ค้นหาร้าน เมนู..."
               value="<?php echo htmlspecialchars($this->input->get('q') ?: ''); ?>"
               type="text"
               onfocus="expandSearch()" onblur="collapseSearch(this)"/>
        <button type="submit"
                style="flex-shrink:0;width:34px;height:34px;margin:2px;border-radius:9px;background:#005e97;border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:background .2s"
                onmouseover="this.style.background='#003d66'" onmouseout="this.style.background='#005e97'">
          <span class="material-symbols-outlined" style="font-size:16px;color:#fff">search</span>
        </button>
      </form>

      <style>
        #search-form.expanded { width: 280px !important; }
        #search-form.expanded #search-input { opacity: 1; }
      </style>

      <script>
        function expandSearch() {
          document.getElementById('search-form').classList.add('expanded');
        }
        function collapseSearch(input) {
          if (!input.value) {
            document.getElementById('search-form').classList.remove('expanded');
          }
        }
        function validateSearch(form) {
          var q = form.querySelector('input[name="q"]').value.trim();
          if (!q) { expandSearch(); form.querySelector('input').focus(); return false; }
          return true;
        }
        // ถ้ามีค่า q อยู่แล้ว ให้ขยายไว้เลย
        window.addEventListener('DOMContentLoaded', function() {
          var input = document.getElementById('search-input');
          if (input && input.value) expandSearch();
        });
      </script>
    </div>
  </div>
</nav>
