<div id="main">
    <h1 class="top">Menu</h1>
    <p><a href="product_manager">Event Manager</a></p>
    <p><a href="product_catalog">Event Catalog</a></p>
</div>

<?php
require('model/database.php');
require('model/product_db.php');
require('model/category_db.php');
require ('model/show_db.php');
require ('model/reservation_db.php');

if (isset($_POST['action'])) {
    $action = $_POST['action'];
} else if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'list_products';
}

if ($action == 'list_products') {

    $category_id = "";
    if ( isset($_GET['category_id']) ) {
        $category_id = $_GET['category_id'];
    } else {
        $category_id = 1;
    }


    $categories = get_categories();
    $category_name = get_category_name($category_id);
    $products = get_products_by_category($category_id);



    include("login/index.php");


    include('product_list.php');
} else if ($action == 'view_product') {

    $categories = get_categories();

    $product_id = $_GET['product_id'];
    $product = get_product($product_id);

    // Get product data
    $description = $product['event_description'];
    $name = $product['event_title'];
    $list_price = $product['event_price'];

//  Get shows data
    $shows = get_shows($product_id);
    $show = get_shows_by_event($product_id);

     $show_date = $show['event_show_date'];
     $seats = $show['event_show_seats'];


    // // Set the discount percent (for all web orders)
    // $discount_percent = 30;

    // // Calculate discounts
    // $discount_amount = round($list_price * ($discount_percent / 100.0), 2);
    // $unit_price = $list_price - $discount_amount;

    // // Format the calculations
    // $discount_amount = number_format($discount_amount, 2);
    // $unit_price = number_format($unit_price, 2);

    // Get image URL and alternate text
    $image_filename = './images/' . $product_id . '.jpg';
    $image_alt = 'Image: ' . $name . '.jpg';
    include("login/index.php");
    include('product_view.php');
} elseif ($action == 'member') {

 $category_id = "";
    if ( isset($_GET['category_id']) ) {
        $category_id = $_GET['category_id'];
    } else {
        $category_id = 1;
    }

    $categories = get_categories();
    $category_name = get_category_name($category_id);
    $products = get_products_by_category($category_id);

session_start();

$user_name = $_SESSION['user_name'];
$user_email = $_SESSION['user_email'] ;
$user_first_name = $_SESSION['user_first_name'];
$user_last_name = $_SESSION['user_last_name'];
$user_home_address = $_SESSION['user_home_address'];
$user_mobile_telephone = $_SESSION['user_mobile_telephone'];
$user_telephone = $_SESSION['user_telephone'];
$user_birth = $_SESSION['user_birth'];

$reservation_name = get_reservation_name($user_name);

// $reservation_ids = array();
//          foreach($reservation_name as $reservation) :
//               $reservation_ids[] = $reservation['event_title'];
//              endforeach;

// print_r($reservation_ids);

// $reservations = get_reservations_by_id();
// $reserved_reservation_id = $reservation_name['reservation_event_id'];

 include '/view/member.php';
}
?>
<?php include '/view/footer.php'; ?>
