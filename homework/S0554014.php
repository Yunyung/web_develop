<?php
//姓名： 許振揚(S0554014)
//作答情形：完成表單製作、保留資料、驗證表單
// 未完成:電話號碼檢查 

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<style>
        
		#mytable{
			width: 750px;
			color: #000000;
			border: 1px solid green;
			background: #ccffcc;
		}
		#mytable thead{
			color: #222222;
			text-align: center;
			border-bottom: 2px solid green;
			font-weight: bolder;
			background: -webkit-linear-gradient(green, white);
			background: -o-linear-gradient(green, white);
			background: -moz-linear-gradient(green, white);
			background: linear-gradient(green, white);
		}

		.btnDiv {
			margin: 30px auto;
			margin-left: 150px;
		}

		#show_data_table{
			width: 500px;
			color: #000000;
			border: 1px solid black;
			background: #aaffaa;
		}

	</style>
	<script>
	$(document).ready(function($) {
	 	 $("#Form1").submit(function() {
	      

	      if ($('#campus').val() == 0 || $('#campus :selected').text() == "") {
	            alert("請選擇報考班別!!");
	            return false;
	      }
	      
	     
		});
	});
	</script>
	<script>
	var arr_dept= new Array(3);
	    arr_dept[0] = new Array();
		arr_dept[1] = new Array('資訊工程學系','電子工程學系','電機工程學系'); 
		arr_dept[2] = new Array('數學系','英語系','電機工程學系'); 

		function change_sel() { 
		  var sel_id = window.document.Form1.campus.selectedIndex; //選擇的學院
		  var dept_cnt = arr_dept[sel_id].length ;//有幾個系所
		  window.document.Form1.dept.length = dept_cnt ;//設定選項數目

		  for(var i=0 ; i < dept_cnt ; i++ ){ 
		    window.document.Form1.dept.options[i].value = i; //對應的值
		    window.document.Form1.dept.options[i].text = arr_dept[sel_id][i]; //顯示的文字 
		  }
		}

	function copybtn(){
		window.document.Form1.address2.value = window.document.Form1.address1.value;
	}

	

	



	</script>
</head>
<body>
	<form id="Form1" name="Form1" action="" method="POST">
		<table id="mytable">
			<thead>
				<th colspan="4">國立彰化師範大學107學年度招生考試報名表</th>
			</thead>
			<tr>
				<td>報考班別:</td>
				<td>
					<select id="campus" name="campus" onchange='change_sel()' required>
						<option value="0"></option>
						<option value="1" <?php echo (!empty($_POST['campus']) && $_POST['campus'] == "1")?"selected":null; ?> >碩士班</option>
						<option value="2" <?php echo (!empty($_POST['campus']) && $_POST['campus'] == "2")?"selected":null; ?> >博士班</option>
                    </select>
                </td>
                <td>報考系所:</td>	
				<td>
					<select id="dept" name="dept" style="width: 130px" >
						<?php
							$campus = array(1 => "碩士班", "博士班");
							$dept1 = array("資訊工程學系", "電子工程學系", "電機工程學系");
        					$dept2 = array("數學系", "英語系", "電機工程學系");
						 		 if ($_POST['campus'] == 1)
				                	echo "<option>" . $dept1[$_POST['dept']] . "</option>";
				                 else
				                	echo "<option>" . $dept2[$_POST['dept']] . "</option>";
						?>
                    </select>
                </td>
			</tr>
			<tr>
				<td>填表日期:</td>
				<?php
				$stamps = mktime(); 
				// 將時間刻記轉換成日期時間
				$today = getdate($stamps); 
				$month = $today["mon"]; 
				$day = $today["mday"]; 
				$year = $today["year"]; 

				?>
				<td colspan="3">民國:
					<select name="year" id="year" size="1">
						<option value="<?php  echo $year - 1911; ?>"><?php  echo $year - 1911; ?></option>
						<option value="<?php  echo $year - 1912; ?>"><?php  echo $year - 1912; ?></option>
						<option value="<?php  echo $year - 1910; ?>"><?php  echo $year - 1910; ?></option>

					</select>年
					<select name="month" size="1">
						<option value="<?php  echo $month;?>"><?php  echo $month;?></option>
					</select>月
					<select name="day" size="1">
						<option value="<?php  echo $day;?>"><?php  echo $day;?></option>
					</select>日
				</td>
			</tr>
			<tr>
				<td colspan="4">------------------------------------------------------------------------------------------------------------------------------------------</td>
			</tr>
			<tr>
				<td>姓名:</td>
				<td><input type="text" name="user" required value="<?php echo !empty($_POST['user'])?$_POST['user']:null; ?>"></td>
			</tr>
			<tr>
				<td>身分證字號:</td>
				<td><input type="text" name="personNumber" required value="<?php echo !empty($_POST['personNumber'])?$_POST['personNumber']:null; ?>"></td>
			</tr>
			<tr>
				<td>性別:</td>
				<td><input type="radio" name="sex" value="1" checked>男生
                    <input type="radio" name="sex" value="2" <?php echo ( !empty($_POST[ 'sex']) && ($_POST['sex']==2 ) )? "checked":null;?> >女生
                </td>
			</tr>
			<tr>
				<td>通訊地址:</td>
				<td colspan="3">
					地址：<input type="text" name="address1" required value="<?php echo !empty($_POST['address1'])?$_POST['address1']:null; ?>">
				</td>
			</tr>
			<tr>
				<td>戶籍地址:</td>
				<td colspan="3">地址：<input type="text" name="address2" value="<?php echo !empty($_POST['address2'])?$_POST['address2']:null; ?>"><input type="button" value="同上" onclick='copybtn()'></td>
			</tr>
			<tr>
				<td>連絡電話:</td>
				<td><input type="number" name="contactNumber" required  value="<?php echo !empty($_POST['contactNumber'])?$_POST['contactNumber']:null; ?>"><span style="color:red">格式09xx-xxxxx</td>
			</tr>
			<tr>
				<td>Email信箱:</td>
				<td><input type="email" name="mail" required value="<?php echo !empty($_POST['mail'])?$_POST['mail']:null; ?>"></td>
			</tr>
			<tr>
				<td colspan="4">------------------------------------------------------------------------------------------------------------------------------------------</td>
			</tr>
			<tr>
				<td>應考學歷</td>
				<td>
					<input type="radio" name="degree" value="1" checked>學士學位
                    <input type="radio" name="degree" value="2" onclick="changeDegree()">同等學力
				</td>
			</tr>
			<tr>
				<td colspan="1"></td>
				<td colspan="4">學校名稱:<input type="text" name="school" required value="<?php echo !empty($_POST['school'])?$_POST['school']:null; ?>">,科系<input type="text" name="deparment" required value="<?php echo !empty($_POST['deparment'])?$_POST['deparment']:null; ?>"></td>

			</tr>
			<tr>
				<td colspan="4">------------------------------------------------------------------------------------------------------------------------------------------</td>
			</tr>
		</table>
		<div class="btnDiv">
			<button type="submit">送出</button>
			<button type="reset">清除</button>
		</div>


	</form>

	<?php
    /* table top */
    if (!empty($_POST['user'])){
        $sex = array(1 => "男生", "女生");
        $degree = array(1 => "學士學位", "同等學力");
      
       
 

        echo "<table id=\"show_data_table\" border='1'>";
        	echo "<tr>";
                echo "<td>報考班別</td>" . "<td>" . $campus[$_POST['campus']];
            echo "</tr>"; 

            echo "<tr>";
                if ($_POST['campus'] == 1)
                	echo "<td>報考系所</td>" . "<td>" . $dept1[$_POST['dept']] . "</td>";
                else
                	echo "<td>報考系所</td>" . "<td>" . $dept2[$_POST['dept']] . "</td>";
            echo "</tr>"; 

            echo "<tr>";
                echo "<td>填報日期</td>" . "<td>" . $_POST['year'] . "年" . $_POST['month'] . "月" . $_POST['day'] . "日" . "</td>";
            echo "</tr>"; 

        	echo "<tr>";
                echo "<td>填報日期</td>" . "<td>" . $_POST['year'] . "年" . $_POST['month'] . "月" . $_POST['day'] . "日" . "</td>";
            echo "</tr>"; 
            echo "<tr>";
                echo "<td>姓名</td>" . "<td>" . $_POST['user'] . "</td>";
            echo "</tr>"; 
             echo "<tr>";
                echo "<td>身分證字號</td>" . "<td>" . $_POST['personNumber'] . "</td>";
            echo "</tr>"; 
            echo "<tr>";
                echo "<td>性別</td>" . "<td>" . $sex[$_POST['sex']] ."</td>";
            echo "</tr>"; 
            echo "<tr>";
                echo "<td>通訊地址</td>" . "<td>" . $_POST['address1'] . "</td>";
            echo "</tr>"; 
            echo "<tr>";
                echo "<td>戶籍地址</td>" . "<td>" . $_POST['address2'] . "</td>";
            echo "</tr>"; 

            

            echo "<tr>";
                echo "<td>連絡電話</td>" . "<td>" . $_POST['contactNumber'] . "</td>";
            echo "</tr>"; 
            echo "<tr>";
                echo "<td>E-mail</td>" . "<td>" . $_POST['mail'] . "</td>";
            echo "</tr>"; 

            echo "<tr>";
                echo "<td>應考學歷</td>" . "<td>" . $degree[$_POST['degree']] . "</td>";
            echo "</tr>"; 

            echo "<tr>";
                echo "<td>學校名稱</td>" . "<td>" . $_POST['school'] . "</td>";
            echo "</tr>"; 
            echo "<tr>";
                echo "<td>科系</td>" . "<td>" . $_POST['deparment'] . "</td>";
            echo "</tr>"; 
            
        echo "</table>";
    }
    ?>
</body>
</html>