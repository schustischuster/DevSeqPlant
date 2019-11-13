
# This code is to read in DevSeq data mapping statistics and write them in JSON format 
#----------------------------------------------------------------------------------------------------------------------------------------------------------

# Set working directory
setwd("/Volumes/User/Shared/Christoph_manuscript/DevSeq_paper/Analysis/Analysis_2019/A_thaliana_gene_exression_map/Excel-R-JSON_Parser")
# List all files in working directory
list.files(path="./")

# Load libraries
library(dplyr)
library(corrplot)
library(jsonlite)

######################################################################################

 # Read mapping statistic tables tables; 
 # Create Seperate Tables and write as JSON

######################################################################################


# Read data files as table; Use ";" separator; Use "." for decimal separator
ATH_mappings_input <- "./ATH_mappings.tsv"
ATH_mappings <- read.table(ATH_mappings_input, sep="\t", dec=".", header=TRUE)
ncol(ATH_mappings)
nrow(ATH_mappings)
ATH_mappings[1:3,]
colnames(ATH_mappings)=c("DevSeq_sample", "Description", "Raw_Reads", "Mapped_Reads", "Mapped_Deduplicated_Reads")



# Create seperate tables for raw reads, mapped reads and mapped_deduplicated reads
ATH_Raw_Reads <- subset(ATH_mappings, select = c(2:3))
ncol(ATH_Raw_Reads)
nrow(ATH_Raw_Reads)
ATH_Raw_Reads[1:3,]
ATH_Mapped_Reads <- subset(ATH_mappings, select = c(2,4))
ncol(ATH_Mapped_Reads)
nrow(ATH_Mapped_Reads)
ATH_Mapped_Reads[1:3,]
ATH_Deduplicated_Reads <- subset(ATH_mappings, select = c(2,5))
ncol(ATH_Deduplicated_Reads)
nrow(ATH_Deduplicated_Reads)
ATH_Deduplicated_Reads[1:3,]


# Export JSON
names(ATH_Raw_Reads) <- NULL
ATH_Raw_Reads_exportJSON <- toJSON(ATH_Raw_Reads)
write(ATH_Raw_Reads_exportJSON, "ATH_raw_data.json")
names(ATH_Mapped_Reads) <- NULL
ATH_Mapped_Reads_exportJSON <- toJSON(ATH_Mapped_Reads)
write(ATH_Mapped_Reads_exportJSON, "ATH_rmapped_data.json")
names(ATH_Deduplicated_Reads) <- NULL
ATH_Deduplicated_Reads_exportJSON <- toJSON(ATH_Deduplicated_Reads)
write(ATH_Deduplicated_Reads_exportJSON, "ATH_deduplicated_data.json")

