######### Create empty mySQL data table ###########

# 1._Connect to mySQL and select database

# Change directory
cd /usr/local/mysql/bin
ls

# Connect to MySQL server by typing:
./mysql -u root -p;

# Enter the following passwort:
Tr21zMP26r

# Show database
show databases;

# Use database "mytest"
use devseq_test;

# Show all tables in selected database
show TABLES;


# 2._Create new database tables

CREATE TABLE Arabidopsis_thaliana_gene_tpm_repl_20190801 (
   `gene_id` VARCHAR(255) Primary Key,
   `symbol` VARCHAR(255),
   `root_root_tip_5d` DECIMAL(10,2),
   `root_maturation_zone_5d` DECIMAL(10,2),
   `root_whole_root_5d` DECIMAL(10,2),
   `root_whole_root_7d` DECIMAL(10,2),
   `root_whole_root_14d` DECIMAL(10,2),
   `root_whole_root_21d` DECIMAL(10,2),
   `hypocotyl_10d` DECIMAL(10,2),
   `third_internode_24d` DECIMAL(10,2),
   `second_internode_24d` DECIMAL(10,2),
   `first_internode_28d` DECIMAL(10,2),
   `cotyledons_7d` DECIMAL(10,2),
   `leaf_1_2_7d` DECIMAL(10,2),
   `leaf_1_2_10d` DECIMAL(10,2),
   `leaf_1_2_petiole_10d` DECIMAL(10,2),
   `leaf_1_2_leaf_tip_10d` DECIMAL(10,2),
   `leaf_5_6_17d` DECIMAL(10,2),
   `leaf_9_10_27d` DECIMAL(10,2),
   `leaves_senescing_35d` DECIMAL(10,2),
   `cauline_leaves_24d` DECIMAL(10,2), 
   `apex_vegetative_7d` DECIMAL(10,2),
   `apex_vegetative_10d` DECIMAL(10,2),
   `apex_vegetative_14d` DECIMAL(10,2),
   `apex_inflorescence_21d` DECIMAL(10,2),
   `apex_inflorescence_28d` DECIMAL(10,2),
   `apex_inflorescence_clv1_21d` DECIMAL(10,2),
   `flower_stg9_21d` DECIMAL(10,2),
   `flower_stg10_11_21d` DECIMAL(10,2),
   `flower_stg12_21d` DECIMAL(10,2),
   `flower_stg15_21d` DECIMAL(10,2),
   `flower_stg12_sepals_21d` DECIMAL(10,2),
   `flower_stg15_sepals_21d` DECIMAL(10,2),
   `flower_stg12_petals_21d` DECIMAL(10,2),
   `flower_stg15_petals_21d` DECIMAL(10,2),
   `flower_stg12_stamens_21d` DECIMAL(10,2),
   `flower_stg15_stamens_21d` DECIMAL(10,2),
   `flowers_mature_pollen_28d` DECIMAL(10,2),
   `flower_early_stg12_carpels_21d` DECIMAL(10,2),
   `flower_late_stg12_carpels_21d` DECIMAL(10,2),
   `flower_stg15_carpels_21d` DECIMAL(10,2),
   `fruit_stg16_siliques_28d` DECIMAL(10,2),
   `fruit_stg17a_siliques_28d` DECIMAL(10,2),
   `fruit_stg16_seeds_28d` DECIMAL(10,2),
   `fruit_stg17a_seeds_28d` DECIMAL(10,2),
   `fruit_stg18_seeds_28d` DECIMAL(10,2),
   FULLTEXT (gene_id, symbol) 
   ) ENGINE=MyISAM;


CREATE TABLE Arabidopsis_thaliana_gene_tpm_repl_RE_20190801 (
   `gene_id` VARCHAR(255) Primary Key,
   `symbol` VARCHAR(255),
   `root_root_tip_5d` DECIMAL(10,2),
   `root_maturation_zone_5d` DECIMAL(10,2),
   `root_whole_root_5d` DECIMAL(10,2),
   `root_whole_root_7d` DECIMAL(10,2),
   `root_whole_root_14d` DECIMAL(10,2),
   `root_whole_root_21d` DECIMAL(10,2),
   `hypocotyl_10d` DECIMAL(10,2),
   `third_internode_24d` DECIMAL(10,2),
   `second_internode_24d` DECIMAL(10,2),
   `first_internode_28d` DECIMAL(10,2),
   `cotyledons_7d` DECIMAL(10,2),
   `leaf_1_2_7d` DECIMAL(10,2),
   `leaf_1_2_10d` DECIMAL(10,2),
   `leaf_1_2_petiole_10d` DECIMAL(10,2),
   `leaf_1_2_leaf_tip_10d` DECIMAL(10,2),
   `leaf_5_6_17d` DECIMAL(10,2),
   `leaf_9_10_27d` DECIMAL(10,2),
   `leaves_senescing_35d` DECIMAL(10,2),
   `cauline_leaves_24d` DECIMAL(10,2), 
   `apex_vegetative_7d` DECIMAL(10,2),
   `apex_vegetative_10d` DECIMAL(10,2),
   `apex_vegetative_14d` DECIMAL(10,2),
   `apex_inflorescence_21d` DECIMAL(10,2),
   `apex_inflorescence_28d` DECIMAL(10,2),
   `apex_inflorescence_clv1_21d` DECIMAL(10,2),
   `flower_stg9_21d` DECIMAL(10,2),
   `flower_stg10_11_21d` DECIMAL(10,2),
   `flower_stg12_21d` DECIMAL(10,2),
   `flower_stg15_21d` DECIMAL(10,2),
   `flower_stg12_sepals_21d` DECIMAL(10,2),
   `flower_stg15_sepals_21d` DECIMAL(10,2),
   `flower_stg12_petals_21d` DECIMAL(10,2),
   `flower_stg15_petals_21d` DECIMAL(10,2),
   `flower_stg12_stamens_21d` DECIMAL(10,2),
   `flower_stg15_stamens_21d` DECIMAL(10,2),
   `flowers_mature_pollen_28d` DECIMAL(10,2),
   `flower_early_stg12_carpels_21d` DECIMAL(10,2),
   `flower_late_stg12_carpels_21d` DECIMAL(10,2),
   `flower_stg15_carpels_21d` DECIMAL(10,2),
   `fruit_stg16_siliques_28d` DECIMAL(10,2),
   `fruit_stg17a_siliques_28d` DECIMAL(10,2),
   `fruit_stg16_seeds_28d` DECIMAL(10,2),
   `fruit_stg17a_seeds_28d` DECIMAL(10,2),
   `fruit_stg18_seeds_28d` DECIMAL(10,2),
   FULLTEXT (gene_id, symbol) 
   ) ENGINE=MyISAM;


CREATE TABLE Arabidopsis_thaliana_isoform_tpm_repl_20190801 (
   `isoform_id` VARCHAR(255) Primary Key,
   `gene_id` VARCHAR(255),
   `symbol` VARCHAR(255),
   `root_root_tip_5d` DECIMAL(10,2),
   `root_maturation_zone_5d` DECIMAL(10,2),
   `root_whole_root_5d` DECIMAL(10,2),
   `root_whole_root_7d` DECIMAL(10,2),
   `root_whole_root_14d` DECIMAL(10,2),
   `root_whole_root_21d` DECIMAL(10,2),
   `hypocotyl_10d` DECIMAL(10,2),
   `third_internode_24d` DECIMAL(10,2),
   `second_internode_24d` DECIMAL(10,2),
   `first_internode_28d` DECIMAL(10,2),
   `cotyledons_7d` DECIMAL(10,2),
   `leaf_1_2_7d` DECIMAL(10,2),
   `leaf_1_2_10d` DECIMAL(10,2),
   `leaf_1_2_petiole_10d` DECIMAL(10,2),
   `leaf_1_2_leaf_tip_10d` DECIMAL(10,2),
   `leaf_5_6_17d` DECIMAL(10,2),
   `leaf_9_10_27d` DECIMAL(10,2),
   `leaves_senescing_35d` DECIMAL(10,2),
   `cauline_leaves_24d` DECIMAL(10,2), 
   `apex_vegetative_7d` DECIMAL(10,2),
   `apex_vegetative_10d` DECIMAL(10,2),
   `apex_vegetative_14d` DECIMAL(10,2),
   `apex_inflorescence_21d` DECIMAL(10,2),
   `apex_inflorescence_28d` DECIMAL(10,2),
   `apex_inflorescence_clv1_21d` DECIMAL(10,2),
   `flower_stg9_21d` DECIMAL(10,2),
   `flower_stg10_11_21d` DECIMAL(10,2),
   `flower_stg12_21d` DECIMAL(10,2),
   `flower_stg15_21d` DECIMAL(10,2),
   `flower_stg12_sepals_21d` DECIMAL(10,2),
   `flower_stg15_sepals_21d` DECIMAL(10,2),
   `flower_stg12_petals_21d` DECIMAL(10,2),
   `flower_stg15_petals_21d` DECIMAL(10,2),
   `flower_stg12_stamens_21d` DECIMAL(10,2),
   `flower_stg15_stamens_21d` DECIMAL(10,2),
   `flowers_mature_pollen_28d` DECIMAL(10,2),
   `flower_early_stg12_carpels_21d` DECIMAL(10,2),
   `flower_late_stg12_carpels_21d` DECIMAL(10,2),
   `flower_stg15_carpels_21d` DECIMAL(10,2),
   `fruit_stg16_siliques_28d` DECIMAL(10,2),
   `fruit_stg17a_siliques_28d` DECIMAL(10,2),
   `fruit_stg16_seeds_28d` DECIMAL(10,2),
   `fruit_stg17a_seeds_28d` DECIMAL(10,2),
   `fruit_stg18_seeds_28d` DECIMAL(10,2),
   FULLTEXT (gene_id, isoform_id, symbol) 
   ) ENGINE=MyISAM;


CREATE TABLE Arabidopsis_thaliana_isoform_tpm_repl_RE_20190801 (
   `isoform_id` VARCHAR(255) Primary Key,
   `gene_id` VARCHAR(255),
   `symbol` VARCHAR(255),
   `root_root_tip_5d` DECIMAL(10,2),
   `root_maturation_zone_5d` DECIMAL(10,2),
   `root_whole_root_5d` DECIMAL(10,2),
   `root_whole_root_7d` DECIMAL(10,2),
   `root_whole_root_14d` DECIMAL(10,2),
   `root_whole_root_21d` DECIMAL(10,2),
   `hypocotyl_10d` DECIMAL(10,2),
   `third_internode_24d` DECIMAL(10,2),
   `second_internode_24d` DECIMAL(10,2),
   `first_internode_28d` DECIMAL(10,2),
   `cotyledons_7d` DECIMAL(10,2),
   `leaf_1_2_7d` DECIMAL(10,2),
   `leaf_1_2_10d` DECIMAL(10,2),
   `leaf_1_2_petiole_10d` DECIMAL(10,2),
   `leaf_1_2_leaf_tip_10d` DECIMAL(10,2),
   `leaf_5_6_17d` DECIMAL(10,2),
   `leaf_9_10_27d` DECIMAL(10,2),
   `leaves_senescing_35d` DECIMAL(10,2),
   `cauline_leaves_24d` DECIMAL(10,2), 
   `apex_vegetative_7d` DECIMAL(10,2),
   `apex_vegetative_10d` DECIMAL(10,2),
   `apex_vegetative_14d` DECIMAL(10,2),
   `apex_inflorescence_21d` DECIMAL(10,2),
   `apex_inflorescence_28d` DECIMAL(10,2),
   `apex_inflorescence_clv1_21d` DECIMAL(10,2),
   `flower_stg9_21d` DECIMAL(10,2),
   `flower_stg10_11_21d` DECIMAL(10,2),
   `flower_stg12_21d` DECIMAL(10,2),
   `flower_stg15_21d` DECIMAL(10,2),
   `flower_stg12_sepals_21d` DECIMAL(10,2),
   `flower_stg15_sepals_21d` DECIMAL(10,2),
   `flower_stg12_petals_21d` DECIMAL(10,2),
   `flower_stg15_petals_21d` DECIMAL(10,2),
   `flower_stg12_stamens_21d` DECIMAL(10,2),
   `flower_stg15_stamens_21d` DECIMAL(10,2),
   `flowers_mature_pollen_28d` DECIMAL(10,2),
   `flower_early_stg12_carpels_21d` DECIMAL(10,2),
   `flower_late_stg12_carpels_21d` DECIMAL(10,2),
   `flower_stg15_carpels_21d` DECIMAL(10,2),
   `fruit_stg16_siliques_28d` DECIMAL(10,2),
   `fruit_stg17a_siliques_28d` DECIMAL(10,2),
   `fruit_stg16_seeds_28d` DECIMAL(10,2),
   `fruit_stg17a_seeds_28d` DECIMAL(10,2),
   `fruit_stg18_seeds_28d` DECIMAL(10,2),
   FULLTEXT (gene_id, isoform_id, symbol) 
   ) ENGINE=MyISAM;


# Show all tables in selected database
show TABLES;

exit;
