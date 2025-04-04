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
CREATE TABLE devseq.Medicago_truncatula_gene_tpm_20231101 (
  gene_id VARCHAR(255),
  root_whole_root_4d_1 DECIMAL(10,2), 
  root_whole_root_4d_2 DECIMAL(10,2), 
  root_whole_root_4d_3 DECIMAL(10,2),  
  hypocotyl_8d_1 DECIMAL(10,2), 
  hypocotyl_8d_2 DECIMAL(10,2), 
  hypocotyl_8d_3 DECIMAL(10,2), 
  leaf_2_7d_1 DECIMAL(10,2), 
  leaf_2_7d_2 DECIMAL(10,2), 
  leaf_2_7d_3 DECIMAL(10,2), 
  apex_vegetative_6d_1 DECIMAL(10,2), 
  apex_vegetative_6d_2 DECIMAL(10,2), 
  apex_vegetative_6d_3 DECIMAL(10,2), 
  meristem_inflorescence_7w_1 DECIMAL(10,2), 
  meristem_inflorescence_7w_2 DECIMAL(10,2), 
  meristem_inflorescence_7w_3 DECIMAL(10,2), 
  flower_stg8_7w_1 DECIMAL(10,2), 
  flower_stg8_7w_2 DECIMAL(10,2), 
  flower_stg8_7w_3 DECIMAL(10,2), 
  flower_stg8_stamens_7w_1 DECIMAL(10,2), 
  flower_stg8_stamens_7w_2 DECIMAL(10,2), 
  flower_stg8_stamens_7w_3 DECIMAL(10,2), 
  flowers_mature_pollen_7w_1 DECIMAL(10,2), 
  flowers_mature_pollen_7w_2 DECIMAL(10,2), 
  flowers_mature_pollen_7w_3 DECIMAL(10,2), 
  flower_stg8_carpels_7w_1 DECIMAL(10,2), 
  flower_stg8_carpels_7w_2 DECIMAL(10,2), 
  flower_stg8_carpels_7w_3 DECIMAL(10,2), 
  FULLTEXT (gene_id),
  PRIMARY KEY(gene_id)
);


CREATE TABLE devseq.Medicago_truncatula_gene_tpm_RE_20231101 (
  gene_id VARCHAR(255),
  root_whole_root_4d_1 DECIMAL(10,2), 
  root_whole_root_4d_2 DECIMAL(10,2), 
  root_whole_root_4d_3 DECIMAL(10,2),  
  hypocotyl_8d_1 DECIMAL(10,2), 
  hypocotyl_8d_2 DECIMAL(10,2), 
  hypocotyl_8d_3 DECIMAL(10,2), 
  leaf_2_7d_1 DECIMAL(10,2), 
  leaf_2_7d_2 DECIMAL(10,2), 
  leaf_2_7d_3 DECIMAL(10,2), 
  apex_vegetative_6d_1 DECIMAL(10,2), 
  apex_vegetative_6d_2 DECIMAL(10,2), 
  apex_vegetative_6d_3 DECIMAL(10,2), 
  meristem_inflorescence_7w_1 DECIMAL(10,2), 
  meristem_inflorescence_7w_2 DECIMAL(10,2), 
  meristem_inflorescence_7w_3 DECIMAL(10,2), 
  flower_stg8_7w_1 DECIMAL(10,2), 
  flower_stg8_7w_2 DECIMAL(10,2), 
  flower_stg8_7w_3 DECIMAL(10,2), 
  flower_stg8_stamens_7w_1 DECIMAL(10,2), 
  flower_stg8_stamens_7w_2 DECIMAL(10,2), 
  flower_stg8_stamens_7w_3 DECIMAL(10,2), 
  flowers_mature_pollen_7w_1 DECIMAL(10,2), 
  flowers_mature_pollen_7w_2 DECIMAL(10,2), 
  flowers_mature_pollen_7w_3 DECIMAL(10,2), 
  flower_stg8_carpels_7w_1 DECIMAL(10,2), 
  flower_stg8_carpels_7w_2 DECIMAL(10,2), 
  flower_stg8_carpels_7w_3 DECIMAL(10,2), 
  FULLTEXT (gene_id),
  PRIMARY KEY(gene_id)
);


CREATE TABLE devseq.Medicago_truncatula_transcript_tpm_20231101 (
  transcript_id VARCHAR(255),
  gene_id VARCHAR(255),
  root_whole_root_4d_1 DECIMAL(10,2), 
  root_whole_root_4d_2 DECIMAL(10,2), 
  root_whole_root_4d_3 DECIMAL(10,2),  
  hypocotyl_8d_1 DECIMAL(10,2), 
  hypocotyl_8d_2 DECIMAL(10,2), 
  hypocotyl_8d_3 DECIMAL(10,2), 
  leaf_2_7d_1 DECIMAL(10,2), 
  leaf_2_7d_2 DECIMAL(10,2), 
  leaf_2_7d_3 DECIMAL(10,2), 
  apex_vegetative_6d_1 DECIMAL(10,2), 
  apex_vegetative_6d_2 DECIMAL(10,2), 
  apex_vegetative_6d_3 DECIMAL(10,2), 
  meristem_inflorescence_7w_1 DECIMAL(10,2), 
  meristem_inflorescence_7w_2 DECIMAL(10,2), 
  meristem_inflorescence_7w_3 DECIMAL(10,2), 
  flower_stg8_7w_1 DECIMAL(10,2), 
  flower_stg8_7w_2 DECIMAL(10,2), 
  flower_stg8_7w_3 DECIMAL(10,2), 
  flower_stg8_stamens_7w_1 DECIMAL(10,2), 
  flower_stg8_stamens_7w_2 DECIMAL(10,2), 
  flower_stg8_stamens_7w_3 DECIMAL(10,2), 
  flowers_mature_pollen_7w_1 DECIMAL(10,2), 
  flowers_mature_pollen_7w_2 DECIMAL(10,2), 
  flowers_mature_pollen_7w_3 DECIMAL(10,2), 
  flower_stg8_carpels_7w_1 DECIMAL(10,2), 
  flower_stg8_carpels_7w_2 DECIMAL(10,2), 
  flower_stg8_carpels_7w_3 DECIMAL(10,2), 
  FULLTEXT (transcript_id, gene_id),
  PRIMARY KEY(transcript_id)
);


CREATE TABLE devseq.Medicago_truncatula_transcript_tpm_RE_20231101 (
  transcript_id VARCHAR(255),
  gene_id VARCHAR(255),
  root_whole_root_4d_1 DECIMAL(10,2), 
  root_whole_root_4d_2 DECIMAL(10,2), 
  root_whole_root_4d_3 DECIMAL(10,2),  
  hypocotyl_8d_1 DECIMAL(10,2), 
  hypocotyl_8d_2 DECIMAL(10,2), 
  hypocotyl_8d_3 DECIMAL(10,2), 
  leaf_2_7d_1 DECIMAL(10,2), 
  leaf_2_7d_2 DECIMAL(10,2), 
  leaf_2_7d_3 DECIMAL(10,2), 
  apex_vegetative_6d_1 DECIMAL(10,2), 
  apex_vegetative_6d_2 DECIMAL(10,2), 
  apex_vegetative_6d_3 DECIMAL(10,2), 
  meristem_inflorescence_7w_1 DECIMAL(10,2), 
  meristem_inflorescence_7w_2 DECIMAL(10,2), 
  meristem_inflorescence_7w_3 DECIMAL(10,2), 
  flower_stg8_7w_1 DECIMAL(10,2), 
  flower_stg8_7w_2 DECIMAL(10,2), 
  flower_stg8_7w_3 DECIMAL(10,2), 
  flower_stg8_stamens_7w_1 DECIMAL(10,2), 
  flower_stg8_stamens_7w_2 DECIMAL(10,2), 
  flower_stg8_stamens_7w_3 DECIMAL(10,2), 
  flowers_mature_pollen_7w_1 DECIMAL(10,2), 
  flowers_mature_pollen_7w_2 DECIMAL(10,2), 
  flowers_mature_pollen_7w_3 DECIMAL(10,2), 
  flower_stg8_carpels_7w_1 DECIMAL(10,2), 
  flower_stg8_carpels_7w_2 DECIMAL(10,2), 
  flower_stg8_carpels_7w_3 DECIMAL(10,2), 
  FULLTEXT (transcript_id, gene_id),
  PRIMARY KEY(transcript_id)
);


# Show all tables in selected database
show TABLES;

exit;
