<?php
session_start();

$products = [
    1 => ['name' => 'มุ้งลวดมาตรฐาน', 'price' => 1500],
    2 => ['name' => 'มุ้งลวดกันแมลง', 'price' => 2000],
    3 => ['name' => 'มุ้งลวดกันฝุ่น', 'price' => 1800],
];

$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

if (empty($cart)) {
    echo '
    <div class="empty-cart-message" style="text-align:center; margin-top:60px;">
        <img src="images/empty_cart.png" alt="ตะกร้าว่างเปล่า" style="width:150px; margin-bottom:20px;">
        <h2 style="color:#666;">โอ๊ะ! ตะกร้าของคุณยังว่างอยู่</h2>
        <p>เลือกสินค้าที่คุณชอบแล้วมาเติมตะกร้าของคุณได้เลย!</p>
        <a href="index.php" style="display:inline-block; background:#e67e22; color:#fff; padding:12px 30px; border-radius:8px; font-weight:bold; text-decoration:none; margin-top:15px;">กลับไปเลือกสินค้า</a>
    </div>
    ';
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $address = trim($_POST['address'] ?? '');

    if ($name && filter_var($email, FILTER_VALIDATE_EMAIL) && $address) {
        unset($_SESSION['cart']);

        echo "<h2>ขอบคุณสำหรับการสั่งซื้อ คุณ " . htmlspecialchars($name) . "</h2>";
        echo "<p>รายละเอียดคำสั่งซื้อจะถูกส่งไปที่อีเมล: " . htmlspecialchars($email) . "</p>";
        echo "<p><a href='index.php'>กลับไปหน้าหลัก</a></p>";
        exit;
    } else {
        $error = "กรุณากรอกข้อมูลให้ครบถ้วนและถูกต้อง";
    }
}

$total = 0;
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8" />
    <title>ชำระเงิน - ร้านขายมุ้งออนไลน์</title>
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet" />
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<header>
    <h1>ร้านขายมุ้งออนไลน์</h1>
    <nav>
        <a href="index.php">หน้าหลัก</a> |
        <a href="cart.php">ตะกร้าสินค้า</a>
    </nav>
</header>

<main>
    <h2>ตรวจสอบรายการสินค้าและกรอกข้อมูลการจัดส่ง</h2>

    <?php if (!empty($error)): ?>
        <p class="error-msg"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <table>
        <thead>
            <tr>
                <th>สินค้า</th>
                <th>ราคา (บาท)</th>
                <th>จำนวน</th>
                <th>รวม (บาท)</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cart as $id => $qty):
                $product = $products[$id];
                $subtotal = $product['price'] * $qty;
                $total += $subtotal;
            ?>
            <tr>
                <td><?= htmlspecialchars($product['name']) ?></td>
                <td><?= number_format($product['price']) ?></td>
                <td><?= $qty ?></td>
                <td><?= number_format($subtotal) ?></td>
            </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="3" style="text-align:right; font-weight:bold;">ราคารวมทั้งหมด</td>
                <td style="font-weight:bold;"><?= number_format($total) ?> บาท</td>
            </tr>
        </tbody>
    </table>

    <h3>ข้อมูลผู้สั่งซื้อ</h3>
    <form method="post" action="checkout.php" id="checkoutForm" novalidate>
        <label for="name">ชื่อ-นามสกุล:</label><br />
        <input type="text" id="name" name="name" required /><br /><br />

        <label for="email">อีเมล:</label><br />
        <input type="email" id="email" name="email" required /><br /><br />

        <label for="address">ที่อยู่จัดส่ง:</label><br />
        <textarea id="address" name="address" rows="4" required></textarea><br /><br />

        <button type="submit" class="btn-checkout">ยืนยันการสั่งซื้อ</button>
    </form>
</main>

<footer>
    <p>© 2025 ร้านขายมุ้งออนไลน์</p>
</footer>
<script src="js/script.js"></script>
</body>
</html>
