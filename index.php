<?php
$mysqli=new mysqli('localhost','root','','kino');
if ($mysqli->connect_errno) {
echo "Не удалось подключиться к MySQL: " . mysqli_connect_error();
return false;
};
$mysqli->set_charset("utf8_unicode_ci");
$method = $_SERVER['REQUEST_METHOD'];
if ($method == 'GET'){
    $a=array();
    if ($_GET['id']==1){
        $text="select * from cinema where cname like '%".$_GET['name']."%' or caddress like '%".$_GET['name']."%'";
        $result=$mysqli->query($text);
        while ($row = mysqli_fetch_assoc($result)){
            $b=array("cname"=>$row['cname'],"caddress"=>$row['caddress']);
            $a[]=$b;
        }
    }
	if ($_GET['id']==2){
  			$text=" select * from films where fname like '%".$_GET['name']."%'";
			$result=$mysqli->query($text);
			while ($row = mysqli_fetch_assoc($result)){
				$b=array("fname"=>$row['fname']);
				$a[]=$b;
			}
			
		}		
	if ($_GET['id']==3){
			$text="select * from cinema";
			$result=$mysqli->query($text);
			while ($row = mysqli_fetch_assoc($result)){
				$b=array("cname"=>$row['cname'],"cid"=>$row['cID']);
				$a[]=$b;
			}
		}
		echo json_encode($a);
	};
	if ($method == 'POST'){
		
		if ($_POST['id']==1){
			$text="INSERT INTO `cinema`(`cname`, `caddress`) VALUES ('".$_POST['cname']."','".$_POST['caddress']."')";
			$result=$mysqli->query($text);
			echo $result;
		}
		if ($_POST['id']==2){
			$text="INSERT INTO `films`(`fname`) VALUES ('".$_POST['fname']."')";
			$result=$mysqli->query($text);
			$text="SELECT MAX(`fID`) as id FROM `films`"; 
			$result=$mysqli->query($text);
			if ($row = mysqli_fetch_assoc($result)){
				echo $row['id'];
			}
		}
		if ($_POST['id']==3){
			$text="INSERT INTO `connections`(`cinemaID`, `filmsID`) VALUES (".$_POST['cinemaID'].",".$_POST['filmsID'].")";
			$result=$mysqli->query($text);
			echo $result;
		}
	};
?>