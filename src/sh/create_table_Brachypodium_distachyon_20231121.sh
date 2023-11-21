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
CREATE TABLE devseq.Brachypodium_distachyon_gene_tpm_20231121 (
  gene_id VARCHAR(255),
  root_whole_root_4d_1 DECIMAL(10,2), 
  root_whole_root_4d_2 DECIMAL(10,2), 
  root_whole_root_4d_3 DECIMAL(10,2),  
  mesocotyl_7d_1 DECIMAL(10,2), 
  mesocotyl_7d_2 DECIMAL(10,2), 
  mesocotyl_7d_3 DECIMAL(10,2), 
  leaf_1_4d_1 DECIMAL(10,2), 
  leaf_1_4d_2 DECIMAL(10,2), 
  leaf_1_4d_3 DECIMAL(10,2), 
  apex_vegetative_5d_1 DECIMAL(10,2), 
  apex_vegetative_5d_2 DECIMAL(10,2), 
  apex_vegetative_5d_3 DECIMAL(10,2), 
  lateral_spikelet_meristem_3w_1 DECIMAL(10,2), 
  lateral_spikelet_meristem_3w_2 DECIMAL(10,2), 
  lateral_spikelet_meristem_3w_3 DECIMAL(10,2), 
  floret_w_anthers_before_dehiscence_32d_1 DECIMAL(10,2), 
  floret_w_anthers_before_dehiscence_32d_2 DECIMAL(10,2), 
  floret_w_anthers_before_dehiscence_32d_3 DECIMAL(10,2), 
  floret_stamen_32d_1 DECIMAL(10,2), 
  flowet_stamen_32d_2 DECIMAL(10,2), 
  flowet_stamen_32d_3 DECIMAL(10,2), 
  floret_mature_pollen_32d_1 DECIMAL(10,2), 
  floret_mature_pollen_32d_2 DECIMAL(10,2), 
  floret_mature_pollen_32d_3 DECIMAL(10,2), 
  floret_carpel_32d_1 DECIMAL(10,2), 
  floret_carpel_32d_2 DECIMAL(10,2), 
  floret_carpel_32d_3 DECIMAL(10,2), 
  FULLTEXT (gene_id),
  PRIMARY KEY(gene_id)
);


CREATE TABLE devseq.Brachypodium_distachyon_gene_tpm_RE_20231121 (
  gene_id VARCHAR(255),
  root_whole_root_4d_1 DECIMAL(10,2), 
  root_whole_root_4d_2 DECIMAL(10,2), 
  root_whole_root_4d_3 DECIMAL(10,2),  
  mesocotyl_7d_1 DECIMAL(10,2), 
  mesocotyl_7d_2 DECIMAL(10,2), 
  mesocotyl_7d_3 DECIMAL(10,2), 
  leaf_1_4d_1 DECIMAL(10,2), 
  leaf_1_4d_2 DECIMAL(10,2), 
  leaf_1_4d_3 DECIMAL(10,2), 
  apex_vegetative_5d_1 DECIMAL(10,2), 
  apex_vegetative_5d_2 DECIMAL(10,2), 
  apex_vegetative_5d_3 DECIMAL(10,2), 
  lateral_spikelet_meristem_3w_1 DECIMAL(10,2), 
  lateral_spikelet_meristem_3w_2 DECIMAL(10,2), 
  lateral_spikelet_meristem_3w_3 DECIMAL(10,2), 
  floret_w_anthers_before_dehiscence_32d_1 DECIMAL(10,2), 
  floret_w_anthers_before_dehiscence_32d_2 DECIMAL(10,2), 
  floret_w_anthers_before_dehiscence_32d_3 DECIMAL(10,2), 
  floret_stamen_32d_1 DECIMAL(10,2), 
  flowet_stamen_32d_2 DECIMAL(10,2), 
  flowet_stamen_32d_3 DECIMAL(10,2), 
  floret_mature_pollen_32d_1 DECIMAL(10,2), 
  floret_mature_pollen_32d_2 DECIMAL(10,2), 
  floret_mature_pollen_32d_3 DECIMAL(10,2), 
  floret_carpel_32d_1 DECIMAL(10,2), 
  floret_carpel_32d_2 DECIMAL(10,2), 
  floret_carpel_32d_3 DECIMAL(10,2), 
  FULLTEXT (gene_id),
  PRIMARY KEY(gene_id)
);


CREATE TABLE devseq.Brachypodium_distachyon_transcript_tpm_20231121 (
  transcript_id VARCHAR(255),
  gene_id VARCHAR(255),
  root_whole_root_4d_1 DECIMAL(10,2), 
  root_whole_root_4d_2 DECIMAL(10,2), 
  root_whole_root_4d_3 DECIMAL(10,2),  
  mesocotyl_7d_1 DECIMAL(10,2), 
  mesocotyl_7d_2 DECIMAL(10,2), 
  mesocotyl_7d_3 DECIMAL(10,2), 
  leaf_1_4d_1 DECIMAL(10,2), 
  leaf_1_4d_2 DECIMAL(10,2), 
  leaf_1_4d_3 DECIMAL(10,2), 
  apex_vegetative_5d_1 DECIMAL(10,2), 
  apex_vegetative_5d_2 DECIMAL(10,2), 
  apex_vegetative_5d_3 DECIMAL(10,2), 
  lateral_spikelet_meristem_3w_1 DECIMAL(10,2), 
  lateral_spikelet_meristem_3w_2 DECIMAL(10,2), 
  lateral_spikelet_meristem_3w_3 DECIMAL(10,2), 
  floret_w_anthers_before_dehiscence_32d_1 DECIMAL(10,2), 
  floret_w_anthers_before_dehiscence_32d_2 DECIMAL(10,2), 
  floret_w_anthers_before_dehiscence_32d_3 DECIMAL(10,2), 
  floret_stamen_32d_1 DECIMAL(10,2), 
  flowet_stamen_32d_2 DECIMAL(10,2), 
  flowet_stamen_32d_3 DECIMAL(10,2), 
  floret_mature_pollen_32d_1 DECIMAL(10,2), 
  floret_mature_pollen_32d_2 DECIMAL(10,2), 
  floret_mature_pollen_32d_3 DECIMAL(10,2), 
  floret_carpel_32d_1 DECIMAL(10,2), 
  floret_carpel_32d_2 DECIMAL(10,2), 
  floret_carpel_32d_3 DECIMAL(10,2), 
  FULLTEXT (transcript_id, gene_id),
  PRIMARY KEY(transcript_id)
);


CREATE TABLE devseq.Brachypodium_distachyon_transcript_tpm_RE_20231121 (
  transcript_id VARCHAR(255),
  gene_id VARCHAR(255),
  root_whole_root_4d_1 DECIMAL(10,2), 
  root_whole_root_4d_2 DECIMAL(10,2), 
  root_whole_root_4d_3 DECIMAL(10,2),  
  mesocotyl_7d_1 DECIMAL(10,2), 
  mesocotyl_7d_2 DECIMAL(10,2), 
  mesocotyl_7d_3 DECIMAL(10,2), 
  leaf_1_4d_1 DECIMAL(10,2), 
  leaf_1_4d_2 DECIMAL(10,2), 
  leaf_1_4d_3 DECIMAL(10,2), 
  apex_vegetative_5d_1 DECIMAL(10,2), 
  apex_vegetative_5d_2 DECIMAL(10,2), 
  apex_vegetative_5d_3 DECIMAL(10,2), 
  lateral_spikelet_meristem_3w_1 DECIMAL(10,2), 
  lateral_spikelet_meristem_3w_2 DECIMAL(10,2), 
  lateral_spikelet_meristem_3w_3 DECIMAL(10,2), 
  floret_w_anthers_before_dehiscence_32d_1 DECIMAL(10,2), 
  floret_w_anthers_before_dehiscence_32d_2 DECIMAL(10,2), 
  floret_w_anthers_before_dehiscence_32d_3 DECIMAL(10,2), 
  floret_stamen_32d_1 DECIMAL(10,2), 
  flowet_stamen_32d_2 DECIMAL(10,2), 
  flowet_stamen_32d_3 DECIMAL(10,2), 
  floret_mature_pollen_32d_1 DECIMAL(10,2), 
  floret_mature_pollen_32d_2 DECIMAL(10,2), 
  floret_mature_pollen_32d_3 DECIMAL(10,2), 
  floret_carpel_32d_1 DECIMAL(10,2), 
  floret_carpel_32d_2 DECIMAL(10,2), 
  floret_carpel_32d_3 DECIMAL(10,2), 
  FULLTEXT (transcript_id, gene_id),
  PRIMARY KEY(transcript_id)
);


# Show all tables in selected database
show TABLES;

exit;
