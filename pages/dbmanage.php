<?php

function r_watch(){
	$ime = $_SESSION["username"];
    $watch = "SELECT * FROM movies WHERE user='$ime' and watched='1' ORDER BY Title";
    return $watch;
}

function r_wish(){
	$ime = $_SESSION["username"];
    $wish = "SELECT * FROM movies WHERE user='$ime' and watched='0' ORDER BY Title";
    return $wish;
}

function r_news(){
	$ime = $_SESSION["username"];
    $news = "SELECT * FROM movies ORDER BY created_at DESC LIMIT 10";
    return $news;
}

function izrada_racuna(){
	$ime = $_SESSION["username"];
	$izrada = "SELECT created_at FROM users WHERE username='$ime'";
	return $izrada;
}

function izrada_grafa(){
	$ime = $_SESSION["username"];
	$graf = "SELECT Genre, count(*) as number FROM movies WHERE user='$ime' GROUP BY Genre";
	return $graf;
}

function izrada_grafad(){
	$ime = $_SESSION["username"];
	$graf = "SELECT Genre FROM movies WHERE user='$ime'";
	return $graf;
}

function delete_row($di){
	$ime=$_SESSION["username"];
	$del = "DELETE FROM movies WHERE user='$ime' and id='$di'";
    return $del;
}

function r_user(){
    $r = "SELECT * FROM users ORDER BY username";
    return $r;
}

function delete_row_user($di){
	$d = "DELETE FROM users WHERE id='$di'";
    return $d;
}

function r_admin(){
	$ime = $_SESSION["username"];
	$a = "SELECT admin FROM users WHERE username='$ime' LIMIT 1";
	return $a;
}

function find($di){
    $t = "SELECT * FROM users WHERE id='$di'";
    return $t;
}

function e_movies($kor){
	$k = "DELETE FROM movies WHERE user = '$kor'";
	return $k;
}

function promijeni_admin($admin_br, $idd){
	$a = "UPDATE users SET admin = '$admin_br' WHERE id = '$idd'";
	return $a;
}

function pogledano($di){
	$p = "UPDATE movies SET watched = '1' WHERE id = '$di'";
	return $p;
}

?>