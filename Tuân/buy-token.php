<?php require_once('./includes/connection.php') ?>
<?php include('./includes/role0') ?>
<?php 

$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
function generate_string($input, $strength = 10) {
    $input_length = strlen($input);
    $random_string = '';
    for($i = 0; $i < $strength; $i++) {
        $random_character = $input[mt_rand(0, $input_length - 1)];
        $random_string .= $random_character;
    }
    return $random_string;
}

$token = generate_string($permitted_chars);
$token_type = $_POST['type'];
$token_service = $_POST['service'];
$token_time = $_POST['time'];

$sql = "INSERT INTO token(name, type, service, time, time_created)
        VALUES ('$token', '$token_type', '$token_service', '$token_time', now())";
mysqli_query($conn, $sql);

$sql_show = "SELECT * FROM token ORDER BY id DESC LIMIT 1";
$query = mysqli_query($conn, $sql_show);
$data = mysqli_fetch_array($query);

?>

<input type="text" class="token-output bold-6" name="nametoken" value="<?php echo $data['name'] ?>">