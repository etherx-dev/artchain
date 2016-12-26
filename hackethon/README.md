independent analysis of the ethercamp hackethon. results and code used for analysis will be published here. 

# TO DO:

- [x] Upload code of every script used to harvest and process data.
- [x] Create list of all user ethereum address, registered to hack.ether.camp. [done](https://github.com/artchain/artchain/blob/master/hackethon/feed.hack.ether.camp.all.txt) with reference in the readme.
- [x] Create a list of all facebook account profiles which have voted.
- [ ] Create list of all account voting times [in progress, shows time voted and facebook data here](https://github.com/artchain/artchain/blob/master/hackethon/numberofVotes.py)
- [ ] Create list of all times user votes were granted by the project owner account (Hack.ether.camp backend) to users whom voted/registered.
- [ ] Diplay data of voting patern times, in corrolation to their signup. and their sister accounts.
- [ ] Create list of all facebook accounts, linked to users whom voted. This can be compiled from finding facebook profile id's corrolating to their votes, and their vote time on the blockchain corrolating to their feed [feed.hack.ether.camp.all.txt](https://github.com/artchain/artchain/blob/master/hackethon/feed.hack.ether.camp.all.txt) 
- [ ] finish updating todo list

# Important Notes:

### Files in this folder:

some of the "legitimate facebook accounts" signed up to the hackathon the same second, i.e;

https://etherscan.io/address/0x1130f6cc5a138458a37a6a6096abf9194889a846

https://etherscan.io/address/0x38f47846e5527370c1c84fc9ace6b2d2f5af6993

and then voted the same second:

https://etherscan.io/tx/0x18dd01d7914cb1ecae4dee0da22e613be5a7b83094fe977e8a9d81d9e5b66c80

https://etherscan.io/tx/0x18dd01d7914cb1ecae4dee0da22e613be5a7b83094fe977e8a9d81d9e5b66c80

if you look at

https://github.com/artchain/artchain/blob/master/hackethon/vote.times.and.facebook.profiles.draft.txt

13869 Thu 22 Dec 2016 13:49:58 GMT coindashio---stop-managing-your-investments-with-spreadsheets 110 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/1405219489496997

13868 Thu 22 Dec 2016 13:49:58 GMT coindashio---stop-managing-your-investments-with-spreadsheets 110 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/10157966816675188

13867 Thu 22 Dec 2016 13:49:58 GMT coindashio---stop-managing-your-investments-with-spreadsheets 110 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/10154869220033934

13866 Thu 22 Dec 2016 13:49:58 GMT coindashio---stop-managing-your-investments-with-spreadsheets 110 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/1367092766655220

13865 Thu 22 Dec 2016 13:49:58 GMT coindashio---stop-managing-your-investments-with-spreadsheets 110 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/10154928637089090

13864 Thu 22 Dec 2016 13:49:58 GMT coindashio---stop-managing-your-investments-with-spreadsheets 110 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/10154866536174777

at least two of these voters, whom voted for coindash with legitimate facebook accounts, signed up the same second, waited 3 hours and voted the same second.

Please comment.

https://github.com/artchain/artchain/blob/master/hackethon/vote.times.and.facebook.profiles.draft.txt
![coindash.png](https://github.com/artchain/artchain/blob/master/hackethon/images/coindash.png)
[feed.hack.ether.camp.all.txt](https://github.com/artchain/artchain/blob/master/hackethon/feed.hack.ether.camp.all.txt)

 A text file, with each line containing a json result of 5 events from the event feed of hack.ether.camp. the last feed is [page 344](https://hack.ether.camp/api/feed?group=ALL&page=344)

we can find the correlation with events on the smart contract for kudos later on, then find out which votes belong to which facebook id, voting partern and more.

tool used to create this file: [fetchhackEvents.py](https://github.com/artchain/artchain/blob/master/hackethon/fetchhackEvents.py)


[mapRegistered.py](https://github.com/artchain/artchain/blob/master/hackethon/mapRegistered.py)

hackergold kudos contract address: 0x5e569e1ecd56fe30dd97ee233ec1675b60fb6680


### Last Block Mined before the End of Hackergold Event (Thu, 22 Dec 2016 14:00:00 GMT):

![reference](https://raw.githubusercontent.com/artchain/artchain/master/hackethon/images/lastminedbeforeeventend.PNG)

https://etherscan.io/block/2855592 (Dec-22-2016 01:59:42 GMT)

reference:
   
    uint constant HACKATHON_5_WEEKS = 60 * 60 * 24 * 7 * 5;
    uint constant T_1_WEEK = 60 * 60 * 24 * 7;

    uint eventStart = 1479391200; // Thu, 17 Nov 2016 14:00:00 GMT
    
[EventInfo.sol#L11](https://github.com/artchain/artchain/blob/master/contract/DST/EventInfo.sol#L11)

### Creator and Owner of ProjectKudos

[0x7baf96ee63017cc63d7da8df51fb04d4c3a7ef7b](https://etherscan.io/address/0x7baf96ee63017cc63d7da8df51fb04d4c3a7ef7b)

![reference](https://raw.githubusercontent.com/artchain/artchain/master/hackethon/images/txinfo.PNG)

[reference](https://etherscan.io/tx/0x3a732ee2f56b0ee7a8f6f74d5f99ec5b3d0632f31603460cd1eda0f957b2512e)

### Contract of ProjectKudos, the contract of which all Registered Voters, Camps, Votes, info and the times of these executions.

[0x5e569e1ecd56fe30dd97ee233ec1675b60fb6680](https://etherscan.io/address/0x5e569e1ecd56fe30dd97ee233ec1675b60fb6680)

![reference](https://raw.githubusercontent.com/artchain/artchain/master/hackethon/images/projectkudoscontract.PNG)

[reference](https://etherscan.io/address/0x5e569e1ecd56fe30dd97ee233ec1675b60fb6680#code)

