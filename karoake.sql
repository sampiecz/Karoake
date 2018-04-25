###########################################################
# CSCI 466 - Group Project - Spring 2018                  #
#                                                         #
# Progammer: Sam Piecz                                    #
# Z-ID: Z1732715                                          #
# Section: 3                                              #
# TA: Rajarshi Sen                                        #
# Date Due: Apr 30, 2018                                  # 
# Purpose: Karoake web app for djs.                       # 
###########################################################

CREATE TABLE Band ( bandId integer AUTO_INCREMENT, name Char(255));
CREATE TABLE Song ( songId integer AUTO_INCREMENT, name Char(255), bandId int, FOREIGN KEY (bandId) REFERENCES Band (bandId));
CREATE TABLE BandMember( bandMemberId integer AUTO_INCREMENT, name Char(255), instrument Char(255), bandId int, FOREIGN KEY (bandId) REFERENCES Band (bandId));
CREATE TABLE Requester ( requesterId integer AUTO_INCREMENT, name Char(255)); 
CREATE TABLE Request ( requestId integer AUTO_INCREMEMNT, paid bool, amountpaid int, songId int, requesterId int, FOREIGN KEY (songId) REFERENCES Song (songId), FOREIGN KEY (requesterId) REFERENCES Requester (reqeusterId)); 
