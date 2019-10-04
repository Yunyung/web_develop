<?php
	$link = mysqli_connect("localhost", "root", "root123456", "school");
	if ($link){
		// encode
		mysqli_query($link, 'SET CHARACTER SET utf8');
		mysqli_query($link,"SET collation_connection = 'utf8_unicode_ci'");
	} 	
	else{
		echo "連結錯誤代碼: ".mysqli_connect_errno()."<br>";//顯示錯誤代碼
		echo "連結錯誤訊息: ".mysqli_connect_error()."<br>";//顯示錯誤訊息
		exit();
	}
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>資料庫分頁練習 </title>
        <style>
        #mytable {
			width     : 500px;
			margin    : 0 auto;
			text-align: center;
        }
        </style>
    </head>
	
    <body>
        <table border="1" id="mytable">
            <thead>
                <tr>
                    <th>學號</th>
                    <th>姓名</th>
                    <th>地址</th>
                </tr>
            </thead>
            <tbody>
                <?php
				$sql = "SELECT * FROM `students`"; 
				$result = mysqli_query($link, $sql); // 取出全部row
				$current_page = (isset($_GET['page']))? $_GET['page'] : 1; // 得到當前頁數

				$records_per_page = 10; // 每頁10筆
				$total_records = mysqli_num_rows($result); // 總資料量(row)
				$total_pages = ceil($total_records / $records_per_page); // 計算有幾頁
				$offset = ($current_page - 1) * $records_per_page; // 算出當前需要的資料位移量

				$sql = "SELECT `stud_no`, `stud_name`, `stud_addr` FROM `students` LIMIT {$offset}, {$records_per_page}"; 
				$result = mysqli_query($link, $sql); // 取出目標的資料
				while ($row = mysqli_fetch_assoc($result)){
					echo "<tr>";
					echo "<td>".$row['stud_no']."</td>" . "<td>".$row['stud_name']."</td>" . "<td>".$row['stud_addr']."</td>";
					echo "</tr>"; 
				}

				// 分頁顯示
				echo "<tr><td colspan='3'>";
				for ($i = 1;$i <= $total_pages;$i++){
					echo "<a href='?page={$i}'>" . $i . "</a>" . " ";
				}
				echo "</td></tr>";
			?>
            </tbody>
        </table>
    </body>

    </html>