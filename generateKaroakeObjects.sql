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

DROP TABLE IF EXISTS Request;
DROP TABLE IF EXISTS Requester;
DROP TABLE IF EXISTS BandMember;
DROP TABLE IF EXISTS Song;
DROP TABLE IF EXISTS Band;

CREATE TABLE Band
(
    bandId integer AUTO_INCREMENT,
    name Char(255),
    primary key (bandId)
);

CREATE TABLE Song
(
    songId integer AUTO_INCREMENT,
    name Char(255),
    bandId int,
    primary key (songId),
    FOREIGN KEY (bandId) REFERENCES Band (bandId)
);

CREATE TABLE BandMember
(
    bandMemberId integer AUTO_INCREMENT,
    name Char(255),
    instrument Char(255),
    bandId int,
    primary key (bandMemberId),
    FOREIGN KEY (bandId) REFERENCES Band (bandId)
);

CREATE TABLE Requester
(
    requesterId integer AUTO_INCREMENT,
    name Char(255),
    primary key (requesterId)
); 

CREATE TABLE Request
(
    requestId integer AUTO_INCREMENT,
    paid BOOL,
    amountpaid int,
    songId int,
    requesterId int,
    hasplayed BOOL,
    primary key (requestId),
    FOREIGN KEY (songId) REFERENCES Song (songId),
    FOREIGN KEY (requesterId) REFERENCES Requester (requesterId)
); 

# Generate Band, Band Members, and Song
INSERT INTO Band (name) VALUES ("Death Grips");
INSERT INTO BandMember (name, instrument, bandId) VALUES ('MC Ride', 'Front Man', 1); 
INSERT INTO BandMember (name, instrument, bandId) VALUES ('Zach Hill', 'Drummer', 1);
INSERT INTO BandMember (name, instrument, bandId) VALUES ('Andy Morin', 'Recording Engineer', 1);
INSERT INTO Song (name, bandId) VALUES ('Hacker', 1); 

# Generate Requester, and Request
INSERT INTO Requester (name) VALUES ('Dr. Freeman');
INSERT INTO Request (paid, amountpaid, songId, requesterId, hasplayed) VALUES (True, 70, 1, 1, False); 
INSERT INTO Request (paid, amountpaid, songId, requesterId, hasplayed) VALUES (False, 0, 1, 1, False); 



INSERT INTO Band (name) VALUES ("Linkin Park"),("Aerosmith"),("KISS"),("Wilco");
INSERT INTO BandMember (name, instrument, bandId) VALUES ('Mike Shidona', 'Pianos', 2), ('Steven Tyler', 'Lead Singer', 3),('Paul Stanley', 'Lead Vocal', 4), ('Jeff Tweedy', 'Guitars', 5);
INSERT INTO Song (name, bandId) VALUES ('Numb', 2),('Dream On',3),('Lick it up',4),('Handshanke Drugs',5); 

# Generate Requester, and Request
INSERT INTO Requester (name) VALUES ('Mr. Smith'), ('Bond'),('Alex'),('Michael');
INSERT INTO Request (paid, amountpaid, songId, requesterId, hasplayed) VALUES (True, 70, 2, 2, False),(False, 0, 3, 3,True),(False, 0, 4, 4,False), (True, 10,5,5,False);

