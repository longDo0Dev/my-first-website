const saleStart = new Date('<?= $saleStart ?>').getTime();
  const saleEnd = new Date('<?= $saleEnd ?>').getTime();

  document.addEventListener('DOMContentLoaded', () => {
    const countdownElements = document.querySelectorAll('.countdown');

    countdownElements.forEach(el => {
      function updateCountdown() {
        const now = new Date().getTime();

        if (now < saleStart) {
          // ยังไม่เริ่ม
          const distanceToStart = saleStart - now;
          const hours = Math.floor(distanceToStart / (1000 * 60 * 60));
          const minutes = Math.floor((distanceToStart % (1000 * 60 * 60)) / (1000 * 60));
          el.textContent = `Flash Sale เริ่มใน ${hours} ชม. ${minutes} นาที`;
        } else if (now >= saleStart && now <= saleEnd) {
          // กำลัง Flash Sale
          const distanceToEnd = saleEnd - now;
          const days = Math.floor(distanceToEnd / (1000 * 60 * 60 * 24));
          const hours = Math.floor((distanceToEnd % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
          const minutes = Math.floor((distanceToEnd % (1000 * 60 * 60)) / (1000 * 60));
          const seconds = Math.floor((distanceToEnd % (1000 * 60)) / 1000);

          el.textContent = `Flash Sale กำลัง berlangsung! เหลือเวลา ${days} วัน ${hours} ชม. ${minutes} นาที ${seconds} วินาที`;
        } else {
          // หมดเวลา Flash Sale แล้ว
          el.textContent = 'หมดเวลาขาย Flash Sale แล้ว';
          clearInterval(intervalId);
        }
      }

      updateCountdown();
      const intervalId = setInterval(updateCountdown, 1000);
    });
  });

  document.getElementById('checkoutForm').addEventListener('submit', function(e) {
    const name = this.name.value.trim();
    const email = this.email.value.trim();
    const address = this.address.value.trim();

    // ลบข้อความ error เก่าถ้ามี
    const oldError = document.querySelector('.error-msg-js');
    if (oldError) oldError.remove();

    if (!name || !email || !address) {
        e.preventDefault();
        showError('กรุณากรอกข้อมูลให้ครบถ้วน');
        return false;
    }

    if (!validateEmail(email)) {
        e.preventDefault();
        showError('รูปแบบอีเมลไม่ถูกต้อง');
        return false;
    }

    function showError(msg) {
        const p = document.createElement('p');
        p.classList.add('error-msg-js');
        p.style.color = '#e74c3c';
        p.style.fontWeight = '700';
        p.style.marginBottom = '1rem';
        p.textContent = msg;
        const form = document.getElementById('checkoutForm');
        form.parentNode.insertBefore(p, form);
    }

    function validateEmail(email) {
        // regex ตรวจสอบอีเมลง่าย ๆ
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }
});

function showToast(message) {
    let toast = document.createElement('div');
    toast.className = 'toast show';
    toast.textContent = message;
    document.body.appendChild(toast);
    setTimeout(() => {
        toast.classList.remove('show');
        toast.classList.add('hide');
        setTimeout(() => toast.remove(), 500);
    }, 2500);
}