import time, urllib2, json, re

## check hack.ether.camp.memberaccounts.distinct.txt for list of users signed up @ 16:09 GMT 22/12/2016
## find list of transactions by their address, write into c:\Users\em\Desktop\hack.ether.camp.memberaccounts.txlist.txt for further analysis.

def gettxlist(address):
    url = "http://api.etherscan.io/api?module=account&action=txlist&address="+address+"&startblock=0&endblock=99999999&sort=asc&apikey=JG9W6QD5CZFHBBSSSZVNZG3JXE3DAJYFBC"
    response = urllib2.urlopen(url)
    data = json.loads(response.read())
    return data

addresslist = []
with open('c:\Users\em\Desktop\hack.ether.camp.memberaccounts.distinct.txt', 'r') as _:
    for line in _:
        line = line.strip()
        if line:
            addresslist.append(line)
accounttxdata = []
f = open("c:\Users\em\Desktop\hack.ether.camp.memberaccounts.txlist.txt", 'w')
i = 0
for address in addresslist:
    txlist = gettxlist("0x"+address)
    f.write("%s\n" % address)
    i = i+1
    print txlist, i
f.close()
