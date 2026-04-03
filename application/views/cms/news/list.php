<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- Filter tabs -->
<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:18px">
  <div class="filter-bar">
    <?php
    $tabs = array(
      ''          => array('label' => 'ทั้งหมด',      'badge' => 'badge-gray'),
      'published' => array('label' => 'เผยแพร่แล้ว', 'badge' => 'badge-green'),
      'draft'     => array('label' => 'ฉบับร่าง',    'badge' => 'badge-warn'),
    );
    foreach ($tabs as $val => $tab):
      $url    = base_url('cms/news') . ($val != '' ? '?status=' . $val : '');
      $active = $status == $val;
      $count  = $val == ''          ? $total
              : ($val == 'published' ? $this->News_model->countNews('published')
                                     : $this->News_model->countNews('draft'));
    ?>
    <a href="<?php echo $url; ?>" class="filter-tab <?php echo $active ? 'active' : ''; ?>">
      <?php echo $tab['label']; ?>
      <span class="filter-tab-count <?php echo $active ? '' : $tab['badge']; ?>">
        <?php echo $count; ?>
      </span>
    </a>
    <?php endforeach; ?>
  </div>
  <a href="<?php echo base_url('cms/news/form'); ?>" class="btn btn-primary">
    + เพิ่มข่าวใหม่
  </a>
</div>

<div class="card" style="padding:0;overflow:hidden">
  <table class="data-table">
    <thead>
      <tr>
        <th style="width:120px">รูป</th>
        <th>หัวข้อ</th>
        <th style="width:120px">หมวดหมู่</th>
        <th style="width:90px">สถานะ</th>
        <th style="width:90px">วันที่</th>
        <th style="width:100px">จัดการ</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($newsList): foreach ($newsList as $n): ?>
      <tr>
        <td>
          <?php if (!empty($n->thumbnail)): ?>
          <img src="<?php echo base_url($n->thumbnail); ?>"
               style="width:100px;height:64px;object-fit:cover;border-radius:8px"/>
          <?php else: ?>
          <div style="width:100px;height:64px;background:var(--bg3);border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:24px">📰</div>
          <?php endif; ?>
        </td>
        <td>
          <div style="font-weight:600;font-size:13px;margin-bottom:3px"><?php echo $n->title; ?></div>
          <div style="font-size:11px;color:var(--muted)">✍️ <?php echo $n->author_name; ?></div>
        </td>
        <td>
          <span class="badge badge-blue"><?php echo $n->category; ?></span>
        </td>
        <td>
          <?php if ($n->status == 'published'): ?>
          <span class="badge badge-green">เผยแพร่</span>
          <?php else: ?>
          <span class="badge badge-warn">ฉบับร่าง</span>
          <?php endif; ?>
        </td>
        <td style="font-size:12px;color:var(--muted)"><?php echo date('d/m/Y', strtotime($n->created_at)); ?></td>
        <td>
          <div style="display:flex;gap:6px">
            <a href="<?php echo base_url('cms/news/form/' . $n->news_id); ?>" class="icon-btn" title="แก้ไข">
              <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
            </a>
            <a href="<?php echo base_url('cms/news/delete/' . $n->news_id); ?>"
               onclick="return confirm('ต้องการลบข่าวนี้ไหม?')"
               class="icon-btn danger" title="ลบ">
              <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4h6v2"/></svg>
            </a>
          </div>
        </td>
      </tr>
      <?php endforeach; else: ?>
      <tr>
        <td colspan="6" style="text-align:center;padding:48px;color:var(--muted)">
          ยังไม่มีข่าว — กด "+ เพิ่มข่าวใหม่" ได้เลยครับ
        </td>
      </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>

<?php if ($total > $limit): ?>
<div style="display:flex;justify-content:center;gap:8px;margin-top:20px">
  <?php $pages = ceil($total / $limit);
  for ($i = 1; $i <= $pages; $i++): ?>
  <a href="?page=<?php echo $i; ?>&status=<?php echo $status; ?>"
     class="btn <?php echo $i == $page ? 'btn-primary' : 'btn-ghost'; ?>" style="min-width:36px">
    <?php echo $i; ?>
  </a>
  <?php endfor; ?>
</div>
<?php endif; ?>
