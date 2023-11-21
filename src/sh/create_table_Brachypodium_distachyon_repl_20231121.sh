######### Create empty mySQL data tables ###########

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

# Create AT replicate tables in devseq database
CREATE TABLE devseq.Brachypodium_distachyon_repl_gene_tpm_20231121 (
   gene_id VARCHAR(255),
   root_whole_root_4d DECIMAL(10,2),
   mesocotyl_7d DECIMAL(10,2),
   leaf_1_4d DECIMAL(10,2),
   apex_vegetative_5d DECIMAL(10,2),
   lateral_spikelet_meristem_3w DECIMAL(10,2),
   floret_w_anthers_before_dehiscence_32d DECIMAL(10,2),
   floret_stamen_32d DECIMAL(10,2),
   floret_mature_pollen_32d DECIMAL(10,2),
   floret_carpel_32d DECIMAL(10,2),
   FULLTEXT (gene_id),
   PRIMARY KEY(gene_id)
);


CREATE TABLE devseq.Brachypodium_distachyon_repl_gene_tpm_RE_20231121 (
   gene_id VARCHAR(255),
   root_whole_root_4d DECIMAL(10,2),
   mesocotyl_7d DECIMAL(10,2),
   leaf_1_4d DECIMAL(10,2),
   apex_vegetative_5d DECIMAL(10,2),
   lateral_spikelet_meristem_3w DECIMAL(10,2),
   floret_w_anthers_before_dehiscence_32d DECIMAL(10,2),
   floret_stamen_32d DECIMAL(10,2),
   floret_mature_pollen_32d DECIMAL(10,2),
   floret_carpel_32d DECIMAL(10,2),
   FULLTEXT (gene_id),
   PRIMARY KEY(gene_id)
);


CREATE TABLE devseq.Brachypodium_distachyon_repl_transcript_tpm_20231121 (
   transcript_id VARCHAR(255),
   gene_id VARCHAR(255),
   root_whole_root_4d DECIMAL(10,2),
   mesocotyl_7d DECIMAL(10,2),
   leaf_1_4d DECIMAL(10,2),
   apex_vegetative_5d DECIMAL(10,2),
   lateral_spikelet_meristem_3w DECIMAL(10,2),
   floret_w_anthers_before_dehiscence_32d DECIMAL(10,2),
   floret_stamen_32d DECIMAL(10,2),
   floret_mature_pollen_32d DECIMAL(10,2),
   floret_carpel_32d DECIMAL(10,2),
   FULLTEXT (transcript_id, gene_id),
   PRIMARY KEY(transcript_id)
);


CREATE TABLE devseq.Brachypodium_distachyon_repl_transcript_tpm_RE_20231121 (
   transcript_id VARCHAR(255),
   gene_id VARCHAR(255),
   root_whole_root_4d DECIMAL(10,2),
   mesocotyl_7d DECIMAL(10,2),
   leaf_1_4d DECIMAL(10,2),
   apex_vegetative_5d DECIMAL(10,2),
   lateral_spikelet_meristem_3w DECIMAL(10,2),
   floret_w_anthers_before_dehiscence_32d DECIMAL(10,2),
   floret_stamen_32d DECIMAL(10,2),
   floret_mature_pollen_32d DECIMAL(10,2),
   floret_carpel_32d DECIMAL(10,2),
   FULLTEXT (transcript_id, gene_id),
   PRIMARY KEY(transcript_id)
);



# Show all tables in selected database
show TABLES;

exit;
