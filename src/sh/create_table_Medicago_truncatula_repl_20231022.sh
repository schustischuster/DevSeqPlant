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
CREATE TABLE devseq.Medicago_truncatula_repl_gene_tpm_20231022 (
   gene_id VARCHAR(255),
   root_whole_root_4d DECIMAL(10,2),
   hypocotyl_8d DECIMAL(10,2),
   leaf_2_7d DECIMAL(10,2),
   apex_vegetative_6d DECIMAL(10,2),
   meristem_inflorescence_7w DECIMAL(10,2),
   flower_stg8_7w DECIMAL(10,2),
   flower_stg8_stamens_7w DECIMAL(10,2),
   flowers_mature_pollen_7w DECIMAL(10,2),
   flower_stg8_carpels_7w DECIMAL(10,2),
   FULLTEXT (gene_id),
   PRIMARY KEY(gene_id)
);


CREATE TABLE devseq.Medicago_truncatula_repl_gene_tpm_RE_20231022 (
   gene_id VARCHAR(255),
   root_whole_root_4d DECIMAL(10,2),
   hypocotyl_8d DECIMAL(10,2),
   leaf_2_7d DECIMAL(10,2),
   apex_vegetative_6d DECIMAL(10,2),
   meristem_inflorescence_7w DECIMAL(10,2),
   flower_stg8_7w DECIMAL(10,2),
   flower_stg8_stamens_7w DECIMAL(10,2),
   flowers_mature_pollen_7w DECIMAL(10,2),
   flower_stg8_carpels_7w DECIMAL(10,2),
   FULLTEXT (gene_id),
   PRIMARY KEY(gene_id)
);


CREATE TABLE devseq.Medicago_truncatula_repl_transcript_tpm_20231022 (
   transcript_id VARCHAR(255),
   gene_id VARCHAR(255),
   root_whole_root_4d DECIMAL(10,2),
   hypocotyl_8d DECIMAL(10,2),
   leaf_2_7d DECIMAL(10,2),
   apex_vegetative_6d DECIMAL(10,2),
   meristem_inflorescence_7w DECIMAL(10,2),
   flower_stg8_7w DECIMAL(10,2),
   flower_stg8_stamens_7w DECIMAL(10,2),
   flowers_mature_pollen_7w DECIMAL(10,2),
   flower_stg8_carpels_7w DECIMAL(10,2),
   FULLTEXT (transcript_id, gene_id),
   PRIMARY KEY(transcript_id)
);


CREATE TABLE devseq.Medicago_truncatula_repl_transcript_tpm_RE_20231022 (
   transcript_id VARCHAR(255),
   gene_id VARCHAR(255),
   root_whole_root_4d DECIMAL(10,2),
   hypocotyl_8d DECIMAL(10,2),
   leaf_2_7d DECIMAL(10,2),
   apex_vegetative_6d DECIMAL(10,2),
   meristem_inflorescence_7w DECIMAL(10,2),
   flower_stg8_7w DECIMAL(10,2),
   flower_stg8_stamens_7w DECIMAL(10,2),
   flowers_mature_pollen_7w DECIMAL(10,2),
   flower_stg8_carpels_7w DECIMAL(10,2),
   FULLTEXT (transcript_id, gene_id),
   PRIMARY KEY(transcript_id)
);



# Show all tables in selected database
show TABLES;

exit;
