
USE tp1_sql;

-- Première partie

-- 1. Donner nom, job, numéro et salaire de tous les employés,
-- puis seulement des employés du département 10
	
SELECT ename_emp, job_emp, empno_emp, sal_emp
FROM emp;

SELECT ename_emp, job_emp, empno_emp, sal_emp, deptno_dept
FROM emp
WHERE deptno_dept = 10 ;


-- 2. Donner nom, job et salaire des employés de type MANAGER dont le salaire est supérieur à 2800

SELECT ename_emp, job_emp, sal_emp
FROM emp
WHERE job_emp = "MANAGER" AND sal_emp >= 2800; 

-- 3. Donner la liste des MANAGER n'appartenant pas au département 30

SELECT ename_emp, deptno_dept
FROM emp
WHERE job_emp = "MANAGER" AND deptno_dept <> 30;		-- <> diffend comme !=

-- 4. Liste des employés de salaire compris entre 1200 et 1400

SELECT ename_emp, sal_emp
FROM emp
WHERE sal_emp BETWEEN  1200 AND 1400;

/*
UPDATE emp
SET sal_emp = 1199
WHERE ename_emp = "Martin";
*/

-- 5. Liste des employés des départements 10 et 30  et 40 classés dans l'ordre alphabétique

SELECT ename_emp, deptno_dept
FROM emp
WHERE deptno_dept IN(40,10,30) ORDER BY  ename_emp ASC; 

/*
UPDATE emp
SET deptno_dept = 40 
WHERE empno_emp = 7369;
*/

-- 6. Liste des employés du département 30 classés dans l'ordre des salaires croissants

SELECT ename_emp, deptno_dept,sal_emp
FROM emp
WHERE deptno_dept IN(30) ORDER BY sal_emp;

-- 7. Liste de tous les employés classés par emploi et salaires décroissants

SELECT ename_emp, job_emp, sal_emp
FROM emp
ORDER BY job_emp, sal_emp DESC;

-- 8. Liste des différents emplois

SELECT DISTINCT job_emp
FROM emp;

-- 9. Donner le nom du département où travaille ALLEN

SELECT dname_dept, ename_emp
FROM dept
INNER JOIN emp ON dept.deptno_dept = emp.deptno_dept 
WHERE ename_emp = "ALLEN";

-- 10. Liste des employés avec nom du département, nom, job, salaire classés par noms de départements et
-- par salaires décroissants.

SELECT  dname_dept,  ename_emp, job_emp, sal_emp
FROM emp
INNER JOIN dept ON dept.deptno_dept = emp.deptno_dept
ORDER BY dept.dname_dept, sal_emp DESC;

-- 11. Liste des employés vendeurs (SALESMAN) avec affichage de nom, salaire, commissions, salaire +
-- commissions

SELECT ename_emp, sal_emp, comm_emp, sal_emp + comm_emp
FROM emp
WHERE job_emp = "SALESMAN" ;

-- 12. Liste des employés du département 20: nom, job, date d'embauche sous forme VEN 28 FEV 1997'

SET lc_time_names = 'fr_FR';
SELECT ename_emp, job_emp, upper(date_format(hiredate_emp, "%a %e %b %Y"))As Date_FR
FROM emp
WHERE deptno_dept ="20";

-- 13. Donner le salaire le plus élevé par département

SELECT deptno_dept, max(sal_emp)
FROM emp 
GROUP BY deptno_dept;

-- 14. Donner département par département masse salariale, nombre d'employés, salaire moyen par type
-- d'emploi.

SELECT emp.deptno_dept, SUM(sal_emp + ifnull(comm_emp,0)), count(empno_emp), round(AVG(sal_emp),2),job_emp, dept.dname_dept    
FROM emp
INNER JOIN dept ON dept.deptno_dept = emp.deptno_dept
GROUP BY emp.deptno_dept, job_emp;

-- 15. Même question mais on se limite aux sous-ensembles d'au moins 2 employés

SELECT emp.deptno_dept, SUM(sal_emp + ifnull(comm_emp,0)), count(empno_emp), round(AVG(sal_emp),2),job_emp, dept.dname_dept    
FROM emp
INNER JOIN dept ON dept.deptno_dept = emp.deptno_dept
GROUP BY emp.deptno_dept, job_emp
HAVING COUNT(empno_emp)>=2;

-- 16. Liste des employés (Nom, département, salaire) de même emploi que JONES

SELECT ename_emp, deptno_dept, sal_emp, job_emp
FROM emp
WHERE job_emp = (SELECT job_emp
					FROM emp
					WHERE ename_emp LIKE "JONES");
  
 SELECT job_emp,ename_emp
					FROM emp
					WHERE ename_emp SOUNDs LIKE "Johns";
SELECT job_emp
FROM emp
WHERE ename_emp ="JONES";


-- 17. Liste des employés (nom, salaire) dont le salaire est supérieur à la moyenne globale des salaires

SELECT ename_emp, sal_emp, (SELECT AVG(sal_emp)
					FROM emp ) as "salaire moyen"
FROM emp
WHERE sal_emp > (SELECT AVG(sal_emp)
					FROM emp );

-- 18. Création d'une table PROJET avec comme colonnes numéro de projet (3 chiffres), 
-- nom de projet (5 caractères), budget. 
-- Entrez les valeurs suivantes:
-- 101, ALPHA, 96000
-- 102, BETA, 82000
-- 103, GAMMA, 15000

CREATE TABLE projet 
(
num_proj SMALLINT AUTO_INCREMENT,
nom_proj char(5) NOT NULL,
budget_proj DECIMAL(8,2) NOT NULL,
CONSTRAINT pk_num_proj PRIMARY KEY (num_proj)
);

ALTER TABLE projet AUTO_INCREMENT = 101;

INSERT INTO projet 
( nom_proj, budget_proj)
VALUES
("ALPHA", 96000),
("BETA" , 82000),
("GAMMA", 15000);


-- 19. Ajouter l'attribut numéro de projet à la table EMP et 
-- affecter tous les vendeurs du département 30 au projet 101, et les autres au projet 102

ALTER TABLE emp ADD num_proj SMALLINT;

UPDATE emp SET num_proj = 101
WHERE deptno_dept = 30 AND job_emp = 'salesman';

UPDATE emp SET num_proj = 102
WHERE num_proj IS NULL;

/*
UPDATE emp SET num_proj = 102
WHERE empno_emp != ALL (SELECT empno_emp WHERE deptno_dept = 30 AND job_emp = 'salesman');

UPDATE emp SET num_proj = NULL;
*/
/*
UPDATE emp SET num_proj = 102
WHERE deptno_dept <> 30 XOR job <> 'salesman';
*/

-- 20. Créer une vue comportant tous les employés avec nom, job, nom de département et nom de projet

CREATE VIEW vue
AS
	SELECT ename_emp, job_emp, dname_dept, nom_proj
    FROM emp
	JOIN dept ON emp.deptno_dept = dept.deptno_dept
    JOIN projet ON emp.num_proj = projet.num_proj;

DROP VIEW vue;
    
-- 21. A l'aide de la vue créée précédemment, lister tous les employés avec nom, job, nom de département
-- et nom de projet triés sur nom de département et nom de projet

SELECT ename_emp, job_emp, dname_dept, nom_proj
FROM vue
ORDER BY dname_dept, nom_proj;

-- 22. Donner le nom du projet associé à chaque manager

SELECT nom_proj, job_emp
FROM projet
JOIN emp ON emp.num_proj = projet.num_proj 
WHERE job_emp = "MANAGER"; 


-- Deuxième partie

-- 1. Afficher la liste des managers des départements 20 et 30

SELECT deptno_dept, ename_emp, job_emp
FROM emp
WHERE deptno_dept IN (20, 30)
ORDER BY deptno_dept, job_emp ;

-- 2. Afficher la liste des employés qui ne sont pas manager et qui ont été embauchés en 81

SELECT ename_emp, job_emp, date_format(hiredate_emp, "%Y") AS "annee embauchés"
FROM emp
WHERE job_emp <> "MANAGER" AND date_format(hiredate_emp, "%Y") = "1981";

-- 3. Afficher la liste des employés ayant une commission

SELECT ename_emp, comm_emp
FROM emp
WHERE comm_emp >= 0;

-- 4. Afficher la liste des noms, numéros de département, jobs et date d'embauche triés par 
--  (Numero de Département) et (JOB les derniers embauches d'abord).

SELECT ename_emp, deptno_dept, job_emp, hiredate_emp
FROM emp
ORDER BY deptno_dept, job_emp, hiredate_emp DESC;

-- ORDER BY date_format(hiredate_emp, "%Y %c %D") DESC;

-- 5. Afficher la liste des employés travaillant à DALLAS

SELECT ename_emp, loc_dept
FROM emp 
JOIN dept ON dept.deptno_dept = emp.deptno_dept
WHERE loc_dept = "DALLAS";

-- 6. Afficher les noms et dates d'embauche des employés embauchés avant (premier) leur manager, avec le nom et
-- date d'embauche du manager.

SELECT DISTINCT employer.ename_emp, employer.hiredate_emp, manager.ename_emp, manager.hiredate_emp
FROM emp employer, emp manager
WHERE manager.empno_emp = employer.mgr_emp AND employer.hiredate_emp < manager.hiredate_emp;




-- 7. Lister les numéros des employés n'ayant pas de subordonné.

-- 8. Afficher les noms et dates d'embauche des employés embauchés avant BLAKE.

-- 9. Afficher les employés embauchés le même jour que FORD.

-- 10. Lister les employés ayant le même manager que CLARK.

-- 11. Lister les employés ayant même job et même manager que TURNER.

-- 12. Lister les employés du département RESEARCH embauchés le même jour que quelqu'un du
-- département SALES.

-- 13. Lister le nom des employés et également le nom du jour de la semaine correspondant à leur date
-- d'embauche.

-- 14. Donner, pour chaque employé, le nombre de mois qui s'est écoulé entre leur date d'embauche et la
-- date actuelle.

-- 15. Afficher la liste des employés ayant un M et un A dans leur nom.

-- 16. Afficher la liste des employés ayant deux 'A' dans leur nom.

-- 17. Afficher les employés embauchés avant tous les employés du département 10.

-- 18. Sélectionner le métier où le salaire moyen est le plus faible.

-- 19. Sélectionner le département ayant le plus d'employés.

-- 20. Donner la répartition en pourcentage du nombre d'employés par département selon le modèle cidessous
-- 			Département 	Répartition en %
-- 			10 				21.43
-- 			20 				35.71
-- 			30 				42.86 


