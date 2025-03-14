# Prepare angiosperm core ortholog data for webpage
# TPM expression estimates normalized by DESeq2
# This script prepares DevSeq angiosperm core ortholog expression data input for DevSeqPlant mySQL database
# Input format of core expression table is as follows:
# id / DEVSEQ_SAMPLE_REPLICATES(24/27samples for table w/w/o pollen)


angio_core_genes_input_file <- "AT_core_inter_tpm_mat_deseq_sample_names.csv"


# Read raw data
core_orthologs <- read.table(file=file.path(in_dir, "core_angio", angio_core_genes_input_file), sep=";", dec=".", header=TRUE, stringsAsFactors = FALSE)


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

names(id_sep) <- c("orthogroup", "AT_id", "AL_id", "CR_id", "ES_id", "TH_id", "MT_id", "BD_id")
seq_id <- data.frame(seq_id = (seq(1:nrow(core_orthologs))))


# Create expression table for each species separately
core_AT <- data.frame(seq_id, id_sep[c("AT_id")], select(core_orthologs, contains("A.thaliana")))
core_AL <- data.frame(seq_id, id_sep[c("AL_id")], select(core_orthologs, contains("A.lyrata")))
core_CR <- data.frame(seq_id, id_sep[c("CR_id")], select(core_orthologs, contains("C.rubella")))
core_ES <- data.frame(seq_id, id_sep[c("ES_id")], select(core_orthologs, contains("E.salsugineum")))
core_TH <- data.frame(seq_id, id_sep[c("TH_id")], select(core_orthologs, contains("T.hassleriana")))
core_MT <- data.frame(seq_id, id_sep[c("MT_id")], select(core_orthologs, contains("M.truncatula")))
core_BD <- data.frame(seq_id, id_sep[c("BD_id")], select(core_orthologs, contains("B.distachyon")))


# Generate unique ortholog column names
spec_ls <- list(core_AT = core_AT, core_AL = core_AL, core_CR = core_CR, core_ES = core_ES, 
	core_TH = core_TH, core_MT = core_MT, core_BD = core_BD)

ls_colnames <- c("seq_id", "gene_id", 
	"root_1", "root_2", "root_3", "hypocotyl_1","hypocotyl_2", "hypocotyl_3", 
	"leaf_1", "leaf_2", "leaf_3", "apex_veg_1", "apex_veg_2", "apex_veg_3", 
	"apex_inf_1", "apex_inf_2", "apex_inf_3", "flower_1", "flower_2", "flower_3", 
	"stamen_1", "stamen_2", "stamen_3", "carpel_1", "carpel_2", "carpel_3")

list2env(lapply(spec_ls, setNames, ls_colnames), .GlobalEnv)

core_data <- rbind(core_AT, core_AL, core_CR, core_ES, core_TH, core_MT, core_BD)

core_data <- core_data[order(core_data$seq_id),]


# Generate column with replicated names for easy MySQL search
AT_id_repl <- rep(unlist(core_AT[c("gene_id")]), each = 7)
AL_id_repl <- rep(unlist(core_AL[c("gene_id")]), each = 7)
CR_id_repl <- rep(unlist(core_CR[c("gene_id")]), each = 7)
ES_id_repl <- rep(unlist(core_ES[c("gene_id")]), each = 7)
TH_id_repl <- rep(unlist(core_TH[c("gene_id")]), each = 7)
MT_id_repl <- rep(unlist(core_MT[c("gene_id")]), each = 7)
BD_id_repl <- rep(unlist(core_BD[c("gene_id")]), each = 7)

gene_id_repl_df <- data.frame(AT_id_repl = AT_id_repl, AL_id_repl = AL_id_repl, CR_id_repl = CR_id_repl, 
	ES_id_repl = ES_id_repl, TH_id_repl = TH_id_repl, MT_id_repl = MT_id_repl, BD_id_repl = BD_id_repl)


core_ortholog_df <- cbind(gene_id_repl_df, core_data)

core_ortholog_df <- core_ortholog_df %>%
  select(seq_id, everything())

names(core_ortholog_df)[names(core_ortholog_df) == 'seq_id'] <- 'orthogroup'



# Round values to two digits (database numeric columns are formated to Decimal[2])
round_df <- function(x, digits) {
    numeric_columns <- sapply(x, mode) == 'numeric'
    x[numeric_columns] <-  round(x[numeric_columns], digits)
    x
}


core_ortholog_df <- cbind(core_ortholog_df[,1:9], round_df(core_ortholog_df[,10:ncol(core_ortholog_df)], 2))


# Write final data tables to csv files and store them in /out_dir/output/data_tables
if (!dir.exists(file.path(out_dir, "output", "data_tables"))) dir.create(file.path(out_dir, "output", "data_tables"), recursive = TRUE)
write.table(core_ortholog_df, file=file.path(out_dir, "output", "data_tables", "core_ortholog_df.csv"), sep=";", dec=".", row.names=FALSE, col.names=TRUE)


