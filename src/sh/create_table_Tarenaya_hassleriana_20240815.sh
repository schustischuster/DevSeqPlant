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

# Create AT tables in devseq database
CREATE TABLE devseq.Tarenaya_hassleriana_gene_tpm_20240815 (
  gene_id VARCHAR(255),
  root_whole_root_5d_1 DECIMAL(10,2), 
  root_whole_root_5d_2 DECIMAL(10,2), 
  root_whole_root_5d_3 DECIMAL(10,2),  
  hypocotyl_11d_1 DECIMAL(10,2), 
  hypocotyl_11d_2 DECIMAL(10,2), 
  hypocotyl_11d_3 DECIMAL(10,2), 
  leaf_1_2_11d_1 DECIMAL(10,2), 
  leaf_1_2_11d_2 DECIMAL(10,2), 
  leaf_1_2_11d_3 DECIMAL(10,2), 
  apex_vegetative_11d_1 DECIMAL(10,2), 
  apex_vegetative_11d_2 DECIMAL(10,2), 
  apex_vegetative_11d_3 DECIMAL(10,2), 
  apex_inflorescence_11w_1 DECIMAL(10,2), 
  apex_inflorescence_11w_2 DECIMAL(10,2), 
  apex_inflorescence_11w_3 DECIMAL(10,2), 
  flower_stg12_11w_1 DECIMAL(10,2), 
  flower_stg12_11w_2 DECIMAL(10,2), 
  flower_stg12_11w_3 DECIMAL(10,2), 
  flower_stamen_11w_1 DECIMAL(10,2), 
  flower_stamen_11w_2 DECIMAL(10,2), 
  flower_stamen_11w_3 DECIMAL(10,2), 
  flower_mature_pollen_11w_1 DECIMAL(10,2), 
  flower_mature_pollen_11w_2 DECIMAL(10,2), 
  flower_mature_pollen_11w_3 DECIMAL(10,2), 
  flower_carpel_11w_1 DECIMAL(10,2), 
  flower_carpel_11w_2 DECIMAL(10,2), 
  flower_carpel_11w_3 DECIMAL(10,2), 
  FULLTEXT (gene_id),
  PRIMARY KEY(gene_id)
);


CREATE TABLE devseq.Tarenaya_hassleriana_gene_tpm_RE_20240815 (
  gene_id VARCHAR(255),
  root_whole_root_5d_1 DECIMAL(10,2), 
  root_whole_root_5d_2 DECIMAL(10,2), 
  root_whole_root_5d_3 DECIMAL(10,2),  
  hypocotyl_11d_1 DECIMAL(10,2), 
  hypocotyl_11d_2 DECIMAL(10,2), 
  hypocotyl_11d_3 DECIMAL(10,2), 
  leaf_1_2_11d_1 DECIMAL(10,2), 
  leaf_1_2_11d_2 DECIMAL(10,2), 
  leaf_1_2_11d_3 DECIMAL(10,2), 
  apex_vegetative_11d_1 DECIMAL(10,2), 
  apex_vegetative_11d_2 DECIMAL(10,2), 
  apex_vegetative_11d_3 DECIMAL(10,2), 
  apex_inflorescence_11w_1 DECIMAL(10,2), 
  apex_inflorescence_11w_2 DECIMAL(10,2), 
  apex_inflorescence_11w_3 DECIMAL(10,2), 
  flower_stg12_11w_1 DECIMAL(10,2), 
  flower_stg12_11w_2 DECIMAL(10,2), 
  flower_stg12_11w_3 DECIMAL(10,2), 
  flower_stamen_11w_1 DECIMAL(10,2), 
  flower_stamen_11w_2 DECIMAL(10,2), 
  flower_stamen_11w_3 DECIMAL(10,2), 
  flower_mature_pollen_11w_1 DECIMAL(10,2), 
  flower_mature_pollen_11w_2 DECIMAL(10,2), 
  flower_mature_pollen_11w_3 DECIMAL(10,2), 
  flower_carpel_11w_1 DECIMAL(10,2), 
  flower_carpel_11w_2 DECIMAL(10,2), 
  flower_carpel_11w_3 DECIMAL(10,2), 
  FULLTEXT (gene_id),
  PRIMARY KEY(gene_id)
);


CREATE TABLE devseq.Tarenaya_hassleriana_transcript_tpm_20240815 (
  transcript_id VARCHAR(255),
  gene_id VARCHAR(255),
  root_whole_root_5d_1 DECIMAL(10,2), 
  root_whole_root_5d_2 DECIMAL(10,2), 
  root_whole_root_5d_3 DECIMAL(10,2),  
  hypocotyl_11d_1 DECIMAL(10,2), 
  hypocotyl_11d_2 DECIMAL(10,2), 
  hypocotyl_11d_3 DECIMAL(10,2), 
  leaf_1_2_11d_1 DECIMAL(10,2), 
  leaf_1_2_11d_2 DECIMAL(10,2), 
  leaf_1_2_11d_3 DECIMAL(10,2), 
  apex_vegetative_11d_1 DECIMAL(10,2), 
  apex_vegetative_11d_2 DECIMAL(10,2), 
  apex_vegetative_11d_3 DECIMAL(10,2), 
  apex_inflorescence_11w_1 DECIMAL(10,2), 
  apex_inflorescence_11w_2 DECIMAL(10,2), 
  apex_inflorescence_11w_3 DECIMAL(10,2), 
  flower_stg12_11w_1 DECIMAL(10,2), 
  flower_stg12_11w_2 DECIMAL(10,2), 
  flower_stg12_11w_3 DECIMAL(10,2), 
  flower_stamen_11w_1 DECIMAL(10,2), 
  flower_stamen_11w_2 DECIMAL(10,2), 
  flower_stamen_11w_3 DECIMAL(10,2), 
  flower_mature_pollen_11w_1 DECIMAL(10,2), 
  flower_mature_pollen_11w_2 DECIMAL(10,2), 
  flower_mature_pollen_11w_3 DECIMAL(10,2), 
  flower_carpel_11w_1 DECIMAL(10,2), 
  flower_carpel_11w_2 DECIMAL(10,2), 
  flower_carpel_11w_3 DECIMAL(10,2), 
  FULLTEXT (transcript_id, gene_id),
  PRIMARY KEY(transcript_id)
);


CREATE TABLE devseq.Tarenaya_hassleriana_transcript_tpm_RE_20240815 (
  transcript_id VARCHAR(255),
  gene_id VARCHAR(255),
  root_whole_root_5d_1 DECIMAL(10,2), 
  root_whole_root_5d_2 DECIMAL(10,2), 
  root_whole_root_5d_3 DECIMAL(10,2),  
  hypocotyl_11d_1 DECIMAL(10,2), 
  hypocotyl_11d_2 DECIMAL(10,2), 
  hypocotyl_11d_3 DECIMAL(10,2), 
  leaf_1_2_11d_1 DECIMAL(10,2), 
  leaf_1_2_11d_2 DECIMAL(10,2), 
  leaf_1_2_11d_3 DECIMAL(10,2), 
  apex_vegetative_11d_1 DECIMAL(10,2), 
  apex_vegetative_11d_2 DECIMAL(10,2), 
  apex_vegetative_11d_3 DECIMAL(10,2), 
  apex_inflorescence_11w_1 DECIMAL(10,2), 
  apex_inflorescence_11w_2 DECIMAL(10,2), 
  apex_inflorescence_11w_3 DECIMAL(10,2), 
  flower_stg12_11w_1 DECIMAL(10,2), 
  flower_stg12_11w_2 DECIMAL(10,2), 
  flower_stg12_11w_3 DECIMAL(10,2), 
  flower_stamen_11w_1 DECIMAL(10,2), 
  flower_stamen_11w_2 DECIMAL(10,2), 
  flower_stamen_11w_3 DECIMAL(10,2), 
  flower_mature_pollen_11w_1 DECIMAL(10,2), 
  flower_mature_pollen_11w_2 DECIMAL(10,2), 
  flower_mature_pollen_11w_3 DECIMAL(10,2), 
  flower_carpel_11w_1 DECIMAL(10,2), 
  flower_carpel_11w_2 DECIMAL(10,2), 
  flower_carpel_11w_3 DECIMAL(10,2), 
  FULLTEXT (transcript_id, gene_id),
  PRIMARY KEY(transcript_id)
);


# Show all tables in selected database
show TABLES;

exit;
