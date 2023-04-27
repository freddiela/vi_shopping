<?php
/**
 * 上传附件和上传视频
 * User: Jinqn
 * Date: 14-04-09
 * Time: 上午10:17
 */


include('../../../../common.php');

/*if ($_FILES['upfile']['size']) {
	pe_lead('public/class/upload.class.php');
	$upload = new upload($_FILES['upfile']);
	if ($upload->checkresult) {
		echo json_encode(array('state' => 'SUCCESS','title'=>$upload->filename, 'original'=>$upload->file_name, 'type'=>$upload->file_type,'size'=>$upload->file_size, 'url' => $upload->filehost_full));
	}
	else {
		echo json_encode(array('state' => 'err','title'=>'null', 'original'=>'null', 'type'=>'null','size'=>'0', 'url' => 'null'));
	}
}

exit();*/

//include "Uploader.class.php";
pe_lead('public/class/upload.class.php');

/* 上传配置 */
$base64 = "upload";
switch (htmlspecialchars($_GET['action'])) {
    case 'uploadimage':
        if ($_FILES['upfile']['size']) {
			$upload = new upload($_FILES['upfile']);
			if ($upload->checkresult) {
				return json_encode(array('state' => 'SUCCESS','title'=>$upload->filename, 'original'=>$upload->file_name, 'type'=>$upload->file_type,'size'=>$upload->file_size, 'url' => $upload->filehost_full));
			}
			else {
				return json_encode(array('state' => 'err','title'=>'null', 'original'=>'null', 'type'=>'null','size'=>'0', 'url' => 'null'));
			}
		}
        break;
    case 'uploadscrawl':
        if ($_FILES['upfile']['size']) {
			$upload = new upload($_FILES['upfile']);
			if ($upload->checkresult) {
				return json_encode(array('state' => 'SUCCESS','title'=>$upload->filename, 'original'=>$upload->file_name, 'type'=>$upload->file_type,'size'=>$upload->file_size, 'url' => $upload->filehost_full));
			}
			else {
				return json_encode(array('state' => 'err','title'=>'null', 'original'=>'null', 'type'=>'null','size'=>'0', 'url' => 'null'));
			}
		}
        $base64 = "base64";
        break;
    case 'uploadvideo':
         if ($_FILES['upfile']['size']) {
			$upload = new upload($_FILES['upfile']);
			if ($upload->checkresult) {
				return json_encode(array('state' => 'SUCCESS','title'=>$upload->filename, 'original'=>$upload->file_name, 'type'=>$upload->file_type,'size'=>$upload->file_size, 'url' => $upload->filehost_full));
			}
			else {
				return json_encode(array('state' => 'err','title'=>'null', 'original'=>'null', 'type'=>'null','size'=>'0', 'url' => 'null'));
			}
		}
        break;
    case 'uploadfile':
    default:
        if ($_FILES['upfile']['size']) {
			$upload = new upload($_FILES['upfile']);
			if ($upload->checkresult) {
				return json_encode(array('state' => 'SUCCESS','title'=>$upload->filename, 'original'=>$upload->file_name, 'type'=>$upload->file_type,'size'=>$upload->file_size, 'url' => $upload->filehost_full));
			}
			else {
				return json_encode(array('state' => 'err','title'=>'null', 'original'=>'null', 'type'=>'null','size'=>'0', 'url' => 'null'));
			}
		}
        break;
}

/* 生成上传实例对象并完成上传 */
//$up = new Uploader($fieldName, $config, $base64);

/**
 * 得到上传文件所对应的各个参数,数组结构
 * array(
 *     "state" => "",          //上传状态，上传成功时必须返回"SUCCESS"
 *     "url" => "",            //返回的地址
 *     "title" => "",          //新文件名
 *     "original" => "",       //原始文件名
 *     "type" => ""            //文件类型
 *     "size" => "",           //文件大小
 * )
 */

/* 返回数据 */
//return json_encode($up->getFileInfo());
