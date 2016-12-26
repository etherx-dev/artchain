import time, urllib2, json, re

## check txlist to count any accounts related to coindash, returned 287
# https://etherscan.io/address/0x5e569e1ecd56fe30dd97ee233ec1675b60fb6680 
## this is the contract address for project kudos, belongs to hack.ether.camp. Every member creates a call to this contract, the moment of signup, the moment they link their social media profile (if they signed up with their social media profile, will be the moment of their signup so we can differentiate them too), the moments they cast votes
# https://etherscan.io/address/0x7baf96ee63017cc63d7da8df51fb04d4c3a7ef7b
## this is the contract address, owner of project kudos. can call private functions of the contract.

coindashcampid = "4352210000000000000000000000000000000000000000000000000000000000"

# f = open("../hack.ether.camp.memberaccounts.txlist.txt", 'r')
# i = 0
# for accounttxs in f:
#     if coindashcampid in accounttxs:
#         print accounttxs
#         i = i+1
#         print i # 287
# turn contents of txlist back into our array hack.ether.camp.memberaccounts.txlist.txt for processing
txlists = []
with open('../hack.ether.camp.memberaccounts.txlist.txt', 'r') as _:
	# remove all blank lines from storage
    for line in _:
        line = line.strip()
        if line:
            txlists.append(line)
for txlist in txlists:
	# load json for processing
	txlist = json.loads(txlist)
	#print txlist
	#{"status":"1","message":"OK","result":[{"blockNumber":"2752364","timeStamp":"1480944890","hash":"0x9f67e60a72ce769ff253182adcdeb1e8a7a92a224f8f62a04e070fd274d57104","nonce":"1455","blockHash":"0xd28e265d1532961a4ab884b84dc198082a5373d928e04adecfe61929d0b1910d","transactionIndex":"23","from":"0x7baf96ee63017cc63d7da8df51fb04d4c3a7ef7b","to":"0x8d5528193a6ce4e04c7014955f89c40c1b92225d","value":"165000000000000000","gas":"1000000","gasPrice":"50000000000","isError":"0","input":"0x","contractAddress":"","cumulativeGasUsed":"636598","gasUsed":"21000","confirmations":"124995"},{"blockNumber":"2771629","timeStamp":"1481218397","hash":"0xb11022e0d27b338f436fa05af69281a4e08d81719519c6ccff9b90ffdd4aa4f9","nonce":"0","blockHash":"0xf664e1cb1e7f0a1a3038ba94c1f68276d15341b46432a4b05197ddd40fe49903","transactionIndex":"2","from":"0xac7f5d3fbd4e6ffc31d1cba9df2049f056bf6d66","to":"0x8d5528193a6ce4e04c7014955f89c40c1b92225d","value":"20000000000000000","gas":"90000","gasPrice":"20000000000","isError":"0","input":"0x","contractAddress":"","cumulativeGasUsed":"129133","gasUsed":"21000","confirmations":"105730"},{"blockNumber":"2771646","timeStamp":"1481218568","hash":"0x8deaaae52011396c5a99df56363fef569ad15cb1f6ff7103f3fd535df94b524e","nonce":"0","blockHash":"0x04294ec3f4f739d2758ee58b971020c1e854c6d3989704feaddfcd26de6fcc74","transactionIndex":"0","from":"0x8d5528193a6ce4e04c7014955f89c40c1b92225d","to":"0x5e569e1ecd56fe30dd97ee233ec1675b60fb6680","value":"0","gas":"300000","gasPrice":"50000000000","isError":"0","input":"0x136d5a594352210000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000006e","contractAddress":"","cumulativeGasUsed":"172883","gasUsed":"172883","confirmations":"105713"}]}
	#to: 0x5e569e1ecd56fe30dd97ee233ec1675b60fb6680
	#0x136d5a594352210000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000006e
	#print txlist['result']
	result = txlist['result']
	for tx in result:
		#print tx['transactionIndex']
		if tx['transactionIndex'] == "0":
			print tx['timeStamp'],tx['from']