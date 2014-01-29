CREATE TABLE `cte_optimizada`.`califiaciones_preguntas` (
  `calificacion` INT NOT NULL,
  `pregunta` INT NOT NULL,
  `calificacion_pregunta` INT NULL,
  PRIMARY KEY (`calificacion`, `pregunta`));
  
CREATE TABLE `cte_optimizada`.`preguntas` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(50) NULL,
  `pregunta` VARCHAR(250) NULL,
  `descripcion_valor_minimo` VARCHAR(50) NULL,
  `descripcion_valor_maximo` VARCHAR(50) NULL,
  PRIMARY KEY (`id`));
  
  ALTER TABLE `cte_optimizada`.`programas` 
ADD COLUMN `mongo` VARCHAR(100) NULL AFTER `sitio_web`;

  