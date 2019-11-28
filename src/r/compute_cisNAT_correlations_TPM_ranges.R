
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
applyThreshold <- function(df, threshold) {
  
  	#* Add an error if radius < 0
  	if (threshold < 0)
    	stop(
           "'threshold' must be >= 0",
	   	call. = TRUE
    	)

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
									x[rowSums(x > threshold) < 2, ] <- 0; 
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
coding_genes_cisNATs_0.5 <- applyThreshold(coding_genes_cisNATs,0.5)
coding_genes_cisNATs_2 <- applyThreshold(coding_genes_cisNATs,2)
coding_genes_cisNATs_5 <- applyThreshold(coding_genes_cisNATs,5)



# Create list of expression tables with different thresholds
coding_genes_cisNATs_list <- list(
	coding_genes_cisNATs_0.5 = coding_genes_cisNATs_0.5, 
	coding_genes_cisNATs_2 = coding_genes_cisNATs_2, 
	coding_genes_cisNATs_5 = coding_genes_cisNATs_5)


# Create list of expression tables without pollen samples with different thresholds
coding_genes_cisNATs_list_wo_pollen <- list(
	coding_genes_cisNATs_0.5_wo_pollen = coding_genes_cisNATs_0.5, 
	coding_genes_cisNATs_2_wo_pollen = coding_genes_cisNATs_2, 
	coding_genes_cisNATs_5_wo_pollen = coding_genes_cisNATs_5)



# Remove pollen triplicates from expression table
removePollen <- function(x) {

	# Generate expression tables without pollen samples
	coding_genes_cisNATs_wo_pollen <- dplyr::select(x, -c(
		flowers_mature_pollen_28d_1, 
		flowers_mature_pollen_28d_2, 
		flowers_mature_pollen_28d_3)) #tibble w/o pollen samles
}

# Apply removePollen function to list
coding_genes_cisNATs_list_wo_pollen <- lapply(coding_genes_cisNATs_list_wo_pollen, removePollen)



# Apply function to list
corToList <- function(x) {

	# Get first member of each group in expression table - this is the protein-coding gene
	all_coding <- subset(x, biotype == "protein_coding")


	# Remove all lncRNAs from expression table that are not associated with a protein-coding gene
	all_coding_genes_cisNATs <- x[(x$prt_id %in% all_coding$prt_id),]


	# Create table of id and prt_id from coding_genes_cisNATs table
	all_id_prt_id <- all_coding_genes_cisNATs[,1:2]


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

	coding_genes_cisNATs_cor <- getCor(all_coding_genes_cisNATs, all_coding_reference)


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


    return(coding_genes_cisNATs_cor)
}


# Apply corToList function to lists
coding_genes_cisNATs_cor_list <- lapply(coding_genes_cisNATs_list, corToList)
coding_genes_cisNATs_cor_list_wo_pollen <- lapply(coding_genes_cisNATs_list_wo_pollen, corToList)

list2env(coding_genes_cisNATs_cor_list, envir = .GlobalEnv)
list2env(coding_genes_cisNATs_cor_list_wo_pollen, envir = .GlobalEnv)




# Create expression tables with TPM ranges
coding_genes_cisNATs_0.5_2 <- coding_genes_cisNATs_0.5 %>% filter(!(id %in% coding_genes_cisNATs_2$id))
coding_genes_cisNATs_0.5_2_wo_pollen <- coding_genes_cisNATs_0.5_wo_pollen %>% filter(!(id %in% coding_genes_cisNATs_2_wo_pollen$id))
coding_genes_cisNATs_2_5 <- coding_genes_cisNATs_2 %>% filter(!(id %in% coding_genes_cisNATs_5$id))
coding_genes_cisNATs_2_5_wo_pollen <- coding_genes_cisNATs_2_wo_pollen %>% filter(!(id %in% coding_genes_cisNATs_5_wo_pollen$id))



# Write final data tables to csv files and store them in /out_dir/output/data_tables
if (!dir.exists(file.path(out_dir, "output", "data_tables"))) dir.create(file.path(out_dir, "output", "data_tables"), recursive = TRUE)
write.table(coding_genes_cisNATs_0.5_2, file=file.path(out_dir, "output", "data_tables", "coding_genes_cisNATs_0.5_2.csv"), sep=";", dec=".", row.names=FALSE, col.names=TRUE)
write.table(coding_genes_cisNATs_0.5_2_wo_pollen, file=file.path(out_dir, "output", "data_tables", "coding_genes_cisNATs_0.5_2_wo_pollen.csv"), sep=";", dec=".", row.names=FALSE, col.names=TRUE)
write.table(coding_genes_cisNATs_2_5, file=file.path(out_dir, "output", "data_tables", "coding_genes_cisNATs_2_5.csv"), sep=";", dec=".", row.names=FALSE, col.names=TRUE)
write.table(coding_genes_cisNATs_2_5_wo_pollen, file=file.path(out_dir, "output", "data_tables", "coding_genes_cisNATs_2_5_wo_pollen.csv"), sep=";", dec=".", row.names=FALSE, col.names=TRUE)
write.table(coding_genes_cisNATs_5, file=file.path(out_dir, "output", "data_tables", "coding_genes_cisNATs_5.csv"), sep=";", dec=".", row.names=FALSE, col.names=TRUE)
write.table(coding_genes_cisNATs_5_wo_pollen, file=file.path(out_dir, "output", "data_tables", "coding_genes_cisNATs_5_wo_pollen.csv"), sep=";", dec=".", row.names=FALSE, col.names=TRUE)



# Generate boxplots of ATGE/DevSeq Spearman and Pearson correlation values
cisNATs_cor_0.5_2 <- subset(coding_genes_cisNATs_0.5_2, biotype == "lnc_exonic_antisense")
cisNATs_cor_0.5_2_wo_pollen <- subset(coding_genes_cisNATs_0.5_2_wo_pollen, biotype == "lnc_exonic_antisense")
cisNATs_cor_2_5 <- subset(coding_genes_cisNATs_2_5, biotype == "lnc_exonic_antisense")
cisNATs_cor_2_5_wo_pollen <- subset(coding_genes_cisNATs_2_5_wo_pollen, biotype == "lnc_exonic_antisense")
cisNATs_cor_5 <- subset(coding_genes_cisNATs_5, biotype == "lnc_exonic_antisense")
cisNATs_cor_5_wo_pollen <- subset(coding_genes_cisNATs_5_wo_pollen, biotype == "lnc_exonic_antisense")



# Generate cor lists
Spearman_05_2 <- as.numeric(unlist(cisNATs_cor_0.5_2[, 6]))
Spearman_2_5 <- as.numeric(unlist(cisNATs_cor_2_5[, 6]))
Spearman_5 <- as.numeric(unlist(cisNATs_cor_5[, 6]))
Spearman_05_2_wo_pollen <- as.numeric(unlist(cisNATs_cor_wo_pollen_0.5_2_wo_pollen[, 6]))
Spearman_2_5_wo_pollen <- as.numeric(unlist(cisNATs_cor_2_5_wo_pollen[, 6]))
Spearman_5_wo_pollen <- as.numeric(unlist(cisNATs_cor_5_wo_pollen[, 6]))
Pearson_05_2 <- as.numeric(unlist(cisNATs_cor_0.5_2[, 7]))
Pearson_2_5 <- as.numeric(unlist(cisNATs_cor_2_5[, 7]))
Pearson_5 <- as.numeric(unlist(cisNATs_cor_5[, 7]))
Pearson_05_2_wo_pollen <- as.numeric(unlist(cisNATs_cor_wo_pollen_0.5_2_wo_pollen[, 7]))
Pearson_2_5_wo_pollen <- as.numeric(unlist(cisNATs_cor_2_5_wo_pollen[, 7]))
Pearson_5_wo_pollen <- as.numeric(unlist(cisNATs_cor_5_wo_pollen[, 7]))









# Make boxplot of result
# Spearman plot
png(file = file.path(out_dir, "output", "data_tables", "Spearman.png"), width = 4250, height = 4000, res = 825)
par(mar = c(4.5, 4.5, 4, 1.5))
boxplot(Spearman_05_2, Spearman_2_5, Spearman_5, Spearman_05_2_wo_pollen, Spearman_2_5_wo_pollen, Spearman_5_wo_pollen,
	ylim = c(-1.0, 1.0), 
	names = c("0.5-2", "2-5", ">5", "0.5-2", "2-5", ">5"),
	las = 1,
	cex.axis = 1.1, #adapt size of axis labels
	xlab = "TPM", 
	ylab = "Spearman rho", 
	col = c("wheat3", "wheat1", "khaki1", "wheat3", "wheat1", "khaki1"), 
	main = "Cor between coding and cisNATs", 
	boxwex = 0.75, 
	at = c(1,2,3,4.5,5.5,6.5),
	pars = list(outcol = "gray50")
	)
	abline(v = 3.75, col="red")
	text(x= 1, y= -0.88, labels= "n=\n1271", col= "red")
	text(x= 2, y= -0.88, labels= "n=\n1200", col= "red")
	text(x= 3, y= -0.88, labels= "n=\n1110", col= "red")
	text(x= 4.5, y= -0.88, labels= "w/o\npollen", col= "red")
	text(x= 5.5, y= -0.88, labels= "w/o\npollen", col= "red")
	text(x= 6.5, y= -0.88, labels= "w/o\npollen", col= "red")
dev.off()

# Pearson plot
png(file = file.path(out_dir, "output", "data_tables", "Pearson.png"), width = 4250, height = 4000, res = 825)
par(mar = c(4.5, 4.5, 4, 1.5))
boxplot(Pearson_05_2, Pearson_2_5, Pearson_5, Pearson_05_2_wo_pollen, Pearson_2_5_wo_pollen, Pearson_5_wo_pollen,
	ylim = c(-1.0, 1.0), 
	names = c("0.5-2", "2-5", ">5", "0.5-2", "2-5", ">5"),
	las = 1,
	cex.axis = 1.1, #adapt size of axis labels
	xlab = "TPM", 
	ylab = "Pearson ρ", 
	col = c("wheat3", "wheat1", "khaki1", "wheat3", "wheat1", "khaki1"), 
	main = "Cor between coding and cisNATs", 
	boxwex = 0.75, 
	at = c(1,2,3,4.5,5.5,6.5),
	pars = list(outcol = "gray50")
	)
	abline(v = 3.75, col="red")
	text(x= 1, y= -0.88, labels= "n=\n1271", col= "red")
	text(x= 2, y= -0.88, labels= "n=\n1200", col= "red")
	text(x= 3, y= -0.88, labels= "n=\n1110", col= "red")
	text(x= 4.5, y= -0.88, labels= "w/o\npollen", col= "red")
	text(x= 5.5, y= -0.88, labels= "w/o\npollen", col= "red")
	text(x= 6.5, y= -0.88, labels= "w/o\npollen", col= "red")
dev.off()






# Wilcox rank sum test
wilcox.test(Spearman_05_2, Spearman_2_5)
wilcox.test(Spearman_05_2, Spearman_5)
wilcox.test(Spearman_2_5, Spearman_5)
wilcox.test(Spearman_05_2_wo_pollen, Spearman_2_5_wo_pollen)
wilcox.test(Spearman_05_2_wo_pollen, Spearman_5_wo_pollen)
wilcox.test(Spearman_2_5_wo_pollen, Spearman_5_wo_pollen)
wilcox.test(Pearson_05_2, Pearson_2_5)
wilcox.test(Pearson_05_2, Pearson_5)
wilcox.test(Pearson_2_5, Pearson_5)
wilcox.test(Pearson_05_2_wo_pollen, Pearson_2_5_wo_pollen)
wilcox.test(Pearson_05_2_wo_pollen, Pearson_5_wo_pollen)
wilcox.test(Pearson_2_5_wo_pollen, Pearson_5_wo_pollen)

nrow(cisNATs_cor_0.5_2)
nrow(cisNATs_cor_0.5_2_wo_pollen)
nrow(cisNATs_cor_2_5)
nrow(cisNATs_cor_2_5_wo_pollen)
nrow(cisNATs_cor_5)
nrow(cisNATs_cor_5_wo_pollen)


