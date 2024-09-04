# Prepare_ES_data_for_webpage - EvoSeq gene expression data version from 20210528
# TPM expression estimates normalized by DESeq2
# This script prepares DevSeq E.salsugineum expression data input for DevSeqPlant mySQL database
# Input format of DevSeq expression table is as follows:
# id / DEVSEQ_SAMPLE_REPLICATES(24/27samples for table w/w/o pollen)


devseq_genes_input_file <- "ES_genes_inter_norm_tpm_mat_deseq_sample_names.csv"
devseq_genes_input_file_pol <- "ES_genes_intra_norm_tpm_mat_deseq_sample_names.csv"


# Read raw data
devseq_genes_all_samples <- read.table(file=file.path(in_dir, "ES", devseq_genes_input_file), sep=";", dec=".", header=TRUE, stringsAsFactors = FALSE)
devseq_genes_all_samples_pol <- read.table(file=file.path(in_dir, "ES", devseq_genes_input_file_pol), sep=";", dec=".", header=TRUE, stringsAsFactors = FALSE)


devseq_genes_all_samples <- tibble::rownames_to_column(devseq_genes_all_samples, "id")
devseq_genes_all_samples_pol <- tibble::rownames_to_column(devseq_genes_all_samples_pol, "id")



####################################################################################################
####### Add pollen data from intra-organ normalization TPM tables
# Pollen can not be normalized with the other samples, it has very specific transcriptome profile


devseq_genes_all_samples_pol <- devseq_genes_all_samples_pol[c("id", 
	"flowers_mature_pollen_7w.8w.17d_.1.", "flowers_mature_pollen_7w.8w.17d_.2.","flowers_mature_pollen_7w.8w.17d_.3.")]

devseq_genes_all_samples <- merge(devseq_genes_all_samples, devseq_genes_all_samples_pol, by = "id")


####################################################################################################



# Change name of id column
names(devseq_genes_all_samples)[names(devseq_genes_all_samples) == 'id'] <- 'gene_id'


# Set final order of samples
devseq_genes_all_samples = devseq_genes_all_samples %>% select(
			gene_id, 
			root_whole_root_6d_.1.:flower_stg12_7w.8w.15d_.3.,
			flower_mid_stg12_stamens_7w.8w.17d_.1.,
			flower_mid_stg12_stamens_7w.8w.17d_.2.,
			flower_mid_stg12_stamens_7w.8w.17d_.3.,
			flowers_mature_pollen_7w.8w.17d_.1.,
			flowers_mature_pollen_7w.8w.17d_.2.,
			flowers_mature_pollen_7w.8w.17d_.3.,
			flower_early_stg12_carpels_7w.8w.18d_.1.,
			flower_early_stg12_carpels_7w.8w.18d_.2.,
			flower_early_stg12_carpels_7w.8w.18d_.3.
			)


# Create string of colnames for merged replicates
# Adjust columns that need to be excluded to table format of devseq input raw data!
replicate_names <- unique(gsub('.{4}$', "", names(devseq_genes_all_samples[2:ncol(devseq_genes_all_samples)])))
devseq_col_names <- c("gene_id", replicate_names)


# Merge replicates
calculateAvgExpr <- function(df) {

	# Split data frame by sample replicates into a list
	# then get rowMeans for each subset, simplify output and bind to first two columns
	
	averaged_replicates <- data.frame(df[1],

		sapply(split.default(df[2:ncol(df)], 
			rep(seq_along(df), 
			each = 3, 
			length.out=ncol(df)-1)
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

	devseq_RE <- data.frame(x[1], 
        as.data.frame(t(apply(x[,c(2:ncol(x))], 1, # transposes matrix output from apply function
	    
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
write.table(devseq_genes_all_samples, file=file.path(out_dir, "output", "data_tables", "ES_devseq_genes_all_samples.csv"), sep=";", dec=".", row.names=FALSE, col.names=TRUE)
write.table(devseq_genes_all_samples_RE, file=file.path(out_dir, "output", "data_tables", "ES_devseq_genes_all_samples_RE.csv"), sep=";", dec=".", row.names=FALSE, col.names=TRUE)
write.table(devseq_replicate_genes, file=file.path(out_dir, "output", "data_tables", "ES_devseq_replicate_genes.csv"), sep=";", dec=".", row.names=FALSE, col.names=TRUE)
write.table(devseq_replicate_genes_RE, file=file.path(out_dir, "output", "data_tables", "ES_devseq_replicate_genes_RE.csv"), sep=";", dec=".", row.names=FALSE, col.names=TRUE)




