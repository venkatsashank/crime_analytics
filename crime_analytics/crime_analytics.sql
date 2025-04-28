CREATE DATABASE crime_analytics;
USE crime_analytics;
-- 1. location table
CREATE TABLE location (
    Location_ID INT AUTO_INCREMENT PRIMARY KEY,
    Address VARCHAR(255),
    City VARCHAR(100),
    State VARCHAR(100),
    Zip_Code VARCHAR(20),
    Latitude DECIMAL(9,6),
    Longitude DECIMAL(9,6)
);

-- 2. suspect table
CREATE TABLE suspect (
    Suspect_ID INT AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(100),
    Age INT,
    Gender VARCHAR(10),
    Criminal_History TEXT,
    Address_ID INT,
    FOREIGN KEY (Address_ID) REFERENCES location(Location_ID)
);

-- 3. victim table
CREATE TABLE victim (
    Victim_ID INT AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(100),
    Age INT,
    Gender VARCHAR(10),
    Address_ID INT,
    Contact_Information VARCHAR(255),
    FOREIGN KEY (Address_ID) REFERENCES location(Location_ID)
);

-- 4. officer table
CREATE TABLE officer (
    Officer_ID INT AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(100),
    Badge_Number VARCHAR(50),
    Ranks VARCHAR(50),
    Department VARCHAR(100),
    Contact_Information VARCHAR(255)
);

-- 5. crime table
CREATE TABLE crime (
    Crime_ID INT AUTO_INCREMENT PRIMARY KEY,
    Crime_Type VARCHAR(100),
    Date_Time DATETIME,
    Location_ID INT,
    Suspect_ID INT,
    Victim_ID INT,
    Officer_ID INT,
    Status VARCHAR(50),
    FOREIGN KEY (Location_ID) REFERENCES location(Location_ID),
    FOREIGN KEY (Suspect_ID) REFERENCES suspect(Suspect_ID),
    FOREIGN KEY (Victim_ID) REFERENCES victim(Victim_ID),
    FOREIGN KEY (Officer_ID) REFERENCES officer(Officer_ID)
);

-- 6. cases table
CREATE TABLE cases (
    Case_ID INT AUTO_INCREMENT PRIMARY KEY,
    Crime_ID INT,
    Investigating_Officer_ID INT,
    Status VARCHAR(50),
    Court_Details TEXT,
    Outcome VARCHAR(100),
    FOREIGN KEY (Crime_ID) REFERENCES crime(Crime_ID),
    FOREIGN KEY (Investigating_Officer_ID) REFERENCES officer(Officer_ID)
);

-- 7. evidence table
CREATE TABLE evidence (
    Evidence_ID INT AUTO_INCREMENT PRIMARY KEY,
    Crime_ID INT,
    Type VARCHAR(100),
    Description TEXT,
    Collected_By INT,
    FOREIGN KEY (Crime_ID) REFERENCES crime(Crime_ID),
    FOREIGN KEY (Collected_By) REFERENCES officer(Officer_ID)
);

-- 8. witness table
CREATE TABLE witness (
    Witness_ID INT AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(100),
    Contact_Information VARCHAR(255),
    Statement TEXT,
    Crime_ID INT,
    FOREIGN KEY (Crime_ID) REFERENCES crime(Crime_ID)
);

-- 9. court_trial table
CREATE TABLE court_trial (
    Trial_ID INT AUTO_INCREMENT PRIMARY KEY,
    Case_ID INT,
    Judge VARCHAR(100),
    Verdict VARCHAR(100),
    Sentence VARCHAR(255),
    FOREIGN KEY (Case_ID) REFERENCES cases(Case_ID)
);