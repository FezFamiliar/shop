<?php
session_start();

$relConfig = '../';
include($relConfig.'config.php');
include('functions/functions.php');
$user = admin_login($_POST['username'], $_POST['password'], $_GET['logout']);
if (!$user)	header('Location: index.php');
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 'LIMIT '.(($page-1)*50).', 50';

$action = ($_POST['action'] ? $_POST['action'] : $_GET['action']);
$table = 'settings';

if ($action == 'save')
{
	$edit_id = $_POST['edit_id'];
	$type = $_POST['type'];


	$data_array = array('name'				=> $_POST['name']);

	if ($type == '1')
		$data_array = array('value'			=> $_POST['value']);
	else
		$file_array['value'] = array(	'name'			=> $_FILES['value'],
																	'path'			=> '../uploads/settings/');


	insert_or_update($table, $edit_id, $data_array, $file_array);
}

if ($action == 'delete')
{
	$id = $_GET['id'];
	delete($table, $id);
}

if ($action == 'edit')
{
	$edit_id = $_GET['edit_id'];
	$edit_row = get_row($table, array('id' => $edit_id));
}

$display_array = get_row($table, '', 'ORDER BY id DESC', $limit, false, false, $condition);
$display_count = get_row($table, '', 'ORDER BY id DESC', '', false, true, $condition);
$paging = get_paging($display_count, $page, '50', $root.$_SERVER['PHP_SELF']);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Administration area</title>
<meta name="viewport" content="width=width, initial-scale=1.0">
<link rel="stylesheet" href="<? echo $root; ?>/functions/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="<? echo $root; ?>/functions/bootstrap/css/bootstrap-theme.min.css">
<link rel="stylesheet" href="<? echo $root; ?>/admin/admin_style.css" type="text/css" />
<script type="text/javascript" src="<? echo $root; ?>/functions/jquery-1.12.3.min.js"></script>
<script type="text/javascript" src="<? echo $root; ?>/functions/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<? echo $root; ?>/functions/jquery-ui/jquery-ui.js"></script>
<script type="text/javascript" src="<? echo $root; ?>/functions/bootstrap-notify.min.js"></script>
<script type="text/javascript" src="<? echo $root; ?>/functions/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="<? echo $root; ?>/admin/functions/functions.js"></script>

<script>tinymce.init({ selector:'textarea', toolbar: 'undo redo | styleselect | bold italic | link image', menubar:false, height:300} );</script>

</head>

<body>
	<? include('header.php'); ?>

    <div class="container-fluid main">

        <div class="col-md-<? echo (in_array($action, array('edit', 'add')) ? '11' : '24'); ?> list-table">
        	<div class="row">
            	<div class="col-md-12"><h1>Setări</h1></div>
                <div class="col-md-12 text-right">
                </div>
            </div>


            <div class="row">
            	<div class="col-md-12"><? echo $paging; ?></div>
                <div class="col-md-12">
                </div>
            </div><br />
            <table class="table table-hover">
            	<tr class="table-level-0">
                    <th class="col-md-2">Nume</th>
										<th class="col-md-9">Value</th>
										<th class="col-md-9">Type</th>
                    <th class="col-md-4">Acțiune</th>
                </tr>
				<?
                if (is_array($display_array))
                foreach ($display_array as $row)
                {
                    ?>
                    <tr class="table-level-0">
                        <td><?= $row['name']; ?></td>
												<td><?= $row['value'] ?></td>
												<td><?= $row['type'] ?></td>
                        <td>
                        	<span class="glyphicon glyphicon-pencil" onclick="window.location='<? echo $_SERVER['PHP_SELF']; ?>?edit_id=<? echo $row['id']; ?>&action=edit'"></span>&nbsp;&nbsp;
                        </td>
                    </tr>
                    <?
                }
                ?>
			</table>

            <? echo $paging; ?>

        </div>
        <div class="col-md-<? echo (in_array($action, array('edit', 'add')) ? '12' : '0'); ?>">
        	<? if (in_array($action, array('edit', 'add')))	{ ?>
        	<form action="<? echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
            	<div class="panel panel-primary form-panel">
                  <div class="panel-heading">Modifică o postare</div>
                  <div class="panel-body">
                  	<? echo html_edit_row('text', 'Nume', 'name', $edit_row[0]['name'], '', ''); ?>
                    <?
					if ($edit_row[0]['type'] == '1')
						echo html_edit_row('text', 'Valoare', 'value', $edit_row[0]['value'], '', '');
					else
						echo html_edit_row('file', 'Imagine', 'value', ($edit_row[0]['value'] != '' ? $root.'/uploads/settings/'.$edit_row[0]['value'] : ''), '', ''); ?>

                    <div class="row">
                      <div class="col-md-24 text-center">
                      	<input type="hidden" name="type" value="<? echo $edit_row[0]['type']; ?>" />
                      	<input type="hidden" name="edit_id" value="<? echo $edit_row[0]['id']; ?>" />
                        <input type="hidden" name="action" value="save" />
                      	<button type="submit" class="btn btn-primary btn-sm">Salvare</button>
                      </div>
                    </div>
                  </div>
                </div>
            </form>
            <? } ?>
        </div>
    </div>
    <? echo output_html_message_array(); ?><br />
</body>
</html>
