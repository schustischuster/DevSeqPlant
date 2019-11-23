# Compute correlations between protein-coding genes and associated cisNATs


# Install and load packages
if (!require(dplyr)) install.packages('dplyr')
library(dplyr)
if (!require(plyr)) install.packages('plyr')
library(plyr)



# Set file path and input files
in_dir <- "/Volumes/User/Shared/Christoph_manuscript/DevSeq_paper/Analysis/Analysis_2019/A_thaliana_gene_exression_map/20191121_CS"
out_dir <- "/Volumes/User/Shared/Christoph_manuscript/DevSeq_paper/Analysis/Analysis_2019/A_thaliana_gene_exression_map/20191121_CS"

coding_cisNAT_input_file <- "lnc_all_antisense_No_TE_genes_tpm_sample_names_w_gene_symbol_w_gene_symbol.csv"



# Read raw data
coding_genes_cisNATs <- read.table(file=file.path(in_dir, coding_cisNAT_input_file), sep=";", dec=".", header=TRUE, stringsAsFactors = FALSE)



# Set TPM threshold: expression > 0.5 TPM in at least one sample
coding_genes_cisNATs <- coding_genes_cisNATs[which(rowSums(coding_genes_cisNATs[,-1:-5, drop = FALSE] > 0.5) > 1),]



# get first memebr of each group in expression table - this is the protein-coding gene
all_coding <- ddply(coding_genes_cisNATs, .(prt_id), head, 1)



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


# Write final data tables to csv files and store them in /out_dir/output/data_tables
if (!dir.exists(file.path(out_dir, "output", "data_tables"))) dir.create(file.path(out_dir, "output", "data_tables"), recursive = TRUE)
write.table(coding_genes_cisNATs_cor, file=file.path(out_dir, "output", "data_tables", "coding_genes_cisNATs_cor.csv"), sep=";", dec=".", row.names=FALSE, col.names=TRUE)



