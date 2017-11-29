INSERT INTO `Students` (`sid`, `sname`, `status`) VALUES
(1, 'Adam', 'Senior'),
(2, 'Sarah', 'Freshman'),
(3, 'Jeff', 'Junior'),
(4, 'Jason', 'Sophomore'),
(5, 'Ted', 'Senior'),
(6, 'Eve', 'Senior'),
(7, 'Ethan', 'Freshman'),
(8, 'Alex', 'Junior'),
(9, 'Taylor', 'Sophomore'),
(10, 'Danny', 'Freshman');

INSERT INTO `Teachers` (`tid`, `tname`, `position`) VALUES
(1, 'Sally', 'Professor'),
(2, 'Harold', 'Professor'),
(3, 'John', 'Professor'),
(4, 'Jack', 'Professor'),
(5, 'Rose', 'Professor'),
(6, 'Sam', 'Professor'),
(7, 'Tom', 'Professor'),
(8, 'Larry', 'Professor'),
(9, 'Caleb', 'Professor'),
(10, 'Grant', 'Professor');

INSERT INTO `Classes` (`cid`, `tid`, `cname`, `subject`) VALUES
(1, 1, 'European Studies', 'History'),
(2, 4, 'Calculus 4', 'Mathematics'),
(3, 10, 'Organic Chemistry', 'Chemistry'),
(4, 2, 'Ethics', 'English'),
(5, 3, 'Database Management Systems', 'Computer Science');

INSERT INTO `Enrolled` (`sid`, `cid`) VALUES
(1, 1),
(2, 1),
(3, 2),
(4, 3),
(1, 2);

INSERT INTO `WeightOfGrades` (`aid`, `cid`, `aname`, `weight`) VALUES
(1, 1, 'Exam', 50),
(2, 2, 'Homework', 25),
(3, 3, 'quiz', 30),
(4, 4, 'Canvas', 10),
(5, 5, 'Case Study', 15);

INSERT INTO `ClassesWork` (`cid`, `aid`, `sid`, `grade`) VALUES
(1, 1, 1, 100),
(2, 3, 2, 70),
(3, 3, 3, 60),
(4, 4, 1, 0),
(5, 5, 4, 80);


