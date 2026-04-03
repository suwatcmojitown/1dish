<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if ($this->session->flashdata('success')): ?>
<div class="alert-success"><?php echo $this->session->flashdata('success'); ?></div>
<?php endif; ?>

<div class="toolbar" style="margin-bottom:16px">
  <a href="<?php echo base_url('cms/influencer/add'); ?>" class="btn btn-primary">+ เพิ่ม Influencer</a>
  <span class="result-count">ทั้งหมด <?php echo $list ? count($list) : 0; ?> คน</span>
</div>

<div class="influ-grid">
  <?php if ($list): foreach ($list as $row): ?>
  <div class="influ-card-cms">
    <!-- Cover -->
    <div class="influ-cover" style="<?php echo !empty($row->cover_image) ? 'background-image:url('.base_url($row->cover_image).')' : ''; ?>">
      <!-- Avatar -->
      <div class="influ-avatar-wrap">
        <?php if (!empty($row->avatar)): ?>
        <img src="<?php echo base_url($row->avatar); ?>" class="influ-avatar-img">
        <?php else: ?>
        <div class="influ-avatar-placeholder"><?php echo strtoupper(mb_substr($row->display_name, 0, 1)); ?></div>
        <?php endif; ?>
      </div>
      <?php if ($row->is_tat_verified): ?>
      <span class="tat-badge" style="position:absolute;top:10px;right:10px">TAT Verified</span>
      <?php endif; ?>
    </div>
    <!-- Info -->
    <div class="influ-info">
      <div class="influ-name"><?php echo $row->display_name; ?></div>
      <div class="influ-bio"><?php echo !empty($row->bio) ? mb_substr($row->bio, 0, 80) . (mb_strlen($row->bio) > 80 ? '...' : '') : '-'; ?></div>
      <!-- Stats -->
      <div class="influ-stats-row">
        <div class="influ-stat">
          <div class="influ-stat-val"><?php echo $row->trusted_review_count; ?></div>
          <div class="influ-stat-lbl">Reviews</div>
        </div>
        <div class="influ-stat">
          <div class="influ-stat-val"><?php echo $row->district_explored; ?></div>
          <div class="influ-stat-lbl">Districts</div>
        </div>
        <div class="influ-stat">
          <div class="influ-stat-val"><?php echo number_format($row->traveler_guided); ?></div>
          <div class="influ-stat-lbl">Guided</div>
        </div>
      </div>
      <!-- Social -->
      <div class="influ-social">
        <?php if (!empty($row->tiktok_url)): ?>
        <a href="<?php echo $row->tiktok_url; ?>" target="_blank" class="social-link tiktok" title="TikTok">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-2.88 2.5 2.89 2.89 0 0 1-2.89-2.89 2.89 2.89 0 0 1 2.89-2.89c.28 0 .54.04.79.1V9.01a6.33 6.33 0 0 0-.79-.05 6.34 6.34 0 0 0-6.34 6.34 6.34 6.34 0 0 0 6.34 6.34 6.34 6.34 0 0 0 6.33-6.34V9.05a8.16 8.16 0 0 0 4.77 1.52V7.12a4.85 4.85 0 0 1-1-.43z"/></svg>
        </a>
        <?php endif; ?>
        <?php if (!empty($row->youtube_url)): ?>
        <a href="<?php echo $row->youtube_url; ?>" target="_blank" class="social-link youtube" title="YouTube">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M23.5 6.19a3.02 3.02 0 0 0-2.12-2.14C19.54 3.5 12 3.5 12 3.5s-7.54 0-9.38.55A3.02 3.02 0 0 0 .5 6.19C0 8.04 0 12 0 12s0 3.96.5 5.81a3.02 3.02 0 0 0 2.12 2.14C4.46 20.5 12 20.5 12 20.5s7.54 0 9.38-.55a3.02 3.02 0 0 0 2.12-2.14C24 15.96 24 12 24 12s0-3.96-.5-5.81zM9.75 15.5v-7l6.5 3.5-6.5 3.5z"/></svg>
        </a>
        <?php endif; ?>
        <?php if (!empty($row->ig_url)): ?>
        <a href="<?php echo $row->ig_url; ?>" target="_blank" class="social-link ig" title="Instagram">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none"/></svg>
        </a>
        <?php endif; ?>
      </div>
      <!-- Action -->
      <div class="influ-action">
        <a href="<?php echo base_url('cms/influencer/edit/' . $row->influencer_id); ?>" class="btn btn-ghost btn-sm" style="flex:1;justify-content:center">
          <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
          แก้ไข
        </a>
      </div>
    </div>
  </div>
  <?php endforeach; else: ?>
  <div style="grid-column:1/-1;text-align:center;padding:40px;color:var(--muted)">ยังไม่มี Influencer</div>
  <?php endif; ?>
</div>
