<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8" />
    <title>ร้านขายมุ้งออนไลน์</title>
    <link rel="stylesheet" href="css/style.css" />
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
</head>


<body>
    <header>
        <h1>🛏 ร้านขายมุ้งนอน</h1>
        <nav>
            <a href="index.php">หน้าแรก</a>
            <a href="cart.php">ตะกร้าสินค้า</a>
            <a href="checkout.php">ชำระเงิน</a>
        </nav>
    </header>

<?php if (isset($_GET['added'])): ?>
    <p class="alert-success">✅ เพิ่มสินค้าลงตะกร้าเรียบร้อยแล้ว!</p>
<?php endif; ?>


    <main>

<?php

$saleStart = '2025-06-14T10:00:00';
$saleEnd = '2025-06-15T23:59:59';

$flash_products = [
    ['name' => 'มุ้งพับได้ Flash', 'price' => 399, 'image' => 'images/flash_mosquito1.jpg', 'stock' => 4 ] ,
    ['name' => 'มุ้งเด็กลายการ์ตูน', 'price' => 299, 'image' => 'images/flash_mosquito2.jpg', 'stock' => 2],
];
?>

<section class="flash-sale">
    <h2>⚡ FLASH SALE ⚡</h2>
    <div class="flash-grid">
        <?php foreach ($flash_products as $index => $product): ?>
            <div class="flash-card">
                <div class="ribbon">FLASH SALE</div>
                <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                <h3><?= htmlspecialchars($product['name']) ?></h3>
                <p class="price">฿<?= number_format($product['price']) ?></p>
                <p class="stock">เหลือ: <?= $product['stock'] ?> ชิ้น</p>

                <!-- ตรงนี้แสดง Countdown -->
                <p class="countdown" id="countdown-<?= $index ?>">กำลังโหลดเวลา...</p>

                <a href="product.php?name=<?= urlencode($product['name']) ?>" class="btn urgent">ซื้อด่วน!</a>
            </div>
        <?php endforeach; ?>
    </div>
</section>




        <h2>สินค้าแนะนำ</h2>
<div class="product-grid">
    <!-- มุ้งธรรมดา -->
    <div class="product-card">
        <img src="images/mosquito_net1.jpg" alt="มุ้งธรรมดา">
        <h3>มุ้งธรรมดา</h3>
        <p>ราคา 250 บาท</p>

        <div class="product-actions">
            <a href="product.php?id=1" class="btn">ดูรายละเอียด</a>
            <form method="post" action="add_to_cart.php" class="cart-form">
                <input type="hidden" name="product_id" value="1">
                <button type="submit" class="btn add-cart-btn">🛒 เพิ่มลงตะกร้า</button>
            </form>
        </div>
    </div>

    <!-- มุ้งพับได้ -->
    <div class="product-card">
        <img src="images/mosquito_net2.jpg" alt="มุ้งพับได้">
        <h3>มุ้งพับได้</h3>
        <p>ราคา 450 บาท</p>

        <div class="product-actions">
            <a href="product.php?id=2" class="btn">ดูรายละเอียด</a>
            <form method="post" action="add_to_cart.php" class="cart-form">
                <input type="hidden" name="product_id" value="2">
                <button type="submit" class="btn add-cart-btn">🛒 เพิ่มลงตะกร้า</button>
            </form>
        </div>
    </div>

    <!-- มุ้งเด็ก -->
    <div class="product-card">
        <img src="images/mosquito_net3.jpg" alt="มุ้งเด็ก">
        <h3>มุ้งเด็ก</h3>
        <p>ราคา 180 บาท</p>

        <div class="product-actions">
            <a href="product.php?id=3" class="btn">ดูรายละเอียด</a>
            <form method="post" action="add_to_cart.php" class="cart-form">
                <input type="hidden" name="product_id" value="3">
                <button type="submit" class="btn add-cart-btn">🛒 เพิ่มลงตะกร้า</button>
            </form>
        </div>
    </div>
</div>

</div>

    </main>

    <footer>
        <p>© 2025 ร้านขายมุ้งออนไลน์ </p>
    </footer>

    <script src="js/script.js"></script>
</body>
</html>
