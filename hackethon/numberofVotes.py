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
			print event['id'],event['createdAt'],event['campSlug'],eventheader
			numberofvotes=numberofvotes+1
print numberofvotes
		#{"header":"New camp Demo Camp was created","description":"The platform of <hack.ether.camp> is ongoing experiment \naiming to give any person on the planned financial potential \nto create a startup. We are connecting the worlds of the \nsocial networks and smart contracts, we study how filter and \npush real innovation to front lines to give backers a good \nchase to identify the best opportunities upfront.","code":"DEM","coverUrl":"/api/files/images/5","campName":"Demo Camp"}
