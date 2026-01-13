<?php
include ("config.php");

//cek apakah tombol daftar sudah diklik atau belum?
if(isset($_POST['cust-name'])){

    //ambil data dari formulir
    $nama = $_POST['cust-name'];
    $tanggal = $_POST['order-time'];
    $no_meja = $_POST['table-num'];
    $total_amount = $_POST['total_amount'];
    $cart_data = json_decode($_POST['cart_data'], true);

    //buat tabel jika belum ada
    $sql_create_order = "CREATE TABLE IF NOT EXISTS `ORDER` (id INT AUTO_INCREMENT PRIMARY KEY, nama VARCHAR(255), tanggal DATETIME, no_meja INT, total DECIMAL(10,2))";
    mysqli_query($db, $sql_create_order);

    $sql_create_items = "CREATE TABLE IF NOT EXISTS `order_items` (id INT AUTO_INCREMENT PRIMARY KEY, order_id INT, item_name VARCHAR(255), item_price DECIMAL(10,2), FOREIGN KEY (order_id) REFERENCES `ORDER`(id))";
    mysqli_query($db, $sql_create_items);

    //buat query untuk order
    $sql="INSERT INTO `ORDER` (nama, tanggal, no_meja, total)
    VALUE ('$nama', '$tanggal', '$no_meja', '$total_amount')";
    $query=mysqli_query($db, $sql);

    if($query){
        $order_id = mysqli_insert_id($db);

        // Insert order items
        foreach($cart_data as $item){
            $item_name = $item['name'];
            $item_price = $item['price'];
            $sql_item = "INSERT INTO order_items (order_id, item_name, item_price) VALUES ('$order_id', '$item_name', '$item_price')";
            mysqli_query($db, $sql_item);
        }

        //kalau berhasil alihkan ke halaman index.php dengan status sukses
        header('Location: index.php?status=sukses');
    }else {
        //kalau gagal alihkan ke halaman index.php dengan status gagal
        header('Location: index.php?status=gagal');
    }
}else{
    die("Akses dilarang...");
}
?>
