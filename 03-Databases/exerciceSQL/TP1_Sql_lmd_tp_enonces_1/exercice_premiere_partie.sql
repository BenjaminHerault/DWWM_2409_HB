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



-- 11. Liste des employés vendeurs (SALESMAN) avec affichage de nom, salaire, commissions, salaire +
-- commissions

-- 12. Liste des employés du département 20: nom, job, date d'embauche sous forme VEN 28 FEV 1997'

-- 13. Donner le salaire le plus élevé par département

-- 14. Donner département par département masse salariale, nombre d'employés, salaire moyen par type
-- d'emploi.

-- 15. Même question mais on se limite aux sous-ensembles d'au moins 2 employés

-- 16. Liste des employés (Nom, département, salaire) de même emploi que JONES

-- 17. Liste des employés (nom, salaire) dont le salaire est supérieur à la moyenne globale des salaires

-- 18. Création d'une table PROJET avec comme colonnes numéro de projet (3 chiffres), nom de projet(5
-- caractères), budget. Entrez les valeurs suivantes:
-- 101, ALPHA, 96000
-- 102, BETA, 82000
-- 103, GAMMA, 15000

-- 19. Ajouter l'attribut numéro de projet à la table EMP et affecter tous les vendeurs du département 30
-- au projet 101, et les autres au projet 102

-- 20. Créer une vue comportant tous les employés avec nom, job, nom de département et nom de projet

-- 21. A l'aide de la vue créée précédemment, lister tous les employés avec nom, job, nom de département
-- et nom de projet triés sur nom de département et nom de projet

-- 22. Donner le nom du projet associé à chaque manager