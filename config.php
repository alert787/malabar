<?php 

function koneksi_db()
{
	$server="127.0.0.1";
	$username="root";
	$passsword="";
	$db="db_malabaroutdoor";

	$link=mysqli_connect($server,$username,$passsword,$db);

	if(!$link)
	{
		die("Gagal Koneksi ".mysqli_error());
	}
return $link;
}

//cek koneksi
$koneksi=koneksi_db();

?>