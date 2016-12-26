import time, urllib2, json
url = "http://api.etherscan.io/api?module=account&action=txlist&address=0x5e569e1ecd56fe30dd97ee233ec1675b60fb6680&startblock=0&endblock=2855592&sort=asc&apikey=JG9W6QD5CZFHBBSSSZVNZG3JXE3DAJYFBC"
response = urllib2.urlopen(url)
data = json.loads(response.read())

## hackergold kudos contract address: 0x5e569e1ecd56fe30dd97ee233ec1675b60fb6680
## checks ethercamp kudos contract and finds all accounts registered. creates 2 sets of arrays, one with distinct users. 
## Results are ethereum address's belonging to the hack.ether.camp users
## will be documented later on.
## check hack.ether.camp.memberaccounts.txt & hack.ether.camp.memberaccounts.distinct.txt for results until (Dec-22-2016 01:59:42 GMT)
### Last Block Mined before the End of Hackergold Event (Thu, 22 Dec 2016 14:00:00 GMT):
### https://etherscan.io/block/2855592 (Dec-22-2016 01:59:42 GMT)

addresslist = []

for row in data['result']:
    if row['input'] and row['input'].startswith("0xab01b469"):
        theinput = str(row['input'])
        caddress = str.replace(theinput, "0xab01b469000000000000000000000000", "")
        addressa = str.replace(caddress, "0000000000000000000000000000000000000000000000000000000000000000", "")
        addressb = str.replace(addressa, "0000000000000000000000000000000000000000000000000000000000000002", "")
        address =  str.replace(addressb, "0000000000000000000000000000000000000000000000000000000000000001", "")
        print address
        addresslist.append(address) # add ethereum address of all users registered with ethercamp to array
distinctlist = list(set(addresslist)) # remove duplicates
print len(addresslist) # 1878 at time of first test
f = open("./hack.ether.camp.memberaccounts.final.txt", 'w')
for address in addresslist:
  f.write("%s\n" % address)
f = open("./hack.ether.camp.memberaccounts.distinct.final.txt", 'w')
for address in distinctlist:
  f.write("%s\n" % address)
