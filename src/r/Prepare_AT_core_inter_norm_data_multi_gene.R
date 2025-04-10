# Prepare angiosperm core ortholog data for multi-gene query on webpage
# TPM expression estimates normalized by DESeq2
# This script prepares DevSeq angiosperm core ortholog expression data input for DevSeqPlant mySQL database
# Input format of core expression table is as follows:
# id / DEVSEQ_SAMPLE_REPLICATES(24/27samples for table w/w/o pollen)


angio_core_genes_input_file <- "AT_core_inter_tpm_mat_deseq_sample_names.csv"


# Read raw data
core_orthologs <- read.table(file=file.path(in_dir, "ortholog_expression_data", angio_core_genes_input_file), sep=";", dec=".", header=TRUE, stringsAsFactors = FALSE)


colnames(core_orthologs)[1] <- "id"


####################################################################################################
####### Remove all pollen data from data table
# Pollen can not be normalized with the other samples, it has very specific transcriptome profile


core_orthologs[c("A.thaliana_flowers_mature_pollen_28d_.2.", "A.thaliana_flowers_mature_pollen_28d_.3.", 
	"A.thaliana_flowers_mature_pollen_28d_.1.", "A.lyrata_flowers_mature_pollen_8w.10w.25d_.2.", 
	"A.lyrata_flowers_mature_pollen_8w.10w.25d_.3.", "A.lyrata_flowers_mature_pollen_8w.10w.25d_.1.", 
	"C.rubella_flowers_mature_pollen_6w.7w.22d_.2.", "C.rubella_flowers_mature_pollen_6w.7w.22d_.3.", 
	"C.rubella_flowers_mature_pollen_6w.7w.22d_.1.", "E.salsugineum_flowers_mature_pollen_7w.8w.17d_.2.", 
	"E.salsugineum_flowers_mature_pollen_7w.8w.17d_.3.", "E.salsugineum_flowers_mature_pollen_7w.8w.17d_.1.", 
	"T.hassleriana_flowers_mature_pollen_11w_.2.", "T.hassleriana_flowers_mature_pollen_11w_.3.", 
	"T.hassleriana_flowers_mature_pollen_11w_.1.", "M.truncatula_flowers_mature_pollen_7w_.2.", 
	"M.truncatula_flowers_mature_pollen_7w_.3.", "M.truncatula_flowers_mature_pollen_7w_.1.", 
	"B.distachyon_flowers_mature_pollen_32d_.2.", "B.distachyon_flowers_mature_pollen_32d_.3.", 
	"B.distachyon_flowers_mature_pollen_32d_.1.")] <- list(NULL)
    # Use list() to respect the target structure.

####################################################################################################


# Remove ERCC data at the end of data frame
core_orthologs <- core_orthologs[1:7003,]

id_df <- as.data.frame(core_orthologs[c("id")])


# Split gene name sequence from "id" column into independent columns
id_sep <- id_df %>%
    mutate(id_df = strsplit(as.character(id), ":\\s*")) %>%
    unnest_wider(id_df, names_sep = "")

names(id_sep)[2:ncol(id_sep)] <- c("AT_id", "AL_id", "CR_id", "ES_id", "TH_id", "MT_id", "BD_id")
orthogroup <- data.frame(orthogroup = (seq(1:nrow(core_orthologs))))


# Merge core ortholog expression table with table containing individual gene IDs
ortho_expr <- merge(core_orthologs, id_sep, by = "id")

core_ortho_df <- cbind(orthogroup, ortho_expr)

names(core_ortho_df)[names(core_ortho_df) == 'id'] <- 'gene_id'

core_ortho_df <- core_ortho_df[, c(1, 171:177, 2, 3:170)]



ls_colnames <- c("root_1", "root_2", "root_3", "hypocotyl_1","hypocotyl_2", "hypocotyl_3", 
	"leaf_1", "leaf_2", "leaf_3", "apex_veg_1", "apex_veg_2", "apex_veg_3", 
	"apex_inf_1", "apex_inf_2", "apex_inf_3", "flower_1", "flower_2", "flower_3", 
	"stamen_1", "stamen_2", "stamen_3", "carpel_1", "carpel_2", "carpel_3")

AT_names <- paste0("AT_", ls_colnames)
AL_names <- paste0("AL_", ls_colnames)
CR_names <- paste0("CR_", ls_colnames)
ES_names <- paste0("ES_", ls_colnames)
TH_names <- paste0("TH_", ls_colnames)
MT_names <- paste0("MT_", ls_colnames)
BD_names <- paste0("BD_", ls_colnames)


names(core_ortho_df)[10:177] <- c(AT_names[1:3], AL_names[1:3], CR_names[1:3], ES_names[1:3], TH_names[1:3], MT_names[1:3], BD_names[1:3],
   AT_names[4:6], AL_names[4:6], CR_names[4:6], ES_names[4:6], TH_names[4:6], MT_names[4:6], BD_names[4:6], 
   AT_names[7:9], AL_names[7:9], CR_names[7:9], ES_names[7:9], TH_names[7:9], MT_names[7:9], BD_names[7:9],
   AT_names[10:12], AL_names[10:12], CR_names[10:12], ES_names[10:12], TH_names[10:12], MT_names[10:12], BD_names[10:12], 
   AT_names[13:15], AL_names[13:15], CR_names[13:15], ES_names[13:15], TH_names[13:15], MT_names[13:15], BD_names[13:15], 
   AT_names[16:18], AL_names[16:18], CR_names[16:18], ES_names[16:18], TH_names[16:18], MT_names[16:18], BD_names[16:18], 
   AT_names[19:21], AL_names[19:21], CR_names[19:21], ES_names[19:21], TH_names[19:21], MT_names[19:21], BD_names[19:21],
   AT_names[22:24], AL_names[22:24], CR_names[22:24], ES_names[22:24], TH_names[22:24], MT_names[22:24], BD_names[22:24])



# Round values to two digits (database numeric columns are formated to Decimal[2])
round_df <- function(x, digits) {
    numeric_columns <- sapply(x, mode) == 'numeric'
    x[numeric_columns] <-  round(x[numeric_columns], digits)
    x
}


core_ortho_df <- cbind(core_ortho_df[,1:9], round_df(core_ortho_df[,10:ncol(core_ortho_df)], 2))


# Write final data tables to csv files and store them in /out_dir/output/data_tables
if (!dir.exists(file.path(out_dir, "output", "data_tables"))) dir.create(file.path(out_dir, "output", "data_tables"), recursive = TRUE)
write.table(core_ortho_df, file=file.path(out_dir, "output", "data_tables", "core_ortholog_multi_gene_df.csv"), sep=";", dec=".", row.names=FALSE, col.names=TRUE)



