<?php
session_start();

// ข้อมูลสินค้าเหมือนเดิม
$products = [
    1 => ['name' => 'รองเท้าวิ่ง', 'price' => 1200, 'image' => 'shoes.jpg'],
    2 => ['name' => 'เสื้อกีฬา', 'price' => 800, 'image' => 'shirt.jpg'],
    3 => ['name' => 'นาฬิกาออกกำลังกาย', 'price' => 1500, 'image' => 'watch.jpg'],
];

// ดึงข้อมูลตะกร้าจาก session
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

// รวมราคารวม
$total = 0;
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>ตะกร้าสินค้า</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: center; }
        th { background-color: #eee; }
        img { max-width: 50px; }
        a { color: blue; text-decoration: none; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <h1>ตะกร้าสินค้า</h1>

    <?php if (empty($cart)): ?>
        <p>ตะกร้าว่างเปล่า <a href="index.php">กลับไปเลือกซื้อสินค้า</a></p>
    <?php else: ?>
        <form method="post" action="update_cart.php">
            <table>
                <tr>
                    <th>สินค้า</th>
                    <th>ราคา (บาท)</th>
                    <th>จำนวน</th>
                    <th>ราคารวม (บาท)</th>
                    <th>ลบ</th>
                </tr>

                <?php foreach ($cart as $id => $qty): 
                    if (!isset($products[$id])) continue;
                    $product = $products[$id];
                    $subtotal = $product['price'] * $qty;
                    $total += $subtotal;
                ?>
                <tr>
                    <td>
                        <img src="images/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                        <br><?= htmlspecialchars($product['name']) ?>
                    </td>
                    <td><?= number_format($product['price']) ?></td>
                    <td>
                        <input type="number" name="quantities[<?= $id ?>]" value="<?= $qty ?>" min="1" style="width:50px;">
                    </td>
                    <td><?= number_format($subtotal) ?></td>
                    <td><a href="remove_from_cart.php?id=<?= $id ?>" onclick="return confirm('ต้องการลบสินค้านี้หรือไม่?')">ลบ</a></td>
                </tr>
                <?php endforeach; ?>

                <tr>
                    <th colspan="3" style="text-align:right;">รวมทั้งหมด</th>
                    <th><?= number_format($total) ?></th>
                    <th></th>
                </tr>
            </table>
            <br>
            <button type="submit">อัปเดตจำนวนสินค้า</button>
        </form>
        <br>
        <a href="checkout.php">ไปหน้าชำระเงิน</a> | <a href="index.php">เลือกซื้อสินค้าเพิ่ม</a>
    <?php endif; ?>
</body>
</html>
