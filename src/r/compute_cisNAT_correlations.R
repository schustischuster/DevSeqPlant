# Compute correlations between protein-coding genes and associated cisNATs


# Install and load packages
if (!require(plyr)) install.packages('plyr')
library(plyr)
if (!require(dplyr)) install.packages('dplyr')
library(dplyr)



# Set file path and input files
in_dir <- "/Volumes/User/Shared/Christoph_manuscript/DevSeq_paper/Analysis/Analysis_2019/A_thaliana_gene_exression_map/20191121_CS"
out_dir <- "/Volumes/User/Shared/Christoph_manuscript/DevSeq_paper/Analysis/Analysis_2019/A_thaliana_gene_exression_map/20191121_CS"

coding_cisNAT_input_file <- "lnc_all_antisense_No_TE_genes_tpm_sample_names_w_gene_symbol_w_gene_symbol.csv"


# Read raw data
coding_genes_cisNATs <- read.table(file=file.path(in_dir, coding_cisNAT_input_file), sep=";", dec=".", header=TRUE, stringsAsFactors = FALSE)



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

	# startup message
	message("Computing correlation...")

	df1$Spearman <- sapply(1:nrow(df1), function(i) 
	    cor(as.numeric(df1[i, 6:137]), as.numeric(df2[i, 5:136]), method=c("spearman")))

	df1$Pearson <- sapply(1:nrow(df1), function(i) 
	    cor(as.numeric(df1[i, 6:137]), as.numeric(df2[i, 5:136]), method=c("pearson")))

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


# Remove all protein-coding genes from table that do not have an associated lncRNA
coding_genes_cisNATs_cor <- coding_genes_cisNATs_cor %>% group_by(prt_id) %>% filter(n() > 1)



# Write final data tables to csv files and store them in /out_dir/output/data_tables
if (!dir.exists(file.path(out_dir, "output", "data_tables"))) dir.create(file.path(out_dir, "output", "data_tables"), recursive = TRUE)
write.table(coding_genes_cisNATs_cor, file=file.path(out_dir, "output", "data_tables", "coding_genes_cisNATs_cor.csv"), sep=";", dec=".", row.names=FALSE, col.names=TRUE)



