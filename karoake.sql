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

CREATE TABLE Band ( bandId integer AUTO_INCREMENT, name Char(255), primary key (bandId));
CREATE TABLE Song ( songId integer AUTO_INCREMENT, name Char(255), bandId int, primary key (songId), FOREIGN KEY (bandId) REFERENCES Band (bandId));
CREATE TABLE BandMember( bandMemberId integer AUTO_INCREMENT, name Char(255), instrument Char(255), bandId int, primary key (bandMemberId), FOREIGN KEY (bandId) REFERENCES Band (bandId));
CREATE TABLE Requester ( requesterId integer AUTO_INCREMENT, name Char(255), primary key (requesterId)); 
CREATE TABLE Request ( requestId integer AUTO_INCREMENT, paid BOOL, amountpaid int, songId int, requesterId int, hasplayed BOOL, primary key (requestId), FOREIGN KEY (songId) REFERENCES Song (songId), FOREIGN KEY (requesterId) REFERENCES Requester (requesterId)); 
