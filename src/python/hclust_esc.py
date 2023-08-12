from collections import OrderedDict
import sys, json
import os.path
import scipy
import scipy.cluster.hierarchy as sch
import pandas as pd


sess_id = json.loads(sys.argv[1])

sess_infile = "_inputfile.json"
sess_outfile = "_outputfile.json"

conc_in_file = sess_id + sess_infile
conc_out_file = sess_id + sess_outfile

root = '/var/www/devseqplant.org/files'

file_path_input = os.path.join(root, conc_in_file)
file_path_output = os.path.join(root, conc_out_file)


# Load the data from json file (only if >400 genes selected)
try:
   with open(file_path_input, 'r') as inputfile:
      data = json.load(inputfile, object_pairs_hook=OrderedDict) 
except (ValueError, TypeError, IndexError, KeyError) as e:
     print (json.dumps({'error': str(e)}))
     sys.exit(1)


####################### Perform data clustering here #########################

# create pandas data frame
df = pd.DataFrame(data)

# invert pandas dataframe
dfinv=df.T

# compute distance matrix and dendrogram
Y = sch.linkage(dfinv, method='average', metric='euclidean', optimal_ordering=True)
Z = sch.dendrogram(Y, no_plot=True)

# select leaves from dendrogram
index = Z['leaves']

# get gene IDs from pandas data frame
ident = dfinv.index.values

# reorder pandas data frame recording to hclust computed indexes
ident_reord = ident[index]


################# Apply rearranged gene ID string to data ####################

myorder = ident_reord
ordered_data = OrderedDict((k, data[k]) for k in myorder)

# write hclust reordred data to json outputfile
with open(file_path_output, 'w') as outputfile:
   json.dump(ordered_data, outputfile)
