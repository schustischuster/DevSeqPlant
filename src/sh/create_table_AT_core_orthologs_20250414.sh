######### Create empty mySQL data table ###########

# 1._Connect to mySQL and select database

# Start MySQL database
sudo mysql

# Show database
show databases;

# Use database "mytest"
use devseq;

# Show all tables in selected database
show TABLES;


# 2._Create new database tables

# Create AT tables in devseq database
CREATE TABLE devseq.AT_core_orthologs_tpm_20250414 (
  orthogroup VARCHAR(255),
  AT_id_repl VARCHAR(255),
  AL_id_repl VARCHAR(255),
  CR_id_repl VARCHAR(255),
  ES_id_repl VARCHAR(255),
  TH_id_repl VARCHAR(255),
  MT_id_repl VARCHAR(255),
  BD_id_repl VARCHAR(255),
  gene_id VARCHAR(255),
  root_1 DECIMAL(10,2), 
  root_2 DECIMAL(10,2), 
  root_3 DECIMAL(10,2), 
  hypocotyl_1 DECIMAL(10,2), 
  hypocotyl_2 DECIMAL(10,2), 
  hypocotyl_3 DECIMAL(10,2), 
  leaf_1 DECIMAL(10,2), 
  leaf_2 DECIMAL(10,2), 
  leaf_3 DECIMAL(10,2), 
  apex_veg_1 DECIMAL(10,2), 
  apex_veg_2 DECIMAL(10,2), 
  apex_veg_3 DECIMAL(10,2), 
  apex_inf_1 DECIMAL(10,2), 
  apex_inf_2 DECIMAL(10,2), 
  apex_inf_3 DECIMAL(10,2), 
  flower_1 DECIMAL(10,2), 
  flower_2 DECIMAL(10,2), 
  flower_3 DECIMAL(10,2), 
  stamen_1 DECIMAL(10,2), 
  stamen_2 DECIMAL(10,2), 
  stamen_3 DECIMAL(10,2), 
  carpel_1 DECIMAL(10,2), 
  carpel_2 DECIMAL(10,2), 
  carpel_3 DECIMAL(10,2), 
  FULLTEXT (gene_id, AT_id_repl, AL_id_repl, CR_id_repl, ES_id_repl, TH_id_repl, MT_id_repl, BD_id_repl),
  PRIMARY KEY(gene_id)
);


CREATE TABLE devseq.AT_core_orthologs_tpm_RE_20250414 (
  orthogroup VARCHAR(255),
  AT_id_repl VARCHAR(255),
  AL_id_repl VARCHAR(255),
  CR_id_repl VARCHAR(255),
  ES_id_repl VARCHAR(255),
  TH_id_repl VARCHAR(255),
  MT_id_repl VARCHAR(255),
  BD_id_repl VARCHAR(255),
  gene_id VARCHAR(255),
  root_1 DECIMAL(10,2), 
  root_2 DECIMAL(10,2), 
  root_3 DECIMAL(10,2), 
  hypocotyl_1 DECIMAL(10,2), 
  hypocotyl_2 DECIMAL(10,2), 
  hypocotyl_3 DECIMAL(10,2), 
  leaf_1 DECIMAL(10,2), 
  leaf_2 DECIMAL(10,2), 
  leaf_3 DECIMAL(10,2), 
  apex_veg_1 DECIMAL(10,2), 
  apex_veg_2 DECIMAL(10,2), 
  apex_veg_3 DECIMAL(10,2), 
  apex_inf_1 DECIMAL(10,2), 
  apex_inf_2 DECIMAL(10,2), 
  apex_inf_3 DECIMAL(10,2), 
  flower_1 DECIMAL(10,2), 
  flower_2 DECIMAL(10,2), 
  flower_3 DECIMAL(10,2), 
  stamen_1 DECIMAL(10,2), 
  stamen_2 DECIMAL(10,2), 
  stamen_3 DECIMAL(10,2), 
  carpel_1 DECIMAL(10,2), 
  carpel_2 DECIMAL(10,2), 
  carpel_3 DECIMAL(10,2), 
  FULLTEXT (gene_id, AT_id_repl, AL_id_repl, CR_id_repl, ES_id_repl, TH_id_repl, MT_id_repl, BD_id_repl),
  PRIMARY KEY(gene_id)
);


# Show all tables in selected database
show TABLES;

exit;
