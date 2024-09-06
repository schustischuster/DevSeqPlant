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
CREATE TABLE devseq.Capsella_rubella_gene_tpm_20240902 (
  gene_id VARCHAR(255),
  root_whole_root_4d_1 DECIMAL(10,2), 
  root_whole_root_4d_2 DECIMAL(10,2), 
  root_whole_root_4d_3 DECIMAL(10,2),  
  hypocotyl_9d_1 DECIMAL(10,2), 
  hypocotyl_9d_2 DECIMAL(10,2), 
  hypocotyl_9d_3 DECIMAL(10,2), 
  leaf_1_2_7d_1 DECIMAL(10,2), 
  leaf_1_2_7d_2 DECIMAL(10,2), 
  leaf_1_2_7d_3 DECIMAL(10,2), 
  apex_vegetative_7d_1 DECIMAL(10,2), 
  apex_vegetative_7d_2 DECIMAL(10,2), 
  apex_vegetative_7d_3 DECIMAL(10,2), 
  apex_inflorescence_15w_1 DECIMAL(10,2), 
  apex_inflorescence_15w_2 DECIMAL(10,2), 
  apex_inflorescence_15w_3 DECIMAL(10,2), 
  flower_stg12_16w_1 DECIMAL(10,2), 
  flower_stg12_16w_2 DECIMAL(10,2), 
  flower_stg12_16w_3 DECIMAL(10,2), 
  flower_stamen_stg12_16w_1 DECIMAL(10,2), 
  flower_stamen_stg12_16w_2 DECIMAL(10,2), 
  flower_stamen_stg12_16w_3 DECIMAL(10,2), 
  flower_mature_pollen_16w_1 DECIMAL(10,2), 
  flower_mature_pollen_16w_2 DECIMAL(10,2), 
  flower_mature_pollen_16w_3 DECIMAL(10,2), 
  flower_carpel_16w_1 DECIMAL(10,2), 
  flower_carpel_16w_2 DECIMAL(10,2), 
  flower_carpel_16w_3 DECIMAL(10,2), 
  FULLTEXT (gene_id),
  PRIMARY KEY(gene_id)
);


CREATE TABLE devseq.Capsella_rubella_gene_tpm_RE_20240902 (
  gene_id VARCHAR(255),
  root_whole_root_4d_1 DECIMAL(10,2), 
  root_whole_root_4d_2 DECIMAL(10,2), 
  root_whole_root_4d_3 DECIMAL(10,2),  
  hypocotyl_9d_1 DECIMAL(10,2), 
  hypocotyl_9d_2 DECIMAL(10,2), 
  hypocotyl_9d_3 DECIMAL(10,2), 
  leaf_1_2_7d_1 DECIMAL(10,2), 
  leaf_1_2_7d_2 DECIMAL(10,2), 
  leaf_1_2_7d_3 DECIMAL(10,2), 
  apex_vegetative_7d_1 DECIMAL(10,2), 
  apex_vegetative_7d_2 DECIMAL(10,2), 
  apex_vegetative_7d_3 DECIMAL(10,2), 
  apex_inflorescence_15w_1 DECIMAL(10,2), 
  apex_inflorescence_15w_2 DECIMAL(10,2), 
  apex_inflorescence_15w_3 DECIMAL(10,2), 
  flower_stg12_16w_1 DECIMAL(10,2), 
  flower_stg12_16w_2 DECIMAL(10,2), 
  flower_stg12_16w_3 DECIMAL(10,2), 
  flower_stamen_stg12_16w_1 DECIMAL(10,2), 
  flower_stamen_stg12_16w_2 DECIMAL(10,2), 
  flower_stamen_stg12_16w_3 DECIMAL(10,2), 
  flower_mature_pollen_16w_1 DECIMAL(10,2), 
  flower_mature_pollen_16w_2 DECIMAL(10,2), 
  flower_mature_pollen_16w_3 DECIMAL(10,2), 
  flower_carpel_16w_1 DECIMAL(10,2), 
  flower_carpel_16w_2 DECIMAL(10,2), 
  flower_carpel_16w_3 DECIMAL(10,2),  
  FULLTEXT (gene_id),
  PRIMARY KEY(gene_id)
);


CREATE TABLE devseq.Capsella_rubella_transcript_tpm_20240902 (
  transcript_id VARCHAR(255),
  gene_id VARCHAR(255),
  root_whole_root_4d_1 DECIMAL(10,2), 
  root_whole_root_4d_2 DECIMAL(10,2), 
  root_whole_root_4d_3 DECIMAL(10,2),  
  hypocotyl_9d_1 DECIMAL(10,2), 
  hypocotyl_9d_2 DECIMAL(10,2), 
  hypocotyl_9d_3 DECIMAL(10,2), 
  leaf_1_2_7d_1 DECIMAL(10,2), 
  leaf_1_2_7d_2 DECIMAL(10,2), 
  leaf_1_2_7d_3 DECIMAL(10,2), 
  apex_vegetative_7d_1 DECIMAL(10,2), 
  apex_vegetative_7d_2 DECIMAL(10,2), 
  apex_vegetative_7d_3 DECIMAL(10,2), 
  apex_inflorescence_15w_1 DECIMAL(10,2), 
  apex_inflorescence_15w_2 DECIMAL(10,2), 
  apex_inflorescence_15w_3 DECIMAL(10,2), 
  flower_stg12_16w_1 DECIMAL(10,2), 
  flower_stg12_16w_2 DECIMAL(10,2), 
  flower_stg12_16w_3 DECIMAL(10,2), 
  flower_stamen_stg12_16w_1 DECIMAL(10,2), 
  flower_stamen_stg12_16w_2 DECIMAL(10,2), 
  flower_stamen_stg12_16w_3 DECIMAL(10,2), 
  flower_mature_pollen_16w_1 DECIMAL(10,2), 
  flower_mature_pollen_16w_2 DECIMAL(10,2), 
  flower_mature_pollen_16w_3 DECIMAL(10,2), 
  flower_carpel_16w_1 DECIMAL(10,2), 
  flower_carpel_16w_2 DECIMAL(10,2), 
  flower_carpel_16w_3 DECIMAL(10,2), 
  FULLTEXT (transcript_id, gene_id),
  PRIMARY KEY(transcript_id)
);


CREATE TABLE devseq.Capsella_rubella_transcript_tpm_RE_20240902 (
  transcript_id VARCHAR(255),
  gene_id VARCHAR(255),
  root_whole_root_4d_1 DECIMAL(10,2), 
  root_whole_root_4d_2 DECIMAL(10,2), 
  root_whole_root_4d_3 DECIMAL(10,2),  
  hypocotyl_9d_1 DECIMAL(10,2), 
  hypocotyl_9d_2 DECIMAL(10,2), 
  hypocotyl_9d_3 DECIMAL(10,2), 
  leaf_1_2_7d_1 DECIMAL(10,2), 
  leaf_1_2_7d_2 DECIMAL(10,2), 
  leaf_1_2_7d_3 DECIMAL(10,2), 
  apex_vegetative_7d_1 DECIMAL(10,2), 
  apex_vegetative_7d_2 DECIMAL(10,2), 
  apex_vegetative_7d_3 DECIMAL(10,2), 
  apex_inflorescence_15w_1 DECIMAL(10,2), 
  apex_inflorescence_15w_2 DECIMAL(10,2), 
  apex_inflorescence_15w_3 DECIMAL(10,2), 
  flower_stg12_16w_1 DECIMAL(10,2), 
  flower_stg12_16w_2 DECIMAL(10,2), 
  flower_stg12_16w_3 DECIMAL(10,2), 
  flower_stamen_stg12_16w_1 DECIMAL(10,2), 
  flower_stamen_stg12_16w_2 DECIMAL(10,2), 
  flower_stamen_stg12_16w_3 DECIMAL(10,2), 
  flower_mature_pollen_16w_1 DECIMAL(10,2), 
  flower_mature_pollen_16w_2 DECIMAL(10,2), 
  flower_mature_pollen_16w_3 DECIMAL(10,2), 
  flower_carpel_16w_1 DECIMAL(10,2), 
  flower_carpel_16w_2 DECIMAL(10,2), 
  flower_carpel_16w_3 DECIMAL(10,2),  
  FULLTEXT (transcript_id, gene_id),
  PRIMARY KEY(transcript_id)
);


# Show all tables in selected database
show TABLES;

exit;
