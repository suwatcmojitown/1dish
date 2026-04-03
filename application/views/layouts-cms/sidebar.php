<?php defined('BASEPATH') OR exit('No direct script access allowed');
$perms = isset($cms_permissions) ? $cms_permissions : array();
$seg2  = $this->uri->segment(2);
?>

<aside class="sidebar" id="sidebar">
  <div class="sidebar-logo">
    <div class="logo-mark">RC</div>
    <div>
      <div class="logo-text">Rayong Curator</div>
      <div class="logo-sub">CMS</div>
    </div>
  </div>

  <div class="sidebar-section">ภาพรวม</div>
  <a href="<?php echo base_url('cms/dashboard'); ?>"
     class="nav-item <?php echo ($seg2 == 'dashboard' || $seg2 == '') ? 'active' : ''; ?>">
    <span class="nav-dot"></span>Dashboard
  </a>

  <div class="sidebar-section">จัดการข้อมูล</div>

  <?php if (in_array('place', $perms)): ?>
  <a href="<?php echo base_url('cms/place'); ?>"
     class="nav-item <?php echo $seg2 == 'place' ? 'active' : ''; ?>">
    <span class="nav-dot"></span>ร้านค้า / สถานที่
  </a>
  <a href="<?php echo base_url('cms/shelf'); ?>"
     class="nav-item <?php echo ($seg2 == 'shelf' && $this->uri->segment(3) == '') ? 'active' : ''; ?>">
    <span class="nav-dot"></span>Shelf — Hero
  </a>
  <a href="<?php echo base_url('cms/shelf/spotlight'); ?>"
     class="nav-item <?php echo ($seg2 == 'shelf' && $this->uri->segment(3) == 'spotlight') ? 'active' : ''; ?>">
    <span class="nav-dot"></span>Shelf — Spotlight
  </a>
  <a href="<?php echo base_url('cms/news'); ?>"
     class="nav-item <?php echo $seg2 == 'news' ? 'active' : ''; ?>">
    <span class="nav-dot"></span>ข่าวประชาสัมพันธ์
  </a>
  <?php endif; ?>

  <?php if (in_array('category', $perms)): ?>
  <a href="<?php echo base_url('cms/category'); ?>"
     class="nav-item <?php echo $seg2 == 'category' ? 'active' : ''; ?>">
    <span class="nav-dot"></span>หมวดหมู่
  </a>
  <a href="<?php echo base_url('cms/district'); ?>"
     class="nav-item <?php echo $seg2 == 'district' ? 'active' : ''; ?>">
    <span class="nav-dot"></span>อำเภอ
  </a>
  <?php endif; ?>

  <div class="sidebar-section">รีวิว</div>

  <?php if (in_array('review', $perms)): ?>
  <a href="<?php echo base_url('cms/review'); ?>"
     class="nav-item <?php echo $seg2 == 'review' ? 'active' : ''; ?>">
    <span class="nav-dot"></span>อนุมัติรีวิว
  </a>
  <?php endif; ?>

  <?php if (in_array('comment', $perms)): ?>
  <a href="<?php echo base_url('cms/comment'); ?>"
     class="nav-item <?php echo $seg2 == 'comment' ? 'active' : ''; ?>">
    <span class="nav-dot"></span>อนุมัติ Comment
  </a>
  <?php endif; ?>

  <div class="sidebar-section">ผู้ใช้</div>

  <?php if (in_array('user', $perms)): ?>
  <a href="<?php echo base_url('cms/user'); ?>"
     class="nav-item <?php echo $seg2 == 'user' ? 'active' : ''; ?>">
    <span class="nav-dot"></span>ทีมงาน
  </a>
  <?php endif; ?>

  <?php if (in_array('member', $perms)): ?>
  <a href="<?php echo base_url('cms/member'); ?>"
     class="nav-item <?php echo $seg2 == 'member' ? 'active' : ''; ?>">
    <span class="nav-dot"></span>สมาชิก
  </a>
  <?php endif; ?>

  <?php if (in_array('influencer', $perms)): ?>
  <a href="<?php echo base_url('cms/influencer'); ?>"
     class="nav-item <?php echo ($seg2 == 'influencer' && $this->uri->segment(3) == '') ? 'active' : ''; ?>">
    <span class="nav-dot"></span>Influencer
  </a>
  <a href="<?php echo base_url('cms/influencer/content'); ?>"
     class="nav-item <?php echo ($seg2 == 'influencer' && $this->uri->segment(3) == 'content') ? 'active' : ''; ?>">
    <span class="nav-dot"></span>Influencer Buzz (หน้า Home)
  </a>
  <?php endif; ?>

  <?php if (in_array('influencer_own', $perms)): ?>
  <?php endif; ?>

  <?php if (in_array('dashboard', $perms)): ?>
  <div class="nav-section-label">AI Tools</div>
  <a href="<?php echo base_url('cms/ai/imagegen'); ?>"
     class="nav-item <?php echo ($seg2 == 'ai' && $this->uri->segment(3) == 'imagegen') ? 'active' : ''; ?>">
    <span class="nav-dot"></span>✨ AI Image Generator
  </a>
  <?php endif; ?>

  <div class="sidebar-bottom">
    <div class="user-row">
      <div class="user-avatar"><?php echo strtoupper(mb_substr($this->session->userdata('cms_display_name'), 0, 1)); ?></div>
      <div>
        <div class="user-name"><?php echo $this->session->userdata('cms_display_name'); ?></div>
        <div class="user-role"><?php echo $this->session->userdata('cms_role'); ?></div>
      </div>
    </div>
  </div>
</aside>

<div class="sidebar-overlay" id="sidebar-overlay"></div>
