<?php
/**************************************************************************
MySQL PHP Search of devseq_test database by CS
This is major version checked for functionality and backup based on V206
MySQL Database Version Used: 5.7.17
PHP Version Used: 5.4.45
Apache Server Version Used: 2.4.25 (Unix)
**************************************************************************/

// Set time limit for PHP script execution time (default limit is 30 seconds)
// If limit is reached, the script returns a fatal error
// Set to 20 seconds before timing out
set_time_limit(20);

// Force script errors and warnings to show during production only
error_reporting(E_ALL);
ini_set('display_errors', '1');

// turn off php notices
error_reporting(0);

// Connect to MySQL database
require_once "/Volumes/User/Shared/Christoph_manuscript/DevSeq_paper/DevSeq_CMS/root_directory/scripts/connect_to_mysql_devseq_test.php";

$search_output = "";
$transformq = "";
// Process the search query_Initiate the search output variable
if(isset($_POST['searchquery']) && $_POST['searchquery'] != ""){
// run code if condition meets here
// preg_replace = case-insensitive (#i) replace function for anything else than letters numbers space ? and ! all other characters get replaced by ' ' = replace by nothing (characters that are not allowed get removed) this rule gets applied for all posted variables ($_POST['searchquery'])
  $searchquery = preg_replace('#[^a-z 0-9?!.,;_]#i', '', $_POST['searchquery']);
  $search = preg_split("/[\s,;]+/", $searchquery); 



// Searching Arabidopsis thaliana tables
// Set MySQL maximum execution time to 10 seconds for database query, since this is not affected by the set_time_limit() of the php script
  if($_POST['filter1'] == "Arabidopsis_thaliana" && $_POST['filter2'] == "gene_level" && ($_POST['filter5'] == "0" || $_POST['filter5'] == "1")){
    $sqlCommand = "SELECT /*+ MAX_EXECUTION_TIME(10000) */ gene_id, root_root_tip_5d_1, root_root_tip_5d_2, root_root_tip_5d_3, root_maturation_zone_5d_1, root_maturation_zone_5d_2, root_maturation_zone_5d_3, root_whole_root_5d_1, root_whole_root_5d_2, root_whole_root_5d_3, root_whole_root_7d_1, root_whole_root_7d_2, root_whole_root_7d_3, root_whole_root_14d_1, root_whole_root_14d_2, root_whole_root_14d_3, root_whole_root_21d_1, root_whole_root_21d_2, root_whole_root_21d_3, hypocotyl_10d_1, hypocotyl_10d_2, hypocotyl_10d_3, third_internode_24d_1, third_internode_24d_2, third_internode_24d_3, second_internode_24d_1, second_internode_24d_2, second_internode_24d_3, first_internode_28d_1, first_internode_28d_2, first_internode_28d_3, cotyledons_7d_1, cotyledons_7d_2, cotyledons_7d_3, leaf_1_2_7d_1, leaf_1_2_7d_2, leaf_1_2_7d_3, leaf_1_2_10d_1, leaf_1_2_10d_2, leaf_1_2_10d_3, leaf_1_2_petiole_10d_1, leaf_1_2_petiole_10d_2, leaf_1_2_petiole_10d_3, leaf_1_2_leaf_tip_10d_1, leaf_1_2_leaf_tip_10d_2, leaf_1_2_leaf_tip_10d_3, leaf_5_6_17d_1, leaf_5_6_17d_2, leaf_5_6_17d_3, leaf_9_10_27d_1, leaf_9_10_27d_2, leaf_9_10_27d_3, leaves_senescing_35d_1, leaves_senescing_35d_2, leaves_senescing_35d_3, cauline_leaves_24d_1, cauline_leaves_24d_2, cauline_leaves_24d_3, apex_vegetative_7d_1, apex_vegetative_7d_2, apex_vegetative_7d_3, apex_vegetative_10d_1, apex_vegetative_10d_2, apex_vegetative_10d_3, apex_vegetative_14d_1, apex_vegetative_14d_2, apex_vegetative_14d_3, apex_inflorescence_21d_1, apex_inflorescence_21d_2, apex_inflorescence_21d_3, apex_inflorescence_28d_1, apex_inflorescence_28d_2, apex_inflorescence_28d_3, apex_inflorescence_clv1_21d_1, apex_inflorescence_clv1_21d_2, apex_inflorescence_clv1_21d_3, flower_stg9_21d_1, flower_stg9_21d_2, flower_stg9_21d_3, flower_stg10_11_21d_1, flower_stg10_11_21d_2, flower_stg10_11_21d_3, flower_stg12_21d_1, flower_stg12_21d_2, flower_stg12_21d_3, flower_stg15_21d_1, flower_stg15_21d_2, flower_stg15_21d_3, flower_stg12_sepals_21d_1, flower_stg12_sepals_21d_2, flower_stg12_sepals_21d_3, flower_stg15_sepals_21d_1, flower_stg15_sepals_21d_2, flower_stg15_sepals_21d_3, flower_stg12_petals_21d_1, flower_stg12_petals_21d_2, flower_stg12_petals_21d_3, flower_stg15_petals_21d_1, flower_stg15_petals_21d_2, flower_stg15_petals_21d_3, flower_stg12_stamens_21d_1, flower_stg12_stamens_21d_2, flower_stg12_stamens_21d_3, flower_stg15_stamens_21d_1, flower_stg15_stamens_21d_2, flower_stg15_stamens_21d_3, flowers_mature_pollen_28d_1, flowers_mature_pollen_28d_2, flowers_mature_pollen_28d_3, flower_early_stg12_carpels_21d_1, flower_early_stg12_carpels_21d_2, flower_early_stg12_carpels_21d_3, flower_late_stg12_carpels_21d_1, flower_late_stg12_carpels_21d_2, flower_late_stg12_carpels_21d_3, flower_stg15_carpels_21d_1, flower_stg15_carpels_21d_2, flower_stg15_carpels_21d_3, fruit_stg16_siliques_28d_1, fruit_stg16_siliques_28d_2, fruit_stg16_siliques_28d_3, fruit_stg17a_siliques_28d_1, fruit_stg17a_siliques_28d_2, fruit_stg17a_siliques_28d_3, fruit_stg16_seeds_28d_1, fruit_stg16_seeds_28d_2, fruit_stg16_seeds_28d_3, fruit_stg17a_seeds_28d_1, fruit_stg17a_seeds_28d_2, fruit_stg17a_seeds_28d_3, fruit_stg18_seeds_28d_1, fruit_stg18_seeds_28d_2, fruit_stg18_seeds_28d_3 FROM Arabidopsis_thaliana_gene_tpm_20190801 WHERE gene_id in ('".implode("','",$search)."') OR symbol in ('".implode("','",$search)."')";
  } else if($_POST['filter1'] == "Arabidopsis_thaliana" && $_POST['filter2'] == "gene_level" && $_POST['filter5'] == "2"){
    $sqlCommand = "SELECT /*+ MAX_EXECUTION_TIME(10000) */ gene_id, root_root_tip_5d_1, root_root_tip_5d_2, root_root_tip_5d_3, root_maturation_zone_5d_1, root_maturation_zone_5d_2, root_maturation_zone_5d_3, root_whole_root_5d_1, root_whole_root_5d_2, root_whole_root_5d_3, root_whole_root_7d_1, root_whole_root_7d_2, root_whole_root_7d_3, root_whole_root_14d_1, root_whole_root_14d_2, root_whole_root_14d_3, root_whole_root_21d_1, root_whole_root_21d_2, root_whole_root_21d_3, hypocotyl_10d_1, hypocotyl_10d_2, hypocotyl_10d_3, third_internode_24d_1, third_internode_24d_2, third_internode_24d_3, second_internode_24d_1, second_internode_24d_2, second_internode_24d_3, first_internode_28d_1, first_internode_28d_2, first_internode_28d_3, cotyledons_7d_1, cotyledons_7d_2, cotyledons_7d_3, leaf_1_2_7d_1, leaf_1_2_7d_2, leaf_1_2_7d_3, leaf_1_2_10d_1, leaf_1_2_10d_2, leaf_1_2_10d_3, leaf_1_2_petiole_10d_1, leaf_1_2_petiole_10d_2, leaf_1_2_petiole_10d_3, leaf_1_2_leaf_tip_10d_1, leaf_1_2_leaf_tip_10d_2, leaf_1_2_leaf_tip_10d_3, leaf_5_6_17d_1, leaf_5_6_17d_2, leaf_5_6_17d_3, leaf_9_10_27d_1, leaf_9_10_27d_2, leaf_9_10_27d_3, leaves_senescing_35d_1, leaves_senescing_35d_2, leaves_senescing_35d_3, cauline_leaves_24d_1, cauline_leaves_24d_2, cauline_leaves_24d_3, apex_vegetative_7d_1, apex_vegetative_7d_2, apex_vegetative_7d_3, apex_vegetative_10d_1, apex_vegetative_10d_2, apex_vegetative_10d_3, apex_vegetative_14d_1, apex_vegetative_14d_2, apex_vegetative_14d_3, apex_inflorescence_21d_1, apex_inflorescence_21d_2, apex_inflorescence_21d_3, apex_inflorescence_28d_1, apex_inflorescence_28d_2, apex_inflorescence_28d_3, apex_inflorescence_clv1_21d_1, apex_inflorescence_clv1_21d_2, apex_inflorescence_clv1_21d_3, flower_stg9_21d_1, flower_stg9_21d_2, flower_stg9_21d_3, flower_stg10_11_21d_1, flower_stg10_11_21d_2, flower_stg10_11_21d_3, flower_stg12_21d_1, flower_stg12_21d_2, flower_stg12_21d_3, flower_stg15_21d_1, flower_stg15_21d_2, flower_stg15_21d_3, flower_stg12_sepals_21d_1, flower_stg12_sepals_21d_2, flower_stg12_sepals_21d_3, flower_stg15_sepals_21d_1, flower_stg15_sepals_21d_2, flower_stg15_sepals_21d_3, flower_stg12_petals_21d_1, flower_stg12_petals_21d_2, flower_stg12_petals_21d_3, flower_stg15_petals_21d_1, flower_stg15_petals_21d_2, flower_stg15_petals_21d_3, flower_stg12_stamens_21d_1, flower_stg12_stamens_21d_2, flower_stg12_stamens_21d_3, flower_stg15_stamens_21d_1, flower_stg15_stamens_21d_2, flower_stg15_stamens_21d_3, flowers_mature_pollen_28d_1, flowers_mature_pollen_28d_2, flowers_mature_pollen_28d_3, flower_early_stg12_carpels_21d_1, flower_early_stg12_carpels_21d_2, flower_early_stg12_carpels_21d_3, flower_late_stg12_carpels_21d_1, flower_late_stg12_carpels_21d_2, flower_late_stg12_carpels_21d_3, flower_stg15_carpels_21d_1, flower_stg15_carpels_21d_2, flower_stg15_carpels_21d_3, fruit_stg16_siliques_28d_1, fruit_stg16_siliques_28d_2, fruit_stg16_siliques_28d_3, fruit_stg17a_siliques_28d_1, fruit_stg17a_siliques_28d_2, fruit_stg17a_siliques_28d_3, fruit_stg16_seeds_28d_1, fruit_stg16_seeds_28d_2, fruit_stg16_seeds_28d_3, fruit_stg17a_seeds_28d_1, fruit_stg17a_seeds_28d_2, fruit_stg17a_seeds_28d_3, fruit_stg18_seeds_28d_1, fruit_stg18_seeds_28d_2, fruit_stg18_seeds_28d_3 FROM Arabidopsis_thaliana_gene_tpm_RE_20190801 WHERE gene_id in ('".implode("','",$search)."') OR symbol in ('".implode("','",$search)."')";
  } else if($_POST['filter1'] == "Arabidopsis_thaliana" && $_POST['filter2'] == "isoform_level" && ($_POST['filter5'] == "0" || $_POST['filter5'] == "1")){
    $sqlCommand = "SELECT /*+ MAX_EXECUTION_TIME(10000) */ isoform_id, root_root_tip_5d_1, root_root_tip_5d_2, root_root_tip_5d_3, root_maturation_zone_5d_1, root_maturation_zone_5d_2, root_maturation_zone_5d_3, root_whole_root_5d_1, root_whole_root_5d_2, root_whole_root_5d_3, root_whole_root_7d_1, root_whole_root_7d_2, root_whole_root_7d_3, root_whole_root_14d_1, root_whole_root_14d_2, root_whole_root_14d_3, root_whole_root_21d_1, root_whole_root_21d_2, root_whole_root_21d_3, hypocotyl_10d_1, hypocotyl_10d_2, hypocotyl_10d_3, third_internode_24d_1, third_internode_24d_2, third_internode_24d_3, second_internode_24d_1, second_internode_24d_2, second_internode_24d_3, first_internode_28d_1, first_internode_28d_2, first_internode_28d_3, cotyledons_7d_1, cotyledons_7d_2, cotyledons_7d_3, leaf_1_2_7d_1, leaf_1_2_7d_2, leaf_1_2_7d_3, leaf_1_2_10d_1, leaf_1_2_10d_2, leaf_1_2_10d_3, leaf_1_2_petiole_10d_1, leaf_1_2_petiole_10d_2, leaf_1_2_petiole_10d_3, leaf_1_2_leaf_tip_10d_1, leaf_1_2_leaf_tip_10d_2, leaf_1_2_leaf_tip_10d_3, leaf_5_6_17d_1, leaf_5_6_17d_2, leaf_5_6_17d_3, leaf_9_10_27d_1, leaf_9_10_27d_2, leaf_9_10_27d_3, leaves_senescing_35d_1, leaves_senescing_35d_2, leaves_senescing_35d_3, cauline_leaves_24d_1, cauline_leaves_24d_2, cauline_leaves_24d_3, apex_vegetative_7d_1, apex_vegetative_7d_2, apex_vegetative_7d_3, apex_vegetative_14d_1, apex_vegetative_14d_2, apex_vegetative_14d_3, apex_vegetative_21d_1, apex_vegetative_21d_2, apex_vegetative_21d_3, apex_inflorescence_21d_1, apex_inflorescence_21d_2, apex_inflorescence_21d_3, apex_inflorescence_28d_1, apex_inflorescence_28d_2, apex_inflorescence_28d_3, apex_inflorescence_clv1_21d_1, apex_inflorescence_clv1_21d_2, apex_inflorescence_clv1_21d_3, flower_stg9_21d_1, flower_stg9_21d_2, flower_stg9_21d_3, flower_stg10_11_21d_1, flower_stg10_11_21d_2, flower_stg10_11_21d_3, flower_stg12_21d_1, flower_stg12_21d_2, flower_stg12_21d_3, flower_stg15_21d_1, flower_stg15_21d_2, flower_stg15_21d_3, flower_stg12_sepals_21d_1, flower_stg12_sepals_21d_2, flower_stg12_sepals_21d_3, flower_stg15_sepals_21d_1, flower_stg15_sepals_21d_2, flower_stg15_sepals_21d_3, flower_stg12_petals_21d_1, flower_stg12_petals_21d_2, flower_stg12_petals_21d_3, flower_stg15_petals_21d_1, flower_stg15_petals_21d_2, flower_stg15_petals_21d_3, flower_stg12_stamens_21d_1, flower_stg12_stamens_21d_2, flower_stg12_stamens_21d_3, flower_stg15_stamens_21d_1, flower_stg15_stamens_21d_2, flower_stg15_stamens_21d_3, flowers_mature_pollen_28d_1, flowers_mature_pollen_28d_2, flowers_mature_pollen_28d_3, flower_early_stg12_carpels_21d_1, flower_early_stg12_carpels_21d_2, flower_early_stg12_carpels_21d_3, flower_late_stg12_carpels_21d_1, flower_late_stg12_carpels_21d_2, flower_late_stg12_carpels_21d_3, flower_stg15_carpels_21d_1, flower_stg15_carpels_21d_2, flower_stg15_carpels_21d_3, fruit_stg16_siliques_28d_1, fruit_stg16_siliques_28d_2, fruit_stg16_siliques_28d_3, fruit_stg17a_siliques_28d_1, fruit_stg17a_siliques_28d_2, fruit_stg17a_siliques_28d_3, fruit_stg16_17a_seeds_28d_1, fruit_stg16_17a_seeds_28d_2, fruit_stg16_17a_seeds_28d_3, fruit_stg17b_seeds_28d_1, fruit_stg17b_seeds_28d_2, fruit_stg17b_seeds_28d_3, fruit_stg18_seeds_28d_1, fruit_stg18_seeds_28d_2, fruit_stg18_seeds_28d_3 FROM Arabidopsis_thaliana_isoform_tpm_20190516 WHERE isoform_id in ('".implode("','",$search)."') OR gene_id in ('".implode("','",$search)."') OR symbol in ('".implode("','",$search)."')";
  } else if($_POST['filter1'] == "Arabidopsis_thaliana" && $_POST['filter2'] == "isoform_level" && $_POST['filter5'] == "2"){
    $sqlCommand = "SELECT /*+ MAX_EXECUTION_TIME(10000) */ isoform_id, root_root_tip_5d_1, root_root_tip_5d_2, root_root_tip_5d_3, root_maturation_zone_5d_1, root_maturation_zone_5d_2, root_maturation_zone_5d_3, root_whole_root_5d_1, root_whole_root_5d_2, root_whole_root_5d_3, root_whole_root_7d_1, root_whole_root_7d_2, root_whole_root_7d_3, root_whole_root_14d_1, root_whole_root_14d_2, root_whole_root_14d_3, root_whole_root_21d_1, root_whole_root_21d_2, root_whole_root_21d_3, hypocotyl_10d_1, hypocotyl_10d_2, hypocotyl_10d_3, third_internode_24d_1, third_internode_24d_2, third_internode_24d_3, second_internode_24d_1, second_internode_24d_2, second_internode_24d_3, first_internode_28d_1, first_internode_28d_2, first_internode_28d_3, cotyledons_7d_1, cotyledons_7d_2, cotyledons_7d_3, leaf_1_2_7d_1, leaf_1_2_7d_2, leaf_1_2_7d_3, leaf_1_2_10d_1, leaf_1_2_10d_2, leaf_1_2_10d_3, leaf_1_2_petiole_10d_1, leaf_1_2_petiole_10d_2, leaf_1_2_petiole_10d_3, leaf_1_2_leaf_tip_10d_1, leaf_1_2_leaf_tip_10d_2, leaf_1_2_leaf_tip_10d_3, leaf_5_6_17d_1, leaf_5_6_17d_2, leaf_5_6_17d_3, leaf_9_10_27d_1, leaf_9_10_27d_2, leaf_9_10_27d_3, leaves_senescing_35d_1, leaves_senescing_35d_2, leaves_senescing_35d_3, cauline_leaves_24d_1, cauline_leaves_24d_2, cauline_leaves_24d_3, apex_vegetative_7d_1, apex_vegetative_7d_2, apex_vegetative_7d_3, apex_vegetative_14d_1, apex_vegetative_14d_2, apex_vegetative_14d_3, apex_vegetative_21d_1, apex_vegetative_21d_2, apex_vegetative_21d_3, apex_inflorescence_21d_1, apex_inflorescence_21d_2, apex_inflorescence_21d_3, apex_inflorescence_28d_1, apex_inflorescence_28d_2, apex_inflorescence_28d_3, apex_inflorescence_clv1_21d_1, apex_inflorescence_clv1_21d_2, apex_inflorescence_clv1_21d_3, flower_stg9_21d_1, flower_stg9_21d_2, flower_stg9_21d_3, flower_stg10_11_21d_1, flower_stg10_11_21d_2, flower_stg10_11_21d_3, flower_stg12_21d_1, flower_stg12_21d_2, flower_stg12_21d_3, flower_stg15_21d_1, flower_stg15_21d_2, flower_stg15_21d_3, flower_stg12_sepals_21d_1, flower_stg12_sepals_21d_2, flower_stg12_sepals_21d_3, flower_stg15_sepals_21d_1, flower_stg15_sepals_21d_2, flower_stg15_sepals_21d_3, flower_stg12_petals_21d_1, flower_stg12_petals_21d_2, flower_stg12_petals_21d_3, flower_stg15_petals_21d_1, flower_stg15_petals_21d_2, flower_stg15_petals_21d_3, flower_stg12_stamens_21d_1, flower_stg12_stamens_21d_2, flower_stg12_stamens_21d_3, flower_stg15_stamens_21d_1, flower_stg15_stamens_21d_2, flower_stg15_stamens_21d_3, flowers_mature_pollen_28d_1, flowers_mature_pollen_28d_2, flowers_mature_pollen_28d_3, flower_early_stg12_carpels_21d_1, flower_early_stg12_carpels_21d_2, flower_early_stg12_carpels_21d_3, flower_late_stg12_carpels_21d_1, flower_late_stg12_carpels_21d_2, flower_late_stg12_carpels_21d_3, flower_stg15_carpels_21d_1, flower_stg15_carpels_21d_2, flower_stg15_carpels_21d_3, fruit_stg16_siliques_28d_1, fruit_stg16_siliques_28d_2, fruit_stg16_siliques_28d_3, fruit_stg17a_siliques_28d_1, fruit_stg17a_siliques_28d_2, fruit_stg17a_siliques_28d_3, fruit_stg16_17a_seeds_28d_1, fruit_stg16_17a_seeds_28d_2, fruit_stg16_17a_seeds_28d_3, fruit_stg17b_seeds_28d_1, fruit_stg17b_seeds_28d_2, fruit_stg17b_seeds_28d_3, fruit_stg18_seeds_28d_1, fruit_stg18_seeds_28d_2, fruit_stg18_seeds_28d_3 FROM Arabidopsis_thaliana_isoform_tpm_RE_20190516 WHERE isoform_id in ('".implode("','",$search)."') OR gene_id in ('".implode("','",$search)."') OR symbol in ('".implode("','",$search)."')";
  

// Searching Capsella rubella tables
  } else if($_POST['filter1'] == "Capsella_rubella" && $_POST['filter2'] == "gene_level" && ($_POST['filter5'] == "0" || $_POST['filter5'] == "1")){
    $sqlCommand = "SELECT /*+ MAX_EXECUTION_TIME(10000) */ gene_id, root_whole_root_1, root_whole_root_2, root_whole_root_3, hypocotyl_1, hypocotyl_2, hypocotyl_3, leaf_1_2_1, leaf_1_2_2, leaf_1_2_3, apex_vegetative_1, apex_vegetative_2, apex_vegetative_3, apex_inflorescence_1, apex_inflorescence_2, apex_inflorescence_3, flower_stg12_1, flower_stg12_2, flower_stg12_3, carpel_stg12_1, carpel_stg12_2, carpel_stg12_3, stamen_stg12_1, stamen_stg12_2, stamen_stg12_3, pollen_mature_1, pollen_mature_2, pollen_mature_3 FROM Capsella_rubella_gene_tpm WHERE gene_id in ('".implode("','",$search)."')";
  } else if($_POST['filter1'] == "Capsella_rubella" && $_POST['filter2'] == "gene_level" && $_POST['filter5'] == "2"){
    $sqlCommand = "SELECT /*+ MAX_EXECUTION_TIME(10000) */ gene_id, root_whole_root_1, root_whole_root_2, root_whole_root_3, hypocotyl_1, hypocotyl_2, hypocotyl_3, leaf_1_2_1, leaf_1_2_2, leaf_1_2_3, apex_vegetative_1, apex_vegetative_2, apex_vegetative_3, apex_inflorescence_1, apex_inflorescence_2, apex_inflorescence_3, flower_stg12_1, flower_stg12_2, flower_stg12_3, carpel_stg12_1, carpel_stg12_2, carpel_stg12_3, stamen_stg12_1, stamen_stg12_2, stamen_stg12_3, pollen_mature_1, pollen_mature_2, pollen_mature_3 FROM Capsella_rubella_gene_tpm_RE WHERE gene_id in ('".implode("','",$search)."')";
  } else if($_POST['filter1'] == "Capsella_rubella" && $_POST['filter2'] == "isoform_level" && ($_POST['filter5'] == "0" || $_POST['filter5'] == "1")){
    $sqlCommand = "SELECT /*+ MAX_EXECUTION_TIME(10000) */ isoform_id, root_whole_root_1, root_whole_root_2, root_whole_root_3, hypocotyl_1, hypocotyl_2, hypocotyl_3, leaf_1_2_1, leaf_1_2_2, leaf_1_2_3, apex_vegetative_1, apex_vegetative_2, apex_vegetative_3, apex_inflorescence_1, apex_inflorescence_2, apex_inflorescence_3, flower_stg12_1, flower_stg12_2, flower_stg12_3, carpel_stg12_1, carpel_stg12_2, carpel_stg12_3, stamen_stg12_1, stamen_stg12_2, stamen_stg12_3, pollen_mature_1, pollen_mature_2, pollen_mature_3 FROM Capsella_rubella_isoform_tpm WHERE isoform_id in ('".implode("','",$search)."') OR gene_id in ('".implode("','",$search)."')";
  } else if($_POST['filter1'] == "Capsella_rubella" && $_POST['filter2'] == "isoform_level" && $_POST['filter5'] == "2"){
    $sqlCommand = "SELECT /*+ MAX_EXECUTION_TIME(10000) */ isoform_id, root_whole_root_1, root_whole_root_2, root_whole_root_3, hypocotyl_1, hypocotyl_2, hypocotyl_3, leaf_1_2_1, leaf_1_2_2, leaf_1_2_3, apex_vegetative_1, apex_vegetative_2, apex_vegetative_3, apex_inflorescence_1, apex_inflorescence_2, apex_inflorescence_3, flower_stg12_1, flower_stg12_2, flower_stg12_3, carpel_stg12_1, carpel_stg12_2, carpel_stg12_3, stamen_stg12_1, stamen_stg12_2, stamen_stg12_3, pollen_mature_1, pollen_mature_2, pollen_mature_3 FROM Capsella_rubella_isoform_tpm_RE WHERE isoform_id in ('".implode("','",$search)."') OR gene_id in ('".implode("','",$search)."')";

// Searching Eutrema salsugineum tables
  } else if($_POST['filter1'] == "Eutrema_salsugineum" && $_POST['filter2'] == "gene_level" && ($_POST['filter5'] == "0" || $_POST['filter5'] == "1")){
    $sqlCommand = "SELECT /*+ MAX_EXECUTION_TIME(10000) */ gene_id, root_whole_root_1, root_whole_root_2, root_whole_root_3, hypocotyl_1, hypocotyl_2, hypocotyl_3, leaf_1_2_1, leaf_1_2_2, leaf_1_2_3, apex_vegetative_1, apex_vegetative_2, apex_vegetative_3, apex_inflorescence_1, apex_inflorescence_2, apex_inflorescence_3, flower_stg12_1, flower_stg12_2, flower_stg12_3, carpel_stg12_1, carpel_stg12_2, carpel_stg12_3, stamen_stg12_1, stamen_stg12_2, stamen_stg12_3, pollen_mature_1, pollen_mature_2, pollen_mature_3 FROM Eutrema_salsugineum_gene_tpm WHERE gene_id in ('".implode("','",$search)."')";
  } else if($_POST['filter1'] == "Eutrema_salsugineum" && $_POST['filter2'] == "gene_level" && $_POST['filter5'] == "2"){
    $sqlCommand = "SELECT /*+ MAX_EXECUTION_TIME(10000) */ gene_id, root_whole_root_1, root_whole_root_2, root_whole_root_3, hypocotyl_1, hypocotyl_2, hypocotyl_3, leaf_1_2_1, leaf_1_2_2, leaf_1_2_3, apex_vegetative_1, apex_vegetative_2, apex_vegetative_3, apex_inflorescence_1, apex_inflorescence_2, apex_inflorescence_3, flower_stg12_1, flower_stg12_2, flower_stg12_3, carpel_stg12_1, carpel_stg12_2, carpel_stg12_3, stamen_stg12_1, stamen_stg12_2, stamen_stg12_3, pollen_mature_1, pollen_mature_2, pollen_mature_3 FROM Eutrema_salsugineum_gene_tpm_RE WHERE gene_id in ('".implode("','",$search)."')";
  } else if($_POST['filter1'] == "Eutrema_salsugineum" && $_POST['filter2'] == "isoform_level" && ($_POST['filter5'] == "0" || $_POST['filter5'] == "1")){
    $sqlCommand = "SELECT /*+ MAX_EXECUTION_TIME(10000) */ isoform_id, root_whole_root_1, root_whole_root_2, root_whole_root_3, hypocotyl_1, hypocotyl_2, hypocotyl_3, leaf_1_2_1, leaf_1_2_2, leaf_1_2_3, apex_vegetative_1, apex_vegetative_2, apex_vegetative_3, apex_inflorescence_1, apex_inflorescence_2, apex_inflorescence_3, flower_stg12_1, flower_stg12_2, flower_stg12_3, carpel_stg12_1, carpel_stg12_2, carpel_stg12_3, stamen_stg12_1, stamen_stg12_2, stamen_stg12_3, pollen_mature_1, pollen_mature_2, pollen_mature_3 FROM Eutrema_salsugineum_isoform_tpm WHERE isoform_id in ('".implode("','",$search)."') OR gene_id in ('".implode("','",$search)."')";
  } else if($_POST['filter1'] == "Eutrema_salsugineum" && $_POST['filter2'] == "isoform_level" && $_POST['filter5'] == "2"){
    $sqlCommand = "SELECT /*+ MAX_EXECUTION_TIME(10000) */ isoform_id, root_whole_root_1, root_whole_root_2, root_whole_root_3, hypocotyl_1, hypocotyl_2, hypocotyl_3, leaf_1_2_1, leaf_1_2_2, leaf_1_2_3, apex_vegetative_1, apex_vegetative_2, apex_vegetative_3, apex_inflorescence_1, apex_inflorescence_2, apex_inflorescence_3, flower_stg12_1, flower_stg12_2, flower_stg12_3, carpel_stg12_1, carpel_stg12_2, carpel_stg12_3, stamen_stg12_1, stamen_stg12_2, stamen_stg12_3, pollen_mature_1, pollen_mature_2, pollen_mature_3 FROM Eutrema_salsugineum_isoform_tpm_RE WHERE isoform_id in ('".implode("','",$search)."') OR gene_id in ('".implode("','",$search)."')";
  }

// ---------------------------------------------------------------------------------------

  // Create PHP Array from MySQL query for Arabidopsis thaliana
    $query = mysqli_query($myConnection, $sqlCommand) or die(mysql_error()); 
    $count = mysqli_num_rows($query);

// ---------------------------------------------------------------------------------------


  // For A.thaliana data only: if count > 1250, search ATH table with averaged expression values
    
  // Searching Arabidopsis thaliana tables
  // Set MySQL maximum execution time to 10 seconds for database query, since this is not affected by the set_time_limit() of the php script
  if(($count > 1250) && $_POST['filter1'] == "Arabidopsis_thaliana" && $_POST['filter2'] == "gene_level" && ($_POST['filter5'] == "0" || $_POST['filter5'] == "1")){
    $sqlCommand = "SELECT /*+ MAX_EXECUTION_TIME(10000) */ gene_id, root_root_tip_5d, root_maturation_zone_5d, root_whole_root_5d, root_whole_root_7d, root_whole_root_14d, root_whole_root_21d, hypocotyl_10d, third_internode_24d, second_internode_24d, first_internode_28d, cotyledons_7d, leaf_1_2_7d, leaf_1_2_10d, leaf_1_2_petiole_10d, leaf_1_2_leaf_tip_10d, leaf_5_6_17d, leaf_9_10_27d, leaves_senescing_35d, cauline_leaves_24d, apex_vegetative_7d, apex_vegetative_10d, apex_vegetative_14d, apex_inflorescence_21d, apex_inflorescence_28d, apex_inflorescence_clv1_21d, flower_stg9_21d, flower_stg10_11_21d, flower_stg12_21d, flower_stg15_21d, flower_stg12_sepals_21d, flower_stg15_sepals_21d, flower_stg12_petals_21d, flower_stg15_petals_21d, flower_stg12_stamens_21d, flower_stg15_stamens_21d, flowers_mature_pollen_28d, flower_early_stg12_carpels_21d, flower_late_stg12_carpels_21d, flower_stg15_carpels_21d, fruit_stg16_siliques_28d, fruit_stg17a_siliques_28d, fruit_stg16_seeds_28d, fruit_stg17a_seeds_28d, fruit_stg18_seeds_28d FROM Arabidopsis_thaliana_gene_tpm_repl_20190801 WHERE gene_id in ('".implode("','",$search)."') OR symbol in ('".implode("','",$search)."')";
  } else if(($count > 1250) && $_POST['filter1'] == "Arabidopsis_thaliana" && $_POST['filter2'] == "gene_level" && $_POST['filter5'] == "2"){
    $sqlCommand = "SELECT /*+ MAX_EXECUTION_TIME(10000) */ gene_id, root_root_tip_5d, root_maturation_zone_5d, root_whole_root_5d, root_whole_root_7d, root_whole_root_14d, root_whole_root_21d, hypocotyl_10d, third_internode_24d, second_internode_24d, first_internode_28d, cotyledons_7d, leaf_1_2_7d, leaf_1_2_10d, leaf_1_2_petiole_10d, leaf_1_2_leaf_tip_10d, leaf_5_6_17d, leaf_9_10_27d, leaves_senescing_35d, cauline_leaves_24d, apex_vegetative_7d, apex_vegetative_10d, apex_vegetative_14d, apex_inflorescence_21d, apex_inflorescence_28d, apex_inflorescence_clv1_21d, flower_stg9_21d, flower_stg10_11_21d, flower_stg12_21d, flower_stg15_21d, flower_stg12_sepals_21d, flower_stg15_sepals_21d, flower_stg12_petals_21d, flower_stg15_petals_21d, flower_stg12_stamens_21d, flower_stg15_stamens_21d, flowers_mature_pollen_28d, flower_early_stg12_carpels_21d, flower_late_stg12_carpels_21d, flower_stg15_carpels_21d, fruit_stg16_siliques_28d, fruit_stg17a_siliques_28d, fruit_stg16_seeds_28d, fruit_stg17a_seeds_28d, fruit_stg18_seeds_28d FROM Arabidopsis_thaliana_gene_tpm_repl_RE_20190801 WHERE gene_id in ('".implode("','",$search)."') OR symbol in ('".implode("','",$search)."')";
  } else if(($count > 1250) && $_POST['filter1'] == "Arabidopsis_thaliana" && $_POST['filter2'] == "isoform_level" && ($_POST['filter5'] == "0" || $_POST['filter5'] == "1")){
    $sqlCommand = "SELECT /*+ MAX_EXECUTION_TIME(10000) */ isoform_id, root_root_tip_5d, root_maturation_zone_5d, root_whole_root_5d, root_whole_root_7d, root_whole_root_14d, root_whole_root_21d, hypocotyl_10d, third_internode_24d, second_internode_24d, first_internode_28d, cotyledons_7d, leaf_1_2_7d, leaf_1_2_10d, leaf_1_2_petiole_10d, leaf_1_2_leaf_tip_10d, leaf_5_6_17d, leaf_9_10_27d, leaves_senescing_35d, cauline_leaves_24d, apex_vegetative_7d, apex_vegetative_10d, apex_vegetative_14d, apex_inflorescence_21d, apex_inflorescence_28d, apex_inflorescence_clv1_21d, flower_stg9_21d, flower_stg10_11_21d, flower_stg12_21d, flower_stg15_21d, flower_stg12_sepals_21d, flower_stg15_sepals_21d, flower_stg12_petals_21d, flower_stg15_petals_21d, flower_stg12_stamens_21d, flower_stg15_stamens_21d, flowers_mature_pollen_28d, flower_early_stg12_carpels_21d, flower_late_stg12_carpels_21d, flower_stg15_carpels_21d, fruit_stg16_siliques_28d, fruit_stg17a_siliques_28d, fruit_stg16_seeds_28d, fruit_stg17a_seeds_28d, fruit_stg18_seeds_28d FROM Arabidopsis_thaliana_isoform_tpm_repl_20190801 WHERE isoform_id in ('".implode("','",$search)."') OR gene_id in ('".implode("','",$search)."') OR symbol in ('".implode("','",$search)."')";
  } else if(($count > 1250) && $_POST['filter1'] == "Arabidopsis_thaliana" && $_POST['filter2'] == "isoform_level" && $_POST['filter5'] == "2"){
    $sqlCommand = "SELECT /*+ MAX_EXECUTION_TIME(10000) */ isoform_id, root_root_tip_5d, root_maturation_zone_5d, root_whole_root_5d, root_whole_root_7d, root_whole_root_14d, root_whole_root_21d, hypocotyl_10d, third_internode_24d, second_internode_24d, first_internode_28d, cotyledons_7d, leaf_1_2_7d, leaf_1_2_10d, leaf_1_2_petiole_10d, leaf_1_2_leaf_tip_10d, leaf_5_6_17d, leaf_9_10_27d, leaves_senescing_35d, cauline_leaves_24d, apex_vegetative_7d, apex_vegetative_10d, apex_vegetative_14d, apex_inflorescence_21d, apex_inflorescence_28d, apex_inflorescence_clv1_21d, flower_stg9_21d, flower_stg10_11_21d, flower_stg12_21d, flower_stg15_21d, flower_stg12_sepals_21d, flower_stg15_sepals_21d, flower_stg12_petals_21d, flower_stg15_petals_21d, flower_stg12_stamens_21d, flower_stg15_stamens_21d, flowers_mature_pollen_28d, flower_early_stg12_carpels_21d, flower_late_stg12_carpels_21d, flower_stg15_carpels_21d, fruit_stg16_siliques_28d, fruit_stg17a_siliques_28d, fruit_stg16_seeds_28d, fruit_stg17a_seeds_28d, fruit_stg18_seeds_28d FROM Arabidopsis_thaliana_isoform_tpm_repl_RE_20190801 WHERE isoform_id in ('".implode("','",$search)."') OR gene_id in ('".implode("','",$search)."') OR symbol in ('".implode("','",$search)."')";
  }

// ---------------------------------------------------------------------------------------

  // Create PHP Array from MySQL query for Arabidopsis thaliana
    $query = mysqli_query($myConnection, $sqlCommand) or die(mysql_error()); 
    $count = mysqli_num_rows($query);


    if ($count == 1) {
    $search_output .= "&nbsp &nbsp&#8198 <strong>1</strong> entity found";
    $transformq=array();
    while($row = mysqli_fetch_row($query)){  

        // Fill transformq array with query data; This array is used for json transformation later
        $transformq[] = $row; 
                 } // close while loop
  } else if ($count > 1) {
    $search_output .= "&nbsp &nbsp&#8198 <strong>$count</strong> entities found";
    $transformq=array();
    while($row = mysqli_fetch_row($query)){  

        // Fill transformq array with query data; This array is used for json transformation later
        $transformq[] = $row; 
                 } // close while loop
  } else {
    $search_output = "<br> &nbsp &nbsp&#8198 <center> <strong>$searchquery</strong> not present in dataset </center> <br/>";
    }
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
};

// Generate an array that contains both header and mysqli fetched data
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

// log2-transformed expression values of transformq array
function mapArray($keys, $valueslog) {
    return [array_merge([$keys[0]], $valueslog)];
  }
$transformqlog = array_map("mapArray", $keys, $valueslog);
$transformqlog = array_map(function($v){return $v[0];},$transformqlog);

// Add header to $transformqlog array
$transformqlogcsv = array_merge($colnames, $transformqlog);

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
  $jsonoutfile = fopen('inputfile.json', 'w');
  fwrite($jsonoutfile, $jsonout);
  fclose($jsonoutfile);


// Perform hierarchical clustering of $jsonout json array by calling python script
if ($_POST['filter4'] == "heatmap" && $_POST['filter6'] == "1" && ($count > 1) && ($count < 400)) {
// Prepare json file for passing to shell
$jsonoutshin = escapeshellarg($jsonout);
// Execute the python script with the JSON data
$resultpy = shell_exec("/usr/local/bin/python3 /Applications/XAMPP/xamppfiles/htdocs/python/hclust_V2.py 2>&1 $jsonoutshin");
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
  $command = escapeshellcmd('/usr/local/bin/python3 /Applications/XAMPP/xamppfiles/htdocs/python/hclust_V3.py 2>&1');
  exec($command);
  // read data from jsonout.json file fater hclust has been performed
  $jsonouthclust = file_get_contents('outputfile.json');
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

// Combine keys and values from hclust analysis
function mapArrayClust($keysclust, $valuesclust) {
    return [array_merge([$keysclust], $valuesclust)];
  }
$clusteresultkeyvalue = array_map("mapArrayClust", $keysclust, $valuesclust);
$clusteresultkeyvalue = array_map(function($v){return $v[0];},$clusteresultkeyvalue);

// write search output to json file containing header for csv file 
$transformqclustcsv = array_merge($colnames, $clusteresultkeyvalue);
$jsonoutclustcsv = json_encode($transformqclustcsv, JSON_NUMERIC_CHECK);



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
$sboxplaceholder = "Enter gene or isoform ID, e.g. Medtr1g013360.1, Medtr1g024025.1, or paste a list";
} else if ($_POST['filter1'] == "Brachypodium_distachyon") {
$sboxplaceholder = "Enter gene or isoform ID, e.g. Bradi1g31200.1, Bradi5g25157.1, or paste a list of IDs";
};


?> 




<!-- ***********************************************************************
Setting up HTML "Head/Style" options
Loading javascript vizualisation libraries for generating plots ("Scripts")
Run javascripts for controling radio button, checkbox, select & text fields
Define filters for user input in "FORM" field
Generate output files
Define "Div's" for charts
************************************************************************ -->

<html>
<html lang="en">
  <meta http-equiv="content-type" content="text/html"; charset="utf-8"/>
  <meta charset="utf-8">
  <meta name="viewport" content="width=1024, user-scalable=yes">
  <meta name="Description" content="DevSeq plant web application: Plant comparative transcriptomics, plant gene expression evolution, expression atlas, isoforms, lncRNAs and circRNAs">


<head>

  <title>DevSeq | Data Analysis</title>
  
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="author" content="Christoph Schuster">

  
  
<!-- ***********************************************************************
Loading css style sheets
************************************************************************ -->


  <!-- Link to DevSeq css stylesheet-->
  <link rel="stylesheet" href="/CSS/tester.css">
  <!-- Link to bootstrap css stylesheet-->
  <link rel="stylesheet" href="/D3js_C3js_source/bootstrap/bootstrap_bundle_latest_less_970px.min.css">
  <!-- Link to bootstrap css grid stylesheet-->
  <link rel="stylesheet" href="/D3js_C3js_source/bootstrap/bootstrap-grid_CS_V11.min.css">
  <link rel="stylesheet" href="/D3js_C3js_source/Font-Awesome/css/font-awesome_partial_bundle_CS.css">



  <!-- Load c3.css versions depending on selected species-->
  <?php if ($_POST['filter4'] == "line_chart" && $_POST['filter1'] == "Arabidopsis_thaliana") { ?>
  <link href="/D3js_C3js_source/c3/c3.min_CS_settings11.css" rel="stylesheet" />
  <?php } else if ($_POST['filter4'] == "line_chart" && $_POST['filter1'] != "Arabidopsis_thaliana") { ?>
  <link href="/D3js_C3js_source/c3/c3.min_CS_settings10.css" rel="stylesheet" />
  <?php } ?>
    



<!-- ***********************************************************************
Loading javascript vizualisation libraries for generating plots 
************************************************************************ -->
  

  <!-- Load either C3/D3.js or Plotly.js library depending on query -->
  <?php if (($_POST['filter4'] == "line_chart") && (isset($_POST['searchquery'])) && ($count > 0)) { ?> 
  <!-- Load d3.js and c3.js -->
  <script src="/D3js_C3js_source/d3/d3.min.js"></script>
  <script src="/D3js_C3js_source/c3/c3.min.js"></script>

  <?php } else if (($_POST['filter4'] == "heatmap") && (isset($_POST['searchquery'])) && ($count > 0)) { ?>
  <!-- Load plotly.js for heatmap plot -->
  <!-- Partial bundles at github.com/plotly/plotly.js/blob/master/dist/README.md -->
  <script src="/D3js_C3js_source/plotly/plotly-cartesian-latest_45_3.min.js"></script>
  <?php } ?>


  <!-- Load jQuery from google CDN -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <!-- If CDN is down, load jQuery from local -->
  <script type="text/javascript">
    if (typeof jQuery == 'undefined') {
      document.write(unescape("%3Cscript src='/D3js_C3js_source/jquery/jquery-3.3.1.min.js' type='text/javascript'%3E%3C/script%3E"));
    }
  </script>



  <!-- Load bootstrap, jQuery, FileSaver.js, Blob.js and css2pdf -->
  <script src="/D3js_C3js_source/bootstrap/bootstrap_bundle_latest.min.js" defer></script>
  <script src="/D3js_C3js_source/jquery/spin.js" defer></script>
  <script src="/D3js_C3js_source/jquery/jquery.spin.js" defer></script>
  <script src="/D3js_C3js_source/filesaver/FileSaver.js" defer></script>
  <script src="/D3js_C3js_source/Blob/Blob.js" defer></script>
  <script src="/D3js_C3js_source/css_to_pdf/xepOnline.jqPlugin.js" defer></script>



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
        <button type="button" class="navbar-toggle" data-target="#navbarCollapse" data-toggle="collapse">	<span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
        </button>
          <a class="navbar-brand" href="about.html"> <img class="logo" src="/img/DevSeqLogoNew10V3.svg" alt="logo"/><span>Dev<b>Seq</b></span></a>     
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
            </div>
            <!-- Navbar Mega-Menu Content -->
            <div class = "row">
              <!-- Begin Single Species Content -->
              <div class = "col-xs-6">
                <div class="Single_Species_Atlas">
                  <div class="SlSpExAt">
                    <div class="SlSpExAtFt">
                      Single Species Expression Atlas
                    </div>
                  </div> 
                  <div class="SlSpExAtCnt">
                    <div class="col-xs-3">
                      <div class="MMSwrap">
                        <a href="search_devseq_test_V223.php" data-select="Arabidopsis_thaliana" class="menuspec" style="text-decoration: none">  
                          <div class="UpperSpcClass">
                            <div class="SlSpExAtTxt">
                              <i>Arabidopsis thaliana</i>
                            </div>
                            <div class="SlSpExAtImg">
                              <div class="MMinfoicn"><img src="img/icons8-info_fin2.svg" class="MMinfoiimg" title="Arabidopsis thaliana | Ecotype: Col-0 | Illumina Stranded Total RNA-Seq">
                              </div>
                              <img src="img/ATH_tin.jpg" class=img-responsive" alt="" style="border-radius:7px">
                            </div>
                          </div>
                        </a> 
                      </div> 
                    </div>
                    <div class="col-xs-3">
                      <div class="MMSwrap">
                        <a href="search_devseq_test_V223.php" data-select="Arabidopsis_lyrata" class="menuspec" style="text-decoration: none">  
                          <div class="UpperSpcClass">
                            <div class="SlSpExAtTxt">
                              <i>Arabidopsis lyrata</i>
                            </div>
                            <div class="SlSpExAtImg">
                              <div class="MMinfoicn"><img src="img/icons8-info_fin2.svg" class="MMinfoiimg" title="Arabidopsis lyrata | Accession: MN47 | Illumina Stranded Total RNA-Seq">
                              </div>
                              <img src="img/AL_tin.jpg" class=img-responsive" alt="" style="border-radius:7px">
                            </div>
                          </div>
                        </a> 
                      </div> 
                    </div>
                    <div class="col-xs-3">
                      <div class="MMSwrap">
                        <a href="search_devseq_test_V223.php" data-select="Brachypodium_distachyon" class="menuspec" style="text-decoration: none">
                          <div class="UpperSpcClass">
                            <div class="SlSpExAtTxt">
                              <i>Brachypodium distachyon</i>
                            </div>
                            <div class="SlSpExAtImg">
                              <div class="MMinfoicn"><img src="img/icons8-info_fin2.svg" class="MMinfoiimg" title="Brachypodium distachyon | Accession: Bd21-3 | Illumina Stranded Total RNA-Seq">
                              </div>
                              <img src="img/BD_tin.jpg" class=img-responsive" alt="" style="border-radius:7px">
                            </div>
                          </div>
                        </a> 
                      </div> 
                    </div>
                    <div class="col-xs-3">
                      <div class="MMSwrap">
                        <a href="search_devseq_test_V223.php" data-select="Capsella_rubella" class="menuspec" style="text-decoration: none"> 
                          <div class="UpperSpcClass">
                            <div class="SlSpExAtTxt">
                              <i>Capsella rubella</i>
                            </div>
                            <div class="SlSpExAtImg">
                              <div class="MMinfoicn"><img src="img/icons8-info_fin2.svg" class="MMinfoiimg" title="Capsella rubella | Ecotype: Monte Gargano | Illumina Stranded Total RNA-Seq">
                              </div>
                              <img src="img/CR_tin.jpg" class=img-responsive" alt="" style="border-radius:7px">
                            </div>
                          </div>
                        </a> 
                      </div> 
                    </div>
                    <div class="col-xs-12">
                      <table></table>
                      <table></table>
                      <table></table>
                      <table></table>
                    </div>
                    <div class="col-xs-3">
                      <div class="MMSwrap">
                        <a href="search_devseq_test_V223.php" data-select="Eutrema_salsugineum" class="menuspec" style="text-decoration: none"> 
                          <div class="UpperSpcClass">
                            <div class="SlSpExAtTxt">
                              <i>Eutrema salsugineum</i>
                            </div>
                            <div class="SlSpExAtImg">
                              <div class="MMinfoicn"><img src="img/icons8-info_fin2.svg" class="MMinfoiimg" title="Eutrema salsugineum | Ecotype: Shandong | Illumina Stranded Total RNA-Seq">
                              </div>
                              <img src="img/ES_tin.jpg" class=img-responsive" alt="" style="border-radius:7px">
                            </div>
                          </div>
                        </a> 
                      </div> 
                    </div>
                    <div class="col-xs-3">
                      <div class="MMSwrap">
                        <a href="search_devseq_test_V223.php" data-select="Medicago_truncatula" class="menuspec" style="text-decoration: none"> 
                          <div class="UpperSpcClass">
                            <div class="SlSpExAtTxt">
                              <i>Medicago truncatula</i>
                            </div>
                            <div class="SlSpExAtImg">
                              <div class="MMinfoicn"><img src="img/icons8-info_fin2.svg" class="MMinfoiimg" title="Medicago truncatula | Accession: A17 | Illumina Stranded Total RNA-Seq">
                              </div>
                              <img src="img/MT_tin.jpg" class=img-responsive" alt="" style="border-radius:7px">
                            </div>
                          </div>
                        </a> 
                      </div> 
                    </div>
                    <div class="col-xs-3">
                      <div class="MMSwrap">
                        <a href="search_devseq_test_V223.php" data-select="Tarenaya_hassleriana" class="menuspec" style="text-decoration: none"> 
                          <div class="UpperSpcClass">
                            <div class="SlSpExAtTxt">
                              <i>Tarenaya hassleriana</i>
                            </div>
                            <div class="SlSpExAtImg">
                              <div class="MMinfoicn"><img src="img/icons8-info_fin2.svg" class="MMinfoiimg" title="Tarenaya hassleriana | Accession: ES1100 | Illumina Stranded Total RNA-Seq">
                              </div>
                              <img src="img/TH_tin.jpg" class=img-responsive" alt="" style="border-radius:7px">
                            </div>
                          </div>
                        </a> 
                      </div> 
                    </div>
                    <div class="col-xs-3 imgs"></div>
                      <!-- this column empty -->
                    </div>
                  </div>
                </div><!-- End Single Species Content -->

              <div class = "col-xs-3">
                <div class="Comparative_Transcriptome_Atlas">
                  <div class="CompTransExAt">
                    <div class="SlSpExAtFt">
                      Comparative Analysis
                    </div>
                  </div>
                  <div class="CompTranscrAtl">
                    <div class="col-xs-6">
                      <div class="MMCwrap">
                        <a href="search_devseq_test_V222_test.php" data-select="Capsella_rubella" class="menuspec" style="text-decoration: none"> 
                          <div class="UpperSpcClass">
                            <div class="SlSpExAtTxt">
                              1-1&nbsportholog expression
                            </div>
                            <div class="SlSpExAtImg">
                              <div class="MMinfoicn"><img src="img/icons8-info_fin2.svg" class="MMinfoiimg" title="1-1 ortholog expression | Orthology Inference: BLAST best reciprocal hit">
                              </div>
                              <img src="img/1-1_orthologs_tin.jpg" class=img-responsive" alt="" style="border-radius:7px">
                            </div>
                          </div>
                        </a> 
                      </div> 
                    </div>
                    <div class="col-xs-6">
                      <div class="MMCwrap">
                        <a href="search_devseq_test_V222_test.php" data-select="Capsella_rubella" class="menuspec" style="text-decoration: none"> 
                          <div class="UpperSpcClass">
                            <div class="SlSpExAtTxt">
                              Orthogroup expression
                            </div>
                            <div class="SlSpExAtImg">
                              <div class="MMinfoicn"><img src="img/icons8-info_fin2.svg" class="MMinfoiimg" title="Orthogroup expression | Orthology Inference: OrthoFinder2">
                              </div>
                              <img src="img/Orthogroups_tin.jpg" class=img-responsive" alt="" style="border-radius:7px">
                            </div>
                          </div>
                        </a> 
                      </div> 
                    </div>
                    <div class="col-xs-12">
                      <table></table>
                      <table></table>
                      <table></table>
                      <table></table>
                    </div>
                    <div class="col-xs-12">
                      <div class="MMwrap">
                        <a href="search_devseq_test_V222_test.php" data-select="Eutrema_salsugineum" class="menuspec" style="text-decoration: none"> 
                          <div class="UpperSpcClass">
                            <div class="SlSpExAtTxt">
                            </div>
                          </div>
                        </a> 
                      </div> 
                    </div>
                  </div>
                </div>
              </div><!-- End Comparative Transcriptome Content -->

              <div class = "col-xs-3">
                <div class="Integrative_Transcriptome_Analysis">
                  <div class="IntTransA">
                    <div class="SlSpExAtFt">
                      Integrative Transcriptome Analysis
                    </div>
                  </div>
                  <div class="SlSpExAtIc">
                    <div class = "col-xs-4">
                      <div class="MMIwrap">
                        <a href="search_devseq_test_V222_test.php" data-select="Capsella_rubella" class="menuspec" style="text-decoration: none"> 
                          <div class="UpperSpcClass">
                            <div class="SlSpExAtTxt">
                              Coding&nbspsense/<br>cis&#8209NAT&nbsppairs
                            </div>
                            <div class="SlSpExAtImg">
                              <div class="MMinfoicn"><img src="img/icons8-info_fin2.svg" class="MMinfoiimg" title="Expression of protein-coding sense/natural antisense transcript (cis-NAT) pairs">
                              </div>
                              <img src="img/cis_NAT_pairs_tin.jpg" class=img-responsive" alt="" style="border-radius:7px">
                            </div>
                          </div>
                        </a> 
                      </div> 
                    </div>
                    <div class="col-xs-4">
                      <div class="MMIwrap">
                        <a href="search_devseq_test_V222_test.php" data-select="Capsella_rubella" class="menuspec" style="text-decoration: none"> 
                          <div class="UpperSpcClass">
                            <div class="SlSpExAtTxt">
                              DevSeq-At<br>GenExpress
                            </div>
                            <div class="SlSpExAtImg">
                              <div class="MMinfoicn"><img src="img/icons8-info_fin2.svg" class="MMinfoiimg" title="Comparative analysis of DevSeq RNA-Seq and AtGenExpress genome array Arabidopsis thaliana gene expression data">
                              </div>
                              <img src="img/DevSeq_ATGE_tin.jpg" class=img-responsive" alt="" style="border-radius:7px">
                            </div>
                          </div>
                        </a> 
                      </div> 
                    </div>
                    <div class = "col-xs-4">
                      <div class="MMIwrap">
                        <a href="search_devseq_test_V222_test.php" data-select="Capsella_rubella" class="menuspec" style="text-decoration: none"> 
                          <div class="UpperSpcClass">
                            <div class="SlSpExAtTxt">
                              Coding&nbspsense/<br>circRNA&nbsppairs
                            </div>
                            <div class="SlSpExAtImg">
                              <div class="MMinfoicn"><img src="img/icons8-info_fin2.svg" class="MMinfoiimg" title="Expression of protein-coding sense/circular RNA (circRNA) pairs">
                              </div>
                              <img src="img/circRNA_pairs.jpg" class=img-responsive" alt="" style="border-radius:7px">
                            </div>
                          </div>
                        </a> 
                      </div> 
                    </div>
                    <div class="col-xs-12">
                      <table></table>
                      <table></table>
                      <table></table>
                      <table></table>
                    </div>
                    <div class="col-xs-4">
                      <div class="MMIwrap">
                        <a href="search_devseq_test_V222_test.php" data-select="Capsella_rubella" class="menuspec" style="text-decoration: none"> 
                          <div class="UpperSpcClass">
                            <div class="SlSpExAtTxt">
                              More...
                            </div>
                            <div class="SlSpExAtImg">
                              <div class="MMinfoicn"><img src="img/icons8-info_fin2.svg" class="MMinfoiimg" title="Find out about the integrative and functional transcriptome analysis tools we currently work on">
                              </div>
                              <img src="img/more_tin.jpg" class=img-responsive" alt="" style="border-radius:7px">
                            </div>
                          </div>
                        </a> 
                      </div> 
                    </div>
                    <div class="col-xs-12">
                      <table></table>
                      <table></table>
                      <table></table>
                      <table></table>
                      <table></table>
                    </div>
                    <div class="col-xs-12">
                      <div class="MMwrap">
                      </div> 
                    </div>
                  </div>
                </div>
              </div><!-- End Comparative Transcriptome Content -->
            </div><!-- Close bootstrap "row" -->

            <div class = "Mega_Menu_Lowerspacer">
              <div class = "Mega_Menu_LowerspacerTxt">
                <div class="MMnum1"><a href="#" title="Go to Home" ><font color="#717577">DevSeq</font></a><font color="#717577">&nbsp/</font>&nbspData Analysis
                </div>
                <div class="MMnum2">
                  <div class = "MMchild2lnk">
                  <font color="#0d0e0f">More information on: &nbsp&nbsp</font>
                    <div class='hreflinks15'>
                    <span style="text-decoration: none"><i class="fa fa-external-link" aria-hidden="true"></i></span>
                    </div>
                    <div class="tooltipwrapper" style="display:inline-block;">
                      <div><a class='hreflinks13' href="#" title="Go to Data Analysis Methods">Data Analysis Methods</a>
                      </div>
                    </div>
                    &nbsp &nbsp
                    <div class='hreflinks15'>
                    <span style="text-decoration: none"><i class="fa fa-external-link" aria-hidden="true"></i></span>
                    </div>
                    <div class="tooltipwrapper" style="display:inline-block;">
                      <div><a class='hreflinks13' href="#" title="Go to Datasets">Datasets</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- Close "Mega_Menu_Lowerspacer" -->
          </div><!-- End of "mega-dropdown-menu" -->
        </li><!-- End of "mega-dropdown active" -->

        <li><a href="#"><span>Datasets</span></a>
        </li> 
        <li><a href="#">Tools</a>
        </li>
        </ul>
      	<ul class="nav navbar-nav navbar-right">
      	<!-- Define right navbar links here --> 
        <li ><a href="https://github.com/schustischuster" target="_blank" rel="noopener" title="DevSeq on GitHub" class="fa_github_class"><span class = 'hreflinks6'><i class="fa fa-github" aria-hidden="true"></i></span></a></li>     
        <li ><a href="#" title="Release Notes" class="fa_ellipsis_class"><span class = 'hreflinks6'><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span></a>
        </li>   
        <li ><a href="#" title="Contact" class="fa_envelope_class"><span class = 'hreflinks6'><i class="fa fa-envelope icon"></i><i class="fa fa-envelope-open icon" ></i> <span></span></a></li>
        <li ><a href="#"><span class = 'hreflinks9'>About</span></a></li> 
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
               $('.dropdown-menu', this).not('.in .dropdown-menu').stop(true,true).slideToggle(350, "swing");
               $(this).toggleClass('open');        
           }
      );
    });
  </script>



  <!-- JavaScipt for writing Mega Menu selected link data (species) to local storage -->
  <script type="text/javascript"> 
    $(document).ready(function(){ 
      $('a[href="search_devseq_test_V223.php"]').click(
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
    <script src="/D3js_C3js_source/d3/d3.min.js" defer></script>
    <script src="/D3js_C3js_source/c3/c3.min.js" defer></script>
    <!-- Partial bundles at github.com/plotly/plotly.js/blob/master/dist/README.md -->
    <script src="/D3js_C3js_source/plotly/plotly-cartesian-latest_45_3.min.js" defer></script>
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
                  <div class="tooltipwrapper2" style="display:inline-block;"><a><span style="text-decoration: none" class="fa-searchinfo2" id="fasearchinfo2_id"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
                      <div class="tooltipsrcsrt" id="tooltipsrcsrtid">
                        <div class="tooltipheadwt">Input requirements and search options
                        </div>
                        <div class="tooltipborderwt">
                        </div>
                        <table></table>
                        Multiple identifiers must be seperated with an empty space, comma, or semicolon. Choose heatmap option when querying large numbers of records. If searching for an isoform, select isoform-level expression estimation.
                      </div>
                    </span>
                    </div>
                  </div>
                </div>
              </div>
              <div>
              <button type="submit" class="SButtonsrt" name="submit" id="SubmBtn" ><i class="fa fa-search"></i></button>
              </div>
            </div><!--/close "selsearchwrapper" start search side-->




            <!-- Load "storelinkInput" variable from local storage -->
            <script type="text/javascript">
              var selectorsrt = $('#selectorsrt'); 
                selectorsrt.val(localStorage.getItem("storelinkInput"));
                if (localStorage.getItem("storelinkInput") === null) {
                  selectorsrt.val("Arabidopsis_thaliana")
                  };
            </script>



            <!-- Safari Select Box hack to center select item text -->
            <script type="text/javascript">
              var customselectsrt = $(".custom-selectsrt");  
              $(document).ready(function() {
                if (navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Chrome') == -1)  {
                  $(document).ready(function() {
                    if(document.getElementById('selectorsrt').value=='Arabidopsis_lyrata') {
                        customselectsrt.addClass("al");
                    }
                    else if(document.getElementById('selectorsrt').value=='Arabidopsis_thaliana') {
                      customselectsrt.addClass("ath");
                    }
                    else if(document.getElementById('selectorsrt').value=='Capsella_rubella') {
                        customselectsrt.addClass("cr");
                    }
                    else if(document.getElementById('selectorsrt').value=='Eutrema_salsugineum') {
                        customselectsrt.addClass("es");
                    }
                    else if(document.getElementById('selectorsrt').value=='Tarenaya_hassleriana') {
                        customselectsrt.addClass("th");
                    }
                    else if(document.getElementById('selectorsrt').value=='Medicago_truncatula') {
                        customselectsrt.addClass("mt");
                    }
                    else if(document.getElementById('selectorsrt').value=='Brachypodium_distachyon') {
                        customselectsrt.addClass("bd");
                    }
                  });
                };
              });

              var slctspc  = (navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Chrome') == -1);
              $("#selectorsrt").on("change", function () {
                customselectsrt.removeClass().addClass("custom-selectsrt");
                    if((slctspc) && (document.getElementById('selectorsrt').value=='Arabidopsis_lyrata')) {
                        customselectsrt.addClass("al");           
                    }
                    else if((slctspc) && (document.getElementById('selectorsrt').value=='Arabidopsis_thaliana')) {
                        customselectsrt.addClass("ath");
                    }
                    else if((slctspc) && (document.getElementById('selectorsrt').value=='Capsella_rubella')) {
                        customselectsrt.addClass("cr");
                    }
                    else if((slctspc) && (document.getElementById('selectorsrt').value=='Eutrema_salsugineum')) {
                        customselectsrt.addClass("es");
                    }
                    else if((slctspc) && (document.getElementById('selectorsrt').value=='Tarenaya_hassleriana')) {
                        customselectsrt.addClass("th");
                    }
                    else if((slctspc) && (document.getElementById('selectorsrt').value=='Medicago_truncatula')) {
                        customselectsrt.addClass("mt");
                    }
                    else if((slctspc) && (document.getElementById('selectorsrt').value=='Brachypodium_distachyon')) {
                        customselectsrt.addClass("bd");
                    }
              });             
            </script>


            <!-- JavaScript to control select box placeholder -->
            <script type="text/javascript">  
              var placeholderText = {
                "Arabidopsis_thaliana": "Enter gene, isoform ID, or symbol, e.g. AT5G10720, PIN1, or paste a list of identifiers",
                "Arabidopsis_lyrata": "Enter gene or isoform ID, e.g. AL6G21260.t1, AL1G32580.t1, or paste a list of IDs",
                "Brachypodium_distachyon": "Enter gene or isoform ID, e.g. Bradi1g31200.1, Bradi5g25157.1, or paste a list of IDs",
                "Capsella_rubella": "Enter gene or isoform ID, e.g. Carubv10003739m, Carubv10008258m, or paste a list",
                "Eutrema_salsugineum": "Enter gene or isoform ID, e.g. Thhalv10012606m, Thhalv10006748m, or paste a list",
                "Medicago_truncatula": "Enter gene or isoform ID, e.g. Medtr1g013360.1, Medtr1g024025.1, or paste a list",
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
                      &nbsp <input type="checkbox" class="checktoradio" name="filter5" value="2" id="cb2" noneoption="true"<?php if ($_POST['filter5'] == "2") echo 'checked';?>><label for="cb2"> min/max (RE)</label> 
                        <div class="tooltipwrapper" style="display:inline-block;"><a><span class = 'hreflinks11' style="text-decoration: none" ><i class="fa fa-info-circle" aria-hidden="true"></i></span></a>
                          <div class = "tooltipsrtbridge"></div>
                          <div class="tooltipsrt">Expression values will be scaled between 0 and 1. This allows to compare expression patterns of transcripts that display unequal absolute intensities. See <a class = 'hreflinks8' href="https://www.ncbi.nlm.nih.gov/pubmed/21150997" target="_blank" rel="noopener"><u>Domazet-Lo&scaron;o and Tautz (2010)</u></a>.</font>
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
        text.value = 'AT5G10720, AT1G19850.1';
        text.focus();
        document.getElementById('isoformlev').checked = true;
        }
        else if (document.getElementById('selectorsrt').value=='Arabidopsis_lyrata') {
          text.value = 'AL6G21260.t1, AL1G32580.t1';
          text.focus();
        document.getElementById('isoformlev').checked = true;
        }
        else if (document.getElementById('selectorsrt').value=='Capsella_rubella') {
          text.value = 'Carubv10003739m, Carubv10008258m';
          text.focus();
        document.getElementById('isoformlev').checked = true;
        }
        else if (document.getElementById('selectorsrt').value=='Eutrema_salsugineum') {
          text.value = 'Thhalv10012606m, Thhalv10006748m';
          text.focus();
        document.getElementById('isoformlev').checked = true;
        }
        else if (document.getElementById('selectorsrt').value=='Tarenaya_hassleriana') {
          text.value = 'XM_010527257.2, XM_010538056.2';
          text.focus();
        document.getElementById('isoformlev').checked = true;
        }
        else if (document.getElementById('selectorsrt').value=='Medicago_truncatula') {
          text.value = 'Medtr1g013360.1, Medtr1g024025.1';
          text.focus();
        document.getElementById('isoformlev').checked = true;
        }
        else {
          text.value = 'Bradi1g31200.1, Bradi5g25157.1';
          text.focus();
        document.getElementById('isoformlev').checked = true;
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
                <a title="Multiple identifiers must be seperated by an empty space, comma, or semicolon. If searching for an isoform, select isoform-level expression estimation." class = "fa-searchinfo" ><i class="fa fa-info-circle" ></i></a>
              </div>
            </div>
          </div>
          <div>
            <button type="submit" class="SButton" name="myBtn" type="submit" id="SubmBtn" ><i class="fa fa-search"></i></button>
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
          "Medicago_truncatula": "Enter gene or isoform ID, e.g. Medtr1g013360.1, Medtr1g024025.1, or paste a list of IDs",
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
                        <div class="tooltipwrapper" style="display:inline-block;"><a><span class = 'hreflinks5' style="text-decoration: none" ><i class="fa fa-info-circle" aria-hidden="true"></i></a>
                          <div class="tooltip">Expression values will be scaled between 0 and 1. It allows to compare expression patterns of transcripts that display unequal absolute intensities. See <a class = 'hreflinks14' href="https://www.ncbi.nlm.nih.gov/pubmed/21150997" target="_blank" rel="noopener"><u>Domazet-Lo&scaron;o and Tautz (2010)</u></a>.</font>
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
                      <div class="tooltipwrapper" style="display:inline-block;"><a><span class = 'hreflinks5' style="text-decoration: none" ><i class="fa fa-info-circle" aria-hidden="true"></i></span></a>
                        <div class="tooltipclust2"> Hierarchical clustering of expression profiles using the average-linkage method will be performed if multiple identifiers are submitted. See SciPy documentation for <a class = 'hreflinks14' href="https://docs.scipy.org/doc/scipy/reference/cluster.hierarchy.html" target="_blank" rel="noopener"><u>cluster.hierarchy</u></a>.
                      </div>
                    </div>
                    <table></table>
                    <font color="#f7f6f6">.</font> 
                    </div>
                  </div>  
                </div><!--/close "some-classinner"-->
                <span class = 'hreflinks1'>
                <button id="export_charts" class="btn btn-green" type="submit" <?php if ((!isset($_POST['searchquery']) || $_POST['searchquery'] == "") || $count==0){?> style="display: none" <?php } ?> style="text-decoration: none" class="tfbutton3"><i class="fa fa-refresh" aria-hidden="true"></i> <span>Update chart</span></a></button>
                </span>
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
                      <a><span class = 'hreflinks7' style="text-decoration: none" class="tfbutton5"><i class="fa fa-info-circle" aria-hidden="true"></i></span></a>
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
                          One or more loci have orthologs in other species. Click on link to show expression.
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
                </div><!--/close "srcresout" div -->

                <!-- div for title text line -->
                <div class = "titletextline">
                </div>

                <!-- div for line chart -->
                <div id="chart">
                </div> 

                <!-- div for line chart -->
                <div id="chart_2" style="display: none">
                </div>

                <!-- div for line chart -->
                <div id="chart_3" style="display: none">
                </div>



                <!-- line chart message: if to many query IDs, print notification -->
                <?php if ((isset($_POST['searchquery'])) && ($_POST['searchquery'] != "") && $_POST['filter4'] == "line_chart" && $_POST['filter1'] == "Arabidopsis_thaliana" && ($count > 50)){?>

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
  		              <span class = 'hreflinks1'>
                    <button id="export_charts" class="btn btn-gray-light" title="Download data as csv file" <?php if ((!isset($_POST['searchquery']) || $_POST['searchquery'] == "") || $count==0){?> style="display: none" <?php } ?> style="text-decoration: none" class="tfbutton3" onclick="download_csv_function();"><i class="fa fa-download" aria-hidden="true" style="color:#0a1e38"></i> <span>Data</span></a></button>
                    </span>
                    <span class = 'hreflinks3'>
                    <a href="devseq_sample_table.xls" download="devseq_sample_table.xls" Download!><button class="btn btn-gray-light" title="Download sample table as xls file" <?php if ((!isset($_POST['searchquery']) || $_POST['searchquery'] == "") || $count==0){?> style="display: none" <?php } ?> style="text-decoration: none"><i class="fa fa-download" aria-hidden="true" style="color:#0a1e38"></i><span> Sample table</span></button></a></a>
                    </span>
                    <span class = 'hreflinks2'>
                    <button id="show2" class="btn btn-gray-light" title="Generate pdf and download chart from cloud" <?php if ((!isset($_POST['searchquery']) || $_POST['searchquery'] == "") || $count==0 || $count>50 || $_POST['filter4'] == "heatmap" || ($_POST['filter4'] == "heatmap" && $_POST['filter6'] == "1" && $count==1)) {?> style="display: none" <?php } ?> style="text-decoration: none" class="tfbutton4" onclick="return addnsandprint()"><i class="fa fa-cloud-download" aria-hidden="true" style="color:#0a1e38"></i> <span>Chart</span></a></button>
                    </span>
                    <span class = 'hreflinks2'>
                    <button id="show3" class="btn btn-gray-light" title="Generate pdf and download resized chart from cloud" <?php if ((!isset($_POST['searchquery']) || $_POST['searchquery'] == "") || $_POST['filter1'] != "Arabidopsis_thaliana" || $count==0 || $count>50 || $_POST['filter4'] == "heatmap" || ($_POST['filter4'] == "heatmap" && $_POST['filter6'] == "1" && $count==1)) {?> style="display: none" <?php } ?> style="text-decoration: none" class="tfbutton4" onclick="return addnsandprint_2()"><i class="fa fa-cloud-download" aria-hidden="true" style="color:#0a1e38"></i> <span>Resized chart</span></a></button>
                    </span>
                    <span class = 'hreflinks2'>
                    <button id="show4" class="btn btn-gray-light" title="Generate pdf and download resized chart from cloud" <?php if ((!isset($_POST['searchquery']) || $_POST['searchquery'] == "") || $_POST['filter1'] == "Arabidopsis_thaliana" || $count==0 || $count>50 || $_POST['filter4'] == "heatmap" || ($_POST['filter4'] == "heatmap" && $_POST['filter6'] == "1" && $count==1)) {?> style="display: none" <?php } ?> style="text-decoration: none" class="tfbutton4" onclick="return addnsandprint_3()"><i class="fa fa-cloud-download" aria-hidden="true" style="color:#0a1e38"></i> <span>Resized chart</span></a></button>
                    </span>
                    


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
Writing output files to local
************************************************************************ -->
<!-- ******************************************************************* -->


<?php
  // write search results to json and php files on server
  $fp = fopen('results.json', 'w');
  fwrite($fp, $jsonouthclust);
  fclose($fp);
  $rp = fopen('results.php', 'w');
  fwrite($rp, print_r($transformqclustcsv, TRUE));
  fclose($rp);
?>




<!-- ******************************************************************* -->
<!-- ***********************************************************************
Run javascript vizualisation libraries for line chart and heatmap here
************************************************************************ -->
<!-- ******************************************************************* -->


<?php 
// define line chart parameters for plotting Arabidopsis thaliana data here
if($_POST['filter4'] == "line_chart" && $_POST['filter1'] == "Arabidopsis_thaliana" && ($count > 0) && ($count < 51)) { ?>

    <script>
      var dataset = <?php echo $jsonout; ?>;
      var title = <?php echo $titleout; ?>;
      var x_axis_cat = ['root, root tip, 5d.1', 'root, root tip, 5d.2', 'root, root tip, 5d.3', 'root, maturation zone, 5d.1', 'root, maturation zone, 5d.2', 'root, maturation zone, 5d.3', 'root, whole root, 5d.1', 'root, whole root_5d.2', 'root, whole root, 5d.3', 'root, whole root, 7d.1', 'root, whole root, 7d.2', 'root, whole root, 7d.3', 'root, whole root, 14d.1', 'root, whole root, 14d.2', 'root, whole root, 14d.3', 'root, whole root, 21d.1', 'root, whole root, 21d.2', 'root, whole root, 21d.3', 'hypocotyl, 10d.1', 'hypocotyl, 10d.2', 'hypocotyl, 10d.3', '3rd internode, 24d.1', '3rd internode, 24d.2', '3rd internode, 24d.3', '2nd internode, 24d.1', '2nd internode, 24d.2', '2nd internode, 24d.3', '1st internode, 28d.1', '1st internode, 28d.2', '1st internode, 28d.3', 'cotyledons, 7d.1', 'cotyledons, 7d.2', 'cotyledons, 7d.3', 'leaf 1+2, 7d.1', 'leaf 1+2, 7d.2', 'leaf 1+2, 7d.3', 'leaf 1+2, 10d.1', 'leaf 1+2, 10d.2', 'leaf 1+2, 10d.3', 'leaf 1+2, petiole, 10d.1', 'leaf 1+2, petiole, 10d.2', 'leaf 1+2, petiole, 10d.3', 'leaf 1+2, leaf tip, 10d.1', 'leaf 1+2, leaf tip, 10d.2', 'leaf 1+2, leaf tip, 10d.3', 'leaf 5+6, 17d.1', 'leaf 5+6, 17d.2', 'leaf 5+6, 17d.3', 'leaf 9+10, 27d.1', 'leaf 9+10, 27d.2', 'leaf 9+10, 27d.3', 'leaves senescing, 35d.1', 'leaves senescing, 35d.2', 'leaves senescing, 35d.3', 'cauline leaves, 24d.1', 'cauline leaves, 24d.2', 'cauline leaves, 24d.3', 'apex vegetative, 7d.1', 'apex vegetative, 7d.2', 'apex vegetative, 7d.3', 'apex vegetative, 10d.1', 'apex vegetative, 10d.2', 'apex vegetative, 10d.3', 'apex vegetative, 14d.1', 'apex vegetative, 14d.2', 'apex vegetative, 14d.3', 'apex inflorescence, 21d.1', 'apex inflorescence, 21d.2', 'apex inflorescence, 21d.3', 'apex inflorescence, 28d.1', 'apex inflorescence, 28d.2', 'apex inflorescence, 28d.3', 'apex inflor. clv1, 21d.1', 'apex inflor. clv1, 21d.2', 'apex inflor. clv1, 21d.3', 'flower stg9, 21d+.1', 'flower stg9, 21d+.2', 'flower stg9, 21d+.3', 'flower stg10/11, 21d+.1', 'flower stg10/11, 21d+.2', 'flower stg10/11, 21d+.3', 'flower stg12, 21d+.1', 'flower stg12, 21d+.2', 'flower stg12, 21d+.3', 'flower stg15, 21d+.1', 'flower stg15, 21d+.2', 'flower stg15, 21d+.3', 'flower stg12, sepals.1', 'flower stg12, sepals.2', 'flower stg12, sepals.3', 'flower stg15, sepals.1', 'flower stg15, sepals.2', 'flower stg15, sepals.3', 'flower stg12, petals.1', 'flower stg12, petals.2', 'flower stg12, petals.3', 'flower stg15, petals.1', 'flower stg15, petals.2', 'flower stg15, petals.3', 'flower stg12, stamens.1', 'flower stg12, stamens.2', 'flower stg12, stamens.3', 'flower stg15, stamens.1', 'flower stg15, stamens.2', 'flower stg15, stamens.3', 'mature pollen, 28d+.1', 'mature pollen, 28d+.2', 'mature pollen, 28d+.3', 'flower early stg12, carpels.1', 'flower early stg12, carpels.2', 'flower early stg12, carpels.3', 'flower late stg12, carpels.1', 'flower late stg12, carpels.2', 'flower late stg12, carpels.3', 'flower stg15, carpels.1', 'flower stg15, carpels.2', 'flower stg15, carpels.3', 'fruit stg16, siliques.1', 'fruit stg16, siliques.2', 'fruit stg16, siliques.3', 'fruit stg17a, siliques.1', 'fruit stg17a, siliques.2', 'fruit stg17a, siliques.3', 'fruit stg16/17a, seeds.1', 'fruit stg16/17a, seeds.2', 'fruit stg16/17a, seeds.3', 'fruit stg17b, seeds.1', 'fruit stg17b, seeds.2', 'fruit stg17b, seeds.3', 'fruit stg18, seeds.1', 'fruit stg18, seeds.2', 'fruit stg18, seeds.3' , ''];
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
      });



    // Function to call line charts for chart#2 div (not displayed) for resized plotting option
    $("#show3").click(function() {
      var x_axis_cat_prt = ['', 'root, root tip, 5d', '', '', 'root, maturation zone', '', '', 'root, whole root_5d', '', '', 'root, whole root, 7d', '', '', 'root, whole root, 14d', '', '', 'root, whole root, 21d', '', '', 'hypocotyl, 10d', '', '', '3rd internode, 24d', '', '', '2nd internode, 24d', '', '', '1st internode, 28d', '', '', 'cotyledons, 7d', '', '', 'leaf 1+2, 7d', '', '', 'leaf 1+2, 10d', '', '', 'leaf 1+2, petiole, 10d', '', '', 'leaf 1+2, leaf tip, 10d', '', '', 'leaf 5+6, 17d', '', '', 'leaf 9+10, 27d', '', '', 'leaves senescing, 35d', '', '', 'cauline leaves, 24d', '', '', 'apex vegetative, 7d', '', '', 'apex vegetative, 10d', '', '', 'apex vegetative, 14d', '', '', 'apex inflor, 21d', '', '', 'apex inflor, 28d', '', '', 'apex inflor clv1, 21d', '', '', 'flower stg9, 21d+', '', '', 'flower stg10/11, 21d+', '', '', 'flower stg12, 21d+', '', '', 'flower stg15, 21d+', '', '', 'sepals stg12', '', '', 'sepals stg15', '', '', 'petals stg12', '', '', 'petals stg15', '', '', 'stamens stg12', '', '', 'stamens stg15', '', '', 'mature pollen, 28d+', '', '', 'carpels early stg12', '', '', 'carpels late stg12', '', '', 'carpels stg15', '', '', 'fruit stg16, siliques', '', '', 'fruit stg17a, siliques', '', '', 'fruit stg16/17a, seeds', '', '', 'fruit stg17b, seeds', '', '', 'fruit stg18, seeds', '' , ''];
      if ($("#displaydomain").hasClass("active")) {
        var chart_2 = c3.generate({
          bindto: '#chart_2',
          padding: {
            top: 20,
            right: 60,
            bottom: 30,
            left: 60,
          },
          size: {height: 467, width: 620},
          point: {r: 3.4},
          data: {json: dataset},
          axis: {
            x: {
              type: 'category',
              categories: x_axis_cat_prt,
              tick: {
                rotate:90,
                multiline: false,
                inner:false
              },
              height: 120,
              padding: {
                left: 0.1,
                right: 0.25
              },
            },
            y: { 
              label: {
                text: title,
                position: 'outer-middle'
              },
              min: 0,
              padding: {bottom:0},
              tick: {
                outer: false,
                format: function (d) {
                  if ((d / 1000) >= 1) {
                    d = Math.round((d / 1000 )*100) / 100 + "K";
                  }
                  return d;
                }
              }
            }
          },
          grid: {
            lines: {front: false},
          },
          zoom: {enabled: false},
          regions: ath_regions,
          onrendered: function() {
            d3.select("#chart_2").selectAll(".c3-axis-x .tick line").style("display", "none");
          }   
        });
      }
      else if ($("#displaygrid").hasClass("active")) {
        var chart_2 = c3.generate({
          bindto: '#chart_2',
          padding: {
            top: 20,
            right: 60,
            bottom: 30,
            left: 60,
          },
          size: {height: 467, width: 620},
          point: {r: 3.4},
          data: {json: dataset},
          axis: {
            x: {
              type: 'category',
              categories: x_axis_cat_prt,
              tick: {
                rotate:90,
                multiline: false,
                inner:false
              },
              height: 120,
              padding: {right: 0.5},
            },
            y: { 
              label: {
                text: title,
                position: 'outer-middle'
              },
              min:0,
              padding: {bottom:1.5},
              tick: {
                outer: false,
                format: function (d) {
                  if ((d / 1000) >= 1) {
                    d = Math.round((d / 1000 )*100) / 100 + "K";
                  }
                  return d;
                }
              }
            }
          },
          grid: {
            x: {
              lines: [
                {value: -0.5, class: 'gridx'},
                {value: 17.5, class: 'gridx'},
                {value: 29.5, class: 'gridx'},
                {value: 56.5, class: 'gridx'},
                {value: 74.5, class: 'gridx'},
                {value: 86.5, class: 'gridx'},
                {value: 113.5, class: 'gridx'},
                {value: 131.5, class: 'gridx'}
              ]
            },
            y: {
              show: true,
              lines: [
                {value: 0, class: 'gridx'}
              ]
            },
          lines: {front: false},
          },
          zoom: {enabled: false},
          onrendered: function() {
            d3.select("#chart_2").selectAll(".c3-axis-x .tick line").style("display", "none");
            d3.select("#chart_2").selectAll(".c3 path.domain").style("stroke", "rgb(224,224,224,0)");
          }   
        });
      }
      else if ($("#displayplain").hasClass("active")) {
        var chart_2 = c3.generate({
          bindto: '#chart_2',
          padding: {
            top: 20,
            right: 60,
            bottom: 30,
            left: 60,
          },
          size: {height: 467, width: 620},
          point: {r: 3.4},
          data: {json: dataset},
          axis: {
            x: {
              type: 'category',
              categories: x_axis_cat_prt,
              tick: {
                rotate:90,
                multiline: false,
                inner:false
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
              padding: {bottom:0},
              tick: {
                outer: false,
                format: function (d) {
                  if ((d / 1000) >= 1) {
                    d = Math.round((d / 1000 )*100) / 100 + "K";
                  }
                  return d;
                }
              }
            }
          },
          grid: {
            lines: {front: false},
          },
          zoom: {enabled: false},
          onrendered: function() {
            d3.select("#chart_2").selectAll(".c3-axis-x .tick line").style("display", "none");
          }   
        });
      }
    })



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
        regions: ath_regions
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
   	  });
    }
    )}

  </script>
<?php } 




// define line chart parameters for plotting non-Arabidopsis thaliana data here
else if ($_POST['filter4'] == "line_chart" && ($count > 0) && ($count < 51) && $_POST['filter1'] != "Arabidopsis_thaliana") { ?>

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
        zoom: {enabled: false}
      });



    // Function to call line charts for chart#3 div (not displayed) for resized plotting option
    $("#show4").click(function() {
      var xValues_plt = 
       <?php if($_POST['filter1'] == "Capsella_rubella") { ?>
       ['root, whole root.1', 'root, whole root.2', 'root, whole root.3', 'hypocotyl.1', 'hypocotyl.2', 'hypocotyl.3', 'leaf 1+2.1', 'leaf 1+2.2', 'leaf 1+2.3', 'apex vegetative.1', 'apex vegetative.2', 'apex vegetative.3', 'apex inflor.1', 'apex inflor.2', 'apex inflor.3', 'flower stg12.1', 'flower stg12.2', 'flower stg12.3', 'carpels stg12.1', 'carpels stg12.2', 'carpels stg12.3', 'stamens stg12.1', 'stamens stg12.2', 'stamens stg12.3', 'mature pollen.1', 'mature pollen.2', 'mature pollen.3'];
        <?php } 
        else if ($_POST['filter1'] == "Eutrema_salsugineum") { ?>
        ['whole root.1', 'whole root.2', 'whole root.3', 'hypocotyl.1', 'hypocotyl.2', 'hypocotyl.3', 'leaf 1+2.1', 'leaf 1+2.2', 'leaf 1+2.3', 'apex veget.1', 'apex veget.2', 'apex veget.3', 'apex inflor.1', 'apex inflor.2', 'apex inflor.3', 'flower 12.1', 'flower 12.2', 'flower 12.3', 'carpel 12.1', 'carpel 12.2', 'carpel 12.3', 'stamen 12.1', 'stamen 12.2', 'stamen 12.3', 'pollen.1', 'pollen.2', 'pollen.3'];
        <?php } ?>
      var nonathgrid_plt = [
        {value: -0.45, class: 'gridx'},
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
      if ($("#displaygrid_noath").hasClass("active")) {
        var chart_3 = c3.generate({
          bindto: '#chart_3',
          padding: {
            top: 20,
            right: 60,
            bottom: 0,
            left: 60,
          },
          size: {height: 438, width: 611},
          point: {r: 3.7},
          data: {json: dataset},
          axis: {
            x: {
              type: 'category',
              categories: xValues_plt,
              tick: {
                rotate:90,
                multiline: false,
              },
              height: 120,
              padding: {right: 0.04},
            },
            y: { 
              label: {
                text: title,
                position: 'outer-middle'
              },
              min:0,
              padding: {bottom: 1.5},
              tick: {
                outer: false,
                format: function (d) {
                  if ((d / 1000) >= 1) {
                    d = Math.round((d / 1000 )*100) / 100 + "K";
                  }
                  return d;
                }
              }
            }
          },
          grid: {
            x: {lines: nonathgrid_plt},
            y: {show: true},
            lines: {front: false},
          },
          zoom: {enabled: false},
          onrendered: function() {
            d3.select("#chart_3").selectAll(".c3-axis-x .tick line").style("display", "none");
            d3.select("#chart_3").selectAll(".c3 path.domain").style("stroke", "rgb(224,224,224,0)");
          }   
        });
      }
      else if ($("#displayplain_noath").hasClass("active")) {
        var chart_3 = c3.generate({
          bindto: '#chart_3',
          padding: {
            top: 20,
            right: 60,
            bottom: 0,
            left: 60,
          },
          size: {height: 438, width: 611},
          point: {r: 3.7},
          data: {json: dataset},
          axis: {
            x: {
              type: 'category',
              categories: xValues_plt,
              tick: {
                rotate:90,
                multiline: false,
                culling: {max: 45}
              },
              height: 120,
              padding: {right: 0.04},
            },
            y: { 
              label: {
                text: title,
                position: 'outer-middle'
              },
              min:0,
              padding: {bottom: 1.5},
              tick: {
                outer: false,
                format: function (d) {
                  if ((d / 1000) >= 1) {
                    d = Math.round((d / 1000 )*100) / 100 + "K";
                  }
                  return d;
                }
              }
            }
          },
          grid: {
            lines: {front: false},
          },
          zoom: {enabled: false},
          onrendered: function() {
            d3.select("#chart_3").selectAll(".c3-axis-x .tick line").style("display", "none");
          }   
        });
      }
    })


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
        ['root, root tip, 5d.1', 'root, root tip, 5d.2', 'root, root tip, 5d.3', 'root, maturation zone, 5d.1', 'root, maturation zone, 5d.2', 'root, maturation zone, 5d.3', 'root, whole root, 5d.1', 'root, whole root_5d.2', 'root, whole root, 5d.3', 'root, whole root, 7d.1', 'root, whole root, 7d.2', 'root, whole root, 7d.3', 'root, whole root, 14d.1', 'root, whole root, 14d.2', 'root, whole root, 14d.3', 'root, whole root, 21d.1', 'root, whole root, 21d.2', 'root, whole root, 21d.3', 'hypocotyl, 10d.1', 'hypocotyl, 10d.2', 'hypocotyl, 10d.3', '3rd internode, 24d.1', '3rd internode, 24d.2', '3rd internode, 24d.3', '2nd internode, 24d.1', '2nd internode, 24d.2', '2nd internode, 24d.3', '1st internode, 28d.1', '1st internode, 28d.2', '1st internode, 28d.3', 'cotyledons, 7d.1', 'cotyledons, 7d.2', 'cotyledons, 7d.3', 'leaf 1+2, 7d.1', 'leaf 1+2, 7d.2', 'leaf 1+2, 7d.3', 'leaf 1+2, 10d.1', 'leaf 1+2, 10d.2', 'leaf 1+2, 10d.3', 'leaf 1+2, petiole, 10d.1', 'leaf 1+2, petiole, 10d.2', 'leaf 1+2, petiole, 10d.3', 'leaf 1+2, leaf tip, 10d.1', 'leaf 1+2, leaf tip, 10d.2', 'leaf 1+2, leaf tip, 10d.3', 'leaf 5+6, 17d.1', 'leaf 5+6, 17d.2', 'leaf 5+6, 17d.3', 'leaf 9+10, 27d.1', 'leaf 9+10, 27d.2', 'leaf 9+10, 27d.3', 'leaves senescing, 35d.1', 'leaves senescing, 35d.2', 'leaves senescing, 35d.3', 'cauline leaves, 24d.1', 'cauline leaves, 24d.2', 'cauline leaves, 24d.3', 'apex vegetative, 7d.1', 'apex vegetative, 7d.2', 'apex vegetative, 7d.3', 'apex vegetative, 10d.1', 'apex vegetative, 10d.2', 'apex vegetative, 10d.3', 'apex vegetative, 14d.1', 'apex vegetative, 14d.2', 'apex vegetative, 14d.3', 'apex inflorescence, 21d.1', 'apex inflorescence, 21d.2', 'apex inflorescence, 21d.3', 'apex inflorescence, 28d.1', 'apex inflorescence, 28d.2', 'apex inflorescence, 28d.3', 'apex inflor. clv1, 21d.1', 'apex inflor. clv1, 21d.2', 'apex inflor. clv1, 21d.3', 'flower stg9, 21d+.1', 'flower stg9, 21d+.2', 'flower stg9, 21d+.3', 'flower stg10/11, 21d+.1', 'flower stg10/11, 21d+.2', 'flower stg10/11, 21d+.3', 'flower stg12, 21d+.1', 'flower stg12, 21d+.2', 'flower stg12, 21d+.3', 'flower stg15, 21d+.1', 'flower stg15, 21d+.2', 'flower stg15, 21d+.3', 'flower stg12, sepals.1', 'flower stg12, sepals.2', 'flower stg12, sepals.3', 'flower stg15, sepals.1', 'flower stg15, sepals.2', 'flower stg15, sepals.3', 'flower stg12, petals.1', 'flower stg12, petals.2', 'flower stg12, petals.3', 'flower stg15, petals.1', 'flower stg15, petals.2', 'flower stg15, petals.3', 'flower stg12, stamens.1', 'flower stg12, stamens.2', 'flower stg12, stamens.3', 'flower stg15, stamens.1', 'flower stg15, stamens.2', 'flower stg15, stamens.3', 'mature pollen, 28d+.1', 'mature pollen, 28d+.2', 'mature pollen, 28d+.3', 'flower early stg12, carpels.1', 'flower early stg12, carpels.2', 'flower early stg12, carpels.3', 'flower late stg12, carpels.1', 'flower late stg12, carpels.2', 'flower late stg12, carpels.3', 'flower stg15, carpels.1', 'flower stg15, carpels.2', 'flower stg15, carpels.3', 'fruit stg16, siliques.1', 'fruit stg16, siliques.2', 'fruit stg16, siliques.3', 'fruit stg17a, siliques.1', 'fruit stg17a, siliques.2', 'fruit stg17a, siliques.3', 'fruit stg16/17a, seeds.1', 'fruit stg16/17a, seeds.2', 'fruit stg16/17a, seeds.3', 'fruit stg17b, seeds.1', 'fruit stg17b, seeds.2', 'fruit stg17b, seeds.3', 'fruit stg18, seeds.1', 'fruit stg18, seeds.2', 'fruit stg18, seeds.3'];

        var title = <?php echo $titleout; ?>;

        var ticknumber = <?php if($countout == 1) { ?> 3;
                     <?php } else { ?> 0; <?php } ?>;

        var ticklabels = ['root, root tip, 5d.1', 'root, maturation zone, 5d.1', 'root, whole root, 5d.1', 'root, whole root, 7d.1', 'root, whole root, 14d.1', 'root, whole root, 21d.1', 'hypocotyl, 10d.1', '3rd internode, 24d.1',  '2nd internode, 24d.1', '1st internode, 28d.1', 'cotyledons, 7d.1', 'leaf 1+2, 7d.1', 'leaf 1+2, 10d.1', 'leaf 1+2, petiole, 10d.1', 'leaf 1+2, leaf tip, 10d.1', 'leaf 5+6, 17d.1', 'leaf 9+10, 27d.1', 'leaves senescing, 35d.1', 'cauline leaves, 24d.1', 'apex vegetative, 7d.1', 'apex vegetative, 10d.1', 'apex vegetative, 14d.1', 'apex inflorescence, 21d.1', 'apex inflorescence, 28d.1', 'apex inflor. clv1, 21d.1', 'flower stg9, 21d+.1', 'flower stg10/11, 21d+.1', 'flower stg12, 21d+.1', 'flower stg15, 21d+.1', 'flower stg12, sepals.1', 'flower stg15, sepals.1', 'flower stg12, petals.1', 'flower stg15, petals.1', 'flower stg12, stamens.1', 'flower stg15, stamens.1', 'mature pollen, 28d+.1', 'flower early stg12, carpels.1', 'flower late stg12, carpels.1', 'flower stg15, carpels.1', 'fruit stg16, siliques.1', 'fruit stg17a, siliques.1', 'fruit stg16/17a, seeds.1', 'fruit stg17b, seeds.1', 'fruit stg18, seeds.1'];

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
            b: 175,
            t: 68,
            pad: 0
            },
          xaxis: {
            showticklabels: true,
            tickangle: 90,
            tickvals: ticklabels,
            tickfont: {
              size: 11.5,
              color: 'black'
            }},
          yaxis: {
            showticklabels: true,
            tickangle: 0,
            tickfont: {
            size: 11.5,
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
                size: 11.5,
                color: 'black'
            }},
          yaxis: {
            showticklabels: true,
            tickangle: 0,
            tickfont: {
              size: 11.5,
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
              size: 11.5,
              color: 'black'
            }},
          yaxis: {
            showticklabels: true,
            tickangle: 0,
            tickfont: {
              size: 11.5,
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
        ['root_root tip_5d', 'root_maturation zone_5d', 'root_whole root_5d', 'root_whole root_7d', 'root_whole root_14d', 'root_whole root_21d', 'hypocotyl_10d', '3rd internode_24d', '2nd internode_24d', '1st internode_28d', 'cotyledons_7d', 'leaf 1+2_7d', 'leaf 1+2_10d', 'leaf 1+2_petiole_10d', 'leaf 1+2_leaf tip_10d', 'leaf_5+6_17d', 'leaf_9+10_27d', 'leaves senescing_35d', 'cauline leaves_24d', 'apex vegetative_7d', 'apex vegetative_10d', 'apex vegetative_14d', 'apex inflorescence_21d', 'apex inflorescence_28d', 'apex inflorescence_clv1_21d', 'flower stg9_21d+', 'flower stg10/11_21d+', 'flower stg12_21d+', 'flower stg15_21d+', 'flower stg12_sepals', 'flower stg15_sepals', 'flower stg12_petals', 'flower stg15_petals', 'flower stg12_stamens', 'flower stg15_stamens', 'mature pollen_28d+', 'flower early stg12_carpels', 'flower late stg12_carpels', 'flower stg15_carpels', 'fruit stg16_siliques', 'fruit stg17a_siliques', 'fruit stg16/17a_seeds', 'fruit stg17b_seeds', 'fruit stg18_seeds'];

        var title = <?php echo $titleout; ?>;

        var ticknumber = <?php if($countout == 1) { ?> 3;
                     <?php } else { ?> 0; <?php } ?>;

        var ticklabels = ['root_root tip_5d', 'root_maturation zone_5d', 'root_whole root_5d', 'root_whole root_7d', 'root_whole root_14d', 'root_whole root_21d', 'hypocotyl_10d', '3rd internode_24d', '2nd internode_24d', '1st internode_28d', 'cotyledons_7d', 'leaf 1+2_7d', 'leaf 1+2_10d', 'leaf 1+2_petiole_10d', 'leaf 1+2_leaf tip_10d', 'leaf_5+6_17d', 'leaf_9+10_27d', 'leaves senescing_35d', 'cauline leaves_24d', 'apex vegetative_7d', 'apex vegetative_10d', 'apex vegetative_14d', 'apex inflorescence_21d', 'apex inflorescence_28d', 'apex inflorescence_clv1_21d', 'flower stg9_21d+', 'flower stg10/11_21d+', 'flower stg12_21d+', 'flower stg15_21d+', 'flower stg12_sepals', 'flower stg15_sepals', 'flower stg12_petals', 'flower stg15_petals', 'flower stg12_stamens', 'flower stg15_stamens', 'mature pollen_28d+', 'flower early stg12_carpels', 'flower late stg12_carpels', 'flower stg15_carpels', 'fruit stg16_siliques', 'fruit stg17a_siliques', 'fruit stg16/17a_seeds', 'fruit stg17b_seeds', 'fruit stg18_seeds'];

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
              size: 11.5,
              color: 'black'
            }},
          yaxis: {
            showticklabels: true,
            tickangle: 0,
            tickfont: {
              size: 11.5,
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
            b: 175,
            t: 68,
            pad: 0
          },
          xaxis: {
            showticklabels: true,
            tickangle: 90,
            tickfont: {
              size: 11.5,
              color: 'black'
          }},
          yaxis: {
            showticklabels: true,
            tickangle: 0,
            tickfont: {
              size: 11.5,
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
              size: 11.5,
              color: 'black'
            }},
          yaxis: {
            showticklabels: true,
            tickangle: 0,
            tickfont: {
              size: 11.5,
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
              size: 11.5,
              color: 'black'
            }},
          yaxis: {
            showticklabels: true,
            tickangle: 0,
            tickfont: {
              size: 11.5,
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
        ['root, root tip, 5d.1', 'root, root tip, 5d.2', 'root, root tip, 5d.3', 'root, maturation zone, 5d.1', 'root, maturation zone, 5d.2', 'root, maturation zone, 5d.3', 'root, whole root, 5d.1', 'root, whole root_5d.2', 'root, whole root, 5d.3', 'root, whole root, 7d.1', 'root, whole root, 7d.2', 'root, whole root, 7d.3', 'root, whole root, 14d.1', 'root, whole root, 14d.2', 'root, whole root, 14d.3', 'root, whole root, 21d.1', 'root, whole root, 21d.2', 'root, whole root, 21d.3', 'hypocotyl, 10d.1', 'hypocotyl, 10d.2', 'hypocotyl, 10d.3', '3rd internode, 24d.1', '3rd internode, 24d.2', '3rd internode, 24d.3', '2nd internode, 24d.1', '2nd internode, 24d.2', '2nd internode, 24d.3', '1st internode, 28d.1', '1st internode, 28d.2', '1st internode, 28d.3', 'cotyledons, 7d.1', 'cotyledons, 7d.2', 'cotyledons, 7d.3', 'leaf 1+2, 7d.1', 'leaf 1+2, 7d.2', 'leaf 1+2, 7d.3', 'leaf 1+2, 10d.1', 'leaf 1+2, 10d.2', 'leaf 1+2, 10d.3', 'leaf 1+2, petiole, 10d.1', 'leaf 1+2, petiole, 10d.2', 'leaf 1+2, petiole, 10d.3', 'leaf 1+2, leaf tip, 10d.1', 'leaf 1+2, leaf tip, 10d.2', 'leaf 1+2, leaf tip, 10d.3', 'leaf 5+6, 17d.1', 'leaf 5+6, 17d.2', 'leaf 5+6, 17d.3', 'leaf 9+10, 27d.1', 'leaf 9+10, 27d.2', 'leaf 9+10, 27d.3', 'leaves senescing, 35d.1', 'leaves senescing, 35d.2', 'leaves senescing, 35d.3', 'cauline leaves, 24d.1', 'cauline leaves, 24d.2', 'cauline leaves, 24d.3', 'apex vegetative, 7d.1', 'apex vegetative, 7d.2', 'apex vegetative, 7d.3', 'apex vegetative, 10d.1', 'apex vegetative, 10d.2', 'apex vegetative, 10d.3', 'apex vegetative, 14d.1', 'apex vegetative, 14d.2', 'apex vegetative, 14d.3', 'apex inflorescence, 21d.1', 'apex inflorescence, 21d.2', 'apex inflorescence, 21d.3', 'apex inflorescence, 28d.1', 'apex inflorescence, 28d.2', 'apex inflorescence, 28d.3', 'apex inflor. clv1, 21d.1', 'apex inflor. clv1, 21d.2', 'apex inflor. clv1, 21d.3', 'flower stg9, 21d+.1', 'flower stg9, 21d+.2', 'flower stg9, 21d+.3', 'flower stg10/11, 21d+.1', 'flower stg10/11, 21d+.2', 'flower stg10/11, 21d+.3', 'flower stg12, 21d+.1', 'flower stg12, 21d+.2', 'flower stg12, 21d+.3', 'flower stg15, 21d+.1', 'flower stg15, 21d+.2', 'flower stg15, 21d+.3', 'flower stg12, sepals.1', 'flower stg12, sepals.2', 'flower stg12, sepals.3', 'flower stg15, sepals.1', 'flower stg15, sepals.2', 'flower stg15, sepals.3', 'flower stg12, petals.1', 'flower stg12, petals.2', 'flower stg12, petals.3', 'flower stg15, petals.1', 'flower stg15, petals.2', 'flower stg15, petals.3', 'flower stg12, stamens.1', 'flower stg12, stamens.2', 'flower stg12, stamens.3', 'flower stg15, stamens.1', 'flower stg15, stamens.2', 'flower stg15, stamens.3', 'mature pollen, 28d+.1', 'mature pollen, 28d+.2', 'mature pollen, 28d+.3', 'flower early stg12, carpels.1', 'flower early stg12, carpels.2', 'flower early stg12, carpels.3', 'flower late stg12, carpels.1', 'flower late stg12, carpels.2', 'flower late stg12, carpels.3', 'flower stg15, carpels.1', 'flower stg15, carpels.2', 'flower stg15, carpels.3', 'fruit stg16, siliques.1', 'fruit stg16, siliques.2', 'fruit stg16, siliques.3', 'fruit stg17a, siliques.1', 'fruit stg17a, siliques.2', 'fruit stg17a, siliques.3', 'fruit stg16/17a, seeds.1', 'fruit stg16/17a, seeds.2', 'fruit stg16/17a, seeds.3', 'fruit stg17b, seeds.1', 'fruit stg17b, seeds.2', 'fruit stg17b, seeds.3', 'fruit stg18, seeds.1', 'fruit stg18, seeds.2', 'fruit stg18, seeds.3'];

        var title = <?php echo $titleout; ?>;

        var ticknumber = <?php if($countout == 1) { ?> 3;
                     <?php } else { ?> 0; <?php } ?>;

        var ticklabels = ['root, root tip, 5d.1', 'root, maturation zone, 5d.1', 'root, whole root, 5d.1', 'root, whole root, 7d.1', 'root, whole root, 14d.1', 'root, whole root, 21d.1', 'hypocotyl, 10d.1', '3rd internode, 24d.1',  '2nd internode, 24d.1', '1st internode, 28d.1', 'cotyledons, 7d.1', 'leaf 1+2, 7d.1', 'leaf 1+2, 10d.1', 'leaf 1+2, petiole, 10d.1', 'leaf 1+2, leaf tip, 10d.1', 'leaf 5+6, 17d.1', 'leaf 9+10, 27d.1', 'leaves senescing, 35d.1', 'cauline leaves, 24d.1', 'apex vegetative, 7d.1', 'apex vegetative, 10d.1', 'apex vegetative, 14d.1', 'apex inflorescence, 21d.1', 'apex inflorescence, 28d.1', 'apex inflor. clv1, 21d.1', 'flower stg9, 21d+.1', 'flower stg10/11, 21d+.1', 'flower stg12, 21d+.1', 'flower stg15, 21d+.1', 'flower stg12, sepals.1', 'flower stg15, sepals.1', 'flower stg12, petals.1', 'flower stg15, petals.1', 'flower stg12, stamens.1', 'flower stg15, stamens.1', 'mature pollen, 28d+.1', 'flower early stg12, carpels.1', 'flower late stg12, carpels.1', 'flower stg15, carpels.1', 'fruit stg16, siliques.1', 'fruit stg17a, siliques.1', 'fruit stg16/17a, seeds.1', 'fruit stg17b, seeds.1', 'fruit stg18, seeds.1'];

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
            b: 175,
            t: 68,
            pad: 0
          },
          xaxis: {
            showticklabels: true,
            tickangle: 90,
            tickvals: ticklabels,
            tickfont: {
              size: 11.5,
              color: 'black'
          }},
          yaxis: {
            showticklabels: true,
            tickangle: 0,
            tickfont: {
              size: 11.5,
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
              size: 11.5,
              color: 'black'
          }},
          yaxis: {
            showticklabels: true,
            tickangle: 0,
            tickfont: {
              size: 11.5,
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
              size: 11.5,
              color: 'black'
          }},
          yaxis: {
            showticklabels: true,
            tickangle: 0,
            tickfont: {
              size: 11.5,
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
        ['root_root tip_5d', 'root_maturation zone_5d', 'root_whole root_5d', 'root_whole root_7d', 'root_whole root_14d', 'root_whole root_21d', 'hypocotyl_10d', '3rd internode_24d', '2nd internode_24d', '1st internode_28d', 'cotyledons_7d', 'leaf 1+2_7d', 'leaf 1+2_10d', 'leaf 1+2_petiole_10d', 'leaf 1+2_leaf tip_10d', 'leaf_5+6_17d', 'leaf_9+10_27d', 'leaves senescing_35d', 'cauline leaves_24d', 'apex vegetative_7d', 'apex vegetative_10d', 'apex vegetative_14d', 'apex inflorescence_21d', 'apex inflorescence_28d', 'apex inflorescence_clv1_21d', 'flower stg9_21d+', 'flower stg10/11_21d+', 'flower stg12_21d+', 'flower stg15_21d+', 'flower stg12_sepals', 'flower stg15_sepals', 'flower stg12_petals', 'flower stg15_petals', 'flower stg12_stamens', 'flower stg15_stamens', 'mature pollen_28d+', 'flower early stg12_carpels', 'flower late stg12_carpels', 'flower stg15_carpels', 'fruit stg16_siliques', 'fruit stg17a_siliques', 'fruit stg16/17a_seeds', 'fruit stg17b_seeds', 'fruit stg18_seeds'];

        var title = <?php echo $titleout; ?>;

        var ticknumber = <?php if($countout == 1) { ?> 3;
                     <?php } else { ?> 0; <?php } ?>;

        var ticklabels = ['root_root tip_5d', 'root_maturation zone_5d', 'root_whole root_5d', 'root_whole root_7d', 'root_whole root_14d', 'root_whole root_21d', 'hypocotyl_10d', '3rd internode_24d', '2nd internode_24d', '1st internode_28d', 'cotyledons_7d', 'leaf 1+2_7d', 'leaf 1+2_10d', 'leaf 1+2_petiole_10d', 'leaf 1+2_leaf tip_10d', 'leaf_5+6_17d', 'leaf_9+10_27d', 'leaves senescing_35d', 'cauline leaves_24d', 'apex vegetative_7d', 'apex vegetative_10d', 'apex vegetative_14d', 'apex inflorescence_21d', 'apex inflorescence_28d', 'apex inflorescence_clv1_21d', 'flower stg9_21d+', 'flower stg10/11_21d+', 'flower stg12_21d+', 'flower stg15_21d+', 'flower stg12_sepals', 'flower stg15_sepals', 'flower stg12_petals', 'flower stg15_petals', 'flower stg12_stamens', 'flower stg15_stamens', 'mature pollen_28d+', 'flower early stg12_carpels', 'flower late stg12_carpels', 'flower stg15_carpels', 'fruit stg16_siliques', 'fruit stg17a_siliques', 'fruit stg16/17a_seeds', 'fruit stg17b_seeds', 'fruit stg18_seeds'];

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
              size: 11.5,
              color: 'black'
          }},
          yaxis: {
            showticklabels: true,
            tickangle: 0,
            tickfont: {
              size: 11.5,
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
            b: 175,
            t: 68,
            pad: 0
          },
          xaxis: {
            showticklabels: true,
            tickangle: 90,
            tickfont: {
              size: 11.5,
              color: 'black'
          }},
          yaxis: {
            showticklabels: true,
            tickangle: 0,
            tickfont: {
              size: 11.5,
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
              size: 11.5,
              color: 'black'
            }},
          yaxis: {
            showticklabels: true,
            tickangle: 0,
            tickfont: {
              size: 11.5,
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
              size: 11.5,
              color: 'black'
          }},
          yaxis: {
            showticklabels: true,
            tickangle: 0,
            tickfont: {
              size: 11.5,
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
<?php }?>




<!-- **************************************************************************** -->
<!-- ********************************************************************************
Closing controlplot_container 2nd level div and wrap 1st level div and define footer
********************************************************************************* -->
<!-- **************************************************************************** -->


  <table></table>
  </div><!--/close controlplot_container-->
</div><!--/close wrap-->

</div><!--/closing div to make footer stay on bottom of page-->



<div class="footer"> 
  <div class="footerinner"> 
    <div class="parent"> 
      <div class="child num1"><a href="#"><font color="#333399">Home</font></a>&nbsp · &nbsp<a href="#"><font color="#333399">About DevSeq</font></a>&nbsp · &nbsp<a href="#"><font color="#333399">Contact</font></a>
      </div>
      <div class="child num3"><a href="#"><font color="#333399">Release 1 - June 2018</font></a>&nbsp · &nbsp<a href="#"><font color="#333399">Back to top<i class="fa fa-chevron-up" aria-hidden="true"></i></a>
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


  <!-- css2pdf hack: define SVG namespace for C3.js SVG element -->
  <script type="text/javascript">
    function addnsandprint(){
     $('#chart').find('svg').attr('xmlns','http://www.w3.org/2000/svg', 'xmlns:xlink', 'http://www.w3.org/1999/xlink');
     xepOnline.Formatter.Format('chart',{render:'download', srctype:'svg', filename: 'devseq_plot'});
    };
  </script>

  <!-- css2pdf hack for saving rescaled line chart: define SVG namespace for C3.js SVG element -->
  <script type="text/javascript">
    function addnsandprint_2(){
     setTimeout(function(){
     $('#chart_2').find('svg').attr('xmlns','http://www.w3.org/2000/svg', 'xmlns:xlink', 'http://www.w3.org/1999/xlink');
     xepOnline.Formatter.Format('chart_2',{render:'download', srctype:'svg', filename: 'devseq_plot'});
     }, 1500);
    };
  </script>

  <!-- css2pdf hack for saving rescaled line chart: define SVG namespace for C3.js SVG element -->
  <script type="text/javascript">
    function addnsandprint_3(){
     setTimeout(function(){
     $('#chart_3').find('svg').attr('xmlns','http://www.w3.org/2000/svg', 'xmlns:xlink', 'http://www.w3.org/1999/xlink');
     xepOnline.Formatter.Format('chart_3',{render:'download', srctype:'svg', filename: 'devseq_plot'});
     }, 1500);
    };
  </script>


  <!-- Spinner for line chart css2pdf download -->
  <script type="text/javascript">
    $(document).ready(function () {
     $("#show2").click(function() {
       // Create a DIV, append to BODY and add a spinner
       var el = $('<div>').appendTo('body').spin()
    
       // After 1 second stop spinning and remove the DIV
       setTimeout(function() { 
          el.spin(false).remove()
       }, 4500)
      })
    })
  </script>

  <!-- Spinner for resized line chart css2pdf download -->
  <script type="text/javascript">
    $(document).ready(function () {
     $("#show3").click(function() {
       // Create a DIV, append to BODY and add a spinner
       var el = $('<div>').appendTo('body').spin()
    
       // After 1 second stop spinning and remove the DIV
       setTimeout(function() { 
           el.spin(false).remove()
       }, 8000)
      })
    })
  </script>

  <!-- Spinner for resized line chart css2pdf download -->
  <script type="text/javascript">
    $(document).ready(function () {
     $("#show4").click(function() {
       // Create a DIV, append to BODY and add a spinner
       var el = $('<div>').appendTo('body').spin()
    
       // After 1 second stop spinning and remove the DIV
       setTimeout(function() { 
           el.spin(false).remove()
       }, 8000)
      })
    })
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