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
CREATE TABLE devseq.Capsella_rubella_repl_gene_tpm_20240902 (
   gene_id VARCHAR(255),
   root_whole_root_4d DECIMAL(10,2),
   hypocotyl_9d DECIMAL(10,2),
   leaf_1_2_7d DECIMAL(10,2),
   apex_vegetative_7d DECIMAL(10,2),
   apex_inflorescence_15w DECIMAL(10,2),
   flower_stg12_16w DECIMAL(10,2),
   flower_stamen_stg12_16w DECIMAL(10,2),
   flower_mature_pollen_16w DECIMAL(10,2),
   flower_carpel_16w DECIMAL(10,2),
   FULLTEXT (gene_id),
   PRIMARY KEY(gene_id)
);


CREATE TABLE devseq.Capsella_rubella_repl_gene_tpm_RE_20240902 (
   gene_id VARCHAR(255),
   root_whole_root_4d DECIMAL(10,2),
   hypocotyl_9d DECIMAL(10,2),
   leaf_1_2_7d DECIMAL(10,2),
   apex_vegetative_7d DECIMAL(10,2),
   apex_inflorescence_15w DECIMAL(10,2),
   flower_stg12_16w DECIMAL(10,2),
   flower_stamen_stg12_16w DECIMAL(10,2),
   flower_mature_pollen_16w DECIMAL(10,2),
   flower_carpel_16w DECIMAL(10,2),
   FULLTEXT (gene_id),
   PRIMARY KEY(gene_id)
);


CREATE TABLE devseq.Capsella_rubella_repl_transcript_tpm_20240902 (
   transcript_id VARCHAR(255),
   gene_id VARCHAR(255),
   root_whole_root_4d DECIMAL(10,2),
   hypocotyl_9d DECIMAL(10,2),
   leaf_1_2_7d DECIMAL(10,2),
   apex_vegetative_7d DECIMAL(10,2),
   apex_inflorescence_15w DECIMAL(10,2),
   flower_stg12_16w DECIMAL(10,2),
   flower_stamen_stg12_16w DECIMAL(10,2),
   flower_mature_pollen_16w DECIMAL(10,2),
   flower_carpel_16w DECIMAL(10,2),
   FULLTEXT (transcript_id, gene_id),
   PRIMARY KEY(transcript_id)
);


CREATE TABLE devseq.Capsella_rubella_repl_transcript_tpm_RE_20240902 (
   transcript_id VARCHAR(255),
   gene_id VARCHAR(255),
   root_whole_root_4d DECIMAL(10,2),
   hypocotyl_9d DECIMAL(10,2),
   leaf_1_2_7d DECIMAL(10,2),
   apex_vegetative_7d DECIMAL(10,2),
   apex_inflorescence_15w DECIMAL(10,2),
   flower_stg12_16w DECIMAL(10,2),
   flower_stamen_stg12_16w DECIMAL(10,2),
   flower_mature_pollen_16w DECIMAL(10,2),
   flower_carpel_16w DECIMAL(10,2),
   FULLTEXT (transcript_id, gene_id),
   PRIMARY KEY(transcript_id)
);



# Show all tables in selected database
show TABLES;

exit;
