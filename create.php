<?php
require '_connect.php';
// require '_loader.php';
date_default_timezone_set("Asia/Bangkok");

$tb = $_POST['table'];
$script = ["INSERT INTO `{$tb}` VALUES ("];
if ($_POST['type'] == 'std') {
    add(2, 3);
} else {
    array_push($script, $_POST['id'] . ', ');
    global $tb;
    isset($_POST["{$tb}1"]) ? $_POST["{$tb}1"] = date('Y-m-d H:i:s', time()) : '';
    require '_check.php';
    $_FILES['file__image']['error'] === 4 ? $_POST["{$tb}2"] = 'default.svg' : $_POST["{$tb}2"] = checkImg();
    add(3, 4);
}

function add($acc, $par)
{
    global $tb;
    global $script;
    for ($i = 0; $i < count($_POST) - $acc; $i++) {
        if ($i < count($_POST) - $par) {
            $elm[$i] = "'" . $_POST[$tb . $i + 1] . "', ";
            array_push($script, $elm[$i]);
        } else {
            $elm[$i] = "'" . $_POST[$tb . $i + 1] . "' )";
            array_push($script, $elm[$i]);
        }
    }
}

if (mysqli_query($connect_db, implode($script))) {
    echo "<script>if(confirm('Update Succes, Click cancel if u wana update more')){
            location.href = '../index.php';
        }else{
            location.href = '../atjwgf.php'
        }
              </script>
        ";
} else {
    echo "<script>alert('Update Failed'); location.href = ../atjwgf.php</script>";
}
