<?php
session_start();
$type = $_GET['type'];
$Pageindex=$_GET["Page"];
if ($type == 'increment') 
{
    $_SESSION['count']+=1;
} 
if ($type == 'minus' && $_SESSION['count'] > 1) 
{
    $_SESSION['count']-=1;
}
if ($type == 'alink')
{	
	$_SESSION['count']=$Pageindex;
}
?>