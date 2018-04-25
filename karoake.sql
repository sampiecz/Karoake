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

CREATE TABLE Singer( singerId integer AUTO_INCREMENT, name Char(20),  paid bool, primary key(singerId));
CREATE TABLE Song( songId integer AUTO_INCREMENT, title Char(20), primary key(songId));
CREATE TABLE Contributor( contributorId integer AUTO_INCREMENT, songId int, singerId int, primary key(contributorId), FOREIGN KEY (songId) REFERENCES Song (songId), FOREIGN KEY (singerId) REFERENCES Singer (singerId));
CREATE TABLE KaroakeFile( fileId integer AUTO_INCREMENT, singerId int, songId int, primary key (fileId), FOREIGN KEY (singerId) REFERENCES Singer (singerId), FOREIGN KEY (songId) REFERENCES Song (songId));
CREATE TABLE Queue( queueId integer AUTO_INCREMENT, position int, fileId int, primary key (queueId), FOREIGN KEY (fileId) REFERENCES KaroakeFile (fileId));
