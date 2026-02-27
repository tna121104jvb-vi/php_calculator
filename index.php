<?php
session_start();

$list_phep_tinh = ['+', "-", "X", "/", "="];

// Khởi tạo các giá trị từ Session
$kq = isset($_SESSION["kq"]) ? (float)$_SESSION["kq"] : 0;
$value = isset($_SESSION['value']) ? (string)$_SESSION['value'] : "";
$phep_tinh_cho = isset($_SESSION['phep_tinh']) ? $_SESSION['phep_tinh'] : "";

if (isset($_GET['dataIp'])) {
    $data = $_GET['dataIp'];

    if (in_array($data, $list_phep_tinh)) {
        if ($data == "=") {
            // Thực hiện phép tính cuối cùng với số đang nhập
            $so_thu_hai = (float)$value;
            switch ($phep_tinh_cho) {
                case "+": $kq += $so_thu_hai; break;
                case "-": $kq -= $so_thu_hai; break;
                case "X": $kq *= $so_thu_hai; break;
                case "/": $kq = ($so_thu_hai != 0) ? ($kq / $so_thu_hai) : "Error"; break;
                default: $kq = $so_thu_hai; // Nếu chưa có phép tính, kq chính là số vừa nhập
            }
            $value = (string)$kq; // Hiển thị kết quả lên màn hình
            $phep_tinh_cho = "";   // Xóa phép tính chờ
            $_SESSION['kq'] = 0;   // Reset bộ nhớ tạm
        } else {
            // Khi nhấn +, -, X, /: Lưu số hiện tại vào $kq và đợi số tiếp theo
            $_SESSION['kq'] = (float)$value;
            $_SESSION['phep_tinh'] = $data;
            $value = ""; // Xóa màn hình để nhập số thứ hai
        }
    } else {
        // Nhập số hoặc dấu chấm
        $value .= $data;
    }

    // Lưu lại vào Session
    $_SESSION['value'] = $value;
}

// Nút xóa (Clear) - Tiện ích thêm vào
if (isset($_GET['clear'])) {
    session_destroy();
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            width: 100%;
            height: 100vh;

        }
        .app {
            width: 450px;
            padding: 8px;
            margin: 0 auto;
            
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
        }
        .app form {
            display: flex;
            flex-wrap: wrap;
            gap:15px;
            justify-content: center;
        }
        .mainIp {
            width: 100%;
            outline: 0;
            color:#ccc;
            height: 65px;
            font-size: xx-large;
            color: #000;
            font-weight: 600;
            
        }
        .btn {
            border: 0;
            min-width: 75px;
            min-height: 75px; 
            display:block;
            border-radius: 999px;
            background-color: #f0f0f0; 
            color: #000;
            font-weight: bold;
            cursor: pointer;
            font-size: xx-large;

}

.btn:hover {
    background-color: #e0e0e0; 
   
}

    </style>
</head>
<body>
    <div class="app">
        <form action="" method="get">
            <input type="text" name="" id="" class="mainIp" value="<?php echo $value?>">
            <input type="number" name="" id="" class="mainIp" value="<?php echo $kq?>">
            <button name="dataIp"class="btn num_btn"  value="1" type="submit">1</button>
            <button name="dataIp"class="btn num_btn" value="2" type="submit">2</button>
            <button name="dataIp"class="btn num_btn" value="3" type="submit">3</button>
            <button name="dataIp"class="btn num_phep" value="+" type="submit">+</button>

            <button name="dataIp"class="btn num_btn" value="4" type="submit">4</button>
            <button name="dataIp"class="btn num_btn" value="5" type="submit">5</button>
            <button name="dataIp"class="btn num_btn" value="6" type="submit">6</button>
            <button name="dataIp"class="btn num_phep" value="-" type="submit">-</button>

            <button name="dataIp"class="btn num_btn" value="7" type="submit">7</button>
            <button name="dataIp"class="btn num_btn" value="8" type="submit">8</button>
            <button name="dataIp"class="btn num_btn" value="9" type="submit">9</button>
            <button name="dataIp"class="btn num_phep" value="X" type="submit">X</button>
            <button name="dataIp"class="btn num_btn" value="/" type="submit">/</button>
            <button name="dataIp"class="btn num_btn" value="0" type="submit">0</button>
            <button name="dataIp"class="btn num_btn" value="." type="submit">.</button>
            <button name="dataIp"class="btn num_btn" value="=" type="submit">=</button>

        </form>
    </div>
</body>
</html>