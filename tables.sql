CREATE TABLE Teachers(
	tid INT NOT NULL AUTO_INCREMENT,
	tname VARCHAR(100) NOT NULL,
	position VARCHAR(50) NOT NULL,
	PRIMARY KEY(tid)
);

CREATE TABLE Students(
	sid INT NOT NULL AUTO_INCREMENT,
	sname VARCHAR(50) NOT NULL,
	`status` VARCHAR(10) NOT NULL,
	PRIMARY KEY(sid)
);

CREATE TABLE Classes(
	cid INT NOT NULL AUTO_INCREMENT,
	tid INT NOT NULL,
	cname VARCHAR(50) NOT NULL,
	subject VARCHAR(50) NOT NULL,
	PRIMARY KEY(cid),
	FOREIGN KEY (tid) REFERENCES Teachers(tid)
);

CREATE TABLE Enrolled(
	sid INT NOT NULL,
	cid INT NOT NULL,
	UNIQUE (`sid`, `cid`),
	FOREIGN KEY (sid) REFERENCES Students(sid),
	FOREIGN KEY (cid) REFERENCES Classes(cid)
);

CREATE TABLE WeightOfGrades(
	aid INT NOT NULL AUTO_INCREMENT,
	cid INT NOT NULL,
	aname VARCHAR(50) NOT NULL,
	weight INT NOT NULL,
	PRIMARY KEY(aid),
	UNIQUE(cid, aname),
	FOREIGN KEY (cid) REFERENCES Classes(cid)
);


CREATE TABLE ClassesWork(
	cid INT NOT NULL,
	aid INT NOT NULL,
	sid INT NOT NULL,
	grade INT NOT NULL,
	PRIMARY KEY(cid, aid, sid),
	FOREIGN KEY (cid) REFERENCES Classes(cid),
	FOREIGN KEY (sid) REFERENCES Students(sid)
);
