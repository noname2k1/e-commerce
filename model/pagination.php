<?php
include_once 'utils.php';
function pagination($table, $limit = 8)
{
 //default value
 $page = 1;
 //get total records
 $query_get_total_records = "SELECT COUNT(id) AS total FROM {$table}";
 $total                   = pdo_fetch_one($query_get_total_records);
 $total_records           = $total['total'];
 $page                    = isset($_GET['page']) ? $_GET['page'] : $page;
 $start                   = ($page - 1) * $limit;
 $total_page              = ceil($total_records / $limit);
 if ($page > $total_page) {
  $page = $total_page;
 } elseif ($page < 1) {
  $page = 1;
 }

 if ($table === 'product') {
  $query_get_data = "SELECT * FROM {$table} WHERE display = 1 AND quantity > 0 AND price > 0 ORDER BY id DESC LIMIT {$start},{$limit}";
 } else {
  $query_get_data = "SELECT * FROM {$table} ORDER BY id DESC LIMIT {$start},{$limit}";
 }
 //get data
 $data = pdo_fetch_all($query_get_data);
 //return
 return [
  'data'       => $data,
  'pagination' => [
   'page'          => $page,
   'limit'         => $limit,
   'total_page'    => $total_page,
   'total_records' => $total_records,
  ],
 ];
}