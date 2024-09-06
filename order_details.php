<?php
include 'includes/header.php';
include 'config/connect.php';

$order_id = $_GET['order_id'];

try {

    $stmt = $conn->prepare("SELECT * FROM orders WHERE id = :order_id");
    $stmt->bindParam(':order_id', $order_id, PDO::PARAM_STR);
    $stmt->execute();
    $order = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$order) {
        echo "<h1 class='grid' style='min-height: 47vh;padding: 20px 0;'>Đơn hàng không tồn tại. Vui lòng kiểm tra lại mã đơn hàng.</h1>";
        include 'includes/footer.php';
        exit;
    }


    $stmt_details = $conn->prepare("
    SELECT od.*, p.name AS product_name, p.image AS product_image 
    FROM order_details od 
    JOIN products p ON od.product_id = p.id 
    WHERE od.order_id = :order_id
");
    $stmt_details->bindParam(':order_id', $order_id, PDO::PARAM_STR);
    $stmt_details->execute();
    $order_details = $stmt_details->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Lỗi: " . $e->getMessage();
}
?>
<style>
    .container {
        font-size: 1.5rem;
    }

    .order-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .order-table th,
    .order-table td {
        padding: 12px 15px;
        text-align: left;
    }

    .order-table th {
        background-color: #f4f4f4;
        font-weight: bold;
    }

    .order-table tr:nth-child(even) {
        background-color: #fafafa;
    }

    .order-table tr:hover {
        background-color: #f1f1f1;
    }

    .product-cell {
        display: flex;
        align-items: center;
    }

    .product-image {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 5px;
        margin-right: 10px;
    }

    .product-name {
        font-weight: bold;
        color: #333;
    }

    .info {
        background-color: #fafafa;
        padding: 30px;
    }
</style>
<main style="min-height: 47vh;" class="container grid">
    <div class="order-details grid__row">
        <div class="grid__column-8">
            <h2>Chi Tiết Đơn Hàng #<?php echo htmlspecialchars($order['id']); ?></h2>
            <p>Ngày đặt hàng: <?php echo htmlspecialchars($order['order_date']); ?></p>

            <table class="order-table">
                <thead>
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($order_details as $detail): ?>
                        <tr>
                            <td class="product-cell">
                                <img src="<?php echo htmlspecialchars($detail['product_image']); ?>"
                                    alt="<?php echo htmlspecialchars($detail['product_name']); ?>" class="product-image">
                                <span class="product-name"><?php echo htmlspecialchars($detail['product_name']); ?></span>
                            </td>
                            <td><?php echo htmlspecialchars($detail['quantity']); ?></td>
                            <td><?php echo number_format($detail['price']); ?>đ</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <h2 style="text-align: right;">Tổng tiền: <?php echo number_format($order['total_amount']); ?>đ
                <span style="font-size: 1.2rem; font-weight: 200;">(*đã bao gồm phí vận chuyển)</span>
            </h2>


        </div>
        <div class="grid__column-4 info">
            <h2>Thông Tin Khách Hàng</h2>
            <p>Họ và tên: <?php echo htmlspecialchars($order['customer_name']); ?></p>
            <p>Số điện thoại: <?php echo htmlspecialchars($order['customer_phone']); ?></p>
            <p>Email: <?php echo htmlspecialchars($order['email']); ?></p>
            <p>Địa chỉ: <?php echo htmlspecialchars($order['customer_address']); ?></p>
        </div>


    </div>
</main>

<?php include 'includes/footer.php'; ?>