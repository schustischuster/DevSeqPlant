# Prepare_ES_data_for_webpage - EvoSeq transcript expression data version from 20210528
# TPM expression estimates normalized by DESeq2
# This script prepares DevSeq E.salsugineum expression data input for DevSeqPlant mySQL database
# Input format of DevSeq expression table is as follows:
# transcript_id / DEVSEQ_SAMPLE_REPLICATES(24/27samples for table w/w/o pollen)

devseq_transcripts_input_file <- "ES_transcripts_inter_norm_tpm_mat_deseq_sample_names.csv"
devseq_transcripts_input_file_pol <- "ES_transcripts_intra_norm_tpm_mat_deseq_sample_names.csv"


# Read raw data
devseq_transcripts_all_samples <- read.table(file=file.path(in_dir, "ES", devseq_transcripts_input_file), sep=";", dec=".", header=TRUE, stringsAsFactors = FALSE)
devseq_transcripts_all_samples_pol <- read.table(file=file.path(in_dir, "ES", devseq_transcripts_input_file_pol), sep=";", dec=".", header=TRUE, stringsAsFactors = FALSE)


devseq_transcripts_all_samples <- tibble::rownames_to_column(devseq_transcripts_all_samples, "id")
devseq_transcripts_all_samples_pol <- tibble::rownames_to_column(devseq_transcripts_all_samples_pol, "id")



####################################################################################################
####### Add pollen data from intra-organ normalization TPM tables
# Pollen can not be normalized with the other samples, it has very specific transcriptome profile


devseq_transcripts_all_samples_pol <- devseq_transcripts_all_samples_pol[c("id", 
	"flowers_mature_pollen_7w.8w.17d_.1.", "flowers_mature_pollen_7w.8w.17d_.2.","flowers_mature_pollen_7w.8w.17d_.3.")]

devseq_transcripts_all_samples <- merge(devseq_transcripts_all_samples, devseq_transcripts_all_samples_pol, by = "id")


####################################################################################################



# Change name of id column
names(devseq_transcripts_all_samples)[names(devseq_transcripts_all_samples) == 'id'] <- 'transcript_id'


# Set final order of samples
devseq_transcripts_all_samples = devseq_transcripts_all_samples %>% select(
			transcript_id, 
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
replicate_names <- unique(gsub('.{4}$', "", names(devseq_transcripts_all_samples[2:ncol(devseq_transcripts_all_samples)])))
devseq_col_names <- c("transcript_id", replicate_names)


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
devseq_replicate_transcripts <- calculateAvgExpr(devseq_transcripts_all_samples)
colnames(devseq_replicate_transcripts) <- devseq_col_names



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
devseq_transcripts_all_samples_RE <- getRE(devseq_transcripts_all_samples)
devseq_replicate_transcripts_RE <- getRE(devseq_replicate_transcripts)



# Round values to two digits (database numeric columns are formated to Decimal[2])
round_df <- function(x, digits) {
    numeric_columns <- sapply(x, mode) == 'numeric'
    x[numeric_columns] <-  round(x[numeric_columns], digits)
    x
}

devseq_transcripts_all_samples <- round_df(devseq_transcripts_all_samples, 2)
devseq_transcripts_all_samples_RE <- round_df(devseq_transcripts_all_samples_RE, 2)

devseq_replicate_transcripts <- round_df(devseq_replicate_transcripts, 2)
devseq_replicate_transcripts_RE <- round_df(devseq_replicate_transcripts_RE, 2)


# Add gene ID
sample_tb <- list(devseq_transcripts_all_samples = devseq_transcripts_all_samples, 
	devseq_transcripts_all_samples_RE = devseq_transcripts_all_samples_RE, 
	devseq_replicate_transcripts = devseq_replicate_transcripts, 
	devseq_replicate_transcripts_RE = devseq_replicate_transcripts_RE)

addGeneId <- function(x) {

	x$gene_id <- x$transcript_id
	x$gene_id <- gsub("\\..*","",x$gene_id)
	x$gene_id <- gsub("\\m","m.g",x$gene_id)
	x <- x %>% select(transcript_id, gene_id, everything())
	return(x)
}

tb_ls <- lapply(sample_tb, addGeneId)
list2env(tb_ls, globalenv())


# Write final data tables to csv files and store them in /out_dir/output/data_tables
if (!dir.exists(file.path(out_dir, "output", "data_tables"))) dir.create(file.path(out_dir, "output", "data_tables"), recursive = TRUE)
write.table(devseq_transcripts_all_samples, file=file.path(out_dir, "output", "data_tables", "ES_devseq_transcripts_all_samples.csv"), sep=";", dec=".", row.names=FALSE, col.names=TRUE)
write.table(devseq_transcripts_all_samples_RE, file=file.path(out_dir, "output", "data_tables", "ES_devseq_transcripts_all_samples_RE.csv"), sep=";", dec=".", row.names=FALSE, col.names=TRUE)
write.table(devseq_replicate_transcripts, file=file.path(out_dir, "output", "data_tables", "ES_devseq_replicate_transcripts.csv"), sep=";", dec=".", row.names=FALSE, col.names=TRUE)
write.table(devseq_replicate_transcripts_RE, file=file.path(out_dir, "output", "data_tables", "ES_devseq_replicate_transcripts_RE.csv"), sep=";", dec=".", row.names=FALSE, col.names=TRUE)




