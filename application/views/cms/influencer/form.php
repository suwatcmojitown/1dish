<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $is_edit = !empty($influencer); ?>

<form method="POST" enctype="multipart/form-data"
      action="<?php echo base_url($is_edit ? 'cms/influencer/update' : 'cms/influencer/save'); ?>">

  <?php if ($is_edit): ?>
  <input type="hidden" name="influencer_id" value="<?php echo $influencer->influencer_id; ?>">
  <?php endif; ?>

  <div style="display:grid;grid-template-columns:1fr 300px;gap:24px;align-items:start">

    <!-- LEFT: ข้อมูลหลัก -->
    <div style="display:flex;flex-direction:column;gap:20px">

      <!-- ข้อมูลพื้นฐาน -->
      <div class="card" style="padding:24px">
        <h4 style="font-weight:700;font-size:14px;margin:0 0 16px 0">ข้อมูล Influencer</h4>
        <div class="form-group">
          <label class="form-label">User Account *</label>
          <select name="user_id" class="form-control" required>
            <option value="">-- เลือก User --</option>
            <?php if (!empty($userList)): foreach ($userList as $u): ?>
            <option value="<?php echo $u->user_id; ?>"
              <?php echo ($is_edit && $influencer->user_id == $u->user_id) ? 'selected' : ''; ?>>
              <?php echo $u->display_name; ?> (<?php echo $u->username; ?>)
            </option>
            <?php endforeach; endif; ?>
          </select>
        </div>
        <div class="form-group">
          <label class="form-label">ชื่อที่แสดง (Display Name) <span style="color:var(--muted);font-weight:400;font-size:11px">— ถ้าไม่กรอกจะใช้ชื่อจาก User</span></label>
          <input type="text" name="display_name" class="form-control" placeholder="เช่น กัญญา สมศักดิ์"
                 value="<?php echo $is_edit ? htmlspecialchars($influencer->display_name ?? '') : ''; ?>"/>
        </div>
        <div class="form-group">
          <label class="form-label">Bio</label>
          <textarea name="bio" class="form-control" rows="3" placeholder="เล่าเกี่ยวกับตัวเอง..."><?php echo $is_edit ? htmlspecialchars($influencer->bio ?? '') : ''; ?></textarea>
        </div>
      </div>

      <!-- Social Links -->
      <div class="card" style="padding:24px">
        <h4 style="font-weight:700;font-size:14px;margin:0 0 16px 0">Social Links</h4>
        <div class="form-group">
          <label class="form-label">TikTok Profile URL</label>
          <input type="text" name="tiktok_url" class="form-control"
                 placeholder="https://www.tiktok.com/@username"
                 value="<?php echo $is_edit ? htmlspecialchars($influencer->tiktok_url ?? '') : ''; ?>"/>
          <p style="font-size:11px;color:var(--muted);margin-top:4px">ใส่ URL หน้า profile TikTok ของ influencer เพื่อให้คนกดไปดูได้</p>
        </div>
        <div class="form-group">
          <label class="form-label">Instagram URL</label>
          <input type="text" name="ig_url" class="form-control"
                 placeholder="https://instagram.com/username"
                 value="<?php echo $is_edit ? htmlspecialchars($influencer->ig_url ?? '') : ''; ?>"/>
        </div>
        <div class="form-group">
          <label class="form-label">YouTube URL</label>
          <input type="text" name="youtube_url" class="form-control"
                 placeholder="https://youtube.com/@username"
                 value="<?php echo $is_edit ? htmlspecialchars($influencer->youtube_url ?? '') : ''; ?>"/>
        </div>
      </div>

      <!-- TikTok Content IDs -->
      <div class="card" style="padding:24px">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px">
          <div>
            <h4 style="font-weight:700;font-size:14px;margin:0 0 2px 0">คลิป TikTok ที่ต้องการแสดง</h4>
            <p style="font-size:11px;color:var(--muted);margin:0">วาง URL หรือ Video ID ของคลิปที่ต้องการแสดงในหน้าโปรไฟล์</p>
          </div>
          <button type="button" onclick="addTikTokRow()" class="btn btn-primary btn-sm">+ เพิ่มคลิป</button>
        </div>
        <div id="tiktok-rows" style="display:flex;flex-direction:column;gap:10px">
          <?php if ($is_edit && !empty($tiktokList)): foreach ($tiktokList as $i => $t): ?>
          <div class="tiktok-row" style="display:grid;grid-template-columns:1fr 1fr auto;gap:8px;align-items:center">
            <input type="text" name="tiktok_ids[]" class="form-control"
                   placeholder="Video ID หรือ URL"
                   value="<?php echo htmlspecialchars($t->tiktok_id); ?>"/>
            <input type="text" name="tiktok_titles[]" class="form-control"
                   placeholder="ชื่อ / คำอธิบายคลิป"
                   value="<?php echo htmlspecialchars($t->title); ?>"/>
            <button type="button" onclick="removeTikTokRow(this)"
                    style="width:32px;height:32px;border:none;background:#fee2e2;color:#dc2626;border-radius:8px;cursor:pointer;font-size:16px;line-height:1;flex-shrink:0">×</button>
          </div>
          <?php endforeach; else: ?>
          <p id="tiktok-empty" style="font-size:12px;color:var(--muted);text-align:center;padding:20px 0">ยังไม่มีคลิป — กด "+ เพิ่มคลิป" ได้เลยครับ</p>
          <?php endif; ?>
        </div>
      </div>

      <!-- Stats -->
      <div class="card" style="padding:24px">
        <h4 style="font-weight:700;font-size:14px;margin:0 0 16px 0">สถิติ (สำหรับแสดงในหน้าโปรไฟล์)</h4>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px">
          <div class="form-group">
            <label class="form-label">จำนวนรีวิว</label>
            <input type="number" name="trusted_review_count" class="form-control" min="0"
                   value="<?php echo $is_edit ? $influencer->trusted_review_count : 0; ?>"/>
          </div>
          <div class="form-group">
            <label class="form-label">อำเภอที่สำรวจ</label>
            <input type="number" name="district_explored" class="form-control" min="0"
                   value="<?php echo $is_edit ? $influencer->district_explored : 0; ?>"/>
          </div>
          <div class="form-group">
            <label class="form-label">คะแนนเฉลี่ย</label>
            <input type="number" name="avg_score" class="form-control" min="0" max="5" step="0.1"
                   value="<?php echo $is_edit ? $influencer->avg_score : ''; ?>"/>
          </div>
          <div class="form-group">
            <label class="form-label">นักท่องเที่ยวที่แนะนำ</label>
            <input type="number" name="traveler_guided" class="form-control" min="0"
                   value="<?php echo $is_edit ? $influencer->traveler_guided : 0; ?>"/>
          </div>
        </div>
      </div>

    </div>

    <!-- RIGHT: รูปภาพ + ตั้งค่า -->
    <div style="display:flex;flex-direction:column;gap:16px">

      <!-- บันทึก -->
      <div class="card" style="padding:20px">
        <div style="display:flex;gap:8px">
          <button type="submit" class="btn btn-primary" style="flex:1">บันทึก</button>
          <a href="<?php echo base_url('cms/influencer'); ?>" class="btn btn-ghost">ยกเลิก</a>
        </div>
        <div class="form-group" style="margin-top:16px">
          <div style="display:flex;align-items:center;gap:10px">
            <input type="checkbox" name="is_tat_verified" value="1" id="tat"
                   <?php echo ($is_edit && $influencer->is_tat_verified) ? 'checked' : ''; ?>
                   style="width:16px;height:16px;cursor:pointer">
            <label for="tat" style="font-size:13px;cursor:pointer;margin:0">TAT Verified ✓</label>
          </div>
        </div>
      </div>

      <!-- Avatar -->
      <div class="card" style="padding:20px">
        <h4 style="font-weight:700;font-size:14px;margin:0 0 12px 0">รูป Avatar</h4>
        <?php if ($is_edit && !empty($influencer->avatar)): ?>
        <img src="<?php echo base_url($influencer->avatar); ?>"
             style="width:80px;height:80px;border-radius:50%;object-fit:cover;border:2px solid var(--border);display:block;margin-bottom:12px"/>
        <?php endif; ?>
        <input type="file" name="avatar" accept="image/*" class="form-control"/>
        <p style="font-size:11px;color:var(--muted);margin-top:4px">แนะนำรูปสี่เหลี่ยมจัตุรัส</p>
      </div>

      <!-- Cover -->
      <div class="card" style="padding:20px">
        <h4 style="font-weight:700;font-size:14px;margin:0 0 12px 0">รูป Cover</h4>
        <?php if ($is_edit && !empty($influencer->cover_image)): ?>
        <img src="<?php echo base_url($influencer->cover_image); ?>"
             style="width:100%;aspect-ratio:16/9;object-fit:cover;border-radius:8px;margin-bottom:12px"/>
        <?php endif; ?>
        <input type="file" name="cover_image" accept="image/*" class="form-control"/>
        <p style="font-size:11px;color:var(--muted);margin-top:4px">แนะนำสัดส่วน 16:9</p>
      </div>

    </div>
  </div>
</form>

<script>
function addTikTokRow() {
  var empty = document.getElementById('tiktok-empty');
  if (empty) empty.remove();

  var row = document.createElement('div');
  row.className = 'tiktok-row';
  row.style.cssText = 'display:grid;grid-template-columns:1fr 1fr auto;gap:8px;align-items:center';
  row.innerHTML =
    '<input type="text" name="tiktok_ids[]" class="form-control" placeholder="Video ID หรือ URL"/>' +
    '<input type="text" name="tiktok_titles[]" class="form-control" placeholder="ชื่อ / คำอธิบายคลิป"/>' +
    '<button type="button" onclick="removeTikTokRow(this)" style="width:32px;height:32px;border:none;background:#fee2e2;color:#dc2626;border-radius:8px;cursor:pointer;font-size:16px;line-height:1;flex-shrink:0">×</button>';
  document.getElementById('tiktok-rows').appendChild(row);
}

function removeTikTokRow(btn) {
  btn.closest('.tiktok-row').remove();
  var rows = document.querySelectorAll('.tiktok-row');
  if (rows.length === 0) {
    var p = document.createElement('p');
    p.id = 'tiktok-empty';
    p.style.cssText = 'font-size:12px;color:var(--muted);text-align:center;padding:20px 0';
    p.textContent = 'ยังไม่มีคลิป — กด "+ เพิ่มคลิป" ได้เลยครับ';
    document.getElementById('tiktok-rows').appendChild(p);
  }
}
</script>
