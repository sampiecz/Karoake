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
CREATE TABLE Singer( singerId integer AUTO_INCREMENT, name Char(20), primary key(ownerId), paid bool() );
CREATE TABLE Band( bandId integer AUTO_INCREMENT,  bandmemberId int, FOREIGN KEY (songId) REFERENCES Song (songId) );
CREATE TABLE Song( songId integer AUTO_INCREMENT, title char(20), contributorId int, FOREIGN KEY (contributorId) REFERENCES Contributor (contributorId), );
CREATE TABLE Contributor( contributorId integer AUTO_INCREMENT, songId int, singerId int, FOREIGN KEY (songId) REFERENCES Song (songId), FOREIGN KEY (singerId) REFERENCES (singerId));
CREATE TABLE KaroakeFile( fileId integer AUTO_INCREMENT, singerId int, songId int, contributorId int, FOREIGN KEY (singerId) REFERENCES Singer (singerId), FOREIGN KEY (songId) REFERENCES Song (songId));
CREATE TABLE Queue( queueId integer AUTO_INCREMENT, position int, paid bool, fileId int, FOREIGN KEY (fileId) REFERENCES Karoake (fileId), );
