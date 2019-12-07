<?php
$con = mysqli_connect("localhost","root","");
if (!$con)
{
    die('Could not connect: ' . mysqli_error($con));
}

if (mysqli_query($con,"CREATE DATABASE CourseDatabase DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci"))
{
    echo "Database created<br>";
} else
    {
    echo "Error creating database: " . mysqli_error($con);
}

$student = "CREATE TABLE student("
    . "student_id int not null,"
    . "student_name varchar(10) not null,"
    . "dept_name varchar(10) not null,"
    . "primary key (student_id)) charset=utf8";
$teacher = "CREATE TABLE teacher("
    . "teacher_id int not null,"
    . "teacher_name varchar(10) not null,"
    . "dept_name varchar(10) not null,"
    . "primary key (teacher_id)) charset=utf8;";
$classroom = "CREATE TABLE classroom("
    . "building_name varchar(10) not null,"
    . "room_number int not null,"
    . "room_capacity int not null,"
    . "primary key (building_name, room_number)) charset=utf8;";
$time_slot = "CREATE TABLE time_slot("
    . "time_id int not null auto_increment,"
    . "day int not null,"
    . "start_time varchar(20) ,"
    . "end_time varchar(20) not null,"
    . "primary key (time_id)) charset=utf8;";
$course = "CREATE TABLE course("
    . "course_id varchar(20) not null,"
    . "course_name varchar(20) not null,"
    . "credits int not null,"
    . "dept_name varchar(10) not null,"
    . "primary key (course_id)) charset=utf8;";
$section = "CREATE TABLE section("
    . "course_id varchar(20) not null,"
    . "section_id int not null,"
    . "semester int not null,"
    . "school_year int not null,"
    . "section_capacity int not null,"
    . "building_name varchar(10) not null,"
    . "room_number int not null,"
    . "time_id int not null,"
    . "primary key (course_id, section_id, semester, school_year),"
    . "foreign key (building_name, room_number) references classroom(building_name, room_number),"
    . "foreign key (time_id) references time_slot(time_id),"
    . "foreign key (course_id) references course(course_id)) charset=utf8;";
$exam = "CREATE TABLE exam("
    . "course_id varchar(20) not null,"
    . "section_id int not null,"
    . "semester int not null,"
    . "school_year int not null,"
    . "type int not null,"
    . "building_name varchar(10) ,"
    . "room_number int ,"
    . "time_id int not null,"
    . "primary key (course_id, section_id, semester, school_year), "
    . "foreign key (course_id, section_id, semester, school_year) references section(course_id, section_id, semester, school_year), "
    . "foreign key (building_name, room_number) references classroom(building_name, room_number), "
    . "foreign key (time_id) references time_slot(time_id) ) charset=utf8;";
$apply = "CREATE TABLE apply("
    . "student_id int not null,"
    . "teacher_id int not null,"
    . "course_id varchar(20) not null,"
    . "section_id int not null,"
    . "semester int not null,"
    . "school_year int not null,"
    . "primary key (student_id, teacher_id, course_id, section_id, semester, school_year), "
    . "foreign key (student_id) references student(student_id),"
    . "foreign key (teacher_id) references teacher(teacher_id),"
    . "foreign key (course_id, section_id, semester, school_year) references section(course_id, section_id, semester, school_year)) charset=utf8;";
$takes = "CREATE TABLE takes("
    . "student_id int not null,"
    . "course_id varchar(20) not null,"
    . "section_id int not null,"
    . "semester int not null,"
    . "school_year int not null,"
    . "primary key (student_id, course_id, section_id, semester, school_year), "
    . "foreign key (student_id) references student(student_id),"
    . "foreign key (course_id, section_id, semester, school_year) references section(course_id, section_id, semester, school_year)) charset=utf8;";
$drops = "CREATE TABLE drops("
    . "student_id int not null,"
    . "course_id varchar(20) not null,"
    . "section_id int not null,"
    . "semester int not null,"
    . "school_year int not null,"
    . "primary key (student_id, course_id, section_id, semester, school_year), "
    . "foreign key (student_id) references student(student_id),"
    . "foreign key (course_id, section_id, semester, school_year) references section(course_id, section_id, semester, school_year)) charset=utf8;";
$teaches = "CREATE TABLE teaches("
    . "teacher_id int not null,"
    . "course_id varchar(20) not null,"
    . "section_id int not null,"
    . "semester int not null,"
    . "school_year int not null,"
    . "primary key (teacher_id, course_id, section_id, semester, school_year), "
    . "foreign key (teacher_id) references teacher(teacher_id),"
    . "foreign key (course_id, section_id, semester, school_year) references section(course_id, section_id, semester, school_year)) charset=utf8;";

mysqli_query($con,'SET NAMES UTF8');
mysqli_select_db($con, "CourseDatabase");

if(mysqli_query($con, $student)){
    echo "create table student successes!<br>";
    mysqli_query($con,"INSERT INTO student (student_id, student_name, dept_name) VALUES (17011001, '陈靖元', '软件工程')");
    mysqli_query($con,"INSERT INTO student (student_id, student_name, dept_name) VALUES (17011002, '王嵩立', '软件工程')");
    mysqli_query($con,"INSERT INTO student (student_id, student_name, dept_name) VALUES (17011003, '颜谋福', '软件工程')");
    mysqli_query($con,"INSERT INTO student (student_id, student_name, dept_name) VALUES (17011004, '姜向阳', '软件工程')");
    mysqli_query($con,"INSERT INTO student (student_id, student_name, dept_name) VALUES (17011005, '周子裕', '软件工程')");
    mysqli_query($con,"INSERT INTO student (student_id, student_name, dept_name) VALUES (17011006, '周子裕', '软件工程')");
}else{
    echo "create table student fails!<br>";
}

if(mysqli_query($con, $teacher)){
    echo "create table teacher successes!<br>";
    mysqli_query($con,"INSERT INTO teacher (teacher_id, teacher_name, dept_name) VALUES (17014001, '陈靖元', '软件工程')");
    mysqli_query($con,"INSERT INTO teacher (teacher_id, teacher_name, dept_name) VALUES (17014002, '王嵩立', '软件工程')");
    mysqli_query($con,"INSERT INTO teacher (teacher_id, teacher_name, dept_name) VALUES (17014003, '颜谋福', '软件工程')");
    mysqli_query($con,"INSERT INTO teacher (teacher_id, teacher_name, dept_name) VALUES (17014004, '姜向阳', '软件工程')");
}else{
    echo "create table teacher fails!<br>";
}


if(mysqli_query($con, $classroom)){
    echo "create table classroom successes!<br>";
    mysqli_query($con,"INSERT INTO classroom (building_name, room_number, room_capacity ) VALUES ('光华楼', 2204, 100)");
    mysqli_query($con,"INSERT INTO classroom (building_name, room_number, room_capacity ) VALUES ('光华楼', 2205, 100)");
    mysqli_query($con,"INSERT INTO classroom (building_name, room_number, room_capacity ) VALUES ('光华楼', 2206, 110)");
}else{
    echo "create table classroom fails!<br>";
}


if(mysqli_query($con, $time_slot)){
    echo "create table time_slot successes!<br>";
    mysqli_query($con,"INSERT INTO time_slot(time_id, day, start_time, end_time ) VALUES (null,1, null,'12:00')");
    mysqli_query($con,"INSERT INTO time_slot(time_id, day, start_time, end_time ) VALUES (null,2, '8:00', '9:00')");
    mysqli_query($con,"INSERT INTO time_slot(time_id, day, start_time, end_time ) VALUES (null,3, '13:00', '15:00')");
    mysqli_query($con,"INSERT INTO time_slot(time_id, day, start_time, end_time ) VALUES (null,1, null, '23:59')");
}else{
    echo "create table time_slot fails!<br>";

}


if(mysqli_query($con, $course)){
    echo "create table course successes!<br>";
    mysqli_query($con,"INSERT INTO course(course_id, course_name, credits, dept_name) VALUES ('SOFT1301', '数据库设计', 4, '软件工程')");
    mysqli_query($con,"INSERT INTO course(course_id, course_name, credits, dept_name) VALUES ('SOFT1302', '概率论', 4, '软件工程')");
    mysqli_query($con,"INSERT INTO course(course_id, course_name, credits, dept_name) VALUES ('SOFT1303', '软件工程', 4, '软件工程')");
}else{
    echo "create table course fails!<br>";
}


if(mysqli_query($con, $section)){
    echo "create table section successes!<br>";
    mysqli_query($con,"INSERT INTO section(course_id,section_id,semester,school_year,section_capacity,building_name,room_number,time_id) 
        VALUES ('SOFT1301',1,2,2017,80,'光华楼',2204, 2)");
    mysqli_query($con,"INSERT INTO section(course_id,section_id,semester,school_year,section_capacity,building_name,room_number,time_id) 
        VALUES ('SOFT1301',2,2,2017,80,'光华楼',2205, 2)");
    mysqli_query($con,"INSERT INTO section(course_id,section_id,semester,school_year,section_capacity,building_name,room_number,time_id) 
        VALUES ('SOFT1302',1,2,2017,80,'光华楼',2204, 3)");
    mysqli_query($con,"INSERT INTO section(course_id,section_id,semester,school_year,section_capacity,building_name,room_number,time_id) 
        VALUES ('SOFT1302',2,2,2017,80,'光华楼',2205, 3)");
}else{
    echo "create table section fails!<br>";
}


if(mysqli_query($con, $exam)){
    echo "create table exam successes!<br>";
    mysqli_query($con,"INSERT INTO exam(course_id,section_id,semester,school_year,type,building_name,room_number,time_id) 
        VALUES ('SOFT1302',2,2,2017,0,'光华楼',2205, 3)");
    mysqli_query($con,"INSERT INTO exam(course_id,section_id,semester,school_year,type,building_name,room_number,time_id) 
        VALUES ('SOFT1302',1,2,2017,1,null ,null , 4)");
}else{
    echo "create table exam fails!<br>";
}


if(mysqli_query($con, $apply)){
    echo "create table apply successes!<br>";
    mysqli_query($con,"INSERT INTO apply(student_id,teacher_id,course_id,section_id,semester,school_year) 
        VALUES (17011001,17014001,'SOFT1301',2,2,2017)");
    mysqli_query($con,"INSERT INTO apply(student_id,teacher_id,course_id,section_id,semester,school_year) 
        VALUES (17011002,17014002,'SOFT1301',2,2,2017)");
}else{
    echo "create table apply fails!<br>";
}


if(mysqli_query($con, $takes)){
    echo "create table takes successes!<br>";
    mysqli_query($con,"INSERT INTO takes(student_id,course_id,section_id,semester,school_year) 
        VALUES (17011002,'SOFT1302',2,2,2017)");
    mysqli_query($con,"INSERT INTO takes(student_id,course_id,section_id,semester,school_year) 
        VALUES (17011003,'SOFT1302',2,2,2017)");
}else{
    echo "create table takes fails!<br>";
}


if(mysqli_query($con, $drops)){
    echo "create table drops successes!<br>";
    mysqli_query($con,"INSERT INTO drops(student_id,course_id,section_id,semester,school_year) 
        VALUES (17011002,'SOFT1302',2,2,2017)");
    mysqli_query($con,"INSERT INTO drops(student_id,course_id,section_id,semester,school_year) 
        VALUES (17011003,'SOFT1302',2,2,2017)");
}else{
    echo "create table drops fails!<br>";
}


if(mysqli_query($con, $teaches)){
    echo "create table teaches successes!<br>";
    mysqli_query($con,"INSERT INTO teaches(teacher_id,course_id,section_id,semester,school_year) 
        VALUES (17014004,'SOFT1302',2,2,2017)");
}else{
    echo "create table teaches fails!<br>";
}

mysqli_close($con);

?>
