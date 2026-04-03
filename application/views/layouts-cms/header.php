<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
$my_role    = $this->session->userdata('cms_role');
$my_user_id = $this->session->userdata('cms_user_id');
$my_name    = $this->session->userdata('cms_display_name');

if ($my_role === 'influencer') {
    $my_inf      = $this->db->get_where('influencer', array('user_id' => $my_user_id))->row();
    $profile_url = $my_inf ? base_url('cms/influencer/edit/' . $my_inf->influencer_id) : '#';
} else {
    $profile_url = base_url('cms/user/edit/' . $my_user_id);
}
?>

<div class="topbar">
  <div class="topbar-left">
    <button class="menu-toggle" id="menu-toggle">
      <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <line x1="3" y1="6" x2="21" y2="6"/>
        <line x1="3" y1="12" x2="21" y2="12"/>
        <line x1="3" y1="18" x2="21" y2="18"/>
      </svg>
    </button>
    <span class="topbar-title"><?php echo isset($page_title) ? $page_title : ''; ?></span>
  </div>
  <div style="display:flex;align-items:center;gap:8px">
    <!-- Avatar + ชื่อ -->
    <div style="display:flex;align-items:center;gap:8px;padding:4px 10px;border-radius:10px;background:var(--bg2)">
      <div style="width:28px;height:28px;border-radius:50%;background:var(--primary);display:flex;align-items:center;justify-content:center;color:#fff;font-size:12px;font-weight:700;flex-shrink:0">
        <?php echo strtoupper(mb_substr($my_name, 0, 1)); ?>
      </div>
      <div style="line-height:1.2">
        <div style="font-size:12px;font-weight:600;color:var(--text)"><?php echo $my_name; ?></div>
        <div style="font-size:10px;color:var(--muted)"><?php echo $my_role; ?></div>
      </div>
    </div>
    <!-- ปุ่มแก้ไขโปรไฟล์ -->
    <a href="<?php echo $profile_url; ?>"
       style="display:flex;align-items:center;gap:5px;padding:6px 12px;border-radius:8px;border:1px solid var(--border);background:#fff;color:var(--text);text-decoration:none;font-size:12px;font-weight:600;transition:all .15s"
       onmouseover="this.style.borderColor='var(--primary)';this.style.color='var(--primary)'"
       onmouseout="this.style.borderColor='var(--border)';this.style.color='var(--text)'">
      <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
      โปรไฟล์
    </a>
    <!-- ปุ่ม Logout -->
    <a href="<?php echo base_url('cms/logout'); ?>"
       style="display:flex;align-items:center;gap:5px;padding:6px 12px;border-radius:8px;border:1px solid var(--border);background:#fff;color:var(--muted);text-decoration:none;font-size:12px;font-weight:600;transition:all .15s"
       onmouseover="this.style.borderColor='var(--danger)';this.style.color='var(--danger)'"
       onmouseout="this.style.borderColor='var(--border)';this.style.color='var(--muted)'">
      <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
      ออก
    </a>
  </div>
</div>
