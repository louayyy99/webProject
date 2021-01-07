<?php


class Posts 
{
private $id;
private  $title;
private  $image;
private $content;
private $category;
private $date;



function __construct( $id,$title,$image,$content,$category,$date)
{

$this->id =$id;
$this->title=$title;
$this->image=$image;
$this->content=$content;
$this->category=$category;
$this->date=$date;

}


function getid()
{return $this->id;}
function gettitle()
{return $this->title;}
function getimage()
{return $this->image;}
function getcontent()
{return $this->content;}
function getcategory()
{return $this->category;}
function getdate()
{return $this->date;}

function setid($id)
{ $this->id=$id;}
function settitle($title)
{ $this->title=$title;}
function setimage($image)
{$this->image=$image;}
function setcontent($content)
{$this->content=$content;}

function setcategory($category)
{$this->category=$category;}

function setdate($date)
{$this->date=$date;}

}

?>

 