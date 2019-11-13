# Prepare_ATH_replicate_data_for_webpage
# This script prepares DevSeq A.thaliana expression data for DevSeq webpage database
# input for queries >1250 entities, which outputs merged replicate expression values
# Input format of DevSeq expression table is as follows:
# id / biotype / source / info / DEVSEQ_SAMPLE_REPLICATES(132samples)
# Check: depending on input file version, input format could be different,
# e.g. it could include symbols


# Install and load the following R packages
if (!require(dplyr)) install.packages('dplyr')
library(dplyr)


# Set file path and input files
in_dir <- "/Volumes/User/Shared/Christoph_manuscript/DevSeq_paper/Analysis/Analysis_2019/A_thaliana_gene_exression_map/DevSeq_ATH_averaged_replicates_for_webpage/data/20190801"
out_dir <- "/Volumes/User/Shared/Christoph_manuscript/DevSeq_paper/Analysis/Analysis_2019/A_thaliana_gene_exression_map/DevSeq_ATH_averaged_replicates_for_webpage"

devseq_transcripts_input_file <- "No_TE_transcripts_tpm_sample_names_20190801.csv"
id_symbol_input_file <- "Gene_IDs_ATH_names_wo_dupl.csv"


# Read raw data
devseq_transcripts_all_samples <- read.table(file=file.path(in_dir, devseq_transcripts_input_file), sep=";", dec=".", header=TRUE, stringsAsFactors = FALSE)
gene_id_symbol_list <- read.table(file=file.path(in_dir, id_symbol_input_file), sep=";", dec=".", header=TRUE, stringsAsFactors = FALSE)
names(gene_id_symbol_list) <- c("gene_id", "symbol")


# Create string of colnames for merged replicates
# Adjust columns that need to be excluded to table format of devseq input raw data!
replicate_names <- unique(gsub('.{2}$', "", names(devseq_transcripts_all_samples[5:ncol(devseq_transcripts_all_samples)])))
devseq_col_names <- c("isoform_id", "gene_id", "symbol", replicate_names)


# Add gene_id column
devseq_transcripts_all_samples$gene_id = devseq_transcripts_all_samples$id
devseq_transcripts_all_samples$gene_id <- sub("*\\.[0-9]", "", devseq_transcripts_all_samples$gene_id)
devseq_transcripts_all_samples = devseq_transcripts_all_samples %>% select(id, gene_id, everything())


####################################################################################################
####### Optional: prepare gene_id-symbol list and add symbols to DevSeq ATH expression table #######
# This step is only required if ATH input data table does not contain a symbol column

all_devseq_genes <- as.data.frame(devseq_transcripts_all_samples[, 2])
names(all_devseq_genes) <- c("gene_id")
all_devseq_genes <- unique(all_devseq_genes)

gene_names_id <- as.data.frame(gene_id_symbol_list[, 1])
names(gene_names_id) <- c("gene_id")

devseq_genes_wo_symbol <- anti_join(all_devseq_genes, gene_names_id, by = "gene_id")
devseq_genes_wo_symbol$symbol = devseq_genes_wo_symbol$gene_id
gene_names_all_genes <- rbind(gene_id_symbol_list, devseq_genes_wo_symbol)

addGeneSymbols <- function(df) {
		    df <- merge(df, gene_names_all_genes[, c("gene_id", "symbol")], by="gene_id")
		    df = df %>% select(id, gene_id, symbol, everything())
		    df <- df[order(df$id),]
		}

devseq_transcripts_all_samples <- addGeneSymbols(devseq_transcripts_all_samples)

####################################################################################################



# Remove all rows that only contain "0"
devseq_transcripts_all_samples <- devseq_transcripts_all_samples[which(rowMeans(devseq_transcripts_all_samples[,-1:-6, drop = FALSE]) > 0),]


# Merge replicates
calculateAvgExpr <- function(df) {

	# Split data frame by sample replicates into a list
	# then get rowMeans for each subset, simplify output and bind to first two columns
	
	averaged_replicates <- data.frame(df[1:3],

		sapply(split.default(df[7:ncol(df)], 
			rep(seq_along(df), 
			each = 3, 
			length.out=ncol(df)-6)
			), rowMeans)
		)
		
	return(averaged_replicates)
}


# Apply calculateAvgExpr function and add column names
devseq_replicate_transcripts <- calculateAvgExpr(devseq_transcripts_all_samples)
colnames(devseq_replicate_transcripts) <- devseq_col_names


# Set final order of samples
devseq_replicate_transcripts = devseq_replicate_transcripts %>% select(
			isoform_id, 
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



# The following wrapper function calculates relative expression (RE)
# it scales all expression values to the range between 0 and 1

getRE <- function(x) { 

	devseq_RE <- data.frame(x[1:3], 
        as.data.frame(t(apply(x[,c(4:ncol(x))], 1, # transposes matrix output from apply function
	    
	    normalize <- function(x) {
		
		    # calculate relative expression
		    calculateRE <- function(x) {
		    	(x - min(x, na.rm = TRUE)) / 
		    	(max(x, na.rm = TRUE) - min(x, na.rm = TRUE))
		    }
		    x <- calculateRE(x)

		    return(x)
		}
	)))
    )
}

# Apply getRE function
devseq_replicate_transcripts_RE <- getRE(devseq_replicate_transcripts)



# Write final data tables to csv files and store them in /out_dir/output/data_tables
if (!dir.exists(file.path(out_dir, "output", "data_tables"))) dir.create(file.path(out_dir, "output", "data_tables"), recursive = TRUE)
write.table(devseq_replicate_transcripts, file=file.path(out_dir, "output", "data_tables", "devseq_replicate_transcripts.csv"), sep=";", dec=".", row.names=FALSE, col.names=TRUE)
write.table(devseq_replicate_transcripts_RE, file=file.path(out_dir, "output", "data_tables", "devseq_replicate_transcripts_RE.csv"), sep=";", dec=".", row.names=FALSE, col.names=TRUE)




