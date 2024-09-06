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
CREATE TABLE devseq.Eutrema_salsugineum_repl_gene_tpm_20240906 (
   gene_id VARCHAR(255),
   root_whole_root_6d DECIMAL(10,2),
   hypocotyl_12d DECIMAL(10,2),
   leaf_1_2_9d DECIMAL(10,2),
   apex_vegetative_9d DECIMAL(10,2),
   apex_inflorescence_17w DECIMAL(10,2),
   flower_stg12_17w DECIMAL(10,2),
   flower_stamen_stg17_17w DECIMAL(10,2),
   flower_mature_pollen_17w DECIMAL(10,2),
   flower_carpel_18w DECIMAL(10,2),
   FULLTEXT (gene_id),
   PRIMARY KEY(gene_id)
);


CREATE TABLE devseq.Eutrema_salsugineum_repl_gene_tpm_RE_20240906 (
   gene_id VARCHAR(255),
   root_whole_root_6d DECIMAL(10,2),
   hypocotyl_12d DECIMAL(10,2),
   leaf_1_2_9d DECIMAL(10,2),
   apex_vegetative_9d DECIMAL(10,2),
   apex_inflorescence_17w DECIMAL(10,2),
   flower_stg12_17w DECIMAL(10,2),
   flower_stamen_stg17_17w DECIMAL(10,2),
   flower_mature_pollen_17w DECIMAL(10,2),
   flower_carpel_18w DECIMAL(10,2),
   FULLTEXT (gene_id),
   PRIMARY KEY(gene_id)
);


CREATE TABLE devseq.Eutrema_salsugineum_repl_transcript_tpm_20240906 (
   transcript_id VARCHAR(255),
   gene_id VARCHAR(255),
   root_whole_root_6d DECIMAL(10,2),
   hypocotyl_12d DECIMAL(10,2),
   leaf_1_2_9d DECIMAL(10,2),
   apex_vegetative_9d DECIMAL(10,2),
   apex_inflorescence_17w DECIMAL(10,2),
   flower_stg12_17w DECIMAL(10,2),
   flower_stamen_stg12_17w DECIMAL(10,2),
   flower_mature_pollen_17w DECIMAL(10,2),
   flower_carpel_18w DECIMAL(10,2),
   FULLTEXT (transcript_id, gene_id),
   PRIMARY KEY(transcript_id)
);


CREATE TABLE devseq.Eutrema_salsugineum_repl_transcript_tpm_RE_20240906 (
   transcript_id VARCHAR(255),
   gene_id VARCHAR(255),
   root_whole_root_6d DECIMAL(10,2),
   hypocotyl_12d DECIMAL(10,2),
   leaf_1_2_9d DECIMAL(10,2),
   apex_vegetative_9d DECIMAL(10,2),
   apex_inflorescence_17w DECIMAL(10,2),
   flower_stg12_17w DECIMAL(10,2),
   flower_stamen_stg12_17w DECIMAL(10,2),
   flower_mature_pollen_17w DECIMAL(10,2),
   flower_carpel_18w DECIMAL(10,2),
   FULLTEXT (transcript_id, gene_id),
   PRIMARY KEY(transcript_id)
);



# Show all tables in selected database
show TABLES;

exit;
