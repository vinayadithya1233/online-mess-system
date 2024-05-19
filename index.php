<?php
include 'partials/header.php';
// require 'config/database.php';

// Fetch tiffin data
$tiffinQuery = "SELECT tiffin_id, tiffin_name, tiffin_description, tiffin_image FROM tiffins";
$result = mysqli_query($connection, $tiffinQuery);

?>

<section class="featured">
    <div class="container featured__container">
       
           

            <?php
            // Check if there are tiffins available
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    // Fetch items for each tiffin using tiffin_id
                    $tiffinId = $row['tiffin_id'];
                    $itemsQuery = "SELECT item_name, item_quantity FROM tiffin_items WHERE tiffin_id = $tiffinId";
                    $itemsResult = mysqli_query($connection, $itemsQuery);

                    // Fetch price for each tiffin using tiffin_id
                    $priceQuery = "SELECT price FROM tiffin_prices WHERE tiffin_id = $tiffinId";
                    $priceResult = mysqli_query($connection, $priceQuery);

                    // Display tiffin information
                    echo '<div class="post__thumbnail">';
                    echo '<img src="' . $row['tiffin_image'] . '" alt="' . $row['tiffin_name'] . '">';
                    echo '</div>';
                    echo '<div class="post__info">';
                    echo '<h3 class="post__title">' . $row['tiffin_name'] . '</h3>';
                    echo '<p>' . $row['tiffin_description'] . '</p>';

                    // Display items for each tiffin
                    if (mysqli_num_rows($itemsResult) > 0) {
                        echo '<table class="new123">';
                        echo '<thead>';
                        echo '<tr>';
                        echo '<th>SR.NO</th>';
                        echo '<th>Item</th>';
                        echo '<th>Quantity</th>';
                        echo '</tr>';
                        echo '</thead>';
                        echo '<tbody>';

                        $srNo = 1;
                        while ($itemRow = mysqli_fetch_assoc($itemsResult)) {
                            echo '<tr>';
                            echo '<td>' . $srNo . '</td>';
                            echo '<td>' . $itemRow['item_name'] . '</td>';
                            echo '<td style="padding-left: 17px;">' . $itemRow['item_quantity'] . '</td>';
                            echo '</tr>';
                            $srNo++;
                        }

                        echo '</tbody>';
                        echo '</table>';
                       
                    } else {
                        echo '<p>No items available for this tiffin.</p>';
                    }

                    // Display price for each tiffin
                    if ($priceRow = mysqli_fetch_assoc($priceResult)) {
                        echo '<p>Price: Rs:' . $priceRow['price'] . '</p>';

                        echo '<a href="order.php?tiffin_id=' . $row['tiffin_id'] . '" class="category__button">Place Order</a>';
                    } else {
                        echo '<p>No price available for this tiffin.</p>';
                    }

                    echo '</div>';
                }
            } else {
                // Display a message if no tiffins are available
                echo '<p>No tiffins available.</p>';
            }

            // Close the database connection
            mysqli_close($connection);
            ?>
        </div>
    </div>
</section>

<?php
include 'partials/footer.php';
?>
