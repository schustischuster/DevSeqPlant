R scripts for preparing mySQL data imput.

### Required Packages
Install and load the following R packages before running the reproducible scripts:

```R
# Required packages
lib_List <- c("dplyr", "data.table", "tidyr")

# Install missing packages
instpack <- lib_List %in% installed.packages()[,"Package"]
if (any(instpack == FALSE)) {
  install.packages(lib_List[!instpack])
}

# Load packages
invisible(lapply(lib_List, library, character.only = TRUE))

```
