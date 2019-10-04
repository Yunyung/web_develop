<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title> 表單傳送 </title>
    <style>
    #show_data_table tr td:last-child {
        color: blue;
    }
    </style>
    <script>

    function check() {
        if (document.getElementById("user").value == ""){
          alert("尚未輸入姓名！");
        }
    }
    </script>
</head>

<body>
    <form name="MyForm1" action="" method="POST" enctype="multipart/form-data">
        <table border="1">
            <tr>
                <td>姓名：</td>
                <td>
                    <input type="text" name="user" id="user" size="20" maxlength="10" value="<?php echo !empty($_POST['user'])?$_POST['user']:null; ?>">
                </td>
            </tr>
            <tr>
                <td>生日：</td>
                <td>
                    <select name="year" id="year" size="1">
                        <option value="60" <?php echo (!empty($_POST['year']) && $_POST['year'] == "60")?"selected":null; ?> >60</option>
                        <option value="61" <?php echo (!empty($_POST['year']) && $_POST['year'] == "61")?"selected":null; ?> >61</option>
                        <option value="62" <?php echo (!empty($_POST['year']) && $_POST['year'] == "62")?"selected":null; ?> >62</option>
                        <option value="63" <?php echo (!empty($_POST['year']) && $_POST['year'] == "63")?"selected":null; ?> >63</option>
                        <option value="64" <?php echo (!empty($_POST['year']) && $_POST['year'] == "64")?"selected":null; ?> >64</option>
                        <option value="65" <?php echo (!empty($_POST['year']) && $_POST['year'] == "65")?"selected":null; ?> >65</option>
                        <option value="66" <?php echo (!empty($_POST['year']) && $_POST['year'] == "66")?"selected":null; ?> >66</option>
                        <option value="67" <?php echo (!empty($_POST['year']) && $_POST['year'] == "67")?"selected":null; ?> >67</option>
                        <option value="68" <?php echo (!empty($_POST['year']) && $_POST['year'] == "68")?"selected":null; ?> >68</option>
                        <option value="69" <?php echo (!empty($_POST['year']) && $_POST['year'] == "69")?"selected":null; ?> >69</option>
                        <option value="70" <?php echo (!empty($_POST['year']) && $_POST['year'] == "70")?"selected":null; ?> >70</option>
                        <option value="71" <?php echo (!empty($_POST['year']) && $_POST['year'] == "71")?"selected":null; ?> >71</option>
                        <option value="72" <?php echo (!empty($_POST['year']) && $_POST['year'] == "72")?"selected":null; ?> >72</option>
                        <option value="73" <?php echo (!empty($_POST['year']) && $_POST['year'] == "73")?"selected":null; ?> >73</option>
                        <option value="74" <?php echo (!empty($_POST['year']) && $_POST['year'] == "74")?"selected":null; ?> >74</option>
                        <option value="75" <?php echo (!empty($_POST['year']) && $_POST['year'] == "75")?"selected":null; ?> >75</option>
                        <option value="76" <?php echo (!empty($_POST['year']) && $_POST['year'] == "76")?"selected":null; ?> >76</option>
                        <option value="77" <?php echo (!empty($_POST['year']) && $_POST['year'] == "77")?"selected":null; ?> >77</option>
                        <option value="78" <?php echo (!empty($_POST['year']) && $_POST['year'] == "78")?"selected":null; ?> >78</option>
                        <option value="79" <?php echo (!empty($_POST['year']) && $_POST['year'] == "79")?"selected":null; ?> >79</option>
                        <option value="80" <?php echo (!empty($_POST['year']) && $_POST['year'] == "80")?"selected":null; ?> >80</option>
                    </select>年
                    <select name="month" size="1">
                        <option value="1" <?php echo (!empty($_POST['month']) && $_POST['month'] == "1")?"selected":null; ?> >1</option>
                        <option value="2" <?php echo (!empty($_POST['month']) && $_POST['month'] == "2")?"selected":null; ?> >2</option>
                        <option value="3" <?php echo (!empty($_POST['month']) && $_POST['month'] == "3")?"selected":null; ?> >3</option>
                        <option value="4" <?php echo (!empty($_POST['month']) && $_POST['month'] == "4")?"selected":null; ?> >4</option>
                        <option value="5" <?php echo (!empty($_POST['month']) && $_POST['month'] == "5")?"selected":null; ?> >5</option>
                        <option value="6" <?php echo (!empty($_POST['month']) && $_POST['month'] == "6")?"selected":null; ?> >6</option>
                        <option value="7" <?php echo (!empty($_POST['month']) && $_POST['month'] == "7")?"selected":null; ?> >7</option>
                        <option value="8" <?php echo (!empty($_POST['month']) && $_POST['month'] == "8")?"selected":null; ?> >8</option>
                        <option value="9" <?php echo (!empty($_POST['month']) && $_POST['month'] == "9")?"selected":null; ?> >9</option>
                        <option value="10" <?php echo (!empty($_POST['month']) && $_POST['month'] == "10")?"selected":null; ?> >10</option>
                        <option value="11" <?php echo (!empty($_POST['month']) && $_POST['month'] == "11")?"selected":null; ?> >11</option>
                        <option value="12" <?php echo (!empty($_POST['month']) && $_POST['month'] == "12")?"selected":null; ?> >12</option>
                    </select>月
                    <select name="day" size="1">
                        <option value="1" <?php echo (!empty($_POST['day']) && $_POST['day'] == "1")?"selected":null; ?> >1</option>
                        <option value="2" <?php echo (!empty($_POST['day']) && $_POST['day'] == "2")?"selected":null; ?> >2</option>
                        <option value="3" <?php echo (!empty($_POST['day']) && $_POST['day'] == "3")?"selected":null; ?> >3</option>
                        <option value="4" <?php echo (!empty($_POST['day']) && $_POST['day'] == "4")?"selected":null; ?> >4</option>
                        <option value="5" <?php echo (!empty($_POST['day']) && $_POST['day'] == "5")?"selected":null; ?> >5</option>
                        <option value="6" <?php echo (!empty($_POST['day']) && $_POST['day'] == "6")?"selected":null; ?> >6</option>
                        <option value="7" <?php echo (!empty($_POST['day']) && $_POST['day'] == "7")?"selected":null; ?> >7</option>
                        <option value="8" <?php echo (!empty($_POST['day']) && $_POST['day'] == "8")?"selected":null; ?> >8</option>
                        <option value="9" <?php echo (!empty($_POST['day']) && $_POST['day'] == "9")?"selected":null; ?> >9</option>
                        <option value="10" <?php echo (!empty($_POST['day']) && $_POST['day'] == "10")?"selected":null; ?> >10</option>
                        <option value="11" <?php echo (!empty($_POST['day']) && $_POST['day'] == "11")?"selected":null; ?> >11</option>
                        <option value="12" <?php echo (!empty($_POST['day']) && $_POST['day'] == "12")?"selected":null; ?> >12</option>
                        <option value="13" <?php echo (!empty($_POST['day']) && $_POST['day'] == "13")?"selected":null; ?> >13</option>
                        <option value="14" <?php echo (!empty($_POST['day']) && $_POST['day'] == "14")?"selected":null; ?> >14</option>
                        <option value="15" <?php echo (!empty($_POST['day']) && $_POST['day'] == "15")?"selected":null; ?> >15</option>
                        <option value="16" <?php echo (!empty($_POST['day']) && $_POST['day'] == "16")?"selected":null; ?> >16</option>
                        <option value="17" <?php echo (!empty($_POST['day']) && $_POST['day'] == "17")?"selected":null; ?> >17</option>
                        <option value="18" <?php echo (!empty($_POST['day']) && $_POST['day'] == "18")?"selected":null; ?> >18</option>
                        <option value="19" <?php echo (!empty($_POST['day']) && $_POST['day'] == "19")?"selected":null; ?> >19</option>
                        <option value="20" <?php echo (!empty($_POST['day']) && $_POST['day'] == "20")?"selected":null; ?> >20</option>
                        <option value="21" <?php echo (!empty($_POST['day']) && $_POST['day'] == "21")?"selected":null; ?> >21</option>
                        <option value="22" <?php echo (!empty($_POST['day']) && $_POST['day'] == "22")?"selected":null; ?> >22</option>
                        <option value="23" <?php echo (!empty($_POST['day']) && $_POST['day'] == "23")?"selected":null; ?> >23</option>
                        <option value="24" <?php echo (!empty($_POST['day']) && $_POST['day'] == "24")?"selected":null; ?> >24</option>
                        <option value="25" <?php echo (!empty($_POST['day']) && $_POST['day'] == "25")?"selected":null; ?> >25</option>
                        <option value="26" <?php echo (!empty($_POST['day']) && $_POST['day'] == "26")?"selected":null; ?> >26</option>
                        <option value="27" <?php echo (!empty($_POST['day']) && $_POST['day'] == "27")?"selected":null; ?> >27</option>
                        <option value="28" <?php echo (!empty($_POST['day']) && $_POST['day'] == "28")?"selected":null; ?> >28</option>
                        <option value="29" <?php echo (!empty($_POST['day']) && $_POST['day'] == "29")?"selected":null; ?> >29</option>
                        <option value="30" <?php echo (!empty($_POST['day']) && $_POST['day'] == "30")?"selected":null; ?> >30</option>
                        <option value="31" <?php echo (!empty($_POST['day']) && $_POST['day'] == "31")?"selected":null; ?> >31</option>
                    </select>日
                </td>
            </tr>
            <tr>
                <td>性別：</td>
                <td>
                    <input type="radio" name="sex" value="1" checked>男生
                    <input type="radio" name="sex" value="2" <?php echo ( !empty($_POST[ 'sex']) && ($_POST['sex']==2 ) )? "checked":null;?> >女生
                </td>
            </tr>
            <tr>
                <td>興趣：</td>
                <td>
                    <?php
                      if (!empty($_POST['hobby'])){
                          $hobby = $_POST['hobby'];
                      }
                  ?>
                        <input type="checkbox" name="hobby[]" value="1" <?php if (!empty($_POST[ 'hobby'])){foreach($hobby as $i){echo ($i==1)? "checked":null;}} else echo "checked" ?> >游泳
                        <input type="checkbox" name="hobby[]" value="2" <?php if (!empty($_POST[ 'hobby'])){foreach($hobby as $i){echo ($i==2)? "checked":null;}}?> >慢跑
                        <input type="checkbox" name="hobby[]" value="3" <?php if (!empty($_POST[ 'hobby'])){foreach($hobby as $i){echo ($i==3)? "checked":null;}}?> >打網球
                        <input type="checkbox" name="hobby[]" value="4" <?php if (!empty($_POST[ 'hobby'])){foreach($hobby as $i){echo ($i==4)? "checked":null;}}?> >打籃球
                        <input type="checkbox" name="hobby[]" value="5" <?php if (!empty($_POST[ 'hobby'])){foreach($hobby as $i){echo ($i==5)? "checked":null;}}?> >爬山
                </td>
            </tr>
            <tr>
                <td>E-mail：</td>
                <td>
                    <input type="text" name="mail" size="20" maxlength="40" value="<?php echo !empty($_POST['mail'])?$_POST['mail']:null; ?>">
                </td>
            </tr>
            <tr>
                <td>照片上傳：</td>
                <td>
                    <input type="file" name="Myfile">
                </td>
            </tr>
            <tr>
                <td>自我介紹：</td>
                <td>
                    <textarea name="content" rows="10" cols="40"><?php echo !empty($_POST['content'])?$_POST['content']:null; ?></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <input type="submit" value="送出資料" onclick="check()">
                </td>
            </tr>
        </table>
    </form>
    <?php
    /* table top */
    if (!empty($_POST['user'])){
        $sex = array(1 => "男生", "女生");
        $array_hobby = array(1 => "游泳", "慢跑", "打網球", "打籃球", "爬山");

        echo "<table id=\"show_data_table\" border='1'>";
            echo "<tr>";
                echo "<td>性別：</td>" . "<td>" . $_POST['user'] . "</td>";
            echo "</tr>"; 

            echo "<tr>";
                echo "<td>生日：</td>" . "<td>" . $_POST['year'] . "年" . $_POST['month'] . "月" . $_POST['day'] . "日" . "</td>";
            echo "</tr>"; 

            echo "<tr>";
                echo "<td>性別：</td>" . "<td>" . $sex[$_POST['sex']] ."</td>";
            echo "</tr>"; 

            echo "<tr>";
                echo "<td>興趣</td>";
                echo "<td>";
                foreach ($hobby as $hobby_number){
                    echo $array_hobby[$hobby_number] . " ";
                }
                echo "</td>";
            echo "</tr>"; 

            echo "<tr>";
                echo "<td>E-mail：</td>" . "<td>" . $_POST['mail'] . "</td>";
            echo "</tr>"; 

            echo "<tr>";
                echo "<td>自我介紹：</td>" . "<td>" . nl2br(strip_tags($_POST['content'])) . "</td>";
            echo "</tr>"; 
        echo "</table>";
    }
    ?>
</body>

</html>