#!/usr/bin/env python
# -*- coding: utf-8 -*- 
import time, urllib2, json, re, datetime
from selenium import webdriver

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
#coindash count
voteNumberOfCoindash = 0
voteNumberOfCoindash100 = 0
voteNumberOfCoindash110 = 0
voteNumberOfCoindash210 = 0
#artchain count
voteNumberOfArtchain = 0
voteNumberOfArtchain100 = 0
voteNumberOfArtchain110 = 0
voteNumberOfArtchain210 = 0
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
				timecreated = event['createdAt'] 
				timecreated = time.strftime("%a %d %b %Y %H:%M:%S GMT", time.gmtime(timecreated / 1000.0))
				print event['id'],timecreated,event['campSlug'],eventheader,"http://facebook.com/"+avatarUrl
		if "voted to Coindash.io" in eventheader:
			voteNumberOfCoindash = voteNumberOfCoindash+1
		if "voted to artchain" in eventheader:
			voteNumberOfArtchain = voteNumberOfArtchain+1
		if "100 voted to Coindash.io" in eventheader:
			voteNumberOfCoindash100 = voteNumberOfCoindash100+1
		if "110 voted to Coindash.io" in eventheader:
			voteNumberOfCoindash110 = voteNumberOfCoindash110+1
		if "210 voted to Coindash.io" in eventheader:
			voteNumberOfCoindash210 = voteNumberOfCoindash210+1
		if "100 voted to artchain" in eventheader:
			voteNumberOfArtchain100 = voteNumberOfArtchain100+1
		if "110 voted to artchain" in eventheader:
			voteNumberOfArtchain110 = voteNumberOfArtchain110+1
		if "210 voted to artchain" in eventheader:
			voteNumberOfArtchain210 = voteNumberOfArtchain210+1
				
			
	numberofvotes=numberofvotes+1
## Sample. Interesting Data:
# 13570 Wed 21 Dec 2016 17:35:23 GMT coindashio---stop-managing-your-investments-with-spreadsheets 100 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/1753280241660693
# 13567 Wed 21 Dec 2016 17:05:54 GMT coindashio---stop-managing-your-investments-with-spreadsheets 110 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/385398465126749
# 13566 Wed 21 Dec 2016 17:04:03 GMT coindashio---stop-managing-your-investments-with-spreadsheets 110 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/358344034528340
# 13565 Wed 21 Dec 2016 17:02:43 GMT coindashio---stop-managing-your-investments-with-spreadsheets 110 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/660226354159581
# 13564 Wed 21 Dec 2016 17:02:14 GMT coindashio---stop-managing-your-investments-with-spreadsheets 110 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/1283514715027623
# 13563 Wed 21 Dec 2016 16:57:13 GMT coindashio---stop-managing-your-investments-with-spreadsheets 110 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/10206029689740263
# 13562 Wed 21 Dec 2016 16:56:53 GMT coindashio---stop-managing-your-investments-with-spreadsheets 110 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/1141083572679555
# 13560 Wed 21 Dec 2016 16:55:54 GMT coindashio---stop-managing-your-investments-with-spreadsheets 110 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/954332991377875
# 13556 Wed 21 Dec 2016 16:53:03 GMT coindashio---stop-managing-your-investments-with-spreadsheets 110 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/185854725216276
# 13553 Wed 21 Dec 2016 16:50:05 GMT coindashio---stop-managing-your-investments-with-spreadsheets 110 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/425876697802699
# 13552 Wed 21 Dec 2016 16:49:43 GMT coindashio---stop-managing-your-investments-with-spreadsheets 110 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/1888719398014940
# 13551 Wed 21 Dec 2016 16:49:24 GMT coindashio---stop-managing-your-investments-with-spreadsheets 220 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/1863545213930109
# 13550 Wed 21 Dec 2016 16:47:53 GMT coindashio---stop-managing-your-investments-with-spreadsheets 110 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/1044995245629711
# 13549 Wed 21 Dec 2016 16:47:44 GMT coindashio---stop-managing-your-investments-with-spreadsheets 110 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/340854329640877
# 13545 Wed 21 Dec 2016 16:47:04 GMT decentralized-court 110 voted to Decentralized Court http://facebook.com/1764499177204976
# 13548 Wed 21 Dec 2016 16:47:04 GMT coindashio---stop-managing-your-investments-with-spreadsheets 110 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/365025987199501
# 13547 Wed 21 Dec 2016 16:47:04 GMT coindashio---stop-managing-your-investments-with-spreadsheets 220 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/362612577435286
# 13546 Wed 21 Dec 2016 16:47:04 GMT coindashio---stop-managing-your-investments-with-spreadsheets 220 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/385498868461113
# 13544 Wed 21 Dec 2016 16:45:14 GMT coindashio---stop-managing-your-investments-with-spreadsheets 110 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/291125054619263
# 13543 Wed 21 Dec 2016 16:44:43 GMT coindashio---stop-managing-your-investments-with-spreadsheets 1 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/342491272804415
# 13541 Wed 21 Dec 2016 16:43:04 GMT coindashio---stop-managing-your-investments-with-spreadsheets 220 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/213293145745848
# 13540 Wed 21 Dec 2016 16:43:04 GMT coindashio---stop-managing-your-investments-with-spreadsheets 220 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/1271737662883168
# 13537 Wed 21 Dec 2016 16:41:54 GMT coindashio---stop-managing-your-investments-with-spreadsheets 110 voted to Coindash.io - Stop managing your investments with spreadsheets! http://facebook.com/349600945421427
print numberofvotes #477
print "Vote Number Of Coindash= "+str(voteNumberOfCoindash)
print "Vote Number Of Artchain= "+str(voteNumberOfArtchain)
print "Votes to Coindash ========================================"
print "Vote Number Of Coindash 100= "+str(voteNumberOfCoindash100)
print "Vote Number Of Coindash 110= "+str(voteNumberOfCoindash110)
print "Vote Number Of Coindash 210= "+str(voteNumberOfCoindash210)
print "Total= "+str(voteNumberOfCoindash210*210+voteNumberOfCoindash110*110+voteNumberOfCoindash100*100)
print "Votes to Artchain ========================================"
print "Vote Number Of Artchain 100= "+str(voteNumberOfArtchain100)
print "Vote Number Of Artchain 110= "+str(voteNumberOfArtchain110)
print "Vote Number Of Artchain 210= "+str(voteNumberOfArtchain210)
print "Total= "+str(voteNumberOfArtchain210*210+voteNumberOfArtchain110*110+voteNumberOfArtchain100*100)
#Vote Number Of Coindash= 283
#Vote Number Of Artchain= 148
#Votes to Coindash ========================================
#Vote Number Of Coindash 100= 10
#Vote Number Of Coindash 110= 171
#Vote Number Of Coindash 210= 4
#Total= 20650
#Votes to Artchain ========================================
#Vote Number Of Artchain 100= 3
#Vote Number Of Artchain 110= 90
#Vote Number Of Artchain 210= 21
#Total= 14610
		#{"header":"New camp Demo Camp was created","description":"The platform of <hack.ether.camp> is ongoing experiment \naiming to give any person on the planned financial potential \nto create a startup. We are connecting the worlds of the \nsocial networks and smart contracts, we study how filter and \npush real innovation to front lines to give backers a good \nchase to identify the best opportunities upfront.","code":"DEM","coverUrl":"/api/files/images/5","campName":"Demo Camp"}
