SELECT `Difficulty_Name`, `Exercice_Name`, `History_Date`, `History_Repetition` ,`Exercice_Repetition`
FROM t_history
INNER JOIN t_exercice
on ID_Exercice = Exercice_ID
INNER JOIN t_difficulty
on ID_DIfficulty = Difficulty_ID
where History_Programme = 1
where Exercice_Name = "Pompes"
where Difficulty_Name = "easy"


