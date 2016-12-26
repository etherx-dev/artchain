independent analysis of the ethercamp hackethon. results and code used for analysis will be published here. 

# Important Notes:

### Files in this folder:

[feed.hack.ether.camp.all.txt](https://github.com/artchain/artchain/blob/master/hackethon/feed.hack.ether.camp.all.txt)

 A text file, with each line containing a json result of 5 events from the event feed of hack.ether.camp. the last feed is [page 344](https://hack.ether.camp/api/feed?group=ALL&page=344)

we can find the correlation with events on the smart contract for kudos later on, then find out which votes belong to which facebook id, voting partern and more.

tool used to create this file: [fetchhackEvents.py](https://github.com/artchain/artchain/blob/master/hackethon/fetchhackEvents.py)


[mapRegistered.py](https://github.com/artchain/artchain/blob/master/hackethon/mapRegistered.py)

hackergold kudos contract address: 0x5e569e1ecd56fe30dd97ee233ec1675b60fb6680


### Last Block Mined before the End of Hackergold Event (Thu, 22 Dec 2016 14:00:00 GMT):

https://etherscan.io/block/2855592 (Dec-22-2016 01:59:42 GMT)

reference:
   
    uint constant HACKATHON_5_WEEKS = 60 * 60 * 24 * 7 * 5;
    uint constant T_1_WEEK = 60 * 60 * 24 * 7;

    uint eventStart = 1479391200; // Thu, 17 Nov 2016 14:00:00 GMT
    
[EventInfo.sol#L11](https://github.com/artchain/artchain/blob/master/contract/DST/EventInfo.sol#L11)

### Creator and Owner of ProjectKudos

[0x7baf96ee63017cc63d7da8df51fb04d4c3a7ef7b](https://etherscan.io/address/0x7baf96ee63017cc63d7da8df51fb04d4c3a7ef7b) - [reference](https://etherscan.io/tx/0x3a732ee2f56b0ee7a8f6f74d5f99ec5b3d0632f31603460cd1eda0f957b2512e)

### Contract of ProjectKudos, the contract of which all Registered Voters, Camps, Votes, info and the times of these executions.

[0x5e569e1ecd56fe30dd97ee233ec1675b60fb6680](https://etherscan.io/address/0x5e569e1ecd56fe30dd97ee233ec1675b60fb6680)

![reference](https://raw.githubusercontent.com/artchain/artchain/master/hackethon/images/txinfo.PNG)

[reference](https://etherscan.io/address/0x5e569e1ecd56fe30dd97ee233ec1675b60fb6680#code)

