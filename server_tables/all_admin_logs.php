<?php 
include('../classes/algorithm_functions.php');
include('../includes/config.php');
// include('includes/header.php');

/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simple to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */
 
// DB table to use
$table = 'logs_tbl';
 
// Table's primary key
$primaryKey = 'id';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    // array( 'db' => 'unique_id', 'dt' => 0 ),
    array( 
        'db' => 'admin_id',
        'dt' => 0,
        'formatter' => function( $d, $row){
             $get_admin_det = get_one_row_from_one_table('admin_tbl','unique_id',$d); 
            return $get_admin_det['surname'].' '.$get_admin_det['other_names'];
        }
     ),
    array( 'db' => 'description',     'dt' => 1 ),
    array(
        'db'        => 'date_created',
        'dt'        => 2,
        'formatter' => function( $d, $row ) {
            // return date( 'jS M y', strtotime($d));
            return date( 'd F Y h:i:s a', strtotime($d));
        }
    )

);
 
//SQL server connection information
$sql_details = array(
    'user' => USER,
    'pass' => PASSWORD,
    'db'   => DB_NAME,
    'host' => HOST
);


 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
 
require( 'ssp.class.php' );
 
echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);