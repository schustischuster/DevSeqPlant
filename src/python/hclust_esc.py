from collections import OrderedDict
import sys, json
import scipy
import scipy.cluster.hierarchy as sch
import pandas as pd
import matplotlib


# Load the data from json file (only if >400 genes selected)
try:
   with open('/Applications/XAMPP/xamppfiles/htdocs/inputfile.json', 'r') as inputfile:
      data = json.load(inputfile, object_pairs_hook=OrderedDict) 
except (ValueError, TypeError, IndexError, KeyError) as e:
     print (json.dumps({'error': str(e)}))
     sys.exit(1)

data2 = json.loads(json.dumps(data))


####################### Perform data clustering here #########################

# create pandas data frame
df = pd.DataFrame(data2)

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
with open('/Applications/XAMPP/xamppfiles/htdocs/outputfile.json', 'w') as outputfile:
   json.dump(ordered_data, outputfile)
