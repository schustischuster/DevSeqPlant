######### Create empty mySQL data table ###########

# 1._Connect to mySQL and select database

# Start MySQL database
sudo mysql

# Show database
show databases;

# Use database "devseq"
use devseq;

# Show all tables in selected database
show TABLES;


# 2._Create new database tables

# Create AL tables in devseq database
CREATE TABLE devseq.Arabidopsis_lyrata_gene_tpm_20240827 (
  gene_id VARCHAR(255),
  root_whole_root_6d_1 DECIMAL(10,2), 
  root_whole_root_6d_2 DECIMAL(10,2), 
  root_whole_root_6d_3 DECIMAL(10,2),  
  hypocotyl_12d_1 DECIMAL(10,2), 
  hypocotyl_12d_2 DECIMAL(10,2), 
  hypocotyl_12d_3 DECIMAL(10,2), 
  leaf_1_2_10d_1 DECIMAL(10,2), 
  leaf_1_2_10d_2 DECIMAL(10,2), 
  leaf_1_2_10d_3 DECIMAL(10,2), 
  apex_vegetative_11d_1 DECIMAL(10,2), 
  apex_vegetative_11d_2 DECIMAL(10,2), 
  apex_vegetative_11d_3 DECIMAL(10,2), 
  apex_inflorescence_20w_1 DECIMAL(10,2), 
  apex_inflorescence_20w_2 DECIMAL(10,2), 
  apex_inflorescence_20w_3 DECIMAL(10,2), 
  flower_stg12_20w_1 DECIMAL(10,2), 
  flower_stg12_20w_2 DECIMAL(10,2), 
  flower_stg12_20w_3 DECIMAL(10,2), 
  flower_stamen_stg11_21w_1 DECIMAL(10,2), 
  flower_stamen_stg11_21w_2 DECIMAL(10,2), 
  flower_stamen_stg11_21w_3 DECIMAL(10,2), 
  flower_stamen_early_stg12_21w_1 DECIMAL(10,2), 
  flower_stamen_early_stg12_21w_2 DECIMAL(10,2), 
  flower_stamen_early_stg12_21w_3 DECIMAL(10,2), 
  flower_stamen_mid_stg12_21w_1 DECIMAL(10,2), 
  flower_stamen_mid_stg12_21w_2 DECIMAL(10,2), 
  flower_stamen_mid_stg12_21w_3 DECIMAL(10,2), 
  flower_stamen_late_stg12_21w_1 DECIMAL(10,2), 
  flower_stamen_late_stg12_21w_2 DECIMAL(10,2), 
  flower_stamen_late_stg12_21w_3 DECIMAL(10,2),
  flower_mature_pollen_21w_1 DECIMAL(10,2), 
  flower_mature_pollen_21w_2 DECIMAL(10,2), 
  flower_mature_pollen_21w_3 DECIMAL(10,2), 
  flower_carpel_20w_1 DECIMAL(10,2), 
  flower_carpel_20w_2 DECIMAL(10,2), 
  flower_carpel_20w_3 DECIMAL(10,2), 
  FULLTEXT (gene_id),
  PRIMARY KEY(gene_id)
);


CREATE TABLE devseq.Arabidopsis_lyrata_gene_tpm_RE_20240827 (
  gene_id VARCHAR(255),
  root_whole_root_6d_1 DECIMAL(10,2), 
  root_whole_root_6d_2 DECIMAL(10,2), 
  root_whole_root_6d_3 DECIMAL(10,2),  
  hypocotyl_12d_1 DECIMAL(10,2), 
  hypocotyl_12d_2 DECIMAL(10,2), 
  hypocotyl_12d_3 DECIMAL(10,2), 
  leaf_1_2_10d_1 DECIMAL(10,2), 
  leaf_1_2_10d_2 DECIMAL(10,2), 
  leaf_1_2_10d_3 DECIMAL(10,2), 
  apex_vegetative_11d_1 DECIMAL(10,2), 
  apex_vegetative_11d_2 DECIMAL(10,2), 
  apex_vegetative_11d_3 DECIMAL(10,2), 
  apex_inflorescence_20w_1 DECIMAL(10,2), 
  apex_inflorescence_20w_2 DECIMAL(10,2), 
  apex_inflorescence_20w_3 DECIMAL(10,2), 
  flower_stg12_20w_1 DECIMAL(10,2), 
  flower_stg12_20w_2 DECIMAL(10,2), 
  flower_stg12_20w_3 DECIMAL(10,2), 
  flower_stamen_stg11_21w_1 DECIMAL(10,2), 
  flower_stamen_stg11_21w_2 DECIMAL(10,2), 
  flower_stamen_stg11_21w_3 DECIMAL(10,2), 
  flower_stamen_early_stg12_21w_1 DECIMAL(10,2), 
  flower_stamen_early_stg12_21w_2 DECIMAL(10,2), 
  flower_stamen_early_stg12_21w_3 DECIMAL(10,2), 
  flower_stamen_mid_stg12_21w_1 DECIMAL(10,2), 
  flower_stamen_mid_stg12_21w_2 DECIMAL(10,2), 
  flower_stamen_mid_stg12_21w_3 DECIMAL(10,2), 
  flower_stamen_late_stg12_21w_1 DECIMAL(10,2), 
  flower_stamen_late_stg12_21w_2 DECIMAL(10,2), 
  flower_stamen_late_stg12_21w_3 DECIMAL(10,2),
  flower_mature_pollen_21w_1 DECIMAL(10,2), 
  flower_mature_pollen_21w_2 DECIMAL(10,2), 
  flower_mature_pollen_21w_3 DECIMAL(10,2), 
  flower_carpel_20w_1 DECIMAL(10,2), 
  flower_carpel_20w_2 DECIMAL(10,2), 
  flower_carpel_20w_3 DECIMAL(10,2), 
  FULLTEXT (gene_id),
  PRIMARY KEY(gene_id)
);


CREATE TABLE devseq.Arabidopsis_lyrata_transcript_tpm_20240827 (
  transcript_id VARCHAR(255),
  gene_id VARCHAR(255),
  root_whole_root_6d_1 DECIMAL(10,2), 
  root_whole_root_6d_2 DECIMAL(10,2), 
  root_whole_root_6d_3 DECIMAL(10,2),  
  hypocotyl_12d_1 DECIMAL(10,2), 
  hypocotyl_12d_2 DECIMAL(10,2), 
  hypocotyl_12d_3 DECIMAL(10,2), 
  leaf_1_2_10d_1 DECIMAL(10,2), 
  leaf_1_2_10d_2 DECIMAL(10,2), 
  leaf_1_2_10d_3 DECIMAL(10,2), 
  apex_vegetative_11d_1 DECIMAL(10,2), 
  apex_vegetative_11d_2 DECIMAL(10,2), 
  apex_vegetative_11d_3 DECIMAL(10,2), 
  apex_inflorescence_20w_1 DECIMAL(10,2), 
  apex_inflorescence_20w_2 DECIMAL(10,2), 
  apex_inflorescence_20w_3 DECIMAL(10,2), 
  flower_stg12_20w_1 DECIMAL(10,2), 
  flower_stg12_20w_2 DECIMAL(10,2), 
  flower_stg12_20w_3 DECIMAL(10,2), 
  flower_stamen_stg11_21w_1 DECIMAL(10,2), 
  flower_stamen_stg11_21w_2 DECIMAL(10,2), 
  flower_stamen_stg11_21w_3 DECIMAL(10,2), 
  flower_stamen_early_stg12_21w_1 DECIMAL(10,2), 
  flower_stamen_early_stg12_21w_2 DECIMAL(10,2), 
  flower_stamen_early_stg12_21w_3 DECIMAL(10,2), 
  flower_stamen_mid_stg12_21w_1 DECIMAL(10,2), 
  flower_stamen_mid_stg12_21w_2 DECIMAL(10,2), 
  flower_stamen_mid_stg12_21w_3 DECIMAL(10,2), 
  flower_stamen_late_stg12_21w_1 DECIMAL(10,2), 
  flower_stamen_late_stg12_21w_2 DECIMAL(10,2), 
  flower_stamen_late_stg12_21w_3 DECIMAL(10,2), 
  flower_mature_pollen_21w_1 DECIMAL(10,2), 
  flower_mature_pollen_21w_2 DECIMAL(10,2), 
  flower_mature_pollen_21w_3 DECIMAL(10,2), 
  flower_carpel_20w_1 DECIMAL(10,2), 
  flower_carpel_20w_2 DECIMAL(10,2), 
  flower_carpel_20w_3 DECIMAL(10,2), 
  FULLTEXT (transcript_id, gene_id),
  PRIMARY KEY(transcript_id)
);


CREATE TABLE devseq.Arabidopsis_lyrata_transcript_tpm_RE_20240827 (
  transcript_id VARCHAR(255),
  gene_id VARCHAR(255),
  root_whole_root_6d_1 DECIMAL(10,2), 
  root_whole_root_6d_2 DECIMAL(10,2), 
  root_whole_root_6d_3 DECIMAL(10,2),  
  hypocotyl_12d_1 DECIMAL(10,2), 
  hypocotyl_12d_2 DECIMAL(10,2), 
  hypocotyl_12d_3 DECIMAL(10,2), 
  leaf_1_2_10d_1 DECIMAL(10,2), 
  leaf_1_2_10d_2 DECIMAL(10,2), 
  leaf_1_2_10d_3 DECIMAL(10,2), 
  apex_vegetative_11d_1 DECIMAL(10,2), 
  apex_vegetative_11d_2 DECIMAL(10,2), 
  apex_vegetative_11d_3 DECIMAL(10,2), 
  apex_inflorescence_20w_1 DECIMAL(10,2), 
  apex_inflorescence_20w_2 DECIMAL(10,2), 
  apex_inflorescence_20w_3 DECIMAL(10,2), 
  flower_stg12_20w_1 DECIMAL(10,2), 
  flower_stg12_20w_2 DECIMAL(10,2), 
  flower_stg12_20w_3 DECIMAL(10,2), 
  flower_stamen_stg11_21w_1 DECIMAL(10,2), 
  flower_stamen_stg11_21w_2 DECIMAL(10,2), 
  flower_stamen_stg11_21w_3 DECIMAL(10,2), 
  flower_stamen_early_stg12_21w_1 DECIMAL(10,2), 
  flower_stamen_early_stg12_21w_2 DECIMAL(10,2), 
  flower_stamen_early_stg12_21w_3 DECIMAL(10,2), 
  flower_stamen_mid_stg12_21w_1 DECIMAL(10,2), 
  flower_stamen_mid_stg12_21w_2 DECIMAL(10,2), 
  flower_stamen_mid_stg12_21w_3 DECIMAL(10,2), 
  flower_stamen_late_stg12_21w_1 DECIMAL(10,2), 
  flower_stamen_late_stg12_21w_2 DECIMAL(10,2), 
  flower_stamen_late_stg12_21w_3 DECIMAL(10,2), 
  flower_mature_pollen_21w_1 DECIMAL(10,2), 
  flower_mature_pollen_21w_2 DECIMAL(10,2), 
  flower_mature_pollen_21w_3 DECIMAL(10,2), 
  flower_carpel_20w_1 DECIMAL(10,2), 
  flower_carpel_20w_2 DECIMAL(10,2), 
  flower_carpel_20w_3 DECIMAL(10,2),  
  FULLTEXT (transcript_id, gene_id),
  PRIMARY KEY(transcript_id)
);


# Show all tables in selected database
show TABLES;

exit;
