create database medistock;

use medistock;

-- Creación de la tabla roles
CREATE TABLE roles (
    idRole INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL
);

-- Creación de la tabla users
CREATE TABLE users (
    idUser INT (20) PRIMARY KEY,
    documentType VARCHAR(20) NOT NULL,
    nameU VARCHAR(50) NOT NULL,
    lastname VARCHAR(50) NOT NULL,
    birthdate Varchar (20) NOT NULL,
    age INT NOT NULL,
    gender VARCHAR(10) NOT NULL,
    phoneNumber VARCHAR(20) NOT NULL,
    profession VARCHAR(50) NOT NULL,
    addressU VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    passwordU VARCHAR(100) NOT NULL,
    code VARCHAR(10) NULL,
    fkIdRole INT NOT NULL,
    FOREIGN KEY (fkIdRole) REFERENCES roles(idRole) ON DELETE CASCADE
);

-- Creación de la tabla schedulings
CREATE TABLE schedulings (
    idScheduling INT PRIMARY KEY AUTO_INCREMENT,
    stateS VARCHAR(50) NOT NULL,
    dateHourStart DATETIME,
    dateHourEnd DATETIME,
    fkIdPatient INT (20) NULL,
    fkIdDoctor INT (20) NOT NULL,
    FOREIGN KEY (fkIdPatient) REFERENCES users(idUser) ON DELETE CASCADE,
    FOREIGN KEY (fkIdDoctor) REFERENCES users(idUser) ON DELETE CASCADE
);

-- Creación de la tabla diagnoses
CREATE TABLE diagnoses (
    idDiagnosis INT PRIMARY KEY AUTO_INCREMENT,
    dateHour TIMESTAMP NOT NULL,
    mainReason VARCHAR (2000) NOT NULL,    
    mainSymptoms VARCHAR (2000) NOT NULL,
    personalHistory VARCHAR (2000) NOT NULL,
    familiarHistory VARCHAR (2000) NOT NULL,
    vitalSigns VARCHAR (2000) NOT NULL,
    physicalExamination VARCHAR (2000) NOT NULL,
    aditionalObservations VARCHAR (2000) NOT NULL,
    fkIdScheduling INT NOT NULL,
    FOREIGN KEY (fkIdScheduling) REFERENCES schedulings(idScheduling) ON DELETE CASCADE
);

-- Creación de la tabla suppliers
CREATE TABLE suppliers (
    idSupplier INT PRIMARY KEY,
    nameSU VARCHAR(100) NOT NULL,
    addressSU VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phoneNumber VARCHAR(20) NOT NULL
);

-- Creación de la tabla medicines
CREATE TABLE medicines (
    idMedicine INT PRIMARY KEY AUTO_INCREMENT,
    nameM VARCHAR(100) NOT NULL,
    formatM VARCHAR(50) NOT NULL,
    stock INT NOT NULL,
    stateM VARCHAR(20) NOT NULL,
    expirationDate VARCHAR(10) NOT NULL,
    category VARCHAR(20) NOT NULL,
    fkIdSupplier INT NOT NULL,
    FOREIGN KEY (fkIdSupplier) REFERENCES suppliers(idSupplier) ON DELETE CASCADE
);

-- Creación de la tabla recipe
CREATE TABLE recipes (
    idRecipe INT PRIMARY KEY AUTO_INCREMENT,
    dateHour TIMESTAMP NOT NULL,
    routeAdministration VARCHAR(500) NOT NULL,
    duration VARCHAR(50) NOT NULL,
    frequency VARCHAR(50) NOT NULL,
    amount INT NOT NULL,
    stateR VARCHAR(50) NOT NULL,
    specialInstructions VARCHAR(5000) NOT NULL,
    fkIdMedicine INT NOT NULL,
    fkIdDiagnosis INT NOT NULL,
    FOREIGN KEY (fkIdMedicine)
    REFERENCES medicines (idMedicine) ON DELETE CASCADE,
    FOREIGN KEY (fkIdDiagnosis)
    REFERENCES diagnoses (idDiagnosis) ON DELETE CASCADE
);