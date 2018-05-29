<?php
define('BASE_URL', 'http://localhost/Shop/');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
// function Sizemap
function sitemap()
{
    global  $dbc;
    $doc = new DOMDocument("1.0","utf-8");
    $doc-> formatOutput =true;
    $r = $doc->createElement("urlset");
    $r->setAttribute("xmlns", "http://www.sitemaps.org/schemas/sitemap/0.9");
    $doc ->appendChild($r);
    $url= $doc->createElement("url");
    $name=$doc->createAttribute("loc");
    $name->appendChild($doc->createTextNode(BASE_URL));
    $url->appendChild($name);
    $changefreq =$doc->createElement("changefreq");
    $changefreq->appendChild($doc->createTextNode('daily'));
    $url->appendChild($changefreq);
    $priority = $doc->createElement(("priority"));
    $priority ->appendChild($doc->createTextNode('1.00'));
    $url->appendChild($priority);
    $r->appendChild($url);
    // bai viet
    $query_st="SELECT * FROM db_baiviet";
    $query_st1= mysqli_query($dbc, $query_st);
    while($category_st1= mysqli_fetch_array($query_st1,MYSQLI_ASSOC))
    {
        $url=$doc->createElement("url");
        $name=$doc->createElement("loc");
        $name->appendChild($doc->createTextNode(BASE_URL.'baivietct.php?id='.$category_st1['id'].'&tieude='.$category_st1['tieude']));
          $url->appendChild($name);
          $changefreq=$doc->createElement("changefreq");
          $changefreq->appendChild($doc->createTextNode('daily'));
          $url->appendChild($changefreq);
          $priority= $doc->createElement("priority");
          $priority->appendChild($doc->createTextNode('1.00'));
          $url->appendChild($priority);
          $r->appendChild($url);
                
    }
      $query_st2="SELECT * FROM db_danhmuc";
    $query_st2= mysqli_query($dbc, $query_st2);
    while($category_st2= mysqli_fetch_array($query_st2,MYSQLI_ASSOC))
    {
        $url=$doc->createElement("url");
        $name=$doc->createElement("loc");
        $name->appendChild($doc->createTextNode(BASE_URL.'baivietct.php?id='.$category_st2['id']));
          $url->appendChild($name);
          $changefreq=$doc->createElement("changefreq");
          $changefreq->appendChild($doc->createTextNode('daily'));
          $url->appendChild($changefreq);
          $priority= $doc->createElement("priority");
          $priority->appendChild($doc->createTextNode('1.00'));
          $url->appendChild($priority);
          $r->appendChild($url);
                
    }
    $doc->save("sitemap.xml");
}
function kt_query($result,$query)
{
    global  $dbc;
    if(!$result)
    {
        die("Query {$query} \n<br/> MYSQL Error".mysqli_error($dbc));
    }
}
// Ham de Quy
function show_categories($parent_id="0",$insert_text="")
{
    global $dbc;
    $query_dq="SELECT * FROM db_dm_sanpham WHERE parent_id=".$parent_id." ORDER BY parent_id DESC ";
    $categories= mysqli_query($dbc,$query_dq);
    while($category= mysqli_fetch_array($categories,MYSQLI_ASSOC))
    {
        echo("<option value='".$category["id"]."'> ".$insert_text.$category['tendm']."</option>");
        show_categories($category["id"],$insert_text."--");
    }
    return true;
}
// ham hien thi 
function  selectCtrl($name,$class='form-control')
{
    global $dbc;
    echo "<select name='$name' class='$class'>";
        echo "<option value='0'>Danh Mục Cha</option>";
        show_categories();
        echo "</select>";
}
function  selectCtrl_edit($name,$class)
{
    global $dbc;
    echo "<select name='".$name."' class='".$class."'>";
        echo "<option value='0'>Danh Mục Cha</option>";
        show_categories();
        echo "</select>";
}
// themse

function menu_dacap($parent_id=0,$dem=0)
{
    global  $dbc;
    $cate_child=array();
     $query_dq_dm="SELECT * FROM db_dm_sanpham WHERE parent_id =".$parent_id." ORDER BY thutu";
       $categories_dm= mysqli_query($dbc, $query_dq_dm);
    
    while($category_dm= mysqli_fetch_array($categories_dm,MYSQLI_ASSOC))
    {
        $cate_child[]=$category_dm;
    }
//   echo "<pre>";
//    print_r($cate_child);
//    echo "</pre>";
    if($cate_child)
    {
        if($dem ==0)
        {
     
            echo "<li class='dropdown'><a href='index.php' class='active'>Trang Chủ</a></li>";
        }
//        elseif($dem==1)
//        {
//            echo "<ul clas='test_sub>";
//        }
        else
        {
            echo "<ul role='menu' class='dropdown-menu sub-menu'>";
        }
       
        foreach ($cate_child as $key => $item)
            {
            echo "<li class='dropdown dropdown-submenu'>"
            . "<a href='ds_sanpham.php?dm=".$item['id']."'>".$item['tendm']."</a>";
            menu_dacap($item['id'],++$dem);
            
             echo "</li>";
        }
         if(count($cate_child)==$dem)
           {
               echo "<li><a href='lienhe.php'>Liên Hệ</a></li>"; 
           }
        echo "</ul>";
        
    }
}

function menu_dacap_sp($parent_id=0,$dem=0)
{
    global  $dbc;
    $cate_child=array();
    $query_dq_dm="SELECT * FROM db_dm_sanpham WHERE parent_id =".$parent_id." ORDER BY thutu";
    $categories_dm= mysqli_query($dbc, $query_dq_dm);
    while($category_dm= mysqli_fetch_array($categories_dm,MYSQLI_ASSOC))
    {
        $cate_child[]=$category_dm;
    }
//    echo "<pre>";
//    print_r($cate_child);
//    echo "</pre>";
    if($cate_child)
    {
       
         echo "<ul>";
        foreach ($cate_child as $key => $item)
        {
            echo "<li><a href='tinsanpham.php?dm=".$item['id']."'>".$item['tendm']."</a>";
            menu_dacap_sp($item['id'],++$dem);
            
             echo "</li>";
        }
      
        echo '</ul>';
        
    }
    
}
function show_categories_sp($parent_id="0" ,$insert_text="")
{
    global $dbc;
    $query_dq="SELECT * FROM db_dm_sanpham WHERE parent_id=".$parent_id." ORDER BY parent_id DESC ";
    $categories= mysqli_query($dbc,$query_dq);
    while($category= mysqli_fetch_array($categories,MYSQLI_ASSOC))
    {
        echo("<option value='".$category["id"]."'> ".$insert_text.$category['tendm']."</option>");
        show_categories_sp($category["id"],$insert_text."--");
    }
    return true;
}
function selectCtrl_sp($name,$class='form-control')
{
     global $dbc;
   
    echo "<select name='".$name."' class=$class>";
        
        show_categories_sp();
        echo "</select>";
}
?>