<?php
/**************************************************************************
MySQL PHP Search of devseq_test database by CS
This is major version checked for functionality and backup based on V206
MySQL Database Version Used: 8.0.33
PHP Version Used: 8.2.8 Zend Engine v4.2.8
Apache Server Version Used: 2.4.41 (Ubuntu)
**************************************************************************/


// Start new session
session_start();

// Set time limit for PHP script execution time (default limit is 30 seconds)
// If limit is reached, the script returns a fatal error
// Set to 20 seconds before timing out
set_time_limit(20);

// Force script errors and warnings to show during production only
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
ini_set('display_errors', '1');

// turn off php notices
# error_reporting(0);

// Connect to MySQL database
require_once("connect_mysql_ds.php");


// Create a file name with session id
// Once the browser gets closed and restarted, a new session with a new session_id is created
$session_id = session_id();
$session_input_fname = $session_id . "_inputfile.json";
$session_output_fname = $session_id . "_outputfile.json";
$session_input_fname_path = "/var/www/devseqplant.org/files/" . $session_input_fname;
$session_output_fname_path = "/var/www/devseqplant.org/files/" . $session_output_fname;
$jsonoutfile = fopen($session_input_fname_path, 'w');
$jsonouthclust = fopen($session_output_fname_path, 'w');

// Define variables
$search_output = "";
$transformq = "";
$atcolnames = "";
$valueslog = "";
$keysclust = "";
$valuesclust = "";
$transformqlogcsv = "";


// Process the search query_Initiate the search output variable

if (isset($_POST['searchquery']) && $_POST['searchquery'] != "") {

  // run code if condition meets here
  // preg_replace = case-insensitive (#i) replace function for anything else than letters numbers space ? and ! all other characters get replaced by ' ' = replace by nothing (characters that are not allowed get removed) this rule gets applied for all posted variables ($_POST['searchquery'])

  $searchquery = preg_replace('#[^a-z 0-9?!.,;]#i', '', $_POST['searchquery']);
  $search = preg_split("/[\s,;]+/", $searchquery); 

  $atcolnames .= 'root_root_tip_5d_1, root_root_tip_5d_2, root_root_tip_5d_3, root_maturation_zone_5d_1, root_maturation_zone_5d_2, root_maturation_zone_5d_3, root_whole_root_5d_1, root_whole_root_5d_2, root_whole_root_5d_3, root_whole_root_7d_1, root_whole_root_7d_2, root_whole_root_7d_3, root_whole_root_14d_1, root_whole_root_14d_2, root_whole_root_14d_3,root_whole_root_21d_1, root_whole_root_21d_2, root_whole_root_21d_3, hypocotyl_10d_1, hypocotyl_10d_2, hypocotyl_10d_3, third_internode_24d_1, third_internode_24d_2, third_internode_24d_3, second_internode_24d_1, second_internode_24d_2, second_internode_24d_3, first_internode_28d_1, first_internode_28d_2, first_internode_28d_3, cotyledons_7d_1, cotyledons_7d_2, cotyledons_7d_3,  leaf_1_2_7d_1, leaf_1_2_7d_2, leaf_1_2_7d_3, leaf_1_2_10d_1, leaf_1_2_10d_2, leaf_1_2_10d_3, leaf_1_2_petiole_10d_1, leaf_1_2_petiole_10d_2, leaf_1_2_petiole_10d_3, leaf_1_2_leaf_tip_10d_1, leaf_1_2_leaf_tip_10d_2, leaf_1_2_leaf_tip_10d_3, leaf_5_6_17d_1, leaf_5_6_17d_2, leaf_5_6_17d_3, leaf_9_10_27d_1, leaf_9_10_27d_2, leaf_9_10_27d_3, leaf_senescing_35d_1, leaf_senescing_35d_2, leaf_senescing_35d_3, cauline_leaves_24d_1, cauline_leaves_24d_2, cauline_leaves_24d_3, apex_vegetative_7d_1, apex_vegetative_7d_2, apex_vegetative_7d_3, apex_vegetative_10d_1, apex_vegetative_10d_2, apex_vegetative_10d_3, apex_vegetative_14d_1, apex_vegetative_14d_2, apex_vegetative_14d_3, apex_inflorescence_21d_1, apex_inflorescence_21d_2, apex_inflorescence_21d_3, apex_inflorescence_28d_1, apex_inflorescence_28d_2, apex_inflorescence_28d_3, apex_inflorescence_clv1_21d_1, apex_inflorescence_clv1_21d_2, apex_inflorescence_clv1_21d_3,  flower_stg9_21d_1, flower_stg9_21d_2, flower_stg9_21d_3, flower_stg10_11_21d_1, flower_stg10_11_21d_2, flower_stg10_11_21d_3, flower_stg12_21d_1, flower_stg12_21d_2, flower_stg12_21d_3, flower_stg15_21d_1, flower_stg15_21d_2, flower_stg15_21d_3, flower_stg12_sepals_21d_1, flower_stg12_sepals_21d_2, flower_stg12_sepals_21d_3, flower_stg15_sepals_21d_1, flower_stg15_sepals_21d_2, flower_stg15_sepals_21d_3, flower_stg12_petals_21d_1, flower_stg12_petals_21d_2, flower_stg12_petals_21d_3, flower_stg15_petals_21d_1, flower_stg15_petals_21d_2, flower_stg15_petals_21d_3, flower_stg12_stamens_21d_1, flower_stg12_stamens_21d_2, flower_stg12_stamens_21d_3, flower_stg15_stamens_21d_1, flower_stg15_stamens_21d_2, flower_stg15_stamens_21d_3, flowers_mature_pollen_28d_1, flowers_mature_pollen_28d_2, flowers_mature_pollen_28d_3, flower_early_stg12_carpels_21d_1, flower_early_stg12_carpels_21d_2, flower_early_stg12_carpels_21d_3, flower_late_stg12_carpels_21d_1, flower_late_stg12_carpels_21d_2, flower_late_stg12_carpels_21d_3, flower_stg15_carpels_21d_1, flower_stg15_carpels_21d_2, flower_stg15_carpels_21d_3, fruit_stg16_siliques_28d_1, fruit_stg16_siliques_28d_2, fruit_stg16_siliques_28d_3, fruit_stg17a_siliques_28d_1, fruit_stg17a_siliques_28d_2,fruit_stg17a_siliques_28d_3,fruit_stg16_seeds_28d_1, fruit_stg16_seeds_28d_2,fruit_stg16_seeds_28d_3, fruit_stg17a_seeds_28d_1,fruit_stg17a_seeds_28d_2, fruit_stg17a_seeds_28d_3, fruit_stg18_seeds_28d_1, fruit_stg18_seeds_28d_2, fruit_stg18_seeds_28d_3';

  $mtcolnames .= 'root_whole_root_4d_1, root_whole_root_4d_2, root_whole_root_4d_3,  hypocotyl_8d_1, hypocotyl_8d_2, hypocotyl_8d_3, leaf_2_7d_1, leaf_2_7d_2, leaf_2_7d_3,   apex_vegetative_6d_1, apex_vegetative_6d_2, apex_vegetative_6d_3, meristem_inflorescence_7w_1, meristem_inflorescence_7w_2, meristem_inflorescence_7w_3, flower_stg8_7w_1, flower_stg8_7w_2, flower_stg8_7w_3, flower_stg8_stamens_7w_1, flower_stg8_stamens_7w_2, flower_stg8_stamens_7w_3, flowers_mature_pollen_7w_1, flowers_mature_pollen_7w_2, flowers_mature_pollen_7w_3, flower_stg8_carpels_7w_1, flower_stg8_carpels_7w_2, flower_stg8_carpels_7w_3';
  
  // Searching Arabidopsis thaliana tables
  if ($_POST['filter1'] == "Arabidopsis_thaliana" && $_POST['filter2'] == "gene_level" && ($_POST['filter5'] == "0" || $_POST['filter5'] == "1")) {
    $sqlCommand = "SELECT gene_id, {$atcolnames} FROM Arabidopsis_thaliana_gene_tpm_20231101 WHERE gene_id in ('".implode("','",$search)."') OR symbol in ('".implode("','",$search)."')";
  
  } else if ($_POST['filter1'] == "Arabidopsis_thaliana" && $_POST['filter2'] == "gene_level" && ($_POST['filter5'] == "2")) {
    $sqlCommand = "SELECT gene_id, {$atcolnames} FROM Arabidopsis_thaliana_gene_tpm_RE_20231101 WHERE gene_id in ('".implode("','",$search)."') OR symbol in ('".implode("','",$search)."')";

  } else if ($_POST['filter1'] == "Arabidopsis_thaliana" && $_POST['filter2'] == "isoform_level" && ($_POST['filter5'] == "0" || $_POST['filter5'] == "1")) {
    $sqlCommand = "SELECT transcript_id, {$atcolnames} FROM Arabidopsis_thaliana_transcript_tpm_20231101 WHERE transcript_id in ('".implode("','",$search)."') OR gene_id in ('".implode("','",$search)."') OR symbol in ('".implode("','",$search)."')";

  } else if ($_POST['filter1'] == "Arabidopsis_thaliana" && $_POST['filter2'] == "isoform_level" && ($_POST['filter5'] == "2")) {
    $sqlCommand = "SELECT transcript_id, {$atcolnames} FROM Arabidopsis_thaliana_transcript_tpm_RE_20231101 WHERE transcript_id in ('".implode("','",$search)."') OR gene_id in ('".implode("','",$search)."') OR symbol in ('".implode("','",$search)."')";

  } else if ($_POST['filter1'] == "Medicago_truncatula" && $_POST['filter2'] == "gene_level" && ($_POST['filter5'] == "0" || $_POST['filter5'] == "1")) {
    $sqlCommand = "SELECT gene_id, {$mtcolnames} FROM Medicago_truncatula_gene_tpm_20231101 WHERE gene_id in ('".implode("','",$search)."')";
  
  } else if ($_POST['filter1'] == "Medicago_truncatula" && $_POST['filter2'] == "gene_level" && ($_POST['filter5'] == "2")) {
    $sqlCommand = "SELECT gene_id, {$mtcolnames} FROM Medicago_truncatula_gene_tpm_RE_20231101 WHERE gene_id in ('".implode("','",$search)."')";

  } else if ($_POST['filter1'] == "Medicago_truncatula" && $_POST['filter2'] == "isoform_level" && ($_POST['filter5'] == "0" || $_POST['filter5'] == "1")) {
    $sqlCommand = "SELECT transcript_id, {$mtcolnames} FROM Medicago_truncatula_transcript_tpm_20231101 WHERE transcript_id in ('".implode("','",$search)."') OR gene_id in ('".implode("','",$search)."')";

  } else if ($_POST['filter1'] == "Medicago_truncatula" && $_POST['filter2'] == "isoform_level" && ($_POST['filter5'] == "2")) {
    $sqlCommand = "SELECT transcript_id, {$mtcolnames} FROM Medicago_truncatula_transcript_tpm_RE_20231101 WHERE transcript_id in ('".implode("','",$search)."') OR gene_id in ('".implode("','",$search)."')";

  }


// ---------------------------------------------------------------------------------------

    $query = mysqli_query($myConnection, $sqlCommand) or die(mysql_error());

    $count = mysqli_num_rows($query);

    if ($count == 1) {

      $search_output .= "&nbsp &nbsp&#8198 <strong>1</strong> entity found";

      $transformq = array();

      while($row = mysqli_fetch_row($query)){  

        // Fill transformq array with query data; This array is used for json transformation later
        $transformq[] = $row;

        }

    } else if ($count > 1) {

      $search_output .= "&nbsp &nbsp&#8198 <strong>$count</strong> entities found";

      $transformq = array();

      while($row = mysqli_fetch_row($query)){  

        // Fill transformq array with query data; This array is used for json transformation later
        $transformq[] = $row;

        }

  } else {

    $search_output = "<br> &nbsp &nbsp&#8198 <center> <strong>$searchquery</strong> not present in dataset </center> <br/>";
  }



mysqli_close($myConnection);


/**************************************************************************
Processing PHP arrays containing MySQL output
Define PHP array containing all column names
Transform PHP arrays into javascript plot library readable json objects
Run python script for data clustering (heatmap option only)
Transform python output into javascript plot library readable json objects
***************************************************************************/

// Define PHP array containing column names for Arabidopsis thaliana
if ($_POST['filter1'] == "Arabidopsis_thaliana" && ($count < 1251)) { 
  $colnames = array(['ID','root_root tip_5d.1', 'root_root tip_5d.2', 'root_root tip_5d.3', 'root_maturation zone_5d.1', 'root_maturation zone_5d.2', 'root_maturation zone_5d.3', 'root_whole root_5d.1', 'root_whole root_5d.2', 'root_whole root_5d.3', 'root_whole root_7d.1', 'root_whole root_7d.2', 'root_whole root_7d.3', 'root_whole root_14d.1', 'root_whole root_14d.2', 'root_whole root_14d.3', 'root_whole root_21d.1', 'root_whole root_21d.2', 'root_whole root_21d.3', 'hypocotyl_10d.1', 'hypocotyl_10d.2', 'hypocotyl_10d.3', '3rd internode_24d.1', '3rd internode_24d.2', '3rd internode_24d.3', '2nd internode_24d.1', '2nd internode_24d.2', '2nd internode_24d.3', '1st internode_28d.1', '1st internode_28d.2', '1st internode_28d.3', 'cotyledons_7d.1', 'cotyledons_7d.2', 'cotyledons_7d.3', 'leaf 1+2_7d.1', 'leaf 1+2_7d.2', 'leaf 1+2_7d.3', 'leaf 1+2_10d.1', 'leaf 1+2_10d.2', 'leaf 1+2_10d.3', 'leaf 1+2_petiole_10d.1', 'leaf 1+2_petiole_10d.2', 'leaf 1+2_petiole_10d.3', 'leaf 1+2_leaf tip_10d.1', 'leaf 1+2_leaf tip_10d.2', 'leaf 1+2_leaf tip_10d.3', 'leaf_5+6_17d.1', 'leaf_5+6_17d.2', 'leaf_5+6_17d.3', 'leaf_9+10_27d.1', 'leaf_9+10_27d.2', 'leaf_9+10_27d.3', 'leaves senescing_35d.1', 'leaves senescing_35d.2', 'leaves senescing_35d.3', 'cauline leaves_24d.1', 'cauline leaves_24d.2', 'cauline leaves_24d.3', 'apex vegetative_7d.1', 'apex vegetative_7d.2', 'apex vegetative_7d.3', 'apex vegetative_10d.1', 'apex vegetative_10d.2', 'apex vegetative_10d.3', 'apex vegetative_14d.1', 'apex vegetative_14d.2', 'apex vegetative_14d.3', 'apex inflorescence_21d.1', 'apex inflorescence_21d.2', 'apex inflorescence_21d.3', 'apex inflorescence_28d.1', 'apex inflorescence_28d.2', 'apex inflorescence_28d.3', 'apex inflorescence_clv1_21d.1', 'apex inflorescence_clv1_21d.2', 'apex inflorescence_clv1_21d.3', 'flower stg9_21d+.1', 'flower stg9_21d+.2', 'flower stg9_21d+.3', 'flower stg10/11_21d+.1', 'flower stg10/11_21d+.2', 'flower stg10/11_21d+.3', 'flower stg12_21d+.1', 'flower stg12_21d+.2', 'flower stg12_21d+.3', 'flower stg15_21d+.1', 'flower stg15_21d+.2', 'flower stg15_21d+.3', 'flower stg12_sepals.1', 'flower stg12_sepals.2', 'flower stg12_sepals.3', 'flower stg15_sepals.1', 'flower stg15_sepals.2', 'flower stg15_sepals.3', 'flower stg12_petals.1', 'flower stg12_petals.2', 'flower stg12_petals.3', 'flower stg15_petals.1', 'flower stg15_petals.2', 'flower stg15_petals.3', 'flower stg12_stamens.1', 'flower stg12_stamens.2', 'flower stg12_stamens.3', 'flower stg15_stamens.1', 'flower stg15_stamens.2', 'flower stg15_stamens.3', 'mature pollen_28d+.1', 'mature pollen_28d+.2', 'mature pollen_28d+.3', 'flower early stg12_carpels.1', 'flower early stg12_carpels.2', 'flower early stg12_carpels.3', 'flower late stg12_carpels.1', 'flower late stg12_carpels.2', 'flower late stg12_carpels.3', 'flower stg15_carpels.1', 'flower stg15_carpels.2', 'flower stg15_carpels.3', 'fruit stg16_siliques.1', 'fruit stg16_siliques.2', 'fruit stg16_siliques.3', 'fruit stg17a_siliques.1', 'fruit stg17a_siliques.2', 'fruit stg17a_siliques.3', 'fruit stg16_seeds.1', 'fruit stg16_seeds.2', 'fruit stg16_seeds.3', 'fruit stg17a_seeds.1', 'fruit stg17a_seeds.2', 'fruit stg17a_seeds.3', 'fruit stg18_seeds.1', 'fruit stg18_seeds.2', 'fruit stg18_seeds.3']);
} else if ($_POST['filter1'] == "Arabidopsis_thaliana" && ($count > 1250)) { 
  $colnames = array(['ID','root_root tip_5d', 'root_maturation zone_5d', 'root_whole root_5d', 'root_whole root_7d', 'root_whole root_14d', 'root_whole root_21d', 'hypocotyl_10d', '3rd internode_24d', '2nd internode_24d', '1st internode_28d', 'cotyledons_7d', 'leaf 1+2_7d', 'leaf 1+2_10d', 'leaf 1+2_petiole_10d', 'leaf 1+2_leaf tip_10d', 'leaf_5+6_17d', 'leaf_9+10_27d', 'leaves senescing_35d', 'cauline leaves_24d', 'apex vegetative_7d', 'apex vegetative_10d', 'apex vegetative_14d', 'apex inflorescence_21d', 'apex inflorescence_28d', 'apex inflorescence_clv1_21d', 'flower stg9_21d+', 'flower stg10/11_21d+', 'flower stg12_21d+', 'flower stg15_21d+', 'flower stg12_sepals', 'flower stg15_sepals', 'flower stg12_petals', 'flower stg15_petals', 'flower stg12_stamens', 'flower stg15_stamens', 'mature pollen_28d+', 'flower early stg12_carpels', 'flower late stg12_carpels', 'flower stg15_carpels', 'fruit stg16_siliques', 'fruit stg17a_siliques', 'fruit stg16/17a_seeds', 'fruit stg17b_seeds', 'fruit stg18_seeds']);
} else if ($_POST['filter1'] == "Capsella_rubella") {
  $colnames = array(['ID','root_whole root_4d.1', 'root_whole root_4d.2', 'root_whole root_4d.3', 'hypocotyl_9d.1', 'hypocotyl_9d.2', 'hypocotyl_9d.3', 'leaf 1+2_7d.1', 'leaf 1+2_7d.2', 'leaf 1+2_7d.3', 'apex vegetative_7d.1', 'apex vegetative_7d.2', 'apex vegetative_7d.3', 'apex inflorescence.1', 'apex inflorescence.2', 'apex inflorescence.3', 'flower stg12.1', 'flower stg12.2', 'flower stg12.3', 'flower stg12_carpels.1', 'flower stg12_carpels.2', 'flower stg12_carpels.3', 'flower stg12_stamens.1', 'flower stg12_stamens.2', 'flower stg12_stamens.3', 'mature pollen.1', 'mature pollen.2', 'mature pollen.3']);
} else if ($_POST['filter1'] == "Eutrema_salsugineum") { 
  $colnames = array(['ID','root_whole root_6d.1', 'root_whole root_6d.2', 'root_whole root_6d.3', 'hypocotyl_12d.1', 'hypocotyl_12d.2', 'hypocotyl_12d.3', 'leaf 1+2_9d.1', 'leaf 1+2_9d.2', 'leaf 1+2_9d.3', 'apex vegetative_9d.1', 'apex vegetative_9d.2', 'apex vegetative_9d.3', 'apex inflorescence.1', 'apex inflorescence.2', 'apex inflorescence.3', 'flower stg12.1', 'flower stg12.2', 'flower stg12.3', 'flower stg12_carpels.1', 'flower stg12_carpels.2', 'flower stg12_carpels.3', 'flower stg12_stamens.1', 'flower stg12_stamens.2', 'flower stg12_stamens.3', 'mature pollen.1', 'mature pollen.2', 'mature pollen.3']);
} else if ($_POST['filter1'] == "Medicago_truncatula") { 
  $colnames = array(['ID','root_whole root_4d.1', 'root_whole root_4d.2', 'root_whole root_4d.3', 'hypocotyl_8d.1', 'hypocotyl_8d.2', 'hypocotyl_8d.3', 'leaf 2_7d.1', 'leaf 2_7d.2', 'leaf 2_7d.3', 'apex vegetative_6d.1', 'apex vegetative_6d.2', 'apex vegetative_6d.3', 'meristem inflorescence_7w.1', 'meristem inflorescence_7w.2', 'meristem inflorescence_7w.3', 'flower stg8.1', 'flower stg8.2', 'flower stg8.3', 'flower stg8_carpels.1', 'flower stg8_carpels.2', 'flower stg8_carpels.3', 'flower stg8_stamens.1', 'flower stg8_stamens.2', 'flower stg8_stamens.3', 'mature pollen.1', 'mature pollen.2', 'mature pollen.3']);
};


// Generate an array that contains both header and mysqli fetched data
// Needed to store expression data for csv that will be generated later
if ($count > 0){

$transformqcsv = array_merge($colnames, $transformq);


// select title for y axis and colorscale based on selected normalization
if ($_POST['filter5'] == "0"){
    $title = "TPM";
} else if ($_POST['filter5'] == "1"){
    $title = "log2(TPM)";
} else if ($_POST['filter5'] == "2"){
    $title = "RE";
};


// Create an array of desired format in PHP as input for C3.json
// first generate php array with deleted gene identifiers
$values = $transformq;
function delete_col1(&$values, $offset) {
    return array_walk($values, function (&$v) use ($offset) {
        array_splice($v, $offset, 1);
    });
}
delete_col1($values, 0);


// Create an array with log2 values of original array with deleted gene identifiers ($values)
if ($_POST['filter5'] == "1") {
  $valueslog = $values;
  function logcalc(&$v) {$v = round (log(($v+1),2),2);}
  array_walk_recursive($valueslog, "logcalc");
};


// second generate php array that only contains gene identifiers
$keys = $transformq;
function delete_col2(&$keys, $offset) {
    return array_walk($keys, function (&$v) use ($offset) {
        array_splice($v, $offset, 123);
    });
}
delete_col2($keys, 1);


// reduce gene identifier array by one dimension
$keys2 = array_map(function($v){return $v[0];},$keys);


if ($_POST['filter5'] == "1"){

  // log2-transformed expression values of transformq array
  function mapArray($keys, $valueslog) {
    return [array_merge([$keys[0]], $valueslog)];
  }

  $transformqlog = array_map("mapArray", $keys, $valueslog);
  $transformqlog = array_map(function($v){return $v[0];},$transformqlog);


  // Add header to $transformqlog array
  $transformqlogcsv = array_merge($colnames, $transformqlog);
}


// create new combined array from $keys and §values/valueslog arrays
if ($_POST['filter5'] == "0" || $_POST['filter5'] == "2"){
  $transformcomb = array_combine(array_map(function($v){return $v[0];},$keys), $values);
} else if ($_POST['filter5'] == "1"){
  $transformcomb = array_combine(array_map(function($v){return $v[0];},$keys), $valueslog);
};


// calculate height for heatmap chart based on count results
// if more than 1250 entries, reduce div height otherwise plotly haetmap will crash
if($count < 1251){
  $reqheight = (275+($count*22));
} else $reqheight = (275+($count*5));


// write search output to json file 
$jsonoutcsv = json_encode($transformqcsv, JSON_NUMERIC_CHECK);
$jsonoutcsvlog = json_encode($transformqlogcsv, JSON_NUMERIC_CHECK);
$jsonout = json_encode($transformcomb, JSON_NUMERIC_CHECK);
$valuesout = json_encode($values, JSON_NUMERIC_CHECK);
$valueslogout = json_encode($valueslog, JSON_NUMERIC_CHECK);
$keys2out = json_encode($keys2);
$reqheightout = json_encode($reqheight, JSON_NUMERIC_CHECK);
$titleout = json_encode($title);
$countout = json_encode($count, JSON_NUMERIC_CHECK);

// write $jsonout to json file on server (needed for hclust if $count > 400)
// Use these variables later when calling python from PHP is tested and functional
fwrite($jsonoutfile, $jsonout);
fclose($jsonoutfile);

$jsonsessid = json_encode($session_id, JSON_NUMERIC_CHECK);
$jsonsessidshin = escapeshellarg($jsonsessid);


// Perform hierarchical clustering of $jsonout json array by calling python script
if ($_POST['filter4'] == "heatmap" && $_POST['filter6'] == "1" && ($count > 1) && ($count <= 400)) {
// Prepare json file for passing to shell
$jsonoutshin = escapeshellarg($jsonout);
// Execute the python script with the JSON data
$resultpy = shell_exec("/usr/bin/python3 /var/www/devseqplant.org/py/hclust_exe.py 2>&1 $jsonoutshin");
// Decode the result
$clusteresult = json_decode($resultpy, true);
// End python clustering workflow

// Generate an array of keys
$keysclust = array_keys($clusteresult);
array_unshift($keys, NULL);
unset($keys[0]);

// Generate an array of expression values
$valuesclust = array_values($clusteresult);
array_unshift($values, NULL);
unset($values[0]);

// write search output to json file 
$valuesclustout = json_encode($valuesclust, JSON_NUMERIC_CHECK);
$keysclustout = json_encode($keysclust);

// For >400 counts read and write json data from file when using hclust
} else if ($_POST['filter4'] == "heatmap" && $_POST['filter6'] == "1" && ($count > 400)) {
  // Execute the python script with the JSON data
  // For production use: Send python errors to PHP and write to html
  //exec('/usr/bin/python3 /var/www/devseqplant.org/py/hclust_esc.py 2>&1', $output, $return_var);
  //if ($return_var>0) {
  //  var_dump($output);
  //}
  shell_exec("/usr/bin/python3 /var/www/devseqplant.org/py/hclust_esc.py 2>&1 $jsonsessidshin");
  // read data from jsonout.json file fater hclust has been performed
  $jsonouthclust = file_get_contents($session_output_fname_path);
  // Decode the result
  $clusteresult = json_decode($jsonouthclust, true);
  // End python clustering workflow

// Generate an array of keys
$keysclust = array_keys($clusteresult);
array_unshift($keys, NULL);
unset($keys[0]);

// Generate an array of expression values
$valuesclust = array_values($clusteresult);
array_unshift($values, NULL);
unset($values[0]);

// write search output to json file 
$valuesclustout = json_encode($valuesclust, JSON_NUMERIC_CHECK);
$keysclustout = json_encode($keysclust);
}; 

if ($_POST['filter4'] == "heatmap" && $_POST['filter6'] == "1" && ($count > 1)) {
  // Combine keys and values from hclust analysis
  function mapArrayClust($keysclust, $valuesclust) {
    return [array_merge([$keysclust], $valuesclust)];
  }
  $clusteresultkeyvalue = array_map("mapArrayClust", $keysclust, $valuesclust);
  $clusteresultkeyvalue = array_map(function($v){return $v[0];},$clusteresultkeyvalue);

  // write search output to json file containing header for csv file 
  $transformqclustcsv = array_merge($colnames, $clusteresultkeyvalue);
  $jsonoutclustcsv = json_encode($transformqclustcsv, JSON_NUMERIC_CHECK);
}


$sboxplaceholder = "Enter gene, isoform ID, or symbol, e.g. AT5G10720, PIN1, or paste a list of identifiers";

// Set input box placeholder in case another species gets selected
if ($_POST['filter1'] == "Arabidopsis_thaliana") {
$sboxplaceholder = "Enter gene, isoform ID, or symbol, e.g. AT5G10720, PIN1, or paste a list of identifiers";
} else if ($_POST['filter1'] == "Arabidopsis_lyrata") {
$sboxplaceholder = "Enter gene or isoform ID, e.g. AL6G21260.t1, AL1G32580.t1, or paste a list of IDs";
} else if ($_POST['filter1'] == "Capsella_rubella") {
$sboxplaceholder = "Enter gene or isoform ID, e.g. Carubv10003739m, Carubv10008258m, or paste a list";
} else if ($_POST['filter1'] == "Eutrema_salsugineum") {
$sboxplaceholder = "Enter gene or isoform ID, e.g. Thhalv10012606m, Thhalv10006748m, or paste a list";
} else if ($_POST['filter1'] == "Tarenaya_hassleriana") {
$sboxplaceholder = "Enter gene or isoform ID, e.g. XM_010527257.2, XM_010538056.2, or paste a list";
} else if ($_POST['filter1'] == "Medicago_truncatula") {
$sboxplaceholder = "Enter gene or isoform ID, e.g. Medtr1g013360, Medtr1g024025, or paste a list";
} else if ($_POST['filter1'] == "Brachypodium_distachyon") {
$sboxplaceholder = "Enter gene or isoform ID, e.g. Bradi1g31200.1, Bradi5g25157.1, or paste a list of IDs";
};

}; # close count condition

}

?> 



<!-- ***********************************************************************
Setting up HTML "Head/Style" options
Loading javascript vizualisation libraries for generating plots ("Scripts")
Run javascripts for controling radio button, checkbox, select & text fields
Define filters for user input in "FORM" field
Generate output files
Define "Div's" for charts
************************************************************************ -->


<!DOCTYPE html>
<html lang="en">
  <meta http-equiv="content-type" content="text/html"; charset="utf-8"/>
  <meta charset="utf-8">
  <meta name="viewport" content="width=1024, user-scalable=yes">
  <meta name="Description" content="DevSeq plant web application: Plant comparative transcriptomics, plant gene expression evolution, expression atlas, isoforms, lncRNAs and circRNAs">


<head>

  <?php if ((!isset($_POST['searchquery']) || $_POST['searchquery'] == "") || $count==0){?>

    <title>DevSeq | Home</title>

  <?php } else if ((isset($_POST['searchquery'])) && $count>0){?>

    <title>DevSeq | Search results</title>

  <?php } ?>
  
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="author" content="Christoph Schuster">


<!-- ***********************************************************************
Loading css style sheets
************************************************************************ -->


  <!-- Link to DevSeq css stylesheet-->
  <link href="https://www.devseqplant.org/css/devseq/devseq_latest_20_01.css" rel="stylesheet" />

  <!-- Link to bootstrap bundle css stylesheet and grid css-->
  <link href="https://www.devseqplant.org/css/bootstrap/bootstrap_bundle_latest_less_970px.min.css" rel="stylesheet" />
  <link href="https://www.devseqplant.org/css/bootstrap/bootstrap-grid_cs.min.css" rel="stylesheet" />

  <!-- Link to font awesome css stylesheet-->
  <link href="https://www.devseqplant.org/css/fa/font-awesome_partial_bundle_cs.css" rel="stylesheet" />

  <!-- Load c3.css versions depending on selected species-->
  <?php if ($_POST['filter4'] == "line_chart" && $_POST['filter1'] == "Arabidopsis_thaliana") { ?>
  <link href="https://www.devseqplant.org/css/c3/c3.min_at.css" rel="stylesheet" />
  <?php } else if ($_POST['filter4'] == "line_chart" && $_POST['filter1'] != "Arabidopsis_thaliana") { ?>
  <link href="https://www.devseqplant.org/css/c3/c3.min_os.css" rel="stylesheet" />
  <?php } ?>


<!-- ***********************************************************************
Loading javascript vizualisation libraries for generating plots 
************************************************************************ -->


  <!-- Load either C3/D3.js or Plotly.js library depending on query -->
  <?php if (($_POST['filter4'] == "line_chart") && (isset($_POST['searchquery'])) && ($count > 0)) { ?> 
  <!-- Load d3.js and c3.js -->
  <script src="https://www.devseqplant.org/js/d3/d3.min.js"></script>
  <script src="https://www.devseqplant.org/js/c3/c3.min.js"></script>

  <?php } else if (($_POST['filter4'] == "heatmap") && (isset($_POST['searchquery'])) && ($count > 0)) { ?>
  <!-- Load plotly.js for heatmap plot -->
  <!-- Partial bundles at github.com/plotly/plotly.js/blob/master/dist/README.md -->
  <script src="https://www.devseqplant.org/js/plotly/plotly-cartesian-latest_45_3.min.js"></script>
  <?php } ?>


  <!-- Load jQuery from google CDN -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <!-- If CDN is down, load jQuery from local -->
  <script type="text/javascript">
    if (typeof jQuery == 'undefined') {
      document.write(unescape("%3Cscript src='https://www.devseqplant.org/js/jquery/jquery-3.3.1.min.js' type='text/javascript'%3E%3C/script%3E"));
    }
  </script>



  <!-- Load bootstrap, jQuery, FileSaver.js, Blob.js and css2pdf -->
  <script src="https://www.devseqplant.org/js/bootstrap/bootstrap_bundle_latest.min.js" defer></script>
  <script src="https://www.devseqplant.org/js/jquery/spin.js" defer></script>
  <script src="https://www.devseqplant.org/js/jquery/jquery.spin.js" defer></script>
  <script src="https://www.devseqplant.org/js/filesaver/FileSaver.js" defer></script>
  <script src="https://www.devseqplant.org/js/blob/Blob.js" defer></script>




</head>


<!-- ******************************************************************* -->
<!-- ***********************************************************************
HTML Body starts: wrapper = 1st level div
************************************************************************ -->
<!-- ******************************************************************* -->


<body>

<!-- Wrap all page content here -->
<div id="wrap">



  <!-- **************************************************************** -->
  <!-- ********************************************************************
  Navbar: 2nd level div
  ********************************************************************* -->
  <!-- **************************************************************** -->


  <nav class="navbar navbar-inverse" id="top-menu" role="navigation">

    <div class="container-fluid">

      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        
          <a class="navbar-brand" href="testindex.php"><span>Dev<b>Seq</b></span></a>     
      </div>
      <!-- End of Navbar Brand -->  

      <!-- Collapse navigation -->
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="nav navbar-nav centered-navbar"> 

        <!-- Begin of Mega Menu -->
        <li class="dropdown mega-dropdown active">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Data Analysis <span class="caret"></span></a>       
          <div class="dropdown-menu mega-dropdown-menu">
           <!-- Navbar Mega-Menu Content -->
           <div class="Mega_menu_Content">
            
            <!-- Navbar Mega-Menu Content -->
            <div class = "row masterrow">
              <!-- Begin Single Species Content -->
              <div class = "col-xs-9">
                <div class="Single_Species_Atlas">
                  <div class="SlSpExAt">
                    <div class="SlSpExAtFt">
                      Single Species Stranded Total RNA-Seq Expression Atlas
                    </div>
                  </div> 
                  <div class="SlSpExAtCnt">
                    <div class = "row">
                    <div class="col">
                      <div class="MMSwrap">
                        <a href="testindex.php" data-select="Arabidopsis_thaliana" class="menuspec" style="text-decoration: none">  
                          <div class="UpperSpcClass">
                            <div class="SlSpExAtTxt">
                              <span style="color:#1b1d1f"><i>Arabidopsis thaliana</i></span><br>
                              <span style="color:#7e8690">Col-0</span><br>
                              <span style="color:white">___________</span>
                            </div>
                            <div class="SlSpExAtImg">
                              
                              <img src="img/ATH_tin.jpg" class="img-responsive" alt="" style="border-radius:7px">
                            </div>
                          </div>
                        </a> 
                      </div> 
                    </div>
                    <div class="col">
                      <div class="MMSwrap">
                        <a href="testindex.php" data-select="Arabidopsis_lyrata" class="menuspec" style="text-decoration: none">  
                          <div class="UpperSpcClass">
                            <div class="SlSpExAtTxt">
                              <span style="color:#1b1d1f"><i>Arabidopsis lyrata</i></span><br>
                              <span style="color:#7e8690">MN47</span><br>
                              <span style="color:white">___________</span>
                            </div>
                            <div class="SlSpExAtImg">
                              
                              <img src="img/AL_tin.jpg" class="img-responsive" alt="" style="border-radius:7px">
                            </div>
                          </div>
                        </a> 
                      </div> 
                    </div>
                    <div class="col">
                      <div class="MMSwrap">
                        <a href="testindex.php" data-select="Brachypodium_distachyon" class="menuspec" style="text-decoration: none"> 
                          <div class="UpperSpcClass">
                            <div class="SlSpExAtTxt">
                              <span style="color:#1b1d1f"><i>Brachypodium distachyon</i></span><br>
                              <span style="color:#7e8690">Bd21-3</span><br>
                              <span style="color:white">___________</span>
                            </div>
                            <div class="SlSpExAtImg">
                              
                              <img src="img/BD_tin.jpg" class="img-responsive" alt="" style="border-radius:7px">
                            </div>
                          </div>
                        </a> 
                      </div> 
                    </div>
                    <div class="col">
                      <div class="MMSwrap">
                        <a href="testindex.php" data-select="Capsella_rubella" class="menuspec" style="text-decoration: none"> 
                          <div class="UpperSpcClass">
                            <div class="SlSpExAtTxt">
                              <span style="color:#1b1d1f"><i>Capsella rubella</i></span><br>
                              <span style="color:#7e8690">Mt.Gargano</span><br>
                              <span style="color:white">___________</span>
                            </div>
                            <div class="SlSpExAtImg">
                              
                              <img src="img/CR_tin.jpg" class="img-responsive" alt="" style="border-radius:7px">
                            </div>
                          </div>
                        </a> 
                      </div> 
                    </div>
                    
                    <div class="col">
                      <div class="MMSwrap">
                        <a href="testindex.php" data-select="Eutrema_salsugineum" class="menuspec" style="text-decoration: none"> 
                          <div class="UpperSpcClass">
                            <div class="SlSpExAtTxt">
                              <span style="color:#1b1d1f"><i>Eutrema salsugineum</i></span><br>
                              <span style="color:#7e8690">Shandong</span><br>
                              <span style="color:white">___________</span>
                            </div>
                            <div class="SlSpExAtImg">
                              
                              <img src="img/ES_tin.jpg" class="img-responsive" alt="" style="border-radius:7px">
                            </div>
                          </div>
                        </a> 
                      </div> 
                    </div>
                    <div class="col">
                      <div class="MMSwrap">
                        <a href="testindex.php" data-select="Medicago_truncatula" class="menuspec" style="text-decoration: none"> 
                          <div class="UpperSpcClass">
                            <div class="SlSpExAtTxt">
                              <span style="color:#1b1d1f"><i>Medicago truncatula</i></span><br>
                              <span style="color:#7e8690">A17</span><br>
                              <span style="color:white">___________</span>
                            </div>
                            <div class="SlSpExAtImg">
                              
                              <img src="img/MT_tin.jpg" class="img-responsive" alt="" style="border-radius:7px">
                            </div>
                          </div>
                        </a> 
                      </div> 
                    </div>
                    <div class="col">
                      <div class="MMSwrap">
                        <a href="testindex.php" data-select="Tarenaya_hassleriana" class="menuspec" style="text-decoration: none"> 
                          <div class="UpperSpcClass">
                            <div class="SlSpExAtTxt">
                              <span style="color:#1b1d1f"><i>Tarenaya hassleriana</i></span><br>
                              <span style="color:#7e8690">ES1100</span><br>
                              <span style="color:white">___________</span>
                            </div>
                            <div class="SlSpExAtImg">
                              
                              <img src="img/TH_tin.jpg" class="img-responsive" alt="" style="border-radius:7px">
                            </div>
                          </div>
                        </a> 
                      </div> 
                    </div>
                    </div>
                    </div>
                  </div>
                
              </div><!-- End Single Species Content -->

              <div class = "col-xs-3">
                <div class="Integrative_Transcriptome_Analysis">
                  <div class="IntTransA">
                    <div class="SlSpExAtFt">
                      Integrative Transcriptome Analysis
                    </div>
                  </div>
                  <div class="SlSpExAtIc">
                    <div class = "row">
                    <div class="col-xs-4">
                      <div class="MMCwrap">
                        <a href="development.html" class="menuspec" style="text-decoration: none"> 
                          <div class="UpperSpcClass">
                            <div class="SlSpExAtTxt">

                              <span style="color:#1b1d1f">1-1&nbsportholog expression</span><br>
                              <span style="color:white">Spacer</span><br>
                              <span style="color:white">___________</span>

                            </div>
                            <div class="SlSpExAtImg">
                              <div class="MMinfoicn"><img src="img/icons8-info_fin2.svg" class="MMinfoiimg" title="1-1 ortholog expression | Orthology Inference: BLAST best reciprocal hit">
                              </div>
                              <img src="img/1-1_orthologs_tin.jpg" class="img-responsive" alt="" style="border-radius:7px">
                            </div>
                          </div>
                        </a> 
                      </div> 
                    </div>
                    <div class = "col-xs-4">
                      <div class="MMCwrap">
                        <a href="development.html" class="menuspec" style="text-decoration: none"> 
                          <div class="UpperSpcClass">
                            <div class="SlSpExAtTxt">

                              <span style="color:#1b1d1f">Coding&nbspsense/<br>cis&#8209NAT&nbsppairs</span><br>
                              <span style="color:white">Spacer</span><br>
                              <span style="color:white">___________</span>

                            </div>
                            <div class="SlSpExAtImg">
                              <div class="MMinfoicn"><img src="img/icons8-info_fin2.svg" class="MMinfoiimg" title="Expression of protein-coding sense/natural antisense transcript (cis-NAT) pairs">
                              </div>
                              <img src="img/cis_NAT_pairs_tin.jpg" class="img-responsive" alt="" style="border-radius:7px">
                            </div>
                          </div>
                        </a> 
                      </div> 
                    </div>
                    <div class="col-xs-4">
                      <div class="MMCwrap">
                        <a href="development.html" class="menuspec" style="text-decoration: none"> 
                          <div class="UpperSpcClass">
                            <div class="SlSpExAtTxt">

                              <span style="color:#1b1d1f">DevSeq-At<br>GenExpress</span><br>
                              <span style="color:white">Spacer</span><br>
                              <span style="color:white">___________</span>

                            </div>
                            <div class="SlSpExAtImg">
                              <div class="MMinfoicn"><img src="img/icons8-info_fin2.svg" class="MMinfoiimg" title="Comparative analysis of DevSeq RNA-Seq and AtGenExpress genome array Arabidopsis thaliana gene expression data">
                              </div>
                              <img src="img/DevSeq_ATGE_tin.jpg" class="img-responsive" alt="" style="border-radius:7px">
                            </div>
                          </div>
                        </a> 
                      </div> 
                    </div>
                    </div>
                    
                    <div class="col-xs-12">
                      <div class="MMwrap">
                      </div> 
                    </div>
                  </div>
                </div>
              </div><!-- End Comparative Transcriptome Content -->
            </div><!-- Close bootstrap "row" -->

            <!-- footerinner -->
            <div class = "Mega_Menu_Lowerspacer">
              <!-- parent -->
              <div class = "Mega_Menu_LowerspacerTxt">
                <!-- child num1 -->
                <div class="childmmf MMnum1"><a href="testindex.php" title="Go to Home" ><font color="#717577">DevSeq</font></a><font color="#717577">&nbsp/</font>&nbspData Analysis
                </div>
                <!-- child num3 -->
                <div class="childmmf MMnum2">
                  <div class = "MMchild2lnk">
                  <font color="#0d0e0f">More information on: &nbsp&nbsp</font>
                    <div class='hreflinks15'><a class='hreflinks13'><span>
                      <a class='hreflinks13' href="methods.html" title="Go to Data Analysis Methods">Data Analysis Methods</a>
                      <svg class="fa_external_link" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><path d="M384 32c35.3 0 64 28.7 64 64V416c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V96C0 60.7 28.7 32 64 32H384zM160 144c-13.3 0-24 10.7-24 24s10.7 24 24 24h94.1L119 327c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l135-135V328c0 13.3 10.7 24 24 24s24-10.7 24-24V168c0-13.3-10.7-24-24-24H160z"/></svg>
                    </span></a></div>
                    &nbsp &nbsp
                    <div class='hreflinks15'><a class='hreflinks13'><span>
                      <a class='hreflinks13' href="datasets.html" title="Go to Datasets">Datasets</a>
                      <svg class="fa_external_link" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><path d="M384 32c35.3 0 64 28.7 64 64V416c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V96C0 60.7 28.7 32 64 32H384zM160 144c-13.3 0-24 10.7-24 24s10.7 24 24 24h94.1L119 327c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l135-135V328c0 13.3 10.7 24 24 24s24-10.7 24-24V168c0-13.3-10.7-24-24-24H160z"/></svg>
                    </span></a></div>
                  </div>
                </div>
              </div><!-- Close "Mega_Menu_LowerspacerTxt" -->
            </div><!-- Close "Mega_Menu_Lowerspacer" -->
           </div><!-- Close "Mega_menu_Content" -->
           <!-- footerborder -->
           <div class = "Mega_Menu_Borderspacer">
           </div>
          </div><!-- End of "mega-dropdown-menu" -->
        </li><!-- End of "mega-dropdown active" -->

        <li><a href="datasets.html"><span>Datasets</span></a>
        </li> 
        </ul>
        <ul class="nav navbar-nav navbar-right">
        <!-- Define right navbar links here --> 
        <li ><a href="https://github.com/schustischuster" target="_blank" rel="noopener" title="DevSeq on GitHub" class="fa_github_class"><span class = 'hreflinks6'><svg class="fa fa-github" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 496 512"><path d="M165.9 397.4c0 2-2.3 3.6-5.2 3.6-3.3.3-5.6-1.3-5.6-3.6 0-2 2.3-3.6 5.2-3.6 3-.3 5.6 1.3 5.6 3.6zm-31.1-4.5c-.7 2 1.3 4.3 4.3 4.9 2.6 1 5.6 0 6.2-2s-1.3-4.3-4.3-5.2c-2.6-.7-5.5.3-6.2 2.3zm44.2-1.7c-2.9.7-4.9 2.6-4.6 4.9.3 2 2.9 3.3 5.9 2.6 2.9-.7 4.9-2.6 4.6-4.6-.3-1.9-3-3.2-5.9-2.9zM244.8 8C106.1 8 0 113.3 0 252c0 110.9 69.8 205.8 169.5 239.2 12.8 2.3 17.3-5.6 17.3-12.1 0-6.2-.3-40.4-.3-61.4 0 0-70 15-84.7-29.8 0 0-11.4-29.1-27.8-36.6 0 0-22.9-15.7 1.6-15.4 0 0 24.9 2 38.6 25.8 21.9 38.6 58.6 27.5 72.9 20.9 2.3-16 8.8-27.1 16-33.7-55.9-6.2-112.3-14.3-112.3-110.5 0-27.5 7.6-41.3 23.6-58.9-2.6-6.5-11.1-33.3 2.6-67.9 20.9-6.5 69 27 69 27 20-5.6 41.5-8.5 62.8-8.5s42.8 2.9 62.8 8.5c0 0 48.1-33.6 69-27 13.7 34.7 5.2 61.4 2.6 67.9 16 17.7 25.8 31.5 25.8 58.9 0 96.5-58.9 104.2-114.8 110.5 9.2 7.9 17 22.9 17 46.4 0 33.7-.3 75.4-.3 83.6 0 6.5 4.6 14.4 17.3 12.1C428.2 457.8 496 362.9 496 252 496 113.3 383.5 8 244.8 8zM97.2 352.9c-1.3 1-1 3.3.7 5.2 1.6 1.6 3.9 2.3 5.2 1 1.3-1 1-3.3-.7-5.2-1.6-1.6-3.9-2.3-5.2-1zm-10.8-8.1c-.7 1.3.3 2.9 2.3 3.9 1.6 1 3.6.7 4.3-.7.7-1.3-.3-2.9-2.3-3.9-2-.6-3.6-.3-4.3.7zm32.4 35.6c-1.6 1.3-1 4.3 1.3 6.2 2.3 2.3 5.2 2.6 6.5 1 1.3-1.3.7-4.3-1.3-6.2-2.2-2.3-5.2-2.6-6.5-1zm-11.4-14.7c-1.6 1-1.6 3.6 0 5.9 1.6 2.3 4.3 3.3 5.6 2.3 1.6-1.3 1.6-3.9 0-6.2-1.4-2.3-4-3.3-5.6-2z"/></svg></span></a></li>     
        <li ><a href="release-notes.html" title="Release Notes" class="fa_ellipsis_class"><span class = 'hreflinks6'><svg class="fa fa-pencil-square-o" xmlns="http://www.w3.org/2000/svg" height="0.95em" viewBox="0 0 512 512"><path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z"/></svg></span></a>
        </li>   
        <li ><a href="contact.html" title="Contact" class="fa_envelope_class"><span class = 'hreflinks6'><svg class="fa fa-envelope icon" xmlns="http://www.w3.org/2000/svg" height="1.1em" viewBox="4 -10 512 512"><path d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"/></svg><svg class="fa fa-envelope-open icon" xmlns="http://www.w3.org/2000/svg" height="1.1em" viewBox="4 -10 512 512"><path d="M255.4 48.2c.2-.1 .4-.2 .6-.2s.4 .1 .6 .2L460.6 194c2.1 1.5 3.4 3.9 3.4 6.5v13.6L291.5 355.7c-20.7 17-50.4 17-71.1 0L48 214.1V200.5c0-2.6 1.2-5 3.4-6.5L255.4 48.2zM48 276.2L190 392.8c38.4 31.5 93.7 31.5 132 0L464 276.2V456c0 4.4-3.6 8-8 8H56c-4.4 0-8-3.6-8-8V276.2zM256 0c-10.2 0-20.2 3.2-28.5 9.1L23.5 154.9C8.7 165.4 0 182.4 0 200.5V456c0 30.9 25.1 56 56 56H456c30.9 0 56-25.1 56-56V200.5c0-18.1-8.7-35.1-23.4-45.6L284.5 9.1C276.2 3.2 266.2 0 256 0z"/></svg><span></span></a></li>
        <li ><a href="about.html"><div id="aboutaes"><span class = 'hreflinks9'>About</span></div></a></li> 
        </ul>
      </div><!-- End of Collapse Navigation -->
    </div>
  </nav>
  <!-- End of Navbar -->



  <!-- JavaScipt for MegaMenü dropdown slide -->
  <script type="text/javascript">  
    $(document).ready(function(){
      $(".dropdown").click(            
            function() {
               $('.dropdown-menu', this).not('.in .dropdown-menu').stop(true,true).slideToggle(200, "swing");
               $(this).toggleClass('open');        
           }
      );
    });
  </script>



  <!-- JavaScipt for writing Mega Menu selected link data (species) to local storage -->
  <script type="text/javascript"> 
    $(document).ready(function(){ 
      $('a[href="testindex.php"]').click(
          function () {
            var SpeciesToStore = $(this).data('select');
            localStorage.setItem("storelinkInput", SpeciesToStore);
          });
      });
  </script>



  <!-- ***************************************************************** -->
  <!-- *********************************************************************
  Start controlplot container here: 2nd level div
  ********************************************************************** -->
  <!-- ***************************************************************** -->



  <div id="controlplot_container">



    <!-- **************************************************************** -->
    <!-- ********************************************************************
    Define flexitop - 3rd level div
    ********************************************************************* -->
    <!-- **************************************************************** -->


    <div class = "flexitop" id="fadeaway">
    </div>


  

    <!-- **************************************************************** -->
    <!-- ********************************************************************
    Start Search page content: only visible if no result - 3rd level div
    ********************************************************************* -->
    <!-- **************************************************************** -->


    <!-- Initially load C3/D3.js and Plotly.js libraries on search landing page to put them into browser cache if not already there - defered loading to let page parse first-->
    <?php if (!isset($_POST['searchquery'])){?> 
    <!-- Load d3.js and c3.js -->
    <script src="https://www.devseqplant.org/js/d3/d3.min.js" defer></script>
    <script src="https://www.devseqplant.org/js/c3/c3.min.js" defer></script>
    <!-- Partial bundles at github.com/plotly/plotly.js/blob/master/dist/README.md -->
    <script src="https://www.devseqplant.org/js/plotly/plotly-cartesian-latest_45_3.min.js" defer></script>
    <?php } ?>


    <!--/start php condition for processing start search landing side-->
    <?php if ((!isset($_POST['searchquery']) || $_POST['searchquery'] == "") || $count==0){?>


    <!-- This div is only visible if no search was done (=single species gene expression map start page) -->
    <div class = "reqcontent"
      <?php if ((!isset($_POST['searchquery']) || $_POST['searchquery'] == "") || $count==0){?> style="display: inline" <?php } 
      else {?> style="display: none"<?php }?> >

      <div class = "reqinnercontent">
        <div class = "reqinnercontentinner">
          <div class = "titletextreq">
          </div>
        </div>

        <table></table><table></table><table></table><table></table><table></table>


        <div class = "col">
        <div id = "startsrcheader">  
        Gene&nbspExpression&nbspAtlas  
        </div>
        <div class = startsrchctr>
          <form id="devseqform" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="selsearchwrapperstr">
              <div class=searchtextsrt>
              Search
              </div>
              <div class=sboxbackground>
                <div class="custom-selectsrt"> <!--/this sets the width of both select and input boxes-->
                  <select name="filter1" id="selectorsrt">
                  <option value="Arabidopsis_thaliana" <?php if ($_POST['filter1'] == "Arabidopsis_thaliana") echo 'selected';?> value = "Arabidopsis_thaliana" >Arabidopsis thaliana</font></option>
                  <option value="Arabidopsis_lyrata" <?php if ($_POST['filter1'] == "Arabidopsis_lyrata") echo 'selected';?> value = "Arabidopsis_lyrata" >Arabidopsis lyrata</option>
                  <option value="Brachypodium_distachyon" <?php if ($_POST['filter1'] == "Brachypodium_distachyon") echo 'selected';?> value = "Brachypodium_distachyon">Brachypodium distachyon</option>
                  <option value="Capsella_rubella" <?php if ($_POST['filter1'] == "Capsella_rubella") echo 'selected';?> value = "Capsella_rubella" >Capsella rubella</option>
                  <option value="Eutrema_salsugineum" <?php if ($_POST['filter1'] == "Eutrema_salsugineum") echo 'selected';?> value = "Eutrema_salsugineum" >Eutrema salsugineum</option>
                  <option value="Medicago_truncatula" <?php if ($_POST['filter1'] == "Medicago_truncatula") echo 'selected';?> value = "Medicago_truncatula" >Medicago truncatula</option>
                  <option value="Tarenaya_hassleriana" <?php if ($_POST['filter1'] == "Tarenaya_hassleriana") echo 'selected';?> value = "Tarenaya_hassleriana" >Tarenaya hassleriana</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="selsearchwrapperstr">
              <div class=searchtext2srt>
              for
              </div>
              <div class="search-form">
                <div class="SBoxsrt">
                  <div class="right-inner-addonsrt" id="rightinneraddonsrt_id">
                  <input name="searchquery" type="text" autofocus="autofocus" id="sfqsrt" size="35" maxlength="100000" class="tftextinput2" placeholder= "<?php echo $sboxplaceholder; ?>" value= "<?php if((isset($_POST['searchquery'])) && $_POST['searchquery'] != "") {echo $searchquery;} ?>" />
                  <div class="tooltipwrapper2" style="display:inline-block;"><div class="searchinfo2div"><a class="fa-searchinfo2d"><span style="text-decoration: none" id="fasearchinfo2_id" class="fa_searchinfo_class" ><svg class="fa-searchinfo2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="1.28em" height="1.28em" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
                    <g>
                    <path fill="#7D8284" d="M50,6.99C26.27,6.99,6.99,26.27,6.99,50c0,23.729,19.28,43.011,43.01,43.011 c23.729,0,43.011-19.281,43.011-43.011C93.011,26.27,73.729,6.99,50,6.99z"/>
                    <path fill="#FFFFFF" d="M50,11.512c21.279,0,38.488,17.209,38.488,38.488c0,21.279-17.209,38.488-38.488,38.488 c-21.279,0-38.488-17.209-38.488-38.488C11.512,28.721,28.721,11.512,50,11.512z"/>
                    <g>
                      <circle cx="50" cy="31.708" r="5.75"/>
                      <polygon points="40.95,45.638 40.95,49.046 43.212,49.046 45.475,49.046 45.475,71.212 43.212,71.212 40.95,71.212 40.95,74.621 43.212,74.621 45.475,74.621 54.525,74.621 56.788,74.621 59.05,74.621 59.05,71.212 56.788,71.212 54.525,71.212 54.525,45.638 52.263,45.638 43.212,45.638"/>
                    </g></g></svg></span></a></div>
                      <div class="tooltipsrcsrt" id="tooltipsrcsrtid">
                        <b>Input requirements:</b>
                        Multiple identifiers or gene symbols must be seperated with an empty space, comma, or semicolon.
                      </div>
                    </span>
                    </div>
                  </div>
                </div>
              </div>
              <div>
              <button type="submit" class="SButtonsrt" name="submit" id="SubmBtn" ><svg class="fa-searchiconsrt" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg></button>
              </div>
            </div><!--/close "selsearchwrapper" start search side-->




            <!-- Load "storelinkInput" variable from local storage -->
            <script type="text/javascript">
              var selectorsrt = $('#selectorsrt'); 
              const array = ["Arabidopsis_thaliana", "Arabidopsis_lyrata", "Capsella_rubella", "Eutrema_salsugineum", "Tarenaya_hassleriana", "Medicago_truncatula", "Brachypodium_distachyon"];

                selectorsrt.val(localStorage.getItem("storelinkInput"));

                if (! array.includes(localStorage.getItem("storelinkInput"))) {
                  selectorsrt.val("Arabidopsis_thaliana")
                  };
            </script>


            <!-- JavaScript to control select box placeholder -->
            <script type="text/javascript">  
              var placeholderText = {
                "Arabidopsis_thaliana": "Enter gene, isoform ID, or symbol, e.g. AT5G10720, PIN1, or paste a list of identifiers",
                "Arabidopsis_lyrata": "Enter gene or isoform ID, e.g. AL6G21260.t1, AL1G32580.t1, or paste a list of IDs",
                "Brachypodium_distachyon": "Enter gene or isoform ID, e.g. Bradi1g31200.1, Bradi5g25157.1, or paste a list of IDs",
                "Capsella_rubella": "Enter gene or isoform ID, e.g. Carubv10003739m, Carubv10008258m, or paste a list",
                "Eutrema_salsugineum": "Enter gene or isoform ID, e.g. Thhalv10012606m, Thhalv10006748m, or paste a list",
                "Medicago_truncatula": "Enter gene or isoform ID, e.g. Medtr1g013360, Medtr1g024025, or paste a list",
                "Tarenaya_hassleriana": "Enter gene or isoform ID, e.g. XM_010527257.2, XM_010538056.2, or paste a list"
              };
              var sfqsrtid = $("#sfqsrt");
              $(document).ready(function(){ 
              sfqsrtid.attr('placeholder', placeholderText[$(this).find(':selected').val()]);
              });
              $("#selectorsrt").on("change", function () {
              sfqsrtid.attr('placeholder', placeholderText[$(this).find(':selected').val()]);
              });
            </script>



            <!-- Example ID button -->
            <div class = srtsrcexpl>
            <input type="button" value="Show example" class = 'hreflinks10' id="addexid"/>
            </div>



            <!-- Search Settings start search page -->
            <div>
            <form id="devseqform" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
              <div>
                <div class="some-class_srt">
                  <div class = "srtsrcpargridfst">
                    <div class = srtsrctitle><b>Expression estimation</b></div>
                    <table></table>
                    &nbsp <span display:inline-block;>
                    <input type="hidden" name="filter5" value="0">
                    <input type = "radio" name="filter2" value="gene_level" id="genelev" <?php if (isset($_POST['filter2']) && $_POST['filter2'] == 'gene_level') echo 'checked="checked"';?> value="gene_level" checked>
                    <label for="genelev">Gene-level</label>
                    <table></table>
                    &nbsp <input type = "radio" name="filter2" value="isoform_level" id="isoformlev" <?php if (isset($_POST['filter2']) && $_POST['filter2'] == 'isoform_level') echo 'checked="checked"';?> value="isoform_level">
                    <label for="isoformlev">Isoform-level</label>
                  </div>
                  <div class = "srtsrcpargrid">
                    <div class = srtsrctitle><b>Transformation (opt.)</b></div>
                    <table></table>
                    <div id="radiocbsrt" onclick="cbclicksrt(event)">
                      <div class="cbform-group">
                      &nbsp  <input type="checkbox" class="checktoradio" name="filter5" value="1" id="cb1" noneoption="true"<?php if ($_POST['filter5'] == "1") echo 'checked';?>><label for="cb1"> log2</label>
                      </div>
                     <div class="cbform-group">
                      &nbsp <input type="checkbox" class="checktoradio" name="filter5" value="2" id="cb2" noneoption="true"<?php if ($_POST['filter5'] == "2") echo 'checked';?>><label for="cb2"> min-max (RE)&nbsp</label>
                        <div class="tooltipwrapper" style="display:inline-block;"><span class = 'hreflinks11' ><svg class="fa-searchinfo3" xmlns="http://www.w3.org/2000/svg" height="0.95em" viewBox="0 0 512 512"><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM216 336h24V272H216c-13.3 0-24-10.7-24-24s10.7-24 24-24h48c13.3 0 24 10.7 24 24v88h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H216c-13.3 0-24-10.7-24-24s10.7-24 24-24zm40-208a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"/></svg></span>
                          <div class = "tooltipsrtbridge"></div>
                          <div class="tooltipsrt">In <b>min-max feature scaling</b>, the expression data of each transcript is linearly rescaled to the unit interval [0, 1].</font>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class = "srtsrcpargridlst">
                    <div class = srtsrctitle><b>Select chart type</b></div>
                    <table></table>
                    &nbsp <input type = "radio" name="filter4" value="line_chart" id="radio1srt" noneoption="true" <?php if (isset($_POST['filter4']) && $_POST['filter4'] == 'line_chart') echo 'checked="checked"';?> value="line_chart" value = "line_chart" checked >
                    <label for="radio1srt"> Line Chart</label>
                    <table></table>
                    &nbsp <input type = "radio" name="filter4" value="heatmap" id="radio2srt" <?php if (isset($_POST['filter4']) && $_POST['filter4'] == 'heatmap') echo 'checked="checked"';?> value = "heatmap" >
                    <label for="radio2srt"> Heatmap</label>
                  </div>
                </div>
              </div>
            </form>
            </div>
          </div><!--/close "startsrchctr"-->

          <!--/OPTIONAL: Link to Comparative Transcriptome Atlas
          <div class = srtsrcexpllw>
            <div class = 'hreflinks12'><a ><span style="text-decoration: none"><i class="fa fa-external-link" aria-hidden="true"></i></span>
            </div>
            <div><a class = 'hreflinks10'>Comparative transcriptome analysis</a>
            </div>
          </div>
          -->
        <div id="srtsrcresult">
          <div id="srtsrcresultinner" <?php if (!isset($_POST['searchquery'])){?> style="display: none!important" <?php } ?> >
            <?php if ((isset($_POST['searchquery'])) && ($_POST['searchquery'] != "") && ($count==0)) {
              echo "No entities found for your query";
            } 
            else if ((isset($_POST['searchquery'])) && ($_POST['searchquery'] == "")) {
              echo "Enter identifier or gene symbol";
            } 
            ?>
          </div>
        </div>
        </div><!--/close "col" start search side-->
      </div><!--/close  "reqinnercontent" start search side-->
    </div><!--/close "reqcontent" start search side-->


    <!-- Set loading bar div for result page with large number of entities -->
    <!-- For Chrome | Pre-load loading spinner to cache but do not show it -->
    <?php if (((strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') !== false) && (strpos($_SERVER['HTTP_USER_AGENT'], 'OPR') == false))){?>

      <!-- display:none; hides element like visibility: hidden; -->
      <!-- BUT: it also removes it from the layout so it doesn't take up any space -->
      <div id="load" style="display: none;"></div>
                
    <?php } ?> <!--/close php condition for loading bar div -->


    <!-- JavaScipt for example ID text input triggered after example ID button onclick event-->
    <script type="text/javascript">  
      document.getElementById("addexid").addEventListener('click', function () {
        var text = document.getElementById('sfqsrt');
        if(document.getElementById('selectorsrt').value=='Arabidopsis_thaliana') {
        text.value = 'AT5G10720, AT1G19850';
        text.focus();
        document.getElementById('genelev').checked = true;
        }
        else if (document.getElementById('selectorsrt').value=='Arabidopsis_lyrata') {
          text.value = 'AL6G21260.t1, AL1G32580.t1';
          text.focus();
        document.getElementById('genelev').checked = true;
        }
        else if (document.getElementById('selectorsrt').value=='Capsella_rubella') {
          text.value = 'Carubv10003739m, Carubv10008258m';
          text.focus();
        document.getElementById('genelev').checked = true;
        }
        else if (document.getElementById('selectorsrt').value=='Eutrema_salsugineum') {
          text.value = 'Thhalv10012606m, Thhalv10006748m';
          text.focus();
        document.getElementById('genelev').checked = true;
        }
        else if (document.getElementById('selectorsrt').value=='Tarenaya_hassleriana') {
          text.value = 'XM_010527257.2, XM_010538056.2';
          text.focus();
        document.getElementById('genelev').checked = true;
        }
        else if (document.getElementById('selectorsrt').value=='Medicago_truncatula') {
          text.value = 'Medtr1g013360, Medtr1g024025';
          text.focus();
        document.getElementById('genelev').checked = true;
        }
        else {
          text.value = 'Bradi1g31200.1, Bradi5g25157.1';
          text.focus();
        document.getElementById('genelev').checked = true;
        }
      });
    </script>


    <!-- JavaScript to clear input box upon select box option change -->
    <script type="text/javascript">  
      $("#selectorsrt").on("change", function () {
        $("#sfqsrt").val('');
      });
    </script>


    <?php } ?> <!--/close php condition for processing start search landing side-->




    <!-- *********************************************************************** -->
    <!-- ***************************************************************************
    Results page content: only visible if search query gives result - 3rd level div
    **************************************************************************** -->
    <!-- *********************************************************************** -->


    <!--/start php condition for processing result page-->
    <?php if ((isset($_POST['searchquery'])) && $count>0){?>

    <div class = "col-md-12 content"
    <?php if ((!isset($_POST['searchquery']) || $_POST['searchquery'] == "") || $count==0){?> style="display: none" <?php } ?> >



      <!-- ********************************************************************
      Define select box, search field and submit buttom - 4th level div
      ********************************************************************* -->


      <div class = "col-sm-12 col-md-12 col-lg-12 col-xl-2" > 
      </div> 
      <div class = "col-sm-12 col-md-12 col-lg-12 col-xl-10">

      <form id="devseqform" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div id="selsearchwrapper">
         <div class=searchtext>
          Search
         </div>
         <div class=sboxbackground>
           <div class="custom-select">
              <select name="filter1" id="selector">
               <option value="Arabidopsis_thaliana" <?php if ($_POST['filter1'] == "Arabidopsis_thaliana") echo 'selected';?> value = "Arabidopsis_thaliana" >Arabidopsis thaliana</font></option>
                <option value="Arabidopsis_lyrata" <?php if ($_POST['filter1'] == "Arabidopsis_lyrata") echo 'selected';?> value = "Arabidopsis_lyrata" >Arabidopsis lyrata</option>
                <option value="Brachypodium_distachyon" <?php if ($_POST['filter1'] == "Brachypodium_distachyon") echo 'selected';?> value = "Brachypodium_distachyon">Brachypodium distachyon</option>
               <option value="Capsella_rubella" <?php if ($_POST['filter1'] == "Capsella_rubella") echo 'selected';?> value = "Capsella_rubella" >Capsella rubella</option>
                <option value="Eutrema_salsugineum" <?php if ($_POST['filter1'] == "Eutrema_salsugineum") echo 'selected';?> value = "Eutrema_salsugineum" >Eutrema salsugineum</option>
                <option value="Medicago_truncatula" <?php if ($_POST['filter1'] == "Medicago_truncatula") echo 'selected';?> value = "Medicago_truncatula" >Medicago truncatula</option>
                <option value="Tarenaya_hassleriana" <?php if ($_POST['filter1'] == "Tarenaya_hassleriana") echo 'selected';?> value = "Tarenaya_hassleriana" >Tarenaya hassleriana</option>
             </select>
           </div>
          </div>

         <div class=searchtext2>
         for
         </div>
         <div class="search-form">
            <div class="SBox">
             <div class="right-inner-addon">
               <input name="searchquery" type="text" id="sfq" size="35" maxlength="100000" class="tftextinput2" placeholder= "<?php echo $sboxplaceholder; ?>" value= "<?php if((isset($_POST['searchquery'])) && $_POST['searchquery'] != "") {echo $searchquery;} ?>" />
                <div><a class="fa-searchinfo2d" title="Multiple identifiers must be seperated by an empty space, comma, or semicolon. If searching for an isoform, select isoform-level expression estimation." ><svg xmlns="http://www.w3.org/2000/svg" class="fa-searchinfo2rst" height="1em" viewBox="0 0 512 512"><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM216 336h24V272H216c-13.3 0-24-10.7-24-24s10.7-24 24-24h48c13.3 0 24 10.7 24 24v88h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H216c-13.3 0-24-10.7-24-24s10.7-24 24-24zm40-208a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"/></svg></a></div>
              </div>
            </div>
          </div>
          <div>
            <button type="submit" class="SButton" name="myBtn" type="submit" id="SubmBtn" ><svg class="fa-searchiconrst" xmlns="http://www.w3.org/2000/svg" height="0.95em" viewBox="0 0 512 512"><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg></button>
          </div>
        </div>
      </div>



      <!-- JavaScript to control select box placeholder -->
      <script type="text/javascript">  
        var placeholderText = {
          "Arabidopsis_thaliana": "Enter gene or isoform ID, or symbol, e.g. AT5G10720, AT1G19850.1, PIN1, or paste a list",
          "Arabidopsis_lyrata": "Enter gene or isoform ID, e.g. AL6G21260.t1, AL1G32580.t1, or paste a list of identifiers",
          "Brachypodium_distachyon": "Enter gene or isoform ID, e.g. Bradi1g31200.1, Bradi5g25157.1, or paste a list of identifiers",
          "Capsella_rubella": "Enter gene or isoform ID, e.g. Carubv10003739m, Carubv10008258m, or paste a list of IDs",
          "Eutrema_salsugineum": "Enter gene or isoform ID, e.g. Thhalv10012606m, Thhalv10006748m, or paste a list of IDs",
          "Medicago_truncatula": "Enter gene or isoform ID, e.g. Medtr1g013360, Medtr1g024025, or paste a list of IDs",
          "Tarenaya_hassleriana": "Enter gene or isoform ID, e.g. XM_010527257.2, XM_010538056.2, or paste a list of IDs"
        };

        $("#selector").on("change", function () {
        $("#sfq").attr('placeholder', placeholderText[$(this).find(':selected').val()]);
        });
      </script>



      <!-- ******************************************************************* -->
      <!-- ***********************************************************************
      Main col-md-12-grid and prmtpltcont - 4th and 5th level div
      ************************************************************************ -->
      <!-- ******************************************************************* -->

      <!-- col-md-12 grid system-->
      <div class = "col-md-12 content" id = "md12rsltpg">
        <!-- prmtpltcont div containing XL-2 Parameter and XL-10 Result divs-->
        <div class = prmtpltcont>
        <table></table>



          <!-- ******************************************************************* -->
          <!-- ***********************************************************************
          Filter and Plot div wrapper - 6th level div
          ************************************************************************ -->
          <!-- ******************************************************************* -->


          <!-- XL-2 grid -->

          <div class = "col-sm-12 col-md-12 col-lg-12 col-xl-2">

            <form id="devseqform" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
              <div>
                <div class="some-class">
                  <div class="some-class3">
                    <div class="some-class3inner">
                      <b>Search Parameters</b>
                    </div>
                    <div class = "parameterln">
                    </div>
                    <div class = "parameterln2">
                    </div>
                  </div>
                </div>
                <div class="some-classundr">
                  <div class = "rsltsrcpargridfst">
                    <div class = rsltsrctitle><b>Quantification level</b></div>
                    <table></table>
                    <input type="hidden" name="filter5" value="0">
                    &nbsp <input type = "radio" name="filter2" value="gene_level" id="gene_level_rp"<?php if (isset($_POST['filter2']) && $_POST['filter2'] == 'gene_level') echo 'checked="checked"';?> value="gene_level" checked><label for="gene_level_rp" > Gene-level</label>
                    <table></table>
                    &nbsp <input type = "radio" name="filter2" value="isoform_level" id="isoformlev_rp"<?php if (isset($_POST['filter2']) && $_POST['filter2'] == 'isoform_level') echo 'checked="checked"';?> value="isoform_level"><label for="isoformlev_rp" >Isoform-level</label>
                  </div>
                  <table></table>
                  <table></table>
                  <hr/>
                  <table></table>
                  <div class = "rsltsrcpargrid">
                    <div class = rsltsrctitle><b>Transformation (opt.)</b></div>
                    <table></table>
                    <div id="radiocb" onclick="cbclick(event)">
                      <div class="cbform-group">
                      &nbsp  <input type="checkbox" class="checktoradio" name="filter5" value="1" id="cb1" noneoption="true"<?php if ($_POST['filter5'] == "1") echo 'checked';?>><label for="cb1"> log2</label>
                      </div>
                      <div class="cbform-group">
                      &nbsp <input type="checkbox" class="checktoradio" name="filter5" value="2" id="cb2" noneoption="true"<?php if ($_POST['filter5'] == "2") echo 'checked';?>><label for="cb2"> min/max (RE)</label> 
                        <div class="tooltipwrapper" style="display:inline-block;"><span class = 'hreflinks11' ><svg class="fa-searchinfo4" xmlns="http://www.w3.org/2000/svg" height="1.0em" viewBox="0 0 512 512"><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM216 336h24V272H216c-13.3 0-24-10.7-24-24s10.7-24 24-24h48c13.3 0 24 10.7 24 24v88h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H216c-13.3 0-24-10.7-24-24s10.7-24 24-24zm40-208a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"/></svg></span>
                          <div class="tooltip">In min-max feature scaling, the data of each transcript is linearly rescaled to the unit interval [0, 1].</font>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <table></table>
                  <table></table>
                  <hr/>
                  <table></table>
                  <div class = "rsltsrcpargrid">
                    <div class = rsltsrctitle><b>Chart type</b></div>
                    <table></table>
                    &nbsp <input type = "radio" name="filter4" value="line_chart" id="radio1" noneoption="true" <?php if (isset($_POST['filter4']) && $_POST['filter4'] == 'line_chart') echo 'checked="checked"';?> value="line_chart" value = "line_chart" checked ><label for="radio1"> Line Chart</label>
                    <table></table>
                    &nbsp <input type = "radio" name="filter4" value="heatmap" id="radio2" <?php if (isset($_POST['filter4']) && $_POST['filter4'] == 'heatmap') echo 'checked="checked"';?> value = "heatmap" ><label for="radio2"> Heatmap</label>
                  </div>
                  <table></table>
                  <table></table>
                  <hr/>
                  <table></table>
                  <div class = "rsltsrcpargridlst">
                    <div class = rsltsrctitle><b>Cluster analysis</b></div>
                    <table></table>
                    <div class="cbform-group">
                    &nbsp <input type="checkbox" name="filter6" value="1" id="cb4" class="idcb" onclick="validate()" noneoption="false"<?php if ($_POST['filter6'] == "1") echo 'checked';?>><label for="cb4"> hclust heatmap</label>
                      <div class="tooltipwrapper" style="display:inline-block;"><span class = 'hreflinks11' ><svg class="fa-searchinfo5" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM216 336h24V272H216c-13.3 0-24-10.7-24-24s10.7-24 24-24h48c13.3 0 24 10.7 24 24v88h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H216c-13.3 0-24-10.7-24-24s10.7-24 24-24zm40-208a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"/></svg></span>
                        <div class="tooltipclust2"> Hierarchical clustering of expression profiles using the average-linkage method will be performed if multiple identifiers are submitted. See SciPy documentation for <a class = 'hreflinks14' href="https://docs.scipy.org/doc/scipy/reference/cluster.hierarchy.html" target="_blank" rel="noopener"><u>cluster.hierarchy</u></a>.</font>
                      </div>
                    </div>
                    <div  class = "rstrefreshspace"></div>
                    </div>
                  </div>  
                </div><!--/close "some-classinner"-->
                <button id="export_charts" class="btn btn-green" type="submit" <?php if ((!isset($_POST['searchquery']) || $_POST['searchquery'] == "") || $count==0){?> style="display: none" <?php } ?> style="text-decoration: none" class="tfbutton3"><svg  class="fa fa-refresh" xmlns="http://www.w3.org/2000/svg" height="1.0em" viewBox="0 0 512 512"><path d="M142.9 142.9c62.2-62.2 162.7-62.5 225.3-1L327 183c-6.9 6.9-8.9 17.2-5.2 26.2s12.5 14.8 22.2 14.8H463.5c0 0 0 0 0 0H472c13.3 0 24-10.7 24-24V72c0-9.7-5.8-18.5-14.8-22.2s-19.3-1.7-26.2 5.2L413.4 96.6c-87.6-86.5-228.7-86.2-315.8 1C73.2 122 55.6 150.7 44.8 181.4c-5.9 16.7 2.9 34.9 19.5 40.8s34.9-2.9 40.8-19.5c7.7-21.8 20.2-42.3 37.8-59.8zM16 312v7.6 .7V440c0 9.7 5.8 18.5 14.8 22.2s19.3 1.7 26.2-5.2l41.6-41.6c87.6 86.5 228.7 86.2 315.8-1c24.4-24.4 42.1-53.1 52.9-83.7c5.9-16.7-2.9-34.9-19.5-40.8s-34.9 2.9-40.8 19.5c-7.7 21.8-20.2 42.3-37.8 59.8c-62.2 62.2-162.7 62.5-225.3 1L185 329c6.9-6.9 8.9-17.2 5.2-26.2s-12.5-14.8-22.2-14.8H48.4h-.7H40c-13.3 0-24 10.7-24 24z"/></svg><span>Update chart</span></button>
              </div>
            </form>
          </div><!--/close "XL-2 grid"-->



          <!-- ******************************************************************* -->
          <!-- ***********************************************************************
          Define plot div - 6th level div
          ************************************************************************ -->
          <!-- ******************************************************************* -->


          <!-- XL-10 grid -->

                

          <div class = "col-sm-12 col-md-12 col-lg-12 col-xl-10">
            <div class = "maincontent" id="custHeightFix">
              <div class = "titletext" style="background-color: white">
                <div class = "titletextin">
                  <left>Single Species Transcriptome Atlas</left>
                </div>
              </div>

              <!-- div for search results and charts  -->
              <div class="some-class2">
                <table></table> 
                <table></table> 
                <table></table>
                <table></table> 
                <table></table> 
                <table></table>
                <table></table>

                <!-- Defining search results and line chart -->
                <div class=srcresout>
                  <div class = "searchouttxt">
                  <?php echo "<div class='serchoutputstyle' style ='color:#0b6227'>$search_output</div>"; ?>
                  <span class = 'hreflinks7'> 
                    <div class="tooltipwrapper" style="display:inline-block;">
                      <div> 
                      <span class = 'hreflinks11' class="tfbutton5"><svg xmlns="http://www.w3.org/2000/svg" class="fa-searchinfo7" height="1em" viewBox="0 0 512 512"><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM216 336h24V272H216c-13.3 0-24-10.7-24-24s10.7-24 24-24h48c13.3 0 24 10.7 24 24v88h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H216c-13.3 0-24-10.7-24-24s10.7-24 24-24zm40-208a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"/></svg></span>
                        <div class="tooltipsinglespec">
                          <div class="tooltiphead">Single Species Transcriptome Atlas
                          </div>
                          <div class="tooltipborder">
                          </div>
                          <table></table>
                          Mouse over plot to see sample information. .1 .2 and .3 represent biological replicates.
                        </div>
                      </div>
                    </div>
                  </span>
                  </div>

                  <!-- Comment out php condition for ortholog link for now until vizualization is built

                  <?php 
                  // Format ortholog link based on ortholog hits and number of entities found in single species atlas
                  if ($count == 1) {?>
                  <div class = rsltpgorthlink>
                    <div class = 'hreflinks12'>
                    <span style="text-decoration: none"><i class="fa fa-external-link" aria-hidden="true"></i></span>
                    </div>
                    <div class="tooltipwrapper" style="display:inline-block;">
                      <div><a class = 'hreflinks13'>Show ortholog expression</a>
                        <div class="tooltipsglspeccomplnk">
                          <div class="tooltiphead">Comparative Transcriptome Atlas
                          </div>
                          <div class="tooltipborder">
                          </div>
                          <table></table>
                          This locus has orthologs in other species. Click on link to show expression.
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php } 
                  // Format ortholog link based on ortholog hits and number of entities found in single species atlas
                  else if ($count > 1) {?>
                  <div class = rsltpgorthlink2>
                    <div class = 'hreflinks12'>
                    <span style="text-decoration: none"><i class="fa fa-external-link" aria-hidden="true"></i></span>
                    </div>
                    <div class="tooltipwrapper" style="display:inline-block;">
                      <div><a class = 'hreflinks13'>Show ortholog expression</a>
                        <div class="tooltipsglspeccomplnk">
                          <div class="tooltiphead">Comparative Transcriptome Atlas
                          </div>
                          <div class="tooltipborder">
                          </div>
                          <table></table>
                          One or more loci have orthologs in other species. Click on link to show expression.
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php } ?>

                  End of ortholog link condition -->


                </div><!--/close "srcresout" div -->

                <!-- div for title text line -->
                <div class = "titletextline">
                </div>

                <!-- div for line chart -->
                <div id="chart">
                </div> 



                <!-- line chart message: if too many query IDs, print notification -->
                <?php if ((isset($_POST['searchquery'])) && ($_POST['searchquery'] != "") && $_POST['filter4'] == "line_chart" && $_POST['filter1'] == "Arabidopsis_thaliana" && ($count > 20)){?>

                  <div id="lcnote">
                  <font color="#cc3623">Large number of entities found:</font><font color="#333399"> to display results, choose heatmap option and update chart.</font>
                
                <?php } ?> <!--/close php condition for line chart notification-->


                <!-- div for heatmap -->
                <div id="myDiv" >
                </div>  


                <!-- Set loading bar div for result page with large number of entities -->
                <!-- For Chrome -->
                <?php if ((isset($_POST['searchquery'])) && ($_POST['searchquery'] != "") && ($count > 100) && ((  (strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') !== false) && (strpos($_SERVER['HTTP_USER_AGENT'], 'OPR') == false)  )) ){?>

                  <div id="load"></div>
                
                <?php } ?> <!--/close php condition for loading bar div -->

             
                <!-- div for Javascript Spinner -->
                <table>
                <div id="dialog" title="Dialog Title">
                </div>
                <div id="spin">
                </div>

                <!-- div for lower spacer -->
                <div id="lowerspacer">
                <table></table>
                </div>



                <!-- ***********************************************************************
                Download data and display chart/colorscale buttons
                ************************************************************************ -->

                <!--/wrapper for download and display buttons-->
                <div class = "dlbtns">
                  <div class = "dlbtncont">

                    <!-- Define "download data and plot" links -->

                    <div class='dloptions' <?php if ((!isset($_POST['searchquery']) || $_POST['searchquery'] == "") || $count==0){?> style="display: none" <?php } ?> style="text-decoration: none" >
                    
                    <button id="export_charts" class="btn btn-gray-light" title="Download data as csv file" <?php if ((!isset($_POST['searchquery']) || $_POST['searchquery'] == "") || $count==0){?> style="display: none" <?php } ?> style="text-decoration: none" class="tfbutton3" onclick="download_csv_function();"><svg class="fa-download" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><path d="M288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32V274.7l-73.4-73.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l128 128c12.5 12.5 32.8 12.5 45.3 0l128-128c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L288 274.7V32zM64 352c-35.3 0-64 28.7-64 64v32c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V416c0-35.3-28.7-64-64-64H346.5l-45.3 45.3c-25 25-65.5 25-90.5 0L165.5 352H64zm368 56a24 24 0 1 1 0 48 24 24 0 1 1 0-48z"/></svg><span>Data</span></button>
                    
                    
                    <a href="data/devseq_sample_table.csv" download="devseq_sample_table.csv" Download!><button class="btn btn-gray-light" title="Download sample table as csv file" <?php if ((!isset($_POST['searchquery']) || $_POST['searchquery'] == "") || $count==0){?> style="display: none" <?php } ?> style="text-decoration: none"><svg class="fa-download" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><path d="M288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32V274.7l-73.4-73.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l128 128c12.5 12.5 32.8 12.5 45.3 0l128-128c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L288 274.7V32zM64 352c-35.3 0-64 28.7-64 64v32c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V416c0-35.3-28.7-64-64-64H346.5l-45.3 45.3c-25 25-65.5 25-90.5 0L165.5 352H64zm368 56a24 24 0 1 1 0 48 24 24 0 1 1 0-48z"/></svg><span>Sample table</span></button></a>
                    
                    


                      <!-- Define chart display buttons -->
                      <!-- Line chart option -->

                      <!-- Defining chart display buttons for Arabidopsis thaliana line chart -->
                      <div class = "lnchartbtns">
                        <?php if ($_POST['filter4'] == "line_chart" && $_POST['filter1'] == "Arabidopsis_thaliana"){?>
                        <div class='lchart' id="displaybtngroup" role="group" <?php if ((!isset($_POST['searchquery']) || $_POST['searchquery'] == "") || $count==0 || $count>50){?> style="display: none" <?php } ?> style="text-decoration: none" >
                          <font size="3">Chart format:</font>
                          <span class = 'lchartset1'>
                          <button id="displaydomain" class="btn-display active" title="Show domains" <?php if ((!isset($_POST['searchquery']) || $_POST['searchquery'] == "") || $count==0 || $count>50){?> style="display: none" <?php } ?> style="text-decoration: none" onclick="a_function();"><span>Domain</span></button>
                          </span>
                          <span class = 'lchartset2'>
                          <button id="displaygrid" class="btn-display" title="Show grid lines" <?php if ((!isset($_POST['searchquery']) || $_POST['searchquery'] == "") || $count==0 || $count>50){?> style="display: none" <?php } ?> style="text-decoration: none" onclick="b_function();"><span>Grid</span></button>
                          </span>
                          <span class = 'lchartset3'>
                          <button id="displayplain" class="btn-display" title="Display plain chart area" <?php if ((!isset($_POST['searchquery']) || $_POST['searchquery'] == "") || $count==0 || $count>50){?> style="display: none" <?php } ?> style="text-decoration: none" onclick="c_function();"><span>Plain</span></button>
                          </span>
                        </div> 
                        <?php } 
                        else if ($_POST['filter4'] == "line_chart" && $_POST['filter1'] != "Arabidopsis_thaliana"){?>
                    
                        <!-- Defining chart display buttons for non-Arabidopsis thaliana line chart -->
                        <div class='lchart' id="displaybtngroup" role="group" <?php if ((!isset($_POST['searchquery']) || $_POST['searchquery'] == "") || $count==0){?> style="display: none" <?php } ?> style="text-decoration: none" >
                          <font size="3">Chart format:</font>
                          <span class = 'lchartset2'>
                          <button id="displaygrid_noath" class="btn-display active" title="Show grid lines" <?php if ((!isset($_POST['searchquery']) || $_POST['searchquery'] == "") || $count==0){?> style="display: none" <?php } ?> style="text-decoration: none" onclick="d_function();"><span>Grid</span></button>
                          </span>
                          <span class = 'lchartset3'>
                          <button id="displayplain_noath" class="btn-display" title="Display plain chart area" <?php if ((!isset($_POST['searchquery']) || $_POST['searchquery'] == "") || $count==0){?> style="display: none" <?php } ?> style="text-decoration: none" onclick="e_function();"><span>Plain</span></button>
                          </span>
                        </div> 
                        <?php }
                        ?>
                      </div><!--/close div for line chart display buttons-->


                      <!-- Define chart display buttons -->
                      <!-- Heatmap option -->

                      <!-- Defining chart display buttons for Arabidopsis thaliana heatmap -->
                      <div class = "hmapbtns">
                        <?php if (($_POST['filter4'] == "heatmap" && ($count > 0) && $_POST['filter1'] == "Arabidopsis_thaliana" && $_POST['filter6'] != "1") || ($_POST['filter4'] == "heatmap" && $_POST['filter1'] == "Arabidopsis_thaliana" && $_POST['filter6'] == "1" && $count == 1)){?>
                        <div class='lchart' id="displaybtngroup" role="group" <?php if ((!isset($_POST['searchquery']) || $_POST['searchquery'] == "") || $count==0){?> style="display: none" <?php } ?> style="text-decoration: none" >
                          <font size="3">Colorscale:</font>
                          <span class = 'hmapset1'>
                          <button class="btn-display active" title="Show viridis colorscale" <?php if ((!isset($_POST['searchquery']) || $_POST['searchquery'] == "") || $count==0){?> style="display: none" <?php } ?> style="text-decoration: none" onclick="f_function();"><span>Vd</span></button>
                          </span>
                          <span class = 'hmapset2'>
                          <button class="btn-display" title="Show blue colorscale" <?php if ((!isset($_POST['searchquery']) || $_POST['searchquery'] == "") || $count==0){?> style="display: none" <?php } ?> style="text-decoration: none" onclick="g_function();"><span>Bu</span></button>
                          </span>
                          <span class = 'hmapset3'>
                          <button class="btn-display" title="Show red colorscale" <?php if ((!isset($_POST['searchquery']) || $_POST['searchquery'] == "") || $count==0){?> style="display: none" <?php } ?> style="text-decoration: none" onclick="h_function();"><span>Rd</span></button>
                          </span>
                          <span class = 'hmapset4'>
                          <button class="btn-display" title="Show green colorscale" <?php if ((!isset($_POST['searchquery']) || $_POST['searchquery'] == "") || $count==0){?> style="display: none" <?php } ?> style="text-decoration: none" onclick="i_function();"><span>Gn</span></button>
                          </span>
                          <span class = 'hmapset5'>
                          <button class="btn-display" title="Show red-yellow colorscale" <?php if ((!isset($_POST['searchquery']) || $_POST['searchquery'] == "") || $count==0){?> style="display: none" <?php } ?> style="text-decoration: none" onclick="j_function();"><span>RdY</span></button>
                          </span>
                          <span class = 'hmapset6'>
                          <button class="btn-display" title="Show yellow-red colorscale" <?php if ((!isset($_POST['searchquery']) || $_POST['searchquery'] == "") || $count==0){?> style="display: none" <?php } ?> style="text-decoration: none" onclick="k_function();"><span>YRd</span></button>
                          </span>
                        </div> 

                        <!-- Defining chart display buttons for Arabidopsis thaliana hclust heatmap -->
                        <?php } else if ($_POST['filter4'] == "heatmap" && ($count > 1) && $_POST['filter1'] == "Arabidopsis_thaliana"  && $_POST['filter6'] == "1"){?>
                        <div class='lchart' id="displaybtngroup" role="group" <?php if ((!isset($_POST['searchquery']) || $_POST['searchquery'] == "") || $count==0){?> style="display: none" <?php } ?> style="text-decoration: none" >
                          <font size="3">Colorscale:</font>
                          <span class = 'hmapset7'>
                          <button class="btn-display active" title="Show viridis colorscale" <?php if ((!isset($_POST['searchquery']) || $_POST['searchquery'] == "") || $count==0){?> style="display: none" <?php } ?> style="text-decoration: none" onclick="l_function();"><span>Vd</span></button>
                          </span>
                          <span class = 'hmapset8'>
                          <button class="btn-display" title="Show blue colorscale" <?php if ((!isset($_POST['searchquery']) || $_POST['searchquery'] == "") || $count==0){?> style="display: none" <?php } ?> style="text-decoration: none" onclick="m_function();"><span>Bu</span></button>
                          </span>
                          <span class = 'hmapset9'>
                          <button class="btn-display" title="Show red colorscale" <?php if ((!isset($_POST['searchquery']) || $_POST['searchquery'] == "") || $count==0){?> style="display: none" <?php } ?> style="text-decoration: none" onclick="n_function();"><span>Rd</span></button>
                          </span>
                          <span class = 'hmapset10'>
                          <button class="btn-display" title="Show green colorscale" <?php if ((!isset($_POST['searchquery']) || $_POST['searchquery'] == "") || $count==0){?> style="display: none" <?php } ?> style="text-decoration: none" onclick="o_function();"><span>Gn</span></button>
                          </span>
                          <span class = 'hmapset11'>
                          <button class="btn-display" title="Show red-yellow colorscale" <?php if ((!isset($_POST['searchquery']) || $_POST['searchquery'] == "") || $count==0){?> style="display: none" <?php } ?> style="text-decoration: none" onclick="p_function();"><span>RdY</span></button>
                          </span>
                          <span class = 'hmapset12'>
                          <button class="btn-display" title="Show yellow-red colorscale" <?php if ((!isset($_POST['searchquery']) || $_POST['searchquery'] == "") || $count==0){?> style="display: none" <?php } ?> style="text-decoration: none" onclick="q_function();"><span>YRd</span></button>
                          </span>
                        </div> 

                        <!-- Defining chart display buttons for non-Arabidopsis thaliana heatmap -->
                        <?php } else if (($_POST['filter4'] == "heatmap" && ($count > 0) && $_POST['filter1'] != "Arabidopsis_thaliana" && $_POST['filter6'] != "1") || ($_POST['filter4'] == "heatmap" && $_POST['filter1'] != "Arabidopsis_thaliana" && $_POST['filter6'] == "1" && $count == 1)){?>
                        <div class='lchart' id="displaybtngroup" role="group" <?php if ((!isset($_POST['searchquery']) || $_POST['searchquery'] == "") || $count==0){?> style="display: none" <?php } ?> style="text-decoration: none" >
                          <font size="3">Colorscale:</font>
                          <span class = 'hmapset13'>
                          <button class="btn-display active" title="Show viridis colorscale" <?php if ((!isset($_POST['searchquery']) || $_POST['searchquery'] == "") || $count==0){?> style="display: none" <?php } ?> style="text-decoration: none" onclick="r_function();"><span>Vd</span></button>
                          </span>
                          <span class = 'hmapset14'>
                          <button class="btn-display" title="Show blue colorscale" <?php if ((!isset($_POST['searchquery']) || $_POST['searchquery'] == "") || $count==0){?> style="display: none" <?php } ?> style="text-decoration: none" onclick="s_function();"><span>Bu</span></button>
                          </span>
                          <span class = 'hmapset15'>
                          <button class="btn-display" title="Show red colorscale" <?php if ((!isset($_POST['searchquery']) || $_POST['searchquery'] == "") || $count==0){?> style="display: none" <?php } ?> style="text-decoration: none" onclick="t_function();"><span>Rd</span></button>
                          </span>
                          <span class = 'hmapset16'>
                          <button class="btn-display" title="Show green colorscale" <?php if ((!isset($_POST['searchquery']) || $_POST['searchquery'] == "") || $count==0){?> style="display: none" <?php } ?> style="text-decoration: none" onclick="u_function();"><span>Gn</span></button>
                          </span>
                          <span class = 'hmapset17'>
                          <button class="btn-display" title="Show red-yellow colorscale" <?php if ((!isset($_POST['searchquery']) || $_POST['searchquery'] == "") || $count==0){?> style="display: none" <?php } ?> style="text-decoration: none" onclick="v_function();"><span>RdY</span></button>
                          </span>
                          <span class = 'hmapset18'>
                          <button class="btn-display" title="Show yellow-red colorscale" <?php if ((!isset($_POST['searchquery']) || $_POST['searchquery'] == "") || $count==0){?> style="display: none" <?php } ?> style="text-decoration: none" onclick="w_function();"><span>YRd</span></button>
                          </span>
                        </div> 

                        <!-- Defining chart display buttons for non-Arabidopsis thaliana hlust heatmap -->
                        <?php } else if ($_POST['filter4'] == "heatmap" && ($count > 1) && $_POST['filter1'] != "Arabidopsis_thaliana"  && $_POST['filter6'] == "1"){?>
                        <div class='lchart' id="displaybtngroup" role="group" <?php if ((!isset($_POST['searchquery']) || $_POST['searchquery'] == "") || $count==0){?> style="display: none" <?php } ?> style="text-decoration: none" >
                          <font size="3">Colorscale:</font>
                          <span class = 'hmapset19'>
                          <button class="btn-display active" title="Show viridis colorscale" <?php if ((!isset($_POST['searchquery']) || $_POST['searchquery'] == "") || $count==0){?> style="display: none" <?php } ?> style="text-decoration: none" onclick="x_function();"><span>Vd</span></button>
                          </span>
                          <span class = 'hmapset20'>
                          <button class="btn-display" title="Show blue colorscale" <?php if ((!isset($_POST['searchquery']) || $_POST['searchquery'] == "") || $count==0){?> style="display: none" <?php } ?> style="text-decoration: none" onclick="y_function();"><span>Bu</span></button>
                          </span>
                          <span class = 'hmapset21'>
                          <button class="btn-display" title="Show red colorscale" <?php if ((!isset($_POST['searchquery']) || $_POST['searchquery'] == "") || $count==0){?> style="display: none" <?php } ?> style="text-decoration: none" onclick="z_function();"><span>Rd</span></button>
                          </span>
                          <span class = 'hmapset22'>
                          <button class="btn-display" title="Show green colorscale" <?php if ((!isset($_POST['searchquery']) || $_POST['searchquery'] == "") || $count==0){?> style="display: none" <?php } ?> style="text-decoration: none" onclick="aa_function();"><span>Gn</span></button>
                          </span>
                          <span class = 'hmapset23'>
                          <button class="btn-display" title="Show red-yellow colorscale" <?php if ((!isset($_POST['searchquery']) || $_POST['searchquery'] == "") || $count==0){?> style="display: none" <?php } ?> style="text-decoration: none" onclick="ab_function();"><span>RdY</span></button>
                          </span>
                          <span class = 'hmapset24'>
                          <button class="btn-display" title="Show yellow-red colorscale" <?php if ((!isset($_POST['searchquery']) || $_POST['searchquery'] == "") || $count==0){?> style="display: none" <?php } ?> style="text-decoration: none" onclick="ac_function();"><span>YRd</span></button>
                          </span>
                        </div> 

                      <?php }
                      ?>
                      </div><!--/close div for heatmap display buttons-->


                      <!-- JavaScript to control active class property of "Display" plot buttons -->
                      <script type="text/javascript">
                        var btngroup = document.getElementById("displaybtngroup");
                        var btns = btngroup.getElementsByClassName("btn-display");
                          for (var i = 0; i < btns.length; i++) {
                            btns[i].addEventListener("click", function() {
                              var current = document.getElementsByClassName("btn-display active");
                              current[0].className = current[0].className.replace(" active", "");
                              this.className += " active";
                            });
                          }
                      </script>


                      <br><br/>
                      <br><br/>
                    </div><!--/close div for download data and plot buttons-->
                  </div>
                </div><!--/close wrapper for download and display buttons-->
              </div><!--/close div for some-class2-->
            </div><!--/close div for maincontent-->
          </div><!--/close XL-10 grid-->
        </div><!--/close prmtpltcont grid--> 
      </div><!--/close 2st col-md-12 content-->
    </div><!--/close 1nd col-md-12 content: all visible content of results page-->


    <?php } ?> <!--/close php condition for processing result page-->





<!-- ******************************************************************* -->
<!-- ***********************************************************************
Run javascript vizualisation libraries for line chart and heatmap here
************************************************************************ -->
<!-- ******************************************************************* -->





<?php 
// define line chart parameters for plotting Arabidopsis thaliana data here
if($_POST['filter4'] == "line_chart" && $_POST['filter1'] == "Arabidopsis_thaliana" && ($count > 0) && ($count < 21)) { ?>

    <script>
      var dataset = <?php echo $jsonout; ?>;
      var title = <?php echo $titleout; ?>;
      var x_axis_cat = ['root, root tip, 5d.1', 'root, root tip, 5d.2', 'root, root tip, 5d.3', 'root, maturation zone, 5d.1', 'root, maturation zone, 5d.2', 'root, maturation zone, 5d.3', 'root, whole root, 5d.1', 'root, whole root_5d.2', 'root, whole root, 5d.3', 'root, whole root, 7d.1', 'root, whole root, 7d.2', 'root, whole root, 7d.3', 'root, whole root, 14d.1', 'root, whole root, 14d.2', 'root, whole root, 14d.3', 'root, whole root, 21d.1', 'root, whole root, 21d.2', 'root, whole root, 21d.3', 'hypocotyl, 10d.1', 'hypocotyl, 10d.2', 'hypocotyl, 10d.3', '3rd internode, 24d.1', '3rd internode, 24d.2', '3rd internode, 24d.3', '2nd internode, 24d.1', '2nd internode, 24d.2', '2nd internode, 24d.3', '1st internode, 28d.1', '1st internode, 28d.2', '1st internode, 28d.3', 'cotyledons, 7d.1', 'cotyledons, 7d.2', 'cotyledons, 7d.3', 'leaf 1+2, 7d.1', 'leaf 1+2, 7d.2', 'leaf 1+2, 7d.3', 'leaf 1+2, 10d.1', 'leaf 1+2, 10d.2', 'leaf 1+2, 10d.3', 'leaf 1+2, petiole, 10d.1', 'leaf 1+2, petiole, 10d.2', 'leaf 1+2, petiole, 10d.3', 'leaf 1+2, leaf tip, 10d.1', 'leaf 1+2, leaf tip, 10d.2', 'leaf 1+2, leaf tip, 10d.3', 'leaf 5+6, 17d.1', 'leaf 5+6, 17d.2', 'leaf 5+6, 17d.3', 'leaf 9+10, 27d.1', 'leaf 9+10, 27d.2', 'leaf 9+10, 27d.3', 'leaves senescing, 35d.1', 'leaves senescing, 35d.2', 'leaves senescing, 35d.3', 'cauline leaves, 24d.1', 'cauline leaves, 24d.2', 'cauline leaves, 24d.3', 'apex vegetative, 7d.1', 'apex vegetative, 7d.2', 'apex vegetative, 7d.3', 'apex vegetative, 10d.1', 'apex vegetative, 10d.2', 'apex vegetative, 10d.3', 'apex vegetative, 14d.1', 'apex vegetative, 14d.2', 'apex vegetative, 14d.3', 'apex inflorescence, 21d.1', 'apex inflorescence, 21d.2', 'apex inflorescence, 21d.3', 'apex inflorescence, 28d.1', 'apex inflorescence, 28d.2', 'apex inflorescence, 28d.3', 'apex inflor. clv1, 21d.1', 'apex inflor. clv1, 21d.2', 'apex inflor. clv1, 21d.3', 'flower stg9, 21d+.1', 'flower stg9, 21d+.2', 'flower stg9, 21d+.3', 'flower stg10/11, 21d+.1', 'flower stg10/11, 21d+.2', 'flower stg10/11, 21d+.3', 'flower stg12, 21d+.1', 'flower stg12, 21d+.2', 'flower stg12, 21d+.3', 'flower stg15, 21d+.1', 'flower stg15, 21d+.2', 'flower stg15, 21d+.3', 'flower stg12, sepals.1', 'flower stg12, sepals.2', 'flower stg12, sepals.3', 'flower stg15, sepals.1', 'flower stg15, sepals.2', 'flower stg15, sepals.3', 'flower stg12, petals.1', 'flower stg12, petals.2', 'flower stg12, petals.3', 'flower stg15, petals.1', 'flower stg15, petals.2', 'flower stg15, petals.3', 'flower stg12, stamens.1', 'flower stg12, stamens.2', 'flower stg12, stamens.3', 'flower stg15, stamens.1', 'flower stg15, stamens.2', 'flower stg15, stamens.3', 'mature pollen, 28d+.1', 'mature pollen, 28d+.2', 'mature pollen, 28d+.3', 'flower early stg12, carpels.1', 'flower early stg12, carpels.2', 'flower early stg12, carpels.3', 'flower late stg12, carpels.1', 'flower late stg12, carpels.2', 'flower late stg12, carpels.3', 'flower stg15, carpels.1', 'flower stg15, carpels.2', 'flower stg15, carpels.3', 'fruit stg16, siliques.1', 'fruit stg16, siliques.2', 'fruit stg16, siliques.3', 'fruit stg17a, siliques.1', 'fruit stg17a, siliques.2', 'fruit stg17a, siliques.3', 'fruit stg16, seeds.1', 'fruit stg16, seeds.2', 'fruit stg16, seeds.3', 'fruit stg17a, seeds.1', 'fruit stg17a, seeds.2', 'fruit stg17a, seeds.3', 'fruit stg18, seeds.1', 'fruit stg18, seeds.2', 'fruit stg18, seeds.3' , ''];
      var ath_regions = [
        {start: 0, end: 17.5},
        {start: 17.5, end: 29.5, class:'col_5', opacity:0.05},
        {start: 29.5, end: 56.5, class: 'col_2', opacity:0.19},
        {start: 56.5, end: 74.5, class:'col_5', opacity:0.05},
        {start: 74.5, end: 86.5},
        {start: 86.5, end: 104.5, class:'col_5', opacity:0.05},
        {start: 104.5, end: 107.5, class:'col_5', opacity:0.05},
        {start: 107.5, end: 113.5, class:'col_5', opacity:0.05},
        {start: 113.5, end: 131.7, class: 'col_1', opacity:.14}
      ];

      var chart = c3.generate({
        padding: {
          top: 12,
          right: 46,
          bottom: 53,
          left: 72,
        },
        size: {height: 609},
        point: {r: 3.1},
        data: {json: dataset},
        axis: {
          x: {
            type: 'category',
            categories: x_axis_cat,
            tick: {
                rotate:90,
                multiline: false,
                culling: {max: 45}
            },
            height: 120,
            padding: {
              right: 0.25
            },
          },
          y: { 
            label: {
              text: title,
              position: 'outer-middle'
            },
            min: 0,
            tick: {
              format: function (d) {
                if ((d / 1000) >= 1) {
                  d = Math.round((d / 1000 )*100) / 100 + "K";
                  }
                return d;
              }
            },
            padding: {bottom:0},
          }
        },
        grid: {
          lines: {front: false},
        },
        zoom: {enabled: false},
        regions: ath_regions,
        color: {
          pattern: ['#1177cf', '#ff7f0e','#2ca02c','#d62728','#9467bd','#8c564b','#e377c2','#7f7f7f','#bcbd22','#17becf', '#ffbb78', '#98df8a', '#aec7e8', '#f7b6d2', '#dbdb8d', '#17becf', '#9edae5', '#d62728', '#2ca02c', '#c49c94']
        }
      });


    // Function to call line chart with regions
    function a_function(){
    $(function () {
      var chart = c3.generate({
        padding: {
          top: 12,
          right: 46,
          bottom: 53,
          left: 72,
        },
        size: {height: 609},
        point: {r: 3.1},
        data: {json: dataset},
        axis: {
          x: {
            type: 'category',
            categories: x_axis_cat,
            tick: {
              rotate:90,
              multiline: false,
              culling: {max: 45}
            },
            height: 120,
            padding: {right: 0.25},
          },
          y: { 
            label: {
              text: title,
              position: 'outer-middle'
            },
            min:0,
            tick: {
              format: function (d) {
                if ((d / 1000) >= 1) {
                  d = Math.round((d / 1000 )*100) / 100 + "K";
                  }
                return d;
              }
            },
            padding: {bottom:0}
          }
        },
        grid: {
          lines: {front: false},
        },
        zoom: {enabled: false},
        regions: ath_regions,
        color: {
          pattern: ['#1177cf', '#ff7f0e','#2ca02c','#d62728','#9467bd','#8c564b','#e377c2','#7f7f7f','#bcbd22','#17becf', '#ffbb78', '#98df8a', '#aec7e8', '#f7b6d2', '#dbdb8d', '#17becf', '#9edae5', '#d62728', '#2ca02c', '#c49c94']
        }
      });
    }
    )}


    // Function to call line chart with grid
    function b_function(){
    $(function () {
      var chart = c3.generate({
        padding: {
          top: 12,
          right: 46,
          bottom: 53,
          left: 72,
        },
        size: {height: 609},
        point: {r: 3.1},
        data: {json: dataset},
        axis: {
          x: {
            type: 'category',
            categories: x_axis_cat,
            tick: {
                rotate:90,
                multiline: false,
                culling: {max: 45}
            },
            height: 120,
            padding: {right: 0.25},
          },
          y: { 
            label: {
              text: title,
              position: 'outer-middle'
            },
            min:0,
            tick: {
              format: function (d) {
                if ((d / 1000) >= 1) {
                  d = Math.round((d / 1000 )*100) / 100 + "K";
                  }
                return d;
              }
            },
            padding: {bottom:0}
          }
        },
        grid: {
          x: {
            lines: [
                {value: 17.5, class: 'gridx'},
                {value: 29.5, class: 'gridx'},
                {value: 56.5, class: 'gridx'},
                {value: 74.5, class: 'gridx'},
                {value: 86.5, class: 'gridx'},
                {value: 113.5, class: 'gridx'},
                {value: 131.5, class: 'gridx'}
            ]
          },
          y: {show: true},
          lines: {front: false},
        },
        zoom: {enabled: false},
        color: {
          pattern: ['#1177cf', '#ff7f0e','#2ca02c','#d62728','#9467bd','#8c564b','#e377c2','#7f7f7f','#bcbd22','#17becf', '#ffbb78', '#98df8a', '#aec7e8', '#f7b6d2', '#dbdb8d', '#17becf', '#9edae5', '#d62728', '#2ca02c', '#c49c94']
        }
      });
    }
    )}


    // Function to call plain line chart
    function c_function(){
    $(function () {
      var chart = c3.generate({
        padding: {
        top: 12,
        right: 46,
        bottom: 53,
        left: 72,
        },
        size: {height: 609},
        point: {r: 3.1},
        data: {json: dataset},
        axis: {
          x: {
            type: 'category',
            categories: x_axis_cat,
            tick: {
              rotate:90,
              multiline: false,
              culling: {max: 45}
            },
            height: 120,
            padding: {right: 0.25},
          },
          y: { 
            label: {
              text: title,
              position: 'outer-middle'
            },
            min:0,
            tick: {
              format: function (d) {
                if ((d / 1000) >= 1) {
                  d = Math.round((d / 1000 )*100) / 100 + "K";
                  }
                return d;
              }
            },
            padding: {bottom:0}
          }
        },
        grid: {
          lines: {front: false},
        },
        zoom: {enabled: false},
        color: {
          pattern: ['#1177cf', '#ff7f0e','#2ca02c','#d62728','#9467bd','#8c564b','#e377c2','#7f7f7f','#bcbd22','#17becf', '#ffbb78', '#98df8a', '#aec7e8', '#f7b6d2', '#dbdb8d', '#17becf', '#9edae5', '#d62728', '#2ca02c', '#c49c94']
        }
      });
    }
    )}


  </script>

<?php }


// define line chart parameters for plotting non-Arabidopsis thaliana data here
else if ($_POST['filter4'] == "line_chart" && ($count > 0) && ($count < 21) && $_POST['filter1'] != "Arabidopsis_thaliana") { ?>

    <script>
      var dataset = <?php echo $jsonout; ?>;
      var title = <?php echo $titleout; ?>;
      var nonathgrid = [
        {value: 2.5, class: 'gridx'},
        {value: 5.5, class: 'gridx'},
        {value: 8.5, class: 'gridx'},
        {value: 11.5, class: 'gridx'},
        {value: 14.5, class: 'gridx'},
        {value: 17.5, class: 'gridx'},
        {value: 20.5, class: 'gridx'},
        {value: 23.5, class: 'gridx'},
        {value: 26.43, class: 'gridy'}
      ];
      var xValues = 
       <?php if($_POST['filter1'] == "Capsella_rubella") { ?>
       ['root, whole root, 4d.1', 'root, whole root, 4d.2', 'root, whole root, 4d.3', 'hypocotyl, 9d.1', 'hypocotyl, 9d.2', 'hypocotyl, 9d.3', 'leaf 1+2, 7d.1', 'leaf 1+2, 7d.2', 'leaf 1+2, 7d.3', 'apex vegetative, 7d.1', 'apex vegetative, 7d.2', 'apex vegetative, 7d.3', 'apex inflorescence.1', 'apex inflorescence.2', 'apex inflorescence.3', 'flower stg12.1', 'flower stg12.2', 'flower stg12.3', 'flower stg12, carpels.1', 'flower stg12, carpels.2', 'flower stg12, carpels.3', 'flower stg12, stamens.1', 'flower stg12, stamens.2', 'flower stg12, stamens.3', 'mature pollen.1', 'mature pollen.2', 'mature pollen.3'];
        <?php } 
        else if ($_POST['filter1'] == "Eutrema_salsugineum") { ?>
        ['root, whole root, 6d.1', 'root, whole root, 6d.2', 'root, whole root, 6d.3', 'hypocotyl, 12d.1', 'hypocotyl, 12d.2', 'hypocotyl, 12d.3', 'leaf 1+2, 9d.1', 'leaf 1+2, 9d.2', 'leaf 1+2, 9d.3', 'apex vegetative, 9d.1', 'apex vegetative, 9d.2', 'apex vegetative, 9d.3', 'apex inflorescence.1', 'apex inflorescence.2', 'apex inflorescence.3', 'flower stg12.1', 'flower stg12.2', 'flower stg12.3', 'flower stg12, carpels.1', 'flower stg12, carpels.2', 'flower stg12, carpels.3', 'flower stg12, stamens.1', 'flower stg12, stamens.2', 'flower stg12, stamens.3', 'mature pollen.1', 'mature pollen.2', 'mature pollen.3'];
        <?php } 
        else if ($_POST['filter1'] == "Medicago_truncatula") { ?>
        ['root_whole root_4d.1', 'root_whole root_4d.2', 'root_whole root_4d.3', 'hypocotyl_8d.1', 'hypocotyl_8d.2', 'hypocotyl_8d.3', 'leaf 2_7d.1', 'leaf 2_7d.2', 'leaf 2_7d.3', 'apex vegetative_6d.1', 'apex vegetative_6d.2', 'apex vegetative_6d.3', 'meristem inflorescence.1', 'meristem inflorescence.2', 'meristem inflorescence.3', 'flower stg8.1', 'flower stg8.2', 'flower stg8.3', 'flower stg8_carpels.1', 'flower stg8_carpels.2', 'flower stg8_carpels.3', 'flower stg8_stamens.1', 'flower stg8_stamens.2', 'flower stg8_stamens.3', 'mature pollen.1', 'mature pollen.2', 'mature pollen.3'];
        <?php } ?>

      var chart = c3.generate({
        padding: {
          top: 12,
          right: 76,
          bottom: 50,
          left: 97,
        },
        size: {height: 600},
        point: {r: 3.1},
        data: {json: dataset},
        axis: {
          x: {
            type: 'category',
            categories: xValues,
            tick: {
                rotate:90,
                multiline: false,
            },
            height: 120,
            label: {
                label: 'X Label',
                position: 'outer-middle'
            },
          },
          y: { 
            label: {
            text: title,
            position: 'outer-middle'
            },
            min:0,
            padding: {bottom:0}
          },
        },
        grid: {
          x: {lines: nonathgrid},
          y: {show: true},
          lines: {front: false},
        },
        zoom: {enabled: false},
        color: {
          pattern: ['#1177cf', '#ff7f0e','#2ca02c','#d62728','#9467bd','#8c564b','#e377c2','#7f7f7f','#bcbd22','#17becf', '#ffbb78', '#98df8a', '#aec7e8', '#f7b6d2', '#dbdb8d', '#17becf', '#9edae5', '#d62728', '#2ca02c', '#c49c94']
        }
      });



    // Function to call non-Arabidopsis thaliana line chart with grid
    function d_function(){
    $(function () {
      var chart = c3.generate({
        padding: {
          top: 12,
          right: 76,
          bottom: 50,
          left: 97,
        },
        size: {height: 600},
        point: {r: 3.1},
        data: {json: dataset},
        axis: {
          x: {
            type: 'category',
            categories: xValues,
            tick: {
                rotate:90,
                multiline: false,
            },
            height: 120,
            label: {
              label: 'X Label',
              position: 'outer-middle'
            },
          },
          y: { 
            label: {
              text: title,
              position: 'outer-middle'
            },
            min:0,
            padding: {bottom:0}
          },
        },
        grid: {
          x: {lines: nonathgrid},
          y: {show: true},
          lines: {front: false},
        },
        zoom: {enabled: false},
        color: {
          pattern: ['#1177cf', '#ff7f0e','#2ca02c','#d62728','#9467bd','#8c564b','#e377c2','#7f7f7f','#bcbd22','#17becf', '#ffbb78', '#98df8a', '#aec7e8', '#f7b6d2', '#dbdb8d', '#17becf', '#9edae5', '#d62728', '#2ca02c', '#c49c94']
        }
      });
    }
    )}


    // Function to call non-Arabidopsis thaliana line chart without grid
    function e_function(){
    $(function () {
      var chart = c3.generate({
        padding: {
          top: 12,
          right: 76,
          bottom: 50,
          left: 97,
        },
        size: {height: 600},
        point: {r: 3.1},
        data: {json: dataset},
        axis: {
          x: {
            type: 'category',
            categories: xValues,
            tick: {
              rotate:90,
              multiline: false,
            },
            height: 120,
            label: {
              label: 'X Label',
              position: 'outer-middle'
            },
          },
          y: { 
            label: {
              text: title,
              position: 'outer-middle'
            },
            min:0,
            padding: {bottom:0}
          },
        },
        grid: {lines: {front: false}},
        zoom: {enabled: false},
        color: {
          pattern: ['#1177cf', '#ff7f0e','#2ca02c','#d62728','#9467bd','#8c564b','#e377c2','#7f7f7f','#bcbd22','#17becf', '#ffbb78', '#98df8a', '#aec7e8', '#f7b6d2', '#dbdb8d', '#17becf', '#9edae5', '#d62728', '#2ca02c', '#c49c94']
        }
      });
    }
    )}

</script>

<?php }



// define heatmap plot parameters for plotting Arabidopsis thaliana data here
else if (($_POST['filter4'] == "heatmap" && $_POST['filter1'] == "Arabidopsis_thaliana" && ($count > 0) && ($count < 1251) && $_POST['filter6'] != "1") || ($_POST['filter4'] == "heatmap" && $_POST['filter1'] == "Arabidopsis_thaliana" && $_POST['filter6'] == "1" && $count == 1)) { ?>

    <script type="text/javascript">

        // Function to call viridis plot (standard setup)
        var zValues = <?php if (($_POST['filter5'] == "0" || $_POST['filter5'] == "2")) { 
                           echo $valuesout; 
                           } else if ($_POST['filter5'] == "1") { 
                           echo $valueslogout; }
                           ?>;
        var yValues = <?php echo $keys2out; ?>;
        var xValues = 
        ['root, root tip, 5d.1', 'root, root tip, 5d.2', 'root, root tip, 5d.3', 'root, maturation zone, 5d.1', 'root, maturation zone, 5d.2', 'root, maturation zone, 5d.3', 'root, whole root, 5d.1', 'root, whole root_5d.2', 'root, whole root, 5d.3', 'root, whole root, 7d.1', 'root, whole root, 7d.2', 'root, whole root, 7d.3', 'root, whole root, 14d.1', 'root, whole root, 14d.2', 'root, whole root, 14d.3', 'root, whole root, 21d.1', 'root, whole root, 21d.2', 'root, whole root, 21d.3', 'hypocotyl, 10d.1', 'hypocotyl, 10d.2', 'hypocotyl, 10d.3', '3rd internode, 24d.1', '3rd internode, 24d.2', '3rd internode, 24d.3', '2nd internode, 24d.1', '2nd internode, 24d.2', '2nd internode, 24d.3', '1st internode, 28d.1', '1st internode, 28d.2', '1st internode, 28d.3', 'cotyledons, 7d.1', 'cotyledons, 7d.2', 'cotyledons, 7d.3', 'leaf 1+2, 7d.1', 'leaf 1+2, 7d.2', 'leaf 1+2, 7d.3', 'leaf 1+2, 10d.1', 'leaf 1+2, 10d.2', 'leaf 1+2, 10d.3', 'leaf 1+2, petiole, 10d.1', 'leaf 1+2, petiole, 10d.2', 'leaf 1+2, petiole, 10d.3', 'leaf 1+2, leaf tip, 10d.1', 'leaf 1+2, leaf tip, 10d.2', 'leaf 1+2, leaf tip, 10d.3', 'leaf 5+6, 17d.1', 'leaf 5+6, 17d.2', 'leaf 5+6, 17d.3', 'leaf 9+10, 27d.1', 'leaf 9+10, 27d.2', 'leaf 9+10, 27d.3', 'leaves senescing, 35d.1', 'leaves senescing, 35d.2', 'leaves senescing, 35d.3', 'cauline leaves, 24d.1', 'cauline leaves, 24d.2', 'cauline leaves, 24d.3', 'apex vegetative, 7d.1', 'apex vegetative, 7d.2', 'apex vegetative, 7d.3', 'apex vegetative, 10d.1', 'apex vegetative, 10d.2', 'apex vegetative, 10d.3', 'apex vegetative, 14d.1', 'apex vegetative, 14d.2', 'apex vegetative, 14d.3', 'apex inflorescence, 21d.1', 'apex inflorescence, 21d.2', 'apex inflorescence, 21d.3', 'apex inflorescence, 28d.1', 'apex inflorescence, 28d.2', 'apex inflorescence, 28d.3', 'apex inflor. clv1, 21d.1', 'apex inflor. clv1, 21d.2', 'apex inflor. clv1, 21d.3', 'flower stg9, 21d+.1', 'flower stg9, 21d+.2', 'flower stg9, 21d+.3', 'flower stg10/11, 21d+.1', 'flower stg10/11, 21d+.2', 'flower stg10/11, 21d+.3', 'flower stg12, 21d+.1', 'flower stg12, 21d+.2', 'flower stg12, 21d+.3', 'flower stg15, 21d+.1', 'flower stg15, 21d+.2', 'flower stg15, 21d+.3', 'flower stg12, sepals.1', 'flower stg12, sepals.2', 'flower stg12, sepals.3', 'flower stg15, sepals.1', 'flower stg15, sepals.2', 'flower stg15, sepals.3', 'flower stg12, petals.1', 'flower stg12, petals.2', 'flower stg12, petals.3', 'flower stg15, petals.1', 'flower stg15, petals.2', 'flower stg15, petals.3', 'flower stg12, stamens.1', 'flower stg12, stamens.2', 'flower stg12, stamens.3', 'flower stg15, stamens.1', 'flower stg15, stamens.2', 'flower stg15, stamens.3', 'mature pollen, 28d+.1', 'mature pollen, 28d+.2', 'mature pollen, 28d+.3', 'flower early stg12, carpels.1', 'flower early stg12, carpels.2', 'flower early stg12, carpels.3', 'flower late stg12, carpels.1', 'flower late stg12, carpels.2', 'flower late stg12, carpels.3', 'flower stg15, carpels.1', 'flower stg15, carpels.2', 'flower stg15, carpels.3', 'fruit stg16, siliques.1', 'fruit stg16, siliques.2', 'fruit stg16, siliques.3', 'fruit stg17a, siliques.1', 'fruit stg17a, siliques.2', 'fruit stg17a, siliques.3', 'fruit stg16, seeds.1', 'fruit stg16, seeds.2', 'fruit stg16, seeds.3', 'fruit stg17a, seeds.1', 'fruit stg17a, seeds.2', 'fruit stg17a, seeds.3', 'fruit stg18, seeds.1', 'fruit stg18, seeds.2', 'fruit stg18, seeds.3'];

        var title = <?php echo $titleout; ?>;

        var ticknumber = <?php if($countout == 1) { ?> 3;
                     <?php } else { ?> 0; <?php } ?>;

        var ticklabels = ['root, root tip, 5d.1', 'root, maturation zone, 5d.1', 'root, whole root, 5d.1', 'root, whole root, 7d.1', 'root, whole root, 14d.1', 'root, whole root, 21d.1', 'hypocotyl, 10d.1', '3rd internode, 24d.1',  '2nd internode, 24d.1', '1st internode, 28d.1', 'cotyledons, 7d.1', 'leaf 1+2, 7d.1', 'leaf 1+2, 10d.1', 'leaf 1+2, petiole, 10d.1', 'leaf 1+2, leaf tip, 10d.1', 'leaf 5+6, 17d.1', 'leaf 9+10, 27d.1', 'leaves senescing, 35d.1', 'cauline leaves, 24d.1', 'apex vegetative, 7d.1', 'apex vegetative, 10d.1', 'apex vegetative, 14d.1', 'apex inflorescence, 21d.1', 'apex inflorescence, 28d.1', 'apex inflor. clv1, 21d.1', 'flower stg9, 21d+.1', 'flower stg10/11, 21d+.1', 'flower stg12, 21d+.1', 'flower stg15, 21d+.1', 'flower stg12, sepals.1', 'flower stg15, sepals.1', 'flower stg12, petals.1', 'flower stg15, petals.1', 'flower stg12, stamens.1', 'flower stg15, stamens.1', 'mature pollen, 28d+.1', 'flower early stg12, carpels.1', 'flower late stg12, carpels.1', 'flower stg15, carpels.1', 'fruit stg16, siliques.1', 'fruit stg17a, siliques.1', 'fruit stg16, seeds.1', 'fruit stg17a, seeds.1', 'fruit stg18, seeds.1'];

        var colorbar = {
          title: title,
          titlefont: {
          size: 12,
          },
          titleside: "top",
          thickness: 20,
          nticks: ticknumber,
          tickfont: {
          size:10.5
          },
          outlinewidth: 0,
          xpad: 1,
          ypad:3
          };

        var height = <?php echo $reqheightout; ?>;
 
        var layout = <?php if($countout < 5) { ?> {
          paper_bgcolor: 'rgba(255,255,255,0)',
          height: height,
          margin: {
            l: 105,
            r: 105,
            b: 181,
            t: 62,
            pad: 0
            },
          xaxis: {
            showticklabels: true,
            tickangle: 90,
            tickvals: ticklabels,
            tickfont: {
              size: 11.75,
              color: 'black'
            }},
          yaxis: {
            showticklabels: true,
            tickangle: 0,
            tickfont: {
            size: 11.75,
            color: 'black'
            }}
          };  

          <?php } else if ($countout < 10) { ?> {
          paper_bgcolor: 'rgba(255,255,255,0)',
          height: height,
          margin: {
            l: 105,
            r: 105,
            b: 187,
            t: 53,
            pad: 0
            },
          xaxis: {
            showticklabels: true,
            tickangle: 90,
            tickvals: ticklabels,
            tickfont: {
                size: 11.75,
                color: 'black'
            }},
          yaxis: {
            showticklabels: true,
            tickangle: 0,
            tickfont: {
              size: 11.75,
              color: 'black'
            }}
          };
      
          <?php } else { ?> {
          paper_bgcolor: 'rgba(255,255,255,0)',
          height: height,
          margin: {
            l: 105,
            r: 105,
            b: 202,
            t: 38,
            pad: 0
          },
          xaxis: {
            showticklabels: true,
            tickangle: 90,
            tickvals: ticklabels,
            tickfont: {
              size: 11.75,
              color: 'black'
            }},
          yaxis: {
            showticklabels: true,
            tickangle: 0,
            tickfont: {
              size: 11.75,
              color: 'black'
            }}
          };
          <?php } ?>;



        // fill in 'text' array for hover
        var text = zValues.map (function(zValues, i) { return zValues.map (function (value, j) {
            return ` ID: ${yValues[i]}<br> Tissue: ${xValues[j]}<br> Expression: ${value.toFixed(2)} `
            });
          });

        // format modebar, add svg download icon, activate responsive design
        var config = {
            modeBarButtonsToRemove: ['sendDataToCloud', 'autoScale2d', 'hoverClosestCartesian', 'hoverCompareCartesian', 'lasso2d', 'select2d', 'toggleSpikelines'],
            displayModeBar: true,
            responsive: true,
            toImageButtonOptions: {
              filename: 'devseq_plot',
              width: 1020,
            },
            modeBarButtonsToAdd: [{
            name: 'Download plot as a svg',
            icon: Plotly.Icons.disk,
            click: function(gd) {
              gd.layout.width = gd.offsetWidth;
              gd.layout.height = gd.offsetHeight;
              Plotly.downloadImage(gd, {filename: 'devseq_plot', format: 'svg'})
              }
            }],
            displaylogo: false
          };

      Plotly.newPlot('myDiv', [{x: xValues, y: yValues, z: zValues, text: text, hoverinfo: 'text', hoverlabel: {bgcolor: '#41454c'}, layout: layout, colorbar: colorbar, type: 'heatmap', colorscale: [['0', 'rgb(64, 1, 82)'],['0.01', 'rgb(68, 1, 84)'],['0.05', 'rgb(71, 17, 102)'],['0.10', 'rgb(73, 34, 117)'],['0.1475', 'rgb(72, 49, 130)'],['0.195', 'rgb(67, 62, 135)'],['0.2425', 'rgb(64, 77, 143)'],['0.29', 'rgb(58, 90, 145)'],['0.3375', 'rgb(52, 103, 148)'],['0.385', 'rgb(47, 116, 148)'],['0.425', 'rgb(41, 124, 145)'],['0.465', 'rgb(38, 136, 145)'],['0.505', 'rgb(33, 145, 142)'],['0.545', 'rgb(31, 155, 137)'],['0.585', 'rgb(34, 165, 132)'],['0.63', 'rgb(42, 175, 126)'],['0.675', 'rgb(59, 185, 117)'],['0.725', 'rgb(80, 195, 105)'],['0.77', 'rgb(105, 204, 90)'],['0.815', 'rgb(132, 212, 74)'],['0.8625', 'rgb(169, 217, 55)'],['0.91', 'rgb(202, 222, 36)'],['0.95', 'rgb(223, 227, 27)'],['0.99', 'rgb(251, 230, 36)'],['1.0', 'rgb(251, 230, 36)']]}], layout, config);



      // Function to call viridis plot
      function f_function(){
        $(function () {
        Plotly.newPlot('myDiv',[{x: xValues, y: yValues, z: zValues, text: text, hoverinfo: 'text', hoverlabel: {bgcolor: '#41454c'}, layout: layout, colorbar: colorbar, type: 'heatmap', colorscale: [['0', 'rgb(64, 1, 82)'],['0.01', 'rgb(68, 1, 84)'],['0.05', 'rgb(71, 17, 102)'],['0.10', 'rgb(73, 34, 117)'],['0.1475', 'rgb(72, 49, 130)'],['0.195', 'rgb(67, 62, 135)'],['0.2425', 'rgb(64, 77, 143)'],['0.29', 'rgb(58, 90, 145)'],['0.3375', 'rgb(52, 103, 148)'],['0.385', 'rgb(47, 116, 148)'],['0.425', 'rgb(41, 124, 145)'],['0.465', 'rgb(38, 136, 145)'],['0.505', 'rgb(33, 145, 142)'],['0.545', 'rgb(31, 155, 137)'],['0.585', 'rgb(34, 165, 132)'],['0.63', 'rgb(42, 175, 126)'],['0.675', 'rgb(59, 185, 117)'],['0.725', 'rgb(80, 195, 105)'],['0.77', 'rgb(105, 204, 90)'],['0.815', 'rgb(132, 212, 74)'],['0.8625', 'rgb(169, 217, 55)'],['0.91', 'rgb(202, 222, 36)'],['0.95', 'rgb(223, 227, 27)'],['0.99', 'rgb(251, 230, 36)'],['1.0', 'rgb(251, 230, 36)']]}], layout, config);
          }
        )}


      // Function to call blue plot
      function g_function(){
        $(function () {
        Plotly.newPlot('myDiv',[{x: xValues, y: yValues, z: zValues, text: text, hoverinfo: 'text', hoverlabel: {bgcolor: '#41454c'}, layout: layout, colorbar: colorbar, type: 'heatmap', colorscale: [['0.0', 'rgb(245, 249, 252)'],['0.1', 'rgb(226, 237, 248)'],['0.2', 'rgb(207, 225, 242)'],['0.3', 'rgb(180, 211, 233)'],['0.4', 'rgb(146, 195, 223)'],['0.5', 'rgb(108, 173, 213)'],['0.6', 'rgb(74, 151, 201)'],['0.7', 'rgb(47, 126, 188)'],['0.8', 'rgb( 24, 100, 170)'],['0.9', 'rgb(10, 74, 144)'],['1.0', 'rgb(9, 57, 127)']]}], layout, config);
          }
        )}


      // Function to call red plot - from R color brewer palette
      function h_function(){
        $(function () {
        Plotly.newPlot('myDiv', [{x: xValues, y: yValues, z: zValues, text: text, hoverinfo: 'text', hoverlabel: {bgcolor: '#41454c'}, layout: layout, colorbar: colorbar, type: 'heatmap', colorscale: [['0.0', 'rgb(252, 245, 245)'],['0.11', 'rgb(250, 221, 207)'],['0.22', 'rgb(247, 199, 178)'],['0.33', 'rgb(240, 173, 151)'],['0.44', 'rgb(227, 127, 102)'],['0.55', 'rgb(209, 86, 67)'],['0.66', 'rgb(191, 55, 48)'],['0.77', 'rgb(173, 26, 31)'],['0.88', 'rgb(133, 12, 18)'],['1.0', 'rgb(110, 4, 18)']]}], layout, config);
          }
        )}


      // Function to call green plot
      function i_function(){
        $(function () {
        Plotly.newPlot('myDiv', [{x: xValues, y: yValues, z: zValues, text: text, hoverinfo: 'text', hoverlabel: {bgcolor: '#41454c'}, layout: layout, colorbar: colorbar, type: 'heatmap', colorscale: [['0.0', 'rgb(245, 252, 247)'],['0.11112', 'rgb(226, 237, 197)'],['0.22223', 'rgb(209, 224, 162)'],['0.33334', 'rgb(185, 204, 129)'],['0.44445', 'rgb(155, 184, 94)'],['0.55556', 'rgb(116, 161, 67)'],['0.66667', 'rgb(70, 138, 41)'],['0.77778', 'rgb(25, 115, 21)'],['0.88889', 'rgb(9, 99, 20)'],['1.0', 'rgb(4, 89, 21)']]}], layout, config);
          }
        )}


      // Function to call red-yellow plot
      function j_function(){
        $(function () {
        Plotly.newPlot('myDiv',[{x: xValues, y: yValues, z: zValues, text: text, hoverinfo: 'text', hoverlabel: {bgcolor: '#41454c'}, layout: layout, colorbar: colorbar, type: 'heatmap', colorscale: [['0.0', 'rgb(253, 0, 0)'],['0.067', 'rgb(253, 33, 2)'],['0.134', 'rgb(253, 63, 6)'],['0.201', 'rgb(253, 89, 12)'],['0.268', 'rgb(253, 113, 18)'],['0.335', 'rgb(253, 137, 24)'],['0.402', 'rgb(253, 161, 30)'],['0.469', 'rgb(253, 185, 36)'],['0.536', 'rgb(253, 209, 42)'],['0.603', 'rgb(253, 233, 48)'],['0.670', 'rgb(253, 255, 54)'],['0.737', 'rgb(252, 255, 69)'],['0.804', 'rgb(253, 255, 136)'],['0.871', 'rgb(253, 255, 170)'],['0.938', 'rgb(254, 255, 207)'],['1.0', 'rgb(254, 255, 207)']]}], layout, config);
          }
        )}


      // Function to call yellow-red plot
      function k_function(){
        $(function () {
        Plotly.newPlot('myDiv',[{x: xValues, y: yValues, z: zValues, text: text, hoverinfo: 'text', hoverlabel: {bgcolor: '#41454c'}, layout: layout, colorbar: colorbar, type: 'heatmap', colorscale: [['0.0', 'rgb(254, 255, 207)'],['0.067', 'rgb(253, 255, 136)'],['0.134', 'rgb(252, 255, 69)'],['0.201', 'rgb(253, 255, 54)'],['0.268', 'rgb(253, 233, 48)'],['0.335', 'rgb(253, 209, 42)'],['0.402', 'rgb(253, 185, 36)'],['0.469', 'rgb(253, 161, 30)'],['0.536', 'rgb(253, 137, 24)'],['0.603', 'rgb(253, 113, 18)'],['0.670', 'rgb(253, 89, 12)'],['0.737', 'rgb(253, 63, 6)'],['0.804', 'rgb(253, 33, 2)'],['0.871', 'rgb(253, 16, 1)'],['0.938', 'rgb(253, 0, 0)'],['1.0', 'rgb(253, 0, 0)']]}], layout, config);
          }
        )}


    </script>
<?php }





// define heatmap plot parameters for plotting Arabidopsis thaliana AVERAGED REPLICATE data here
// AVERAGED REPLICATE data will be plotted if number of entities found is >1250
else if (($_POST['filter4'] == "heatmap" && $_POST['filter1'] == "Arabidopsis_thaliana" && ($count > 1250) && $_POST['filter6'] != "1") || ($_POST['filter4'] == "heatmap" && $_POST['filter1'] == "Arabidopsis_thaliana" && $_POST['filter6'] == "1" && $count == 1)) { ?>

    <script type="text/javascript">

        // Function to call viridis plot (standard setup)
        var zValues = <?php if (($_POST['filter5'] == "0" || $_POST['filter5'] == "2")) { 
                           echo $valuesout; 
                           } else if ($_POST['filter5'] == "1") { 
                           echo $valueslogout; }
                           ?>;
        var yValues = <?php echo $keys2out; ?>;
        var xValues = 
        ['root_root tip_5d', 'root_maturation zone_5d', 'root_whole root_5d', 'root_whole root_7d', 'root_whole root_14d', 'root_whole root_21d', 'hypocotyl_10d', '3rd internode_24d', '2nd internode_24d', '1st internode_28d', 'cotyledons_7d', 'leaf 1+2_7d', 'leaf 1+2_10d', 'leaf 1+2_petiole_10d', 'leaf 1+2_leaf tip_10d', 'leaf_5+6_17d', 'leaf_9+10_27d', 'leaves senescing_35d', 'cauline leaves_24d', 'apex vegetative_7d', 'apex vegetative_10d', 'apex vegetative_14d', 'apex inflorescence_21d', 'apex inflorescence_28d', 'apex inflorescence_clv1_21d', 'flower stg9_21d+', 'flower stg10/11_21d+', 'flower stg12_21d+', 'flower stg15_21d+', 'flower stg12_sepals', 'flower stg15_sepals', 'flower stg12_petals', 'flower stg15_petals', 'flower stg12_stamens', 'flower stg15_stamens', 'mature pollen_28d+', 'flower early stg12_carpels', 'flower late stg12_carpels', 'flower stg15_carpels', 'fruit stg16_siliques', 'fruit stg17a_siliques', 'fruit stg16_seeds', 'fruit stg17a_seeds', 'fruit stg18_seeds'];

        var title = <?php echo $titleout; ?>;

        var ticknumber = <?php if($countout == 1) { ?> 3;
                     <?php } else { ?> 0; <?php } ?>;

        var ticklabels = ['root_root tip_5d', 'root_maturation zone_5d', 'root_whole root_5d', 'root_whole root_7d', 'root_whole root_14d', 'root_whole root_21d', 'hypocotyl_10d', '3rd internode_24d', '2nd internode_24d', '1st internode_28d', 'cotyledons_7d', 'leaf 1+2_7d', 'leaf 1+2_10d', 'leaf 1+2_petiole_10d', 'leaf 1+2_leaf tip_10d', 'leaf_5+6_17d', 'leaf_9+10_27d', 'leaves senescing_35d', 'cauline leaves_24d', 'apex vegetative_7d', 'apex vegetative_10d', 'apex vegetative_14d', 'apex inflorescence_21d', 'apex inflorescence_28d', 'apex inflorescence_clv1_21d', 'flower stg9_21d+', 'flower stg10/11_21d+', 'flower stg12_21d+', 'flower stg15_21d+', 'flower stg12_sepals', 'flower stg15_sepals', 'flower stg12_petals', 'flower stg15_petals', 'flower stg12_stamens', 'flower stg15_stamens', 'mature pollen_28d+', 'flower early stg12_carpels', 'flower late stg12_carpels', 'flower stg15_carpels', 'fruit stg16_siliques', 'fruit stg17a_siliques', 'fruit stg16_seeds', 'fruit stg17a_seeds', 'fruit stg18_seeds'];

        var colorbar = {
          title: title,
          titlefont: {
          size: 12,
          },
          titleside: "top",
          thickness: 20,
          nticks: ticknumber,
          tickfont: {
          size:10.5
          },
          outlinewidth: 0,
          xpad: 1,
          ypad:3
          };

        var height = <?php echo $reqheightout; ?>;
 
        var layout = {
          paper_bgcolor: 'rgba(255,255,255,0)',
          height: height,
          margin: {
            l: 105,
            r: 105,
            b: 202,
            t: 38,
            pad: 0
          },
          xaxis: {
            showticklabels: true,
            tickangle: 90,
            tickvals: ticklabels,
            tickfont: {
              size: 11.75,
              color: 'black'
            }},
          yaxis: {
            showticklabels: true,
            tickangle: 0,
            tickfont: {
              size: 11.75,
              color: 'black'
            }}
          };



        // fill in 'text' array for hover
        var text = zValues.map (function(zValues, i) { return zValues.map (function (value, j) {
            return ` ID: ${yValues[i]}<br> Tissue: ${xValues[j]}<br> Expression: ${value.toFixed(2)} `
            });
          });

        // format modebar, add svg download icon, activate responsive design
        var config = {
            modeBarButtonsToRemove: ['sendDataToCloud', 'autoScale2d', 'hoverClosestCartesian', 'hoverCompareCartesian', 'lasso2d', 'select2d', 'toggleSpikelines'],
            displayModeBar: true,
            responsive: true,
            toImageButtonOptions: {
              filename: 'devseq_plot',
              width: 1020,
            },
            modeBarButtonsToAdd: [{
            name: 'Download plot as a svg',
            icon: Plotly.Icons.disk,
            click: function(gd) {
              gd.layout.width = gd.offsetWidth;
              gd.layout.height = gd.offsetHeight;
              Plotly.downloadImage(gd, {filename: 'devseq_plot', format: 'svg'})
              }
            }],
            displaylogo: false
          };

      Plotly.newPlot('myDiv', [{x: xValues, y: yValues, z: zValues, text: text, hoverinfo: 'text', hoverlabel: {bgcolor: '#41454c'}, layout: layout, colorbar: colorbar, type: 'heatmap', colorscale: [['0', 'rgb(64, 1, 82)'],['0.01', 'rgb(68, 1, 84)'],['0.05', 'rgb(71, 17, 102)'],['0.10', 'rgb(73, 34, 117)'],['0.1475', 'rgb(72, 49, 130)'],['0.195', 'rgb(67, 62, 135)'],['0.2425', 'rgb(64, 77, 143)'],['0.29', 'rgb(58, 90, 145)'],['0.3375', 'rgb(52, 103, 148)'],['0.385', 'rgb(47, 116, 148)'],['0.425', 'rgb(41, 124, 145)'],['0.465', 'rgb(38, 136, 145)'],['0.505', 'rgb(33, 145, 142)'],['0.545', 'rgb(31, 155, 137)'],['0.585', 'rgb(34, 165, 132)'],['0.63', 'rgb(42, 175, 126)'],['0.675', 'rgb(59, 185, 117)'],['0.725', 'rgb(80, 195, 105)'],['0.77', 'rgb(105, 204, 90)'],['0.815', 'rgb(132, 212, 74)'],['0.8625', 'rgb(169, 217, 55)'],['0.91', 'rgb(202, 222, 36)'],['0.95', 'rgb(223, 227, 27)'],['0.99', 'rgb(251, 230, 36)'],['1.0', 'rgb(251, 230, 36)']]}], layout, config);



      // Function to call viridis plot
      function f_function(){
        $(function () {
        Plotly.newPlot('myDiv',[{x: xValues, y: yValues, z: zValues, text: text, hoverinfo: 'text', hoverlabel: {bgcolor: '#41454c'}, layout: layout, colorbar: colorbar, type: 'heatmap', colorscale: [['0', 'rgb(64, 1, 82)'],['0.01', 'rgb(68, 1, 84)'],['0.05', 'rgb(71, 17, 102)'],['0.10', 'rgb(73, 34, 117)'],['0.1475', 'rgb(72, 49, 130)'],['0.195', 'rgb(67, 62, 135)'],['0.2425', 'rgb(64, 77, 143)'],['0.29', 'rgb(58, 90, 145)'],['0.3375', 'rgb(52, 103, 148)'],['0.385', 'rgb(47, 116, 148)'],['0.425', 'rgb(41, 124, 145)'],['0.465', 'rgb(38, 136, 145)'],['0.505', 'rgb(33, 145, 142)'],['0.545', 'rgb(31, 155, 137)'],['0.585', 'rgb(34, 165, 132)'],['0.63', 'rgb(42, 175, 126)'],['0.675', 'rgb(59, 185, 117)'],['0.725', 'rgb(80, 195, 105)'],['0.77', 'rgb(105, 204, 90)'],['0.815', 'rgb(132, 212, 74)'],['0.8625', 'rgb(169, 217, 55)'],['0.91', 'rgb(202, 222, 36)'],['0.95', 'rgb(223, 227, 27)'],['0.99', 'rgb(251, 230, 36)'],['1.0', 'rgb(251, 230, 36)']]}], layout, config);
          }
        )}


      // Function to call blue plot
      function g_function(){
        $(function () {
        Plotly.newPlot('myDiv',[{x: xValues, y: yValues, z: zValues, text: text, hoverinfo: 'text', hoverlabel: {bgcolor: '#41454c'}, layout: layout, colorbar: colorbar, type: 'heatmap', colorscale: [['0.0', 'rgb(245, 250, 254)'],['0.1', 'rgb(226, 237, 248)'],['0.2', 'rgb(207, 225, 242)'],['0.3', 'rgb(180, 211, 233)'],['0.4', 'rgb(146, 195, 223)'],['0.5', 'rgb(108, 173, 213)'],['0.6', 'rgb(74, 151, 201)'],['0.7', 'rgb(47, 126, 188)'],['0.8', 'rgb( 24, 100, 170)'],['0.9', 'rgb(10, 74, 144)'],['1.0', 'rgb(9, 57, 127)']]}], layout, config);
          }
        )}


      // Function to call red plot
      function h_function(){
        $(function () {
        Plotly.newPlot('myDiv', [{x: xValues, y: yValues, z: zValues, text: text, hoverinfo: 'text', hoverlabel: {bgcolor: '#41454c'}, layout: layout, colorbar: colorbar, type: 'heatmap', colorscale: [['0.0', 'rgb(254, 245, 245)'],['0.11', 'rgb(249, 225, 215)'],['0.22', 'rgb(244, 201, 182)'],['0.33', 'rgb(240, 168, 145)'],['0.44', 'rgb(231, 126, 107)'],['0.55', 'rgb(217, 73, 64)'],['0.66', 'rgb(197, 38, 40)'],['0.77', 'rgb(162, 23, 28)'],['0.88', 'rgb(127, 13, 24)'],['1.0', 'rgb(98, 2, 14)']]}], layout, config);
          }
        )}


      // Function to call green plot
      function i_function(){
        $(function () {
        Plotly.newPlot('myDiv', [{x: xValues, y: yValues, z: zValues, text: text, hoverinfo: 'text', hoverlabel: {bgcolor: '#41454c'}, layout: layout, colorbar: colorbar, type: 'heatmap', colorscale: [['0.0', 'rgb(245, 252, 234)'],['0.11112', 'rgb(228, 240, 195)'],['0.22223', 'rgb(207, 224, 154)'],['0.33334', 'rgb(181, 206, 109)'],['0.44445', 'rgb(154, 187, 83)'],['0.55556', 'rgb(116, 165, 63)'],['0.66667', 'rgb(72, 138, 44)'],['0.77778', 'rgb(33, 113, 29)'],['0.88889', 'rgb(9, 96, 21)'],['1.0', 'rgb(0, 87, 18)']]}], layout, config);
          }
        )}


      // Function to call red-yellow plot
      function j_function(){
        $(function () {
        Plotly.newPlot('myDiv',[{x: xValues, y: yValues, z: zValues, text: text, hoverinfo: 'text', hoverlabel: {bgcolor: '#41454c'}, layout: layout, colorbar: colorbar, type: 'heatmap', colorscale: [['0.0', 'rgb(253, 0, 0)'],['0.067', 'rgb(253, 33, 2)'],['0.134', 'rgb(253, 63, 6)'],['0.201', 'rgb(253, 89, 12)'],['0.268', 'rgb(253, 113, 18)'],['0.335', 'rgb(253, 137, 24)'],['0.402', 'rgb(253, 161, 30)'],['0.469', 'rgb(253, 185, 36)'],['0.536', 'rgb(253, 209, 42)'],['0.603', 'rgb(253, 233, 48)'],['0.670', 'rgb(253, 255, 54)'],['0.737', 'rgb(252, 255, 69)'],['0.804', 'rgb(253, 255, 136)'],['0.871', 'rgb(253, 255, 170)'],['0.938', 'rgb(254, 255, 207)'],['1.0', 'rgb(254, 255, 207)']]}], layout, config);
          }
        )}


      // Function to call yellow-red plot
      function k_function(){
        $(function () {
        Plotly.newPlot('myDiv',[{x: xValues, y: yValues, z: zValues, text: text, hoverinfo: 'text', hoverlabel: {bgcolor: '#41454c'}, layout: layout, colorbar: colorbar, type: 'heatmap', colorscale: [['0.0', 'rgb(254, 255, 207)'],['0.067', 'rgb(253, 255, 136)'],['0.134', 'rgb(252, 255, 69)'],['0.201', 'rgb(253, 255, 54)'],['0.268', 'rgb(253, 233, 48)'],['0.335', 'rgb(253, 209, 42)'],['0.402', 'rgb(253, 185, 36)'],['0.469', 'rgb(253, 161, 30)'],['0.536', 'rgb(253, 137, 24)'],['0.603', 'rgb(253, 113, 18)'],['0.670', 'rgb(253, 89, 12)'],['0.737', 'rgb(253, 63, 6)'],['0.804', 'rgb(253, 33, 2)'],['0.871', 'rgb(253, 16, 1)'],['0.938', 'rgb(253, 0, 0)'],['1.0', 'rgb(253, 0, 0)']]}], layout, config);
          }
        )}


    </script>
<?php }




// define heatmap plot parameters for plotting non-Arabidopsis thaliana data here
else if (($_POST['filter4'] == "heatmap" && $_POST['filter1'] != "Arabidopsis_thaliana" && ($count > 0) && $_POST['filter6'] != "1") || ($_POST['filter4'] == "heatmap" && $_POST['filter1'] != "Arabidopsis_thaliana" && $_POST['filter6'] == "1" && $count == 1)) { ?>

    <script type="text/javascript">
        var zValues = <?php if (($_POST['filter5'] == "0" || $_POST['filter5'] == "2")) { 
                           echo $valuesout; 
                           } else if ($_POST['filter5'] == "1") { 
                           echo $valueslogout; }
                           ?>;
        var yValues = <?php echo $keys2out; ?>;

        // define x axis labels depending on selected species
        var xValues = 
        <?php if($_POST['filter1'] == "Capsella_rubella") { ?>
        ['root, whole root, 4d.1', 'root, whole root, 4d.2', 'root, whole root, 4d.3', 'hypocotyl, 9d.1', 'hypocotyl, 9d.2', 'hypocotyl, 9d.3', 'leaf 1+2, 7d.1', 'leaf 1+2, 7d.2', 'leaf 1+2, 7d.3', 'apex vegetative, 7d.1', 'apex vegetative, 7d.2', 'apex vegetative, 7d.3', 'apex inflorescence.1', 'apex inflorescence.2', 'apex inflorescence.3', 'flower stg12.1', 'flower stg12.2', 'flower stg12.3', 'flower stg12, carpels.1', 'flower stg12, carpels.2', 'flower stg12, carpels.3', 'flower stg12, stamens.1', 'flower stg12, stamens.2', 'flower stg12, stamens.3', 'mature pollen.1', 'mature pollen.2', 'mature pollen.3'];
        <?php } 
        else if ($_POST['filter1'] == "Eutrema_salsugineum") { ?>
        ['root, whole root, 6d.1', 'root, whole root, 6d.2', 'root, whole root, 6d.3', 'hypocotyl, 12d.1', 'hypocotyl, 12d.2', 'hypocotyl, 12d.3', 'leaf 1+2, 9d.1', 'leaf 1+2, 9d.2', 'leaf 1+2, 9d.3', 'apex vegetative, 9d.1', 'apex vegetative, 9d.2', 'apex vegetative, 9d.3', 'apex inflorescence.1', 'apex inflorescence.2', 'apex inflorescence.3', 'flower stg12.1', 'flower stg12.2', 'flower stg12.3', 'flower stg12, carpels.1', 'flower stg12, carpels.2', 'flower stg12, carpels.3', 'flower stg12, stamens.1', 'flower stg12, stamens.2', 'flower stg12, stamens.3', 'mature pollen.1', 'mature pollen.2', 'mature pollen.3'];
        <?php } 
        else if ($_POST['filter1'] == "Medicago_truncatula") { ?>
        ['root, whole root, 4d.1', 'root, whole root, 4d.2', 'root, whole root, 4d.3', 'hypocotyl, 8d.1', 'hypocotyl, 8d.2', 'hypocotyl, 8d.3', 'leaf 2, 7d.1', 'leaf 2, 7d.2', 'leaf 2, 7d.3', 'apex vegetative, 6d.1', 'apex vegetative, 6d.2', 'apex vegetative, 6d.3', 'meristem inflorescence.1', 'meristem inflorescence.2', 'meristem inflorescence.3', 'flower stg8.1', 'flower stg8.2', 'flower stg8.3', 'flower stg8, carpels.1', 'flower stg8, carpels.2', 'flower stg8, carpels.3', 'flower stg8, stamens.1', 'flower stg8, stamens.2', 'flower stg8, stamens.3', 'mature pollen.1', 'mature pollen.2', 'mature pollen.3'];
        <?php } ?>

        var title = <?php echo $titleout; ?>;

        var ticknumber = <?php if($countout == 1) { ?> 3;
                     <?php } else { ?> 0; <?php } ?>;

        var colorbar = {
          title: title,
          titlefont: {
          size: 12,
          },
          titleside: "top",
          thickness: 20,
          nticks: ticknumber,
          tickfont: {
          size:10.5
          },
          outlinewidth: 0,
          xpad: 1,
          ypad:3
          };

        var height = <?php echo $reqheightout; ?>;
    
        var layout = <?php if($countout < 5) { ?> {
          paper_bgcolor: 'rgba(255,255,255,0)',
          height: height,
          margin: {
            l: 148,
            r: 148,
            b: 181,
            t: 62,
            pad: 0
          },
          xaxis: {
            showticklabels: true,
            tickangle: 90,
            tickfont: {
              size: 11.75,
              color: 'black'
          }},
          yaxis: {
            showticklabels: true,
            tickangle: 0,
            tickfont: {
              size: 11.75,
              color: 'black'
          }}
        }; 

        <?php } else if ($countout < 10) { ?> {
          paper_bgcolor: 'rgba(255,255,255,0)',
          height: height,
          margin: {
            l: 148,
            r: 148,
            b: 187,
            t: 53,
            pad: 0
          },
          xaxis: {
            showticklabels: true,
            tickangle: 90,
            tickfont: {
              size: 11.75,
              color: 'black'
            }},
          yaxis: {
            showticklabels: true,
            tickangle: 0,
            tickfont: {
              size: 11.75,
              color: 'black'
            }}
          };
      
        <?php } else { ?> {
          paper_bgcolor: 'rgba(255,255,255,0)',
          height: height,
          margin: {
            l: 148,
            r: 148,
            b: 202,
            t: 38,
            pad: 0
          },
          xaxis: {
            showticklabels: true,
            tickangle: 90,
            tickfont: {
              size: 11.75,
              color: 'black'
            }},
          yaxis: {
            showticklabels: true,
            tickangle: 0,
            tickfont: {
              size: 11.75,
              color: 'black'
            }}
          };
        <?php } ?>;


        // fill in 'text' array for hover
        var text = zValues.map (function(zValues, i) { return zValues.map (function (value, j) {
            return ` ID: ${yValues[i]}<br> Tissue: ${xValues[j]}<br> Expression: ${value.toFixed(2)} `
            });
          });

        // format modebar, add svg download icon, activate responsive design
        var config = {
            displayModeBar: true,
            responsive: true,
            toImageButtonOptions: {
              filename: 'devseq_plot',
              width: 1020,
            },
            modeBarButtonsToRemove: ['sendDataToCloud', 'autoScale2d', 'hoverClosestCartesian', 'hoverCompareCartesian', 'lasso2d', 'select2d', 'toggleSpikelines'],
            modeBarButtonsToAdd: [{
            name: 'Download plot as a svg',
            icon: Plotly.Icons.disk,
            click: function(gd) {
            Plotly.downloadImage(gd, {format: 'svg'})
            } 
            }],
            displaylogo: false
          };

      Plotly.newPlot('myDiv',[{x: xValues, y: yValues, z: zValues, text: text, hoverinfo: 'text', hoverlabel: {bgcolor: '#41454c'}, layout: layout, colorbar: colorbar, type: 'heatmap', colorscale: [['0', 'rgb(64, 1, 82)'],['0.01', 'rgb(68, 1, 84)'],['0.05', 'rgb(71, 17, 102)'],['0.10', 'rgb(73, 34, 117)'],['0.1475', 'rgb(72, 49, 130)'],['0.195', 'rgb(67, 62, 135)'],['0.2425', 'rgb(64, 77, 143)'],['0.29', 'rgb(58, 90, 145)'],['0.3375', 'rgb(52, 103, 148)'],['0.385', 'rgb(47, 116, 148)'],['0.425', 'rgb(41, 124, 145)'],['0.465', 'rgb(38, 136, 145)'],['0.505', 'rgb(33, 145, 142)'],['0.545', 'rgb(31, 155, 137)'],['0.585', 'rgb(34, 165, 132)'],['0.63', 'rgb(42, 175, 126)'],['0.675', 'rgb(59, 185, 117)'],['0.725', 'rgb(80, 195, 105)'],['0.77', 'rgb(105, 204, 90)'],['0.815', 'rgb(132, 212, 74)'],['0.8625', 'rgb(169, 217, 55)'],['0.91', 'rgb(202, 222, 36)'],['0.95', 'rgb(223, 227, 27)'],['0.99', 'rgb(251, 230, 36)'],['1.0', 'rgb(251, 230, 36)']]}], layout, config);



      // Function to call viridis plot for non-Arabidopsis thaliana species
      function r_function(){
        $(function () {
        Plotly.newPlot('myDiv',[{x: xValues, y: yValues, z: zValues, text: text, hoverinfo: 'text', hoverlabel: {bgcolor: '#41454c'}, layout: layout, colorbar: colorbar, type: 'heatmap', colorscale: [['0', 'rgb(64, 1, 82)'],['0.01', 'rgb(68, 1, 84)'],['0.05', 'rgb(71, 17, 102)'],['0.10', 'rgb(73, 34, 117)'],['0.1475', 'rgb(72, 49, 130)'],['0.195', 'rgb(67, 62, 135)'],['0.2425', 'rgb(64, 77, 143)'],['0.29', 'rgb(58, 90, 145)'],['0.3375', 'rgb(52, 103, 148)'],['0.385', 'rgb(47, 116, 148)'],['0.425', 'rgb(41, 124, 145)'],['0.465', 'rgb(38, 136, 145)'],['0.505', 'rgb(33, 145, 142)'],['0.545', 'rgb(31, 155, 137)'],['0.585', 'rgb(34, 165, 132)'],['0.63', 'rgb(42, 175, 126)'],['0.675', 'rgb(59, 185, 117)'],['0.725', 'rgb(80, 195, 105)'],['0.77', 'rgb(105, 204, 90)'],['0.815', 'rgb(132, 212, 74)'],['0.8625', 'rgb(169, 217, 55)'],['0.91', 'rgb(202, 222, 36)'],['0.95', 'rgb(223, 227, 27)'],['0.99', 'rgb(251, 230, 36)'],['1.0', 'rgb(251, 230, 36)']]}], layout, config);
          }
        )}


      // Function to call blue plot for non-Arabidopsis thaliana species
      function s_function(){
        $(function () {
        Plotly.newPlot('myDiv',[{x: xValues, y: yValues, z: zValues, text: text, hoverinfo: 'text', hoverlabel: {bgcolor: '#41454c'}, layout: layout, colorbar: colorbar, type: 'heatmap', colorscale: [['0.0', 'rgb(245, 250, 254)'],['0.1', 'rgb(226, 237, 248)'],['0.2', 'rgb(207, 225, 242)'],['0.3', 'rgb(180, 211, 233)'],['0.4', 'rgb(146, 195, 223)'],['0.5', 'rgb(108, 173, 213)'],['0.6', 'rgb(74, 151, 201)'],['0.7', 'rgb(47, 126, 188)'],['0.8', 'rgb( 24, 100, 170)'],['0.9', 'rgb(10, 74, 144)'],['1.0', 'rgb(9, 57, 127)']]}], layout, config);
          }
        )}


      // Function to call red plot for non-Arabidopsis thaliana species
      function t_function(){
        $(function () {
        Plotly.newPlot('myDiv',[{x: xValues, y: yValues, z: zValues, text: text, hoverinfo: 'text', hoverlabel: {bgcolor: '#41454c'}, layout: layout, colorbar: colorbar, type: 'heatmap', colorscale: [['0.0', 'rgb(254, 245, 245)'],['0.11', 'rgb(249, 225, 215)'],['0.22', 'rgb(244, 201, 182)'],['0.33', 'rgb(240, 168, 145)'],['0.44', 'rgb(231, 126, 107)'],['0.55', 'rgb(217, 73, 64)'],['0.66', 'rgb(197, 38, 40)'],['0.77', 'rgb(162, 23, 28)'],['0.88', 'rgb(127, 13, 24)'],['1.0', 'rgb(98, 2, 14)']]}], layout, config);
          }
        )}


      // Function to call green plot for non-Arabidopsis thaliana species
      function u_function(){
        $(function () {
        Plotly.newPlot('myDiv',[{x: xValues, y: yValues, z: zValues, text: text, hoverinfo: 'text', hoverlabel: {bgcolor: '#41454c'}, layout: layout, colorbar: colorbar, type: 'heatmap', colorscale: [['0.0', 'rgb(245, 252, 234)'],['0.11112', 'rgb(228, 240, 195)'],['0.22223', 'rgb(207, 224, 154)'],['0.33334', 'rgb(181, 206, 109)'],['0.44445', 'rgb(154, 187, 83)'],['0.55556', 'rgb(116, 165, 63)'],['0.66667', 'rgb(72, 138, 44)'],['0.77778', 'rgb(33, 113, 29)'],['0.88889', 'rgb(9, 96, 21)'],['1.0', 'rgb(0, 87, 18)']]}], layout, config);
          }
        )}


      // Function to call red-yellow plot for non-Arabidopsis thaliana species
      function v_function(){
        $(function () {
        Plotly.newPlot('myDiv',[{x: xValues, y: yValues, z: zValues, text: text, hoverinfo: 'text', hoverlabel: {bgcolor: '#41454c'}, layout: layout, colorbar: colorbar, type: 'heatmap', colorscale: [['0.0', 'rgb(253, 0, 0)'],['0.067', 'rgb(253, 33, 2)'],['0.134', 'rgb(253, 63, 6)'],['0.201', 'rgb(253, 89, 12)'],['0.268', 'rgb(253, 113, 18)'],['0.335', 'rgb(253, 137, 24)'],['0.402', 'rgb(253, 161, 30)'],['0.469', 'rgb(253, 185, 36)'],['0.536', 'rgb(253, 209, 42)'],['0.603', 'rgb(253, 233, 48)'],['0.670', 'rgb(253, 255, 54)'],['0.737', 'rgb(252, 255, 69)'],['0.804', 'rgb(253, 255, 136)'],['0.871', 'rgb(253, 255, 170)'],['0.938', 'rgb(254, 255, 207)'],['1.0', 'rgb(254, 255, 207)']]}], layout, config);
          }
        )}


      // Function to call yellow-red plot for non-Arabidopsis thaliana species
      function w_function(){
      $(function () {
        Plotly.newPlot('myDiv',[{x: xValues, y: yValues, z: zValues, text: text, hoverinfo: 'text', hoverlabel: {bgcolor: '#41454c'}, layout: layout, colorbar: colorbar, type: 'heatmap', colorscale: [['0.0', 'rgb(254, 255, 207)'],['0.067', 'rgb(253, 255, 136)'],['0.134', 'rgb(252, 255, 69)'],['0.201', 'rgb(253, 255, 54)'],['0.268', 'rgb(253, 233, 48)'],['0.335', 'rgb(253, 209, 42)'],['0.402', 'rgb(253, 185, 36)'],['0.469', 'rgb(253, 161, 30)'],['0.536', 'rgb(253, 137, 24)'],['0.603', 'rgb(253, 113, 18)'],['0.670', 'rgb(253, 89, 12)'],['0.737', 'rgb(253, 63, 6)'],['0.804', 'rgb(253, 33, 2)'],['0.871', 'rgb(253, 16, 1)'],['0.938', 'rgb(253, 0, 0)'],['1.0', 'rgb(253, 0, 0)']]}], layout, config);
          }
        )}

    </script>
<?php }




// define hclust viridis heatmap plot parameters for plotting Arabidopsis thaliana data here
else if ($_POST['filter4'] == "heatmap" && $_POST['filter1'] == "Arabidopsis_thaliana" && ($count > 1) && ($count < 1251) && $_POST['filter6'] == "1") { ?>

    <script type="text/javascript">
        // Function to call viridis plot (standard plot)
        var zValues = <?php echo $valuesclustout; ?>;                       
        var yValues = <?php echo $keysclustout; ?>;
        var xValues = 
        ['root, root tip, 5d.1', 'root, root tip, 5d.2', 'root, root tip, 5d.3', 'root, maturation zone, 5d.1', 'root, maturation zone, 5d.2', 'root, maturation zone, 5d.3', 'root, whole root, 5d.1', 'root, whole root_5d.2', 'root, whole root, 5d.3', 'root, whole root, 7d.1', 'root, whole root, 7d.2', 'root, whole root, 7d.3', 'root, whole root, 14d.1', 'root, whole root, 14d.2', 'root, whole root, 14d.3', 'root, whole root, 21d.1', 'root, whole root, 21d.2', 'root, whole root, 21d.3', 'hypocotyl, 10d.1', 'hypocotyl, 10d.2', 'hypocotyl, 10d.3', '3rd internode, 24d.1', '3rd internode, 24d.2', '3rd internode, 24d.3', '2nd internode, 24d.1', '2nd internode, 24d.2', '2nd internode, 24d.3', '1st internode, 28d.1', '1st internode, 28d.2', '1st internode, 28d.3', 'cotyledons, 7d.1', 'cotyledons, 7d.2', 'cotyledons, 7d.3', 'leaf 1+2, 7d.1', 'leaf 1+2, 7d.2', 'leaf 1+2, 7d.3', 'leaf 1+2, 10d.1', 'leaf 1+2, 10d.2', 'leaf 1+2, 10d.3', 'leaf 1+2, petiole, 10d.1', 'leaf 1+2, petiole, 10d.2', 'leaf 1+2, petiole, 10d.3', 'leaf 1+2, leaf tip, 10d.1', 'leaf 1+2, leaf tip, 10d.2', 'leaf 1+2, leaf tip, 10d.3', 'leaf 5+6, 17d.1', 'leaf 5+6, 17d.2', 'leaf 5+6, 17d.3', 'leaf 9+10, 27d.1', 'leaf 9+10, 27d.2', 'leaf 9+10, 27d.3', 'leaves senescing, 35d.1', 'leaves senescing, 35d.2', 'leaves senescing, 35d.3', 'cauline leaves, 24d.1', 'cauline leaves, 24d.2', 'cauline leaves, 24d.3', 'apex vegetative, 7d.1', 'apex vegetative, 7d.2', 'apex vegetative, 7d.3', 'apex vegetative, 10d.1', 'apex vegetative, 10d.2', 'apex vegetative, 10d.3', 'apex vegetative, 14d.1', 'apex vegetative, 14d.2', 'apex vegetative, 14d.3', 'apex inflorescence, 21d.1', 'apex inflorescence, 21d.2', 'apex inflorescence, 21d.3', 'apex inflorescence, 28d.1', 'apex inflorescence, 28d.2', 'apex inflorescence, 28d.3', 'apex inflor. clv1, 21d.1', 'apex inflor. clv1, 21d.2', 'apex inflor. clv1, 21d.3', 'flower stg9, 21d+.1', 'flower stg9, 21d+.2', 'flower stg9, 21d+.3', 'flower stg10/11, 21d+.1', 'flower stg10/11, 21d+.2', 'flower stg10/11, 21d+.3', 'flower stg12, 21d+.1', 'flower stg12, 21d+.2', 'flower stg12, 21d+.3', 'flower stg15, 21d+.1', 'flower stg15, 21d+.2', 'flower stg15, 21d+.3', 'flower stg12, sepals.1', 'flower stg12, sepals.2', 'flower stg12, sepals.3', 'flower stg15, sepals.1', 'flower stg15, sepals.2', 'flower stg15, sepals.3', 'flower stg12, petals.1', 'flower stg12, petals.2', 'flower stg12, petals.3', 'flower stg15, petals.1', 'flower stg15, petals.2', 'flower stg15, petals.3', 'flower stg12, stamens.1', 'flower stg12, stamens.2', 'flower stg12, stamens.3', 'flower stg15, stamens.1', 'flower stg15, stamens.2', 'flower stg15, stamens.3', 'mature pollen, 28d+.1', 'mature pollen, 28d+.2', 'mature pollen, 28d+.3', 'flower early stg12, carpels.1', 'flower early stg12, carpels.2', 'flower early stg12, carpels.3', 'flower late stg12, carpels.1', 'flower late stg12, carpels.2', 'flower late stg12, carpels.3', 'flower stg15, carpels.1', 'flower stg15, carpels.2', 'flower stg15, carpels.3', 'fruit stg16, siliques.1', 'fruit stg16, siliques.2', 'fruit stg16, siliques.3', 'fruit stg17a, siliques.1', 'fruit stg17a, siliques.2', 'fruit stg17a, siliques.3', 'fruit stg16, seeds.1', 'fruit stg16, seeds.2', 'fruit stg16, seeds.3', 'fruit stg17a, seeds.1', 'fruit stg17a, seeds.2', 'fruit stg17a, seeds.3', 'fruit stg18, seeds.1', 'fruit stg18, seeds.2', 'fruit stg18, seeds.3'];

        var title = <?php echo $titleout; ?>;

        var ticknumber = <?php if($countout == 1) { ?> 3;
                     <?php } else { ?> 0; <?php } ?>;

        var ticklabels = ['root, root tip, 5d.1', 'root, maturation zone, 5d.1', 'root, whole root, 5d.1', 'root, whole root, 7d.1', 'root, whole root, 14d.1', 'root, whole root, 21d.1', 'hypocotyl, 10d.1', '3rd internode, 24d.1',  '2nd internode, 24d.1', '1st internode, 28d.1', 'cotyledons, 7d.1', 'leaf 1+2, 7d.1', 'leaf 1+2, 10d.1', 'leaf 1+2, petiole, 10d.1', 'leaf 1+2, leaf tip, 10d.1', 'leaf 5+6, 17d.1', 'leaf 9+10, 27d.1', 'leaves senescing, 35d.1', 'cauline leaves, 24d.1', 'apex vegetative, 7d.1', 'apex vegetative, 10d.1', 'apex vegetative, 14d.1', 'apex inflorescence, 21d.1', 'apex inflorescence, 28d.1', 'apex inflor. clv1, 21d.1', 'flower stg9, 21d+.1', 'flower stg10/11, 21d+.1', 'flower stg12, 21d+.1', 'flower stg15, 21d+.1', 'flower stg12, sepals.1', 'flower stg15, sepals.1', 'flower stg12, petals.1', 'flower stg15, petals.1', 'flower stg12, stamens.1', 'flower stg15, stamens.1', 'mature pollen, 28d+.1', 'flower early stg12, carpels.1', 'flower late stg12, carpels.1', 'flower stg15, carpels.1', 'fruit stg16, siliques.1', 'fruit stg17a, siliques.1', 'fruit stg16, seeds.1', 'fruit stg17a, seeds.1', 'fruit stg18, seeds.1'];

        var colorbar = {
          title: title,
          titlefont: {
            size: 12,
          },
          titleside: "top",
          thickness: 20,
          nticks: ticknumber,
          tickfont: {
            size:10.5
          },
          outlinewidth: 0,
          xpad: 1,
          ypad:3
        };

        var height = <?php echo $reqheightout; ?>;

        var layout = <?php if($countout < 5) { ?> {
          paper_bgcolor: 'rgba(255,255,255,0)',
          height: height,
          margin: {
            l: 105,
            r: 105,
            b: 181,
            t: 62,
            pad: 0
          },
          xaxis: {
            showticklabels: true,
            tickangle: 90,
            tickvals: ticklabels,
            tickfont: {
              size: 11.75,
              color: 'black'
          }},
          yaxis: {
            showticklabels: true,
            tickangle: 0,
            tickfont: {
              size: 11.75,
              color: 'black'
            }}
          };

          <?php } else if ($countout < 10) { ?> {
          paper_bgcolor: 'rgba(255,255,255,0)',
          height: height,
          margin: {
            l: 105,
            r: 105,
            b: 187,
            t: 53,
            pad: 0
          },
          xaxis: {
            showticklabels: true,
            tickangle: 90,
            tickvals: ticklabels,
            tickfont: {
              size: 11.75,
              color: 'black'
          }},
          yaxis: {
            showticklabels: true,
            tickangle: 0,
            tickfont: {
              size: 11.75,
              color: 'black'
            }}
          };
      
          <?php } else { ?> {
          paper_bgcolor: 'rgba(255,255,255,0)',
          height: height,
          margin: {
            l: 105,
            r: 105,
            b: 202,
            t: 38,
            pad: 0
          },
          xaxis: {
            showticklabels: true,
            tickangle: 90,
            tickvals: ticklabels,
            tickfont: {
              size: 11.75,
              color: 'black'
          }},
          yaxis: {
            showticklabels: true,
            tickangle: 0,
            tickfont: {
              size: 11.75,
              color: 'black'
          }}
        };
        <?php } ?>;


        // fill in 'text' array for hover
        var text = zValues.map (function(zValues, i) { return zValues.map (function (value, j) {
            return ` ID: ${yValues[i]}<br> Tissue: ${xValues[j]}<br> Expression: ${value.toFixed(2)} `
            });
          });

        // format modebar, add svg download icon, activate responsive design
        var config = {
            modeBarButtonsToRemove: ['sendDataToCloud', 'autoScale2d', 'hoverClosestCartesian', 'hoverCompareCartesian', 'lasso2d', 'select2d', 'toggleSpikelines'],
            displayModeBar: true,
            responsive: true,
            toImageButtonOptions: {
              filename: 'devseq_plot',
              width: 1020,
            },
            modeBarButtonsToAdd: [{
            name: 'Download plot as a svg',
            icon: Plotly.Icons.disk,
            click: function(gd) {
            Plotly.downloadImage(gd, {filename: 'devseq_plot', format: 'svg'})
            } 
            }],
            displaylogo: false
          };

      Plotly.newPlot('myDiv',[{x: xValues, y: yValues, z: zValues, text: text, hoverinfo: 'text', hoverlabel: {bgcolor: '#41454c'}, layout: layout, colorbar: colorbar, type: 'heatmap', colorscale: [['0', 'rgb(64, 1, 82)'],['0.01', 'rgb(68, 1, 84)'],['0.05', 'rgb(71, 17, 102)'],['0.10', 'rgb(73, 34, 117)'],['0.1475', 'rgb(72, 49, 130)'],['0.195', 'rgb(67, 62, 135)'],['0.2425', 'rgb(64, 77, 143)'],['0.29', 'rgb(58, 90, 145)'],['0.3375', 'rgb(52, 103, 148)'],['0.385', 'rgb(47, 116, 148)'],['0.425', 'rgb(41, 124, 145)'],['0.465', 'rgb(38, 136, 145)'],['0.505', 'rgb(33, 145, 142)'],['0.545', 'rgb(31, 155, 137)'],['0.585', 'rgb(34, 165, 132)'],['0.63', 'rgb(42, 175, 126)'],['0.675', 'rgb(59, 185, 117)'],['0.725', 'rgb(80, 195, 105)'],['0.77', 'rgb(105, 204, 90)'],['0.815', 'rgb(132, 212, 74)'],['0.8625', 'rgb(169, 217, 55)'],['0.91', 'rgb(202, 222, 36)'],['0.95', 'rgb(223, 227, 27)'],['0.99', 'rgb(251, 230, 36)'],['1.0', 'rgb(251, 230, 36)']]}], layout, config);
 


    // Function to call viridis plot
    function l_function(){
      $(function () {
      Plotly.newPlot('myDiv',[{x: xValues, y: yValues, z: zValues, text: text, hoverinfo: 'text', hoverlabel: {bgcolor: '#41454c'}, layout: layout, colorbar: colorbar, type: 'heatmap', colorscale: [['0', 'rgb(64, 1, 82)'],['0.01', 'rgb(68, 1, 84)'],['0.05', 'rgb(71, 17, 102)'],['0.10', 'rgb(73, 34, 117)'],['0.1475', 'rgb(72, 49, 130)'],['0.195', 'rgb(67, 62, 135)'],['0.2425', 'rgb(64, 77, 143)'],['0.29', 'rgb(58, 90, 145)'],['0.3375', 'rgb(52, 103, 148)'],['0.385', 'rgb(47, 116, 148)'],['0.425', 'rgb(41, 124, 145)'],['0.465', 'rgb(38, 136, 145)'],['0.505', 'rgb(33, 145, 142)'],['0.545', 'rgb(31, 155, 137)'],['0.585', 'rgb(34, 165, 132)'],['0.63', 'rgb(42, 175, 126)'],['0.675', 'rgb(59, 185, 117)'],['0.725', 'rgb(80, 195, 105)'],['0.77', 'rgb(105, 204, 90)'],['0.815', 'rgb(132, 212, 74)'],['0.8625', 'rgb(169, 217, 55)'],['0.91', 'rgb(202, 222, 36)'],['0.95', 'rgb(223, 227, 27)'],['0.99', 'rgb(251, 230, 36)'],['1.0', 'rgb(251, 230, 36)']]}], layout, config);
        }
      )}


    // Function to call blue plot
    function m_function(){
      $(function () {
      Plotly.newPlot('myDiv',[{x: xValues, y: yValues, z: zValues, text: text, hoverinfo: 'text', hoverlabel: {bgcolor: '#41454c'}, layout: layout, colorbar: colorbar, type: 'heatmap', colorscale: [['0.0', 'rgb(245, 250, 254)'],['0.1', 'rgb(226, 237, 248)'],['0.2', 'rgb(207, 225, 242)'],['0.3', 'rgb(180, 211, 233)'],['0.4', 'rgb(146, 195, 223)'],['0.5', 'rgb(108, 173, 213)'],['0.6', 'rgb(74, 151, 201)'],['0.7', 'rgb(47, 126, 188)'],['0.8', 'rgb( 24, 100, 170)'],['0.9', 'rgb(10, 74, 144)'],['1.0', 'rgb(9, 57, 127)']]}], layout, config);
        }
      )}


    // Function to call red plot
    function n_function(){
      $(function () {
      Plotly.newPlot('myDiv', [{x: xValues, y: yValues, z: zValues, text: text, hoverinfo: 'text', hoverlabel: {bgcolor: '#41454c'}, layout: layout, colorbar: colorbar, type: 'heatmap', colorscale: [['0.0', 'rgb(254, 245, 245)'],['0.11', 'rgb(249, 225, 215)'],['0.22', 'rgb(244, 201, 182)'],['0.33', 'rgb(240, 168, 145)'],['0.44', 'rgb(231, 126, 107)'],['0.55', 'rgb(217, 73, 64)'],['0.66', 'rgb(197, 38, 40)'],['0.77', 'rgb(162, 23, 28)'],['0.88', 'rgb(127, 13, 24)'],['1.0', 'rgb(98, 2, 14)']]}], layout, config);
        }
      )}


    // Function to call green plot
    function o_function(){
      $(function () {
      Plotly.newPlot('myDiv', [{x: xValues, y: yValues, z: zValues, text: text, hoverinfo: 'text', hoverlabel: {bgcolor: '#41454c'}, layout: layout, colorbar: colorbar, type: 'heatmap', colorscale: [['0.0', 'rgb(245, 252, 234)'],['0.11112', 'rgb(228, 240, 195)'],['0.22223', 'rgb(207, 224, 154)'],['0.33334', 'rgb(181, 206, 109)'],['0.44445', 'rgb(154, 187, 83)'],['0.55556', 'rgb(116, 165, 63)'],['0.66667', 'rgb(72, 138, 44)'],['0.77778', 'rgb(33, 113, 29)'],['0.88889', 'rgb(9, 96, 21)'],['1.0', 'rgb(0, 87, 18)']]}], layout, config);
        }
      )}


    // Function to call red-yellow plot
    function p_function(){
      $(function () {
      Plotly.newPlot('myDiv',[{x: xValues, y: yValues, z: zValues, text: text, hoverinfo: 'text', hoverlabel: {bgcolor: '#424447'}, layout: layout, colorbar: colorbar, type: 'heatmap', colorscale: [['0.0', 'rgb(253, 0, 0)'],['0.067', 'rgb(253, 33, 2)'],['0.134', 'rgb(253, 63, 6)'],['0.201', 'rgb(253, 89, 12)'],['0.268', 'rgb(253, 113, 18)'],['0.335', 'rgb(253, 137, 24)'],['0.402', 'rgb(253, 161, 30)'],['0.469', 'rgb(253, 185, 36)'],['0.536', 'rgb(253, 209, 42)'],['0.603', 'rgb(253, 233, 48)'],['0.670', 'rgb(253, 255, 54)'],['0.737', 'rgb(252, 255, 69)'],['0.804', 'rgb(253, 255, 136)'],['0.871', 'rgb(253, 255, 170)'],['0.938', 'rgb(254, 255, 207)'],['1.0', 'rgb(254, 255, 207)']]}], layout, config);
        }
      )}


    // Function to call yellow-red plot
    function q_function(){
      $(function () {
      Plotly.newPlot('myDiv',[{x: xValues, y: yValues, z: zValues, text: text, hoverinfo: 'text', hoverlabel: {bgcolor: '#41454c'}, layout: layout, colorbar: colorbar, type: 'heatmap', colorscale: [['0.0', 'rgb(254, 255, 207)'],['0.067', 'rgb(253, 255, 136)'],['0.134', 'rgb(252, 255, 69)'],['0.201', 'rgb(253, 255, 54)'],['0.268', 'rgb(253, 233, 48)'],['0.335', 'rgb(253, 209, 42)'],['0.402', 'rgb(253, 185, 36)'],['0.469', 'rgb(253, 161, 30)'],['0.536', 'rgb(253, 137, 24)'],['0.603', 'rgb(253, 113, 18)'],['0.670', 'rgb(253, 89, 12)'],['0.737', 'rgb(253, 63, 6)'],['0.804', 'rgb(253, 33, 2)'],['0.871', 'rgb(253, 16, 1)'],['0.938', 'rgb(253, 0, 0)'],['1.0', 'rgb(253, 0, 0)']]}], layout, config);
        }
      )}

    </script>
<?php }




// define hclust viridis heatmap plot parameters for plotting Arabidopsis thaliana AVERAGED REPLICATE data here
// AVERAGED REPLICATE data will be plotted if number of entities found is >1250
else if ($_POST['filter4'] == "heatmap" && $_POST['filter1'] == "Arabidopsis_thaliana" && ($count > 1) && ($count > 1250) && $_POST['filter6'] == "1") { ?>

    <script type="text/javascript">
        // Function to call viridis plot (standard plot)
        var zValues = <?php echo $valuesclustout; ?>;                       
        var yValues = <?php echo $keysclustout; ?>;
        var xValues = 
        ['root_root tip_5d', 'root_maturation zone_5d', 'root_whole root_5d', 'root_whole root_7d', 'root_whole root_14d', 'root_whole root_21d', 'hypocotyl_10d', '3rd internode_24d', '2nd internode_24d', '1st internode_28d', 'cotyledons_7d', 'leaf 1+2_7d', 'leaf 1+2_10d', 'leaf 1+2_petiole_10d', 'leaf 1+2_leaf tip_10d', 'leaf_5+6_17d', 'leaf_9+10_27d', 'leaves senescing_35d', 'cauline leaves_24d', 'apex vegetative_7d', 'apex vegetative_10d', 'apex vegetative_14d', 'apex inflorescence_21d', 'apex inflorescence_28d', 'apex inflorescence_clv1_21d', 'flower stg9_21d+', 'flower stg10/11_21d+', 'flower stg12_21d+', 'flower stg15_21d+', 'flower stg12_sepals', 'flower stg15_sepals', 'flower stg12_petals', 'flower stg15_petals', 'flower stg12_stamens', 'flower stg15_stamens', 'mature pollen_28d+', 'flower early stg12_carpels', 'flower late stg12_carpels', 'flower stg15_carpels', 'fruit stg16_siliques', 'fruit stg17a_siliques', 'fruit stg16_seeds', 'fruit stg17a_seeds', 'fruit stg18_seeds'];

        var title = <?php echo $titleout; ?>;

        var ticknumber = <?php if($countout == 1) { ?> 3;
                     <?php } else { ?> 0; <?php } ?>;

        var ticklabels = ['root_root tip_5d', 'root_maturation zone_5d', 'root_whole root_5d', 'root_whole root_7d', 'root_whole root_14d', 'root_whole root_21d', 'hypocotyl_10d', '3rd internode_24d', '2nd internode_24d', '1st internode_28d', 'cotyledons_7d', 'leaf 1+2_7d', 'leaf 1+2_10d', 'leaf 1+2_petiole_10d', 'leaf 1+2_leaf tip_10d', 'leaf_5+6_17d', 'leaf_9+10_27d', 'leaves senescing_35d', 'cauline leaves_24d', 'apex vegetative_7d', 'apex vegetative_10d', 'apex vegetative_14d', 'apex inflorescence_21d', 'apex inflorescence_28d', 'apex inflorescence_clv1_21d', 'flower stg9_21d+', 'flower stg10/11_21d+', 'flower stg12_21d+', 'flower stg15_21d+', 'flower stg12_sepals', 'flower stg15_sepals', 'flower stg12_petals', 'flower stg15_petals', 'flower stg12_stamens', 'flower stg15_stamens', 'mature pollen_28d+', 'flower early stg12_carpels', 'flower late stg12_carpels', 'flower stg15_carpels', 'fruit stg16_siliques', 'fruit stg17a_siliques', 'fruit stg16_seeds', 'fruit stg17a_seeds', 'fruit stg18_seeds'];

        var colorbar = {
          title: title,
          titlefont: {
            size: 12,
          },
          titleside: "top",
          thickness: 20,
          nticks: ticknumber,
          tickfont: {
            size:10.5
          },
          outlinewidth: 0,
          xpad: 1,
          ypad:3
        };

        var height = <?php echo $reqheightout; ?>;

        var layout = {
          paper_bgcolor: 'rgba(255,255,255,0)',
          height: height,
          margin: {
            l: 105,
            r: 105,
            b: 202,
            t: 38,
            pad: 0
          },
          xaxis: {
            showticklabels: true,
            tickangle: 90,
            tickvals: ticklabels,
            tickfont: {
              size: 11.75,
              color: 'black'
          }},
          yaxis: {
            showticklabels: true,
            tickangle: 0,
            tickfont: {
              size: 11.75,
              color: 'black'
          }}
        };


        // fill in 'text' array for hover
        var text = zValues.map (function(zValues, i) { return zValues.map (function (value, j) {
            return ` ID: ${yValues[i]}<br> Tissue: ${xValues[j]}<br> Expression: ${value.toFixed(2)} `
            });
          });

        // format modebar, add svg download icon, activate responsive design
        var config = {
            modeBarButtonsToRemove: ['sendDataToCloud', 'autoScale2d', 'hoverClosestCartesian', 'hoverCompareCartesian', 'lasso2d', 'select2d', 'toggleSpikelines'],
            displayModeBar: true,
            responsive: true,
            toImageButtonOptions: {
              filename: 'devseq_plot',
              width: 1020,
            },
            modeBarButtonsToAdd: [{
            name: 'Download plot as a svg',
            icon: Plotly.Icons.disk,
            click: function(gd) {
            Plotly.downloadImage(gd, {filename: 'devseq_plot', format: 'svg'})
            } 
            }],
            displaylogo: false
          };

      Plotly.newPlot('myDiv',[{x: xValues, y: yValues, z: zValues, text: text, hoverinfo: 'text', hoverlabel: {bgcolor: '#41454c'}, layout: layout, colorbar: colorbar, type: 'heatmap', colorscale: [['0', 'rgb(64, 1, 82)'],['0.01', 'rgb(68, 1, 84)'],['0.05', 'rgb(71, 17, 102)'],['0.10', 'rgb(73, 34, 117)'],['0.1475', 'rgb(72, 49, 130)'],['0.195', 'rgb(67, 62, 135)'],['0.2425', 'rgb(64, 77, 143)'],['0.29', 'rgb(58, 90, 145)'],['0.3375', 'rgb(52, 103, 148)'],['0.385', 'rgb(47, 116, 148)'],['0.425', 'rgb(41, 124, 145)'],['0.465', 'rgb(38, 136, 145)'],['0.505', 'rgb(33, 145, 142)'],['0.545', 'rgb(31, 155, 137)'],['0.585', 'rgb(34, 165, 132)'],['0.63', 'rgb(42, 175, 126)'],['0.675', 'rgb(59, 185, 117)'],['0.725', 'rgb(80, 195, 105)'],['0.77', 'rgb(105, 204, 90)'],['0.815', 'rgb(132, 212, 74)'],['0.8625', 'rgb(169, 217, 55)'],['0.91', 'rgb(202, 222, 36)'],['0.95', 'rgb(223, 227, 27)'],['0.99', 'rgb(251, 230, 36)'],['1.0', 'rgb(251, 230, 36)']]}], layout, config);
 


    // Function to call viridis plot
    function l_function(){
      $(function () {
      Plotly.newPlot('myDiv',[{x: xValues, y: yValues, z: zValues, text: text, hoverinfo: 'text', hoverlabel: {bgcolor: '#41454c'}, layout: layout, colorbar: colorbar, type: 'heatmap', colorscale: [['0', 'rgb(64, 1, 82)'],['0.01', 'rgb(68, 1, 84)'],['0.05', 'rgb(71, 17, 102)'],['0.10', 'rgb(73, 34, 117)'],['0.1475', 'rgb(72, 49, 130)'],['0.195', 'rgb(67, 62, 135)'],['0.2425', 'rgb(64, 77, 143)'],['0.29', 'rgb(58, 90, 145)'],['0.3375', 'rgb(52, 103, 148)'],['0.385', 'rgb(47, 116, 148)'],['0.425', 'rgb(41, 124, 145)'],['0.465', 'rgb(38, 136, 145)'],['0.505', 'rgb(33, 145, 142)'],['0.545', 'rgb(31, 155, 137)'],['0.585', 'rgb(34, 165, 132)'],['0.63', 'rgb(42, 175, 126)'],['0.675', 'rgb(59, 185, 117)'],['0.725', 'rgb(80, 195, 105)'],['0.77', 'rgb(105, 204, 90)'],['0.815', 'rgb(132, 212, 74)'],['0.8625', 'rgb(169, 217, 55)'],['0.91', 'rgb(202, 222, 36)'],['0.95', 'rgb(223, 227, 27)'],['0.99', 'rgb(251, 230, 36)'],['1.0', 'rgb(251, 230, 36)']]}], layout, config);
        }
      )}


    // Function to call blue plot
    function m_function(){
      $(function () {
      Plotly.newPlot('myDiv',[{x: xValues, y: yValues, z: zValues, text: text, hoverinfo: 'text', hoverlabel: {bgcolor: '#41454c'}, layout: layout, colorbar: colorbar, type: 'heatmap', colorscale: [['0.0', 'rgb(245, 250, 254)'],['0.1', 'rgb(226, 237, 248)'],['0.2', 'rgb(207, 225, 242)'],['0.3', 'rgb(180, 211, 233)'],['0.4', 'rgb(146, 195, 223)'],['0.5', 'rgb(108, 173, 213)'],['0.6', 'rgb(74, 151, 201)'],['0.7', 'rgb(47, 126, 188)'],['0.8', 'rgb( 24, 100, 170)'],['0.9', 'rgb(10, 74, 144)'],['1.0', 'rgb(9, 57, 127)']]}], layout, config);
        }
      )}


    // Function to call red plot
    function n_function(){
      $(function () {
      Plotly.newPlot('myDiv', [{x: xValues, y: yValues, z: zValues, text: text, hoverinfo: 'text', hoverlabel: {bgcolor: '#41454c'}, layout: layout, colorbar: colorbar, type: 'heatmap', colorscale: [['0.0', 'rgb(254, 245, 245)'],['0.11', 'rgb(249, 225, 215)'],['0.22', 'rgb(244, 201, 182)'],['0.33', 'rgb(240, 168, 145)'],['0.44', 'rgb(231, 126, 107)'],['0.55', 'rgb(217, 73, 64)'],['0.66', 'rgb(197, 38, 40)'],['0.77', 'rgb(162, 23, 28)'],['0.88', 'rgb(127, 13, 24)'],['1.0', 'rgb(98, 2, 14)']]}], layout, config);
        }
      )}


    // Function to call green plot
    function o_function(){
      $(function () {
      Plotly.newPlot('myDiv', [{x: xValues, y: yValues, z: zValues, text: text, hoverinfo: 'text', hoverlabel: {bgcolor: '#41454c'}, layout: layout, colorbar: colorbar, type: 'heatmap', colorscale: [['0.0', 'rgb(245, 252, 234)'],['0.11112', 'rgb(228, 240, 195)'],['0.22223', 'rgb(207, 224, 154)'],['0.33334', 'rgb(181, 206, 109)'],['0.44445', 'rgb(154, 187, 83)'],['0.55556', 'rgb(116, 165, 63)'],['0.66667', 'rgb(72, 138, 44)'],['0.77778', 'rgb(33, 113, 29)'],['0.88889', 'rgb(9, 96, 21)'],['1.0', 'rgb(0, 87, 18)']]}], layout, config);
        }
      )}


    // Function to call red-yellow plot
    function p_function(){
      $(function () {
      Plotly.newPlot('myDiv',[{x: xValues, y: yValues, z: zValues, text: text, hoverinfo: 'text', hoverlabel: {bgcolor: '#424447'}, layout: layout, colorbar: colorbar, type: 'heatmap', colorscale: [['0.0', 'rgb(253, 0, 0)'],['0.067', 'rgb(253, 33, 2)'],['0.134', 'rgb(253, 63, 6)'],['0.201', 'rgb(253, 89, 12)'],['0.268', 'rgb(253, 113, 18)'],['0.335', 'rgb(253, 137, 24)'],['0.402', 'rgb(253, 161, 30)'],['0.469', 'rgb(253, 185, 36)'],['0.536', 'rgb(253, 209, 42)'],['0.603', 'rgb(253, 233, 48)'],['0.670', 'rgb(253, 255, 54)'],['0.737', 'rgb(252, 255, 69)'],['0.804', 'rgb(253, 255, 136)'],['0.871', 'rgb(253, 255, 170)'],['0.938', 'rgb(254, 255, 207)'],['1.0', 'rgb(254, 255, 207)']]}], layout, config);
        }
      )}


    // Function to call yellow-red plot
    function q_function(){
      $(function () {
      Plotly.newPlot('myDiv',[{x: xValues, y: yValues, z: zValues, text: text, hoverinfo: 'text', hoverlabel: {bgcolor: '#41454c'}, layout: layout, colorbar: colorbar, type: 'heatmap', colorscale: [['0.0', 'rgb(254, 255, 207)'],['0.067', 'rgb(253, 255, 136)'],['0.134', 'rgb(252, 255, 69)'],['0.201', 'rgb(253, 255, 54)'],['0.268', 'rgb(253, 233, 48)'],['0.335', 'rgb(253, 209, 42)'],['0.402', 'rgb(253, 185, 36)'],['0.469', 'rgb(253, 161, 30)'],['0.536', 'rgb(253, 137, 24)'],['0.603', 'rgb(253, 113, 18)'],['0.670', 'rgb(253, 89, 12)'],['0.737', 'rgb(253, 63, 6)'],['0.804', 'rgb(253, 33, 2)'],['0.871', 'rgb(253, 16, 1)'],['0.938', 'rgb(253, 0, 0)'],['1.0', 'rgb(253, 0, 0)']]}], layout, config);
        }
      )}

    </script>
<?php }




// define hclust heatmap parameters for plotting non-Arabidopsis thaliana data here
else if ($_POST['filter4'] == "heatmap" && $_POST['filter1'] != "Arabidopsis_thaliana" && ($count > 1) && $_POST['filter6'] == "1") { ?>

    <script type="text/javascript">
        var zValues = <?php echo $valuesclustout; ?>;
        var yValues = <?php echo $keysclustout; ?>;
        // define x axis labels depending on selected species
        var xValues = 
        <?php if($_POST['filter1'] == "Capsella_rubella") { ?>
        ['root, whole root, 4d.1', 'root, whole root, 4d.2', 'root, whole root, 4d.3', 'hypocotyl, 9d.1', 'hypocotyl, 9d.2', 'hypocotyl, 9d.3', 'leaf 1+2, 7d.1', 'leaf 1+2, 7d.2', 'leaf 1+2, 7d.3', 'apex vegetative, 7d.1', 'apex vegetative, 7d.2', 'apex vegetative, 7d.3', 'apex inflorescence.1', 'apex inflorescence.2', 'apex inflorescence.3', 'flower stg12.1', 'flower stg12.2', 'flower stg12.3', 'flower stg12, carpels.1', 'flower stg12, carpels.2', 'flower stg12, carpels.3', 'flower stg12, stamens.1', 'flower stg12, stamens.2', 'flower stg12, stamens.3', 'mature pollen.1', 'mature pollen.2', 'mature pollen.3'];
        <?php } 
        else if ($_POST['filter1'] == "Eutrema_salsugineum") { ?>
        ['root, whole root, 6d.1', 'root, whole root, 6d.2', 'root, whole root, 6d.3', 'hypocotyl, 12d.1', 'hypocotyl, 12d.2', 'hypocotyl, 12d.3', 'leaf 1+2, 9d.1', 'leaf 1+2, 9d.2', 'leaf 1+2, 9d.3', 'apex vegetative, 9d.1', 'apex vegetative, 9d.2', 'apex vegetative, 9d.3', 'apex inflorescence.1', 'apex inflorescence.2', 'apex inflorescence.3', 'flower stg12.1', 'flower stg12.2', 'flower stg12.3', 'flower stg12, carpels.1', 'flower stg12, carpels.2', 'flower stg12, carpels.3', 'flower stg12, stamens.1', 'flower stg12, stamens.2', 'flower stg12, stamens.3', 'mature pollen.1', 'mature pollen.2', 'mature pollen.3'];
        <?php } 
        else if ($_POST['filter1'] == "Medicago_truncatula") { ?>
        ['root, whole root, 4d.1', 'root, whole root, 4d.2', 'root, whole root, 4d.3', 'hypocotyl, 8d.1', 'hypocotyl, 8d.2', 'hypocotyl, 8d.3', 'leaf 2, 7d.1', 'leaf 2, 7d.2', 'leaf 2, 7d.3', 'apex vegetative, 6d.1', 'apex vegetative, 6d.2', 'apex vegetative, 6d.3', 'meristem inflorescence.1', 'meristem inflorescence.2', 'meristem inflorescence.3', 'flower stg8.1', 'flower stg8.2', 'flower stg8.3', 'flower stg8, carpels.1', 'flower stg8, carpels.2', 'flower stg8, carpels.3', 'flower stg8, stamens.1', 'flower stg8, stamens.2', 'flower stg8, stamens.3', 'mature pollen.1', 'mature pollen.2', 'mature pollen.3'];
        <?php } ?>

        var title = <?php echo $titleout; ?>;

        var ticknumber = <?php if($countout == 1) { ?> 3;
                     <?php } else { ?> 0; <?php } ?>;

        var colorbar = {
          title: title,
          titlefont: {
            size: 12,
          },
          titleside: "top",
          thickness: 20,
          nticks: ticknumber,
          tickfont: {
            size:10.5
          },
          outlinewidth: 0,
          xpad: 1,
          ypad:3
        };

        var height = <?php echo $reqheightout; ?>;

        var layout = <?php if($countout < 5) { ?> {
          paper_bgcolor: 'rgba(255,255,255,0)',
          height: height,
          margin: {
            l: 148,
            r: 148,
            b: 181,
            t: 62,
            pad: 0
          },
          xaxis: {
            showticklabels: true,
            tickangle: 90,
            tickfont: {
              size: 11.75,
              color: 'black'
          }},
          yaxis: {
            showticklabels: true,
            tickangle: 0,
            tickfont: {
              size: 11.75,
              color: 'black'
            }}
          };      
      
          <?php } else if ($countout < 10) { ?> {
          paper_bgcolor: 'rgba(255,255,255,0)',
          height: height,
          margin: {
            l: 148,
            r: 148,
            b: 187,
            t: 53,
            pad: 0
          },
          xaxis: {
            showticklabels: true,
            tickangle: 90,
            tickfont: {
              size: 11.75,
              color: 'black'
            }},
          yaxis: {
            showticklabels: true,
            tickangle: 0,
            tickfont: {
              size: 11.75,
              color: 'black'
            }}
          };
      
          <?php } else { ?> {
          paper_bgcolor: 'rgba(255,255,255,0)',
          height: height,
          margin: {
            l: 148,
            r: 148,
            b: 202,
            t: 38,
            pad: 0
          },
          xaxis: {
            showticklabels: true,
            tickangle: 90,
            tickfont: {
              size: 11.75,
              color: 'black'
          }},
          yaxis: {
            showticklabels: true,
            tickangle: 0,
            tickfont: {
              size: 11.75,
              color: 'black'
            }}
          };
          <?php } ?>;


        // fill in 'text' array for hover
        var text = zValues.map (function(zValues, i) { return zValues.map (function (value, j) {
            return ` ID: ${yValues[i]}<br> Tissue: ${xValues[j]}<br> Expression: ${value.toFixed(2)} `
            });
          });

        // format modebar, add svg download icon, activate responsive design
        var config = {
            displayModeBar: true,
            responsive: true,
            toImageButtonOptions: {
              filename: 'devseq_plot',
              width: 1020,
            },
            modeBarButtonsToRemove: ['sendDataToCloud', 'autoScale2d', 'hoverClosestCartesian', 'hoverCompareCartesian', 'lasso2d', 'select2d', 'toggleSpikelines'],
            modeBarButtonsToAdd: [{
            name: 'Download plot as a svg',
            icon: Plotly.Icons.disk,
            click: function(gd) {
            Plotly.downloadImage(gd, {format: 'svg'})
            } 
            }],
            displaylogo: false
          };

      Plotly.newPlot('myDiv',[{x: xValues, y: yValues, z: zValues, text: text, hoverinfo: 'text', hoverlabel: {bgcolor: '#41454c'}, layout: layout, colorbar: colorbar, type: 'heatmap', colorscale: [['0', 'rgb(64, 1, 82)'],['0.01', 'rgb(68, 1, 84)'],['0.05', 'rgb(71, 17, 102)'],['0.10', 'rgb(73, 34, 117)'],['0.1475', 'rgb(72, 49, 130)'],['0.195', 'rgb(67, 62, 135)'],['0.2425', 'rgb(64, 77, 143)'],['0.29', 'rgb(58, 90, 145)'],['0.3375', 'rgb(52, 103, 148)'],['0.385', 'rgb(47, 116, 148)'],['0.425', 'rgb(41, 124, 145)'],['0.465', 'rgb(38, 136, 145)'],['0.505', 'rgb(33, 145, 142)'],['0.545', 'rgb(31, 155, 137)'],['0.585', 'rgb(34, 165, 132)'],['0.63', 'rgb(42, 175, 126)'],['0.675', 'rgb(59, 185, 117)'],['0.725', 'rgb(80, 195, 105)'],['0.77', 'rgb(105, 204, 90)'],['0.815', 'rgb(132, 212, 74)'],['0.8625', 'rgb(169, 217, 55)'],['0.91', 'rgb(202, 222, 36)'],['0.95', 'rgb(223, 227, 27)'],['0.99', 'rgb(251, 230, 36)'],['1.0', 'rgb(251, 230, 36)']]}], layout, config);



    // Function to call viridis hclust heatmap plot for non-Arabidopsis thaliana species 
    function x_function(){
      $(function () {
      Plotly.newPlot('myDiv',[{x: xValues, y: yValues, z: zValues, text: text, hoverinfo: 'text', hoverlabel: {bgcolor: '#41454c'}, layout: layout, colorbar: colorbar, type: 'heatmap', colorscale: [['0', 'rgb(64, 1, 82)'],['0.01', 'rgb(68, 1, 84)'],['0.05', 'rgb(71, 17, 102)'],['0.10', 'rgb(73, 34, 117)'],['0.1475', 'rgb(72, 49, 130)'],['0.195', 'rgb(67, 62, 135)'],['0.2425', 'rgb(64, 77, 143)'],['0.29', 'rgb(58, 90, 145)'],['0.3375', 'rgb(52, 103, 148)'],['0.385', 'rgb(47, 116, 148)'],['0.425', 'rgb(41, 124, 145)'],['0.465', 'rgb(38, 136, 145)'],['0.505', 'rgb(33, 145, 142)'],['0.545', 'rgb(31, 155, 137)'],['0.585', 'rgb(34, 165, 132)'],['0.63', 'rgb(42, 175, 126)'],['0.675', 'rgb(59, 185, 117)'],['0.725', 'rgb(80, 195, 105)'],['0.77', 'rgb(105, 204, 90)'],['0.815', 'rgb(132, 212, 74)'],['0.8625', 'rgb(169, 217, 55)'],['0.91', 'rgb(202, 222, 36)'],['0.95', 'rgb(223, 227, 27)'],['0.99', 'rgb(251, 230, 36)'],['1.0', 'rgb(251, 230, 36)']]}], layout, config);
        }
      )}


    // Function to call blue hclust heatmap plot for non-Arabidopsis thaliana species 
    function y_function(){
      $(function () {
      Plotly.newPlot('myDiv',[{x: xValues, y: yValues, z: zValues, text: text, hoverinfo: 'text', hoverlabel: {bgcolor: '#41454c'}, layout: layout, colorbar: colorbar, type: 'heatmap', colorscale: [['0.0', 'rgb(245, 250, 254)'],['0.1', 'rgb(226, 237, 248)'],['0.2', 'rgb(207, 225, 242)'],['0.3', 'rgb(180, 211, 233)'],['0.4', 'rgb(146, 195, 223)'],['0.5', 'rgb(108, 173, 213)'],['0.6', 'rgb(74, 151, 201)'],['0.7', 'rgb(47, 126, 188)'],['0.8', 'rgb( 24, 100, 170)'],['0.9', 'rgb(10, 74, 144)'],['1.0', 'rgb(9, 57, 127)']]}], layout, config);
        }
      )}


    // Function to call red hclust heatmap plot for non-Arabidopsis thaliana species 
    function z_function(){
      $(function () {
      Plotly.newPlot('myDiv',[{x: xValues, y: yValues, z: zValues, text: text, hoverinfo: 'text', hoverlabel: {bgcolor: '#41454c'}, layout: layout, colorbar: colorbar, type: 'heatmap', colorscale: [['0.0', 'rgb(254, 245, 245)'],['0.11', 'rgb(249, 225, 215)'],['0.22', 'rgb(244, 201, 182)'],['0.33', 'rgb(240, 168, 145)'],['0.44', 'rgb(231, 126, 107)'],['0.55', 'rgb(217, 73, 64)'],['0.66', 'rgb(197, 38, 40)'],['0.77', 'rgb(162, 23, 28)'],['0.88', 'rgb(127, 13, 24)'],['1.0', 'rgb(98, 2, 14)']]}], layout, config);
        }
      )}


    // Function to call green hclust heatmap plot for non-Arabidopsis thaliana species 
    function aa_function(){
      $(function () {
      Plotly.newPlot('myDiv',[{x: xValues, y: yValues, z: zValues, text: text, hoverinfo: 'text', hoverlabel: {bgcolor: '#41454c'}, layout: layout, colorbar: colorbar, type: 'heatmap', colorscale: [['0.0', 'rgb(245, 252, 234)'],['0.11112', 'rgb(228, 240, 195)'],['0.22223', 'rgb(207, 224, 154)'],['0.33334', 'rgb(181, 206, 109)'],['0.44445', 'rgb(154, 187, 83)'],['0.55556', 'rgb(116, 165, 63)'],['0.66667', 'rgb(72, 138, 44)'],['0.77778', 'rgb(33, 113, 29)'],['0.88889', 'rgb(9, 96, 21)'],['1.0', 'rgb(0, 87, 18)']]}], layout, config);
        }
      )}


    // Function to call red-yellow hclust heatmap plot for non-Arabidopsis thaliana species 
    function ab_function(){
      $(function () {
      Plotly.newPlot('myDiv',[{x: xValues, y: yValues, z: zValues, text: text, hoverinfo: 'text', hoverlabel: {bgcolor: '#41454c'}, layout: layout, colorbar: colorbar, type: 'heatmap', colorscale: [['0.0', 'rgb(253, 0, 0)'],['0.067', 'rgb(253, 33, 2)'],['0.134', 'rgb(253, 63, 6)'],['0.201', 'rgb(253, 89, 12)'],['0.268', 'rgb(253, 113, 18)'],['0.335', 'rgb(253, 137, 24)'],['0.402', 'rgb(253, 161, 30)'],['0.469', 'rgb(253, 185, 36)'],['0.536', 'rgb(253, 209, 42)'],['0.603', 'rgb(253, 233, 48)'],['0.670', 'rgb(253, 255, 54)'],['0.737', 'rgb(252, 255, 69)'],['0.804', 'rgb(253, 255, 136)'],['0.871', 'rgb(253, 255, 170)'],['0.938', 'rgb(254, 255, 207)'],['1.0', 'rgb(254, 255, 207)']]}], layout, config);
        }
      )}


    // Function to call yellow-red hclust heatmap plot for non-Arabidopsis thaliana species 
    function ac_function(){
      $(function () {
      Plotly.newPlot('myDiv',[{x: xValues, y: yValues, z: zValues, text: text, hoverinfo: 'text', hoverlabel: {bgcolor: '#41454c'}, layout: layout, colorbar: colorbar, type: 'heatmap', colorscale: [['0.0', 'rgb(254, 255, 207)'],['0.067', 'rgb(253, 255, 136)'],['0.134', 'rgb(252, 255, 69)'],['0.201', 'rgb(253, 255, 54)'],['0.268', 'rgb(253, 233, 48)'],['0.335', 'rgb(253, 209, 42)'],['0.402', 'rgb(253, 185, 36)'],['0.469', 'rgb(253, 161, 30)'],['0.536', 'rgb(253, 137, 24)'],['0.603', 'rgb(253, 113, 18)'],['0.670', 'rgb(253, 89, 12)'],['0.737', 'rgb(253, 63, 6)'],['0.804', 'rgb(253, 33, 2)'],['0.871', 'rgb(253, 16, 1)'],['0.938', 'rgb(253, 0, 0)'],['1.0', 'rgb(253, 0, 0)']]}], layout, config);
        }
      )}

    </script>

<?php }

?>




<!-- **************************************************************************** -->
<!-- ********************************************************************************
Closing controlplot_container 2nd level div and wrap 1st level div and define footer
********************************************************************************* -->
<!-- **************************************************************************** -->


  <table></table>
  </div><!--/close controlplot_container-->
</div><!--/close wrap-->

</div><!--/closing div to make footer stay on bottom of page-->



<!--/start php condition for processing start search landing side-->
<?php if ((!isset($_POST['searchquery']) || $_POST['searchquery'] == "") || $count==0){?>


  <!-- This div is only visible if no search was done (=single species gene expression map start page) -->
  <div 
    <?php if ((!isset($_POST['searchquery']) || $_POST['searchquery'] == "") || $count==0){?> style="display: inline" <?php } 
      else {?> style="display: none"<?php }?> >

      <div id = "srtcredits">
        <a href="https://www.slcu.cam.ac.uk/" target="_blank">
          <div id = "cred2">
            <img src="img/SLCU_Logo-min.png" height = "105" style="position: relative; top: 0px; padding-left: 28px" alt="">
          </div>
        </a>
        <a href="https://www.gatsby.org.uk/" target="_blank">
          <div id = "cred3">
            <img src="img/Gatsby_Logo-min_cropped.png" height = "50" style="position: relative; top: 4px; padding-left: 25px" alt="">
            <div id = "cred3lab" style = "float: right">
              <p> GATSBY </p>
            </div>
          </div>
        </a>
        <a href="https://www.cam.ac.uk/" target="_blank">
          <div id = "cred1">
            <img src="img/Cambridge_Logo-min_cropped.png" style="position: relative; top: 4.5px; float: left; padding-left: 28px" alt="" class="center-img" >
            <div id = "cred1lab" style = "float: right">
              <div id = "cred1labpar">
                <div id = "cred1lab1">
                  <p> UNIVERSITY OF </p>
                </div>
                <div id = "cred1lab2">
                  <p> CAMBRIDGE </p>
                </div>
              </div>
            </div>
          </div>
        </a>
        <table></table><table></table><table></table><table></table><table></table>
      </div>

    </div>

<?php }

?>



<div class="footer"> 
  <div class="footerinner"> 
    <div class="parent"> 
      <div class="child num1"><a href="testindex.php"><font color="#333399">Home</font></a>&nbsp · &nbsp<a href="about.html"><font color="#333399">About DevSeq</font></a>&nbsp · &nbsp<a href="contact.html"><font color="#333399">Contact</font></a>
      </div>
      <div class="child num3"><a href="release-notes.html"><font color="#333399">Release 1 - September 2023</font></a>&nbsp · &nbsp<a href="#"><font color="#333399">Back to top<span class="fa fa-chevron-up"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><path d="M233.4 105.4c12.5-12.5 32.8-12.5 45.3 0l192 192c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L256 173.3 86.6 342.6c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l192-192z"/></svg></span></a>
      </div>  
    </div> 
  </div> 
</div>




<!-- ***********************************************************************
Loading custom JavaScript scripts 
************************************************************************ -->


  <!-- Make checkbox behave like radio buttons -->
  <!-- (only allows to check either log2 or min/max checkbox) -->
  <script type="text/javascript">
       function cbclick(e){
       e = e || event;
       var cb = e.srcElement || e.target;
       if (cb.type !== 'checkbox') {return true;}
       var cbxs = document.getElementById('radiocb').getElementsByTagName('input'), i=cbxs.length;
       while(i--) {
        if (cbxs[i].type && cbxs[i].type == 'checkbox' && cbxs[i].id !== cb.id) {
         cbxs[i].checked = false;
        }
       }
    }
  </script>


  <!-- Make checkbox behave like radio buttons on Start Search Page-->
  <!-- (only allows to check either log2 or min/max checkbox) -->
  <script type="text/javascript">
       function cbclicksrt(e){
       e = e || event;
       var cb = e.srcElement || e.target;
       if (cb.type !== 'checkbox') {return true;}
       var cbxs = document.getElementById('radiocbsrt').getElementsByTagName('input'), i=cbxs.length;
       while(i--) {
        if (cbxs[i].type && cbxs[i].type == 'checkbox' && cbxs[i].id !== cb.id) {
         cbxs[i].checked = false;
        }
       }
    }
  </script>


  <!-- javascript command to set condition for hclust checkbox -->
  <!-- (select Heatmap radio button if hclust checkbox is checked) -->
  <script  type="text/javascript">
    function validate()
    {
      var idcbClass = document.getElementsByClassName("idcb");
      console.log(this);
      for (var i = 0; i < idcbClass.length; i++) {
        if (idcbClass[i].checked == true) {
        document.getElementById("radio1").checked = false;
        document.getElementById("radio2").checked = true;
        }
      }
    }
  </script>


  <!-- jQuery command to set condition for hclust checkbox -->
  <!-- (uncheck hclust checkbox if Line Chart readio button is selected) -->
  <script>
  $(document).ready(function(e) {    
    $("input[id=radio1]").on("click", function() { 
    if ($(this).attr("checked", true)) {
        $("input[id=cb4]").prop("checked", false);
       }
      });
    });
  </script>


  <!-- JSON to CSV Converter -->
  <script type="text/javascript">
        function ConvertToCSV(objArray) {
        var array = typeof objArray != 'object' ? JSON.parse(objArray) : objArray;
        var str = '';
            for (var i = 0; i < array.length; i++) {
                var line = '';
                for (var index in array[i]) {
                    if (line != '') line += ','
                    line += array[i][index];
                }
                str += line + '\r\n';
            }
            return str;
        }
        function download_csv_function() {
        // Read in JSON data and transform to CSV
        $(document).ready(function () {          
            // Read in json data
            var items = <?php 
              if ((($_POST['filter5'] == "0" || $_POST['filter5'] == "2") && $_POST['filter6'] != "1") || (($_POST['filter5'] == "0" || $_POST['filter5'] == "2") && $_POST['filter6'] == "1" && $count == 1)) { 
                           echo $jsonoutcsv; 
              } else if (($_POST['filter5'] == "1" && $_POST['filter6'] != "1") || ($_POST['filter5'] == "1" && $_POST['filter6'] == "1" && $count == 1)) {  
                           echo $jsonoutcsvlog; 
              } else if ($_POST['filter6'] == "1" && $count > 1) { 
                           echo $jsonoutclustcsv; 
              }
              ?>;
            // Convert JSON object into JSON string
            var jsonObject = JSON.stringify(items);
            // Convert JSON to CSV & Display CSV on screen
            var csvstring = ConvertToCSV(jsonObject);
        // FileSaver.js: open download dialog and save file as csv
        saveTextAs(csvstring, "devseq_data.csv");
         })
        };
  </script> 


  <!-- Keep navbar link marked after page loaded -->
  <script type="text/javascript">
  $(function(){
    $('#navContainer a').click(function () {
        $('#navContainer a').removeClass('active');
        $(this).addClass('active');
     });
   });
  </script>


  <!-- Set font color for select box -->
  <script type="text/javascript">  
  $(document).ready(function() {
    $('select').change(function() {
        $(this).blur();
    })
  })
  </script>


  <!-- Font awesome search icon submit function -->
  <script type="text/javascript">  
    function SbnFunction() {
        document.getElementById("devseqform").submit();
    }
  </script>
  

  <!-- Bootstrap - rotate dropdown caret -->
  <script type="text/javascript">  
  $(document).ready(function() {
    $('.dropdown').on('hidden.bs.dropdown', function(e) {
      $(this).find('.caret').toggleClass('rotate-180');
    });
    $('.dropdown').on('shown.bs.dropdown', function(e) {
      $(this).find('.caret').toggleClass('rotate-180');
    });
  });
  </script>


<!-- Show loading bar in Chrome if result page has large number of entities -->
  <?php if ((isset($_POST['searchquery'])) && ($_POST['searchquery'] != "") && ($count > 100) && ((  (strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') !== false) && (strpos($_SERVER['HTTP_USER_AGENT'], 'OPR') == false)  )) ){?>

    <script type="text/javascript">
    document.onreadystatechange = function () {
      var state = document.readyState
      if (state === 'interactive') {
      document.getElementById('load').style.visibility="visible";
      } else if (state === 'complete') {
      document.getElementById('load').remove();
      }
    }
    </script>

  <?php } ?> <!--/close php condition for Chrome loading bar -->




</body>


</html>



<?php

//delete session data files from server
unlink($session_input_fname_path);
unlink($session_output_fname_path);

?> 







