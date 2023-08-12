from collections import OrderedDict
import sys, json
import scipy
import scipy.cluster.hierarchy as sch
import pandas as pd


# Load the data that PHP sent
try:
     data = json.loads(sys.argv[1], object_pairs_hook=OrderedDict) 

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

print (json.dumps(ordered_data))
