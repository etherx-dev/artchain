#!/usr/bin/env python
# -*- coding: utf-8 -*- 
import time, urllib2, json, re


eventlist = []
with open('./feed.hack.ether.camp.all.txt', 'r') as _:
    for line in _:
        line = line.strip()
        if line:
            eventlist.append(line)
eventdata = []
i = 0
for event in eventlist:
    eventdata.append(event)
    i = i+1
    #print event, i
i = 0
numberofvotes = 0
for events in eventdata:
	eventbatch = json.loads(events)
	for event in eventbatch:
		eventdata= event['jsonData'].encode("utf-8")
		eventdata = json.loads(eventdata)
		eventheader = eventdata['header'].encode("utf-8")
		if "voted to " in eventheader:
			#print event['id'],event['createdAt'],event['campSlug'],eventheader,eventdata['avatarUrl']
			eventdatar = eventdata['avatarUrl'].encode("utf-8")
			if "facebook" in eventdatar:
				avatarUrl = str.replace(eventdatar, "https://graph.facebook.com/", "")
				avatarUrl = str.replace(avatarUrl, "/picture?height=300", "")
				print event['id'],event['createdAt'],event['campSlug'],eventheader,"http://facebook.com/profile.php?id="+avatarUrl
				numberofvotes=numberofvotes+1
## Sample. Interesting Data:
# 13736 1482408928074 coindashio---stop-managing-your-investments-with-spreadsheets 210 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/profile.php?id=10157301208300068
# 13735 1482408587772 artchain 110 voted to artchain http://facebook.com/profile.php?id=2174825116076071
# 13734 1482407778350 coindashio---stop-managing-your-investments-with-spreadsheets 110 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/profile.php?id=10205904690695294
# 13731 1482407748530 coindashio---stop-managing-your-investments-with-spreadsheets 110 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/profile.php?id=1772951679621370
# 13730 1482407748494 coindashio---stop-managing-your-investments-with-spreadsheets 220 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/profile.php?id=1172571572826163
# 13728 1482407718712 coindashio---stop-managing-your-investments-with-spreadsheets 220 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/profile.php?id=10154843926414207
# 13721 1482407608205 artchain 220 voted to artchain http://facebook.com/profile.php?id=10210599616003263
# 13711 1482406377800 coindashio---stop-managing-your-investments-with-spreadsheets 110 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/profile.php?id=10155442728654240
# 13710 1482406377769 coindashio---stop-managing-your-investments-with-spreadsheets 110 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/profile.php?id=10154723679132954
# 13705 1482405850305 coindashio---stop-managing-your-investments-with-spreadsheets 110 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/profile.php?id=10154831676455844
# 13704 1482405850274 coindashio---stop-managing-your-investments-with-spreadsheets 110 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/profile.php?id=10208163186261526
# 13703 1482405850248 coindashio---stop-managing-your-investments-with-spreadsheets 110 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/profile.php?id=360939837600389
# 13697 1482404214941 coindashio---stop-managing-your-investments-with-spreadsheets 110 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/profile.php?id=10157951325680436
# 13696 1482404214916 coindashio---stop-managing-your-investments-with-spreadsheets 110 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/profile.php?id=10209233446452053
# 13695 1482404185526 coindashio---stop-managing-your-investments-with-spreadsheets 110 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/profile.php?id=10154689411406590
# 13693 1482402922303 decentralized-court 100 voted to Decentralized Court http://facebook.com/profile.php?id=10154692247800993
# 13692 1482402741570 coindashio---stop-managing-your-investments-with-spreadsheets 110 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/profile.php?id=10154907751340559
# 13691 1482402721695 coindashio---stop-managing-your-investments-with-spreadsheets 110 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/profile.php?id=10209921254422334
# 13690 1482402701766 coindashio---stop-managing-your-investments-with-spreadsheets 110 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/profile.php?id=10154871739744850
# 13686 1482402211464 coindashio---stop-managing-your-investments-with-spreadsheets 110 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/profile.php?id=10154726232077593
# 13685 1482402211454 coindashio---stop-managing-your-investments-with-spreadsheets 110 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/profile.php?id=10157914078000173
# 13684 1482402201724 coindashio---stop-managing-your-investments-with-spreadsheets 110 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/profile.php?id=10154247857081491
# 13683 1482401811760 coindashio---stop-managing-your-investments-with-spreadsheets 110 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/profile.php?id=10154989029479683
# 13676 1482401451617 coindashio---stop-managing-your-investments-with-spreadsheets 110 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/profile.php?id=10154554088305395
# 13666 1482400417875 decentralized-hedge-fund 1 voted to decentralized hedge fund http://facebook.com/profile.php?id=10157616769430635
# 13665 1482400249884 coindashio---stop-managing-your-investments-with-spreadsheets 110 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/profile.php?id=1336468396383530
# 13664 1482400249874 coindashio---stop-managing-your-investments-with-spreadsheets 220 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/profile.php?id=10154062092975887
# 13663 1482400198116 coindashio---stop-managing-your-investments-with-spreadsheets 110 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/profile.php?id=10154184351938479
# 13662 1482400198105 coindashio---stop-managing-your-investments-with-spreadsheets 110 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/profile.php?id=10154839335652417
# 13661 1482400198091 coindashio---stop-managing-your-investments-with-spreadsheets 110 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/profile.php?id=10154798498171823
# 13660 1482400198080 coindashio---stop-managing-your-investments-with-spreadsheets 110 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/profile.php?id=1369238309754176
# 13659 1482400198070 coindashio---stop-managing-your-investments-with-spreadsheets 110 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/profile.php?id=10202682065250405
# 13658 1482400198060 coindashio---stop-managing-your-investments-with-spreadsheets 220 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/profile.php?id=10154427200182639
# 13657 1482400188142 coindashio---stop-managing-your-investments-with-spreadsheets 220 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/profile.php?id=10211744398591809
# 13642 1482390707881 artchain 110 voted to artchain http://facebook.com/profile.php?id=10154640777066539
# 13639 1482389178873 coindashio---stop-managing-your-investments-with-spreadsheets 110 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/profile.php?id=1201316109938317
# 13638 1482389178860 coindashio---stop-managing-your-investments-with-spreadsheets 220 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/profile.php?id=1288307561253740
# 13637 1482389167978 coindashio---stop-managing-your-investments-with-spreadsheets 220 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/profile.php?id=1152528448164636
# 13636 1482389127892 coindashio---stop-managing-your-investments-with-spreadsheets 110 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/profile.php?id=1481193408576751
# 13632 1482386894124 coindashio---stop-managing-your-investments-with-spreadsheets 110 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/profile.php?id=10154854990612300
# 13631 1482386883785 coindashio---stop-managing-your-investments-with-spreadsheets 110 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/profile.php?id=10154822023147720
# 13630 1482386883761 coindashio---stop-managing-your-investments-with-spreadsheets 110 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/profile.php?id=10154276040239141
# 13629 1482386883736 coindashio---stop-managing-your-investments-with-spreadsheets 220 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/profile.php?id=10153978583411174
# 13586 1482352863820 a-truly-decentralized-p2p-insurance 110 voted to etherisc http://facebook.com/profile.php?id=10208104182070839
# 13585 1482351274849 a-truly-decentralized-p2p-insurance 110 voted to etherisc http://facebook.com/profile.php?id=1185532568196551
# 13581 1482344274070 coindashio---stop-managing-your-investments-with-spreadsheets 100 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/profile.php?id=678767375635479
# 13574 1482343094011 coindashio---stop-managing-your-investments-with-spreadsheets 100 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/profile.php?id=1087840157991436
# 13572 1482341833640 coindashio---stop-managing-your-investments-with-spreadsheets 100 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/profile.php?id=1359437890780432
# 13570 1482341723892 coindashio---stop-managing-your-investments-with-spreadsheets 100 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/profile.php?id=1753280241660693
# 13567 1482339954002 coindashio---stop-managing-your-investments-with-spreadsheets 110 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/profile.php?id=385398465126749
# 13566 1482339843987 coindashio---stop-managing-your-investments-with-spreadsheets 110 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/profile.php?id=358344034528340
# 13565 1482339763828 coindashio---stop-managing-your-investments-with-spreadsheets 110 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/profile.php?id=660226354159581
# 13564 1482339734114 coindashio---stop-managing-your-investments-with-spreadsheets 110 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/profile.php?id=1283514715027623
# 13563 1482339433622 coindashio---stop-managing-your-investments-with-spreadsheets 110 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/profile.php?id=10206029689740263
# 13562 1482339413490 coindashio---stop-managing-your-investments-with-spreadsheets 110 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/profile.php?id=1141083572679555
# 13560 1482339354110 coindashio---stop-managing-your-investments-with-spreadsheets 110 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/profile.php?id=954332991377875
# 13556 1482339183521 coindashio---stop-managing-your-investments-with-spreadsheets 110 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/profile.php?id=185854725216276
# 13553 1482339005400 coindashio---stop-managing-your-investments-with-spreadsheets 110 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/profile.php?id=425876697802699
# 13552 1482338983928 coindashio---stop-managing-your-investments-with-spreadsheets 110 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/profile.php?id=1888719398014940
# 13551 1482338964790 coindashio---stop-managing-your-investments-with-spreadsheets 220 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/profile.php?id=1863545213930109
# 13550 1482338873780 coindashio---stop-managing-your-investments-with-spreadsheets 110 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/profile.php?id=1044995245629711
# 13549 1482338864353 coindashio---stop-managing-your-investments-with-spreadsheets 110 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/profile.php?id=340854329640877
# 13545 1482338824607 decentralized-court 110 voted to Decentralized Court http://facebook.com/profile.php?id=1764499177204976
# 13548 1482338824595 coindashio---stop-managing-your-investments-with-spreadsheets 110 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/profile.php?id=365025987199501
# 13547 1482338824584 coindashio---stop-managing-your-investments-with-spreadsheets 220 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/profile.php?id=362612577435286
# 13546 1482338824576 coindashio---stop-managing-your-investments-with-spreadsheets 220 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/profile.php?id=385498868461113
# 13544 1482338714264 coindashio---stop-managing-your-investments-with-spreadsheets 110 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/profile.php?id=291125054619263
# 13543 1482338683840 coindashio---stop-managing-your-investments-with-spreadsheets 1 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/profile.php?id=342491272804415
# 13541 1482338584667 coindashio---stop-managing-your-investments-with-spreadsheets 220 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/profile.php?id=213293145745848
# 13540 1482338584659 coindashio---stop-managing-your-investments-with-spreadsheets 220 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/profile.php?id=1271737662883168
print numberofvotes #477
		#{"header":"New camp Demo Camp was created","description":"The platform of <hack.ether.camp> is ongoing experiment \naiming to give any person on the planned financial potential \nto create a startup. We are connecting the worlds of the \nsocial networks and smart contracts, we study how filter and \npush real innovation to front lines to give backers a good \nchase to identify the best opportunities upfront.","code":"DEM","coverUrl":"/api/files/images/5","campName":"Demo Camp"}
