<?php
session_start();

// ข้อมูลสินค้าเหมือนเดิม
$products = [
    1 => ['name' => 'มุ้งลวดมาตรฐาน', 'price' => 1500],
    2 => ['name' => 'มุ้งลวดกันแมลง', 'price' => 2000],
    3 => ['name' => 'มุ้งลวดกันฝุ่น', 'price' => 1800],
];

// ฟังก์ชันเพิ่มสินค้าเข้าตะกร้า
function addToCart($id) {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]++;
    } else {
        $_SESSION['cart'][$id] = 1;
    }
}

// ฟังก์ชันลบสินค้าออกจากตะกร้า
function removeFromCart($id) {
    if (isset($_SESSION['cart'][$id])) {
        unset($_SESSION['cart'][$id]);
    }
}

// ฟังก์ชันล้างตะกร้า
function clearCart() {
    unset($_SESSION['cart']);
}

// จัดการคำสั่งจาก URL
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

    if ($action === 'add' && isset($products[$id])) {
        addToCart($id);
        header('Location: cart.php');
        exit;
    }
    if ($action === 'remove' && isset($products[$id])) {
        removeFromCart($id);
        header('Location: cart.php');
        exit;
    }
    if ($action === 'clear') {
        clearCart();
        header('Location: cart.php');
        exit;
    }
}

// ดึงข้อมูลตะกร้า
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8" />
    <title>ตะกร้าสินค้า - ร้านขายมุ้งออนไลน์</title>
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
    <h2>ตะกร้าสินค้า</h2>

    <?php if (empty($cart)): ?>
        <p>ตะกร้าของคุณยังว่างอยู่</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>สินค้า</th>
                    <th>ราคา (บาท)</th>
                    <th>จำนวน</th>
                    <th>รวม (บาท)</th>
                    <th>จัดการ</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $total = 0;
                foreach ($cart as $id => $qty): 
                    $product = $products[$id];
                    $subtotal = $product['price'] * $qty;
                    $total += $subtotal;
                ?>
                <tr>
                    <td><?= htmlspecialchars($product['name']) ?></td>
                    <td><?= number_format($product['price']) ?></td>
                    <td><?= $qty ?></td>
                    <td><?= number_format($subtotal) ?></td>
                    <td><a href="cart.php?action=remove&id=<?= $id ?>" class="btn btn-remove">ลบ</a></td>
                </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="3" style="text-align:right; font-weight:bold;">ราคารวมทั้งหมด</td>
                    <td colspan="2" style="font-weight:bold;"><?= number_format($total) ?> บาท</td>
                </tr>
            </tbody>
        </table>

        <div style="margin-top:20px;">
            <a href="cart.php?action=clear" class="btn btn-clear">ล้างตะกร้าสินค้า</a>
            <a href="checkout.php" class="btn btn-checkout">ไปชำระเงิน</a>
        </div>
    <?php endif; ?>
</main>

<footer>
    <p>© 2025 ร้านขายมุ้งออนไลน์</p>
</footer>
</body>
</html>
