<?php
include 'partials/header.php';
// require 'config/database.php'; 

// Retrieve the user ID from the session
$userId = $_SESSION['user-id'];

// Fetch orders for the specific user from the database
$fetch_orders_query = "SELECT * FROM orders WHERE user_id = ?";
$stmt = mysqli_prepare($connection, $fetch_orders_query);
mysqli_stmt_bind_param($stmt, "i", $userId);
mysqli_stmt_execute($stmt);
$fetch_orders_result = mysqli_stmt_get_result($stmt);
?>

<section class="dashboard">
    <!-- ... (your existing code) ... -->
    <div class="container_var dashboard__container">
        <button id="show__sidebar-btn" class="sidebar__toggle"><i class="uil uil-angle-right-b"></i></button>
        <button id="hide__sidebar-btn" class="sidebar__toggle"><i class="uil uil-angle-left"></i></button>
        <aside>
            <ul>
                
                <li><a href="user_index.php"   class="active"><i class="uil uil-create-dashboard"></i>
                <h5>View orders</h5></a></li>
                <li><a href="index.php"   class="active"><i class="uil uil-plus-circle"></i>
                <h5>Place Order</h5></a></li>
                
            </ul>
        </aside>
    <main>
        <h2>Orders</h2>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Mobile Number</th>
                    <th>Preferred Time</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Address</th>
                  
                    <th>Pay</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($order = mysqli_fetch_assoc($fetch_orders_result)): ?>
                    <tr>
                        <td><?= $order['name']; ?></td>
                        <td><?= $order['mobileno']; ?></td>
                        <td><?= $order['preferred_time']; ?></td>
                        <td><?= $order['start_date']; ?></td>
                        <td><?= $order['end_date']; ?></td>
                        <td><?= $order['address']; ?></td>
                    
                        <td><a href="admin/Pay-order.php?= $order['id']; ?>" class="btn sn">Pay</a></td>
                        <td><a href="delete-order.php?id=<?= $order['id']; ?>" class="btn sn danger">Delete</a></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </main>
    <!-- ... (your existing code) ... -->
</section>

<?php
include 'partials/footer.php';
?>
