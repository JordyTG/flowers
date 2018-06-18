-- -----------------------------------------------------
-- Table `geekshop`.`Administrador`
-- -----------------------------------------------------
CREATE TABLE `Administrador` (
  `id_administrador` CHAR(5) NOT NULL,
  `usuario` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
   `apellido`                       varchar(20),
   `direccion`                      varchar(50),
   `telefono`                       varchar(10),
  
  PRIMARY KEY (`id_administrador`))



-- -----------------------------------------------------
-- Table `geekshop`.`Usuarios`
-- -----------------------------------------------------
CREATE TABLE `Usuarios` (
  `id_usuario` int NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
   `nombre`  varchar(20),
   `apellido`                       varchar(20),
   `direccion`                      varchar(50),
   `telefono`                       varchar(10),
  PRIMARY KEY (`id_usuario`))



-- -----------------------------------------------------
-- Table `geekshop`.`Proveedor`
-- -----------------------------------------------------
CREATE TABLE `Proveedor` (
  `id_proveedor` int not null AUTO_INCREMENT,
  `codproveedor` VARCHAR(10) NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  `telefono` VARCHAR(15) NOT NULL,
  `email` VARCHAR(30) NOT NULL,
   `direccion`                      varchar(50),
   
  PRIMARY KEY (`id_proveedor`))



-- -----------------------------------------------------
-- Table `geekshop`.`Productos`
-- -----------------------------------------------------
CREATE TABLE `Productos` (
  `id_producto` int not null AUTO_INCREMENT,
  `codproducto` VARCHAR(10) NOT NULL,
  `stock` INT NOT NULL,
  `descripcion` VARCHAR(45) NOT NULL,
  `precio_unit` DOUBLE NOT NULL,
  `id_proveedor` int NOT NULL,
  PRIMARY KEY (`id_producto`),
  CONSTRAINT `idProveedor`
    FOREIGN KEY (`id_proveedor`)
    REFERENCES `Proveedor` (`id_proveedor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)

CREATE INDEX `idProveedor_idx` ON `geekshop`.`Productos` (`id_proveedor` ASC);


-- -----------------------------------------------------
-- Table `geekshop`.`Pedidos`
-- -----------------------------------------------------
CREATE TABLE `Pedidos` (
  `id_pedido` INT NOT NULL AUTO_INCREMENT,
  `fecha` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `confirmacion` CHAR(1) NOT NULL,
  `id_usuario` int NOT NULL,
  PRIMARY KEY (`id_pedido`),
  CONSTRAINT `id_usuario`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `Usuarios` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)

-- -----------------------------------------------------
-- Table `geekshop`.`Facturas`
-- -----------------------------------------------------
CREATE TABLE `Facturas` (
  `id_facturas` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `cedula` VARCHAR(10) NOT NULL,
  `telefono` VARCHAR(15) NOT NULL,
  `direccion` VARCHAR(45) NOT NULL,
  `num_facturas` CHAR(15) NOT NULL,
  `ruc` VARCHAR(15) NOT NULL,
  `fecha_emision`  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `tipo_gasto` VARCHAR(20) NOT NULL,
  `valor_base` DOUBLE NOT NULL,
  `iva` DOUBLE NOT NULL,
  `descuento` DOUBLE NOT NULL,
  `total` DOUBLE NOT NULL,
  `id_pedido` INT NOT NULL,
  `confirmacion` CHAR(1) NOT NULL,
  PRIMARY KEY (`id_facturas`))


-- -----------------------------------------------------
-- Table `geekshop`.`Detalles`
-- -----------------------------------------------------
CREATE TABLE `Detalles` (
  `id_detalles` INT NOT NULL AUTO_INCREMENT,
  `id_pedido` INT NOT NULL,
  `id_producto` int NOT NULL,
  `descripcion` VARCHAR(45) NOT NULL,
  `cantidad` INT NOT NULL,
  `valor_unit` DOUBLE NOT NULL,
  `valor_total` DOUBLE NOT NULL,
  PRIMARY KEY (`id_detalles`),
  CONSTRAINT `id_producto`
    FOREIGN KEY (`id_producto`)
    REFERENCES `Productos` (`id_producto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `id_pedido`
    FOREIGN KEY (`id_pedido`)
    REFERENCES `Pedidos` (`id_pedido`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)




