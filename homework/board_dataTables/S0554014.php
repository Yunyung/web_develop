<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8">
<title></title>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<link href="//cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css" rel="stylesheet">

<script src="//code.jquery.com/jquery-3.3.1.js"></script>
<script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/localization/messages_zh_TW.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
<script src="S0554014.js"></script>
<style>
body {
    font-family: "微軟正黑體";
}

.error {
    color: #D82424;
    font-weight: normal;
    display: inline;
    padding: 1px;
}

button{
    display: inline-block;
}
</style>
</head>

<body>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8 text-center">
            <form class="form-horizontal form-inline" name="form1" id="form1" method="post">
                <input type="hidden" name="oper" id="oper" value="insert">
                <input type="hidden" name="message_id_old" id="message_id_old" value="">
                <table id="edit" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">id</th>
                            <th class="text-center">主題</th>
                            <th class="text-center">作者</th>
                            <th class="text-center">內容</th>
                            <th class="text-center">發布時間</th>
                            <th class="text-center">修改/刪除</th>
                        </tr>
                        <tr>
                            <td class="text-center">
                                <input type="text" id="message_id" name="message_id">
                            </td>
                            <td class="text-center">
                                <input type="text" id="message_subject" name="message_subject">
                            </td>
                            <td class="text-center">
                                 <input type="text" id="message_author" name="message_author">
                            </td>
                            <td class="text-center">
                                <textarea type="text" id="message_content" name="message_content" rows="4">
                                </textarea>
                            </td>
                            <td class="text-center">
                                <input type="text" id="message_publishTime">
                            </td>
                            <td>
                                <button type="submit" class="btn btn-primary btn-xs" id="btn-save"><i class="glyphicon glyphicon-save"></i>存檔</button>
                                <button type="reset" class="btn btn-danger btn-xs" id="btn-cancel">取消</button>
                            </td>
                        </tr>
                    </thead>
                </table>
            </form>
                <table id="example" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                           <th class="text-center">id</th>
                           <th class="text-center">主題</th>
                           <th class="text-center">作者</th>
                           <th class="text-center">內容</th>
                           <th class="text-center">發布時間</th>
                           <th class="text-center">修改/刪除</th>
                        </tr>
                        
                    </thead>
                </table>
        </div>
        <div class="col-md-2"></div>
    </div>
</body>

</html>