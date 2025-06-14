<?php
session_start();

// ข้อมูลสินค้าเหมือนเดิม
$products = [
    1 => ['name' => 'รองเท้าวิ่ง', 'price' => 1200],
    2 => ['name' => 'เสื้อกีฬา', 'price' => 800],
    3 => ['name' => 'นาฬิกาออกกำลังกาย', 'price' => 1500],
];

// ดึงตะกร้าสินค้า
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

// ถ้าตะกร้าว่างให้กลับไปหน้าแสดงสินค้า
if (empty($cart)) {
    header("Location: index.php");
    exit;
}

// คำนวณราคารวม
$total = 0;
foreach ($cart as $id => $qty) {
    if (isset($products[$id])) {
        $total += $products[$id]['price'] * $qty;
    }
}

// ตรวจสอบว่ามีการส่งฟอร์มหรือยัง
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $address = trim($_POST['address'] ?? '');

    // ตรวจสอบข้อมูลเบื้องต้น
    if ($name === '') {
        $errors[] = "กรุณากรอกชื่อของคุณ";
    }
    if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "กรุณากรอกอีเมลที่ถูกต้อง";
    }
    if ($address === '') {
        $errors[] = "กรุณากรอกที่อยู่จัดส่ง";
    }

    // ถ้าไม่มี error ให้แสดงข้อความขอบคุณและล้างตะกร้า
    if (empty($errors)) {
        // ปกติจะบันทึกข้อมูลสั่งซื้อที่นี่ (ฐานข้อมูล หรือส่งอีเมล)
        $_SESSION['cart'] = []; // ล้างตะกร้า

        echo "<h1>ขอบคุณสำหรับคำสั่งซื้อ คุณ $name!</h1>";
        echo "<p>เราจะติดต่อกลับไปที่อีเมล: $email</p>";
        echo "<p><a href='index.php'>กลับไปหน้าแรก</a></p>";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>ชำระเงิน</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; max-width: 600px; margin: auto; }
        .error { color: red; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: center; }
        th { background-color: #eee; }
        input, textarea { width: 100%; padding: 8px; margin-bottom: 10px; box-sizing: border-box; }
        button { padding: 10px 20px; }
    </style>
</head>
<body>
    <h1>ชำระเงิน</h1>

    <?php if (!empty($errors)): ?>
        <div class="error">
            <ul>
                <?php foreach($errors as $e): ?>
                    <li><?= htmlspecialchars($e) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <h2>รายการสินค้า</h2>
    <table>
        <tr>
            <th>สินค้า</th>
            <th>ราคา (บาท)</th>
            <th>จำนวน</th>
            <th>ราคารวม (บาท)</th>
        </tr>
        <?php foreach ($cart as $id => $qty): 
            if (!isset($products[$id])) continue;
            $product = $products[$id];
            $subtotal = $product['price'] * $qty;
        ?>
        <tr>
            <td><?= htmlspecialchars($product['name']) ?></td>
            <td><?= number_format($product['price']) ?></td>
            <td><?= $qty ?></td>
            <td><?= number_format($subtotal) ?></td>
        </tr>
        <?php endforeach; ?>
        <tr>
            <th colspan="3" style="text-align:right;">รวมทั้งหมด</th>
            <th><?= number_format($total) ?></th>
        </tr>
    </table>

    <h2>กรอกข้อมูลผู้ซื้อ</h2>
    <form method="post" action="">
        <label for="name">ชื่อ:</label><br>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($_POST['name'] ?? '') ?>" required><br>

        <label for="email">อีเมล:</label><br>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required><br>

        <label for="address">ที่อยู่จัดส่ง:</label><br>
        <textarea id="address" name="address" rows="4" required><?= htmlspecialchars($_POST['address'] ?? '') ?></textarea><br>

        <button type="submit">ยืนยันสั่งซื้อ</button>
    </form>

    <p><a href="cart.php">กลับไปตะกร้าสินค้า</a></p>
</body>
</html>
