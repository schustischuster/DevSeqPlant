# Prepare_ATH_replicate_data_for_webpage
# This script prepares DevSeq A.thaliana expression data for DevSeq webpage database
# input for queries >1250 entities, which outputs merged replicate expression values
# Input format of DevSeq expression table is as follows:
# id / symbol / biotype / source / DEVSEQ_SAMPLE_REPLICATES(132samples)
# Check: depending on input file version, input format could be without symbols
# id / biotype / source / DEVSEQ_SAMPLE_REPLICATES(132samples)
# In that case, load gene_ids_araport_gene_symbol file and add gene symbols to
# devseq expression table


# Install and load the following R packages
if (!require(dplyr)) install.packages('dplyr')
library(dplyr)


# Set directory
setwd("/Volumes/User/Shared/Christoph_manuscript/DevSeq_paper/Analysis/Analysis_2019/A_thaliana_gene_exression_map/DevSeq_ATH_averaged_replicates_for_webpage")
setwd(file.path("data", "20190801"))


# Read raw data
devseq_input_file <- "No_TE_genes_tpm_sample_names_20190801.csv"
devseq_all_samples <- read.table(file=devseq_input_file, sep=";", dec=".", header=TRUE, stringsAsFactors = FALSE)
id_symbol_input_file <- "Gene_IDs_ATH_names_wo_dupl.csv"
gene_id_symbol_list <- read.table(file=id_symbol_input_file, sep=";", dec=".", header=TRUE, stringsAsFactors = FALSE)


# Create string of colnames for merged replicates
# Adjust columns that need to be excluded to table format of devseq input raw data!
replicate_names <- unique(gsub('.{2}$', "", names(devseq_all_samples[4:ncol(devseq_all_samples)])))
devseq_col_names <- c("gene_id", "symbol", replicate_names)



####################################################################################################
####### Optional: prepare gene_id-symbol list and add symbols to DevSeq ATH expression table #######
# This step is only required if ATH input data table does not contain a symbol column

all_devseq_genes <- as.data.frame(devseq_all_samples[, 1])
names(all_devseq_genes) <- c("id")

gene_names_id <- as.data.frame(gene_id_symbol_list[, 1])
names(gene_names_id) <- c("id")

devseq_genes_wo_symbol <- anti_join(all_devseq_genes, gene_names_id, by = "id")
devseq_genes_wo_symbol$symbol = devseq_genes_wo_symbol$id
gene_names_all_genes <- rbind(gene_id_symbol_list, devseq_genes_wo_symbol)

addGeneSymbols <- function(df) {
		    df <- merge(df, gene_names_all_genes[, c("id", "symbol")], by="id")
		    df = df %>% select(id, symbol, everything())
		    df <- df[order(df$id),]
		}

devseq_all_samples <- addGeneSymbols(devseq_all_samples)

####################################################################################################



# Merge replicates
calculateAvgExpr <- function(df) {

	# Split data frame by sample replicates into a list
	# then get rowMeans for each subset, simplify output and bind to first two columns
	
	averaged_replicates <- data.frame(df[1:2],

		sapply(split.default(df[5:ncol(df)], 
			rep(seq_along(df), 
			each = 3, 
			length.out=ncol(df)-4)
			), rowMeans)
		)
		
	return(averaged_replicates)
}


# Apply calculateAvgExpr function and add column names
devseq_replicate_samples <- calculateAvgExpr(devseq_all_samples)
colnames(devseq_replicate_samples) <- devseq_col_names


# Set final order of samples
devseq_replicate_samples = devseq_replicate_samples %>% select(
			gene_id, 
			symbol, 
			root_root_tip_5d, 
			root_maturation_zone_5d, 
			root_whole_root_5d, 
			root_whole_root_7d, 
			root_whole_root_14d, 
			root_whole_root_21d, 
			hypocotyl_10d, 
			third_internode_24d, 
			second_internode_24d, 
			first_internode_28d., 
			cotyledons_7d, 
			leaf_1.2_7d, 
			leaf_1.2_10d, 
			leaf_1.2_petiole_10d, 
			leaf_1.2_leaf_tip_10d, 
			leaf_5.6_17d, 
			leaf_9.10_27d, 
			leaf_senescing_35d, 
			cauline_leaves_24d, 
			apex_vegetative_7d, 
			apex_vegetative_10d, 
			apex_vegetative_14d, 
			apex_inflorescence_21d, 
			apex_inflorescence_28d, 
			apex_inflorescence_clv1_21d., 
			flower_stg9_21d., 
			flower_stg10_11_21d., 
			flower_stg12_21d., 
			flower_stg15_21d., 
			flower_stg12_sepals_21d., 
			flower_stg15_sepals_21d., 
			flower_stg12_petals_21d., 
			flower_stg15_petals_21d., 
			flower_stg12_stamens_21d., 
			flower_stg15_stamens_21d., 
			flowers_mature_pollen_28d, 
			flower_early_stg12_carpels_21d., 
			flower_late_stg12_carpels_21d., 
			flower_stg15_carpels_21d., 
			fruit_stg16_siliques_28d., 
			fruit_stg17a_siliques_28d., 
			fruit_stg16_seeds_28d., 
			fruit_stg17a_seeds_28d., 
			fruit_stg18_seeds_28d.
			)


# Change row names to the final ones
# These names are the samples names for mySQL table and DevSeq wep application
colnames(devseq_replicate_samples) <- c(
			"gene_id", 
			"symbol", 
			"root_root_tip_5d", 
			"root_maturation_zone_5d", 
			"root_whole_root_5d", 
			"root_whole_root_7d", 
			"root_whole_root_14d", 
			"root_whole_root_21d", 
			"hypocotyl_10d", 
			"third_internode_24d", 
			"second_internode_24d", 
			"first_internode_28d", 
			"cotyledons_7d", 
			"leaf_1_2_7d", 
			"leaf_1_2_10d", 
			"leaf_1_2_petiole_10d", 
			"leaf_1_2_leaf_tip_10d", 
			"leaf_5_6_17d", 
			"leaf_9_10_27d", 
			"leaves_senescing_35d", 
			"cauline_leaves_24d", 
			"apex_vegetative_7d", 
			"apex_vegetative_10d", 
			"apex_vegetative_14d", 
			"apex_inflorescence_21d", 
			"apex_inflorescence_28d", 
			"apex_inflorescence_clv1_21d", 
			"flower_stg9_21d", 
			"flower_stg10_11_21d", 
			"flower_stg12_21d", 
			"flower_stg15_21d", 
			"flower_stg12_sepals_21d", 
			"flower_stg15_sepals_21d", 
			"flower_stg12_petals_21d", 
			"flower_stg15_petals_21d", 
			"flower_stg12_stamens_21d", 
			"flower_stg15_stamens_21d", 
			"flowers_mature_pollen_28d", 
			"flower_early_stg12_carpels_21d", 
			"flower_late_stg12_carpels_21d", 
			"flower_stg15_carpels_21d", 
			"fruit_stg16_siliques_28d", 
			"fruit_stg17a_siliques_28d", 
			"fruit_stg16_seeds_28d", 
			"fruit_stg17a_seeds_28d", 
			"fruit_stg18_seeds_28d"
			)


# Write final data tables to csv files
setwd("..")
setwd("..")
dir.create(file.path("output", "data_tables"), recursive = TRUE)
setwd(file.path("output", "data_tables"))
write.table(devseq_replicate_samples, file="devseq_replicate_samples.csv", sep=";", dec=".", row.names=FALSE, col.names=TRUE)

