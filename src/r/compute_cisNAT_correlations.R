
# Compute correlations between protein-coding genes and associated cisNATs
# Caution: Input sample tables can have different format,
# e.g. id / prt_id / symbol / biotype / source / DEVSEQ_SAMPLE_REPLICATES(132samples)
# OR id / prt_id / biotype / source / DEVSEQ_SAMPLE_REPLICATES(132samples) (without symbol column)
# In the latter case, load gene_ids_araport_gene_symbol file and add gene symbols to
# devseq expression table



# Install and load packages
if (!require(dplyr)) install.packages('dplyr')
library(dplyr)



# Set file path and input files
in_dir <- "/Volumes/User/Shared/Christoph_manuscript/DevSeq_paper/Analysis/Analysis_2019/A_thaliana_gene_exression_map/20191121_CS_coding_cisNAT_analysis"
out_dir <- "/Volumes/User/Shared/Christoph_manuscript/DevSeq_paper/Analysis/Analysis_2019/A_thaliana_gene_exression_map/20191121_CS_coding_cisNAT_analysis"

coding_cisNAT_input_file <- "lnc_all_antisense_No_TE_genes_tpm_sample_names.csv" # does not have symbol column
id_symbol_input_file <- "Gene_IDs_ATH_names_wo_dupl.csv"


# Read raw data
coding_genes_cisNATs <- read.table(file=file.path(in_dir, coding_cisNAT_input_file), sep=";", dec=".", header=TRUE, stringsAsFactors = FALSE)
gene_id_symbol_list <- read.table(file=file.path(in_dir, id_symbol_input_file), sep=";", dec=".", header=TRUE, stringsAsFactors = FALSE)



# --------- Prepare gene_id-symbol list and add symbols to DevSeq ATH expression table ---------
# ------ Only required if coding-cisNAT input data table does not contain a symbol column ------

all_devseq_cd_nc <- as.data.frame(coding_genes_cisNATs[, 1])
names(all_devseq_cd_nc) <- c("id") #id column from coding_genes_cisNATs table

gene_names_id <- as.data.frame(gene_id_symbol_list[, 1])
names(gene_names_id) <- c("id") #id column from gene_id_symbol_list table

devseq_genes_wo_symbol <- anti_join(all_devseq_cd_nc, gene_names_id, by = "id")
devseq_genes_wo_symbol$symbol = devseq_genes_wo_symbol$id
gene_names_all_genes <- rbind(gene_id_symbol_list, devseq_genes_wo_symbol)
gene_names_all_genes <- unique(gene_names_all_genes) #removes duplicates in gene_id-symbol list

addGeneSymbols <- function(df) {
		    df <- merge(df, gene_names_all_genes, by="id")
		    df = df %>% select(id, prt_id, symbol, everything())
		    df <- df[order(df$prt_id),]
		}

coding_genes_cisNATs <- addGeneSymbols(coding_genes_cisNATs)

# ----------------------------------------------------------------------------------------------



# This is a threshold function that can be applied to expression tables
# Settings: TPM > 0.5 in at least 2 of 3 replicates
applyThreshold <- function(df) {

	# Add keys to data frame
	key <- seq(1, nrow(df), 1)
	key <- as.data.frame(key)
	df <- cbind(key,df)

	# Define threshold function
	getThreshold <- function(df) {

		# Split data frame by sample replicates into a list then apply threshold for each subset
	
		th_replicates <- do.call(cbind, lapply(split.default(df[7:ncol(df)], # adjust columns
								rep(seq_along(df), each = 3, length.out = ncol(df)-6)), # adjust columns
								function(x) {
									x[rowSums(x > 0.5) < 2, ] <- 0; 
									x
								}
							))

		# Bind key/id/prt_id/symbol/biotype/source columns to thresholded data frame
		th_replicates <- cbind(df[1:6], th_replicates)

		# Remove all rows that only contain "0"
		th_replicates <- th_replicates[which(rowSums(th_replicates[,-1:-6, drop = FALSE] > 0) > 0),]

		return(th_replicates)
	}

	# Apply threshold to data and extract keys ("key")
	keys_data <- getThreshold(df)
	keys_data <- keys_data[,1:2]
	names(keys_data) <- c("key","ID")

	# Generate thresholded data frame based on keys
	th_df <- merge(keys_data, df, by="key")
	th_df <- th_df[order(th_df$key),]
	th_df <- th_df[-1:-2]

	return(th_df)
}



# Apply threshold function
coding_genes_cisNATs <- applyThreshold(coding_genes_cisNATs)



# Get first member of each group in expression table - this is the protein-coding gene
all_coding <- subset(coding_genes_cisNATs, biotype == "protein_coding")


# Remove all lncRNAs from expression table that are not associated with a protein-coding gene
coding_genes_cisNATs <- coding_genes_cisNATs[(coding_genes_cisNATs$prt_id %in% all_coding$prt_id),]


# Create table of id and prt_id from coding_genes_cisNATs table
all_id_prt_id <- coding_genes_cisNATs[,1:2]



# Generate reference table containing all coding genes with same table length as 
# coding_genes_cisNATs table
all_coding_reference <- merge(all_id_prt_id, all_coding, by="prt_id")
all_coding_reference <- all_coding_reference[,-2:-3]



# Compute spearman and pearson correlations
getCor <- function(df1, df2) {

	df1_col <- ncol(df1)
	df2_col <- ncol(df2)

	# startup message
	message("Computing correlation...")

	df1$Spearman <- sapply(1:nrow(df1), function(i) 
	    cor(as.numeric(df1[i, 6:df1_col]), as.numeric(df2[i, 5:df2_col]), method=c("spearman")))

	df1$Pearson <- sapply(1:nrow(df1), function(i) 
	    cor(as.numeric(df1[i, 6:df1_col]), as.numeric(df2[i, 5:df2_col]), method=c("pearson")))

	return(df1)
}

coding_genes_cisNATs_cor <- getCor(coding_genes_cisNATs, all_coding_reference)


# Rearrange columns
coding_genes_cisNATs_cor = coding_genes_cisNATs_cor %>% select(
	id, 
	prt_id, 
	symbol, 
	biotype, 
	source, 
	Spearman, 
	Pearson, 
	everything())



# ------------------------- Generate cor table without pollen samples ------------------------- #

# Remove pollen samples from expression tables
coding_genes_cisNATs_wo_pollen <- dplyr::select(coding_genes_cisNATs, -c(
	flowers_mature_pollen_28d_1, 
	flowers_mature_pollen_28d_2, 
	flowers_mature_pollen_28d_3)) #tibble w/o pollen samles

all_coding_reference_wo_pollen <- dplyr::select(all_coding_reference, -c(
	flowers_mature_pollen_28d_1, 
	flowers_mature_pollen_28d_2, 
	flowers_mature_pollen_28d_3)) #tibble w/o pollen samles

coding_genes_cisNATs_cor_wo_pollen <- getCor(coding_genes_cisNATs_wo_pollen, all_coding_reference_wo_pollen)


# Rearrange columns
coding_genes_cisNATs_cor_wo_pollen = coding_genes_cisNATs_cor_wo_pollen %>% select(
	id, 
	prt_id, 
	symbol, 
	biotype, 
	source, 
	Spearman, 
	Pearson, 
	everything())

# --------------------------------------------------------------------------------------------- #



# Remove all protein-coding genes from table that do not have an associated lncRNA
coding_genes_cisNATs_cor <- coding_genes_cisNATs_cor %>% group_by(prt_id) %>% filter(n() > 1)
coding_genes_cisNATs_cor_wo_pollen <- coding_genes_cisNATs_cor_wo_pollen %>% group_by(prt_id) %>% filter(n() > 1)



# Write final data tables to csv files and store them in /out_dir/output/data_tables
if (!dir.exists(file.path(out_dir, "output", "data_tables"))) dir.create(file.path(out_dir, "output", "data_tables"), recursive = TRUE)
write.table(coding_genes_cisNATs_cor, file=file.path(out_dir, "output", "data_tables", "coding_genes_cisNATs_cor.csv"), sep=";", dec=".", row.names=FALSE, col.names=TRUE)



# Make boxplot of result
# Generate boxplots of ATGE/DevSeq Spearman and Pearson correlation values
cisNATs_cor <- subset(coding_genes_cisNATs_cor, biotype == "lnc_exonic_antisense")
cisNATs_cor_wo_pollen <- subset(coding_genes_cisNATs_cor_wo_pollen, biotype == "lnc_exonic_antisense")
cisNATs_cor <- as.data.frame(cisNATs_cor)
cisNATs_cor_wo_pollen <-as.data.frame(cisNATs_cor_wo_pollen)

png(file = file.path(out_dir, "output", "data_tables", "cisNATs_cor_ATH.png"), width = 3800, height = 4700, res = 825)
par(mar = c(7.5, 4.5, 4, 1.5))
boxplot(cisNATs_cor[, 6], cisNATs_cor[, 7], cisNATs_cor_wo_pollen[, 6], cisNATs_cor_wo_pollen[, 7],
	ylim = c(-1.0, 1.0), 
	names = c("Spearman", "Pearson", "Spearman\nw/o_pollen", "Pearson\nw/o_pollen"),
	las = 2,
	cex.axis = 1.1, #adapt size of axis labels
	ylab = "ρ", 
	col = c("wheat4", "wheat3", "wheat1", "khaki1"), 
	main = "Correlation protein-coding cisNATs", 
	boxwex = 0.75, 
	pars = list(outcol = "gray50")
	)
dev.off()



