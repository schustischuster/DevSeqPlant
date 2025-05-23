# Prepare_AT_data_for_webpage - gene expression data version from 20210528
# TPM expression estimates normalized by DESeq2
# This script prepares DevSeq A.thaliana expression data input for DevSeqPlant mySQL database
# Input format of DevSeq expression table is as follows:
# id / DEVSEQ_SAMPLE_REPLICATES(132samples)
# Load gene_ids_araport_gene_symbol file and add gene symbols to devseq expression table

devseq_genes_input_file <- "AT_genes_inter_norm_tpm_mat_deseq_sample_names.csv"
devseq_genes_input_file_pol <- "AT_genes_intra_norm_tpm_mat_deseq_sample_names.csv"
id_symbol_input_file <- "Gene_IDs_ATH_names_wo_dupl.csv"


# Read raw data
devseq_genes_all_samples <- read.table(file=file.path(in_dir, "AT", devseq_genes_input_file), sep=";", dec=".", header=TRUE, stringsAsFactors = FALSE)
devseq_genes_all_samples_pol <- read.table(file=file.path(in_dir, "AT", devseq_genes_input_file_pol), sep=";", dec=".", header=TRUE, stringsAsFactors = FALSE)
gene_id_symbol_list <- read.table(file=file.path(in_dir, "AT", id_symbol_input_file), sep=";", dec=".", header=TRUE, stringsAsFactors = FALSE)


devseq_genes_all_samples <- tibble::rownames_to_column(devseq_genes_all_samples, "id")
devseq_genes_all_samples_pol <- tibble::rownames_to_column(devseq_genes_all_samples_pol, "id")



####################################################################################################
####### Optional: prepare gene_id-symbol list and add symbols to DevSeq ATH expression table #######
# This step is only required if ATH input data table does not contain a symbol column

all_devseq_genes <- as.data.frame(devseq_genes_all_samples[, 1])
names(all_devseq_genes) <- c("id")

gene_names_id <- as.data.frame(gene_id_symbol_list[, 1])
names(gene_names_id) <- c("id")

devseq_genes_wo_symbol <- anti_join(all_devseq_genes, gene_names_id, by = "id")
devseq_genes_wo_symbol$symbol <- devseq_genes_wo_symbol$id
gene_names_all_genes <- rbind(gene_id_symbol_list, devseq_genes_wo_symbol)

addGeneSymbols <- function(df) {
		    df <- merge(df, gene_names_all_genes, by = "id")
		    df = df %>% select(id, symbol, everything())
		    df <- df[order(df$id), ]
		}

devseq_genes_all_samples <- addGeneSymbols(devseq_genes_all_samples)

####################################################################################################



####################################################################################################
####### Add pollen data from intra-organ normalization TPM tables
# Pollen can not be normalized with the other samples, it has very specific transcriptome profile


devseq_genes_all_samples_pol <- devseq_genes_all_samples_pol[c("id", 
	"flowers_mature_pollen_28d_.1.", "flowers_mature_pollen_28d_.2.","flowers_mature_pollen_28d_.3.")]

devseq_genes_all_samples <- merge(devseq_genes_all_samples, devseq_genes_all_samples_pol, by = "id")


####################################################################################################



# Change name of id column
names(devseq_genes_all_samples)[names(devseq_genes_all_samples) == 'id'] <- 'gene_id'


# Set final order of samples
devseq_genes_all_samples = devseq_genes_all_samples %>% select(
			gene_id, 
			symbol, 
			root_root_tip_5d_.1., 
			root_root_tip_5d_.2., 
			root_root_tip_5d_.3., 
			root_maturation_zone_5d_.1., 
			root_maturation_zone_5d_.2., 
			root_maturation_zone_5d_.3., 
			root_whole_root_5d_.1., 
			root_whole_root_5d_.2., 
			root_whole_root_5d_.3., 
			root_whole_root_7d_.1., 
			root_whole_root_7d_.2., 
			root_whole_root_7d_.3., 
			root_whole_root_14d_.1., 
			root_whole_root_14d_.2., 
			root_whole_root_14d_.3.,
			root_whole_root_21d_.1., 
			root_whole_root_21d_.2., 
			root_whole_root_21d_.3., 
			hypocotyl_10d_.1., 
			hypocotyl_10d_.2., 
			hypocotyl_10d_.3., 
			third_internode_24d_.1., 
			third_internode_24d_.2., 
			third_internode_24d_.3., 
			second_internode_24d_.1., 
			second_internode_24d_.2., 
			second_internode_24d_.3., 
			first_internode_28d._.1., 
			first_internode_28d._.2., 
			first_internode_28d._.3., 
			cotyledons_7d_.1., 
			cotyledons_7d_.2., 
			cotyledons_7d_.3.,  
			leaf_1.2_7d_.1., 
			leaf_1.2_7d_.2., 
			leaf_1.2_7d_.3., 
			leaf_1.2_10d_.1., 
			leaf_1.2_10d_.2., 
			leaf_1.2_10d_.3., 
			leaf_1.2_petiole_10d_.1., 
			leaf_1.2_petiole_10d_.2., 
			leaf_1.2_petiole_10d_.3., 
			leaf_1.2_leaf_tip_10d_.1., 
			leaf_1.2_leaf_tip_10d_.2., 
			leaf_1.2_leaf_tip_10d_.3., 
			leaf_5.6_17d_.1., 
			leaf_5.6_17d_.2., 
			leaf_5.6_17d_.3., 
			leaf_9.10_27d_.1., 
			leaf_9.10_27d_.2., 
			leaf_9.10_27d_.3., 
			leaf_senescing_35d_.1., 
			leaf_senescing_35d_.2., 
			leaf_senescing_35d_.3., 
			cauline_leaves_24d_.1., 
			cauline_leaves_24d_.2., 
			cauline_leaves_24d_.3., 
			apex_vegetative_7d_.1., 
			apex_vegetative_7d_.2., 
			apex_vegetative_7d_.3., 
			apex_vegetative_10d_.1., 
			apex_vegetative_10d_.2., 
			apex_vegetative_10d_.3., 
			apex_vegetative_14d_.1., 
			apex_vegetative_14d_.2., 
			apex_vegetative_14d_.3., 
			apex_inflorescence_21d_.1., 
			apex_inflorescence_21d_.2., 
			apex_inflorescence_21d_.3., 
			apex_inflorescence_28d_.1., 
			apex_inflorescence_28d_.2., 
			apex_inflorescence_28d_.3., 
			apex_inflorescence_clv1_21d._.1., 
			apex_inflorescence_clv1_21d._.2., 
			apex_inflorescence_clv1_21d._.3.,  
			flower_stg9_21d._.1., 
			flower_stg9_21d._.2., 
			flower_stg9_21d._.3., 
			flower_stg10_11_21d._.1., 
			flower_stg10_11_21d._.2., 
			flower_stg10_11_21d._.3., 
			flower_stg12_21d._.1., 
			flower_stg12_21d._.2., 
			flower_stg12_21d._.3., 
			flower_stg15_21d._.1., 
			flower_stg15_21d._.2., 
			flower_stg15_21d._.3., 
			flower_stg12_sepals_21d._.1., 
			flower_stg12_sepals_21d._.2., 
			flower_stg12_sepals_21d._.3., 
			flower_stg15_sepals_21d._.1., 
			flower_stg15_sepals_21d._.2., 
			flower_stg15_sepals_21d._.3., 
			flower_stg12_petals_21d._.1., 
			flower_stg12_petals_21d._.2., 
			flower_stg12_petals_21d._.3., 
			flower_stg15_petals_21d._.1., 
			flower_stg15_petals_21d._.2., 
			flower_stg15_petals_21d._.3., 
			flower_stg12_stamens_21d._.1., 
			flower_stg12_stamens_21d._.2., 
			flower_stg12_stamens_21d._.3., 
			flower_stg15_stamens_21d._.1., 
			flower_stg15_stamens_21d._.2., 
			flower_stg15_stamens_21d._.3., 
			flowers_mature_pollen_28d_.1., 
			flowers_mature_pollen_28d_.2., 
			flowers_mature_pollen_28d_.3., 
			flower_early_stg12_carpels_21d._.1., 
			flower_early_stg12_carpels_21d._.2., 
			flower_early_stg12_carpels_21d._.3., 
			flower_late_stg12_carpels_21d._.1., 
			flower_late_stg12_carpels_21d._.2., 
			flower_late_stg12_carpels_21d._.3., 
			flower_stg15_carpels_21d._.1., 
			flower_stg15_carpels_21d._.2., 
			flower_stg15_carpels_21d._.3., 
			fruit_stg16_siliques_28d._.1., 
			fruit_stg16_siliques_28d._.2., 
			fruit_stg16_siliques_28d._.3., 
			fruit_stg17a_siliques_28d._.1., 
			fruit_stg17a_siliques_28d._.2., 
			fruit_stg17a_siliques_28d._.3., 
			fruit_stg16_seeds_28d._.1., 
			fruit_stg16_seeds_28d._.2., 
			fruit_stg16_seeds_28d._.3., 
			fruit_stg17a_seeds_28d._.1., 
			fruit_stg17a_seeds_28d._.2., 
			fruit_stg17a_seeds_28d._.3., 
			fruit_stg18_seeds_28d._.1., 
			fruit_stg18_seeds_28d._.2., 
			fruit_stg18_seeds_28d._.3.
			)



# Create string of colnames for merged replicates
# Adjust columns that need to be excluded to table format of devseq input raw data!
replicate_names <- unique(gsub('.{4}$', "", names(devseq_genes_all_samples[3:ncol(devseq_genes_all_samples)])))
replicate_names <- gsub("[.]", "", replicate_names)
devseq_col_names <- c("gene_id", "symbol", replicate_names)


# Merge replicates
calculateAvgExpr <- function(df) {

	# Split data frame by sample replicates into a list
	# then get rowMeans for each subset, simplify output and bind to first two columns
	
	averaged_replicates <- data.frame(df[1:2],

		sapply(split.default(df[3:ncol(df)], 
			rep(seq_along(df), 
			each = 3, 
			length.out=ncol(df)-2)
			), rowMeans)
		)
		
	return(averaged_replicates)
}


# Apply calculateAvgExpr function and add column names
devseq_replicate_genes <- calculateAvgExpr(devseq_genes_all_samples)
colnames(devseq_replicate_genes) <- devseq_col_names


# The following wrapper function calculates relative expression (RE)
# it scales all expression values to the range between 0 and 1

getRE <- function(x) { 

	devseq_RE <- data.frame(x[1:2], 
        as.data.frame(t(apply(x[,c(3:ncol(x))], 1, # transposes matrix output from apply function
	    
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
devseq_genes_all_samples_RE <- getRE(devseq_genes_all_samples)
devseq_replicate_genes_RE <- getRE(devseq_replicate_genes)



# Round values to two digits (database numeric columns are formated to Decimal[2])
round_df <- function(x, digits) {
    numeric_columns <- sapply(x, mode) == 'numeric'
    x[numeric_columns] <-  round(x[numeric_columns], digits)
    x
}

devseq_genes_all_samples <- round_df(devseq_genes_all_samples, 2)
devseq_genes_all_samples_RE <- round_df(devseq_genes_all_samples_RE, 2)

devseq_replicate_genes <- round_df(devseq_replicate_genes, 2)
devseq_replicate_genes_RE <- round_df(devseq_replicate_genes_RE, 2)


# Write final data tables to csv files and store them in /out_dir/output/data_tables
if (!dir.exists(file.path(out_dir, "output", "data_tables"))) dir.create(file.path(out_dir, "output", "data_tables"), recursive = TRUE)
write.table(devseq_genes_all_samples, file=file.path(out_dir, "output", "data_tables", "AT_devseq_genes_all_samples.csv"), sep=";", dec=".", row.names=FALSE, col.names=TRUE)
write.table(devseq_genes_all_samples_RE, file=file.path(out_dir, "output", "data_tables", "AT_devseq_genes_all_samples_RE.csv"), sep=";", dec=".", row.names=FALSE, col.names=TRUE)
write.table(devseq_replicate_genes, file=file.path(out_dir, "output", "data_tables", "AT_devseq_replicate_genes.csv"), sep=";", dec=".", row.names=FALSE, col.names=TRUE)
write.table(devseq_replicate_genes_RE, file=file.path(out_dir, "output", "data_tables", "AT_devseq_replicate_genes_RE.csv"), sep=";", dec=".", row.names=FALSE, col.names=TRUE)




