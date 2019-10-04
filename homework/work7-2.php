<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>表單傳送</title>
    <style>
    #show_data tr td:last-child{
		color:blue;
    }

    #show_data tr {
		height: 30px;
    }
    .inner-table {
        border: 2px solid #E6CFE6;
    }

    .inner-table td {
        border: 1px solid #E6CFE6;
    }

    .inner-table tr:first-child {
        background: #E6CFE6;
    }
    </style>
    <script>
    function check() {
        if (document.getElementById("user").value == "") {
            alert("姓名尚未填寫無法送出!");
            return false;
        }
        if (!(document.MyForm1.register_sport[0].checked || document.MyForm1.register_sport[1].checked)){
        	alert("報名項目尚未選擇無法送出!");
        	return false;
        }
    }
    </script>
</head>

<body>
    <form name="MyForm1" action="" method="POST" enctype="multipart/form-data">
        <table>
            <tr>
                <td>◆ 姓名</td>
                <td>
                    <input type="text" name="user" id="user" value="<?php echo !empty($_POST['user'])?$_POST['user']:null; ?>">
                </td>
            </tr>
            <tr>
                <td>◆ 報名項目</td>
                <td>
                    <table class="inner-table" width="500" rules="all" cellpadding='5' ;>
                        <tbody>
                            <tr>
                                <th colspan="2">項目名稱</th>
                                <th>報名費</th>
                            </tr>
                            <tr>
                                <td width="30px">
                                    <input type="radio" name="register_sport" value="1" 
                                    <?php if(!empty($_POST['register_sport'])){echo ($_POST['register_sport'] == 1)?"checked":null;} ?> >
                                </td>
                                <td>10K挑戰組</td>
                                <td align="right">$800元</td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="radio" name="register_sport" value="2" 
                                    <?php if(!empty($_POST["register_sport"])){echo ($_POST["register_sport"] == 2)? "checked":null;} ?> >
                                </td>
                                <td>21K半馬組</td>
                                <td align="right">$950元</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td>◆ 選購品</td>
                <td>
                    <table class="inner-table" width="500" rules="all" cellpadding='5' ;>
                        <tbody>
                            <tr>
                                <th colspan="2">品名</th>
                                <th>單價</th>
                                <th>數量</th>
                            </tr>
                            <tr>
                                <td width="30px">
                                	<?php
                                	if (!empty($_POST['buy_item'])){
    									$buy_item = $_POST["buy_item"];
    								}
                                	?>
                                    <input type="checkbox" name="buy_item[]" value="1" 
                                    <?php if (!empty($_POST['buy_item'])){echo (in_array(1, $_POST['buy_item']))?"checked":null;} ?> >
                                </td>
                                <td width="230px">運動襪</td>
                                <td align="right">$150元</td>
                                <td align="center">
                                    <select name="sock_amount" id="sock_amount">
                                        <option value="">請選擇數量</option>
                                        <?php
                                			for ($i = 1;$i <= 50;$i++){
	                                			echo "<option " . "value=$i ";
	                                			if (!empty($_POST['sock_amount'])){echo ($i == $_POST['sock_amount'])?"selected":null;};
	                                			echo ">" . $i;
	                                			echo "</option>";
	                                		}
                                		?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="checkbox" name="buy_item[]" value="2"
                                    <?php if (!empty($_POST['buy_item'])){foreach($buy_item as $i){echo ($i == 2)?"checked":null;}}?> >
                                </td>
                                <td width="230px">運動帽</td>
                                <td align="right">$100元</td>
                                <td align="center">
                                    <select name="hat_amount" id="hat_amount">
                                        <option value="">請選擇數量</option>
                                        <?php
                                			for ($i = 1;$i <= 50;$i++){
	                                			echo "<option " . "value=$i ";
	                                			if (!empty($_POST['hat_amount'])){echo ($i == $_POST['hat_amount'])?"selected":null;};
	                                			echo ">" . $i;
	                                			echo "</option>";
	                                		}
                                		?>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td>◆ 報到方式</td>
                <td>
                    <table class="inner-table" width="500" rules="all" cellpadding='5' ;>
                        <tbody>
                            <tr>
                                <th colspan="2">說明</th>
                                <th>費用</th>
                            </tr>
                            <tr>
                                <td width="30px">
                                    <input type="radio" name="register_metohd" value="1" checked>
                                </td>
                                <td>事前報到</td>
                                <td align="right">-</td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="radio" name="register_metohd" value="2"                                 
                                    <?php echo (!empty($_POST["register_metohd"]) && $_POST["register_metohd"] == 2)?"checked":null;?> >
                                </td>
                                <td>郵寄報到</td>
                                <td align="right">$100元</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <button type="submit" onclick="check()">送出資料</button>
                </td>
            </tr>
        </table>
    </form>

    <?php

    	if (!empty($_POST['user']) && !empty($_POST['register_sport'])){
    		$array_register_sport = array(1 => "10K挑戰組", "21K半馬組");
    		$array_buy_item = array(1 => "運動襪", "運動帽");
    		$array_register_metohd = array(1 => "事前報到", "郵寄報到");

    		// 計算費用
    		$register_sport_charge = 0;
    		$register_metohd_charge = 0;
    		$sock_charge = 0;
    		$hat_charge = 0;
    		$total = 0;

    		($_POST['register_sport'] == 1)?$register_sport_charge+=800:$register_sport_charge+=950;
    		($_POST['register_metohd'] == 1)?$register_metohd_charge+=0:$register_metohd_charge+=100;
    		$total+= $register_sport_charge;
    		$total+= $register_metohd_charge;


    		echo "<table id='show_data' style='margin-left:40px'>";
    		echo "<tr>" . "<td>性&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;別：</td>" . "<td>" . $_POST['user'] . "</td>" ."</tr>";
    		echo "<tr>" . "<td>報名項目：</td>" . "<td>" . $array_register_sport[$_POST['register_sport']] . "</td>" ."</tr>";
    		echo "<tr>" . "<td>選購項目：</td>" . "<td>";
    		if (!empty($_POST['buy_item'])){
    			foreach ($buy_item as $i){
	    			if ($i == 1){
	    				if (!empty($_POST["sock_amount"])){
			    			$sock_amount = $_POST["sock_amount"];
			    			$sock_charge += 150 * $sock_amount;
			    			$total += $sock_charge;
			    			echo "運動襪" . " * " . $sock_amount . " ";
			    		}
	    			}
	    			if ($i == 2){
	    				if (!empty($_POST["hat_amount"])){
		    				$hat_amount = $_POST["hat_amount"];
		    				$hat_charge += 100 * $hat_amount;
		    				$total += $hat_charge;
		    				echo "運動帽" . " * " . $hat_amount;
		    			}
	    			}
    			}
    		}
    		echo "</td>" ."</tr>";
    		echo "<tr>" . "<td>報到方式：</td>" . "<td>" . $array_register_metohd[$_POST['register_metohd']] . "</td>" ."</tr>";
    		echo "<tr>" . "<td>費&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;用：</td>" . "<td>";
    			echo $register_sport_charge . " + ";
    			echo ($sock_charge != 0)?$sock_charge . " + ":"";
    			echo ($hat_charge != 0)?$hat_charge . " + ":"";
    			echo $register_metohd_charge;
    			echo " = <span style='color:red;'>" . $total . "</span>";
    		echo "</td>" ."</tr>";
    		echo "</table>";
    	}
    ?>
</body>

</html>