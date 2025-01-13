DROP DATABASE IF EXISTS tp1_sql;

CREATE DATABASE IF NOT EXISTS tp1_sql;

USE tp1_sql ;

CREATE TABLE dept 
(
	deptno_dept  TINYINT NOT NULL,	-- primary key
    dname_dept  VARCHAR(30) NOT NULL,
    loc_dept VARCHAR(30) NOT NULL,
    CONSTRAINT fk_num_deptno PRIMARY KEY (deptno_dept)
);

CREATE TABLE emp
(
	empno_emp SMALLINT NOT NULL,				-- primary key
    ename_emp VARCHAR(50) NOT NULL,		
    job_emp VARCHAR(50) NOT NULL,
    mgr_emp SMALLINT, 							-- cle etrangere
    hiredate_emp DATE NOT NULL,
	sal_emp SMALLINT NOT NULL,
    comm_emp SMALLINT,
    deptno_dept TINYINT, 						-- FOREIGN KEY
    CONSTRAINT fk_empno_emp PRIMARY KEY (empno_emp)
);

ALTER TABLE emp 
	ADD CONSTRAINT fk_emp_mgr_emp FOREIGN KEY(mgr_emp) REFERENCES emp(empno_emp),
    ADD CONSTRAINT fk_emp_deptno_emp FOREIGN KEY(deptno_dept) REFERENCES dept(deptno_dept);
	